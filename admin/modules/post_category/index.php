<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_PostCategory = new ACP_PostCategory();
	$CMS->ACP_PostCategory->Autorun();
	class ACP_PostCategory{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'viewlist':
					$this->PostCategoryList();
					break;
				case 'add':
					$this->CreatePostCategory();
					break;
				case 'add_do':
					$this->SavePostCategory();
					break;
				case 'clone':
					$this->EditPostCategory();
					break;
				case 'clone_do':
					$this->SavePostCategory();
					break;
				case 'edit':
					$this->EditPostCategory();
					break;
				case 'delete':
					$this->DeletePostCategory();
					break;
				case 'edit_do':
					$this->UpdatePostCategory();
					break;
				default:
					$this->PageDefault();
					break;
			}
			return true;
		}
		public function PostCategoryList(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('post_category');
			echo $CMS->skin_post_category->PageDefault();exit;
			return;
		}
		public function CreatePostCategory(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('post_category');
			echo $CMS->skin_post_category->CreatePostCategory();exit;
			return;
		}
		public function SavePostCategory(){
			global $CMS, $DB;
			$newId = $CMS->main_object->SaveObjectPrimaryData("post_category", "insert");
			header("Location: {$CMS->vars['root_domain']}?site=admin&page=post_category&action=edit&id=".$newId);exit;
			return;
		}
		public function EditPostCategory(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('post_category');
			echo $CMS->skin_post_category->EditPostCategory();exit;
			return;
		}
		public function UpdatePostCategory(){
			global $CMS, $DB;
			$newId = $CMS->main_object->SaveObjectPrimaryData("post_category", "update");
			header("Location: {$CMS->vars['root_domain']}?site=admin&page=post_category&action=edit&id=".$newId);exit;
			return;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('post_category');
			echo $CMS->skin_post_category->PageDefault();exit;
			return;
		}
		public function DeletePostCategory(){
			global $CMS, $DB;
			return $CMS->main_object->DeleteObject();
		}
	}