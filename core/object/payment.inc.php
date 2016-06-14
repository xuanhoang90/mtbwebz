<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	
	$CLASS->payment = new Payment();
	class Payment{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			
			return $data;
		}
	}