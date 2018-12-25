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

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'CLI_CONFIG_CANNOT_CACHED'			=> 'Nastavte túto možnosť, pokiaľ se konfiguracia mení príliš často na to, aby sa oplatilo ju držať v medzipamäti..',
	'CLI_CONFIG_CURRENT'				=> 'Súčasná konfiguračná hodnota, použite 0 a 1 k určeniu bivalencie',
	'CLI_CONFIG_DELETE_SUCCESS'			=> 'Konfigurácia %s úspešne vymazaná.',
	'CLI_CONFIG_NEW'					=> 'Nová konfiguračná hodnota, použite 0 a 1 k určeniu bivalencie',
	'CLI_CONFIG_NOT_EXISTS'				=> 'Konfigurácia %s neexistuje',
	'CLI_CONFIG_OPTION_NAME'			=> 'Názov konfiguračnej možnosti',
	'CLI_CONFIG_PRINT_WITHOUT_NEWLINE'	=> 'Nastavte túto možnosť, ak má byť hodnota vytlačená bez nového riadka na konci.',
	'CLI_CONFIG_INCREMENT_BY'			=> 'Zvýšiť hodnotu o',
	'CLI_CONFIG_INCREMENT_SUCCESS'		=> 'Konfigurácia %s úspešne zvýšená',
	'CLI_CONFIG_SET_FAILURE'			=> 'Konfigurácia %s nemôže byť nastavená',
	'CLI_CONFIG_SET_SUCCESS'			=> 'Konfigurácia %s úspešne nastavená',

	'CLI_DESCRIPTION_CRON_LIST'					=> 'Zobrazí zoznam pripravených a nepripravených úloh pre cron.',
	'CLI_DESCRIPTION_CRON_RUN'					=> 'Spustí všetky pripravené úlohy pre cron.',
	'CLI_DESCRIPTION_CRON_RUN_ARGUMENT_1'		=> 'Názov úlohy, ktorá má byť spustená',
	'CLI_DESCRIPTION_DB_LIST'					=> 'Vypíše všetky nainštalované a dostupné migrácie.',
	'CLI_DESCRIPTION_DB_MIGRATE'				=> 'Aktualizuje databázu aplikovaním migrácií.',
	'CLI_DESCRIPTION_DB_REVERT'					=> 'Vráti migráciu.',
	'CLI_DESCRIPTION_DELETE_CONFIG'				=> 'Zmaže konfiguračnú možnosť',
	'CLI_DESCRIPTION_DISABLE_EXTENSION'			=> 'Zakáže určené rozšírenie.',
	'CLI_DESCRIPTION_ENABLE_EXTENSION'			=> 'Povolí určené rozšírenie.',
	'CLI_DESCRIPTION_FIND_MIGRATIONS'			=> 'Nájde migrácie, na ktorých nie je závislá.',
	'CLI_DESCRIPTION_FIX_LEFT_RIGHT_IDS'		=> 'Opraví štruktúru stromov fór a modulov.',
	'CLI_DESCRIPTION_GET_CONFIG'				=> 'Získa hodnotu konfiguračnej možnosti',
	'CLI_DESCRIPTION_INCREMENT_CONFIG'			=> 'Zvýši číselnú hodnotu konfiguračnej možnosti',
	'CLI_DESCRIPTION_LIST_EXTENSIONS'			=> 'Zobrazí všetky rozšírenia v databáze a súborovom systéme.',

	'CLI_DESCRIPTION_OPTION_ENV'				=> 'Meno prostredia.',
	'CLI_DESCRIPTION_OPTION_SAFE_MODE'			=> 'Spustiť v bezpečnom režime (bez rozšírení).',
	'CLI_DESCRIPTION_OPTION_SHELL'				=> 'Spustiť shell.',

	'CLI_DESCRIPTION_PURGE_EXTENSION'			=> 'Prečistiť rozšírenie.',

	'CLI_DESCRIPTION_REPARSER_LIST'						=> 'Vypíše typy textu, ktoré môžu byť reparsované.',
	'CLI_DESCRIPTION_REPARSER_AVAILABLE'				=> 'Dostupné reparsovania:',
	'CLI_DESCRIPTION_REPARSER_REPARSE'					=> 'Reparsuje uložené texty s aktuálnou text_formatter službou.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_ARG_1'			=> 'Typ textu na reparsovanie. Nechajte prázdne pre reparsovanie všetkého.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_DRY_RUN'		=> 'Neuloží žiadne zmeny; iba vypíše čo by sa stalo',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MIN'	=> 'Najnižšie ID záznamu na spracovanie',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MAX'	=> 'Najvyššie ID záznamu na spracovanie',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_SIZE'	=> 'Približný počet záznamov, ktoré sa spracujú ja jednu jednotku času',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RESUME'		=> 'Začať reparsovať tam, kde posledné reparsovanie skončilo',

	'CLI_DESCRIPTION_RECALCULATE_EMAIL_HASH'			=> 'Prepočítať stĺpec user_email_hash tabuľky užívateľov.',

	'CLI_DESCRIPTION_SET_ATOMIC_CONFIG'					=> 'Nastaví hodnotu konfiguračnej možnosti, len ak je zhodná so súčasnou hodnotou',
	'CLI_DESCRIPTION_SET_CONFIG'						=> 'Nastaví hodnotu konfiguračnej možnosti',

	'CLI_DESCRIPTION_THUMBNAIL_DELETE'					=> 'Vymazať všetky existujúce náhľady.',
	'CLI_DESCRIPTION_THUMBNAIL_GENERATE'				=> 'Generovať všetky chýbajúce náhľady.',
	'CLI_DESCRIPTION_THUMBNAIL_RECREATE'				=> 'Znovu vytvoriť všetky náhľady.',

	'CLI_DESCRIPTION_UPDATE_CHECK'					=> 'Skontrolovať, či je fórum aktuálne.',
	'CLI_DESCRIPTION_UPDATE_CHECK_ARGUMENT_1'		=> 'Názov rozšírenia na skontrolovanie (ak je zadané all, skontrolujú sa všetky rozšírenia)',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_CACHE'		=> 'Spustiť príkaz s cache.',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_STABILITY'	=> 'Spustiť príkaz s kontrolou iba stabilných alebo nestabilných verzií.',

	'CLI_DESCRIPTION_UPDATE_HASH_BCRYPT'		=> 'Aktualizuje zastaralé heslá a zahashuje ich použitím bcrypt.',

	'CLI_ERROR_INVALID_STABILITY' => '"%s" musí byť nastavené na "stable" alebo "unstable".',

	'CLI_DESCRIPTION_USER_ACTIVATE'				=> 'Aktivuje (alebo deaktivuje) používateľský účet.',
	'CLI_DESCRIPTION_USER_ACTIVATE_USERNAME'	=> 'Používateľské meno účtu na aktivovanie.',
	'CLI_DESCRIPTION_USER_ACTIVATE_DEACTIVATE'	=> 'Deaktivovať používateľský účet',
	'CLI_DESCRIPTION_USER_ACTIVATE_ACTIVE'		=> 'Používateľ už je aktivovaný.',
	'CLI_DESCRIPTION_USER_ACTIVATE_INACTIVE'	=> 'Používateľ už je deaktivovaný.',
	'CLI_DESCRIPTION_USER_ADD'					=> 'Pridať nového používateľa.',
	'CLI_DESCRIPTION_USER_ADD_OPTION_USERNAME'	=> 'Používateľské meno nového používateľa',
	'CLI_DESCRIPTION_USER_ADD_OPTION_PASSWORD'	=> 'Heslo nového používateľa',
	'CLI_DESCRIPTION_USER_ADD_OPTION_EMAIL'		=> 'Emailová adresa nového používateľa',
	'CLI_DESCRIPTION_USER_ADD_OPTION_NOTIFY'	=> 'Poslať aktivačný email novému používateľovi (predvolene sa neposiela)',
	'CLI_DESCRIPTION_USER_DELETE'				=> 'Vymazať používateľský účet.',
	'CLI_DESCRIPTION_USER_DELETE_USERNAME'		=> 'Používateľské meno účtu na vymazanie',
	'CLI_DESCRIPTION_USER_DELETE_OPTION_POSTS'	=> 'Vymazať všetky príspevky používateľa. Bez tejto možnosti budú používateľove príspevky zachované.',
	'CLI_DESCRIPTION_USER_RECLEAN'				=> 'Prečistiť používateľské mená.',

	'CLI_EXTENSION_DISABLE_FAILURE'		=> 'Nebolo možné zakázať rozšírenie %s',
	'CLI_EXTENSION_DISABLE_SUCCESS'		=> 'Rozšírenie %s zakázané',
	'CLI_EXTENSION_DISABLED'			=> 'Rozšírenie %s nie je povolené',
	'CLI_EXTENSION_ENABLE_FAILURE'		=> 'Nebolo možné povoliť rozšírenie %s',
	'CLI_EXTENSION_ENABLE_SUCCESS'		=> 'Rozšírenie %s povolené',
	'CLI_EXTENSION_ENABLED'				=> 'Rozšírenie %s už je povolené',
	'CLI_EXTENSION_NOT_EXIST'			=> 'Rozšírenie %s neexistuje',
	'CLI_EXTENSION_NAME'				=> 'Názov rozšírenia',
	'CLI_EXTENSION_PURGE_FAILURE'		=> 'Nebolo možné prečistiť rozšírenie %s',
	'CLI_EXTENSION_PURGE_SUCCESS'		=> 'Rozšírenie %s prečistené',
	'CLI_EXTENSION_UPDATE_FAILURE'		=> 'Nebolo možné aktualizovať rozšírenie %s',
	'CLI_EXTENSION_UPDATE_SUCCESS'		=> 'Úspešne aktualizované rozšírenie %s',
	'CLI_EXTENSION_NOT_FOUND'			=> 'Žiadne rozšírenia neboli nájdené.',
	'CLI_EXTENSION_NOT_ENABLEABLE'		=> 'Rozšírenie %s nie je možné povoliť.',
	'CLI_EXTENSIONS_AVAILABLE'			=> 'Dostupné',
	'CLI_EXTENSIONS_DISABLED'			=> 'Zakázané',
	'CLI_EXTENSIONS_ENABLED' 			=> 'Povolené',

	'CLI_FIXUP_FIX_LEFT_RIGHT_IDS_SUCCESS'		=> 'Bezpečne opravené štruktúry stromov fór a modulov.',
	'CLI_FIXUP_RECALCULATE_EMAIL_HASH_SUCCESS'	=> 'Všetky hashe e-mailov úspešne prepočítané.',
	'CLI_FIXUP_UPDATE_HASH_BCRYPT_SUCCESS'		=> 'Úspešne aktualizované heslá použitím bcrypt.',

	'CLI_MIGRATION_NAME'					=> 'Názov migrácie, vrátane menného priestoru (pre predídenie problémov, použite lomítko namiesto obráteného lomítka).',
	'CLI_MIGRATIONS_AVAILABLE'				=> 'Dostupné migrácie',
	'CLI_MIGRATIONS_INSTALLED'				=> 'Nainštalované migrácie',
	'CLI_MIGRATIONS_ONLY_AVAILABLE'		    => 'Zobraziť iba dostupné migrácie',
	'CLI_MIGRATIONS_EMPTY'                  => 'Žiadne migrácie.',

	'CLI_REPARSER_REPARSE_REPARSING'		=> 'Reparsuje sa %1$s (rozsah %2$d..%3$d)',
	'CLI_REPARSER_REPARSE_REPARSING_START'	=> 'Reparsuje sa %s...',
	'CLI_REPARSER_REPARSE_SUCCESS'			=> 'Reparsovanie skončilo úspechom',

	// In all the case %1$s is the logical name of the file and %2$s the real name on the filesystem
	// eg: big_image.png (2_a51529ae7932008cf8454a95af84cacd) generated.
	'CLI_THUMBNAIL_DELETED'		=> '%1$s (%2$s) vymazaný.',
	'CLI_THUMBNAIL_DELETING'	=> 'Vymazávanie náhľadov',
	'CLI_THUMBNAIL_SKIPPED'		=> '%1$s (%2$s) preskočený.',
	'CLI_THUMBNAIL_GENERATED'	=> '%1$s (%2$s) vygenerovaný.',
	'CLI_THUMBNAIL_GENERATING'	=> 'Generovanie náhľadov',
	'CLI_THUMBNAIL_GENERATING_DONE'	=> 'Všetky náhľady boli opätovne generované.',
	'CLI_THUMBNAIL_DELETING_DONE'	=> 'Všetky náhľady boli vymazané.',

	'CLI_THUMBNAIL_NOTHING_TO_GENERATE'	=> 'Nie sú dostupné žiadne náhľady na generovanie.',
	'CLI_THUMBNAIL_NOTHING_TO_DELETE'	=> 'Nie sú dostupné žiadne náhľady na vymazanie.',

	'CLI_USER_ADD_SUCCESS'		=> 'Úspešne pridaný používateľ %s.',
	'CLI_USER_DELETE_CONFIRM'	=> 'Ste si istý, že chcete odstrániť používateľa ‘%s’? [y/N]',
	'CLI_USER_RECLEAN_START'	=> 'Prečisťovanie používateľských mien',
	'CLI_USER_RECLEAN_DONE'		=> [
		0	=> 'Prečisťovanie dokončené. Žiadne používateľské mená nebolo nutné prečistiť.',
		1	=> 'Prečisťovanie dokončené. %d používateľské meno bolo prečistené.',
		2	=> 'Prečisťovanie dokončené. %d používateľské mená boli prečistené.',
		3	=> 'Prečisťovanie dokončené. %d používateľských mien bolo prečistených.',
	],
));

// Additional help for commands.
$lang = array_merge($lang, array(
	'CLI_HELP_CRON_RUN'			=> $lang['CLI_DESCRIPTION_CRON_RUN'] . ' Prípadne môžete špecifikovať meno cron úlohy pre spustenie len zadanej cron úlohy.',
	'CLI_HELP_USER_ACTIVATE'	=> 'Aktivuje používateľský účet alebo deaktivuje účet použítím možnosti <info>--deactivate</info>.
Pre voliteľné zaslanie aktivačného emailu novému používateľovi, použite možnosť <info>--send-email</info>.',
	'CLI_HELP_USER_ADD'			=> 'Príkaz <info>%command.name%</info> pridá nového používateľa:
Ak je tento príkaz spustený bez možností, budete vyzvaní k ich vyplneniu.
Pre voliteľné zaslanie aktivačného emailu novému používateľovi, použite možnosť <info>--send-email</info>.',
	'CLI_HELP_USER_RECLEAN'		=> 'Prečistenie používateľských mien skontroluje všetky uložené používateľské mená a uistí sa, že sú uložené aj prečistené verzie mien. Prečistené používateľské mená ignorujú veľkosť písmen, sú NFC normalizované a transformované do ASCII.',
));
