<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @author phpBB3.sk, PepeLopez, Fonzi, Senky
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

// Common installer pages
$lang = array_merge($lang, array(
	'INSTALL_PANEL'				=> 'Inštalačný panel',
	'SELECT_LANG'				=> 'Vyberte jazyk',

	'STAGE_INSTALL'	=> 'Inštalácia phpBB',

	// Introduction page
	'INTRODUCTION_TITLE'	=> 'Úvod',
	'INTRODUCTION_BODY'		=> 'Vitajte v phpBB3!<br /><br />phpBB® je najpoužívanejšie otvorené riešenie fóra na svete. phpBB3 je najnovšie vydanie softvéru, ktorý začal v roku 2000. Tak ako jeho predchodcovia, phpBB3 je bohaté na funkcie, priateľské na používanie a plne podporované tímom phpBB. phpBB3 zlepšuje to, čo bolo v phpBB2 populárne a pridáva najčastejšie požadované funkcie, ktoré sa v predchádzajúcej verzii nenachádzali. Dúfame, že predčí vaše očakávania.<br /><br />Tento inštalačný systém vás prevedie procesom inštalácie phpBB3, aktualizáciou na najnovšiu verziu zo starej, ako aj konvertovaním na phpBB3 z iných systémov fór (vrátane phpBB2). Viac sa dočítate v <a href="../docs/INSTALL.html">inštalačnej príručke</a> (v Angličtine).<br /><br />Na prečítanie phpBB3 licencie alebo získanie podpory a nášmu postoju k nej, prosíme, vyberte možnosť z bočného menu. Pre pokračovanie vyberte vhodnú kartu hore.',

	// Support page
	'SUPPORT_TITLE'		=> 'Podpora',
	'SUPPORT_BODY'		=> 'Plná podpora bude zadarmo poskytnutá aktuálne stabilnému vydaniu phpBB3. To zahŕňa:</p><ul><li>inštaláciu</li><li>konfiguráciu</li><li>technické otázky</li><li>problémy s potencionálnymi chybami v softvéry</li><li>aktualizáciu z Release Candidate (RC) verzií na najnovšiu stabilnú verziu</li><li>konvertovanie z phpBB 2.0.x na phpBB3</li><li>konvertovanie z iného softvéru fór na phpBB3 (prosím, pozrite <a href="https://www.phpbb.com/community/viewforum.php?f=486">fórum konvertorov</a>)</li></ul><p>Povzbudzujeme používateľov beta verzií phpBB3, aby nahradili inštaláciu najnovšou verziou.</p><h2>Rozšírenia / Štýly</h2><p>Problémy týkajúce sa rozšírení, prosíme, hláste do vhodného <a href="https://www.phpbb.com/community/viewforum.php?f=451">fóra rozšírení</a>.<br />Problémy týkajúce sa štýlov, šablón a tém, prosíme, hláste do vhodného <a href="https://www.phpbb.com/community/viewforum.php?f=471">fóra štýlov</a>.<br /><br />Ak sa vaša otázka týka špecifického balíčka, prosíme, píšte priamo do témy venovanej danému balíčku.</p><h2>Získanie podpory</h2><p><a href="https://www.phpbb.com/support/">Sekcia podpory</a><br /><a href="https://www.phpbb.com/support/docs/en/3.2/ug/quickstart/">Návod na rýchle začatie</a><br /><br />Aby ste sa uistili, že máte stále najnovšiu verziu, sledujte nás na <a href="https://www.twitter.com/phpbb/">Twitteri</a> a <a href="https://www.facebook.com/phpbb/">Facebooku</a><br /><br />',

	// License
	'LICENSE_TITLE'		=> 'General Public License',

	// Install page
	'INSTALL_INTRO'				=> 'Vitajte v inštalácii',
	'INSTALL_INTRO_BODY'	=> 'Tento postup vám pomôže s inštaláciou phpBB3 na váš server.</p><p>Aby ste mohli pokračovať, budete potrebovať vaše nastavenie databázy. Ak neviete vaše nastavenia databázy, prosím kontaktujte váš webhosting a spýtajte sa ich. Nemôžete bez nich pokračovať. Potrebujete:</p>

	<ul>
		<li>Druh databázy - databáza, ktorú budete používať.</li>
		<li>Databázový server alebo DSN - adresa databázového serveru.</li>
		<li>Port databázového serveru - port k pripojeniu na databázu (vo väčšine prípadov ho nebude treba).</li>
		<li>Názov databázy - názov databázy uloženej na serveri.</li>
		<li>Užívateľské meno a heslo databázy - prístupové údaje ku databáze.</li>
	</ul>

	<p><strong>Poznámka:</strong> pokiaľ inštalujete a používate SQLite, mali by ste zadať úplnú cestu k databáze do DSN poľa a nechať pole pre meno a heslo prázdne. Z bezpečnostných dôvodov by ste mali zaistiť, že súbor databázy bude uložený na mieste, ktoré nie je prístupné z webu.</p>

	<p>phpBB3.1 môžete spustiť na týchto databázach:</p>
	<ul>
		<li>MySQL 3.23 alebo vyšší (MySQLi je podporované)</li>
		<li>PostgreSQL 8.3+</li>
		<li>SQLite 3.6.15+</li>
		<li>MS SQL Server 2000 alebo vyšší (priamo alebo cez ODBC)</li>
		<li>MS SQL Server 2005 alebo vyšší (natívny)</li>
		<li>Oracle</li>
	</ul>

	<p>Len databázy, ktoré sú podporované na vašom serveri budú zobrazené.',

	'ACP_LINK'	=> 'Prejsť do <a href="%1$s">administrátorského panelu</a>',

	'INSTALL_PHPBB_INSTALLED'		=> 'phpBB už je nainštalované.',
	'INSTALL_PHPBB_NOT_INSTALLED'	=> 'phpBB ešte nie je nainštalované.',
));

