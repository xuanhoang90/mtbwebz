<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_Product = new ACP_Product();
	$CMS->ACP_Product->Autorun();
	class ACP_Product{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'viewlist':
					$this->ProductList();
					break;
				case 'add':
					$this->CreateProduct();
					break;
				case 'add_do':
					$this->SaveProduct();
					break;
				case 'clone':
					$this->EditProduct();
					break;
				case 'clone_do':
					$this->SaveProduct();
					break;
				case 'edit':
					$this->EditProduct();
					break;
				case 'delete':
					$this->DeleteProduct();
					break;
				case 'edit_do':
					$this->UpdateProduct();
					break;
				default:
					$this->PageDefault();
					break;
			}
			return true;
		}
		public function ProductList(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('product');
			echo $CMS->skin_product->PageDefault();exit;
			return;
		}
		public function CreateProduct(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('product');
			echo $CMS->skin_product->CreateProduct();exit;
			return;
		}
		public function SaveProduct(){
			global $CMS, $DB;
			$newId = $CMS->main_object->SaveObjectPrimaryData("product", "insert");
			header("Location: {$CMS->vars['root_domain']}?site=admin&page=product&action=edit&id=".$newId);exit;
			return;
		}
		public function EditProduct(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('product');
			echo $CMS->skin_product->EditProduct();exit;
			return;
		}
		public function UpdateProduct(){
			global $CMS, $DB;
			$newId = $CMS->main_object->SaveObjectPrimaryData("product", "update");
			header("Location: {$CMS->vars['root_domain']}?site=admin&page=product&action=edit&id=".$newId);exit;
			return;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('product');
			echo $CMS->skin_product->PageDefault();exit;
			return;
		}
		public function DeleteProduct(){
			global $CMS, $DB;
			return $CMS->main_object->DeleteObject();
		}
	}