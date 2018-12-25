<?php
/**
 *
 * This file is part of the phpBB Forum Software package.
 *
 * @author Senky
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * For full copyright and license information, please see
 * the docs/CREDITS.txt file.
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'HELP_FAQ_ATTACHMENTS_ALLOWED_ANSWER'	=> 'Každý administrátor fóra môže povoliť alebo zakázať jednotlivé druhy príloh. Pokiaľ si nie ste istý, ktoré súbory môžu byť nahrávané, kontaktuje administrátora fóra.',
	'HELP_FAQ_ATTACHMENTS_ALLOWED_QUESTION'	=> 'Aké prílohy sú povolené na tomto fóre?',
	'HELP_FAQ_ATTACHMENTS_OWN_ANSWER'	=> 'Pre zobrazenie kompletného zoznamu vami nahraných príloh, prejdite na Užívateľský panel a nasledujte odkazy do časti s prílohami.',
	'HELP_FAQ_ATTACHMENTS_OWN_QUESTION'	=> 'Ako si môžem zobraziť všetky svoje prílohy?',

	'HELP_FAQ_BLOCK_ATTACHMENTS'	=> 'Prílohy',
	'HELP_FAQ_BLOCK_BOOKMARKS'	=> 'Sledovanie tém a záložiek',
	'HELP_FAQ_BLOCK_FORMATTING'	=> 'Formátovanie a typy príspevkov',
	'HELP_FAQ_BLOCK_FRIENDS'	=> 'Priatelia a ignorovaní',
	'HELP_FAQ_BLOCK_GROUPS'	=> 'Užívateľské úrovne a skupiny',
	'HELP_FAQ_BLOCK_ISSUES'	=> 'Záležitosti okolo phpBB',
	'HELP_FAQ_BLOCK_LOGIN'	=> 'Registrácia a prihlásenie',
	'HELP_FAQ_BLOCK_PMS'	=> 'Súkromné správy',
	'HELP_FAQ_BLOCK_POSTING'	=> 'Vkladanie príspevkov',
	'HELP_FAQ_BLOCK_SEARCH'	=> 'Hľadanie na fóre',
	'HELP_FAQ_BLOCK_USERSETTINGS'	=> 'Užívateľské nastavenia',

	'HELP_FAQ_BOOKMARKS_DIFFERENCE_ANSWER'	=> 'Záložkovanie v phpBB3 je veľmi podobné záložkám, ktoré poznáte z vášho prehliadača. Nie ste upozornený, keď príde nový príspevok, ale môžete sa kedykoľvek do témy jednoducho vrátiť. Sledovanie vám ale naopak uľahčí prechádzanie tím, že vás kontaktuje vami vybraným spôsobom.',
	'HELP_FAQ_BOOKMARKS_DIFFERENCE_QUESTION'	=> 'Aký je rozdiel medzi sledovaním a záložkami?',
	'HELP_FAQ_BOOKMARKS_FORUM_ANSWER'	=> 'Pre sledovanie jednotlivého fóra, kliknite po vstupu do neho na odkaz "Sledovať toto fórum". Pre sledovanie témy kliknite na odkaz v ňom alebo pri odosielaní príspevku zvoľte možnosť sledovať túto tému.',
	'HELP_FAQ_BOOKMARKS_FORUM_QUESTION'	=> 'Ako môžem sledovať zvolené fóra?',
	'HELP_FAQ_BOOKMARKS_REMOVE_ANSWER'	=> 'Pre zrušenie sledovania, prejdite v Užívateľskom panely do sekcie Sledovanie.',
	'HELP_FAQ_BOOKMARKS_REMOVE_QUESTION'	=> 'Ako môžem zrušiť sledovanie?',
	'HELP_FAQ_BOOKMARKS_TOPIC_ANSWER'	=> 'Môžete záložkovať alebo sledovať konkrétne témy kliknutím na odkaz v meno “Nástroje témy”, zvyčajne umiestnenom tesne nad a pod témou.<br />Odpovedaním na tému so zaškrtnutou možnosťou “Upozorni ma keď príde odpoveď” tiež nastaví sledovanie na danú tému.',
	'HELP_FAQ_BOOKMARKS_TOPIC_QUESTION'	=> 'Ako môžem záložkovať alebo sledovať konkrétne témy?',

	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_ANSWER'	=> 'Oznámenia často prinášajú dôležité informácie a mali by ste ich prečítať čo najskôr. Oznámenia sa objavujú v hornej časti každej stránky fóra, kde sú uvedené. Či môžete či nemôžete pridávať oznámenia do fóra, záleží na tom, či vám to administrátor umožnil.',
	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_QUESTION'	=> 'Čo sú to Oznámenia?',
	'HELP_FAQ_FORMATTING_BBOCDE_ANSWER'	=> 'BBCode je špeciálna konfigurácia HTML. O jeho použití rozhoduje administrátor (môže to zakázať pre jednotlivé príspevky). BBCode sám o sebe je podobný štýlu HTML, tagy sú uzavreté v hranatých zátvorkách [ a ] a ponúkajú väčšiu kontrolu nad tým, čo a jak sa zobrazí. Pre viac informácií o BBCode si prezrite stránku, ktorá je dostupná cez stránku prispievania.',
	'HELP_FAQ_FORMATTING_BBOCDE_QUESTION'	=> 'Čo je BBCode?',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_ANSWER'	=> 'Globálne oznámenia obsahujú dôležité informácie, ktoré by ste si mali prečítať čo najskôr. Globálne oznámenie sa zobrazujú nad každým fórom a taktiež vo vašom Užívateľskom panely. To, či môžete odosielať globálne oznámenie, záleží na nastavených oprávneniach, ktoré nastavujú administrátori.',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_QUESTION'	=> 'Čo sú to Globálne oznámenia?',
	'HELP_FAQ_FORMATTING_HTML_ANSWER'	=> 'Bohužiaľ nie je možné používať akékoľvek HTML formátovanie na tomto fóre a ani nieje možné túto možnosť zapnúť, administrátor však môže definovať zvláštne BBCode značky, ktoré môžu HTML nahradiť.',
	'HELP_FAQ_FORMATTING_HTML_QUESTION'	=> 'Môžem používať HTML?',
	'HELP_FAQ_FORMATTING_ICONS_ANSWER'	=> 'Ikony tém sú obrázky, ktoré môžu byť spojené s príspevkom pre vyjadrenie jeho obsahu. Ikony môžete používať iba vtedy pokiaľ vám nastavil administrátor príslušné oprávnenie.',
	'HELP_FAQ_FORMATTING_ICONS_QUESTION'	=> 'Čo sú ikony tém?',
	'HELP_FAQ_FORMATTING_IMAGES_ANSWER'	=> 'Obrázky sa môžu zobrazovať vo vašich príspevkoch, keďže v súčasnej dobe neexistuje žiadna funkcia k nahraniu obrázkov priamo na fórum. Z tohto dôvodu musíte zadať na obrázok odkaz, napr. http://www.stránk.xx/obrazok.jpg. Nemôžete vytvárať odkazy na obrázky umiestené vo vlastnom PC (pokiaľ to nie je verejne prístupná stanica). K zobrazeniu obrázku použite buď BBCode [img] tag alebo príslušné HTML (ak je povolené).',
	'HELP_FAQ_FORMATTING_IMAGES_QUESTION'	=> 'Môžem pridávať obrázky?',
	'HELP_FAQ_FORMATTING_LOCKED_ANSWER'	=> 'Témy môžu byť zamknuté moderátorom alebo administrátorom. Nemôžete odpovedať na zamknuté témy ani upravovať svoje príspevky. Každé hlasovanie je automaticky ukončené. Témy môžu byť zamknuté z rôznych dôvodov.',
	'HELP_FAQ_FORMATTING_LOCKED_QUESTION'	=> 'Čo sú to Zamknuté témy?',
	'HELP_FAQ_FORMATTING_SMILIES_ANSWER'	=> 'Smajlíky, alebo emotikony sú malé grafické obrázky, ktoré sa používajú k vyjadreniu emócií použitím malého kódu, napr. :) znamená šťastný, :( znamená smutný. Kompletný zoznam smajlíkov si môžete prezrieť v príspevkovom formulári. Prosím, snažte sa tieto smajlíky nezneužívať, aby sa príspevok nestal nečitateľným. Moderátor môže taktiež prípadne váš príspevok v tomto smere zmeniť.',
	'HELP_FAQ_FORMATTING_SMILIES_QUESTION'	=> 'Čo sú to smajlíky (emotikony)?',
	'HELP_FAQ_FORMATTING_STICKIES_ANSWER'	=> 'Dôležité témy sa objavujú na fóre hneď pod Oznámením, ale iba na prvej stránke. Sú často veľmi dôležité, takže si ich prečítajte tam, kde sú. Rovnako ako pri oznámení rozhoduje administrátor, ktorí užívatelia majú právo pridávať dôležité témy.',
	'HELP_FAQ_FORMATTING_STICKIES_QUESTION'	=> 'Čo sú to dôležité témy?',

	'HELP_FAQ_FRIENDS_BASIC_ANSWER'	=> 'Tieto zoznamy môžete využiť k triedeniu ostatných užívateľov na fóre. Napríklad užívatelia vo vašom zozname priateľov budú zobrazený vo vašom užívateľskom panely so svojím stavom a budete z nich môcť rýchlo vyberať napr. pri písaní súkromných správ. Pokiaľ to umožňuje vzhľad fóra, príspevky od týchto užívateľov budú zvýraznene. Pokiaľ pridáte užívateľov do zoznamu ignorovaných, ich príspevky vám vo východzom stave nebudú zobrazované.',
	'HELP_FAQ_FRIENDS_BASIC_QUESTION'	=> 'Čo je môj zoznam priateľov a ignorovaných?',
	'HELP_FAQ_FRIENDS_MANAGE_ANSWER'	=> 'Môžete pridávať užívateľov dvoma spôsobmi. V profile každého užívateľa je odkaz pre jeho pridanie do jedného z oboch zoznamov. Ďalej môžete použiť svoj užívateľský panel, kde môžete priamo zadať užívateľské mená. Sem taktiež môžete odobrať členov z vašich zoznamov.',
	'HELP_FAQ_FRIENDS_MANAGE_QUESTION'	=> 'Ako môžem pridávať užívateľov do zoznamu alebo ich odoberať?',

	'HELP_FAQ_GROUPS_ADMINISTRATORS_ANSWER'	=> 'Administrátori sú užívatelia poverení najvyššou kontrolou nad celým fórom. Títo užívatelia môžu kontrolovať chod fóra vrátane povoľovania, zakazovania užívateľov, vytvárane užívateľských skupín alebo moderátorov, atď. Majú taktiež všetky právomoci moderátorov na celom fóre.',
	'HELP_FAQ_GROUPS_ADMINISTRATORS_QUESTION'	=> 'Kto sú Administrátori?',
	'HELP_FAQ_GROUPS_COLORS_ANSWER'	=> 'Je možné, aby administrátor fóra pridelil členom určitej skupiny farbu, pre uľahčenie ich odlíšenia od ostatných členov.',
	'HELP_FAQ_GROUPS_COLORS_QUESTION'	=> 'Prečo majú niektoré skupiny inú farbu?',
	'HELP_FAQ_GROUPS_DEFAULT_ANSWER'	=> 'Pokiaľ ste členom viac skupín, vaša východzia skupina určuje, akú farbu bude mať vaše užívateľské meno. Administrátor fóra vám môže udeliť oprávnenie meniť si svoju východziu skupinu cez užívateľský panel.',
	'HELP_FAQ_GROUPS_DEFAULT_QUESTION'	=> 'Čo je "Východzia užívateľská skupina"?',
	'HELP_FAQ_GROUPS_MODERATORS_ANSWER'	=> 'Moderátori sú jednotlivci (alebo skupiny jednotlivcov), ich prácou je starať sa o chod fóra pokiaľ možno denne. Majú právo upravovať alebo mazať príspevky, zamykať/odomykať, presúvať, mazať a rozdeľovať témy, o ktoré sa starajú. Vo všeobecnosti, moderátori sú na to, aby užívatelia neprispievali mimo tém alebo nepridávali otravný materiál.',
	'HELP_FAQ_GROUPS_MODERATORS_QUESTION'	=> 'Kto sú Moderátori?',
	'HELP_FAQ_GROUPS_TEAM_ANSWER'	=> 'Táto stránka vám poskytuje prehľad členov tímu fóra, vrátane administrátorov a moderátorov vrátane ďalších informácií, ako napr. ktoré fóra moderujú, hodnosť atď.',
	'HELP_FAQ_GROUPS_TEAM_QUESTION'	=> 'Čo znamená odkaz "Tím"?',
	'HELP_FAQ_GROUPS_USERGROUPS_ANSWER'	=> 'Užívateľské skupiny sú cestou, ktorou administrátori môžu užívateľom priradiť skupiny. Každý užívateľ môže patriť do niekoľkých skupín a každej skupine môže byť definovaný individuálny prístup. To umožňuje administrátorom ľahšie nastaviť niekoľko užívateľov ako moderátorov fóra alebo im dať prístup na súkromné fórum, atď.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_ANSWER'	=> 'Pre pripojenie sa do užívateľskej skupiny stačí kliknúť na odkaz Užívateľské skupiny (väčšinou sa nachádza v hornej časti stránky, ale nemusí to byť pravidlom) a potom si môžete prezrieť všetky skupiny. Nie všetky skupiny majú otvorený prístup, niektoré sú uzavreté a niektoré majú utajené členstvo. Pokiaľ je skupina otvorená, môžete žiadať o zaradenie kliknutím na príslušné tlačítko. Moderátor užívateľskej skupiny musí vašu žiadosť schváliť a môže sa vás spýtať na dôvody, prečo chcete do skupiny vstúpiť. Prosím, nenadávajte moderátorovi, pokiaľ vašej žiadosti nevyhovie. Má svoj dôvod.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_QUESTION'	=> 'Ako sa môžem zapojiť do užívateľskej skupiny?',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_ANSWER'	=> 'Užívateľské skupiny sú pôvodne vytvorené administrátorom a môžu taktiež ustanoviť moderátora. Ak máte záujem vytvoriť užívateľskú skupinu, potom ako prvého kontaktujte administrátora súkromnou správou.',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_QUESTION'	=> 'Ako sa stanem moderátorom užívateľskej skupiny?',
	'HELP_FAQ_GROUPS_USERGROUPS_QUESTION'	=> 'Čo sú užívateľské skupiny?',

	'HELP_FAQ_ISSUES_ADMIN_ANSWER'	=> 'Všetci užívatelia fóra môžu využiť formulár “Kontaktujte nás”, ak bola táto možnosť povolená administrátorom.<br />Členovia fóra môžu tiež využiť odkaz “Tím”.',
	'HELP_FAQ_ISSUES_ADMIN_QUESTION'	=> 'Ako môžem kontaktovať aministrátora fóra?',
	'HELP_FAQ_ISSUES_FEATURE_ANSWER'	=> 'Tento software bol napísaný a licencovaný cez phpBB Group. Máte dojem, že je potrebné pridať nejakú funkciu alebo chcete oznámiť chybu, prosíme, navštívte <a href="https://www.phpbb.com/ideas/">phpBB centrum nápadov</a>, kde môžete hlasovať za existujúce nápady alebo navrhnúť nové.',
	'HELP_FAQ_ISSUES_FEATURE_QUESTION'	=> 'Prečo nie je k dispozícii funkcia X?',
	'HELP_FAQ_ISSUES_LEGAL_ANSWER'	=> 'Mali by ste kontaktovať administrátora tohto fóra. Ak ho nemôžete nájsť, skúste najprv kontaktovať moderátora fóra a popýtajte si kontakt. Pokiaľ sa nič neudeje, kontaktujte majiteľa domény (skúste vyhľadať na <a href="http://www.google.com/search?q=whois">"whois"</a>) alebo, pokiaľ táto služba beží na freeserveri (napr. yahoo, IC, webzdarma, atď.), management alebo oddelenie sťažností tohto poskytovateľa. Berte na vedomie, že phpBB Group nemá vôbec žiadnu moc a nemôže nijak ovplyvniť to jak, kto a kde spravuje fórum. Je zbytočné kontaktovať phpBB Group v akejkoľvek právnej záležitosti nepriamo spojené s phpbb.com alebo so samotným softwarom phpBB. Pokiaľ zašlete e-mail phpBB Group o použití softwaru treťou stranou, nečakajte žiadnu odpoveď.',
	'HELP_FAQ_ISSUES_LEGAL_QUESTION'	=> 'Koho mám kontaktovať ohľadom obťažujúcich e-mailov alebo právnych záležitostí fóra?',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_ANSWER'	=> 'Tento software (v jeho nemodifikované forme) je vytvorený, zverejnený a chránený autorskými právami <a href="https://www.phpbb.com/">phpBB Group</a>. Je dostupný pod the GNU General Public Licence a môže byť voľne šíriteľný. Pre viac informácií kliknite <a href="https://www.phpbb.com/about/">sem</a>.',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_QUESTION'	=> 'Kto napísal tento program?',

	'HELP_FAQ_LOGIN_AUTO_LOGOUT_ANSWER'	=> 'Pokiaľ nezaškrtnete tlačítko <em>Prihlásiť automaticky pri ďalšej návšteve</em>, budete prihlásený len počas práce vo fóre. Toto má zabrániť zneužitiu Vášho účtu niekým iným. Aby ste zostali prihlásený, zaškrtnite toto políčko, keď sa prihlasujete. Toto však nedoporučujeme, keď sa prihlasujete z verejného počítača, napr. v knižnici, z internetovej kaviarne, na univerzite atď.',
	'HELP_FAQ_LOGIN_AUTO_LOGOUT_QUESTION'	=> 'Prečo som automaticky odhlásený?',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANSWER'	=> 'Už ste sa zaregistrovali? Pred prihlásením je potrebné sa najskôr zaregistrovať. Bola Vám na fóre zakázaná činnosť (v takom prípade sa táto skutočnosť zobrazí)? Pokiaľ áno, kontaktujte administrátora a pýtajte sa na dôvody. Pokiaľ ste sa zaregistrovali, neboli ste z fóra vylúčení a stále sa nemôžete prihlásiť, znova skontrolujte prihlasovacie meno a heslo. Obyčajne toto býva ten problém a pokiaľ nie je, kontaktujte administrátora, možno má chybné nastavenia fóra.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_ANSWER'	=> 'Najpravdepodobnejšie dôvody: zadali ste chybné užívateľské meno alebo heslo (skontrolujte e-mail, ktorý ste obdržali pri registrácií). Je bežné, že sa pravidelne odstraňujú užívatelia, ktorí ničím neprispeli, aby sa zmenšila veľkosť databázy. Skúste sa zaregistrovať znova a zapojte sa do diskusie.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_QUESTION'	=> 'V minulosti som sa zaregistroval, avšak teraz sa nemôžem prihlásiť!',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_QUESTION'	=> 'Prečo sa nemôžem prihlásiť?',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_ANSWER'	=> 'Je možné, že Administrátor fóra zablokoval vašu IP adresu alebo zakázal použitie užívateľského mena, ktoré ste si zvolili. Administrátor taktiež mohol vypnúť registrácie, aby zabránil prístupu nových užívateľov na fórum. Pre ďalšie informácie kontaktuje administrátora fóra.',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_QUESTION'	=> 'Prečo sa nemôžem zaregistrovať?',
	'HELP_FAQ_LOGIN_COPPA_ANSWER'	=> 'COPPA (Child Online Privacy and Protection Act) z roku 1998 je zákon Spojených Štátov, ktorý má chrániť mládež na internete. Na stránkach, kde je potencionálna možnosť ukladania osobných údajov o užívateľovi, ktorému je menej ako 13 rokov, musí mať súhlas rodičov alebo zákonných zástupcov, aby tieto data uložil. Tento zákon však platí iba v Spojených Štátoch. Pokiaľ si nie ste istý, či toto platí aj na vašom fóre, doporučujeme kontaktovať vášho právneho poradcu, phpBB Team nemôže a nebude poskytovať právnu podporu v akomkoľvek kontexte.',
	'HELP_FAQ_LOGIN_COPPA_QUESTION'	=> 'Čo znamená COPPA?',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_ANSWER'	=> '“Vymazať cookies” odstráni cookies, ktoré sú vytvorené phpBB a ktoré Vás udržujú prihlásených, ďalej sa taktiež starajú o funkcie sledovania nových príspevkov na fórach a v témach, pokiaľ to administrátor umožní. Zmažte cookies fóra pokiaľ máte problémy s prihlasovaním.',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_QUESTION'	=> 'Na čo slúži odkaz "Vymazať cookies"?',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_ANSWER'	=> 'Nepanikárte! Vaše heslo môžeme obnoviť. V tomto prípade stlačte na prihlasovacej stránke tlačítko <em>Zabudli ste svoje heslo?</em>, pokračujte podľa inštrukcií a takmer ihneď budete prihlásený.',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_QUESTION'	=> 'Zabudol som heslo!',
	'HELP_FAQ_LOGIN_REGISTER_ANSWER'	=> 'Nemusíte. Všetko záleží na administrátorovi fóra, či je potrebné sa zaregistrovať ku vkladaniu príspevkov. Samozrejme, že registrácia Vám umožní prístup k ostatným službám nedostupným anonymným užívateľom, ako napr. postavičky, súkromné správy, posielanie e-mailov užívateľom, prihlásenie do skupín, atď. Vrele Vám teda registráciu doporučujeme. Zaberie to len chvíľu.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_ANSWER'	=> 'Najskôr skontrolujte, že zadávate správne užívateľské meno a heslo. Pokiaľ sú v poriadku, potom sa mohla stať jedna z nasledovných dvoch vecí. Pokiaľ je povolená podpora COPPA a klikli ste pri registrácii na odkaz ... a je mi menej ako 13 rokov, budete musieť postupovať podľa zaslaných inštrukcií. Pokiaľ toto nie je ten prípad, potom Váš účet musí byť aktivovaný. Niektoré fóra potrebujú aktiváciu všetkých nových registrácií, buď Vami, alebo administrátorom pred tim, ako sa budete môcť prihlásiť. Keď ste sa registrovali, boli by ste k tomu vyzvaný. Pokiaľ Vám bol zaslaný e-mail, postupujte podľa inštrukcií v ňom uvedených, pokiaľ ste tento e-mail neobdržali, uistite sa, že Vaša e-mailová adresa je platná. Jedným z dôvodov, prečo sa aktivácia používa, je zmenšiť možnosť nežiaducich užívateľov, ktorý sa snažia iba obťažovať. Pokiaľ si ste istí, že e-mailová adresa, ktorú ste použili je platná, kontaktujte administrátora fóra.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_QUESTION'	=> 'Zaregistroval som sa, ale nemôžem sa prihlásiť!',
	'HELP_FAQ_LOGIN_REGISTER_QUESTION'	=> 'Je vôbec potrebné sa zaregistrovať?',

	'HELP_FAQ_PMS_CANNOT_SEND_ANSWER'	=> 'Pre tento problém existujú tri hlavné dôvody. Nie ste zaregistrovaný alebo nie ste prihlásený, alebo administrátor zakázal posielanie súkromných správ pre celé fórum alebo to administrátor zakázal priamo vám. Pokiaľ je toto ten dôvod, spýtajte sa administrátora, prečo to tomu tak je.',
	'HELP_FAQ_PMS_CANNOT_SEND_QUESTION'	=> 'Nemôžem posielať súkromné správy!',
	'HELP_FAQ_PMS_SPAM_ANSWER'	=> 'To je nám ľúto. Príspevkové formuláre obsahujú obranné mechanizmy, ktorými sa snažíme vystopovať takéhoto užívateľa. Mali by ste napísať administrátorovi a zaslať kópiu e-mailu, ktorý ste obdržali, čo je veľmi dôležité (kvôli hlavičke, ktorá potrebné informácie obsahuje).',
	'HELP_FAQ_PMS_SPAM_QUESTION'	=> 'Dostal/a som spamový a obťažujúci e-mail od niekoho z fóra!',
	'HELP_FAQ_PMS_UNWANTED_ANSWER'	=> 'Plánujeme pridanie zoznamu ignorovaných užívateľov v systému zasielania súkromných správ. Teraz, pokiaľ dostávate takéto správy, kontaktujte svojho administrátora, ktorý má tu moc takému užívateľovi zasielanie správ zakázať.',
	'HELP_FAQ_PMS_UNWANTED_QUESTION'	=> 'Dostávam nechcené súkromné správy!',

	'HELP_FAQ_POSTING_BUMP_ANSWER'	=> 'Kliknutím na odkaz "Oživiť tému", pokiaľ ho vidíte, môžete "oživiť" tému, čím ho posuniete na prvé miesto v prehľadu tém. Pokiaľ tento odkaz nevidíte, administrátor túto možnosť pravdepodobne vypol. Tému môžete "oživiť" taktiež pridaním nového príspevku, ale dbajte na to, aby ste neporušili pravidlá fóra.',
	'HELP_FAQ_POSTING_BUMP_QUESTION'	=> 'Ako môžem oživiť svoje témy?',
	'HELP_FAQ_POSTING_CREATE_ANSWER'	=> 'Jednoducho. Kliknite na príslušné tlačítko na obrazovke fóra alebo témy. Možno bude nutné sa zaregistrovať, kým budete môcť prispieť do diskusie. To, čo vám je povolené môžete vidieť na spodnej časti fóra alebo témy (napr. Môžete zakladať nové témy v tomto fóre, Môžete odpovedať na témy v tomto fóre, atď.).',
	'HELP_FAQ_POSTING_CREATE_QUESTION'	=> 'Ako vložím tému do fóra?',
	'HELP_FAQ_POSTING_DRAFT_ANSWER'	=> 'Táto možnosť vám umožňuje uložiť si rozpísané správy pre neskoršie odoslanie. Pre ich opätovné načítanie navštívte Užívateľský panel, kde sú správy uložené.',
	'HELP_FAQ_POSTING_DRAFT_QUESTION'	=> 'Na čo slúži tlačítko "Uložiť" pri písaní príspevku?',
	'HELP_FAQ_POSTING_EDIT_DELETE_ANSWER'	=> 'V prípade, že nie ste moderátor alebo administrátor, tak môžete upravovať alebo mazať len svoje príspevky. Môžete upraviť správu (niekedy len do obmedzeného času) kliknutím na tlačítko Upraviť. Pokiaľ už niekto odpovedal na váš príspevok a vy ho upravíte, objaví sa vám malý doplnok pod príspevkom, ktorí ukazuje, koľkokrát ste tento príspevok upravovali. Tento doplnok sa neobjaví, pokiaľ zatiaľ nikto neodpovedal alebo moderátor či administrátor zmenili príspevok (tí by mali sami zanechať odkaz prečo ho zmenili). Normálny užívatelia nemôžu príspevok zmazať, pokiaľ na neho už niekto odpovedal.',
	'HELP_FAQ_POSTING_EDIT_DELETE_QUESTION'	=> 'Ako zmením alebo zmažem príspevok?',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_ANSWER'	=> 'Niektoré fóra môžu byť zneprístupnené určitým ľuďom či skupinám. K čítaniu, prezeraniu, prispievaniu atď. potrebujete zvláštnu autorizáciu, ktorú môže poskytnúť len moderátor a administrátor, takže ich kontaktujte.',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_QUESTION'	=> 'Prečo sa nemôžem dostať k fóru?',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_ANSWER'	=> 'Administrátor môže povoľovať pridávanie príloh pre jednotlivé fóra, užívateľov, alebo skupiny. Pokiaľ nemáte dostatočné oprávnenia z jednej z týchto možností, alebo niektoré z nich úplne zabraňujú pridávať prílohy, nezobrazí sa vám táto možnosť pri odosielaní príspevkov.',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_QUESTION'	=> 'Prečo nemôžem pridávať prílohy?',
	'HELP_FAQ_POSTING_POLL_ADD_ANSWER'	=> 'Maximálny počet možností nastavuje Administrátor. Ak máte pocit, že potrebujete pridať viac možností pre vaše hlasovanie, kontaktujte administrátora fóra.',
	'HELP_FAQ_POSTING_POLL_ADD_QUESTION'	=> 'Prečo nemôžem pridať viac možností do hlasovania?',
	'HELP_FAQ_POSTING_POLL_CREATE_ANSWER'	=> 'Vytvorenie hlasovania je jednoduché. Pokiaľ pridáte nový príspevok (alebo upravujete prví príspevok, pokiaľ môžete) mali by ste vidieť tlačítko Pridať hlasovanie pod hlavným oknom na pridávanie príspevkov (pokiaľ to nevidíte, zrejme nemáte oprávnenie vytvárať hlasovania). Mali by ste zadať názov ankety a potom aspoň dve možnosti (nastavte napísaním názov otázky a kliknite na Pridať odpoveď. Môžete taktiež pridať časový limit pre anketu, kde 0 znamená neobmedzenú voľbu. Počet odpovedí, ktoré môžete zadať, určuje Administrátor fóra.',
	'HELP_FAQ_POSTING_POLL_CREATE_QUESTION'	=> 'Ako vytvorím hlasovanie?',
	'HELP_FAQ_POSTING_POLL_EDIT_ANSWER'	=> 'Je to rovnako ako s príspevkami, hlasovania môžu byť upravované pôvodným autorom, moderátorom alebo administrátorom. Upraviť ho môžete kliknutím na prvý príspevok v téme (toto je vždy s hlasovaním spojené). Pokiaľ nikto zatiaľ nehlasoval, pokiaľ užívatelia môžu vymazať alebo zmeniť položku v hlasovaní, v prípade už uskutočnenej voľby to tak môže učiniť len moderátor alebo administrátor. Týmto opatrením sa snažíme zabrániť manipulácii s výsledkami hlasovania.',
	'HELP_FAQ_POSTING_POLL_EDIT_QUESTION'	=> 'Ako zmením alebo zmažem hlasovanie?',
	'HELP_FAQ_POSTING_QUEUE_ANSWER'	=> 'Administrátor fóra môže nastaviť, že príspevky od užívateľov alebo skupín musia byť pred zobrazením schválené moderátormi. Buďto je na fóre nastavené schvaľovanie, alebo ste boli umiestnený do skupiny, pri ktorej je schvaľovanie požadované. Kontaktujte administrátora fóra pre viac informácií.',
	'HELP_FAQ_POSTING_QUEUE_QUESTION'	=> 'Prečo musí byť môj príspevok schválený?',
	'HELP_FAQ_POSTING_REPORT_ANSWER'	=> 'Administrátor môže na fóre povoliť nahlasovanie príspevkov užívateľovi. Pokiaľ je táto možnosť povolené, u každého príspevku uvidíte ikonu, ktorá vás privedie na formulár, kde vyplníte všetky informácie pre nahlásenie príspevku.',
	'HELP_FAQ_POSTING_REPORT_QUESTION'	=> 'Ako môžem nahlásiť príspevok moderátorom?',
	'HELP_FAQ_POSTING_SIGNATURE_ANSWER'	=> 'Pridať podpis znamená, že si musíte najprv nie aký vytvoriť. To urobíte cez stránku <em>Profil</em> v Užívateľskom panely. Podpis môžete pridať k práve písanému príspevku označením okienka <em>Pripojiť podpis</em>. Môžete taktiež pridať rovnaký podpis pre všetky vaše príspevky označením príslušného políčka v nastavení profilu (je možné nepridávať podpis k vybraným príspevkom odstránením tohto označenia).',
	'HELP_FAQ_POSTING_SIGNATURE_QUESTION'	=> 'Ako pridám podpis k môjmu príspevku?',
	'HELP_FAQ_POSTING_WARNING_ANSWER'	=> 'Každý administrátor si môže stanoviť vlastné pravidlá na svojom fóre, pokiaľ ich porušíte, môže vám byť udelené varovanie. Prosíme berte na vedomie, že toto je plne v kompetencií administrátorov fóra a phpBB Group nemá s vydávaním varovaní nič spoločné.',
	'HELP_FAQ_POSTING_WARNING_QUESTION'	=> 'Prečo som obdržal varovanie?',

	'HELP_FAQ_SEARCH_BLANK_ANSWER'	=> 'Vašou požiadavkou sa našlo príliš mnoho výsledkov, ktoré server nebol schopný spracovať. Spresnite vašu požiadavku a využite možnosť pokročilého vyhľadávania.',
	'HELP_FAQ_SEARCH_BLANK_QUESTION'	=> 'Prečo mi vyhľadávanie vracia prázdnu bielu stránku?',
	'HELP_FAQ_SEARCH_FORUM_ANSWER'	=> 'Vložením hľadaného výrazu do vyhľadávacieho poľa umiestneného na titulnej stránke, na fórach alebo v témach. Pre Pokročilé vyhľadávanie kliknite na odkaz "Hľadať", ktorý je dostupný vo všetkých stránkach fóra. Spôsob, akým sa pristupuje k vyhľadávaniu sa môže líšiť podľa použitého vzhľadu.',
	'HELP_FAQ_SEARCH_FORUM_QUESTION'	=> 'Ako môžem hľadať v jednom alebo viac fórach?',
	'HELP_FAQ_SEARCH_MEMBERS_ANSWER'	=> 'Prejdite na stránku "Užívatelia" a kliknite na odkaz "Vyhľadať užívateľa", kde môžete pomocou rôznych parametrov užívateľa vyhľadať.',
	'HELP_FAQ_SEARCH_MEMBERS_QUESTION'	=> 'Ako môžem vyhľadávať členov fóra?',
	'HELP_FAQ_SEARCH_NO_RESULT_ANSWER'	=> 'Vami hľadaný výraz bol pravdepodobne príliš obecný a obsahoval príliš mnoho častých slov, ktoré nie sú indexované. Spresnite vašu požiadavku a využite možnosti pokročilého vyhľadávania.',
	'HELP_FAQ_SEARCH_NO_RESULT_QUESTION'	=> 'Prečo moja požiadavka vracia nulový počet výsledkov?',
	'HELP_FAQ_SEARCH_OWN_ANSWER'	=> 'K vaším príspevkom sa môžete dostať kliknutím na odkaz "Hľadať užívateľove príspevky" v Užívateľskom panely, alebo cez váš profil. Pre vyhľadávanie tém, ktoré ste odoslali, využite stránku pokročilého vyhľadávania, kde zadáte odpovedajúce kritéria.',
	'HELP_FAQ_SEARCH_OWN_QUESTION'	=> 'Ako môžem nájsť svoje vlastné príspevky a témy?',

	'HELP_FAQ_USERSETTINGS_AVATAR_ANSWER'	=> 'Sú dva obrázky, ktoré sa môžu zobraziť vedľa užívateľského mena pri prezeraní príspevkov. Jeden z nich môže byť obrázok prepojený s vašou hodnosťou, všeobecne vo forme hviezdičiek, blokov alebo bodiek, ukazujúcich, koľko príspevkov ste poslali alebo váš stav na fóre. Iný, zvyčajne väčší, obrázok je známy ako avatar a je vo všeobecnosti jedinečný u každého užívateľa.',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_ANSWER'	=> 'Možno ste zaregistrovali pri prezeraní príspevkov dva obrázky pri užívateľskom mene. Ten prvý je obrázok spojený s Vašou úrovňou, zvyčajne v tvare hviezdičiek alebo kociek ukazujúcich, koľko príspevkov ste už pridali, alebo Vašu pozíciu vo fóre. Pod ním sa môže nachádzať väčší obrázok, známy ako "postavička" (avatar), čo je vlastne unikátny obrázok každého užívateľa. Záleží na administrátorovi fóra, či postavičky povolí, či ako s nimi naloží (v akej podobe sa zobrazia). Pokiaľ nemôžete využívať postavičky, potom práve vtedy toto administrátori zakázali, a Vy by ste sa mali spýtať na dôvody (veríme, že sa hodia).',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_QUESTION'	=> 'Ako zobrazím obrázok pri užívateľskom mene?',
	'HELP_FAQ_USERSETTINGS_AVATAR_QUESTION'	=> 'Čo je to za obrázok vedľa môjho užívateľského mena?',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_ANSWER'	=> 'Všetky Vaše nastavenia (pokiaľ ste zaregistrovaný) sú uložené v databáze. Ku zmene stačí stlačiť tlačítko odkazu Nastavenia (zvyčajne sa objavuje na hornej časti stránky, ale nemusí to byť pravidlom). Takto si môžete zmeniť všetky svoje nastavenia.',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_QUESTION'	=> 'Ako zmením svoje nastavenia?',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_ANSWER'	=> 'Len zaregistrovaní užívatelia môžu posielať e-mail ľuďom cez      nastavený e-mailový formulár (pokiaľ administrátor túto možnosť povolil). Toto opatrenie umožňuje zbaviť sa otravných anonymných správ a robotov, ktorý zbierajú e-mailové adresy.',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_QUESTION'	=> 'Keď kliknem na e-mailový odkaz užívateľa, som vyzvaný k prihláseniu!',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_ANSWER'	=> 'Vo Vašom nastavení nájdete možnosť <em>Skryť Vašu prítomnosť vo fóre</em>, pokiaľ túto možnosť <em>zvolíte</em> budete viditeľný len pre administrátorov. Budete počítaný ako skrytý užívateľ.',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_QUESTION'	=> 'Ako zabránim, aby sa moje užívateľské meno objavilo v zozname práve prihlásených?',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_ANSWER'	=> 'Pravdepodobne administrátor nenainštaloval tento jazyk, alebo ho nikto do tohto jazyka zatiaľ nepreložil. Kontaktujte administrátora, prípadne si preklad vytvorte sami. Pre viac informácií navštívte stránky <a href="https://www.phpbb.com/">phpBB Group</a>.',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_QUESTION'	=> 'Môj jazyk nie je na zozname!',
	'HELP_FAQ_USERSETTINGS_RANK_ANSWER'	=> 'Zvyčajne svoje zaradenie zmeniť priamo nemôžete (úrovne sa objavujú pod Vašim užívateľským menom v témach a vo Vašom profile, čo záleží na použitom vzhľade). Väčšina diskusných fór používa hodnotenie úrovní k rozlíšeniu počtu Vami pridaných príspevkov a k identifikácií určitých užívateľov, napr. označenie moderátorov a administrátorov môže mať zvláštny vzhľad. Prosím, nezaťažujte fórum zbytočným prispievaním len aby ste dosiahli vyššej úrovne. Moderátor alebo administrátor potom môže počet Vašich príspevkov znížiť.',
	'HELP_FAQ_USERSETTINGS_RANK_QUESTION'	=> 'Ako zmeniť svoje zaradenie?',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_ANSWER'	=> 'Ak ste si istí, že ste zadali časové pásmo správne a aj tak sa líši od toho správneho, tak tou najpravdepodobnejšou odpoveďou je, že sa jedná o letný čas. Fórum nie je stavané na uplatňovanie rozdielov medzi štandardným a letným časom, takže sa môže jednať o 1 hodinový rozdiel. Riešením môže byť posunutie časového pásma o jednu hodinu po dobu trvania letného času.',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_QUESTION'	=> 'Zmenil som časové pásmo, ale je to stále chybne!',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_ANSWER'	=> 'Časy sú takmer vždy v poriadku, avšak to, čo vidíte sú časy zobrazené v inom časovom pásme než v tom, v ktorom sa nachádzate. Pokiaľ je to tak, zmeňte si časové pásmo v nastaveniach. Berte na vedomie, že zmenu časového pásma a podobné nastavenia môžu meniť len registrovaní užívatelia. Takže pokiaľ nie ste registrovaný, toto je dobrý dôvod, prečo tak urobiť!',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_QUESTION'	=> 'Časy sú chybné!',
));
