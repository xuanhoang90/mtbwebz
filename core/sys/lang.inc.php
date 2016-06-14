<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->lang = new Language();
	$CMS->lang->Autorun();
	$CMS->vars['lang'] = array();
	class Language{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			
			return true;
		}
		public function LoadLanguage($name = false){
			global $CMS, $DB;
			if($name){
				$file = LANGUAGE_FOLDER."/{$CMS->vars['language']}/{$name}.php";
				if(file_exists($file)){
					require($file);
				}else{
					echo "System error!!! {$file} not exist!";
				}
			}
			$CMS->vars['lang'] = array_merge($CMS->vars['lang'], $language);
			return $CMS->vars['lang'];
		}
	}