// Requirements translation
$lang = array_merge($lang, array(
	// Filesystem requirements
	'FILE_NOT_EXISTS'						=> 'Súbor neexistuje',
	'FILE_NOT_EXISTS_EXPLAIN'				=> 'Aby bolo možné nainštalovať phpBB, súbor %1$s musí existovať.',
	'FILE_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'Je odporúčané, aby súbor %1$s existoval. Zlepší to používanie fóra.',
	'FILE_NOT_WRITABLE'						=> 'Súbor nie je zapisovateľný',
	'FILE_NOT_WRITABLE_EXPLAIN'				=> 'Aby bolo možné nainštalovať phpBB, súbor %1$s musí byť zapisovateľný.',
	'FILE_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Je odporúčané, aby súbor %1$s bol zapisovateľný. Zlepší to používanie fóra.',

	'DIRECTORY_NOT_EXISTS'						=> 'Adresár neexistuje',
	'DIRECTORY_NOT_EXISTS_EXPLAIN'				=> 'Aby bolo možné nainštalovať phpBB, adresár %1$smusí existovať.',
	'DIRECTORY_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'Je odporúčané, aby adresár %1$s existoval. Zlepší to používanie fóra.',
	'DIRECTORY_NOT_WRITABLE'					=> 'Adresár nie je zapisovateľný',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN'			=> 'Aby bolo možné nainštalovať phpBB, adresár %1$smusí byť zapisovateľný.',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Je odporúčané, aby adresár %1$s bol zapisovateľný. Zlepší to používanie fóra.',

	// Server requirements
	'PHP_VERSION_REQD'					=> 'Verzia PHP',
	'PHP_VERSION_REQD_EXPLAIN'			=> 'phpBB vyžaduje verziu PHP 5.4.0 alebo vyššiu.',
	'PHP_GETIMAGESIZE_SUPPORT'			=> 'PHP funkcia getimagesize() je nevyhnutná',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'	=> 'Aby phpBB pracovalo správne, funkcia getimagesize musí byť dostupná.',
	'PCRE_UTF_SUPPORT'					=> 'Podpora PCRE UTF-8',
	'PCRE_UTF_SUPPORT_EXPLAIN'			=> 'phpBB nebude fungovať, ak vaše PHP nie je kompilované s podporou UTF-8 s rozšírením PCRE.',
	'PHP_JSON_SUPPORT'					=> 'Podpora PHP JSON',
	'PHP_JSON_SUPPORT_EXPLAIN'			=> 'Aby phpBB pracovalo správne, rozšírenie PHP JSON musí byť dostupné.',
	'PHP_XML_SUPPORT'					=> 'Podpora PHP XML/DOM',
	'PHP_XML_SUPPORT_EXPLAIN'			=> 'Aby phpBB pracovalo správne, rozšírenie PHP XML/DOM musí byť dostupné.',
	'PHP_SUPPORTED_DB'					=> 'Podporované typy databáz',
	'PHP_SUPPORTED_DB_EXPLAIN'			=> 'Musí byť povolené využívať aspoň jeden typ databázy kompatibilný s vašim PHP. Pokiaľ nie je ani jeden typ databázy ukázaný ako aktívny, kontaktujte prosím administrátora vášho webhostingu alebo si prezrite odpovedajúcu dokumentáciu PHP pre ďalšie informácie.',

	'RETEST_REQUIREMENTS'	=> 'Znovu otestovať požiadavky',

	'STAGE_REQUIREMENTS'	=> 'Skontrolovať požiadavky',
));

// General error messages
$lang = array_merge($lang, array(
	'INST_ERR_MISSING_DATA'		=> 'Musíte vyplniť všetky polia v tejto časti',

	'TIMEOUT_DETECTED_TITLE'	=> 'Inštalátor detekoval vypršanie času',
	'TIMEOUT_DETECTED_MESSAGE'	=> 'Inštalátor detekoval vypršanie času. Môžete skúsiť optovne načítať stránku, no to môže viesť k počkodeniu dát. Navrhujeme buď zvýšiť nastavenie vypršania času alebo použiť príkazový riadok.',
));

