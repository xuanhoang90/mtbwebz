<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->main_attachment = new ACP_Attachment();
	class ACP_Attachment{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			
			return true;
		}
		public function LoadListAttachmentData($type = false, $limit = 1000000){
			global $CMS, $DB;
			switch($type){
				case 'image':
					$type = "1";
					break;
				case 'video':
					$type = "2";
					break;
				default:
					$type = false;
					break;
			}
			if($type){
				$DB->query("use ".WEBSITE_DBNAME);
				$sql = $DB->query("SELECT link FROM media WHERE 1=1 AND type='{$type}' ORDER BY id DESC LIMIT {$limit}");
				if($data = $sql->fetchAll()){
					return $data;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		public function LoadListAttachmentDataSize($type = false, $limit = 1000000){
			global $CMS, $DB;
			switch($type){
				case 'image':
					$type = "1";
					break;
				case 'video':
					$type = "2";
					break;
				default:
					$type = false;
					break;
			}
			if($type){
				$DB->query("use ".WEBSITE_DBNAME);
				$sql = $DB->query("SELECT sum(status) FROM media WHERE type='{$type}'");
				if($data = $sql->fetchAll()){
					return $data[0]['sum(status)'];
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		public function SizeCounter(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT SUM(size) FROM media WHERE 1");
			if($data = $sql->fetchAll()){
				return $data[0][0];
			}else{
				return false;
			}
		}
		public function SaveAttachmentData($type = false, $data){
			global $CMS, $DB;
			if($type){
				$DB->query("use ".WEBSITE_DBNAME);
				$today = date('Y-m-d H:i:s');
				return $DB->query("INSERT INTO media (type, link, size, date_upload) VALUES ('{$type}', '{$data['files'][0]}', '{$data['metas'][0]['size']}', '{$today}')");
			}else{
				return false;
			}
		}
	}