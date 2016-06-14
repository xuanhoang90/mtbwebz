<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_ProductCategory = new ACP_ProductCategory();
	$CMS->ACP_ProductCategory->Autorun();
	class ACP_ProductCategory{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'viewlist':
					$this->ProductCategoryList();
					break;
				case 'add':
					$this->CreateProductCategory();
					break;
				case 'add_do':
					$this->SaveProductCategory();
					break;
				case 'clone':
					$this->EditProductCategory();
					break;
				case 'clone_do':
					$this->SaveProductCategory();
					break;
				case 'edit':
					$this->EditProductCategory();
					break;
				case 'delete':
					$this->DeleteProductCategory();
					break;
				case 'edit_do':
					$this->UpdateProductCategory();
					break;
				default:
					$this->PageDefault();
					break;
			}
			return true;
		}
		public function ProductCategoryList(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('product_category');
			echo $CMS->skin_product_category->PageDefault();exit;
			return;
		}
		public function CreateProductCategory(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('product_category');
			echo $CMS->skin_product_category->CreateProductCategory();exit;
			return;
		}
		public function SaveProductCategory(){
			global $CMS, $DB;
			$newId = $CMS->main_object->SaveObjectPrimaryData("product_category", "insert");
			header("Location: {$CMS->vars['root_domain']}?site=admin&page=product_category&action=edit&id=".$newId);exit;
			return;
		}
		public function EditProductCategory(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('product_category');
			echo $CMS->skin_product_category->EditProductCategory();exit;
			return;
		}
		public function UpdateProductCategory(){
			global $CMS, $DB;
			$newId = $CMS->main_object->SaveObjectPrimaryData("product_category", "update");
			header("Location: {$CMS->vars['root_domain']}?site=admin&page=product_category&action=edit&id=".$newId);exit;
			return;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('product_category');
			echo $CMS->skin_product_category->PageDefault();exit;
			return;
		}
		public function DeleteProductCategory(){
			global $CMS, $DB;
			return $CMS->main_object->DeleteObject();
		}
	}