<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	//include system files
	function LoadSystemFile($dir){
		$files = array_diff(scandir($dir), array('..', '.'));
		if(sizeof($files)){
			foreach($files as $file){
				if (preg_match("/.php/i", $file)) {
					if(is_file($dir."/".$file)){
						echo $dir."/".$file."<br/>";
						include $dir."/".$file;
					}
				}
			}
			return;
		}else{
			return;
		}
	}
	$system = array("core");
	foreach($system as $sys){
		foreach(glob($sys.'/*', GLOB_ONLYDIR) as $dir) {
			$s = $sys.'/'.basename($dir);
			$files = array_diff(scandir($s), array('..', '.'));
			foreach($files as $file){
				if (preg_match("/.php/i", $file)) {
					if(is_file($s."/".$file)){
						//echo $s."/".$file."<br/>";
						include_once $s."/".$file;
					}
				}
			}
		}
	}
?>