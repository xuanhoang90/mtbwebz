<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Post = new ACP_Post();
	$CMS->ACP_Post->Autorun();
	class ACP_Post{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'viewlist':
					$this->PostList();
					break;
				case 'add':
					$this->CreatePost();
					break;
				case 'add_do':
					$this->SavePost();
					break;
				case 'clone':
					$this->EditPost();
					break;
				case 'clone_do':
					$this->SavePost();
					break;
				case 'edit':
					$this->EditPost();
					break;
				case 'delete':
					$this->DeletePost();
					break;
				case 'edit_do':
					$this->UpdatePost();
					break;
				default:
					$this->PageDefault();
					break;
			}
			return true;
		}
		public function PostList(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('post');
			echo $CMS->skin_post->PageDefault();exit;
			return;
		}
		public function CreatePost(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('post');
			echo $CMS->skin_post->CreatePost();exit;
			return;
		}
		public function SavePost(){
			global $CMS, $DB;
			$newId = $CMS->main_object->SaveObjectPrimaryData("post", "insert");
			header("Location: {$CMS->vars['root_domain']}?site=admin&page=post&action=edit&id=".$newId);exit;
			return;
		}
		public function EditPost(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('post');
			echo $CMS->skin_post->EditPost();exit;
			return;
		}
		public function UpdatePost(){
			global $CMS, $DB;
			$newId = $CMS->main_object->SaveObjectPrimaryData("post", "update");
			header("Location: {$CMS->vars['root_domain']}?site=admin&page=post&action=edit&id=".$newId);exit;
			return;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('post');
			echo $CMS->skin_post->PageDefault();exit;
			return;
		}
		public function DeletePost(){
			global $CMS, $DB;
			return $CMS->main_object->DeleteObject();
		}
	}