$('.onlineTestButton').on('click',function () {
    $('#onlineTest').show();
});

(function() {
    var questions = [
        {
        question:"Kto organizuje jazdecký šport v SR?",
        choices:[
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
        correctAnswer: 3
        },
        {
        question:"Aký je názov medzinárodnej jazdeckej federácie?",
        choices:[
        "Federation Equestre Internationale (FEI)",
        "National Equestrian Federation (NEF)",
        "International Equestre Federation (IEF)",
        "Internationale Equestrian Sport Federation (IESF)"],
        correctAnswer: 0
        },
        {
        question:"Čím sa riadia jednotlivé súťaže všetkých disciplín jazdeckého športu?",
        choices:[
        "Pravidlá určeného jazdeckého klubu, alebo jazdeckej školy",
        "Pravidlá stredoslovenského zväzu jazdeckého športu",
        "Pravidlá jazdeckého športu SJF",
        "Pravidlá presne určené športovo–technickou odbornou komisiou"],
        correctAnswer: 2
        },
        {
        question:"Z ktorých disciplín sa skladá súťaž všestrannej spôsobilosti (military)?",
        choices:[
        "Voltíž, drezúra, parkúr",
        "Terénna jazda, drezúra, western",
        "Dostihy, parkúr, terénna jazda",
        "Drezúra, terénna jazda, parkúr"],
        correctAnswer: 3
        },
        {
        question:"Popis drezúrneho obdĺžnika",
        choices:[
        "Rozmery 15x50 (20x40) m",
        "Rozmery 20x50 (20x40) m",
        "Rozmery 30x50 (20x40) m",
        "Rozmery 20x60 (20x40) m"],
        correctAnswer: 3
        },
        {
        question:"Aký je spôsob hodnotenia v drezúrnej súťaži?",
        choices:[
        "Predvedenie predpísaných cvikov hodnotí 3 (5) – členný rozhodcovský zbor 10 – bodovou stupnicou",
        "Prevedenie predpísanej zostavy cvikov, hodnotí 3 (6) – členný rozhodcovský zbor 50 – bodovou stupnicou",
        "Prevedenie ľubovoľných cvikov, hodnotí 3 (5) – členný rozhodcovský zbor 10 – bodovou stupnicou",
        "Predvedenie predpísaných skokov, hodnotí 3 (6) – členný rozhodcovský zbor 50 – bodovou stupnicou"],
        correctAnswer: 0
        },
        {
        question:"Aké sú výšky prekážok v klasických skokových súťažiach? ",
        choices:[
        "<b>ZM</b>–50 cm, <b>Z</b>–70 cm, <b>ZL</b>–90 cm, <b>L</b>–100 cm, <b>S</b>–110 cm, <b>ST</b>–120 cm, <b>T</b>–150 cm, <b>TT</b>–220 cm",
        "<b>ZM</b>–80 cm, <b>Z</b>–100 cm, <b>ZL</b>–110 cm, <b>L</b>–130 cm, <b>S</b>–140 cm, <b>ST</b>–150 cm, <b>T</b>–160 cm, <b>TT</b>–170 cm",
        "<b>ZM</b>–80 cm, <b>Z</b>–100 cm, <b>ZL</b>–110 cm, <b>L</b>–120 cm, <b>S</b>–130 cm, <b>ST</b>–140 cm, <b>T</b>–150 cm, <b>TT</b>–160 cm",
        "<b>ZM</b>–80 cm, <b>Z</b>–90 cm, <b>ZL</b>–100 cm, <b>L</b>–110 cm, <b>S</b>–120 cm, <b>ST</b>–130 cm, <b>T</b>–140 cm, <b>TT</b>–160 cm"],
        correctAnswer: 2
        },
        {
        question:"Aký je význam veterinárnej kontroly na vytrvalostných súťažiach?",
        choices:[
        "Zachovanie zdravia koňa",
        "Žiadny",
        "Veterinárna kontrola na vytrvalostných súťažiach nemá vplyv na zachovanie zdravia koňa",
        "Zachovanie zdravia jazdca"],
        correctAnswer: 0
        },
        {
        question:"Aké je rozdelenie disciplín westernového jazdenia?",
        choices:[
        "Drezúra, parkúr (skoky), vytrvalostné preteky, súťaže na prijazdenosť, ovládateľnosť a poslušnosť koňa. Rýchlostne súťaže – barel racing (obiehanie barelov), pole bending (slalom medzi tyčami)",
        "Medzi disciplíny westernového jazdenia patrí výlučne práca s dobytkom – roping (chytanie teľaťa do lasa), team pening (odchyt dobytka v trojici), cutting (oddelenie dobytka od stáda), working cowhorse (dvojdielna súťaž na prijazdenosť kona – reining a práca s dobytkom)",
        "Súťaže na prijazdenosť, ovládateľnosť a poslušnosť koňa – reining (westernová drezúra), western riding, western pleasure, trail. Rýchlostné súťaže – barel racing (obiehanie barelov), pole bending (slalom medzi tyčami) Práca s dobytkom – roping (chytanie teľaťa do lasa), team pening (odchyt dobytka v trojici), cutting (oddelenie dobytka od stáda), working cowhorse (dvojdielna súťaž na prijazdenosť koňa – reining a práca s dobytkom)Posúdenie stavby tela – halter",
        "Dostihy, drezúra, voltížne jazdenie. Rýchlostne súťaže – barel racing (obiehanie barelov), pole bending (slalom medzi tyčami) a práca s dobytkom"],
        correctAnswer: 2
        },
        {
        question:"V akom veku môžu kone štartovať na pretekoch?",
        choices:[
        "Vo veku štyroch rokoch, vo westerne v troch rokoch",
        "Vo veku dvoch rokoch, vo westerne v troch rokoch",
        "Vo veku štyroch rokoch, vo westerne v dvoch rokoch",
        "Vo veku piatich rokoch, vo westerne v štyroch rokoch"],
        correctAnswer: 0
        },
        {
        question:"Aké sú potrebné doklady jazdca a koňa pre štart na pretekoch?",
        choices:[
        "Platná licencia jazdca, pas koňa s neplatnými veterinárnymi vyšetreniami a vakcináciami, platná licencia koňa",
        "Platná licencia jazdca, pas koňa s platnými veterinárnymi vyšetreniami a vakcináciami, platná licencia koňa",
        "Neplatná licencia jazdca, podpis trénera, pas jazdca, platná licencia koňa",
        "Pas trénera, pas jazdca, platná licencia jazdca, potvrdenie jazdca o vakcinácii"],
        correctAnswer: 1
        },
        {
        question:"Zásady prvej pomoci pri úraze jazdca",
        choices:[
        "Prvá pomoc sa poskytuje na záchranu života, na zabránenie zhoršenia stavu a zníženia výskytu komplikácii. Ak je postihnutý v bezvedomí – volať prvú pomoc v časovom rozmedzí 60 –120 minút (nikdy nie skôr), hýbať s ním aby sa mu čo najviac uvoľnili svaly",
        "Volať špecializovanú pomoc a odovzdať postihnutého pracovníkom zdravotníckeho záchranného systému, pri výskyte viacerých poranení u jedného postihnutého treba najskôr riešiť tie, ktoré sú menej závažne (a teda, neohrozujú život jazdca), až potom riešiť tie, ktoré priamo ohrozujú život jazdca",
        "Prvú pomoc netreba poskytnúť ešte pred príchodom záchrannej služby alebo lekára. Medzi život ohrozujúce stavy patria: zlomený členok, zastavenie dýchania a bezvedomie. Ak je jazdec pri vedomí – podľa rozsahu zistených poranení dopraviť jazdca do nemocnice",
        "Ak je postihnutý v bezvedomí – okamžite volať prvú pomoc, zaistiť dýchanie, dať ho do stabilizovanej polohy, nehýbať s ním ak to nie je vyslovene potrebné; ak je jazdec pri vedomí – podľa rozsahu zistených poranení zavolať prvú pomoc prípadne dopraviť jazdca do nemocnice"],
        correctAnswer: 3
        },
        {
        question:"Čo musí obsahovať lekárnička v jazdeckom zariadení?",
        choices:[
        "Základná výbava lekárničky v jazdeckom zariadení musí obsahovať lieky tlmiace bolesť, manikúrové nožničky, pilník, 2 trojrohé šatky, leukoplast, klince, špendlíky a kladivo",
        "Niekoľko rýchloobväzových náplastí, sťahovací obväz, lieky tlmiace bolesť, prostriedok na dezinfekciu rán, obväzové balíčky vo veľkosti malá, stredná a veľká, 2 trojrohé šatky, sterilné obväzové štvorce 10x10 cm, gázový obväz, zatváracie špendlíky, leukoplast, nožnice, jednorazové rukavice, lepiaca páska, návod prvej pomoci, zoznam všetkých dôležitých telefónnych čísiel",
        "Lekárnička v jazdeckom zariadení by nemala obsahovať niekoľko rýchloobväzových náplastí, sťahovací obväz, lieky tlmiace bolesť, prostriedok na dezinfekciu rán, obväzové balíčky vo veľkosti malá, stredná a veľká, 2 trojrohé šatky, sterilné obväzové štvorce 10x10 m, gázový obväz, zatváracie špendlíky, leukoplast, nožnice, jednorazové rukavice, lepiaca páska, návod prvej pomoci, zoznam všetkých dôležitých telefónnych čísiel",
        "V jazdeckom zariadení nie je potrebná lekárnička"],
        correctAnswer: 1
        },
        {
        question:"Aké sú základne chody koňa?",
        choices:[
        "<b>Krok –</b> štvortaktný laterálny pohyb (počujeme 4 údery nasledujúce viac–menej pravidelne za sebou) <br><b>Klus –</b> dvojtaktný, diagonálny pohyb, dĺžka klusového kroku 1,50 – 2,20 m, rýchlosť 210–240m/min <br> <b>Cval –</b> trojtaktný chod, rozlíšený na cval vľavo alebo vpravo, dĺžka cvalového skoku je 3,60 – 3,90 m",
        "<b>Krok –</b> dvojtaktný, diagonálny pohyb (počujeme 4 údery nasledujúce viac–menej pravidelne za sebou) <br><b>Klus –</b> štvortaktný laterálny pohyb, dĺžka klusového kroku 1,50 – 2,10 m, rýchlosť 210–240m/min <br><b>Cval –</b> trojtaktný chod, nerozlišuje sa cval vľavo alebo vpravo, dĺžka cvalového skoku je 3,60 – 3,90 m",
        "<b>Krok –</b> štvortaktný laterálny pohyb (počujeme 4 údery nasledujúce viac–menej pravidelne za sebou) <br><b>Klus –</b> trojtaktný chod, rozlíšený na klus vľavo alebo vpravo, dĺžka klusového kroku je 1,20 – 2,10 m, rýchlosť 210 – 230m/min <br><b>Cval –</b> dvojtaktný, diagonálny pohyb, dĺžka cvalového skoku je 4,50 – 4,90 m",
        "<b>Krok –</b> trojtaktný chod (počujeme 4 údery nasledujúce viac–menej pravidelne za sebou) <br><b>Klus –</b> dvojtaktný, diagonálny pohyb, dĺžka klusového kroku 1,50 – 2,20 m, rýchlosť 210 – 240m/min <br><b>Cval –</b> štvortaktný laterálny pohyb, rozlíšený na cval vľavo alebo vpravo, dĺžka cvalového skoku je 3,60 – 3,90 m"],
        correctAnswer: 0
        },
        {
        question:"Popíš nohosled koňa v základných chodoch",
        choices:[
        "<b>Krok –</b> 4–taktný, nohosled LZ, PP, PZ, LP <br><b>Klus –</b> 2–taktný, nohosled LZ + PP, PZ + LP <br><b>Cval –</b> 3–taktný, nohosled na ľavú ruku PZ, LZ + PP, LP na pravú ruku LZ, LP + PZ, PP",
        "<b>Krok –</b> 4–taktný, nohosled LZ + PP, PZ + LP <br><b>Klus –</b> 2–taktný, nohosled LZ, PP, PZ, LP <br><b>Cval –</b> 3– taktný, nohosled na ľavú ruku PZ, LZ + PP, LP na pravú ruku LZ, LP + PZ, PP",
        "<b>Krok –</b> 4–taktný, nohosled LZ + PP, PZ + LP <br><b>Klus –</b> 3–taktný, nohosled LZ, PP, PZ, LP <br><b>Cval –</b> 2– taktný, nohosled na ľavú ruku LZ, LP + PZ, PP na pravú ruku PZ, LZ + PP, LP",
        "<b>Krok –</b> 2–taktný, nohosled LZ, PP, PZ, LP <br><b>Klus –</b> 4–taktný, nohosled LZ + LP, PZ + PP <br><b>Cval –</b> 3–taktný, nohosled na ľavú ruku LZ + PZ, LP + PP na pravú ruku PZ + LZ, PP + LP"],
        correctAnswer: 0
        },
        {
        question:"Vysvetli pojem chod, ruch a akcia",
        choices:[
        "<b>Chod –</b> druh a rýchlosť striedania končatín <br><b>Ruch –</b> tempo v určitom čase <br><b>Akcia –</b> výška a spôsob dvíhania končatín",
        "<b>Chod –</b> tempo v určitom čase <br><b>Ruch –</b> druh a rýchlosť striedania končatín <br><b>Akcia –</b> výška a spôsob dvíhania končatín",
        "<b>Chod –</b> výška a spôsob dvíhania končatín <br><b>Ruch –</b> druh a rýchlosť striedania končatín <br><b>Akcia –</b> tempo v určitom čase",
        "<b>Chod –</b> druh a rýchlosť striedania končatín <br><b>Ruch –</b> výška a spôsob dvíhania končatín <br><b>Akcia –</b> tempo v určitom čase"],
        correctAnswer: 0
        },
        {
        question:"Čo je to mimochod?",
        choices:[
        "Nie je označovaný aj ako pas, ale je to prejav výrazného laterálne posunu končatín, napr. pravej zadnej a pravej prednej súčasne vzad",
        "Je to prejav výrazného mediálneho posunu končatín, napr. pravej zadnej a pravej prednej súčasne vpred",
        "Je to prejav nevýrazného kolaterálneho posunu končatín, napr. ľavej zadnej a ľavej prednej súčasne vpred",
        "Označovaný aj ako pas, je to prejav výrazného laterálneho posunu končatín, napr. pravej zadnej a pravej prednej súčasne vpred"],
        correctAnswer: 3
        },
        {
        question:"Popíš oblasti tela koňa",
        choices:[
        "Hlava, hriva, šija, hrdlo, hrdelnicová brázda, kohútik, chrbát, bedrá, kríže, chvost, plece, ramenný kĺb, rameno, lakťový kĺb, predlaktie, zápästie, záprstie, sponka a sponkový kĺb, korunka, kopyto, prsia, hrboľ zadnicovej kosti, predpätová riasa, mozolec",
        "Hlava, hriva, šija, hrdlo, pätová brázda, kohútik, chrbát, bedrá, kríže, chvost, plece, rameno, predkolenie, lonový hrboľ, stehno, zápästie, korunkový kĺb",
        "Hlava, hriva, šija, hrdlo, hrdelnicová brázda, kohútik, chrbát, bedrá, kríže, chvost, plece, ramenný kĺb, rameno, lakťový kĺb, predlaktie, zápästie, záprstie, sponka a sponkový kĺb, korunka, kopyto, prsia, rebrová krajina, hruď, podrebrie, mečová krajina, hladová jama, slabina, pupková krajina, lonová krajina, bedrový hrboľ, zadnica, hrboľ stehnovej kosti, stehno, predkolenná riasa, predkolenie, predpätie, pätový kĺb, podpätie, mozolec",
        "Kopyto, prsia, pupková krajina, lonová krajina, hrdelnicový mozolec, mečový jama, hladová krajina, hruď, hlava"],
        correctAnswer: 2
        },
        {
        question:"Popíš základne farby koňa.",
        choices:[
        "<b>Beluš</b> je kôñ, ktorý má srsť po celom tele bielu alebo prevaťne bielu, pričom kožu a kopytá má tmavošedé – pigmentové. Žriebätá Belušov sa liahnu čierne alebo tmavé. Po výmene žriebäcej podsady sa stávajú tmavošedé, medzi tmavými chlpmi im začnú narastať chlpy biele – začínajú vybeľovať. Vybeľovanie srsti trvá u niektorých jedincov dlhšie, u iných kratšie. <b>Ryšiak</b> je kôň s červeno–hrdzavou farbou srsti s odtieňmi od žltočervenej až po čiernu. Hriva, chvost a spodok končatín sú buď rovnakej farby ako srsť, alebo sú svetlejšie až biele, prípadne tmavšie, nikdy nie čierne. Odtiene: žltý, pravý, červený <b>Ryšiak</b>. Na hlave a končatinách majú často biele odznaky. <b>Hnedák</b> má srsť červenohnedej farby, rôznych odtieňov. Hriva, chvost a spodná časť končatín je čierna. Podľa intenzity sfarbenia svetlý, tmavý, pravý a čierny. <b>Vraník</b> má srsť po celom tele čiernu. Koža je tmavošedá. Úplny mechanizmus sa prejavuje aj vo sfarbení kopýt. Vyskytuje sa len v odtieni Vraníkov.",
        "<b>Beluš</b> má srsť po celom tele čiernu. Koža je tmavošedá. Úplny mechanizmus sa prejavuje aj vo sfarbení kopýt. <b>Ryšiak</b> je kôň s červeno–hrdzavou farbou srsti s odtieňmi od žltočervenej až po čiernu. Hriva, chvost a spodok končatín sú buď rovnakej farby ako srsť, alebo sú svetlejšie až biele, prípadne tmavšie, nikdy nie čierne. Odtiene: žltý, pravý, červený <b>Ryšiak</b>. Na hlave a končatinách majú často biele odznaky. <b>Hnedák</b> je kôñ, ktorý má srsť po celom tele bielu alebo prevaťne bielu, pričom kožu a kopytá má tmavošedé – pigmentové. Žriebätá Belušov sa liahnu čierne alebo tmavé. Po výmene žriebäcej podsady sa stávajú tmavošedé, medzi tmavými chlpmi im začnú narastať chlpy biele – začínajú vybeľovať. Vybeľovanie srsti trvá u niektorých jedincov dlhšie, u iných kratšie. <b>Vraník</b> má srsť červenohnedej farby, rôznych odtieňov. Hriva, chvost a spodná časť končatín je čierna. Podľa intenzity sfarbenia svetlý, tmavý, pravý a čierny.",
        "<b>Beluš</b> má srsť po celom tele čiernu. Koža je tmavošedá. Úplny mechanizmus sa prejavuje aj vo sfarbení kopýt. <b>Ryšiak</b> má srsť červenohnedej farby, rôznych odtieňov. Hriva, chvost a spodná časť končatín je čierna. Podľa intenzity sfarbenia svetlý, tmavý, pravý a čierny. <b>Hnedák</b> je kôň, ktorý má srsť po celom tele bielu alebo prevaťne bielu, pričom kožu a kopytá má tmavošedé – pigmentové. Žriebätá Belušov sa liahnu čierne alebo tmavé. Po výmene žriebäcej podsady sa stávajú tmavošedé, medzi tmavými chlpmi im začnú narastať chlpy biele – začínajú vybeľovať. Vybeľovanie srsti trvá u niektorých jedincov dlhšie, u iných kratšie. <b>Vraník</b> je kôň s červeno–hrdzavou farbou srsti s odtieňmi od žltočervenej až po čiernu.",
        "<b>Beluš</b> je kôň s červeno–hrdzavou farbou srsti s odtieňmi od žltočervenej až po čiernu. <b>Ryšiak</b> – hriva, chvost a spodok končatín sú buď rovnakej farby ako srsť, alebo sú svetlejšie až biele, prípadne tmavšie, nikdy nie čierne. Odtiene: žltý, pravý, červený <b>Ryšiak</b>. Na hlave a končatinách majú často biele odznaky. <b>Hnedák</b> má srsť červenohnedej farby, rôznych odtieňov. Hriva, chvost a spodná časť končatín je čierna. Podľa intenzity sfarbenia svetlý, tmavý, pravý a čierny. <b>Vraník</b> má srsť po celom tele čiernu. Koža je tmavošedá. Úplny mechanizmus sa prejavuje aj vo sfarbení kopýt."],
        correctAnswer: 0
        },
        {
        question:"Aké sú získane odznaky koní?",
        choices:[
        "Odchýlka od základného sfarbenia, výpaly, rany, jazvy",
        "Tetovanie, odreniny, jazvy",
        "Vrodené abnormality chrupu, rany, jazvy",
        "Výpaly, rany, jazvy"],
        correctAnswer: 3
        },
        {
        question:"Aké sú vrodené odznaky koní?",
        choices:[
        "K vrodeným odznakom patria predovšetkým výpaly, rany, a jazvy",
        "K vrodeným odznakom patria všetky odchýlky od základného sfarbenia. Ide o iné sfarbenie určitej časti tela, odznaky vzniknuté depigmentáciou na niektorej časti tela (parciálny albinizmus), zvlášť na hlave a končatinách. Ďalej sú to vrodené abnormality chrupu, tvar a poloha chlpových vírov. K odchýlkam od typického sfarbenia patrí aj prekvitnutosť a škvrnitosť.",
        "K vrodeným odznakom patria všetky odchýlky od základného sfarbenia. Ide o iné sfarbenie určitej časti tela, odznaky vzniknuté depigmentáciou na niektorej časti tela. Ďalej sú to vrodené abnormality hlavy, šije, ucha a ramenného kĺbu. K odchýlkam od typického sfarbenia nepatrí škvrnitosť",
        "K vrodeným odznakom nepatria všetky odchýlky od základného sfarbenia. Ide o iné sfarbenie určitej časti tela, odznaky vzniknuté depigmentáciou na niektorej časti tela (parciálny albinizmus), zvlášť na hlave a končatinách. Ďalej sú to vrodené abnormality chrupu, tvar a poloha chlpových vírov."],
        correctAnswer: 1
        },
        {
        question:"Popíš zásady správneho kŕmenia a napájania koní (základne krmivá, spotreba vody, ... )",
        choices:[
        "Kone kŕmime v ľubovoľný čas počas dňa, denná kŕmna dávka nie je rozdelená. Voda musí byť zdravotne nezávadná, čistá so zápachom. Základné krmivá: granule určené špeciálne pre kone, mrkva a obilniny. Krmivo nesmie byť namrznuté.",
        "Kone kŕmime cez deň v presne stanovený čas, denná kŕmna dávka je rozdelená: na 50% ráno, 50% večer. Voda musí byť podávaná raz do týždňa. Základné krmivá: seno, cibuľa, slama",
        "Kone kŕmime cez deň v ľubovoľný čas, pričom denná kŕmna dávka je rozdelená: na 25% ráno, 25% obed a 50% večer. Voda musí byť zdravotne nezávadná, čistá a bez zápachu, v priemere počítame pre koňa s hmotnosťou 500 kg asi 40 l vody. Spotreba vody vôbec nezáleží od plemena, veku, pracovného zaťaženia ani ročného obdobia. Medzi základne krmivo radíme: seno, chlieb, kŕmna slama, citrón. Krmivo nesmie byť namrznuté, mokré, zaplesnené, zaparené či stuchnuté.",
        "Kone kŕmime cez deň v presne stanovený čas, denná kŕmna dávka je rozdelená: na 25% ráno, 25% obed a 50% večer. Voda musí byť zdravotne nezávadná, čistá bez zápachu, najlepšie v adlibitnom množstve, v priemere počítame pre koňa s hmotnosťou 500 kg asi 40 l vody. Spotreba vody závisí od plemena, veku, pracovného zaťaženia, ročného obdobia, u kobýl od laktácie. Základné krmivá: seno, lúčne, ovos, kŕmna slama, kŕmna repa, mrkva. Krmivo nesmie byť namrznuté, zaplesnené, zaparené či stuchnuté."],
        correctAnswer: 3
        },
        {
        question:"Aká je telesná teplota koňa?",
        choices:[
        "38,5 °C",
        "37,5 °C",
        "39 °C ",
        "35,5 °C"],
        correctAnswer: 0
        },
        {
        question:"Zásady bezpečnosti práce pri ošetrovaní koní a prístup ku koňom",
        choices:[
        "Predtým ako pristúpime ku koňovi musíme vždy pískaním ohlásiť svoj príchod. Ku koňovi vždy pristupujeme z pravej strany.",
        "Pred vstupom do stajne koňa musíme vždy ohlásiť hlasným kričaním, predídeme tým možnosti zľaknutia a tým možnej neželanej reakcie. Ku koňovi pristupujeme vždy z pravej strany a bez zbytočných rýchlych pohybov, ktoré by koňa mohli vystrašiť.",
        "Predtým ako pristúpime ku koňovi musíme ho vždy ohlásiť, predídeme tým možnosti zľaknutia a tým možnej neželanej reakcie. Ku koňovi pristupujeme vždy z ľavej strany a bez zbytočných rýchlych pohybov, ktoré by koňa mohli vystrašiť.",
        "Predtým ako pristúpime ku koňovi nemusíme ho ohlásiť. Pri koňoch sa vždy pohybujeme rýchlymi pohybmi, nakoľko pomalé pohyby by ho mohli vystrašiť"],
        correctAnswer: 2
        },
        {
        question:"Ošetrovanie koní pred a po výcviku",
        choices:[
        "Kone sú čistené česákom, ktorým sa srsť po celom tele oblúkovými pohybmi očistí, a mäkkou kefou sa zotrie prach. Keď sa na kefe prach nahromadí, kefa sa otrie o česák, aby sa zbavila prachu. Z hygienického hľadiska je najsprávnejšie očistiť kone mimo stajne, lebo čistením sa veľmi rozvíri prach v stajni. Nozdry, okolie oči, vonkajšie pohlavné ústroje a okolie konečníka očistíme osobitnou mäkkou a čistou handrou. Kone, ktoré sú po práci spotené a znečistené, treba hneď vyčistiť. Spoteného koňa najskôr vysušíme, a to za teplého počasia jeho prevádzaním na slnku, pri nepriaznivom počasí slamenými vechťami. Po osušení ho riadne vyčistíme. Hrivu a chvost čistíme hrebeňom alebo kefou, ale opatrne, po pramienkoch, aby sme nevytŕhali vlásie. Kone sa nemajú čistiť pri kŕmení, aby sa nevyrušovali.",
        "Kone sú čistené česákom, ktorým sa srsť po celom tele trojuholníkovým pohybom očistí, a mäkkou kefou sa zotrie prach. Z hygienického hľadiska je najsprávnejšie očistiť kone v stajni. Kone ktoré sú po práci spotené a znečistené, treba hneď vyčistiť. Spoteného koňa najskôr vysušíme, a to za teplého počasia slamenými vechťami, a za nepriaznivého počasia jeho prevádzaním po stajni. Po osušení ho riadne vyčistíme. Hrivu a chvost čistíme hrebeňom alebo kefou, ale opatrne, po pramienkoch, aby sme nevytŕhali vlásie. Kone sa nemajú čistiť pri kŕmení, aby sa nevyrušovali ",
        "Kone sa čistia česákom, ktorým sa srsť po celom tele oblúkovými pohybmi očistí, a mäkkou kefou sa zotrie prach. Keď sa na kefe prach nahromadí, kefa sa otrie o česák, aby sa zbavila prachu. Z hygienického hľadiska je najsprávnejšie očistiť kone mimo stajne, lebo čistením sa veľmi rozvíri prach v stajni. Nozdry, okolie očí, vonkajšie pohlavné ústroje a okolie konečníka očistíme kefou a česákom. Kone, ktoré sú po práci spotené a znečistené netreba čistiť.  ",
        "Kone sa čistia česákom, ktorým sa srsť po celom tele oblúkovými pohybmi očistí, a mäkkou kefou sa zotrie prach. Keď sa na kefe prach nahromadí, kefa sa otrie o česák, aby sa zbavila prachu. Z hygienického hľadiska je najsprávnejšie očistiť kone mimo stajne, lebo čistením sa veľmi rozvíri prach v stajni. Kone by sa mali čistiť výhradne pri kŕmení."],
        correctAnswer: 0
        },
        {
        question:"Vysvetli význam podkúvania a ošetrovania kopýt",
        choices:[
        "Ošetrovaniu kopýt sa nekladie príliš veľa pozornosti. Kopytá sa znečisťujú a poškodzujú v stajni, pri práci alebo pohybovaní, kde sa často narúša ich kvalita a tvar kopytnej rohoviny. Keď chceme udržať kopyto zdravé, pevné a pružné, nemusíme ho pravidelne čistiť, natierať ani upravovať.",
        "Ošetrovanie kopýt je veľmi dôležité, pomáha k nerušenému rastu žriebät, udržuje dobrý zdravotný stav a pracovnú spôsobilosť dospelých koní. Kopytá sa znečisťujú a poškodzujú v stajni, pri práci alebo pohybovaní, kde sa často narúša ich kvalita a tvar kopytnej rohoviny. Keď chceme udržať kopyto zdravé, pevné a pružné, musíme ho pravidelne čistiť, natierať a upravovať. Úprava kopýt spočíva v pravidelnej korektúre a podkúvaní v intervaloch každých 6 mesiacov.",
        "Ošetrovanie kopýt je veľmi dôležité, pomáha k nerušenému rastu žriebät, udržuje dobrý zdravotný stav a pracovnú spôsobilosť dospelých koní. Kopytá sa znečisťujú a poškodzujú v stajni, pri práci alebo pohybovaní, kde sa často narúša ich kvalita a tvar kopytnej rohoviny. Keď chceme udržať kopyto zdravé, pevné a pružné, musíme ho pravidelne čistiť, natierať a upravovať. Úprava kopýt spočíva v pravidelnej korektúre a podkúvaní v intervaloch každých 6 týždňov.",
        "Ošetrovanie kopýt nie je natoľko dôležité aby udržovalo dobrý zdravotný stav a pracovnú spôsobilosť dospelých koní. Úprava kopýt spočíva v pravidelnej korektúre a podkúvaní v intervaloch každých 7 týždňov."],
        correctAnswer: 2
        },
        {
        question:"Aká je dĺžka žrebnosti u kobýl?",
        choices:[
        "302 dní",
        "365 dní",
        "231 dní",
        "333 dní"],
        correctAnswer: 3
        },
        {
        question:"V akom veku sa odstavuje žriebä od matky?",
        choices:[
        "5 – 6 mesiacov",
        "10 – 12 mesiacov",
        "7 – 8 mesiacov",
        "4 mesiace"],
        correctAnswer: 0
        },
        {
        question:"Aké sú zásady správneho odchovu mladých koní?",
        choices:[
        "Státie v boxe 24/7, seno, ošetrovanie veterinárom raz za 3 roky",
        "Občasný pohyb na pasienku, strava – seno, ošetrenie iba v prípade potreby",
        "Dostatočný pohyb na pasienku, kvalitná výživa, dôkladné ošetrovanie",
        "Pestrá a kvalitná výživa, nedostatočný pohyb na pasienku a dôkladné ošetrovanie"],
        correctAnswer: 2
        },
        {
        question:"Aké sú zlozvyky koní?",
        choices:[
        "Tkalcovanie (hodinárčenie), klkanie (prehĺtanie vzduchu), hryzenie",
        "Zhadzovanie jazdca, hryzenie",
        "Utekanie, neposlušnosť, žranie trávy počas tréningu",
        "Tkalcovanie (hodinárčenie), klkanie (prehĺtanie vzduchu) a lenivosť"],
        correctAnswer: 0
        },
        {
        question:"Popíš uzdičku a uzdu",
        choices:[
        "<b>Uzdička</b> – sa používa pri vyšších stupňoch drezúrneho jazdenia. Tvorí ju: nátylník, čelenka, lícnice, podhrdelník, nánosník, dve zubadlá (z toho jedno pákové a druhé lomené) <br><b>Uzda</b> –  je vhodná pre základný výcvik, športové a rekreačné jazdenie. Skladá sa z nátylníka, čelenky, dvoch lícnic, podhrdelníka, nánosníka, zubadla a oťaží",
        "<b>Uzdička</b> – používa sa pri vyšších stupňoch drezúrneho jazdenia. Skladá sa z nátylníka, čelenky, troch lícnic, podhrdelníka, nánosníka, zubadla a oťaží <br><b>Uzda</b>–  je vhodná pre základný výcvik, športové a rekreačné jazdenie. Skladá sa z nátylníka, čelenky, lícnice, podhrdelníka, nánosníka, a dvoch zubadiel.",
        "<b>Uzdička</b> – je vhodná pre základný výcvik, športové a rekreačné jazdenie. Skladá sa z nátylníka, čelenky, dvoch lícnic, podhrdelníka, nánosníka, zubadla a oťaží. <br><b>Uzda</b> – sa používa pri vyšších stupňoch drezúrneho jazdenia. Tvorí ju: nátylník, čelenka, lícnice, podhrdelník, nánosník, dve zubadlá (z toho jedno pákové a druhé lomené) a oťaže.",
        "<b>Uzdička</b> – nie je vhodná pre základný výcvik, športové ani rekreačné jazdenie <br><b>Uzda</b> –  používa sa pri vyšších stupňoch drezúrneho jazdenia. Tvorí ju: nátylník, čelenka, lícnice, podhrdelník, nánosník a zubadlo"],
        correctAnswer: 2
        },
        {
        question:"Popíš anglické sedlo a jeho doplnky",
        choices:[
        "Základné zloženie anglického sedla – kostra sedla, predná rázsocha, posedlie, zadná rázsocha, sedlový vankúš, veľké stranice, malé stranice, remene na podbrušník, strmeňový zámok, strmeňový remeň, masívny strmeň, spodné stranice, kolenná opierka, podbrušník s prackami, sedlová hruška nachádzajúcu sa na prednej rászoche",
        "Jazdecké sedlo musí vyhovovať jeho športovému využitiu, tzn. musí byť prispôsobené konkrétnemu druhu jazdeckého športu. Základné zloženie anglického sedla – kostra sedla, predná rázsocha, posedlie, zadná rázsocha, sedlový vankúš, veľké stranice, malé stranice, remene na podbrušník, strmeňový zámok, strmeňový remeň, strmeň, spodné stranice, kolenná opierka, podbrušník s prackami",
        "Anglické sedlo sa neskladá z kostry sedla, prednej rázsochy, posedlia, zadnej rázsochy, sedlového vankúša, veľkej stranice, malej stranice, remena na podbrušníku, strmeňového zámku, strmeňového remeňa, strmeňa, spodnej stranice, kolennej opierky, podbrušníka s prackami",
        "Jazdecké sedlo musí vyhovovať jeho športovému využitiu, tzn. musí byť prispôsobené konkrétnemu druhu jazdeckého športu. Anglické sedlo váži okolo 15 – 20 kg. Základné zloženie anglického sedla – kostra sedla , predná/zadná rázsocha a posedlie"],
        correctAnswer: 1
        },
        {
        question:"Čo je to martingal a k čomu slúži?",
        choices:[
        "Je jednou z pomocných oťaží. Poznáme krúžkový a pevný martingal, v praxi sa najčastejšie používa krúžkový. Používa sa pri koňoch ktorý majú zlozvyk hrýzť",
        "Nie je jednou z pomocných oťaží. Poznáme krúžkový a pevný martingal, v praxi sa najčastejšie využíva krúžkový. Je to pomôcka používaná pri koňoch, ktoré majú zlozvyk dávať hlavu dole, po nastavení pevného priľnutia oťaže ťahajú hubu koňa cez martingal smerom hore.",
        "Je jednou z pomocných oťaží. Poznáme krúžkový a pevný martingal, v praxi sa najčastejšie využíva krúžkový. Martingal je pomôcka používaná pri koňoch, ktoré majú zlozvyk dvíhať hlavu hore, po nastavení pevného priľnutia oťaže ťahajú hubu koňa cez martingal dolu.",
        "Je jednou z pomocných oťaží. Poznáme krúžkový a pevný martingal, v praxi sa najčastejšie využíva pevný. Martingal je pomôcka používaná pri dobytku."],
        correctAnswer: 2
        },
        {
        question:"Aké poznáš pomocné oťaže a aká je ich funkcia?",
        choices:[
        "Jednoduché vyväzovacie oťaže, trojuholníkové oťaže, dvojité vyväzovacie oťaže, krúžkový martingal, pevný martingal, prievlečné oťaže. Funkcia pomocných oťaží nespočíva v uľahčení práce pri výcviku koní.",
        "Jednoduché vyväzovacie oťaže, trojuholníkové oťaže, dvojité vyväzovacie oťaže, krúžkový martingal, pevný martingal, prievlečné oťaže. Funkcia pomocných oťaží spočíva v uľahčení práce pri výcviku koní, používaju sa pri uvoľnovaní koňa pred prácou, ďalej pri výcviku začiatočníkov – správne pripnuté pomocné oťaže nútia koňa skloniť hlavu, krk a tým vyklenúť chrbát",
        "Jednoduché vyväzovacie oťaže, štvoruholníkove oťaže a krúžkový martingal.",
        "Jednoduché vyväzovacie oťaže, trojuholníkové oťaže, dvojité vyväzovacie oťaže, krúžkový martingal, pevný martingal, prievlečné oťaže. Funkcia pomocných oťaží je dôležitá pri výcviku začiatočníkov – nesprávne pripnuté pomocné oťaže nútia koňa skloniť hlavu, krk a tým vyklenúť chrbát."],
        correctAnswer: 1
        },
        {
        question:"Akú funkciu má vonkajšia oťaž pri vedení koňa?",
        choices:[
        "Vonkajšia oťaž má dôležitú funkciu pri postavení koňa k ruke a pri jeho ohnutí. Postavenie k ruke znamená, že kôň neohne hlavu do strany. U uvoľneného koňa sa hrebeň krku ťažko nakloní na tú stranu, ku ktorej ho pristavujeme. Postavenie koňa k ruke zvyšuje jeho poslušnosť na oťaž. Kôň sa dostáva z vnútorných pomôcok na vonkajšie",
        "Vonkajšia oťaž nezohráva dôležitú úlohu pri vedení koňa, jeho postavení k ruke, ani pri jeho ohnutí.",
        "Vonkajšia oťaž má dôležitú funkciu pri postavení koňa k ruke a pri jeho ohnutí, pričom ale nemusí byť napnutá. Postavenie k ruke ale neznamená, že kôň ohne hlavu do strany",
        "Vonkajšia oťaž má dôležitú funkciu pri postavení koňa k ruke a pri jeho ohnutí. Postavenie k ruke znamená, že kôň ohne hlavu do strany. U uvoľneného koňa sa hrebeň krku ľahko nakloní na tú stranu, ku ktorej ho pristavujeme. Postavenie koňa k ruke zvyšuje jeho poslušnosť na oťaž. Kôň sa dostáva z vnútorných pomôcok na vonkajšie"],
        correctAnswer: 3
        },
        {
        question:"Vymenuj a popíš funkciu ochranných pomôcok pre koňa vo výcviku a na súťaži. ",
        choices:[
        "Chrániče predných a zadných nôh – zabraňujú poraneniu nohy koňa <br>Hrudný chránič na podbrušníku – zabraňuje poraneniu hrudníka u koní ktoré si nad skokom krčením nôh narážajú kopytami do hrudníka",
        "Chrániče predných a zadných nôh – nezabraňujú poraneniu nohy koňa  <br>Hrudný chránič na podbrušníku – zabraňuje poraneniu hrudníka u koní ktoré si nad skokom krčením nôh narážajú kopytami do hrudníka",
        "Chrániče predných a zadných nôh – zabraňujú poraneniu nohy koňa <br>Hrudný chránič na podbrušníku – neplnia žiadnu významnú úlohu pri jazdení",
        "Chrániče predných a zadných nôh – pri tréningu zabraňujú poraneniu nohy koňa <br>Hrudný chránič na podbrušníku – pri tréningu nie je dôležitý nakoľko nezabraňujú poraneniu hrudníka u koní "],
        correctAnswer: 0
        },
        {
        question:"Popíš oblečenia a výstroj jazdca pri tréningu",
        choices:[
        "Oblečenie jazdca v tréningu je závislé od jazdeckej disciplíny, ktorej sa venuje. Výstroj jazdca je: cilinder (pri skoku) jazdecké nohavice (rajtky), jazdecké čižmy alebo holenné chrániče – tzv. chapsy. Celkovo oblečenie musí byť pevné, elastické a musí umožňovať maximálny možný komfort jazdcovi pri výcviku koňa",
        "Oblečenie jazdca musí zodpovedať jazdeckej disciplíne ktorej sa venuje a počasiu. Jazdec počas tréningu musí mať frak a voľné rifle pre lepšiu hybnosť v sedle. Celkovo oblečenie musí byť pevné, elastické a musí umožňovať maximálny možný komfort jazdcovi pri výcviku koňa",
        "Oblečenie jazdca v tréningu je závislé od jazdeckej disciplíny, ktorej sa venuje. Výstroj jazdca je: – jazdecká prilba (pri skoku), jazdecké nohavice (rajtky), jazdecké čižmy alebo kožené holenné chrániče – tzv. chapsy alebo legíny, rukavice, jazdecká vesta. Celkovo oblečenie musí byť pevné, elastické a musí umožňovať maximálny možný komfort jazdcovi pri výcviku koňa",
        "Oblečenie jazdca v tréningu nie je závislé od jazdeckej disciplíny, ktorej sa venuje. Výstroj jazdca je: rifle, jazdecké čižmy, alebo kožené holenné chrániče – tzv. chapsy alebo legíny, rukavice, jazdecká vesta/korytnačka, jazdecká bunda. Celkovo oblečenie nemusí byť pevné, elastické."],
        correctAnswer: 2
        },
        {
        question:"Popíš oblečenie a výstroj jazdca v súťažiach.",
        choices:[
        "<b>Parkúr</b> – klobúk, jazdecká košeľa, biele rajtky, jazdecké čižmy (najčastejšie čierne) <br><b>Drezúra</b> – frak, cylinder, jazdecká vesta, čierne rajtky",
        "<b>Parkúr</b> – jazdecké sako, jazdecká košeľa, kravata, biele rajtky, jazdecké čižmy (najčastejšie čierne), jazdecká prilba <br><b>Drezúra –</b> frak, cylinder, biele rajtky, biele rukavice, jazdecké čižmy",
        "<b>Parkúr</b> – frak, cylinder, biele rajtky, biele rukavice, jazdecké čižmy <br><b>Drezúra –</b> jazdecké sako, jazdecká košeľa, kravata, biele rajtky, jazdecké čižmy (najčastejšie biele), jazdecká prilba",
        "<b>Parkúr</b> – jazdecké sako, cylinder, biele rajtky, kravata <br><b>Drezúra –</b> jazdecká prilba, frak, čierne rukavice, jazdecké chapsy a čižmy"],
        correctAnswer: 1
        },
        {
        question:"Popíš správny sed jazdca.",
        choices:[
        "Jazdec sedí v najhlbšom mieste sedla, vyrovnaný a s uvoľnenými svalmi, hlavu má držať prirodzene, päsť, koleno a špička tvoria kolmicu, zátylie, ramená, bedro a päta tvoria druhú kolmicu, päta je najnižší bod jazdca na koni, strmene sú našliapnuté na najširšom mieste chodidla",
        "Jazdec sedí v najhlbšom mieste sedla, s miernym predklonom dopredu, hlavu drží prirodzene, päta a koleno tvoria kolmicu, špička, bedrá a ramená tvoria druhú kolmicu, strmene sú našliapnuté v najširšom mieste chodidla",
        "Jazdec má vzpriamenú hlavu s pohľadom dole, trup v záklone, päty prešliapnuté, špička odklonená od koňa, zátylie, ramená, bedro a päta tvoria kolmicu, päty prešliapnuté",
        "Jazdec sedí v najhlbšom mieste sedla, s ramenami vpredu a s lakťami od tela, holene má posunuté dopredu, päta je najnižší bod jazdca na koni, strmene sú našliapnuté na najširšom mieste chodidla"],
        correctAnswer: 0
        },
        {
        question:"Vymenuj základné pomôcky, ktorými pôsobí jazdec na koňa.",
        choices:[
        "Nohy, šporne, oťaže, hlas",
        "Stehná, bičík, holeň, oťaže",
        "Sed, holeň, oťaže, bičík",
        "Sed, holeň, otaže, zubadlo"],
        correctAnswer: 2
        },
        {
        question:"Vysvetli pojem ,Polovičná zádrž,” ,,<b>Celá zádrž</b>”",
        choices:[
        "<b>Polovičná zádrž</b> je zádrž, ktorá vedie k úplnému zastaveniu koňa. Celú zádrž môžeme dať z akéhokoľvek chodu, avšak iba na rovných líniách. Koňa na ňu pripravím jednou alebo viacerými polovičnými zádržami. Pomôcky používame rovnaké ako pri polovičnej zádrži, a to tak, že pobádame koňa sedom a holeňami do vydržujúcej ruky až do úplneho zastavenia<br><b>Celá zádrž</b> je súhra všetkých pomôcok, umožňujúcich kontrolované jazdenie. Dáva sa krátkym, zvýšeným zovretím koňa medzi pomôckami sedu, holeňami a oťažami, po ktorých najsleduje povoľujúca pomôcka. Zosilneným pobádaním pri polovičnej zádrži dostane kôň silnejší impulz dopredu. Tým začne viac pristupovať do ruky. Dobre prijazdený kôň si pritom akoby sám berie pomôcku oťaže a primerane priestupne vykračuje pod ťažisko. Polovičné zádrže sa používajú aby sme: <br>–urobili prechod z jedného chodu do druhého<br>–skrátili alebo regulovali krok koňa v jednom chode<br>–uporoznili koňa na nový cvik alebo úlohu<br>–zlepšili alebo udržali zhromaždenie a držanie tela koňa pri pohybe",
        "<b>Polovičná zádrž</b> je súhra všetkých pomôcok, umožňujúcich kontrolované jazdenie. Dáva sa z akéhokoľvek chodu, avšak iba na rovných líniách. Koňa na ňu pripravím jednou alebo viacerými polovičnými zádržami<br><b>Celá zádrž</b>  je zádrž, ktorá vedie k úplnému zastaveniu koňa. Dáva sa krátkym, zvýšeným zovretím koňa medzi pomôckami sedu, holeňami a oťažami, po ktorých nasleduje uvoľnujúca pomôcka. Zosilneným pobádaním pri polovičnej zádrži dostane kôň silnejší impulz dopredu. Tým začne viac pristupovať do ruky. Dobre prijazdený kôň si pritom akoby sám berie pomôcku oťaže a primerane priestupne vykračuje pod ťažisko. Polovičné zádrže sa používajú aby sme: <br>–urobili prechod z jedného chodu do druhého<br>–skrátili alebo regulovali krok koňa v jednom chode<br>–uporoznili koňa na nový cvik alebo úlohu<br>–zlepšili alebo udržali zhromaždenie a držanie tela koňa pri pohybe",
        "<b>Polovičná zádrž</b> je súhra všetkých pomôcok, umožňujúcich kontrolované jazdenie. Dáva sa krátkym, zvýšeným zovretím koňa medzi pomôckami sedu, holeňami a oťažami, po ktorých najsleduje povoľujúca pomôcka. Zosilneným pobádaním pri polovičnej zádrži dostane kôň silnejší impulz dopredu. Tým začne viac pristupovať do ruky. Dobre prijazdený kôň si pritom akoby sám berie pomôcku oťaže a primerane priestupne vykračuje pod ťažisko. Polovičné zádrže sa používajú aby sme:<br>–urobili prechod z jedného chodu do druhého<br>–skrátili alebo regulovali krok koňa v jednom chode<br>–upozornili koňa na nový cvik alebo úlohu<br>–zlepšili alebo udržali zhromaždenie a držanie tela koňa pri pohybe<br><b>Celá zádrž</b> je zádrž, ktorá vedie k úplnému zastaveniu koňa. Celú zádrž môžeme dať z akéhokoľvek chodu, avšak iba na rovných líniách. Koňa na ňu pripravím jednou alebo viacerými polovičnými zádržami. Pomôcky používame rovnaké ako pri polovičnej zádrži, a to tak, že pobádame koňa sedom a holeňami do vydržujúcej ruky až do úplneho zastavenia",
        "<b>Polovičná zádrž</b> je súhra všetkých pomôcok, umožňujúcich kontrolované jazdenie. Dáva sa dlhým, zvýšeným zovretím koňa medzi pomôckami sedu, holeňami a oťažami, po ktorých najsleduje povoľujúca pomôcka. Zosilneným pobádaním pri polovičnej zádrži dostane kôň silnejší impulz dopredu. Tým začne viac pristupovať do ruky. Dobre prijazdený kôň si pritom akoby sám berie pomôcku oťaže a primerane priestupne vykračuje pod ťažisko. <br><b>Celá zádrž</b> je zádrž, ktorá nevedie k úplnému zastaveniu koňa. Celú zádrž môžeme dať iba z cvalu, na rovných líniách. Koňa na ňu pripravím jednou alebo viacerými polovičnými zádržami. Pomôcky používame rovnaké ako pri polovičnej zádrži, a to tak, že pobádame koňa sedom a holeňami do vydržujúcej ruky až do úplneho zastavenia"],
        correctAnswer: 2
        },
        {
        question:"Popíš veľký kruh. Aký má priemer?",
        choices:[
        "Veľký kruh začína a končí v ľavom rohu jazdiarne a má priemer 20 m",
        "Veľký kruh nezačína v strede krátkej steny jazdiarne a nemá priemer 20 m",
        "Veľký kruh sa nachádza výhradne v pravom rohu jazdiarne s priemerom 15 m",
        "Veľký kruh začína a končí v strede krátkej steny jazdiarne a má priemer 20 m"],
        correctAnswer: 3
        },
        {
        question:"Aká je vzdialenosť kavaliet (pre krok, klus, cval).",
        choices:[
        "<b>Krok</b>: 1 – 1.1 m, <b>Klus</b>: 1.3 m, <b>Cval</b>: 3 – 3.5m",
        "<b>Krok</b>: 1.5 m, <b>Klus</b>: 2.3 m, <b>Cval</b>: 3m",
        "<b>Krok</b>: 1m, <b>Klus</b>: 1.3 m, <b>Cval</b>: 4m",
        "<b>Krok</b>: 1 – 1.1 m, <b>Klus</b>: 1.2 m, <b>Cval</b>: 3 – 3.3m"],
        correctAnswer: 0
        },
        {
        question:"Základné zásady prepravy koní – dopravné prostriedky, výstroj koňa.",
        choices:[
        "Ako dopravné prostriedky sa používajú špeciálne upravené nákladné autá, prípadne kamióny. Ďalej sa používajú prívesné vozíky za osobné automobily špeciálne určené na prepravu koní, ktoré sa vyrábajú pre 1 – 4 kone. Výstroj koňa na prepravu je zložená zo špeciálnych prepravných chráničov, ktoré chránia nohy koňa pred poranením počas prepravy, v prípade potreby sa používajú chrániče na chvost, používajú sa u koní, ktoré sa počas prepravy opierajú chvostom o zadnú stenu dopravného prostriedku. V prípade nepriaznivého počasia deka",
        "Na prepravu koní sa používajú osobné automobily, prípadne lietadlá. Výstroj koňa na prepravu je zložená zo špeciálnych prepravných chráničov, ktoré chránia hlavu koňa pred poranením počas prepravy, v prípade potreby sa používajú chrániče na chvost, používajú sa u koní, ktoré sa počas prepravy opierajú chvostom o zadnú stenu dopravného prostriedku.  ",
        "Ako dopravné prostriedky sa nepoužívajú špeciálne upravené nákladné autá, prípadne kamióny. Používajú sa prívesné vozíky za osobné automobily špeciálne určené na prepravu koní, ktoré sa vyrábajú pre 5 – 10 koní. Výstroj koňa na prepravu je zložená zo špeciálnych prepravných chráničov, ktorí chránia nohy koňa pred poranením počas prepravy, v prípade potreby sa používajú chrániče na chvost, používajú sa u koní, ktoré sa počas prepravy opierajú chvostom o zadnú stenu dopravného prostriedku. V prípade nepriaznivého počasia kone nesmú cestovať",
        "Na prepravu koní sa používajú špeciálne upravené nákladné autá, prívesné vozíky za osobné automobily, špeciálne určené na prepravu koní. Výstroj koňa na prepravu je zložená z prepravných popruhov, uzdy a chráničov na uši. V prípade nepriaznivého počasie deka."],
        correctAnswer: 0
        },
        {
        question:"Aké sú základné zásady jazdenia na jazdiarni?",
        choices:[
        "Vyšší ruch má na jazdiarni prednosť, stretávajú sa ľavé ruky",
        "Nižší ruch má na jazdiarni prednosť, stretávajú sa ľavé ruky",
        "Vyšší ruch má na jazdiarni prednosť, stretávajú sa pravé ruky",
        "Nižší ruch má na jazdiarni prednosť, stretávajú sa pravé ruky"],
        correctAnswer: 0
        },
        {
        question:"Aké sú základné jazdecké disciplíny?",
        choices:[
        "Drezúra, mushing, skok, drezúra, všestranná spôsobilosť, western",
        "Skok, drezúra, všestranná spôsobilosť (military), vytrvalosť, voltíž, záprahy, western",
        "Agility, drezúra, western, voltíž, všestranná spôsobilosť (military)",
        "Horsedancing, všestranná spôsobilosť (military), vytrvalosť, voltíž"],
        correctAnswer: 1
        }
        ];
    
    var questionCounter = 0; //Tracks question number
    var selections = []; //Array containing user choices
    var quiz = $('#quiz'); //Quiz div object
    shuffle(questions);  
    // Display initial question
    displayNext();
    
    // Click handler for the 'next' button
    $('#next').on('click', function (e) {
      e.preventDefault();
      
      // Suspend click listener during fade animation
      if(quiz.is(':animated')) {        
        return false;
      }
      choose();
      
      // If no user selection, progress is stopped
      if (isNaN(selections[questionCounter])) {
        warningAnimation('Vyberte jednu možnosť!');
      } else {
        questionCounter++;
        displayNext();
      }
    });
    
    // Click handler for the 'prev' button
    $('#prev').on('click', function (e) {
      e.preventDefault();
      
      if(quiz.is(':animated')) {
        return false;
      }
      choose();
      questionCounter--;
      displayNext();
    });
    
    // Click handler for the 'Start Over' button
    $('#start').on('click', function (e) {
      shuffle(questions); //shuffle questions
      e.preventDefault();
      
      if(quiz.is(':animated')) {
        return false;
      }
      questionCounter = 0;
      selections = [];
      displayNext();
      $('#start').hide();
    });
    
    // Animates buttons on hover
    $('.button').on('mouseenter', function () {
      $(this).addClass('active');
    });
    $('.button').on('mouseleave', function () {
      $(this).removeClass('active');
    });
    
    // Creates and returns the div that contains the questions and 
    // the answer selections
    function createQuestionElement(index) {
      var qElement = $('<div>', {
        id: 'question'
      });
      
      var header = $('<h2>Otázka ' + (index + 1) + ' z '+questions.length+':</h2>');
      qElement.append(header);
      
      var question = $('<p class="questionTitle">').append(questions[index].question);
      qElement.append(question);
      
      var radioButtons = createRadios(index);
      qElement.append(radioButtons);
      
      return qElement;
    }
    
    // Creates a list of the answer choices as radio inputs
    function createRadios(index) {
      var radioList = $('<ul>');
      var item;
      var input = '';
      for (var i = 0; i < questions[index].choices.length; i++) {
        item = $('<li>');
        input = '<label><input type="radio" name="answer" value=' + i + ' />';
        input += '<div class="questionOption">' + questions[index].choices[i] + '</div></label>';
        item.append(input);
        radioList.append(item);
      }
      return radioList;
    }
    
    // Reads the user selection and pushes the value to an array
    function choose() {
      selections[questionCounter] = +$('input[name="answer"]:checked').val();
    }
    
    // Displays next requested element
    function displayNext() {
      
      quiz.fadeOut(function() {
        $('#question').remove();
        
        if(questionCounter < questions.length){
          var nextQuestion = createQuestionElement(questionCounter);
          quiz.append(nextQuestion).fadeIn();
          if (!(isNaN(selections[questionCounter]))) {
            $('input[value='+selections[questionCounter]+']').prop('checked', true);
          }
          
          // Controls display of 'prev' button
          if(questionCounter === 1){
            $('#prev').show();
          } else if(questionCounter === 0){
            
            $('#prev').hide();
            $('#next').show();
          }
        }else {
          var scoreElem = displayScore();
          quiz.append(scoreElem).fadeIn();
          $('#next').hide();
          $('#prev').hide();
          $('#start').show();
        }
      });
    }
    
    // Computes score and returns a paragraph element to be displayed
    function displayScore() {
      var score = $('<p>',{id: 'question'});
      
      var numCorrect = 0;
      for (var i = 0; i < selections.length; i++) {
        if (selections[i] === questions[i].correctAnswer) {
          numCorrect++;
        }
      }
      
      score.append('<h4>Dosiahli ste ' + numCorrect + ' správnych odpovedí z ' +
                   questions.length + '</h4>');
      return score;
    }

    function shuffle(a) {
        var j, x, i;
        for (i = a.length - 1; i > 0; i--) {
            j = Math.floor(Math.random() * (i + 1));
            x = a[i];
            a[i] = a[j];
            a[j] = x;
        }
        return a;
    }
  })();