<?php

function robots($useragent)
	{
        $arr = array(
            "#.*(yandex|yadirectbot).*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/yandex.png />",
            "#.*(google|accoona|gsa-crawler).*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/google.png />",
            "#.*rambler.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/rambler.png />",
            '#.*mail.ru.*#si' => "<img src=".admin_url."/plugins/block_online/img/bots/mail_ru.png />",
            "#.*aport.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/aport.png />",
            "#.*TurtleScanner.*#si" => "Turtle",
            "#.*slurp.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/Inktomi-Spider.png />",
            "#.*msnbot.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/msn.png />",
            "#.*(askjeeves|ask jeeves).*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/ask_com.png />",
            "#.*yahoo.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/yahoo.png />",
            "#.*scooter.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/altavista.png />",
            "#.*lycos.*#si" => "Lycos.com",
            "#.*libwww.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/Punto.png />",
            "#.*picsearch.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/picsearch.png />",
            "#.*mnogosearch.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/mnogosearch.png />",
            "#.*(is_archiver|archive_org).*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/Archive.org.png />",
            "#.*W3C_Validator.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/w3cvalidator.png />",
            "#.*W3C_CSS_Validator.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/w3c_css_validator.png />",
            "#.*antabot.*#si" => "antabot (private)",
            "#.*Asterias.*#si" => "Singingfish Spider",
            "#.*Baiduspider.*#si" => "Baidu Spider",
            "#.*Feedfetcher-Google.*#si" => "Feedfetcher-Google",
            "#.*GameSpyHTTP.*#si" => "GameSpy HTTP",
            "#.*GigaBlast.*#si" => "GigaBlast",
            "#.*Gigabot.*#si" => "Gigabot",
            "#.*Googlebot-Image.*#si" => "Googlebot-Image",
            "#.*Googlebot.*#si" => "Googlebot",
            "#.*grub-client.*#si" => "Grub",
            "#.*slurp@inktomi.*#si" => "Hot Bot",
            "#.*whatuseek.*#si" => "What You Seek",
            "#.*ia_archiver.*#si" => "Alexa",
            "#.*YandexBlog.*#si" => "YandexBlog",
            "#.*YandexSomething.*#si" => "YandexSomething",
            "#.*StackRambler.*#si" => "Rambler",
            "#.*WebAlta Crawler.*#si" => "WebAlta Crawler",
            "#.*zyborg@looksmart.*#si" => "WiseNut",
            "#.*WebCrawler.*#si" => "Fast",
            "#.*Openbot.*#si" => "Openfind",
			"#.*Bing.*#si" => "<img src=".admin_url."/plugins/block_online/img/bots/Bing.png />",
            "#.*booch.*#si" => "booch_Bot",
            "#.*WebZIP.*#si" => "WebZIP",
            "#.*GetSmart.*#si" => "GetSmart",
            "#.*NaverBot.*#si" => "NaverBot",
            "#.*Vampire.*#si" => "Net_Vampire",
            "#.*ZipppBot.*#si" => "ZipppBot",
            "#.*crawl.*#si" => "crawl Bot"
			 );
        $result = preg_replace(array_keys($arr), $arr, $useragent);
        return $result;
	}
	
function user_os($useragent)
	{
		$arr = array(
		"#.*Windows NT 12.0.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/win10.png style=vertical-align:middle;/> Windows 12",
		"#.*Windows NT 11.0.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/win10.png style=vertical-align:middle;/> Windows 11",
        "#.*Windows NT 10.0.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/win10.png style=vertical-align:middle;/> Windows 10",
        "#.*Windows NT 6.3.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/win81.png style=vertical-align:middle;/> Windows 8.1",
        "#.*Windows NT 6.2.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/win8.png style=vertical-align:middle;/> Windows 8",
        "#.*Windows NT 6.1.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/win7.png style=vertical-align:middle;/> Windows 7",
        "#.*Windows NT 6.0.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/vista.png style=vertical-align:middle;/> Windows Vista",
        "#.*Windows NT 5.2.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/xp64.png style=vertical-align:middle;/> Windows XP x64 or Server 2003",
        "#.*Windows NT 5.1.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/xp.png style=vertical-align:middle;/> Windows XP",
        "#.*Windows NT 5.0.*#si" => "<img src=".admin_url."/plugins/block_online/img/system/win2000.png style=vertical-align:middle;/> Windows 2000",
		"#.*(Windows NT 4.0|Windows NT 3.5).*#si" => "Windows NT",
		"#.*Windows CE.*#si" => "Windows CE or Mobile",
		"#.*Windows Me.*#si" => "Windows ME",
		"#.*Windows 98.*#si" => "Windows 98",
		"#.*Windows 95.*#si" => "Windows 95",
		"#.*(Linux|Lynx|Unix).*#si" => "Linux",
		"#.*(Macintosh|PowerPC).*#si" => "MacOS",
		"#.*OS/2.*#si" => "OS/2",
		"#.*BeOS.*#si" => "BeOS");
		$result = preg_replace(array_keys($arr), $arr, $useragent);
		return $result;
	}

