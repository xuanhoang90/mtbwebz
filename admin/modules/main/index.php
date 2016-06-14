<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Main = new ACP_Main();
	$CMS->ACP_Main->Autorun();
	class ACP_Main{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'page_default':
					$this->PageDefault();
					break;
				case 'ajax_object_insert':
					$this->AjaxWindowObject();
					break;
				default:
					$this->PageDefault();
					break;
			}
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('main');
			echo $CMS->skin_main->PageDefault();exit;
			return;
		}
		public function AjaxWindowObject(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('main');
			echo $CMS->admin['skin_global']->ListObject();exit;
			return;
		}
	}