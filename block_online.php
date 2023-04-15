<?php

# protect against hack attempts
if (!defined('NGCMS')) die ('HAL');

add_act('index', 'block_online');

$BOOT = false;
$jouser = Array();

include_once(dirname(__FILE__) . '/lib/online.class.php');

function isBot()
{
	$uar		= parse_ini_file('lib/user-agent.ini');
	$bot_name	= '';
	
	foreach($uar as $key => $value)
		if(stripos($_SERVER['HTTP_USER_AGENT'], $key)){
			$bot_name = $value;
			break;
		}
	
	if ($bot_name)
		$GLOBALS['BOOT'] = true;
	else
		$bot_name = $_SERVER['HTTP_USER_AGENT'];
	
	return $bot_name;
}

function block_online ()
{
	global $mysql, $tpl, $config, $template, $userROW, $ip, $lang, $UGROUP;
	
	$tpath = locatePluginTemplates(array('skins/user_hint', 'skins/user_block'), 'block_online', intval(pluginGetVariable('block_online', 'localsource')));	

	register_htmlvar('css', admin_url . '/plugins/block_online/tpl/skins/css/online.css');
	register_htmlvar('js', admin_url . '/plugins/block_online/tpl/skins/css/online.js');
	
	LoadPluginLang('block_online', 'main', '', '', ':');
	
	$agent 	= !$userROW['id']    ? isBot()    : $_SERVER['HTTP_USER_AGENT'];
	$login 	= $userROW['name']   ? $userROW['name']   : '';
	$grp 	= $userROW['status'] ? $userROW['status'] : ($GLOBALS['BOOT'] ? -1 : 0);
	$id 	= $userROW['id']     ? $userROW['id']     : 0;
	$os 	= user_OS($_SERVER["HTTP_USER_AGENT"])   ? user_OS($_SERVER["HTTP_USER_AGENT"])   : 'неизвестно';
	$browser 	= user_browser($_SERVER["HTTP_USER_AGENT"])   ? user_browser($_SERVER["HTTP_USER_AGENT"])   : 'неизвестно';
	$location 	= user_position()   ? user_position()   : '';
	$sess = md5($agent.$ip.$id);
	
	# check session
	$ss = $mysql->record('SELECT `session` FROM '.prefix.'_online WHERE `session` = '.db_squote($sess).' LIMIT 1');
	
	$db_column = array('session', 'id', 'lasttime', 'ip', 'agent', 'os', 'browser', 'login', 'status', 'avatar', 'location', 'reg');
	$db_value = array(db_squote($sess), $id, time(), db_squote($ip), db_squote($agent), db_squote($os), db_squote($browser), db_squote($login), $grp, db_squote($userROW['avatar']), db_squote($location), db_squote($userROW['reg']));
	
	if ($ss == false){
		$mysql->query('INSERT INTO `'.prefix.'_online` ('.implode(',', $db_column).') VALUES ('.implode(',', $db_value).')');
	}else{
		$mysql->query('UPDATE `'.prefix.'_online` SET `lasttime`='.time().', `id`='.$id.', `os`='.db_squote($os).', `browser`='.db_squote($browser).', `login`='.db_squote($login).', `status`='.$grp.', `location`='.db_squote($location).' WHERE `session`='.db_squote($ss['session']));
	}
	
	$i = 0; $u = 0; $b = 0; $g = 0; $list = ''; $obot = ''; $guest = '';
	
	$separator = pluginGetVariable('block_online', 'separator') ? pluginGetVariable('block_online', 'separator') : ', ';

	$num_user_last = pluginGetVariable('block_online', 'num_user_last') ? pluginGetVariable('block_online', 'num_user_last') : 1;
	$num_user_vizit = pluginGetVariable('block_online', 'num_user_vizit') ? pluginGetVariable('block_online', 'num_user_vizit') : 1;
			
	if($num_user_last == 1){
		$separat = $separator;
	}

	if($num_user_vizit == 1){
		$vseparat = $separator;
	}
	
	$timeout = pluginGetVariable('block_online', 'timeout') ? pluginGetVariable('block_online', 'timeout') : 300;
	$tm = time() - intval($timeout);

	$res = $mysql->select('SELECT * FROM `'.prefix.'_online` WHERE `lasttime` > '.$tm.';');
	foreach ($res as $row)
	{
		if ($row['status'] == -1)
		{
			$b++;
			$k.= '<div class="online_out'.$num_user_last.'">'.$row['agent'].''.$separat.'</div>';
			
			if (pluginGetVariable('block_online', 'robo_ip')){
				$robot0 = '<b>IP:</b> <span>'.$row['ip'].'</span><br />';
			}
			$robots = '<div><span style=\'padding:30px 30px 0 30px\'>'.robots($row['agent']).'</span></div>';
			$robot1 = '<b>Браузер:</b> '.$row['browser'].'<br />';
			$robot2 = '<b>Локация:</b> '.$row['location'].'<br />';
			$hint = pluginGetVariable('block_online', 'hint') ? pluginGetVariable('block_online', 'hint') : 'hintbox';

			$bot.= '<a href="" udata="<div class=\''.$hint.'\'><div class=\'lcol\'>'.$robots.'</div><div class=\'rcol\'>'.$robot0.''.$robot1.''.$robot2.'</div></div>">'.$row['agent'].'</a>'.$separator.'';
		}

		elseif ($row['status'] > 0)
		{
			if ($jouser[$row['id']]) continue;
			
			$status = isset($UGROUP[$row['status']]) ? $UGROUP[$row['status']]['name'] : ('Unknown ['.$row['status'].']');

			$u++;
			
			$profile_link = checkLinkAvailable('uprofile', 'show')?
				 generateLink('uprofile', 'show', array('name' => $row['login'], 'id' => $row['id'])):
				 generateLink('core', 'plugin', array('plugin' => 'uprofile', 'handler' => 'show'), array('id' => $row['id']));
			$avatar_link = $row['avatar'] ? avatars_url.'/'.$row['avatar'] : avatars_url.'/noavatar.gif';
			
			if (is_array($userROW) && ($userROW['status'] == 1 || $userROW['status'] == 2)) { 
				$userip = $ip ? $ip : $_SERVER["REMOTE_ADDR"];
				$user_ip = '<b>IP:</b>&nbsp;'.$userip.'<br />';
			}
			
			$time = time() + ($config['date_adjust'] * 60);
			$last_time = $time - 500;
			
			$last_date = date('H:i:s', intval($row['lasttime']));
		
			$tvars['vars'] = array(
				'hint'			=> pluginGetVariable('block_online', 'hint') ? pluginGetVariable('block_online', 'hint') : 'hintbox',
				'foto'			=> $avatar_link,
				'profile'		=> $profile_link,
				'user'			=> $row['login'],
				'user_location'	=> $row['location'],
				'user_agent'	=> $row['os'],
				'ip'			=> $user_ip,
				'browser_icon'	=> '<b>Браузер:</b>&nbsp;'.$row['browser'].'<br />',
				'user_OS'		=> '<b>ОС:</b>&nbsp;'.$row['os'].'<br />',
				'usergroup'		=> '<b>Группа:</b>&nbsp;'.$status.'<br />',
				'last_visit'	=> '<b>Последний визит:</b>&nbsp;'.langdate("j Q Y", $last_time).'&nbsp;('.$last_date.')<br />',
			);
		
			$tpl->template('skins/user_hint', $tpath['skins/user_hint']);
			$tpl->vars('skins/user_hint', $tvars);
			$entries = $tpl->show('skins/user_hint');
			
			$listall = '<div class="online_out'.$num_user_last.'"><a href="'.$profile_link.'" udata="'.$entries.'">'.$row['login'].'</a>'.$separat.'</div>';
			$list .= substr($listall, 0, strlen($listall));
			
			$onuser = '<a href="'.$profile_link.'" udata="'.$entries.'">'.$row['login'].'</a>'.$separator.'';
			$ouser .= substr($onuser, 0, strlen($onuser));

			$jouser[$row['id']] = true;

		} else 
				if ($row['status'] == 0)
		{
			$t.= '<div class="online_out'.$num_user_last.'">гость'.$separat.'</div>';
				$g++;
			if (is_array($userROW) && ($userROW['status'] == 1 || $userROW['status'] == 2)) { 
				$guest_ip = '<div class=\'statonline\'>'.$row['ip'].'</div>';
			}

			$guests = '<img src=\''.admin_url.'/plugins/block_online/img/nouser.png\'>'.$guest_ip.'';
			$guest1 = '<b>Браузер:</b> '.$row['browser'].'<br />';
			$guest2 = '<b>Локация:</b> '.$row['location'].'<br />';
			$hint = pluginGetVariable('block_online', 'hint') ? pluginGetVariable('block_online', 'hint') : 'hintbox';
			$guest.= '<a href="" udata="<div class=\''.$hint.'\'><div class=\'lcol\'>'.$guests.'</div><div class=\'rcol\'>'.$guest1.''.$guest2.'</div></div>">гость</a>'.$separator.'';
		}
	}
	
	$lim = pluginGetVariable('block_online', 'limit');
	$limit = $lim ? $lim : 20;
	
	$vtimeout = pluginGetVariable('block_online', 'vtimeout') ? pluginGetVariable('block_online', 'vtimeout') : 3600;
	$vtm = time() - intval($vtimeout);

	$vres = $mysql->select('SELECT * FROM `'.prefix.'_online` WHERE `lasttime` > '.$vtm.' ORDER BY lasttime DESC LIMIT '. $limit.'');
	foreach ($vres as $row)
	{
		if ($row['status'] == -1)
		{
			$vk.= '<div class="online_out'.$num_user_vizit.'">'.$row['agent'].''.$vseparat.'</div>';
		}
		elseif ($row['status'] > 0)
		{
			
			$status = isset($UGROUP[$row['status']]) ? $UGROUP[$row['status']]['name'] : ('Unknown ['.$row['status'].']');

			$vizit = str_replace(array('{profile_link}', '{login}', '{status}', '{num_user_vizit}', '{location}', '{reg}', '{separator}'), array($profile_link, $row['login'], $status, $num_user_vizit, $row['location'], langdate("j Q Y", $row['reg']), $vseparat), $lang['block_online:vizit']);
			
		} else ;

	}
	

	$list = $list.$k;
	$online_all = substr($list, 0, strlen($list)-2);
	$online_user = substr($ouser, 0, strlen($ouser));
	$obot = $bot;
	$online_bot = substr($obot, 0, strlen($obot));
	$oguest = $guest;
	$online_guest = substr($oguest, 0, strlen($oguest));

	$vizit = $vizit.$vk/* .$t */;
	$online_user_vizit = substr($vizit, 0, strlen($vizit)-2);
	
	$tvars['vars'] = array (
		'online_user_list' 	=> $online_all,
		'online_user_vizit' => $online_user_vizit,
		'user_count' 		=> $u,
		'guest_count'		=> $g,
		'bot_count'			=> $b,
		'sum_count'			=> $u + $g + $b,
		'online_user' 		=> $online_user ? $online_user : 'нет',
		'online_bot' 		=> $online_bot ? $online_bot : 'нет',
		'online_guest' 		=> $online_guest ? $online_guest : 'нет',
		'online_time'		=> gmdate('H:i', $vtimeout),
	);

	$tpl->template('skins/user_block', $tpath['skins/user_block']);
	$tpl->vars('skins/user_block', $tvars);
	$template['vars']['block_online'] = $tpl->show('skins/user_block');

	# clear old records
	if (pluginGetVariable('block_online', 'last_clear') < time() - intval(pluginGetVariable('block_online', 'time_clear'))){
		$mysql->query('DELETE FROM `'.prefix.'_online` WHERE `lasttime` < '.$tm.';');
		pluginSetVariable('block_online', 'last_clear', time());
		pluginsSaveConfig();
	}
}

?>