// Data obtaining translations
$lang = array_merge($lang, array(
	'STAGE_OBTAIN_DATA'	=> 'Nastavenie inštalačných dát',

	//
	// Admin data
	//
	'STAGE_ADMINISTRATOR'	=> 'Detaily administrátora',

	// Form labels
	'ADMIN_CONFIG'				=> 'Administrátorská konfigurácia',
	'ADMIN_PASSWORD'			=> 'Heslo administrátora',
	'ADMIN_PASSWORD_CONFIRM'	=> 'Heslo administrátora pre potvrdenie',
	'ADMIN_PASSWORD_EXPLAIN'	=> 'Heslo musí mať minimálne 6 a maximálne 30 znakov.',
	'ADMIN_USERNAME'			=> 'Užívateľské meno administrátora',
	'ADMIN_USERNAME_EXPLAIN'	=> 'Meno musí mať minimálne 3 a maximálne 20 znakov.',

	// Errors
	'INST_ERR_EMAIL_INVALID'		=> 'Emailová adresa, ktorú ste vložili nie je platná.',
	'INST_ERR_PASSWORD_MISMATCH'	=> 'Zadané heslá sa nezhodujú.',
	'INST_ERR_PASSWORD_TOO_LONG'	=> 'Heslo je príliš dlhé. Heslo môže mať maximálne 30 znakov.',
	'INST_ERR_PASSWORD_TOO_SHORT'	=> 'Heslo je príliš krátke. Heslo musí mať minimálne 6 znakov.',
	'INST_ERR_USER_TOO_LONG'		=> 'Užívateľské meno je príliš dlhé. Užívateľské meno môže mať maximálne 20 znakov.',
	'INST_ERR_USER_TOO_SHORT'		=> 'Užívateľské meno je príliš krátke. Užívateľské meno musí mať minimálne 2 znaky.',

	//
	// Board data
	//
	// Form labels
	'BOARD_CONFIG'		=> 'Konfigurácia fóra',
	'DEFAULT_LANGUAGE'	=> 'Predvolený jazyk',
	'BOARD_NAME'		=> 'Názov fóra',
	'BOARD_DESCRIPTION'	=> 'Krátky popis fóra',

	//
	// Database data
	//
	'STAGE_DATABASE'	=> 'Nastavenia databázy',

	// Form labels
	'DB_CONFIG'				=> 'Konfigurácia databázy',
	'DBMS'					=> 'Typ databázy',
	'DB_HOST'				=> 'Server databázy',
	'DB_HOST_EXPLAIN'		=> 'DSN je skratka pre názov zdroja dát a je relevantná len pre inštalácie ODBC. Na PostgreSQL, použite localhost pripojenie k lokálnemu serveru cez socket UNIX a 127.0.0.1 pre pripojenie cez TCP. Pre SQLite, zadajte celú cestu k súboru databázy.',
	'DB_PORT'					=> 'Port servera databázy',
	'DB_PORT_EXPLAIN'			=> 'Nechajte toto políčko prázdne, pokiaľ je port iný, ako je štandartný.',
	'DB_PASSWORD'			=> 'Heslo databázy',
	'DB_NAME'				=> 'Meno databázy',
	'DB_USERNAME'			=> 'Užívateľské meno databázy',
	'DATABASE_VERSION'		=> 'Verzia databázy',
	'TABLE_PREFIX'			=> 'Predpona tabuliek v databáze',
	'TABLE_PREFIX_EXPLAIN'	=> 'Predpona musí začínať písmenom a môže obsahovať iba písmená, číslice a podtržník.',

	// Database options
	'DB_OPTION_MSSQL_ODBC'	=> 'MSSQL Server 2000+ via ODBC',
	'DB_OPTION_MSSQLNATIVE'	=> 'MSSQL Server 2005+ [ Native ]',
	'DB_OPTION_MYSQL'		=> 'MySQL',
	'DB_OPTION_MYSQLI'		=> 'MySQL s rozšírením MySQLi',
	'DB_OPTION_ORACLE'		=> 'Oracle',
	'DB_OPTION_POSTGRES'	=> 'PostgreSQL',
	'DB_OPTION_SQLITE3'		=> 'SQLite 3',

	// Errors
	'INST_ERR_DB'					=> 'Chyba pri inštalácii databázy',
	'INST_ERR_NO_DB'				=> 'Nedá sa načítať PHP modul pre vybraný druh databázy',
	'INST_ERR_DB_INVALID_PREFIX'	=> 'Zadaná predpona je neplatná. Predpona musí začínať písmenom a môže obsahovať iba písmena, číslice a podtržník.',
	'INST_ERR_PREFIX_TOO_LONG'		=> 'Predpona tabuliek je príliš dlhá. Maximálna dĺžka je %d znakov.',
	'INST_ERR_DB_NO_NAME'			=> 'Nezadali ste meno databázy',
	'INST_ERR_DB_FORUM_PATH'		=> 'Databázový súbor, ktorý ste zvolili je v zložkách fóra. Mali by ste ho uložiť do adresára, ktorý nie je prístupný z webu.',
	'INST_ERR_DB_CONNECT'			=> 'Nemôžem sa pripojiť k databáze so zadaným menom a heslom. Pozri správu o chybe.',
	'INST_ERR_DB_NO_WRITABLE'		=> 'Aj databáza aj adresár, ktorý ju obsahuje musia byť zapisovateľné.',
	'INST_ERR_DB_NO_ERROR'			=> 'Žiadna chybová správa',
	'INST_ERR_PREFIX'				=> 'Tabuľky so zvolenou predponou už v databáze existujú, zvoľte prosím inú.',
	'INST_ERR_DB_NO_MYSQLI'			=> 'Verzia databázy MySQL, ktorá je inštalovaná na tomto stroji, je nekompatibilná s možnosťou "MySQL s rozšírením MySQLi", ktorú ste vybrali. Skúste zvoliť možnosť "MySQL".',
	'INST_ERR_DB_NO_SQLITE3'		=> 'Verzia rozšírenia SQLite, ktorú máte nainštalovanú, je príliš zastaralá a je potrebné ju aktualizovať aspoň na verziu 3.6.15.',
	'INST_ERR_DB_NO_ORACLE'			=> 'Verzia databázy Oracle, ktorá je inštalovaná na tomto stroji, vyžaduje nastavenie parametru <var>NLS_CHARACTERSET</var> na <var>UTF8</var>. Buď aktualizujte vašu inštaláciu na verziu 9.2+ alebo zmeňte tento parameter.',
	'INST_ERR_DB_NO_POSTGRES'		=> 'Databáza, ktorú ste zvolili, nebola vytvorená v kódovaní <var>UNICODE</var> alebo <var>UTF8</var>. Skúste inštalovať do databázy, ktorá má kódovanie <var>UNICODE</var> alebo <var>UTF8</var>',
	'INST_SCHEMA_FILE_NOT_WRITABLE'	=> 'Súbor so schémou nie je zapisovateľný',

	//
	// Email data
	//
	'EMAIL_CONFIG'	=> 'Konfigurácia emailov',

	// Package info
	'PACKAGE_VERSION'					=> 'Nainštalovaná verzia balíka',
	'UPDATE_INCOMPLETE'				=> 'Vaša inštalácia phpBB nebola správne aktualizovaná.',
	'UPDATE_INCOMPLETE_MORE'		=> 'Prosíme, pre nápravu si prečítajte informácie uvedené nižšie.',
	'UPDATE_INCOMPLETE_EXPLAIN'		=> '<h1>Nekompletná aktualizácia</h1>

		<p>Všimli sme si, že posledná aktualizácia vašej inštalácie phpBB nebola kompletná. Navštívte <a href="%1$s" title="%1$s">aktualizátor databázy</a>, vyberte <em>Aktualizovať iba databázu</em> a kliknite na <strong>Odoslať</strong>. Nezabudnite po aktualizácii vymazať adresár "install".</p>',

	//
	// Server data
	//
	// Form labels
	'UPGRADE_INSTRUCTIONS'			=> 'Nová verzia <strong>%1$s</strong> je dostupná. Prosíme, prečítajte si <a href="%2$s" title="%2$s"><strong>oznámenie o vydaní</strong></a> (v Angličtine), aby ste zistili, čo ponúka a ako aktualizovať.',
	'SERVER_CONFIG'				=> 'Nastavenie serveru',
	'SCRIPT_PATH'				=> 'Cesta ku skriptom',
	'SCRIPT_PATH_EXPLAIN'		=> 'Cesta k phpBB relatívne k názvu domény napr. <samp>/phpBB3</samp>.',
));

