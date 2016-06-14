<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	
	$ClientRequest = new ClientRequest();
	$ClientRequest->Autorun();
	// echo "<pre>";print_r($CMS->input);
	class ClientRequest{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			$CMS->input = $this->AnalyticRequest();
			return true;
		}
		public function AnalyticRequest(){
			global $CMS, $DB;
			if(isset($_REQUEST['xmtb_request_uri'])){
				$xmtb_request_uri = explode("/", $_REQUEST['xmtb_request_uri']);
			}else{
				$xmtb_request_uri = array();
			}
			$tmp_in['xmtb_request_uri'] = array();
			foreach($xmtb_request_uri as $val){
				array_push($tmp_in['xmtb_request_uri'], $val);
			}
			$input = array_merge($_REQUEST, $tmp_in);
			return $input;
		}
	}