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
	'HELP_BBCODE_BLOCK_IMAGES'	=> 'Zobrazovanie obrázkov',
	'HELP_BBCODE_BLOCK_INTRO'	=> 'Úvod',
	'HELP_BBCODE_BLOCK_LINKS'	=> 'Vytváranie odkazov',
	'HELP_BBCODE_BLOCK_LISTS'	=> 'Vytváranie zoznamov',
	'HELP_BBCODE_BLOCK_OTHERS'	=> 'Iné',
	'HELP_BBCODE_BLOCK_QUOTES'	=> 'Citácie a vloženie časti kódu alebo textu s pevnou šírkou',
	'HELP_BBCODE_BLOCK_TEXT'	=> 'Formátovanie textu',

	'HELP_BBCODE_IMAGES_ATTACHMENT_ANSWER'	=> 'Prílohy je teraz možné pridávať do príspevku priemo pri jeho písaní použitím párového tagu <strong>[attachment=][/attachment]</strong>, ak bol tento párový tag povolený administrátorom portálu a ak autor príspevku disponuje príslušným oprávnením k vkladaniu príloh.',
	'HELP_BBCODE_IMAGES_ATTACHMENT_QUESTION'	=> 'Vkladanie príloh',
	'HELP_BBCODE_IMAGES_BASIC_ANSWER'	=> '<br />Pri vkladaní obrázkov do príspevku by mal mať autor píspevku na pamäti konečný vzhľad svojho príspevku a preto sa neodporúča vkladanie neúmerného množstva obrázkov, ďalej je potrebné zabezpečiť, aby vkladaný obrázok bol priamo prístupný prostredníctvom URL adresy (odkazu). K zobrazeniu obrázku v príspevku postačí zapísať odkaz na obrázok do párového tagu <strong>[img][/img]</strong>. Príklad zápisu:<br /><br /><strong>[img]</strong>https://www.phpbb.com/theme/images/logos/blue/160x52.png<strong>[/img]</strong><br /><br />Ako už bolo spomenuté tagy sa môžu kombinovať, v tomto prípade napríklad s tagom <strong>[url][/url]</strong>, ak teda chcete zobraziť obrázok s aktívnym odkazom, použite nasledovný zápis:<br /><br /><strong>[url=https://www.phpbb.com/][img]</strong>https://www.phpbb.com/theme/images/logos/blue/160x52.png<strong>[/img][/url]</strong><br /><br />Výsledok bude vo vašom príspevku nasledovný:<br /><br /><a href="https://www.phpbb.com/"><img src="https://www.phpbb.com/theme/images/logos/blue/160x52.png" alt="" /></a><br />',
	'HELP_BBCODE_IMAGES_BASIC_QUESTION'	=> 'Pridanie obrázku do príspevku',

	'HELP_BBCODE_INTRO_BBCODE_ANSWER'	=> 'BBCode je špeciálna implementácia HTML, ktorá umožňuje meniť vlastnosti jednotlivých prvkov príspevku a celkový vzhľad príspevku. O tom, či môžete používať BBCode pri písaní príspevkov rozhoduje administrátor portálu nastavením príslušných možností portálu. Ak je používanie BBCode povolené pre celý portál, môžete o jeho použití nakoniec rozhodnúť sami pri písaní každého príspevku. BBCode je veľmi podobný HTML, značky charakterizujúce vlastnosť písaného textu, nazývané tiež tagy, sú uzvreté v hranatých zátvorkách [ ] a ponúkajú tak väčšiu kontrolu nad vzhľadom príspevku. Od použitej témy portálu závisí, či je pre vkladanie tagov možné použiť jednoduché zástupné ikony alebo písať tagy ručne.',
	'HELP_BBCODE_INTRO_BBCODE_QUESTION'	=> 'Čo je to BBCode (značky)?',

	'HELP_BBCODE_LINKS_BASIC_ANSWER'	=> 'BBCode podporuje niekoľko spôsobov vytvárania odkazov na iné stránky.<br /><br /><ul><li>Prvý príklad používa párový tag <strong>[url=][/url]</strong>, čokoľvek uvedené za symbolom = bude interpretované prehliadačom ako cieľová adresa, ktorú má prehliadač otvoriť. Príklad zápisu aktívneho odkazu na phpBB.com:<br /><br /><strong>[url=https://www.phpbb.com/]</strong>Navštívte stránky phpBB!<strong>[/url]</strong><br /><br />sa zobrazí nasledovne: <a href="https://www.phpbb.com/">Navštívte stránky phpBB!</a> Tento odkaz otvorí vložený link buď v rovnakom, alebo novom okne, v závislosti od nastavení vášho prehliadača.<br /><br /></li><li>Ak chcete, aby bol odkaz zobrazený priamo v príspevku, stačí jednoduchý zápis:<br /><br /><strong>[url]</strong>https://www.phpbb.com/<strong>[/url]</strong><br /><br />zobrazenie takéhoto zápisu bude nasledovné: <a href="https://www.phpbb.com/">https://www.phpbb.com/</a><br /><br /></li><li>Ďalej, BBCode ponúka tzv. <i>Magic Links</i>, toto spôsobí, že platný odkaz bude prehliadačom interpretovaný ako aktívny odkaz, bez toho, aby bol uvedený do párového tagu alebo počiatočnej predpony http://. Príklad zápisu:<br /><br />www.phpbb.com<br /><br />sa zobrazí v príspevku nasledovne <a href="http://www.phpbb.com/">www.phpbb.com</a><br /><br /></li><li>Obdobne to platí pre odosielanie emailov priamo z príspevku. Príklad zápisu:<br /><br /><strong>[email]</strong>meno.priezvisko@adresa.sk<strong>[/email]</strong><br /><br />sa v príspevku zobrazí nasledovne: <a href="mailto:meno.priezvisko@adresa.sk">meno.priezvisko@adresa.sk</a> alebo stačí pri písaní príspevku jednoducho napísať meno.priezvisko@adresa.sk, bez toho, aby bolo potrebné uzatvárať adresu príjemcu do párového tagu.</li></ul><br /><br />',
	'HELP_BBCODE_LINKS_BASIC_QUESTION'	=> 'Odkazy na iné stránky',

	'HELP_BBCODE_LISTS_ORDERER_ANSWER'	=> 'Zoradený zoznam s očíslovaním jednotlivých položiek zoznamu vytvoríte použitím zápisu <strong>[list=1][/list]</strong> alebo zoznam s chronologickým zoradením položiek podľa písmen abecedy s použitím zápisu <strong>[list=a][/list]</strong>. Rovnako ako u jednoduchého zoznamu jednotlivé položky zoznamu sú definované na samostatnom riadku s použitím <strong>[*]</strong>. Príklad zápisu:<br /><br /><strong>[list=1]</strong><br /><strong>[*]</strong>Nakúpiť<br /><strong>[*]</strong>Navariť<br /><strong>[*]</strong>Povysávať<br /><strong>[/list]</strong><br /><br />sa zobrazí nasledovne:<br /><br /><ol style="list-style-type: decimal;"><li>Nakúpiť</li><li>Navariť</li><li>Povysávať</li></ol><br /><strong>[list=A]</strong><br /><strong>[*]</strong>Prvá možná odpoveď<br /><strong>[*]</strong>Druhá možná odpoveď<br /><strong>[*]</strong>Tretia možná odpoveď<br /><strong>[/list]</strong><br /><br />vráti<ol style="list-style-type: upper-alpha"><li>Prvá možná odpoveď</li><li>Druhá možná odpoveď</li><li>Tretia možná odpoveď</li></ol><br /><strong>[list=i]</strong><br /><strong>[*]</strong>Prvá možná odpoveď<br /><strong>[*]</strong>Druhá možná odpoveď<br /><strong>[*]</strong>Tretia možná odpoveď<br /><strong>[/list]</strong><br /><br />vráti<ol style="list-style-type: lower-roman"><li>Prvá možná odpoveď</li><li>Druhá možná odpoveď</li><li>Tretia možná odpoveď</li></ol><br /><strong>[list=I]</strong><br /><strong>[*]</strong>Prvá možná odpoveď<br /><strong>[*]</strong>Druhá možná odpoveď<br /><strong>[*]</strong>Tretia možná odpoveď<br /><strong>[/list]</strong><br /><br />vráti<ol style="list-style-type: upper-roman"><li>Prvá možná odpoveď</li><li>Druhá možná odpoveď</li><li>Tretia možná odpoveď</li></ol>',
	'HELP_BBCODE_LISTS_ORDERER_QUESTION'	=> 'Vytvorenie zoradeného zoznamu',
	'HELP_BBCODE_LISTS_UNORDERER_ANSWER'	=> '<br />BBCode podporuje dva typy zoznamov, jednoduchý (nezoradený) a zoradený. V zásade je ich tvorba rovnaká ako v jazyku HTML. Jednoduchý (nezoradený) zoznam položiek vypíše každú položku zoznamu na samostatnom riadku, jednu po druhej so symbolom plného krúžku na začiatku každej položky. Na vytvorenie takéhoto zoznamu použite párový tag <strong>[list][/list]</strong> a každú položku v ňom definujte použitím <strong>[*]</strong> na samostatnom riadku. Príklad zápisu:<br /><br /><strong>[list]</strong><br /><strong>[*]</strong>Slnko<br /><strong>[*]</strong>Seno<br /><strong>[*]</strong>Jahody<br /><strong>[/list]</strong><br /><br />Takýto zápis sa po uverejnení príspevku prejaví nasledovne:<br /><br /><ul><li>Slnko</li><li>Seno</li><li>Jahody</li></ul><br />Taktiež môžete špecifikovať štýl bodky zoznamu použitím <strong>[list=disc][/list]</strong>, <strong>[list=circle][/list]</strong> alebo <strong>[list=square][/list]</strong>.',
	'HELP_BBCODE_LISTS_UNORDERER_QUESTION'	=> 'Vytvorenie nezoradeného zoznamu',

	'HELP_BBCODE_OTHERS_CUSTOM_ANSWER'	=> 'Ak ste administrátor tohto fóra a máte dostatočné oprávnenia, môžete pridať nové BBCode cez modul Vlastné BBCode.',
	'HELP_BBCODE_OTHERS_CUSTOM_QUESTION'	=> 'Môžem pridať vlastné tagy?',

	'HELP_BBCODE_QUOTES_CODE_ANSWER'	=> '<br />Ak potrebujete vo svojom príspevku zobraziť časť kódu alebo text s pevnou šírkou, vložte úryvok svojho kódu alebo časť textu do párového tagu <strong>[code][/code]</strong>, príklad zápisu: <br /><br /><strong>[code]</strong>echo &quot;Toto je priklad zapisu kodu&quot;;<strong>[/code]</strong><br /><br />Formátovacie značky vo vnútri tagu zostanú zachované a nebudú vykonané.',
	'HELP_BBCODE_QUOTES_CODE_QUESTION'	=> 'Vloženie časti kódu alebo textu s pevnou šírkou',
	'HELP_BBCODE_QUOTES_TEXT_ANSWER'	=> '<br />Sú dve možnosti ako použiť citácie a to s odkazom na autora alebo bez odkazu na autora.<br /><br /><ul><li>Citovaný text je vložený do párového tagu <strong>[quote=&quot;&quot;][/quote]</strong> pričom užívateľské meno autora textu sa vkladá do úvodzoviek otváracieho tagu. Príklad zápisu:<br /><br /><strong>[quote=&quot;PepeLopez&quot;]</strong>Bol som tam.<strong>[/quote]</strong><br /><br />spôsobí, že pred citovaný text bude automaticky vložené "PepeLopez napísal:"<br /><br /></li><li>Druhý spôsob, je citácia, bez uvedenia autora. V tomto prípade vkladáme citovaný text do párového tagu <strong>[quote][/quote]</strong>.</li></ul>',
	'HELP_BBCODE_QUOTES_TEXT_QUESTION'	=> 'Použitie citovaného príspevku v odpovedi',

	'HELP_BBCODE_TEXT_BASIC_ANSWER'	=> '<br /><ul><li>Tučný text vytvoríte uzavretím časti textu do párového tagu <strong>[b][/b]</strong>, zápis počas písania príspevku: <br /><br /><strong>[b]</strong>Ahoj<strong>[/b]</strong><br /><br />bude po odoslaní príspevku vyzerať takto: <strong>Ahoj</strong><br /><br /></li><li>Pre podčiarknutý text použite <strong>[u][/u]</strong>, napríklad:<br /><br /><strong>[u]</strong>Dobré ráno<strong>[/u]</strong><br /><br />bude vyzerať takto: <span style="text-decoration: underline">Dobré ráno</span><br /><br /></li><li>Pre kurzívu použite <strong>[i][/i]</strong>, napríklad:<br /><br />Toto je <strong>[i]</strong>neskutočné!<strong>[/i]</strong><br /><br />bude vyzerať takto: Toto je <i>neskutočné!</i></li></ul><br /><br />',
	'HELP_BBCODE_TEXT_BASIC_QUESTION'	=> 'Ako vytvoriť tučný text, kurzívu a podčiarmnutý text?',
	'HELP_BBCODE_TEXT_COLOR_ANSWER'	=> '<br />Nasledujúce tagy môžu byť použité na zmenu veľkosti textu a jeho farby. Majte na pamäti, že výsledné zobrazenie je závislé na použitom prehliadači.<br /><br /><ul><li>Zmenu farby textu dosiahnete uzavretím časti textu do párového tagu <strong>[color=][/color]</strong>. Môžete použiť známe názvy farieb písaných ich anglickým názvom (napríklad red, blue, yellow, a pod.) alebo ich hexadecimálnu alternatívu, napríklad #FFFFFF, #000000. Pre zobrazenie textu červenou farbou použite napríklad zápis:<br /><br /><strong>[color=red]</strong>Ahoj!<strong>[/color]</strong><br /><br />alebo<br /><br /><strong>[color=#FF0000]</strong>Ahoj!<strong>[/color]</strong><br /><br />Obidva spôsoby zápisu sa prejavia takto: <span style="color:red">Ahoj!</span><br /><br /></li><li>Zmenu veľkosti textu je možné dosiahnuť podobným spôsobom <strong>[size=][/size]</strong>. Tento párový tag je závislý na použitej šablóne portálu. Odporúča sa použiť číselnú hodnotu, ktorá reprezentuje veľkosť textu v percentách, počiatočná hodnota je 20 (veľmi malé) až do 200 (veľmi veľké). Napríklad:<br /><br /><strong>[size=30]</strong>MALÉ PÍSMO<strong>[/size]</strong><br /><br />bude vyzerať takto <span style="font-size:30%;">MALÉ PÍSMO</span><br /><br />alebo:<br /><br /><strong>[size=200]</strong>VEĽKÉ!<strong>[/size]</strong><br /><br />bude <span style="font-size:200%;">VEĽKÉ!</span></li></ul><br /><br />',
	'HELP_BBCODE_TEXT_COLOR_QUESTION'	=> 'Ako zmeniť veľkosť textu a jeho farbu?',
	'HELP_BBCODE_TEXT_COMBINE_ANSWER'	=> '<br />Áno, je možné rôzne kombinovať formátovacie tagy, napríklad:<br /><br /><strong>[size=200][color=red][b]</strong>POZRI!<strong>[/b][/color][/size]</strong><br /><br />bude zobrazené ako <span style="color:red;font-size:200%;"><strong>POZRI!</strong></span><br /><br />Kvôli prehľadnosti však odporúčame vhodne voliť použitie jednotlivých formátovacích tagov, aby bol text prehľadný a čitateľný. Pamätajte na správne poradie v prípade použitia kombinácie tagov na rovnakú časť textu. Nasledujúci príklad zápisu je nesprávny a nemusí sa zobraziť správne:<br /><br /><strong>[b][u]</strong>TOTO JE ZLE ZAPÍSANÁ KOMBINÁCIA FORMÁTOVACÍCH TAGOV<strong>[/b][/u]</strong><br /><br />',
	'HELP_BBCODE_TEXT_COMBINE_QUESTION'	=> 'Môžem kombinovať formátovacie tagy?',
));
