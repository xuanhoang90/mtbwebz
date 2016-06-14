<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_ChangeTpl = new ACP_ChangeTpl();
	$CMS->ACP_ChangeTpl->Autorun();
	class ACP_ChangeTpl{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'viewlist':
					$this->TplList();
					break;
				case 'applychange':
					$this->ApplyChangeTpl();
					break;
				default:
					$this->PageDefault();
					break;
			}
			return true;
		}
		public function TplList(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('change_tpl');
			echo $CMS->skin_change_tpl->PageDefault();exit;
			return;
		}
		public function ApplyChangeTpl(){
			global $CMS, $DB;
			if($CMS->input['tplname'] != ""){
				//check dir
				if(is_dir("themes/".$CMS->input['tplname'])){
					$DB->query("use ".WEBSITE_DBNAME);
					$DB->query("UPDATE config SET `value`='{$CMS->input['tplname']}' WHERE `key`='theme'");
				}
				header("Location: {$CMS->vars['root_domain']}/?site=admin&page=change_tpl&action=viewlist");exit;
			}
			return;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('change_tpl');
			echo $CMS->skin_change_tpl->PageDefault();exit;
			return;
		}
	}