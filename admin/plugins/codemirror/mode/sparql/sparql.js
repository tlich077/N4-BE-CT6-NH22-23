leaner.com|dieselfuellube.com|dieselmovies.com|dieselplace.com|dieselramforum.com|digestionboards.com|digitalcorvettes.com|digitalhome.ca|dirtbikes.com|discoverysport.net|diycentral.com|diyelectriccar.com|diymobileaudio.com|dobermantalk.com|dodge-nitro.com|dodgedartcentral.com|dodgeintrepid.net|dodgetalk.com|dog-obedience-training-review.com|dogfoodchat.com|dogforum.com|dogforums.com|dognameswoof.com|dootalk.com|driveaccord.net|drywalltalk.com|ds-450central.com|ds450hq.com|dsmtalk.com|ducati-superbikes.com|ducati.ms|ducatimonster.org|ducatiscramblerforum.com|duckhuntingchat.com|easttennesseefishing.com|ecoboostmustang.org|ecoboostraptors.com|ehmac.ca|elantraforum.com|elantraxd.com|elcaminocentral.com|elcaminos.com|electraforum.com|electriciantalk.com|elementownersclub.com|enclaveforum.net|encoreforums.com|encoreowners.com|engine-care.com|evo4gforum.net|evotuners.net|evoxforums.com|ex-500.com|expatforum.com|f-typeclub.com|f-typeforum.com|f650.co.uk|f6baggers.com|f6cforum.com|f800riders.org|family-marriage-counseling.com|fancymicebreeders.com|fcxclub.com|feoa.net|ferrari-talk.com|ferrarilife.com|ffcars.com|fiat500owners.com|fiatforums.com|fiatscene.com|fiestadrivers.com|fiestastoc.com|firebirdnation.com|fishforums.com|fishingcountry.com|fishstoredirectory.com|fishtanks.net|fiskerbuzz.com|fitownersclub.com|fjcruiserforums.com|fjrowners.com|floridaspl.com|flyfishbc.com|flyfishingforum.com|flytyingbug.com|fmvperformance.com|focusdrivers.com|focusfanatics.com|focusrsclub.com|focusrsoc.com|focusstoc.com|footballforum.com|ford-taurus.org|fordescape.org|fordfocuselectric.com|fordforums.com|fordfusionclub.com|fordgt500.com|fordinsidenews.com|fordmuscleforums.com|fordranger.net|fordtough.ca|fordtransitusaforum.com|forteforums.com|fourtitude.com|fpaceforum.com|fr-sforum.com|frugalvillage.com|fullsizebronco.com|furyforums.com|fz-09forums.com|fz6forums.com|fz8forum.com|g20.net|g450riders.org|g5club.net|g6ownersclub.com|g8board.com|g8forum.com|galaxys2forums.com|galaxys3forum.com|gameandfishrecipes.com|gasserhotrods.com|gasstinks.com|gatorforums.net|gencoupe.com|genesisforums.com|genesisforums.org|germanshepherds.com|ghibliforum.com|giuliaforums.com|gixxer.com|gl1800riders.com|glaowners.com|glcforums.com|gm-volt.com|gmdietforum.com|gmdietworks.com|gminsidenews.com|gmtruckclub.com|goldenretrieverforum.com|goldwingfacts.com|goldwingowners.com|golf7forum.com|golfforum.com|golfgteforum.com|golfr400forum.com|goosehuntingchat.com|gopitbull.com|goproforums.com|grandcherokeephotos.com|grandwagoneer.org|graniteowners.com|greatlakes4x4.com|greentractortalk.com|greentractortoolstore.com|grizzlycentral.com|grizzlyowners.com|grizzlyriders.com|gromforum.com|gs350forum.com|gsxr.com|gsxs1000.org|gtaaquaria.com|gtoforum.com|gtrlife.com|gundogguide.com|h2fanatic.com|hardcoresledder.com|harley-davidsonforums.com|havaneseforum.com|haytalk.com|hdlivewireforum.com|healthmediatoday.com|hedgehogcentral.com|hemiforum.com|heresy-online.net|hobbytalk.com|hockeyforum.com|homerefurbers.com|hometheatershack.com|hondaatvforums.net|hondacbr125r.com|hondaforeman.com|hondapioneerforum.com|hondarebelforum.com|hondashadow.net|hornet-forum.com|horseforum.com|hotrodders.com|hrvforum.com|htcdesireforum.com|huntingne.com|huskytalk.com|hvacsite.com|hybridcars.com|hybridexplorer.com|hybridforums.org|hyundai-forums.com|hyundaiperformance.com|ibdsupport.org|icefishingchat.com|ifish.net|ihackmyi.com|ilovemycockapoo.com|ilxclub.com|ilxforums.com|imboc.com|impalaforums.com|impalas.net|impalassforum.com|inegma.net|infinitifx.org|infinitijxforum.com|infinitiq30.org|infinitiq50.org|infinitiq50forums.com|infinitiq60.org|infinitiqx30.org|infinitiqx50.org|infinitiqx60.org|infinitiqx70.org|infinitiqx80.org|insightcentral.net|iq-forums.com|iqcolony.com|ivf.ca|j300forum.com|jdtechtalk.com|jeepcherokeeclub.com|jeepcommander.com|jeeperos.com|jeeppatriot.com|jeeprenegadeforum.com|jeeptrackhawk.org|jetski.com|jetskinews.com|jettaforums.com|jettajunkie.com|jkowners.com|jockeyjournal.com|jukeforums.com|justlabradors.com|k-bikes.com|k-series.com|k1600forum.com|k20a.org|k900forum.com|kanyetothe.comalse, ch;
      while ((ch = stream.next()) != null) {
        if (ch == quote && !escaped) {
          state.tokenize = tokenBase;
          break;
        }
        escaped = !escaped && ch == "\\";
      }
      return "string";
    };
  }

  function pushContext(state, type, col) {
    state.context = {prev: state.context, indent: state.indent, col: col, type: type};
  }
  function popContext(state) {
    state.indent = state.context.indent;
    state.context = state.context.prev;
  }

  return {
    startState: function() {
      return {tokenize: tokenBase,
              context: null,
              indent: 0,
              col: 0};
    },

    token: function(stream, state) {
      if (stream.sol()) {
        if (state.context && state.context.align == null) state.context.align = false;
        state.indent = stream.indentation();
      }
      if (stream.eatSpace()) return null;
      var style = state.tokenize(stream, state);

      if (style != "comment" && state.context && state.context.align == null && state.context.type != "pattern") {
        state.context.align = true;
      }

      if (curPunc == "(") pushContext(state, ")", stream.column());
      else if (curPunc == "[") pushContext(state, "]", stream.column());
      else if (curPunc == "{") pushContext(state, "}", stream.column());
      else if (/[\]\}\)]/.test(curPunc)) {
        while (state.context && state.context.type == "pattern") popContext(state);
        if (state.context && curPunc == state.context.type) {
          popContext(state);
          if (curPunc == "}" && state.context && state.context.type == "pattern")
            popContext(state);
        }
      }
      else if (curPunc == "." && state.context && state.context.type == "pattern") popContext(state);
      else if (/atom|string|variable/.test(style) && state.context) {
        if (/[\}\]]/.test(state.context.type))
          pushContext(state, "pattern", stream.column());
        else if (state.context.type == "pattern" && !state.context.align) {
          state.context.align = true;
          state.context.col = stream.column();
        }
      }

      return style;
    },

    indent: function(state, textAfter) {
      var firstChar = textAfter && textAfter.charAt(0);
      var context = state.context;
      if (/[\]\}]/.test(firstChar))
        while (context && context.type == "pattern") context = context.prev;

      var closing = context && firstChar == context.type;
      if (!context)
        return 0;
      else if (context.type == "pattern")
        return context.col;
      else if (context.align)
        return context.col + (closing ? 0 : 1);
      else
        return context.indent + (closing ? 0 : indentUnit);
    },

    lineComment: "#"
  };
});

CodeMirror.defineMIME("application/sparql-query", "sparql");

});
