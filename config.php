<?php

# protect against hack attempts
if (!defined('NGCMS')) die ('HAL');

pluginsLoadConfig();
LoadPluginLang('block_online', 'config', '', '', '#');

switch ($_REQUEST['action']) {
	case 'about':			about();		break;
	default: main();
}

function about()
{global $twig, $lang, $breadcrumb;
	$tpath = locatePluginTemplates(array('main', 'about'), 'block_online', 1);
	$breadcrumb = breadcrumb('<i class="fa fa-user-secret btn-position"></i><span class="text-semibold">'.$lang['block_online']['block_online'].'</span>', array('?mod=extras' => '<i class="fa fa-puzzle-piece btn-position"></i>'.$lang['extras'].'', '?mod=extra-config&plugin=block_online' => '<i class="fa fa-user-secret btn-position"></i>'.$lang['block_online']['block_online'].'',  '<i class="fa fa-exclamation-circle btn-position"></i>'.$lang['block_online']['about'].'' ) );

	$xt = $twig->loadTemplate($tpath['about'].'about.tpl');
	$tVars = array();
	$xg = $twig->loadTemplate($tpath['main'].'main.tpl');
	
	$about = 'версия 0.2';
	
	$tVars = array(
		'global' => 'О плагине',
		'header' => $about,
		'entries' => $xt->render($tVars)
	);
	
	print $xg->render($tVars);
}