function user_browser($useragent)
 	{
 		$arr = array(
		    "#.*InternetExplorer (\S*);.*#si" => "<img src=".admin_url."/plugins/block_online/img/browser/internet.png style=vertical-align:middle;/> InternetExplorer \\1",
            "#.*MSIE (\S*);.*#si" => "<img src=".admin_url."/plugins/block_online/img/browser/msie.png style=vertical-align:middle;/> Internet Explorer \\1",
            "#.*(Opera.*Version|Opera)/(\S*).*#si" => "<img src=".admin_url."/plugins/block_online/img/browser/opera.png style=vertical-align:middle;/> Opera \\2",
            "#.*Navigator/(\S*).*#si" => "Navigator \\1",
            "#.*Flock/(\S*).*#si" => "<img src=".admin_url."/plugins/block_online/img/browser/flock.png style=vertical-align:middle;/> Flock \\1",
            "#.*Firefox/(\S*).*#si" => "<img src=".admin_url."/plugins/block_online/img/browser/firefox.png style=vertical-align:middle;/> Firefox \\1",
            "#.*Chrome/(\S*).*#si" => "<img src=".admin_url."/plugins/block_online/img/browser/chrome.png style=vertical-align:middle;/> Chrome \\1",
            "#.*Version/(\S*).*Safari.*#si" => "<img src=".admin_url."/plugins/block_online/img/browser/safari.png style=vertical-align:middle;/> Safari \\1",
            "#.*Safari/(\S*).*#si" => "<img src=".admin_url."/plugins/block_online/img/browser/safari.png style=vertical-align:middle;/> Safari \\1",
            "#.*K-Meleon.*#si" => "K-Meleon",
            "#.*SeaMonkey.*#si" => "SeaMonkey",
            "#.*Camino.*#si" => "Camino",
            "#.*Epiphany.*#si" => "Epiphany",
            "#.*America Online Browser.*#si" => "America Online Browser",
            "#.*avantbrowser.*#si" => "Avant Browser."
        );
        $result = preg_replace(array_keys($arr), $arr, $useragent);
        return $result;
	}
	
function user_position()
	{
		global $catz, $catmap, $CurrentHandler, $plugin, $SYSTEM_FLAGS, $lang;
		$result = "Просматривает главную страницу";
		
		$titl_n = $SYSTEM_FLAGS['news']['db.title'];
		$titl_s = $SYSTEM_FLAGS['static']['db.title'];
		$titl_c = $SYSTEM_FLAGS['news']['currentCategory.name'];
		
		$actors = $_REQUEST['actor'];

		switch($CurrentHandler['pluginName'])
		{
			case "main":			$result = "Просматривает главную страницу"; break;
			case "news":			if($CurrentHandler['handlerName'] == 'news') $result = "Просматривает новость: $titl_n"; if($CurrentHandler['handlerName'] == 'by.category') $result = "Просматривает категорию: $titl_c"; if($SYSTEM_FLAGS['info']['title']['group'] == $lang['404.title']) $result = "Просматривает страницу: Error 404"; break;
			case "static":			$result = "Просматривает страницу: $titl_s"; break;	
			case "pm":				$result = "Находится в разделе: Личные сообщения"; break;
			case "bookmarks":		$result = "Просматривает избранные статьи"; break;
			case "uprofile":		$result = "Просматривает профиль"; break;
			
			case "genres":			$result = "Просматривает жанры"; break;
			case "collections":		$result = "Просматривает коллекции новостей"; break;	
			case "avatar":			$result = "Выбирает аватар"; break;
			case "tags":			$result = "Просматривает облако тегов"; break;

			case "feedback":		$result = "Находится в разделе"; break;
			case "forum":			$result = "Просматривает форум"; break;
			
			case "actors":			$result = "Просматривает: $actors"; break;

		}
		return addslashes(htmlspecialchars($result));
	}

?>