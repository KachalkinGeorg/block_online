<?php

# protect against hack attempts
if (!defined('NGCMS')) die ('HAL');

global $lang;

loadPluginLang('block_online', 'config', '', '', ':');

$db_update = array(
	array(
		'table'		=>	'online',
		'action'	=>	'drop',
	),
);

if ($_REQUEST['action'] == 'commit') {
	if (fixdb_plugin_install('block_online', $db_update, 'deinstall')) {
		plugin_mark_deinstalled('block_online');
	}
} else {
	generate_install_page('block_online', $lang['block_online:uninstall'], 'deinstall');
}