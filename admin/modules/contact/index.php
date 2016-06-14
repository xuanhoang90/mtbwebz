<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Contact = new ACP_Contact();
	$CMS->ACP_Contact->Autorun();
	class ACP_Contact{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'page_default':
					$this->PageDefault();
					break;
				case 'view':
					$this->ReadContact();
					break;
				default:
					$this->PageDefault();
					break;
			}
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('contact');
			echo $CMS->skin_contact->PageDefault();exit;
			return;
		}
		public function ReadContact(){
			global $CMS, $DB;
			if(intval($CMS->input['id'])){
				$CMS->admin['system']->LoadSkinModule('contact');
				echo $CMS->skin_contact->ReadContact();exit;
			}else{
				$CMS->admin['system']->LoadSkinModule('contact');
				echo $CMS->skin_contact->PageDefault();exit;
			}
			return;
		}
	}