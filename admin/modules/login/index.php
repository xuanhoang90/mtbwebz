<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Login = new ACP_Login();
	$CMS->ACP_Login->Autorun();
	class ACP_Login{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'page_default':
					$this->PageDefault();
					break;
				case 'login_do':
					$this->LoginProcess();
					break;
				default:
					$this->PageDefault();
					break;
			}
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('login');
			echo $CMS->skin_login->PageDefault();exit;
			return;
		}
		public function LoginProcess(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_login');
			//ket noi db sau, hien tai la admin/12345
			//$acp_default_name = "admin";
			//$acp_default_pwd = "12345";
			$res = array();
			if($CMS->input['username'] && $CMS->input['password']){
				if($data = $this->LoadAdminData()){
					if($CMS->input['password'] == $data['hint']){
						$res = array(
							"status" => "true",
							"reason" => $lang['login_do_success']
						);
						$_SESSION['member'] = $data['admin_name'];
						$_SESSION['admin'] = "Master";
					}else{
						$res = array(
							"status" => "false",
							"reason" => $lang['login_do_password_false']
						);
					}
				}else{
					if($data = $this->LoadEmployData()){
						if(md5($CMS->input['password']) == $data['password']){
							$res = array(
								"status" => "true",
								"reason" => $lang['login_do_success']
							);
							$_SESSION['member'] = $data['name'];
						}else{
							$res = array(
								"status" => "false",
								"reason" => $lang['login_do_password_false']
							);
						}
					}else{
						$res = array(
							"status" => "false",
							"reason" => $lang['login_do_username_invalid']
						);
					}					
				}
				echo json_encode($res);exit;
				return;
			}else{
				if($CMS->input['username']==""){
					$res = array(
						"status" => "false",
						"reason" => $lang['login_do_empty_username']
					);
				}
				if($CMS->input['password']==""){
					$res = array(
						"status" => "false",
						"reason" => $lang['login_do_empty_password']
					);
				}
				if($CMS->input['username']=="" && $CMS->input['password']==""){
					$res = array(
						"status" => "false",
						"reason" => $lang['login_do_empty_request']
					);
				}
                print_r($lang);exit;
				echo json_encode($res);exit;
				return;
			}
		}
		public function LoadAdminData(){
			global $CMS, $DB;
			$DB->query("use ".DATABASE_SYSTEM);
			$sql = $DB->query("SELECT * FROM web_data WHERE admin_name LIKE '{$CMS->input['username']}' AND domain LIKE '{$CMS->vars['root_domain']}'");
			if($data = $sql->fetchAll()){
				return $data[0];
			}else{
				return false;
			}
		}
		public function LoadEmployData(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT * FROM employ WHERE name LIKE '{$CMS->input['username']}'");
			if($data = $sql->fetchAll()){
				return $data[0];
			}else{
				return false;
			}
		}
	}