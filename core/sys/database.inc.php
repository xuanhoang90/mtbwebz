<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$DB = new PDO('mysql:host='.DATABASE_HOST.';dbname='.DATABASE_SYSTEM.';charset=utf8', DATABASE_USER, DATABASE_PASSWORD);
	
	//check page domain->select db
	
	/* foreach($DB->query('SELECT * FROM db') as $row) {
		echo $row['Host'].' '.$row['Db']; //etc...
	} */