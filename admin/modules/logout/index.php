<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Logout = new ACP_Logout();
	$CMS->ACP_Logout->Autorun();
	class ACP_Logout{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			session_destroy();
			header("Location: {$CMS->vars['root_domain']}/taka_acp");exit;
			return true;
		}
	}