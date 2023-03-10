<?php

# protect against hack attempts
if (!defined('NGCMS')) die ('HAL');

function plugin_block_online_install($action) {
	global $lang;
	
	if ($action != 'autoapply')
		loadPluginLang('block_online', 'config', '', '', ':');
		
	$db_create = array(
		array(
			'table' => 'online',
			'action' => 'cmodify',
			'key' => 'primary key (`session`)',
			'fields' => array(
				array('action' => 'cmodify', 'name' => 'session', 'type' => 'varchar(35)', 'params' => 'NOT NULL DEFAULT \'\''),
				array('action' => 'cmodify', 'name' => 'id', 'type' => 'int(11)', 'params' => 'UNSIGNED NOT NULL DEFAULT 0'),
				array('action' => 'cmodify', 'name' => 'lasttime', 'type' => 'int(10)', 'params' => 'UNSIGNED NOT NULL DEFAULT 0'),
				array('action' => 'cmodify', 'name' => 'ip', 'type' => 'varchar(30)', 'params' => 'NOT NULL DEFAULT \'\''),
				array('action' => 'cmodify', 'name' => 'agent', 'type' => 'varchar(255)', 'params' => 'NOT NULL DEFAULT \'\''),
				array('action' => 'cmodify', 'name' => 'os', 'type' => 'varchar(255)', 'params' => 'NOT NULL DEFAULT \'\''),
				array('action' => 'cmodify', 'name' => 'browser', 'type' => 'varchar(255)', 'params' => 'NOT NULL DEFAULT \'\''),
				array('action' => 'cmodify', 'name' => 'login', 'type' => 'varchar(30)', 'params' => 'NOT NULL DEFAULT \'\''),
				array('action' => 'cmodify', 'name' => 'status', 'type' => 'tinyint(1)', 'params' => 'NOT NULL DEFAULT 0'),
				array('action' => 'cmodify', 'name' => 'avatar', 'type' => 'varchar(100)', 'params' => ''),
				array('action' => 'cmodify', 'name' => 'reg', 'type' => 'int(10)', 'params' => 'NOT NULL DEFAULT 0'),
				array('action' => 'cmodify', 'name' => 'location', 'type' => 'varchar(255)', 'params' => 'NOT NULL DEFAULT \'\'')
			)
		)
	);

	switch ($action) {
		case 'confirm': 
			 generate_install_page('block_online', $lang['block_online:install']);
			 break;
		case 'autoapply':
		case 'apply':
			if (fixdb_plugin_install('block_online', $db_create, 'install', ($action=='autoapply')?true:false)) {
				plugin_mark_installed('block_online');
				pluginSetVariable('block_online', 'separator', ',');
				pluginSetVariable('block_online', 'limit', '20');
				pluginSetVariable('block_online', 'vtimeout', '3600');
				pluginSetVariable('block_online', 'timeout', '300');
				pluginSetVariable('block_online', 'time_clear', '3600');
				pluginsSaveConfig();
			} else {
				return false;
			}
			break;
	}
	return true;
}