// Default database schema entries...
$lang = array_merge($lang, array(
	'CONFIG_BOARD_EMAIL_SIG'		=> 'Ďakujeme, vedenie fóra',
	'CONFIG_SITE_DESC'				=> 'Tu bude krátky popis vášho fóra',
	'CONFIG_SITENAME'				=> 'vaša_doména.sk',

	'DEFAULT_INSTALL_POST'			=> 'Toto je príklad ako budú vyzerať príspevky vo vašom phpBB3 fóre. Môžete upraviť alebo zmazať tento príspevok, alebo rovno celú tému, alebo dokonca celé toto fórum, pretože sa zdá, že všetko funguje ako má!',

	'FORUMS_FIRST_CATEGORY'			=> 'Vaša prvá kategória',
	'FORUMS_TEST_FORUM_DESC'		=> 'Popis vášho prvého fóra.',
	'FORUMS_TEST_FORUM_TITLE'		=> 'Vaše prvé fórum',

	'RANKS_SITE_ADMIN_TITLE'		=> 'Administrátor',
	'REPORT_WAREZ'					=> 'Príspevok obsahuje odkaz na nelegálny alebo pirátsky softvér.',
	'REPORT_SPAM'					=> 'Nahlásený príspevok mal za účel propagovať inú webovú stránku alebo produkt.',
	'REPORT_OFF_TOPIC'				=> 'Nahlásený príspevok je mimo tému.',
	'REPORT_OTHER'					=> 'Nahlásený príspevok nezapadá do žiadnej z kategórii, prosím vyplňte pole pre ďalšie informácie.',

	'SMILIES_ARROW'					=> 'Šípka',
	'SMILIES_CONFUSED'				=> 'Zmätený',
	'SMILIES_COOL'					=> 'Cool',
	'SMILIES_CRYING'				=> 'Plačúci',
	'SMILIES_EMARRASSED'			=> 'Hanblivý',
	'SMILIES_EVIL'					=> 'Zlý',
	'SMILIES_EXCLAMATION'			=> 'Výkričník',
	'SMILIES_GEEK'					=> 'Týpek',
	'SMILIES_IDEA'					=> 'Nápad',
	'SMILIES_LAUGHING'				=> 'Smejúci sa',
	'SMILIES_MAD'					=> 'Nahnevaný',
	'SMILIES_MR_GREEN'				=> 'Mr. Green',
	'SMILIES_NEUTRAL'				=> 'Neutrálny',
	'SMILIES_QUESTION'				=> 'Otáznik',
	'SMILIES_RAZZ'					=> 'Vyplazujúci jazyk',
	'SMILIES_ROLLING_EYES'			=> 'Krútiaci očami',
	'SMILIES_SAD'					=> 'Smutný',
	'SMILIES_SHOCKED'				=> 'Šokovaný',
	'SMILIES_SMILE'					=> 'Usmiaty',
	'SMILIES_SURPRISED'				=> 'Prekvapený',
	'SMILIES_TWISTED_EVIL'			=> 'Zvrátený',
	'SMILIES_UBER_GEEK'				=> 'Bradatý týpek',
	'SMILIES_VERY_HAPPY'			=> 'Veľmi šťastný',
	'SMILIES_WINK'					=> 'Žmurk',

	'TOPICS_TOPIC_TITLE'			=> 'Vitajte v phpBB3',
));

// Common navigation items' translation
$lang = array_merge($lang, array(
	'MENU_OVERVIEW'		=> 'Prehľad',
	'MENU_INTRO'		=> 'Úvod',
	'MENU_LICENSE'		=> 'Licencia',
	'MENU_SUPPORT'		=> 'Podpora',
));

// Task names
$lang = array_merge($lang, array(
	// Install filesystem
	'TASK_CREATE_CONFIG_FILE'	=> 'Vytváranie konfiguračného súboru',

	// Install database
	'TASK_ADD_CONFIG_SETTINGS'			=> 'Pridávanie konfiguračných nastavení',
	'TASK_ADD_DEFAULT_DATA'				=> 'Pridávanie predvolených nastavení do databázy',
	'TASK_CREATE_DATABASE_SCHEMA_FILE'	=> 'Vytváranie súboru databázovej schémy',
	'TASK_SETUP_DATABASE'				=> 'Nastavovanie databázy',
	'TASK_CREATE_TABLES'				=> 'Vytváranie tabuliek',

	// Install data
	'TASK_ADD_BOTS'				=> 'Registrovanie botov',
	'TASK_ADD_LANGUAGES'		=> 'Inštalovanie dostupných jazykov',
	'TASK_ADD_MODULES'			=> 'Inštalovanie modulov',
	'TASK_CREATE_SEARCH_INDEX'	=> 'Vytváranie vyhľadávacieho indexu',

	// Install finish tasks
	'TASK_INSTALL_EXTENSIONS'	=> 'Inštalovanie pribalených rozšírení',
	'TASK_NOTIFY_USER'			=> 'Posielanie notifikačného emailu',
	'TASK_POPULATE_MIGRATIONS'	=> 'Spracovanie migrácií',

	// Installer general progress messages
	'INSTALLER_FINISHED'	=> 'Inštalátor bol úspešne ukončený',
));

// Installer's general messages
$lang = array_merge($lang, array(
	'MODULE_NOT_FOUND'				=> 'Modul nebol nájdený',
	'MODULE_NOT_FOUND_DESCRIPTION'	=> 'Modul nebol nájdený, pretože služba %s je nedefinovaná.',

	'TASK_NOT_FOUND'				=> 'Úloha nebola nájdená',
	'TASK_NOT_FOUND_DESCRIPTION'	=> 'Úloha nebola nájdená, pretože služba %s je nedefinovaná.',

	'SKIP_MODULE'	=> 'Preskočiť modul “%s”',
	'SKIP_TASK'		=> 'Preskočiť úlohu “%s”',

	'TASK_SERVICE_INSTALLER_MISSING'	=> 'Všetky úlohy inštalátora musia začať s “installer”',
	'TASK_CLASS_NOT_FOUND'				=> 'Definícia služby úlohy inštalátora je neplatná. Názov služby je “%1$s”, no očakávaný menný priestor triedy je “%2$s”. Pre viac informácií, prosíme, pozrite v dokumentáciu task_interface.',

	'INSTALLER_CONFIG_NOT_WRITABLE'	=> 'Konfiguračný súbor inštalátora nie je zapisovateľný.',
));

// CLI messages
$lang = array_merge($lang, array(
	'CLI_INSTALL_BOARD'				=> 'Inštalovať phpBB',
	'CLI_UPDATE_BOARD'				=> 'Aktualizovať phpBB',
	'CLI_INSTALL_SHOW_CONFIG'		=> 'Zobraziť konfiguráciu, ktorá bude použitá',
	'CLI_INSTALL_VALIDATE_CONFIG'	=> 'Skontrolovať konfiguračný súbor',
	'CLI_CONFIG_FILE'				=> 'Konfiguračný súbor, ktorý sa použije',
	'MISSING_FILE'					=> 'Nie je možné pristúpiť k súboru %1$s',
	'MISSING_DATA'					=> 'V konfiguračnom súbore chýbajú dáta alebo môže obsahovať nesprávne nastavenia.',
	'INVALID_YAML_FILE'				=> 'Nebolo možné spracovať YAML súbor %1$s',
	'CONFIGURATION_VALID'			=> 'Konfiguračný súbor je validný',
));

