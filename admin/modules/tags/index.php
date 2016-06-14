<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Tags = new ACP_Tags();
	$CMS->ACP_Tags->Autorun();
	class ACP_Tags{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'ajax':
					if($CMS->input['subact'] == "auto_complete"){
						$this->LoadAutoCompleteList();
					}
					break;
				default:
					$this->FileUpload();
					break;
			}
			return true;
		}
		public function LoadAutoCompleteList(){
			global $CMS, $DB;
			$output = "";
			if($data = $this->GetTagsRelated()){
				foreach($data as $tag){
					$output .=<<<HERE
					<p class="tag-item" data="{$tag['tag_name']}">{$tag['tag_name']}<i class="fa fa-eyedropper"></i></p>
HERE;
				}
			}
			echo $output;exit;
			return;
		}
		public function GetTagsRelated(){
			global $CMS, $DB;
			switch($CMS->input['object_type']){
				case 'post_category':
					$type = "1";
					break;
				case 'product_category':
					$type = "2";
					break;
				case 'post':
					$type = "3";
					break;
				case 'product':
					$type = "4";
					break;
				default:
					$type = false;
					break;
			}
			$DB->query("use ".WEBSITE_DBNAME);
			//echo "SELECT tag_name FROM tag WHERE object_type='{$type}' AND lang_id='{$CMS->input['current_lang']}' AND nice_url LIKE '%{$CMS->input['tag_text']}%'";exit;
			$sql = $DB->query("SELECT tag_name FROM tag WHERE object_type='{$type}' AND lang_id='{$CMS->input['current_lang']}' AND nice_url LIKE '%{$CMS->input['tag_text']}%'");
			if($data = $sql->fetchAll()){
				return $data;
			}else{
				return false;
			}
		}
	}