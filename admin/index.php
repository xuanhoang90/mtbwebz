<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	define("ADMIN_F_ROOT","admin");
	define("ADMIN_F_SKIN","admin/skin");
	define("ADMIN_F_MODULE","admin/modules");
	define("ADMIN_F_INCLUDE","admin/inc");
	define("ADMIN_LANGUAGE_FOLDER","admin/language");
	
	//Load system require
	$files = array_diff(scandir(ADMIN_F_INCLUDE), array('..', '.'));
	foreach($files as $file){
		if (preg_match("/.php/i", $file)) {
			if(is_file(ADMIN_F_INCLUDE."/".$file)){
				//echo $sys."/".$file."<br/>";
				include_once ADMIN_F_INCLUDE."/".$file;
			}
		}
	}
	
	//check system admin version
	$skin = ADMIN_F_SKIN."/skin.inc.php";
	if(file_exists($skin)){
		require($skin);
	}else{
		echo "System error!!!";
	}
	
	//Check member login
	$CMS->admin['member'] = $_SESSION['member'];
	if($CMS->admin['member']){
		//Load user data
		//$USER = 
		if($CMS->input['page'] != "" && $CMS->input['page'] != "login"){
			$CMS->admin['system']->LoadModule($CMS->input['page']);
		}else{
			$CMS->admin['system']->LoadModule('main');
		}
	}else{
		$CMS->admin['system']->LoadModule('login');
	}
	
	exit;