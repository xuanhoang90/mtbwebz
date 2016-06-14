<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	require 'vendor/Smarty.class.php';

	$CMS->tpl = new ClassTpl();
	class ClassTpl{
		public $debugging = false;
		public $caching = false;
		public $force_compile = true;
		public $cache_lifetime = 0;
		public $data = array();
		public function Display($file = false, $echo = true){
			global $CMS, $DB, $USER;
			$smarty = new Smarty;
			//set cache and compile dir
			$smarty->setCacheDir("./data/cache/");
			$smarty->setCompileDir("./data/template_c/");
			$smarty->force_compile = $this->force_compile;
			$smarty->debugging = $this->debugging;
			$smarty->caching = $this->caching;
			$smarty->cache_lifetime = $this->cache_lifetime;
			if($file){
				//check template website use.
				$file_dir = "themes/".$file.".tpl";
				if(is_file($file_dir)){
					$smarty->assign($this->data);
					if($echo){
						return $smarty->display($file_dir);
					}else{
						return $smarty->fetch($file_dir);
					}
				}else{
					echo "File: <b>{$file_dir}</b> is missing.";
				}
			}
		}
	}
?>