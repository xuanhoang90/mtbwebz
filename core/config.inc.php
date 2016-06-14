<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	
	define("DATABASE_HOST","localhost");
	define("DATABASE_SYSTEM","mtbwebz_db");
	define("DATABASE_USER","root");
	define("DATABASE_PASSWORD","");
	define("DATABASE_PREFIX","xmtb_");
	define("TABLE_PREFIX","taka_");
	define("LANGUAGE_FOLDER","language");
	define("ROOT_DOMAIN","http://".$_SERVER[HTTP_HOST]);