com|simplo.org|directdeals.io|reduto.ie|reduto.fr|reduto.it|reduto.at|reduto.be|reduto.es|reduto.nl|helpful.tips|best-jobs-online.com","||cdn1.inspsearchapi.com/commoncdn/abp/px.gif?ch=2$domain=infojustnow.com|understoodnow.com|clipmigo.com|bestsearch.tips|superask.tips|makeanswer.com|groovyanswers.com|searchhelper.net|findyoursearch.org|searchforonline.com|search.one|fivetoptips.com|findtoday.info|quicklyresults.com|find-info.co|mysearchhelp.com|search.fivetoptips.co|search.search.one|veryfastinfo.com|examineinfo.com|superfastinfo.com|top.mujibo.tips|relatedresult.com|listingsupdated.com|search.smoody.net|search.kognito.me|linkvertise.com|search.dealcart.co|results.findgiftdeals.com|searchtoday.site|bestfindtoday.com|infoinstantly.com|browsinginfo.com|price-shopping.co|seshamo.tips|dealday.sale|dealday.club|dealday.today|dealday.sale|dealday.store|luckysrch.com|salesstocker.com|healthythingy.com|askfest.com|autorari.com|simplisenior.com|careerjob360.com|ehealthiq.com|financeweb.org|legalboulevard.com|savings.shop|topbestanswers.com|mujibo.com|reviewer.today|fastquickanswers.com|suvcarfinder.com|find.ageful.com|relativeanswers.com|doubtresolver.com|10best.cc|howtogetridofstuff.com|searchkibble.com|higherincomejobs.com|onlygreatjobs.com|luxxle.com|best.answers.today|smartfinance.tips|bestresultstoday.com|search.goliath.com|search.forkly.com|magazinoid.com|top.results.vip|savesmart.shop|zenya.com|ynetnews.com|openwebshopper.com|todayconsumer.com|allproductsweb.com|dogpile.com|howstuffworks.com|dental-health.care|healthinfo.care|search.childhood.com|s.healthnwell.com|search.legalboulevard.com|comparedeals247.com|search.carsgenius.com|search.walletgenius.com|dealpilot.com|findresultsweb.com|techserious.com|travel-wise.com|wheelscene.com|help.website|plis.co|fandian.us|options.xyz|quandas.org|life65.com|health.family|editorsreview.org|hiyo.com|articlebasement.com|toptopics.net|webopedia.com|travelerexplore.com|techsavvywire.com|symptomcare.com|socialscour.com|shopperprices.com|realtorfinds.com|lookrecipes.com|investingrelief.com|homegardenshed.com|autosengine.com|encyclopedia.com|chek.com|leaprate.com|tips.today|gexsi.com|frontpage.pch.com|search.pch.com|alhea.com|searchall.com|knowzo.com|info.com|info.co.uk|info.com.au|crawler.com|financeweb.org|ehealthiq.com|thenexttask.com|lifescript.com|search.socialdownloadr.com|mypoints.com|comparison411.com|zipfilesearch.com|pdfconvertsearch.com|checkspeedsearch.com|mystart.space|seekit.com|search.avira.net|search.avira.com|search.monstercrawler.com|search.ozby.com|search.soundrad.net|myplaycity.com|allgameshome.com|igropark.ru|buzztechnology.net|buzzfinance.net|search.navegaki.com|search.atajitos.com|search.portalsepeti.com|usdirectory.com|getsearch.club|yidio.com|search.scanguard.com|search.totalav.com|search.pcprotect.com|search.mapsnt.com|bitmotion-tab.com|incognito-search.com|quizcourt.com|lightdials.com|search.emailaccountlogin.co|results.ur-search.com|boost.ur-search.com|offeroftheday.co.uk|homenewtab.com|webcrawler.com|search.sportstrackerx.com|search2.sportstrackerx.com|alientab.net|search.relola.com|search.ichro.me|owntitle.com|chilimovie.com|uchat.com|browser.start.fyi|web.start.fyi|guardengine.com|shopping.selfbutler.com|search.selfbutler.com|zenya.co|looksmart.com|wisegoose.com|search.us.com|netzerosearch.net|search.topicbites.com|mapquest.com|startpage.com|asked.com|simplo.org|directdeals.io|reduto.ie|reduto.fr|reduto.it|reduto.at|reduto.be|reduto.es|reduto.nl|helpful.tips|best-jobs-online.com","@@||admarketplace.net/imp?$image,domain=infojustnow.com|understoodnow.com|clipmigo.com|bestsearch.tips|superask.tips|makeanswer.com|groovyanswers.com|searchhelper.net|findyoursearch.org|searchforonline.com|search.one|fivetoptips.com|findtoday.info|quicklyresults.com|find-info.co|mysearchhelp.com|search.fivetoptips.co|search.search.one|veryfastinfo.com|examineinfo.com|superfastinfo.com|top.mujibo.tips|relatedresult.com|listingsupdated.com|search.smoody.net|search.kognito.me|linkvertise.com|search.dealcart.co|results.findgiftdeals.com|searchtoday.site|bestfindtoday.com|infoinstantly"define"
        return "keyword"
      }
      if (prev == "define") return "def"
      return "variable"
    }

    stream.next()
    return null
  }

  function tokenUntilClosingParen() {
    var depth = 0
    return function(stream, state, prev) {
      var inner = tokenBase(stream, state, prev)
      if (inner == "punctuation") {
        if (stream.current() == "(") ++depth
        else if (stream.current() == ")") {
          if (depth == 0) {
            stream.backUp(1)
            state.tokenize.pop()
            return state.tokenize[state.tokenize.length - 1](stream, state)
          }
          else --depth
        }
      }
      return inner
    }
  }

  function tokenString(openQuote, stream, state) {
    var singleLine = openQuote.length == 1
    var ch, escaped = false
    while (ch = stream.peek()) {
      if (escaped) {
        stream.next()
        if (ch == "(") {
          state.tokenize.push(tokenUntilClosingParen())
          return "string"
        }
        escaped = false
      } else if (stream.match(openQuote)) {
        state.tokenize.pop()
        return "string"
      } else {
        stream.next()
        escaped = ch == "\\"
      }
    }
    if (singleLine) {
      state.tokenize.pop()
    }
    return "string"
  }

  function tokenComment(stream, state) {
    var ch
    while (true) {
      stream.match(/^[^/*]+/, true)
      ch = stream.next()
      if (!ch) break
      if (ch === "/" && stream.eat("*")) {
        state.tokenize.push(tokenComment)
      } else if (ch === "*" && stream.eat("/")) {
        state.tokenize.pop()
      }
    }
    return "comment"
  }

  function Context(prev, align, indented) {
    this.prev = prev
    this.align = align
    this.indented = indented
  }

  function pushContext(state, stream) {
    var align = stream.match(/^\s*($|\/[\/\*])/, false) ? null : stream.column() + 1
    state.context = new Context(state.context, align, state.indented)
  }

  function popContext(state) {
    if (state.context) {
      state.indented = state.context.indented
      state.context = state.context.prev
    }
  }

  CodeMirror.defineMode("swift", function(config) {
    return {
      startState: function() {
        return {
          prev: null,
          context: null,
          indented: 0,
          tokenize: []
        }
      },

      token: function(stream, state) {
        var prev = state.prev
        state.prev = null
        var tokenize = state.tokenize[state.tokenize.length - 1] || tokenBase
        var style = tokenize(stream, state, prev)
        if (!style || style == "comment") state.prev = prev
        else if (!state.prev) state.prev = style

        if (style == "punctuation") {
          var bracket = /[\(\[\{]|([\]\)\}])/.exec(stream.current())
          if (bracket) (bracket[1] ? popContext : pushContext)(state, stream)
        }

        return style
      },

      indent: function(state, textAfter) {
        var cx = state.context
        if (!cx) return 0
        var closing = /^[\]\}\)]/.test(textAfter)
        if (cx.align != null) return cx.align - (closing ? 1 : 0)
        return cx.indented + (closing ? 0 : config.indentUnit)
      },

      electricInput: /^\s*[\)\}\]]$/,

      lineComment: "//",
      blockCommentStart: "/*",
      blockCommentEnd: "*/",
      fold: "brace",
      closeBrackets: "()[]{}''\"\"``"
    }
  })

  CodeMirror.defineMIME("text/x-swift","swift")
});
