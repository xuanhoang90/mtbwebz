<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	if(isset($_SESSION['member'])){
		$CMS->admin['member'] = $_SESSION['member'];
		$CMS->member = new AdminMember();
		$CMS->member->Autorun();
	}
	class AdminMember{
		public function __construct(){
			return true;
		}
		public function Is_Admin(){
			if(isset($_SESSION['admin'])){
				return true;
			}else{
				return false;
			}
		}
		public function Autorun(){
			global $CMS, $DB, $USER;
			if($this->Is_Admin()){
				$data = $this->LoadAdminData();
				$USER->data['id'] = "0";
				$USER->data['display_name'] = $data['name'];
				$USER->data['email'] = $data['email'];
				$USER->data['user_image'] = $data['avatar'];
				$USER->data['permission'] = "All";
				$USER->data['admin_type'] = "Admin";
			}else{
				$data = $this->LoadMemberData();
				$USER->data['id'] = $data['id'];
				$USER->data['display_name'] = $data['display_name'];
				$USER->data['email'] = $data['email'];
				$USER->data['user_image'] = $data['image'];
				$USER->data['permission'] = $data['permission'];
				$USER->data['admin_type'] = "Sup member";
			}
		}
		public function LoadAdminData(){
			global $CMS, $DB, $USER;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT * FROM admin_data WHERE 1");
			if($data = $sql->fetchAll()){
				return $data[0];
			}else{
				return false;
			}
		}
		public function LoadMemberData(){
			global $CMS, $DB, $USER;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT * FROM employ WHERE name LIKE '{$CMS->admin['member']}'");
			if($data = $sql->fetchAll()){
				return $data[0];
			}else{
				return false;
			}
		}
	}
?>