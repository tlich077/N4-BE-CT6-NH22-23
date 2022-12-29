r> switch. It may be quite voluminous depending on the complexity
of the match.  Using C<debugcolor> instead of C<debug> enables a
form of output that can be used to get a colorful display on terminals
that understand termcap color sequences.  Set C<$ENV{PERL_RE_TC}> to a
comma-separated list of C<termcap> properties to use for highlighting
strings on/off, pre-point part on/off.
See L<perldebug/"Debugging Regular Expressions"> for additional info.

As of 5.9.5 the directive C<use re 'debug'> and its equivalents are
lexically scoped, as the other directives are.  However they have both
compile-time and run-time effects.

See L<perlmodlib/Pragmatic Modules>.

=head2 'Debug' mode

Similarly C<use re 'Debug'> produces debugging output, the difference
being that it allows the fine tuning of what debugging output will be
emitted. Options are divided into three groups, those related to
compilation, those related to execution and those related to special
purposes. The options are as follows:

=over 4

=item Compile related options

=over 4

=item COMPILE

Turns on all non-extra compile related debug options.

=item PARSE

Turns on debug output related to the process of parsing the pattern.

=item OPTIMISE

Enables output related to the optimisation phase of compilation.

=item TRIEC

Detailed info about trie compilation.

=item DUMP

Dump the final program out after it is compiled and optimised.

=item FLAGS

Dump the flags associated with the program

=item TEST

Print output intended for testing the internals of the compile process

=back

=item Execute related options

=over 4

=item EXECUTE

Turns on all non-extra execute related debug options.

=item MATCH

Turns on debugging of the main matching loop.

=item TRIEE

Extra debugging of how tries execute.

=item INTUIT

Enable debugging of start-point optimisations.

=back

=item Extra debugging options

=over 4

=item EXTRA

Turns on all "extra" debugging options.

=item BUFFERS

Enable debugging the capture group storage during match. Warning,
this can potentially produce extremely large output.

=item TRIEM

Enable enhanced TRIE debugging. Enhances both TRIEE
and TRIEC.

=item STATE

Enable debugging of states in the engine.

=item STACK

Enable debugging of the recursion stack in the engine. Enabling
or disabling this option automatically does the same for debugging
states as well. This output from this can be quite large.

=item GPOS

Enable debugging of the \G modifier.

=item OPTIMISEM

Enable enhanced optimisation debugging and start-point optimisations.
Probably not useful except when debugging the regexp engine itself.

=item OFFSETS

Dump offset information. This can be used to see how regops correlate
to the pattern. Output format is

   NODENUM:POSITION[LENGTH]

Where 1 is the position of the first char in the string. Note that position
can be 0, or larger than the actual length of the pattern, likewise length
can be zero.

=item OFFSETSDBG

Enable debugging of offsets information. This emits copious
amounts of trace information and doesn't mesh well with other
debug options.

Almost definitely only useful to people hacking
on the offsets part of the debug engine.

=item DUMP_PRE_OPTIMIZE

Enable the dumping of the compiled pattern before the optimization phase.

=item WILDCARD

When Perl encounters a wildcard subpattern, (see L<perlunicode/Wildcards in
Property Values>), it suspends compilation of the main pattern, compiles the
subpattern, and then matches that against all legal possibilities to determine
the actual code points the subpattern matches.  After that it adds these to
the main pattern, and continues its compilation.

You may very well want to see how your subpattern gets compiled, but it is
likely of less use to you to see how Perl matches that against all the legal
possibilities, as that is under control of Perl, not you.   Therefore, the
debugging information of the compilation portion is as specified by the other
options, but the debugging output of the matching portion is normally
suppressed.

You can use the WILDCARD option to enable the debugging output of this
subpattern matching.  Careful!  This can lead to voluminous outputs, and it
may not make much sense to you what and why Perl is doing what it is.
But it may be helpful to you to see why things aren't going the way you
expect.

Note that this option alone doesn't cause any debugging information to be
output.  What it does is stop the normal suppression of execution-related
debugging information during the matching portion of the compilation of
wildcards.  You also have to specify which execution debugging information you
want, such as by also including the EXECUTE option.

=back

=item Other useful flags

These are useful shortcuts to save on the typing.

=over 4

=item ALL

Enable all opt