// Common updater messages
$lang = array_merge($lang, array(
	'UPDATE_INSTALLATION'			=> 'Aktualizovať inštaláciu phpBB',
	'UPDATE_INSTALLATION_EXPLAIN'	=> 'Týmto nástrojom sa dá aktualizovať vaša inštalácia phpBB na najnovšiu verziu.<br />počas procesu bude skontrolovaná integrita všetkých súborov. Budete mať možnosť si prehliadnuť všetky rozdiely a súbory pred aktualizáciou.<br /><br />Samotné úpravy súborov môžu byť uskutočnené dvoma spôsobmi.</p><h2>Ručná aktualizácia</h2><p>Pokiaľ zvolíte len tento spôsob, stiahnete len upravené súbory pre fórum, aby ste sa mohli uistiť, že nestratíte zmeny uskutočnené na fóre. Po stiahnutí tohto balíčku budete musieť ručne nahrať všetky súbory na server a umiestniť ich do zodpovedajúcich zložiek. Po skončení nahrávania budete môcť znovu skontrolovať integritu súborov, aby ste si overili, že ste súbory nahrali správne. Pokiaľ boli všetky správne nahrané, budete presmerovaný na aktualizačný skript databázy.</p><h2>Automatická aktualizácia cez FTP</h2><p>Tento spôsob je podobný prvému, ale nebudete musieť stiahnuť súbory a ručne ich nahrať. Toto systém uskutoční automaticky. Aby ste mohli využiť tento spôsob, budete musieť poznať prístupové údaje k FTP. Po nahraní bude znova prevedená kontrola integrity. Pokiaľ sú súbory v poriadku budete presmerovaný na aktualizačný skript databázy.',
	'UPDATE_INSTRUCTIONS'			=> '

		<h1>Oznámenie o vydaní</h1>

		<p>Prosíme, prečítajte si oznámenie o vydaní najnovšej verzie pred tým, ako začnete proces aktualizácie, pretože môžeo bsahovať užitočné informácie. Tento oznam taktiež obsahuje odkazy na stiahnutie a tiež zoznam zmien.</p>

		<br />

		<h1>Ako aktualizovať vašu inštaláciu s plným balíčkom (Full Package)</h1>

		<p>Odporúčame vám aktualizovať vašu inštaláciu pomocou plného balíčka. Ak boli súbory phpBB upravené, pravdepodobne budete potrebovať balík automatickej aktualizácie, aby ste tieto zmeny nestratili. Môžete aktualizovať vašu inštaláciu taktiež inými metódami popísanými v dokumente INSTALL.html. Kroky k aktualizovaniu phpBB3 pomocou plného balíka sú:</p>

		<ol style="margin-left: 20px; font-size: 1.1em;">
			<li><strong class="error">Zálohujte všetky súbory fóra a databázu.</strong></li>
			<li>Choďte na <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">stránku na stiahnutie na phpBB.com</a> a stiahnite si najnovší archív "Full Package".</li>
			<li>Rozbaľte archív.</li>
			<li>Odstráňte (vymažte) <em>z balíčka</em> (nie z vašej stránky) súbor <code class="inline">config.php</code> a adresáre <code class="inline">/images</code>, <code class="inline">/store</code> a <code class="inline">/files</code>.</li>
			<li>Choďte do Administračného panelu, Nastavenia fóra a uistite sa, že prosilver je nastavený ako predvolený štýl. Ak nie je, nastavte ho.</li>
			<li>Vymažte adresáre <code class="inline">/vendor</code> a <code class="inline">/cache</code> z vášho fóra.</li>
			<li>Cez FTP alebo SSH nahrajte zvyšné súbory a adresáre (teda zvyšok OBSAHU adresára phpBB3) do cieľového adresára vašej inštalácie na serveri. Týmto prepíšete existujúce súbory. (Poznámka: dajte si pozor, aby ste pri nahrávaní nevymazali žiadne rozšírenia v adresári <code class="inline">/ext</code>.)</li>
			<li><strong><a href="%1$s" title="%1$s">Teraz začnite proces aktualizácie prejdením do inštalačného adresára</a>.</strong></li>
			<li>Nasledujte kroky na aktualizáciu databázy a nechajte ich zbehnúť až do ukončenia.</li>
			<li>Cez FTP alebo SSH vymažte adresár <code class="inline">/install</code> z koreňového adresára vašej inštalácie na serveri.<br><br></li>
		</ol>
		
		<p>Teraz máte najnovšiu verziu fóra, ktorá obsahuje všetkých vašich používateľov a príspevky. Ďalšie úlohy sú:</p>
		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li>Aktualizujte svoje jazykové balíčky</li>
			<li>Aktualizujte svoje štýly<br><br></li>
		</ul>

		<h1>Ako aktualizovať vašu inštaláciu pomocou balíčka automatickej aktualizácie (Automatic Update Package)</h1>

		<p>Balík automatickej inštalácie je odporúčaný iba v prípade, že súbory phpBB boli vo vašej inštalácii upravené. Môžete aktualizovať vašu inštaláciu taktiež inými metódami popísanými v dokumente INSTALL.html. Kroky k aktualizácii phpBB použitím balíka automatickej inštalácie sú:</p>

		<ol style="margin-left: 20px; font-size: 1.1em;">
			<li>Choďte na <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">stránku stiahnutí na phpBB.com</a> a stiahnite si archív "Automatic Update Package".</li>
			<li>Rozbaľte archív.</li>
			<li>Nahrajte adresáre "install" a "vendor" do koreového adresára vášho phpBB (tam, kde je config.php).<br><br></li>
		</ol>

		<p>Akonáhle nahráte tieto súbory, vaše fórum sa pre normálnych používateľov vypne, keďže je prítomný inštalačný adresár.<br /><br />
		<strong><a href="%1$s" title="%1$s">Teraz začnite proces aktualizácie prejdením do inštalačného adresára</a>.</strong><br />
		<br />
		Cez proces aktualizácie budete vední. Akonáhle sa aktualizácia ukončí, budete o tom upovedomený.
		</p>
	',
));

// Updater forms
$lang = array_merge($lang, array(
	// Updater types
	'UPDATE_TYPE'			=> 'Typ aktualizácie, ktorý sa spustí',

	'UPDATE_TYPE_ALL'		=> 'Aktualizovať súbory a databázu',
	'UPDATE_TYPE_DB_ONLY'	=> 'Aktualizovať iba databázu',

	// File updater methods
	'UPDATE_FILE_METHOD_TITLE'		=> 'Metódy aktualizácie súborov',

	'UPDATE_FILE_METHOD'			=> 'Metóda aktualizácie súborov',
	'UPDATE_FILE_METHOD_DOWNLOAD'	=> 'Stiahnuť aktualizované súbory v archíve',
	'UPDATE_FILE_METHOD_FTP'		=> 'Aktualizovať súbory cez FTP (automaticky)',
	'UPDATE_FILE_METHOD_FILESYSTEM'	=> 'Aktualizovať súbory cez priamy prístup k súborom (automaticky)',

	// File updater archives
	'SELECT_DOWNLOAD_FORMAT'	=> 'Vyberte formát archívu',

	// FTP settings
	'FTP_SETTINGS'			=> 'Nastavenia FTP',
));

