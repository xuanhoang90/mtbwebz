<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$MemberPermissionCode = array(
		/* default = true. ig view = false -> all false 
			'security_code' => array(
				'view' => true|false,
				'add' => true|false,
				'edit' => true|false,
				'delete' => true|false,
			),
		*/
		'security_code' => array(
				'view' => 0,
				'add' => 1,
				'edit' => 0,
				'delete' => 1,
			),
			'security_code2' => array(
				'view' => 1,
				'add' => 1,
				'edit' => 0,
				'delete' => 1,
			),
	);
	if(isset($_SESSION['member'])){
		$CMS->admin['member'] = $_SESSION['member'];
		$CMS->permission = new MemberPermission();
		$CMS->permission->GetMemberPermissionCode();
	}
	class MemberPermission{
		public function __construct(){
			return true;
		}
		//test
		public function ShowMemberPermissionCode(){
			global $MemberPermissionCode;
			echo "<pre>";print_r($MemberPermissionCode);
		}
		//Get
		public function GetMemberPermissionCode(){
			global $MemberPermissionCode;
			$res = array();
			foreach($MemberPermissionCode as $key => $val){
				foreach($val as $sub_key => $sub_val){
					if($MemberPermissionCode[$key]['view']){
						$res[$key."_".$sub_key] = $sub_val;
					}else{
						$res[$key."_".$sub_key] = 0;
					}
				}
			}
			return $res;
		}
		//Add
		public function AddMemberPermissionCode($item = false){
			global $MemberPermissionCode;
			if($item){
				$MemberPermissionCode = array_merge($MemberPermissionCode, $item);
			}else{
				return false;
			}
		}
	}
?>