<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Member = new ACP_Member();
	$CMS->ACP_Member->Autorun();
	class ACP_Member{
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
			$CMS->admin['system']->LoadSkinModule('member');
			echo $CMS->skin_member->PageDefault();exit;
			return;
		}
	}