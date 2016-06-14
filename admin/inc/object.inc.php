<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->main_object = new MainObject();
	class MainObject{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			
			return true;
		}
		public function GetObjectTypeID($type = false){
			global $CMS, $DB;
			switch($type){
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
			return $type;
		}
		public function ObjectCount2($target = false, $type = "All"){
			global $CMS, $DB;
			$sql_add = "";
			if($type == "post_and_cat"){
				$sql_add = " AND type NOT IN (2, 4) ";
			}
			if($type == "product_and_cat"){
				$sql_add = " AND type NOT IN (1, 3) ";
			}
			if($type == "postcat"){
				$sql_add = " AND type NOT IN (2, 3, 4) ";
			}
			if($type == "productcat"){
				$sql_add = " AND type NOT IN (1, 3, 4) ";
			}
			if(!$target){
				$target = 0;
			}
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT COUNT(*) FROM object WHERE parent LIKE '%,{$target},%' {$sql_add}");
			if($data = $sql->fetchColumn()){
				return $data;
			}else{
				return false;
			}
		}
		public function LoadObjectByParent($target = false, $type = "All", $page = 1, $limit = 20){
			global $CMS, $DB;
			$sql_add = "";
			if($type == "post_and_cat"){
				$sql_add = " AND o.type NOT IN (2, 4) ";
			}
			if($type == "product_and_cat"){
				$sql_add = " AND o.type NOT IN (1, 3) ";
			}
			if($type == "postcat"){
				$sql_add = " AND o.type NOT IN (2, 3, 4) ";
			}
			if($type == "productcat"){
				$sql_add = " AND o.type NOT IN (1, 3, 4) ";
			}
			if(!$target){
				$target = 0;
			}
			$DB->query("use ".WEBSITE_DBNAME);
			$limit = $limit*($page-1).",".$limit;
			$sql = $DB->query("SELECT * FROM object o,object_description od WHERE o.id=od.object_id AND od.lang_id='1' AND 1=1 {$sql_add} AND o.delete='0' AND o.parent LIKE '%,{$target},%' ORDER BY o.type ASC, o.id DESC LIMIT {$limit}");
			if($data = $sql->fetchAll()){
				return $data;
			}else{
				return false;
			}
			return false;
		}
		public function DeleteObject(){
			global $CMS, $DB, $OBJECT, $USER;
			$res = array();
			if($CMS->input['id'] != ""){
				$DB->query("use ".WEBSITE_DBNAME);
				if($DB->query("UPDATE object SET `delete`='1' WHERE id='{$CMS->input['id']}'")){
					$res = array(
						'status' => 'success',
						'reason' => 'OK, done',
					);
				}else{
					$res = array(
						'status' => 'false',
						'reason' => 'SQL Error',
					);
				}
			}else{
				$res = array(
					'status' => 'false',
					'reason' => 'Error, No id input',
				);
			}
			echo json_encode($res);exit;
		}
		public function SaveTagsData($tags = false, $tags_slug = false, $langid = false, $type = 1, $objID = 0){
			global $CMS, $DB, $OBJECT, $USER;
			if($objID && $type){
				$DB->query("use ".WEBSITE_DBNAME);
				$DB->query("DELETE FROM tag WHERE object_id='{$objID}' AND lang_id='{$langid}'");
				$tags = explode(",", $tags);
				$tags_slug = explode(",", $tags_slug);
				$counter = sizeof($tags);
				if($counter){
					for($i = 0; $i < $counter; $i++){
						if($tags[$i] != ""){
							$DB->query("INSERT INTO tag (tag_name, nice_url, object_type, object_id, lang_id) VALUES ('{$tags[$i]}', '{$tags_slug[$i]}', '{$type}', '{$objID}', '{$langid}')");
						}
						//echo "INSERT INTO tag (tag_name, nice_url, object_type, object_id, lang_id) VALUES ('{$tags[$i]}', '{$tags_slug[$i]}', '{$type}', '{$objID}', '{$langid}')";
					}
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		public function SaveDescriptionData($type = false, $objID = false, $action = "insert"){
			global $CMS, $DB, $OBJECT, $USER;
			if($objID){
				$langAcess = $CMS->vars['language_access'];
				foreach($langAcess as $oneLang){
					$ObjData = $CMS->input['object_data'][$oneLang['id']];
					$DB->query("use ".WEBSITE_DBNAME);
					$name = mysql_real_escape_string($ObjData['name']);
					$short_description = mysql_real_escape_string($ObjData['short_description']);
					$content = mysql_real_escape_string($ObjData['content']);
					$meta_keyword = mysql_real_escape_string($ObjData['meta_keyword']);
					$nice_url = mysql_real_escape_string($ObjData['nice_url']);
					$sql = $DB->query("SELECT * FROM object o,object_description od WHERE od.nice_url='{$nice_url}' AND od.lang_id='{$oneLang['id']}' AND o.type='{$type}' AND o.id=od.object_id AND o.id NOT LIKE '{$objID}'");
					//echo "SELECT * FROM object o,object_description od WHERE od.nice_url='{$nice_url}' AND od.lang_id='{$oneLang['id']}' AND o.type='{$type}' AND o.id=od.object_id AND o.id NOT LIKE '{$objID}'";exit;
					if($data = $sql->fetchAll()){
						$nice_url .= "-".date("d-m-Y-H-i-s");
					}
					if($action == "insert"){
						$DB->query("INSERT INTO object_description (object_id, name, content, meta_keyword, short_description, nice_url, lang_id) VALUES ('{$objID}', '{$name}', '{$content}', '{$meta_keyword}', '{$short_description}', '{$nice_url}', '{$oneLang['id']}')");
					}
					if($action == "update"){
						$DB->query("UPDATE object_description SET name='{$name}', content='{$content}', meta_keyword='{$meta_keyword}', short_description='{$short_description}', nice_url='{$nice_url}' WHERE object_id='{$objID}' AND lang_id='{$oneLang['id']}'");
					}
					$this->SaveTagsData($ObjData['tag'], $ObjData['tag_slug'], $oneLang['id'], $type, $objID);
				}
			}else{
				return false;
			}
		}
		public function SaveObjectPrimaryData($type = false, $action = "insert"){
			global $CMS, $DB, $OBJECT, $USER;
			if($type = $this->GetObjectTypeID($type)){
				$parent = ",";
				$ObjData = $CMS->input['object_data'][1];
				if(is_array($ObjData['parent'])){
					foreach($ObjData['parent'] as $onPar){
						if($onPar != ""){
							$parent .= $onPar . ",";
						}
					}
				}else{
					$parent = ",0,";
				}
				$today = date('Y-m-d H:i:s');
				$image = mysql_real_escape_string($ObjData['image']);
				$image = str_replace($CMS->vars['root_domain']."/","",$image);
				$name = mysql_real_escape_string($ObjData['name']);
				$secret = md5($today.$image.$name);
				$DB->query("use ".WEBSITE_DBNAME);
				if($action == "insert"){
					//echo "INSERT INTO object (parent, type, viewed, date_created, created_by, image, status, secret) VALUES ('{$parent}', '{$type}', '0', '{$today}', '{$USER->data['id']}', '{$image}', '1', '{$secret}')";exit;
					if($DB->query("INSERT INTO object (parent, type, viewed, date_created, date_updated, created_by, image, status, secret) VALUES ('{$parent}', '{$type}', '0', '{$today}', '{$today}', '{$USER->data['id']}', '{$image}', '1', '{$secret}')")){
						$sql = $DB->query("SELECT * FROM object WHERE secret='{$secret}'");
						if($data = $sql->fetchAll()){
							$objID = $data[0]['id'];
						}else{
							echo "Error! SQL secret!";exit;
						}
						
					}
				}
				if($action == "update"){
					if($DB->query("UPDATE object SET parent='{$parent}', date_updated='{$today}', image='{$image}' WHERE id='{$CMS->input['id']}'")){
						$objID = $CMS->input['id'];
					}
				}
				$this->SaveDescriptionData($type, $objID, $action);
				return $objID;
			}
			return true;
		}
		public function SetupObjectData($type = false, $id = false){
			global $CMS, $DB, $OBJECT;
			$langAcess = $CMS->vars['language_access'];
			if(($type = $this->GetObjectTypeID($type)) && $id){
				foreach($langAcess as $oneLang){
					$DB->query("use ".WEBSITE_DBNAME);
					$sql = $DB->query("SELECT * FROM object o,object_description od WHERE o.id=od.object_id AND od.lang_id='{$oneLang['id']}' AND o.id='{$id}' AND o.type='{$type}' AND o.delete='0'");
					if($data = $sql->fetchAll()){
						$defaultOBdata = $data[0];
						//load tag list
						$sql = $DB->query("SELECT tag_name, nice_url FROM tag WHERE object_type='{$type}' AND lang_id='{$oneLang['id']}' AND object_id='{$id}'");
						//echo "SELECT tag_name, nice_url FROM tag WHERE object_type='{$type}' AND lang_id='{$oneLang['id']}' AND object_id='{$id}'";exit;
						if($data = $sql->fetchAll()){
							//add tag data to object
							$tags = "";
							$tags_slug = "";
							foreach($data as $tag){
								$tags .= $tag['tag_name'].",";
								$tags_slug .= $tag['nice_url'].",";
							}
						}else{
							//tag data = 0
							$tags = "";
							$tags_slug = "";
						}
						//check if product -> load extend data
						if($type == "4"){
							$sql = $DB->query("SELECT * FROM product WHERE object_id='{$id}'");
							if($data = $sql->fetchAll()){
								//add extend product data
								$productExtend = $data[0];
							}else{
								//product data = 0
								$productExtend = 0;
							}
						}else{
							$productExtend = 0;
						}
						//set up data for lang $OBJECT[$oneLang['id']] = data
						$OBJECT[$oneLang['id']] = array(
							"name" => $defaultOBdata['name'],
							"nice_url" => $defaultOBdata['nice_url'],
							"meta_keyword" => $defaultOBdata['meta_keyword'],
							"short_description" => $defaultOBdata['short_description'],
							"content" => $defaultOBdata['content'],
							"image" => $defaultOBdata['image'],
							"parent" => $defaultOBdata['parent'],
							"tags" => $tags,
							"tags_slug" => $tags_slug,
							"product_extend" => $productExtend,
						);
					}else{
						return false;
					}
				}
				//echo "<pre>";print_r($OBJECT);exit;
				return true;
			}else{
				return false;
			}
		}
		public function LoadObjectTypeListData($type = false, $page = 1, $iPerpage = 10){
			global $CMS, $DB;
			if($type = $this->GetObjectTypeID($type)){
				$DB->query("use ".WEBSITE_DBNAME);
				$limit = $iPerpage*($page-1).",".$iPerpage;
				$sql = $DB->query("SELECT * FROM object o,object_description od WHERE o.id=od.object_id AND od.lang_id='1' AND 1=1 AND o.type='{$type}' AND o.delete='0' ORDER BY o.id DESC LIMIT {$limit}");
				if($data = $sql->fetchAll()){
					return $data;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		public function ObjectCount($type = false){
			global $CMS, $DB;
			if($type = $this->GetObjectTypeID($type)){
				$DB->query("use ".WEBSITE_DBNAME);
				$sql = $DB->query("SELECT COUNT(*) FROM object WHERE type='{$type}'");
				if($data = $sql->fetchColumn()){
					return $data;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		public function GetNameParentObject($id = false){
			global $CMS, $DB;
			if($id){
				$DB->query("use ".WEBSITE_DBNAME);
				$output['name'] = "";
				$list = explode(",",$id);
				if(is_array($list)){
					$tmp = array();
					foreach($list as $id){
						$sql = $DB->query("SELECT * FROM object o,object_description od WHERE o.id=od.object_id AND od.lang_id='1' AND 1=1 AND o.id='{$id}' AND o.delete='0' ORDER BY o.id");
						if($data = $sql->fetchAll()){
							array_push($tmp,"<a>".$data[0]['name']."</a>");
						}
					}
					$output['name'] = implode(",", $tmp);
				}else{
					$sql = $DB->query("SELECT * FROM object o,object_description od WHERE o.id=od.object_id AND od.lang_id='1' AND 1=1 AND o.id='{$id}' AND o.delete='0' ORDER BY o.id");
					if($data = $sql->fetchAll()){
						$output['name'] .= "<a>".$data[0]['name']."</a>";
					}
				}
				return $output;
			}else{
				return false;
			}
		}
		public function GetObjectName($id = false){
			global $CMS, $DB;
			if($id){
				$DB->query("use ".WEBSITE_DBNAME);				
				$sql = $DB->query("SELECT * FROM object o,object_description od WHERE o.id=od.object_id AND od.lang_id='1' AND 1=1 AND o.id='{$id}' AND o.delete='0'");
				if($data = $sql->fetchAll()){
					return $data[0]['name'];
				}else{
					return "<i>No name</i>";
				}
			}else{
				return false;
			}
		}
		public function LoadObjectDataById($id = false){
			global $CMS, $DB;
			if($id){
				$DB->query("use ".WEBSITE_DBNAME);
				$sql = $DB->query("SELECT * FROM object o,object_description od WHERE o.id=od.object_id AND od.lang_id='1' AND 1=1 AND o.id='{$id}' AND o.delete='0' ORDER BY o.id");
				if($data = $sql->fetchAll()){
					return $data[0];
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		public function LoadObjectDataByOption($parent = "0", $lang_id = "1", $type = "post"){
			global $CMS, $DB;
			if($type = $this->GetObjectTypeID($type)){
				$DB->query("use ".WEBSITE_DBNAME);
				$sql_add = "";
				if($CMS->input['id'] != "" && $CMS->input['action'] != "clone"){
					$sql_add = "AND o.id NOT LIKE '{$CMS->input['id']}'";
				}
				if($CMS->input['id'] != "" && $CMS->input['action'] == "edit"){
					if($parent == $CMS->input['id']){
						return false;
					}
				}
				if($CMS->input['id'] == ""){
					$sql_add = "";
				}
				$sql = $DB->query("SELECT o.id, od.name FROM object o,object_description od WHERE o.id=od.object_id AND od.lang_id='{$lang_id}' AND 1=1 AND o.parent LIKE '%,{$parent},%' AND o.delete='0' AND o.type='{$type}' {$sql_add} ORDER BY o.id");
				if($data = $sql->fetchAll()){
					return $data;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}