function main()
{global $twig, $lang, $breadcrumb;
	
	$tpath = locatePluginTemplates(array('main', 'general.from'), 'block_online', 1);
	$breadcrumb = breadcrumb('<i class="fa fa-user-secret btn-position"></i><span class="text-semibold">'.$lang['block_online']['block_online'].'</span>', array('?mod=extras' => '<i class="fa fa-puzzle-piece btn-position"></i>'.$lang['extras'].'', '?mod=extra-config&plugin=block_online' => '<i class="fa fa-user-secret btn-position"></i>'.$lang['block_online']['block_online'].'' ) );

	if (isset($_REQUEST['submit'])){
		pluginSetVariable('block_online', 'limit', intval($_REQUEST['limit']));
		pluginSetVariable('block_online', 'vtimeout', intval($_REQUEST['vtimeout']));
		pluginSetVariable('block_online', 'timeout', intval($_REQUEST['timeout']));
		pluginSetVariable('block_online', 'time_clear', intval($_REQUEST['time_clear']));
		pluginSetVariable('block_online', 'hint', $_REQUEST['hint']);
		pluginSetVariable('block_online', 'icon', $_REQUEST['icon']);
		pluginSetVariable('block_online', 'num_user_last', intval($_REQUEST['num_user_last']));
		pluginSetVariable('block_online', 'num_user_vizit', intval($_REQUEST['num_user_vizit']));
		pluginSetVariable('block_online', 'separator', $_REQUEST['separator']);
		pluginSetVariable('block_online', 'robo_ip', (int)$_REQUEST['robo_ip']);
		pluginSetVariable('block_online', 'robo_geo', (int)$_REQUEST['robo_geo']);
		pluginSetVariable('block_online', 'guest_ip', (int)$_REQUEST['guest_ip']);
		pluginSetVariable('block_online', 'guest_geo', (int)$_REQUEST['guest_geo']);
		
		pluginSetVariable('block_online', 'localsource', (int)$_REQUEST['localsource']);
		pluginsSaveConfig();
		msg(array("type" => "info", "info" => "сохранение прошло успешно"));
		return print_msg( 'info', ''.$lang['block_online']['block_online'].'', 'Cохранение прошло успешно', 'javascript:history.go(-1)' );
	}
	
	$limit = pluginGetVariable('block_online', 'limit');
	$vtimeout = pluginGetVariable('block_online', 'vtimeout');
	$timeout = pluginGetVariable('block_online', 'timeout');
	$time_clear = pluginGetVariable('block_online', 'time_clear');
	$separator = pluginGetVariable('block_online', 'separator');

	$hint = pluginGetVariable('block_online', 'hint');
	$hint = '<option value="hintbox" '.($hint==0?'selected':'').'>по умолчанию</option><option value="hints" '.($hint==1?'selected':'').'>белая</option><option value="hintbox" '.($hint==2?'selected':'').'>темная</option>';
	$icon = pluginGetVariable('block_online', 'icon');
	$icon = '<option value="0" '.($icon==0?'selected':'').'>'.$lang['noa'].'</option><option value="1" '.($icon==1?'selected':'').'>'.$lang['yesa'].'</option>';

	$num_user_last = pluginGetVariable('block_online', 'num_user_last');
	$num_user_last = '<option value="1" '.($num_user_last==1?'selected':'').'>по умолчанию</option><option value="2" '.($num_user_last==1?'selected':'').'>2 столбца</option><option value="3" '.($num_user_last==3?'selected':'').'>3 столбца</option>';

	$num_user_vizit = pluginGetVariable('block_online', 'num_user_vizit');
	$num_user_vizit = '<option value="1" '.($num_user_vizit==1?'selected':'').'>по умолчанию</option><option value="2" '.($num_user_vizit==1?'selected':'').'>2 столбца</option><option value="3" '.($num_user_vizit==3?'selected':'').'>3 столбца</option>';

	$robo_ip = pluginGetVariable('block_online', 'robo_ip');
	$robo_ip = '<option value="0" '.($robo_ip==0?'selected':'').'>'.$lang['noa'].'</option><option value="1" '.($robo_ip==1?'selected':'').'>'.$lang['yesa'].'</option>';
	$robo_geo = pluginGetVariable('block_online', 'robo_geo');
	$robo_geo = '<option value="0" '.($robo_geo==0?'selected':'').'>'.$lang['noa'].'</option><option value="1" '.($robo_geo==1?'selected':'').'>'.$lang['yesa'].'</option>';

	$guest_ip = pluginGetVariable('block_online', 'guest_ip');
	$guest_ip = '<option value="0" '.($guest_ip==0?'selected':'').'>'.$lang['noa'].'</option><option value="1" '.($guest_ip==1?'selected':'').'>'.$lang['yesa'].'</option>';
	$guest_geo = pluginGetVariable('block_online', 'guest_geo');
	$guest_geo = '<option value="0" '.($guest_geo==0?'selected':'').'>'.$lang['noa'].'</option><option value="1" '.($guest_geo==1?'selected':'').'>'.$lang['yesa'].'</option>';

	$xt = $twig->loadTemplate($tpath['general.from'].'general.from.tpl');
	$xg = $twig->loadTemplate($tpath['main'].'main.tpl');
	
	$tVars = array(
		'limit' 		=> $limit,
		'vtimeout' 		=> $vtimeout,
		'timeout' 		=> $timeout,
		'time_clear'	=> $time_clear,
		'icon' 			=> $icon,
		'hint' 			=> $hint,
		'separator' 	=> $separator,
		'robo_ip'   	=> $robo_ip,
		'robo_geo'   	=> $robo_geo,
		'guest_ip'   	=> $guest_ip,
		'guest_geo'   	=> $guest_geo,
		'num_user_last' => $num_user_last,
		'num_user_vizit' => $num_user_vizit,
		'localsource'   => MakeDropDown(array(0 => 'Шаблон сайта', 1 => 'Плагина'), 'localsource', (int)pluginGetVariable('block_online', 'localsource')),
	);
	
	$tVars = array(
		'global' => 'Общие',
		'header' => '<i class="fa fa-exclamation-circle"></i> <a href="?mod=extra-config&plugin=block_online&action=about">'.$lang['block_online']['about'].'</a>',
		'entries' => $xt->render($tVars)
	);
	
	print $xg->render($tVars);
}
