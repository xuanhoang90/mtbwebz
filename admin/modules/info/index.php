<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_WInfo = new ACP_WInfo();
	$CMS->ACP_WInfo->Autorun();
	class ACP_WInfo{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'page_default':
					$this->PageDefault();
					break;
				default:
					$this->PageDefault();
					break;
			}
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('info');
			echo $CMS->skin_info->PageDefault();exit;
			return;
		}
	}