// Requirements messages
$lang = array_merge($lang, array(
	'UPDATE_FILES_NOT_FOUND'	=> 'Nebola nájdený žiadny aktualizačný adresár. Prosíme, uistite sa, že ste nahrali správne súbory.',

	'NO_UPDATE_FILES_UP_TO_DATE'	=> 'Vaša verzia je aktuálna. Nie je dôvod spúšťať aktualizačný nástroj. Ak chcete vykonať kontrolu integrity súborov, uistite sa, že ste nahrali správne aktualizačné súbory.',
	'OLD_UPDATE_FILES'				=> 'Aktualizačné súbory sú neaktuálne. Súbory sú pripravené na aktualizáciu phpBB %1$s na phpBB %2$s, ale najnovšia verzia phpBB je %3$s.',
	'INCOMPATIBLE_UPDATE_FILES'		=> 'Nájdené aktualizačné súbory sú nekompatibilné s vami nainštalovanou verziou. Vaša nainštalovaná verzia je %1$s a aktualizačné súbory sú na aktualizáciu z phpBB %2$s na %3$s.',
));

// Update files
$lang = array_merge($lang, array(
	'STAGE_UPDATE_FILES'		=> 'Aktualizovať súbory',

	// Check files
	'UPDATE_CHECK_FILES'	=> 'Skontrolovať súbory na aktualizovanie',

	// Update file differ
	'FILE_DIFFER_ERROR_FILE_CANNOT_BE_READ'	=> 'Nebolo možné nájsť zmeny v súbore %s.',

	'UPDATE_FILE_DIFF'		=> 'Hľadajú sa zmeny v súboroch',
	'ALL_FILES_DIFFED'		=> 'Všetky zmeny v súboroch boli nájdené.',

	// File status
	'UPDATE_CONTINUE_FILE_UPDATE'	=> 'Aktualizovať súbory',

	'DOWNLOAD'							=> 'Stiahnuť',
	'DOWNLOAD_CONFLICTS'				=> 'Stiahnuť archív konfliktov',
	'DOWNLOAD_CONFLICTS_EXPLAIN'		=> 'Vyhľadajte &lt;&lt;&lt; pre objavenie konfliktov',
	'DOWNLOAD_UPDATE_METHOD'			=> 'Stiahnuť archív upravených súborov',
	'DOWNLOAD_UPDATE_METHOD_EXPLAIN'	=> 'Po stiahnutí archív rozbaľte. Nájdete upravené súbory, ktoré je potrebné nahrať do vášho phpBB koreňového adresára. Prosíme, nahrajte súbory do ich presného umiestnenia. Po nahratí všetých súborov môžete pokračovať v aktualizačnom procese.',

	'FILE_ALREADY_UP_TO_DATE'		=> 'Súbor už je v najnovšej verzii',
	'FILE_DIFF_NOT_ALLOWED'			=> 'Súbor nemôže byť zmenený',
	'FILE_USED'						=> 'Informácie použité z',			// Single file
	'FILES_CONFLICT'				=> 'Konfliktné súbory',
	'FILES_CONFLICT_EXPLAIN'		=> 'Nasledujúce súbory boli upravené a nie sú rovnaké ako súbory z predchádzajúcej verzie. phpBB zistilo, že tieto súbory spôsobujú konflikt, keď sa ich pokúsi o ich zlúčenie. Preskúmajte tieto konflikty a skúste ich vyriešiť ručne alebo pokračujte v prechode zvolením metódy pre zlúčenie súborov. Pokiaľ spracujete konflikt ručne, po úpravách skontrolujte súbory znovu. Môžete tiež zvoliť preferovanú metódu zlúčenia pre každý súbor zvlášť. Prvá zlúči oba súbory do jedného, kde konfliktné riadky budú nahradené tými z nového súboru a riadky zo starého súboru budú zmazané, druhá naopak použije riadky zo starého súboru.',
	'FILES_DELETED'					=> 'Zmazané súbory',
	'FILES_DELETED_EXPLAIN'			=> 'Nasledujúce súbory v novej verzii neexistujú. Tieto súbory musíte z vašej inštalácie zmazať.',
	'FILES_MODIFIED'				=> 'Upravené súbory',
	'FILES_MODIFIED_EXPLAIN'		=> 'Nasledujúce súbory boli upravené a nie sú rovnaké ako súbory z predchádzajúcej verzie. Aktualizovaný súbor bude výsledok vašich úprav a nového súboru.',
	'FILES_NEW'						=> 'Nové súbory',
	'FILES_NEW_EXPLAIN'				=> 'Nasledujúce súbory zatiaľ neexistujú vo vašej inštalácii. Tieto súbory budú pridané do inštalácie.',
	'FILES_NEW_CONFLICT'			=> 'Nové konfliktné súbory',
	'FILES_NEW_CONFLICT_EXPLAIN'	=> 'Nasledujúce súbory sú nové v poslednej verzii, ale rovnaký súbor s rovnakým menom už vo vašej inštalácii existuje. Tento súbor bude nahradený novým.',
	'FILES_NOT_MODIFIED'			=> 'Neupravené súbory',
	'FILES_NOT_MODIFIED_EXPLAIN'	=> 'Nasledujúce súbory neboli upravené a sú rovnaké ako súbory v predchádzajúcej verzii. Budú prepísané aktuálnymi.',
	'FILES_UP_TO_DATE'				=> 'Už aktualizované súbory',
	'FILES_UP_TO_DATE_EXPLAIN'		=> 'Tieto súbory sú už v aktuálnej verzii a preto nemusia byť zaktualizované.',
	'FILES_VERSION'					=> 'Verzia súborov',
	'TOGGLE_DISPLAY'				=> 'Zobraziť/skryť zoznam súborov',

	// File updater
	'UPDATE_UPDATING_FILES'	=> 'Aktualizovanie súborov',

	'UPDATE_FILE_UPDATER_HAS_FAILED'	=> 'Aktualizovanie pomocou “%1$s“ zlyhalo. Inštalátor skúsi namiesto toho použiť “%2$s“.',
	'UPDATE_FILE_UPDATERS_HAVE_FAILED'	=> 'Aktualizovanie súborov zlyhalo. Už nie sú dostupné žiadne iné metódy.',

	'UPDATE_CONTINUE_UPDATE_PROCESS'	=> 'Pokračovať v procese aktualizácie',
	'UPDATE_RECHECK_UPDATE_FILES'		=> 'Skontrolovať súbory nanovo',
));

