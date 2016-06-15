<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	
	$CLASS->main_object = new MainObject();
	class MainObject{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			
			return $data;
		}
		public function LoadObjectData($id = false){
			global $CMS, $DB;
			$data = false;
			if(intval($id)){
				$query = $DB->prepare("SELECT * FROM ".DATABASE_PREFIX."object WHERE xid = ? AND object_type='post' AND status=1 AND delete=0");
				$query->execute(array($id));
				if($result = $query->fetchAll()){
					$data = $result[0];
				}
			}
			return $data;
		}
	}
