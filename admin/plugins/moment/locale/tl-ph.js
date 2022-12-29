d retry
            $self->_connection_kill;
            die "Error sending request: $err";
        };
    $self->trace_msg("Request sent: $encoded_request\n",0) if $trace >= 4;

    return undef; # indicate no response yet (so caller calls receive_response_by_transport)
}


sub receive_response_by_transport {
    my $self = shift;
    my $trace = $self->trace;

    $self->trace_msg("receive_response_by_transport: awaiting response\n",0) if $trace >= 4;
    my $connection = $self->connection_info || die;
    my ($pid, $rfh, $efh, $cmd) = @{$connection}{qw(pid rfh efh cmd)};

    my $errno = 0;
    my $encoded_response;
    my $stderr_msg;

    $self->read_response_from_fh( {
        $efh => {
            error => sub { warn "error reading response stderr: $!"; $errno||=$!; 1 },
            eof   => sub { warn "eof reading efh" if $trace >= 4; 1 },
            read  => sub { $stderr_msg .= $_; 0 },
        },
        $rfh => {
            error => sub { warn "error reading response: $!"; $errno||=$!; 1 },
            eof   => sub { warn "eof reading rfh" if $trace >= 4; 1 },
            read  => sub { $encoded_response .= $_; ($encoded_response=~s/\015\012$//) ? 1 : 0 },
        },
    });

    # if we got no output on stdout at all then the command has
    # probably exited, possibly with an error to stderr.
    # Turn this situation into a reasonably useful DBI error.
    if (not $encoded_response) {
        my @msg;
        push @msg, "error while reading response: $errno" if $errno;
        if ($stderr_msg) {
            chomp $stderr_msg;
            push @msg, sprintf "error reported by \"%s\" (pid %d%s): %s",
                $self->cmd_as_string,
                $pid, ((kill 0, $pid) ? "" : ", exited"),
                $stderr_msg;
        }
        die join(", ", "No response received", @msg)."\n";
    }

    $self->trace_msg("Response received: $encoded_response\n",0)
        if $trace >= 4;

    $self->trace_msg("Gofer stream stderr message: $stderr_msg\n",0)
        if $stderr_msg && $trace;

    my $frozen_response = pack("H*", $encoded_response);

    # XXX need to be able to detect and deal with corruption
    my $response = $self->thaw_response($frozen_response);

    if ($stderr_msg) {
        # add stderr messages as warnings (for 