// Update database
$lang = array_merge($lang, array(
	'STAGE_UPDATE_DATABASE'		=> 'Aktualizovať databázu',

	'INLINE_UPDATE_SUCCESSFUL'		=> 'Aktualizácie databázy bola úspešná.',

	'TASK_UPDATE_EXTENSIONS'	=> 'Aktualizovanie rozšírení',
));

// Converter
$lang = array_merge($lang, array(
	// Common converter messages
	'CONVERT_NOT_EXIST'			=> 'Zvolený konvertor neexistuje',
	'DEV_NO_TEST_FILE'			=> 'Nebola zadaná žiadna hodnota pre premennú test_file v konvertore. Pokiaľ ste užívateľ tohto konvertoru, mali by ste toto nahlásiť autorovi tohto modulu. Pokiaľ ste autor tohto modulu musíte špecifikovať súbor, ktorý existuje v zdrojovom fóre, pre overenie cesty k nemu.',
	'COULD_NOT_FIND_PATH'		=> 'Nedá sa nájsť cesta k bývalému fóru. Skontrolujte vaše nastavenia a skúste znovu.<br />» Zadaná cesta bola %s',
	'CONFIG_PHPBB_EMPTY'		=> 'Konfiguračná premenná phpBB3 “%s” je prázdna.',

	'MAKE_FOLDER_WRITABLE'		=> 'Prosím skontrolujte či táto zložka existuje a či má webserver právo na zápis do nej a skúste znovu:<br />»<strong>%s</strong>',
	'MAKE_FOLDERS_WRITABLE'		=> 'Prosím skontrolujte či tieto zložky existujú a či má webserver právo na zápis do nich a skúste znovu:<br />»<strong>%s</strong>',

	'INSTALL_TEST'				=> 'Otestovať znovu',

	'NO_TABLES_FOUND'			=> 'Neboli nájdené žiadne tabuľky.',
	'TABLES_MISSING'			=> 'Nedajú sa nájsť tieto tabuľky<br />» <strong>%s</strong>.',
	'CHECK_TABLE_PREFIX'		=> 'Prosím skontrolujte Vašu predponu tabuliek a akciu opakujte.',

	// Conversion in progress
	'CONTINUE_CONVERT'			=> 'Pokračovať v prenose',
	'CONTINUE_CONVERT_BODY'		=> 'Bol detekovaný predchádzajúci pokus o prechod na inú verziu. Teraz si môžete vybrať medzi novým pokusom alebo pokračovaním v predchádzajúcom.',
	'CONVERT_NEW_CONVERSION'	=> 'Nová konverzia',
	'CONTINUE_OLD_CONVERSION'	=> 'Pokračovať v predchádzajúcom pokuse',

	// Start conversion
	'SUB_INTRO'					=> 'Úvod',
	'CONVERT_INTRO'				=> 'Vitajte v phpBB Univerzálny Konvertor Framework',
	'CONVERT_INTRO_BODY'		=> 'Odtiaľto môžete importovať dáta z iných (inštalovaných) systémov pre fóra. Zoznam dole uvádza všetky momentálne dostupné moduly pre prechod. Pokiaľ konvertor z verzie, ktorú hľadáte, nie je v zozname, skúste navštíviť naše stránky, kde môžu byť ďalšie moduly dostupné k stiahnutiu.',
	'AVAILABLE_CONVERTORS'		=> 'Dostupné konvertory',
	'NO_CONVERTORS'				=> 'Nie sú dostupné žiadne konvertory k použitiu',
	'CONVERT_OPTIONS'			=> 'Možnosti',
	'SOFTWARE'					=> 'Systém fóra',
	'VERSION'					=> 'Verzia',
	'CONVERT'					=> 'Preniesť',

	// Settings
	'STAGE_SETTINGS'			=> 'Nastavenia',
	'TABLE_PREFIX_SAME'			=> 'Predpona tabuliek musí byť rovnaká ako je použitá softvérom z ktorého prenášate fórum.<br />» Zvolená predpona tabuliek bola %s',
	'DEFAULT_PREFIX_IS'			=> 'Východzia predpona databázových tabuliek pre %1$s je <strong>%2$s</strong>',
	'SPECIFY_OPTIONS'			=> 'Špecifikujte možnosti prenosu',
	'FORUM_PATH'				=> 'Cesta k fóru',
	'FORUM_PATH_EXPLAIN'		=> 'Toto je <strong>relatívna</strong> cesta na disku k vášmu bývalému fóru <strong>so základnými zložkami phpBB inštalácie</strong>',
	'REFRESH_PAGE'				=> 'Aktualizujte stránku pre pokračovanie v prechode',
	'REFRESH_PAGE_EXPLAIN'		=> 'Pokiaľ je nastavené na áno, konvertor aktualizuje stránku pre pokračovanie v prechode po skončený tohto kroku. Pokiaľ je toto vaše prvé konvertovanie pre testovacie účely a zistenie všetkých chýb vopred, doporučujeme nastaviť na nie.',

	// Conversion
	'STAGE_IN_PROGRESS'			=> 'Konvertovanie spustené',
	
	'AUTHOR_NOTES'				=> 'Poznámka autora<br />» %s',
	'STARTING_CONVERT'			=> 'Zahajujem proces konvertovania',
	'CONFIG_CONVERT'			=> 'Prenesenie konfigurácie',
	'DONE'						=> 'Hotovo',
	'PREPROCESS_STEP'				=> 'Spúšťam prípravné funkcie/overenia',
	'FILLING_TABLE'				=> 'Naplňujem tabuľku <strong>%s</strong>',
	'FILLING_TABLES'			=> 'Naplňovanie tabuliek',
	'DB_ERR_INSERT'				=> 'Chyba pri spracovávaní <code>INSERT</code> príkazu',
	'DB_ERR_LAST'				=> 'Chyba pri spracovávaní <var>query_last</var>',
	'DB_ERR_QUERY_FIRST'		=> 'Chyba pri vykonávaní <var>query_first</var>',
	'DB_ERR_QUERY_FIRST_TABLE'	=> 'Chyba pri vykonávaní <var>query_first</var>, %s (“%s”)',
	'DB_ERR_SELECT'				=> 'Chyba pri priebehu <code>SELECT</code> príkazu',
	'STEP_PERCENT_COMPLETED'	=> 'Krok <strong>%d</strong> z <strong>%d</strong>',
	'FINAL_STEP'				=> 'Spracovať posledný krok',
	'SYNC_FORUMS'				=> 'Začína synchronizácia fór',
	'SYNC_POST_COUNT'			=> 'Synchronizovanie počtu príspevkov',
	'SYNC_POST_COUNT_ID'		=> 'Synchronizovanie počtu príspevkov od <var>záznamu</var> %1$s do %2$s.',
	'SYNC_TOPICS'				=> 'Začína synchronizácia tém',
	'SYNC_TOPIC_ID'				=> 'Synchronizujú sa témy od topic_id %1$s do %2$s',
	'PROCESS_LAST'					=> 'Spracovávam posledné príkazy',
	'UPDATE_TOPICS_POSTED'		=> 'Generujem informácie o odoslaných témach',
	'UPDATE_TOPICS_POSTED_ERR'	=> 'Objavila sa chyba počas generovania informácii o odoslaných témach. Môžete sa pokúsiť opakovať tento krok cez administráciu (ACP) po skončení konvertovania.',
	'CONTINUE_LAST'				=> 'Pokračovať posledným príkazom',
	'CLEAN_VERIFY'				=> 'Čistenie a overovanie konečnej štruktúry',
	'NOT_UNDERSTAND'			=> 'Nie je zrozumiteľné %s #%d, tabuľka %s (“%s”)',
	'NAMING_CONFLICT'			=> 'Konflikt v názvoch: %s a %s sú oba aliasy<br /><br />%s',
	
	// Finish conversion
	'CONVERT_COMPLETE'			=> 'Konverzia je kompletná',
	'CONVERT_COMPLETE_EXPLAIN'	=> 'Úspešne ste konvertovali vaše fórum na phpBB 3.2. Teraz sa môžete prihlásiť a <a href="../">používať vaše fórum</a>. Prosíme, uistite sa, že nastavenia boli správne prenesené ešte predtým, ako sprístupníte fórum vymazaním inštalačného adresára. Pamätajte na to, že pomoc s používaním phpBB je dostupná online cez <a href="https://www.phpbb.com/support/docs/en/3.3/ug/">dokumentáciu</a> a <a href="https://www.phpbb.com/community/viewforum.php?f=466">fóra podpory</a>.',

	'CONV_ERROR_ATTACH_FTP_DIR'			=> 'FTP upload je povolený na starom fóre. Vypnete prosím túto možnosť a skontrolujte či existuje platná zložka pre upload. Potom skopírujte všetky prílohy do tejto, z webu prístupnej zložky. Keď to urobíte reštartujte konvertor.',
	'CONV_ERROR_CONFIG_EMPTY'			=> 'Nie sú dostupné žiadne konfiguračné informácie pre prechod.',
	'CONV_ERROR_FORUM_ACCESS'			=> 'Nie je možné získať informácie o prístupe na fórum.',
	'CONV_ERROR_GET_CATEGORIES'			=> 'Nedá sa získať kategória.',
	'CONV_ERROR_GET_CONFIG'				=> 'Nedá sa získať nastavenie fóra.',
	'CONV_ERROR_COULD_NOT_READ'			=> 'Nedá sa získať prístu k (nedá sa čítať) “%s”.',
	'CONV_ERROR_GROUP_ACCESS'			=> 'Nedajú sa získať oprávnenia skupín.',
	'CONV_ERROR_INCONSISTENT_GROUPS'	=> 'Bola zistená nestálosť v tabuľke skupín add_bots() - musíte pridať všetky špeciálne skupiny, pokiaľ to budete robiť ručne.',
	'CONV_ERROR_INSERT_BOT'				=> 'Nedá sa vložiť bot do tabuľky užívateľov.',
	'CONV_ERROR_INSERT_BOTGROUP'		=> 'Nedá sa vložiť bot do tabuľky botov.',
	'CONV_ERROR_INSERT_USER_GROUP'		=> 'Nedá sa vložiť užívateľ do user_group tabuľky.',
	'CONV_ERROR_MESSAGE_PARSER'			=> 'Chyba v parseri správ',
	'CONV_ERROR_NO_AVATAR_PATH'			=> 'Poznámka pre vývojárov: musíte špecifikovať $convertor[\'avatar_path\'] pre použitie %s.',
	'CONV_ERROR_NO_FORUM_PATH'			=> 'Relatívna cesta k zdrojovému fóru nebola špecifikovaná.',
	'CONV_ERROR_NO_GALLERY_PATH'		=> 'Poznámka pre vývojárov: musíte špecifikovať $convertor[\'avatar_gallery_path\'] pre použitie %s.',
	'CONV_ERROR_NO_GROUP'				=> 'Skupina “%1$s” nebola nájdená v %2$s.',
	'CONV_ERROR_NO_RANKS_PATH'			=> 'Poznámka pre vývojárov: musíte špecifikovať $convertor[\'ranks_path\'] pre použitie %s.',
	'CONV_ERROR_NO_SMILIES_PATH'		=> 'Poznámka pre vývojárov: musíte špecifikovať $convertor[\'smilies_path\'] pre použitie %s.',
	'CONV_ERROR_NO_UPLOAD_DIR'			=> 'Poznámka pre vývojárov: musíte špecifikovať $convertor[\'upload_dir\'] pre použitie %s.',
	'CONV_ERROR_PERM_SETTING'			=> 'Nedajú sa vložiť/aktualizovať nastavenia oprávnení.',
	'CONV_ERROR_PM_COUNT'				=> 'Nedá sa vybrať zložka pre súčet súkromných správ.',
	'CONV_ERROR_REPLACE_CATEGORY'		=> 'Nedá sa vložiť nové fórum nahradzujúce starú kategóriu.',
	'CONV_ERROR_REPLACE_FORUM'			=> 'Nedá sa vložiť nové fórum nahradzujúce staré fórum.',
	'CONV_ERROR_USER_ACCESS'			=> 'Nedajú sa získať informácie o oprávneniach užívateľov.',
	'CONV_ERROR_WRONG_GROUP'			=> 'Zlá skupina “%1$s” definovaná v %2$s.',
	'CONV_OPTIONS_BODY'					=> 'Táto stránka zhromažďuje všetky dáta nutné pre prístup k zdrojovému fóru. Vyplňte údaje databázy starého fóra, konvertor nebude v pôvodnej databáze nič meniť. Zdrojové fórum by malo byť vypnuté pre zaistenie konzistentného prechodu.',
	'CONV_SAVED_MESSAGES'				=> 'Uložené správy',

	'PRE_CONVERT_COMPLETE'			=> 'Všetky prípravné kroky pred konvertovaním boli úspešne dokončené. Teraz môžete začať s prechodom.',
));
