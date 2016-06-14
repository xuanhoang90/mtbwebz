<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	
	$CLASS->language = new Language();
	class Language{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			
			return $data;
		}
	}