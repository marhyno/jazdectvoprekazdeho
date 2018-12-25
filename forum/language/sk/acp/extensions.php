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
	'EXTENSION'					=> 'Rozšírenie',
	'EXTENSIONS'				=> 'Rozšírenia',
	'EXTENSIONS_ADMIN'			=> 'Správca rozšírení',
	'EXTENSIONS_EXPLAIN'		=> 'Správca rozšírení je nástroj vášho phpBB fóra, ktorý vám umožňuje spravovať všetky rozšírenia a prezerať informácie o nich.',
	'EXTENSION_INVALID_LIST'	=> 'Rozšírenie “%s” nie je platné.<br />%s<br /><br />',
	'EXTENSION_NOT_AVAILABLE'	=> 'Vybrané rozšírenie nie je pre vaše fórum dostupné. Prosíme, overte vaše phpBB a PHP verzie (pozrite na stránku s detailami).',
	'EXTENSION_DIR_INVALID'		=> 'Vybrané rozšírenie nemá platnú štruktúru adresárov, a preto nemôže byť nainštalované.',
	'EXTENSION_NOT_ENABLEABLE'	=> 'Vybrané rozšírenie nemôže byť povolené, prosíme overte požiadavky rozšírenia.',
	'EXTENSION_NOT_INSTALLED'	=> 'Rozšírenie %s nie je dostupné. Prosíme, skontrolujte, či ste ho nainštalovali správne.',

	'DETAILS'				=> 'Detaily',

	'EXTENSIONS_DISABLED'	=> 'Zakázané rozšírenia',
	'EXTENSIONS_ENABLED'	=> 'Povolené rošírenia',

	'EXTENSION_DELETE_DATA'	=> 'Vymazať údaje',
	'EXTENSION_DISABLE'		=> 'Zakázať',
	'EXTENSION_ENABLE'		=> 'Povoliť',

	'EXTENSION_DELETE_DATA_EXPLAIN'	=> 'Vymazaním údajov rozšírenia odstránite všetky jeho údaje a nastavenia. Súbory rozšírenia ostanú, takže ho môžete opäť povoliť.',
	'EXTENSION_DISABLE_EXPLAIN'		=> 'Zakázaním rozšírenia zachováte jeho súbory, údaje a nastavenia, no vypnete jeho funkcionalitu.',
	'EXTENSION_ENABLE_EXPLAIN'		=> 'Povolením rozšírenia aktivujete jeho funkcionalitu na vašom fóre.',

	'EXTENSION_DELETE_DATA_IN_PROGRESS'	=> 'Údaje rozšírenia sa práve odstraňujú. Prosíme, neodchádzajte ani neobnovujte túto stránku, kým sa mazanie nedokončí.',
	'EXTENSION_DISABLE_IN_PROGRESS'	=> 'Rozšírenie sa práve zakazuje. Prosíme, neodchádzajte ani neobnovujte túto stránku, kým sa zakazovanie nedokončí.',
	'EXTENSION_ENABLE_IN_PROGRESS'	=> 'Rozšírenie sa práve povoľuje. Prosíme, neodchádzajte ani neobnovujte túto stránku, kým sa povoľovanie nedokončí.',

	'EXTENSION_DELETE_DATA_SUCCESS'	=> 'Údaje rozšírenia boli úspešne vymazané',
	'EXTENSION_DISABLE_SUCCESS'		=> 'Rozšírenie bolo úspešne zakázané',
	'EXTENSION_ENABLE_SUCCESS'		=> 'Rozšírenie bolo úspešne povolené',

	'EXTENSION_NAME'			=> 'Názov rozšírenia',
	'EXTENSION_ACTIONS'			=> 'Akcie',
	'EXTENSION_OPTIONS'			=> 'Možnosti',
	'EXTENSION_INSTALL_HEADLINE'=> 'Inštalovanie rozšírenia',
	'EXTENSION_INSTALL_EXPLAIN'	=> '<ol>
			<li>Stiahnite rozšírenie z databázy phpBB rozšírení</li>
			<li>Rozbaľte rozšírenie a nahrajte ho do <samp>ext/</samp> priečinka vášho phpBB fóra</li>
			<li>Povoľte rozšírenie tu, v Správcovi rozšírení</li>
		</ol>',
	'EXTENSION_UPDATE_HEADLINE'	=> 'Aktualizácia rozšírenia',
	'EXTENSION_UPDATE_EXPLAIN'	=> '<ol>
			<li>Zakážte rozšírenie</li>
			<li>Vymažte súbory rozšírenia</li>
			<li>Nahrajte nové súbory</li>
			<li>Povoľte rozšírenie</li>
		</ol>',
	'EXTENSION_REMOVE_HEADLINE'	=> 'Kompletné odstránenie rozšírenia z vášho fóra',
	'EXTENSION_REMOVE_EXPLAIN'	=> '<ol>
			<li>Zakážte rozšírenie</li>
			<li>Vymažte údaje rozšírenia</li>
			<li>Vymažte súbory rozšírenia</li>
		</ol>',

	'EXTENSION_DELETE_DATA_CONFIRM'	=> 'Ste si istý, že chcete odstrániť všetky údaje spojené s “%s”?<br /><br />Odstránite tým všetky jeho údaje a nastavenia a nebude možné ich vrátiť späť!',
	'EXTENSION_DISABLE_CONFIRM'		=> 'Ste si istý, že chcete zakázať rozšírenie “%s”?',
	'EXTENSION_ENABLE_CONFIRM'		=> 'Ste si istý, že chcete povoliť rozšírenie “%s”?',
	'EXTENSION_FORCE_UNSTABLE_CONFIRM'	=> 'Ste si istý, že chcete vynútiť použitie nestabilnej verzie??',

	'RETURN_TO_EXTENSION_LIST'	=> 'Návrat na zoznam rozšírení',

	'EXT_DETAILS'			=> 'Detaily rozšírenia',
	'DISPLAY_NAME'			=> 'Zobrazované meno',
	'CLEAN_NAME'			=> 'Vyčistené meno',
	'TYPE'					=> 'Typ',
	'DESCRIPTION'			=> 'Popis',
	'VERSION'				=> 'Verzia',
	'HOMEPAGE'				=> 'Domovská stránka',
	'PATH'					=> 'Cesta k súboru',
	'TIME'					=> 'Dátum vydania',
	'LICENSE'				=> 'Licencia',

	'REQUIREMENTS'			=> 'Požiadavky',
	'PHPBB_VERSION'			=> 'phpBB verzia',
	'PHP_VERSION'			=> 'PHP verzia',
	'AUTHOR_INFORMATION'	=> 'Informácie o autorovi',
	'AUTHOR_NAME'			=> 'Meno',
	'AUTHOR_EMAIL'			=> 'Email',
	'AUTHOR_HOMEPAGE'		=> 'Domovská stránka',
	'AUTHOR_ROLE'			=> 'Rola',

	'NOT_UP_TO_DATE'		=> '%s nie je aktuálne',
	'UP_TO_DATE'			=> '%s je aktuálne',
	'ANNOUNCEMENT_TOPIC'	=> 'Oznámenie o vydaní',
	'DOWNLOAD_LATEST'		=> 'Stiahnuť verziu',
	'NO_VERSIONCHECK'		=> 'Nebola poskytnutá žiadna informácie o kontrole verzie.',

	'VERSIONCHECK_FORCE_UPDATE_ALL'		=> 'Prekontrolovať všetky verzie',
	'FORCE_UNSTABLE'					=> 'Vždy kontrolovať nestabilné verzie',
	'EXTENSIONS_VERSION_CHECK_SETTINGS'	=> 'Nastavenia kontroly verzie',

	'BROWSE_EXTENSIONS_DATABASE'		=> 'Prehliadať databázu rozšírení',

	'META_FIELD_NOT_SET'	=> 'Požadované meta pole %s nebolo nastavené.',
	'META_FIELD_INVALID'	=> 'Meta pole %s je neplatné.',
));
