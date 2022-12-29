s.com|halloweenforum.com|handgunforum.net|handgunsandammunition.com|hardcoresledder.com|harley-davidsonforums.com|hauntforum.com|havaneseforum.com|haytalk.com|hdlivewireforum.com|hdstreetforums.com|hedgehogcentral.com|hellcat.org|hemitruckclub.com|heresy-online.net|hipointfirearmsforums.com|hkpro.com|hobbytalk.com|hockeyforum.com|homesteadingtoday.com|hometheatershack.com|hondaatvforums.net|hondacb1000r.com|hondacivicforum.co.uk|hondaforeman.com|hondagrom.net|hondapioneerforum.com|hondarebel3forum.com|hondarebelforum.com|hondashadow.net|hondatwins.net|horseforum.com|hotrodders.com|hrvforum.com|hummerchat.com|huntingpa.com|hyundai-forums.com|hyundaicoupeclub.co.uk|hyundaikonaforum.com|hyundaiperformance.com|i-paceforum.com|i4talk.com|ibsgroup.org|ifish.net|ilovemycockapoo.com|imboc.com|impalaforums.com|impalas.net|impalassforum.com|impreza5.com|indianmotorcycles.net|infinitifx.org|infinitiq30.org|infinitiq50.org|infinitiq60.org|infinitiqx30.org|infinitiqx60.org|insightcentral.net|ioniqforum.com|ipaceforums.co.uk|iq-forums.com|iwsti.com|ixforums.com|jaginfo.org|jaguarxeforum.com|jeepcherokeeclub.com|jeepcommander.com|jeepforum.com|jeepgarage.org|jeeppatriot.com|jeeprenegadeforum.com|jeeptrackhawk.org|jemsite.com|jettajunkie.com|jockeyjournal.com|jukeforums.co.uk|jukeforums.com|jukeownersclub.co.uk|justlabradors.com|k-bikes.com|k1600forum.com|k20a.org|k5owners.com|kanyetothe.com|kawasakimotorcycle.org|kawasakininja1000.com|kawasakiversys.com|kawasakiworld.com|kawasakiz650.com|kawieriders.com|kawiforums.com|kboards.com|kfx450hq.com|kia-forums.com|kiaevforums.com|kianiroforum.com|kiaownersclub.co.uk|kiasoulforums.com|kimbertalk.com|klrforum.com|kodiakowners.com|kodiaqforums.co.uk|ktm1090forum.net|ktmatvhq.com|ktmduke390forum.com|ktmforum.co.uk|ktmforums.com|kugaownersclub.co.uk|labradoodle-dogs.net|labradorforums.co.uk|lakestclair.net|lamborghini-talk.com|lancerregister.com|landroversonly.com|layitlow.com|lexusfforum.com|lexusnxforum.com|librarium-online.com|lightningowners.com|lightningrodder.com|longislandfirearms.com|lotustalk.com|ls1gto.com|ls1lt1.com|ltr450hq.com|lucid-forum.com|lugerforums.com|m109riders.com|m14forum.com|m5board.com|macanforum.com|macheclub.com|majestyusa.com|marlinforum.com|marlinowners.com|maseratilevanteforum.com|maseratilife.com|masscops.com|maverickchat.com|maverickforums.net|mazda2revolution.com|mazda3forums.com|mazda3revolution.com|mazda6club.com|mazdaworld.org|mbeqclub.com|mclarenlife.com|mdxers.org|medstudentz.com|meganesport.net|mercedescla.org|mercedesclaforum.com|mercedesgleforum.com|mercurycougar.net|metalguitarist.org|metrisforum.com|mg-rover.org|michiganreefers.com|microskiff.com|migweb.co.uk|mini2.com|minievforum.com|minif56.com|minitorque.com|missouriwhitetails.com|mitsubishi-forums.com|mmaforum.com|moddedraptor.com|modelrailforum.com|modeltrainforum.com|moderncamaro.com|modularfords.com|mokkaownersclub.co.uk|mondeostoc.com|mothering.com|motorcycleforum.com|motorcycleforums.net|motorgeek.com|mountainbuzz.com|mp-pistol.com|mr2oc.com|msgo.com|mudinmyblood.net|mustangecoboost.net|mustangevolution.com|mvagusta.net|mx30forum.com|mx5life.com|mx5nutz.com|mx6.com|my.is|myaudiq5.com|mybikeforums.com|myfastgti.com|myjeepcompass.com|mylargescale.com|mylawnmowerforum.com|mymbonline.com|mytiguan.com|mytractorforum.com|mytreg.com|myturbodiesel.com|nagca.com|nationalgunforum.com|ncangler.com|newbeetle.org|newcelica.org|newcougar.org|newjerseyhunter.com|newninja.com|newnissanz.com|newtiburon.com|ninetowners.com|ninja400riders.com|ninjah2.org|nissan-navara.net|nissanclub.com|nissancubelife.com|nissanforums.com|nissankicksforum.com|nissanmurano.org|nissanversaforums.com|nitroforumz.com|nordenforums.com|noteownersclub.co.uk|novas.net|novascotiafishing.com|novascotiahunting.com|nv200forum.com|nybass.com|nyfirearms.com|observedtrials.net|oceanforums.com|odyclub.com|off-road.com|ohiogamefishing.com|ohiosportsman.com|onefora.com|onesixthwarriors.com|opelgt.com|optimaforums.com|ourbeagleworld.com|outbackers.com|outlanderforums.com|pacificaforums.com|paintballforum.com|painttalk.com|palisadeforum.com|panamericaer, period) {
            switch (period) {
                case 'y':
                    return number === 1 ? '元年' : number + '年';
                case 'd':
                case 'D':
                case 'DDD':
                    return number + '日';
                default:
                    return number;
            }
        },
        relativeTime: {
            future: '%s後',
            past: '%s前',
            s: '数秒',
            ss: '%d秒',
            m: '1分',
            mm: '%d分',
            h: '1時間',
            hh: '%d時間',
            d: '1日',
            dd: '%d日',
            M: '1ヶ月',
            MM: '%dヶ月',
            y: '1年',
            yy: '%d年',
        },
    });

    return ja;

})));
