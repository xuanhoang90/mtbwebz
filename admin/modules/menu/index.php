<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Menu = new ACP_Menu();
	$CMS->ACP_Menu->Autorun();
	class ACP_Menu{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'viewlist_menu':
					$this->ListMenu();
					break;
				case 'editmenu':
					$this->EditMainMenu();
					break;
				case 'deletemenu':
					echo $this->DeleteMenu();exit;
					break;
				case 'savemenu':
					$this->SaveMenu();
					break;
				case 'menu_select':
					$this->LoadMenuSelect();
					break;
				default:
					$this->ListMenu();
					break;
			}
			return true;
		}
		public function ListMenu(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('menu');
			echo $CMS->skin_menu->ListMenu();exit;
			return;
		}
		public function EditMainMenu(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('menu');
			echo $CMS->skin_menu->EditMainMenu();exit;
			return;
		}
		public function LoadMenuSelect(){
			global $CMS, $DB;
			echo $CMS->admin['skin_global']->ListMenuSelect();exit;
			return;
		}
		public function SaveMenu(){
			global $CMS, $DB;
			if(intval($CMS->input['id'])){
				$menu_id = $CMS->input['id'];
				return $this->UpdateMenu($menu_id);
			}else{
				return $this->AddNewMenu();
			}
		}
		public function UpdateMenu($menu_id){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$menuData = mysql_real_escape_string(serialize($CMS->input['menudata']));
			$sql = "UPDATE menu SET name='{$CMS->input['menuname']}', data='{$menuData}' WHERE id='{$menu_id}'";
			if($DB->query($sql)){
				$res = array("status" => "ok","reload" => "false");
			}else{
				$res = array("status" => "error","reload" => "false");
			}
			echo json_encode($res);exit;
		}
		public function AddNewMenu(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$menuData = mysql_real_escape_string(serialize($CMS->input['menudata']));
			$sql = "INSERT INTO menu(name, data) VALUES ('{$CMS->input['menuname']}', '{$menuData}')";
			if($DB->query($sql)){
				$res = array("status" => $CMS->vars['root_domain']."?site=admin&page=menu&action=editmenu&id=".$DB->lastInsertId(),"reload" => "true");
			}else{
				$res = array("status" => "error","reload" => "false");
			}
			echo json_encode($res);exit;
		}
		public function DeleteMenu(){
			global $CMS, $DB;
			if(intval($CMS->input['id'])){
				$menu_id = $CMS->input['id'];
				$DB->query("use ".WEBSITE_DBNAME);
				$sql = "DELETE FROM menu WHERE id='{$menu_id}'";
				if($DB->query($sql)){
					return "OK";
				}else{
					return "Error sql";
				}
			}else{
				return "Error id";
			}
		}
	}