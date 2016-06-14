<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Slider = new ACP_Slider();
	$CMS->ACP_Slider->Autorun();
	class ACP_Slider{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'add':
					$this->AddSlider();
					break;
				case 'viewlist':
					$this->ListSlider();
					break;
				case 'deleteslider':
					echo $this->DeleteSlider();exit;
					break;
				case 'slider_select':
					$this->LoadSliderSelect();
					break;
				case 'saveslider':
					$this->SaveSlider();
					break;
				default:
					$this->ListSlider();
					break;
			}
			return true;
		}
		public function AddSlider(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('slider');
			echo $CMS->skin_slider->AddSlider();exit;
			return;
		}
		public function ListSlider(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('slider');
			echo $CMS->skin_slider->ListSlider();exit;
			return;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('slider');
			echo $CMS->skin_slider->PageDefault();exit;
			return;
		}
		public function LoadSliderSelect(){
			global $CMS, $DB;
			echo $CMS->admin['skin_global']->ListSliderSelect();exit;
			return;
		}
		public function DeleteSlider(){
			global $CMS, $DB;
			if(intval($CMS->input['id'])){
				$slider_id = $CMS->input['id'];
				$DB->query("use ".WEBSITE_DBNAME);
				$sql = "DELETE FROM slider WHERE id='{$slider_id}'";
				if($DB->query($sql)){
					return "OK";
				}else{
					return "Error sql";
				}
			}else{
				return "Error id";
			}
		}
		public function SaveSlider(){
			global $CMS, $DB;
			if(intval($CMS->input['id'])){
				$slider_id = $CMS->input['id'];
				return $this->UpdateSlider($slider_id);
			}else{
				return $this->AddNewSlider();
			}
		}
		public function UpdateSlider($slider_id){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sliderData = mysql_real_escape_string(serialize($CMS->input['sliderdata']));
			$sql = "UPDATE slider SET name='{$CMS->input['slidername']}', data='{$sliderData}' WHERE id='{$slider_id}'";
			if($DB->query($sql)){
				$res = array("status" => "ok","reload" => "false");
			}else{
				$res = array("status" => "error","reload" => "false");
			}
			echo json_encode($res);exit;
		}
		public function AddNewSlider(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sliderData = mysql_real_escape_string(serialize($CMS->input['sliderdata']));
			$sql = "INSERT INTO slider(name, data) VALUES ('{$CMS->input['slidername']}', '{$sliderData}')";
			if($DB->query($sql)){
				$res = array("status" => $CMS->vars['root_domain']."?site=admin&page=slider&action=add&id=".$DB->lastInsertId(),"reload" => "true");
			}else{
				$res = array("status" => "error","reload" => "false");
			}
			echo json_encode($res);exit;
		}
	}