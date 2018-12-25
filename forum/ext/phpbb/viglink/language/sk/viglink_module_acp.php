<?php
/**
 *
 * VigLink extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_VIGLINK_SETTINGS'			=> 'VigLink nastavenia',
	'ACP_VIGLINK_SETTINGS_EXPLAIN'	=> 'VigLink je služba tretej strany, ktorá diskrétne speňažní odkazy v príspevkoch používateľov na vašom fóre bez akejkoľvek zmeny v ich používaní. Keď používateľ klikne na odkaz nejakého produktu alebo služby a zakúpi ju, predajca vyplatí VigLinku províziu, ktorej časť sa použije ako dar pre phpBB. Povolením VigLinku podporujete našu organizáciu a zaisťujete jej finančné zabezpečenie.',
	'ACP_VIGLINK_SETTINGS_CHANGE'	=> 'Tieto nastavenia môžete kedykoľvek zmeniť v paneli „<a href="%1$s">VigLink nastavení</a>“.',
	'ACP_VIGLINK_SUPPORT_EXPLAIN'	=> 'Po tom, čo odošlete vašu preferovanú možnosť kliknutím na tlačidlo Odoslať už viac nebudete presmerovaní na túto stránku.',
	'ACP_VIGLINK_ENABLE'			=> 'Povoliť VigLink',
	'ACP_VIGLINK_ENABLE_EXPLAIN'	=> 'Povolí používanie služby VigLink.',
	'ACP_VIGLINK_EARNINGS'			=> 'Nárokujte si na vlastné zárobky (voliteľné)',
	'ACP_VIGLINK_EARNINGS_EXPLAIN'  => 'Môžete si nárokovať na vlastné zárobky tým, že si vytvoríte VigLink účet.',
	'ACP_VIGLINK_DISABLED_PHPBB'	=> 'VigLink služba bola pre phpBB vypnutá.',
	'ACP_VIGLINK_CLAIM'				=> 'Nárokujte si na vlastné zárobky',
	'ACP_VIGLINK_CLAIM_EXPLAIN'		=> 'Namiesto darovania ziskov phpBB projektu si môžete nárokovať na zárobky vášho fóra zo speňažených VigLink odkazov. Pre správu vášho účtu sa zaregistrujte do „VigLink Convert” kliknutím na „Konvertovať účet”.',
	'ACP_VIGLINK_CONVERT_ACCOUNT'	=> 'Konvertovať účet',
	'ACP_VIGLINK_NO_CONVERT_LINK'	=> 'Odkaz konvertovaného účtu VigLink sa nepodarilo získať.',
));
