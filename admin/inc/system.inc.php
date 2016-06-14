<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->admin['style_dir'] = $CMS->vars['root_domain']."/".ADMIN_F_SKIN."/style";
	$CMS->admin['system'] = new Admin();
	$CMS->admin['system']->Autorun();
	$admin_menu = array(
		
		/* Default
			array(
				'root' => array(
					'icon' => 'icon bootstrap: fa-',
					'link' => 'link',
					'lang' => 'lang id',
					'type' => 'type: link, header',
					'security' => 'security code'
				),
				'sub' => array(
					//One item
					'item' => array(
						'icon' => 'fa-cart-plus',
						'link' => '#',
						'lang' => 'acp_admin_menu_product_add',
					),
				)
			)
		*/
		
		//dashboard link
		array(
			'root' => array(
				'icon' => 'fa-home text-red',
				'link' => '?site=admin',
				'lang' => 'acp_menu_item_home',
				'type' => 'link',
			)
		),
		array(
			'root' => array(
				'icon' => 'fa-home text',
				'link' => '?site=home',
				'lang' => 'acp_menu_item_homepage',
				'type' => 'link',
			)
		),
		//header product
		/*
		array(
			'root' => array(
				'icon' => '',
				'link' => '',
				'lang' => 'acp_menu_prods',
				'type' => 'header',
			)
		),
		//product
		array(
			'root' => array(
				'icon' => 'fa-shopping-cart text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_product',
				'type' => 'link',
			),
			'sub' => array(
				//add product
				array(
					'icon' => 'fa-cart-plus',
					'link' => '?site=admin&page=product&action=add',
					'lang' => 'acp_menu_item_product_add',
				),
				//list
				array(
					'icon' => 'fa-list-ul',
					'link' => '?site=admin&page=product&action=viewlist',
					'lang' => 'acp_menu_item_product_list',
				),
				//properties
				array(
					'icon' => 'fa-cubes',
					'link' => '?site=admin&page=product&action=properties',
					'lang' => 'acp_menu_item_product_prop',
				),
				//Order
				array(
					'icon' => 'fa-calendar-check-o',
					'link' => '?site=admin&page=product&action=order',
					'lang' => 'acp_menu_item_product_order',
				),
				//Store
				array(
					'icon' => 'fa-bar-chart-o',
					'link' => '?site=admin&page=product&action=store',
					'lang' => 'acp_menu_item_product_store',
				),
				//Mail, feedback
				array(
					'icon' => 'fa-envelope',
					'link' => '?site=admin&page=product&action=feedback',
					'lang' => 'acp_menu_item_product_feedback',
				),
			)
		),
		//header product category
		array(
			'root' => array(
				'icon' => 'fa-navicon text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_productcat',
				'type' => 'link',
			),
			'sub' => array(
				//add product category
				array(
					'icon' => 'fa-plus-circle',
					'link' => '?site=admin&page=product_category&action=add',
					'lang' => 'acp_menu_item_productcat_add',
				),
				//view list
				array(
					'icon' => 'fa-list-ul',
					'link' => '?site=admin&page=product_category&action=viewlist',
					'lang' => 'acp_menu_item_productcat_list',
				)
			)
		), */
		//header post
		array(
			'root' => array(
				'icon' => '',
				'link' => '',
				'lang' => 'acp_menu_posts',
				'type' => 'header',
			)
		),
		//post
		array(
			'root' => array(
				'icon' => 'fa-file-text text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_post',
				'type' => 'link',
			),
			'sub' => array(
				//add post
				array(
					'icon' => 'fa-pencil',
					'link' => '?site=admin&page=post&action=add',
					'lang' => 'acp_menu_item_post_add',
				),
				//view list
				array(
					'icon' => 'fa-list-ul',
					'link' => '?site=admin&page=post&action=viewlist',
					'lang' => 'acp_menu_item_post_list',
				)
			)
		),
		//post category
		array(
			'root' => array(
				'icon' => 'fa-navicon text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_postcat',
				'type' => 'link',
			),
			'sub' => array(
				//add post cateogyr
				array(
					'icon' => 'fa-plus-circle',
					'link' => '?site=admin&page=post_category&action=add',
					'lang' => 'acp_menu_item_postcat_add',
				),
				//view list
				array(
					'icon' => 'fa-list-ul',
					'link' => '?site=admin&page=post_category&action=viewlist',
					'lang' => 'acp_menu_item_postcat_list',
				)
			)
		),
		//header system
		array(
			'root' => array(
				'icon' => '',
				'link' => '',
				'lang' => 'acp_menu_system',
				'type' => 'header',
			)
		),
		//system
		array(
			'root' => array(
				'icon' => 'fa-cogs text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_system_config',
				'type' => 'link',
			),
			'sub' => array(
				//system setting
				array(
					'icon' => 'fa-wrench',
					'link' => '?site=admin&page=config&action=general_config',
					'lang' => 'acp_menu_header_system_config_setting',
				),
				//change info
				array(
					'icon' => 'fa-eraser',
					'link' => '?site=admin&page=config&action=info',
					'lang' => 'acp_menu_header_system_config_changeinfo',
				),
				//language
				array(
					'icon' => 'fa-globe',
					'link' => '?site=admin&page=config&action=language',
					'lang' => 'acp_menu_header_system_config_language',
				),
				//currency
				/*
				array(
					'icon' => 'fa-dollar',
					'link' => '?site=admin&page=config&action=currency',
					'lang' => 'acp_menu_header_system_config_currentcy',
				),
				*/
			)
		),
		//config
		array(
			'root' => array(
				'icon' => 'fa-desktop text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_config_themes',
				'type' => 'link',
			),
			'sub' => array(
				//change template
				array(
					'icon' => 'fa-newspaper-o',
					'link' => '?site=admin&page=change_tpl&action=viewlist',
					'lang' => 'acp_menu_header_config_themes_changetpl',
				),
				//theme customize
				array(
					'icon' => 'fa-clipboard',
					'link' => '?site=admin&page=edit_tpl&action=viewlist',
					'lang' => 'acp_menu_header_config_themes_custom',
				),
				//change template
				/*
				array(
					'icon' => 'fa-cogs',
					'link' => '?site=admin&page=change_tpl&action=change_header',
					'lang' => 'acp_menu_header_config_themes_change_header',
				),
				//theme customize
				array(
					'icon' => 'fa-cogs',
					'link' => '?site=admin&page=edit_tpl&action=change_footer',
					'lang' => 'acp_menu_header_config_themes_change_footer',
				),
				*/
			)
		),
		//menu
		array(
			'root' => array(
				'icon' => 'fa-list-ul text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_menu',
				'type' => 'link',
			),
			'sub' => array(
				//upload image
				array(
					'icon' => 'fa-edit',
					'link' => '?site=admin&page=menu&action=editmenu',
					'lang' => 'acp_menu_header_config_mainmenu',
				),
				//image manage
				array(
					'icon' => 'fa-list-ul',
					'link' => '?site=admin&page=menu&action=viewlist_menu',
					'lang' => 'acp_menu_header_config_mainmenu_list',
				)
			)
		),
		//slider
		array(
			'root' => array(
				'icon' => 'fa-tv text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_slider',
				'type' => 'link',
			),
			'sub' => array(
				//upload image
				array(
					'icon' => 'fa-edit',
					'link' => '?site=admin&page=slider&action=add',
					'lang' => 'acp_menu_header_slider_add',
				),
				//image manage
				array(
					'icon' => 'fa-list-ul',
					'link' => '?site=admin&page=slider&action=viewlist',
					'lang' => 'acp_menu_header_slider_manage',
				)
			)
		),
		//module manage
		/*
		array(
			'root' => array(
				'icon' => 'fa-cubes text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_config_module_manage',
				'type' => 'link',
			)
		),
		*/
		//header member
		array(
			'root' => array(
				'icon' => '',
				'link' => '',
				'lang' => 'acp_menu_member',
				'type' => 'header',
			)
		),
		//member
		array(
			'root' => array(
				'icon' => 'fa-user text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_member',
				'type' => 'link',
			),
			'sub' => array(
				//add member
				array(
					'icon' => 'fa-user-plus',
					'link' => '?site=admin&page=member&action=viewlist',
					'lang' => 'acp_menu_header_member_add',
				),
				//member manage
				array(
					'icon' => 'fa-share-alt',
					'link' => '?site=admin&page=member&action=viewlist',
					'lang' => 'acp_menu_header_member_manage',
				)
			)
		),
		//customer
		array(
			'root' => array(
				'icon' => 'fa-user-secret text-green',
				'link' => '?site=admin&page=user&action=viewlist',
				'lang' => 'acp_menu_header_customer',
				'type' => 'link',
			)
		),
		//customer
		array(
			'root' => array(
				'icon' => 'fa-envelope-o text-green',
				'link' => '?site=admin&page=contact&action=viewlist',
				'lang' => 'acp_menu_header_contact',
				'type' => 'link',
			)
		),
		//header media
		/*
		array(
			'root' => array(
				'icon' => '',
				'link' => '',
				'lang' => 'acp_menu_media',
				'type' => 'header',
			)
		),
		//media
		array(
			'root' => array(
				'icon' => 'fa-photo text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_image',
				'type' => 'link',
			),
			'sub' => array(
				//upload image
				array(
					'icon' => 'fa-upload',
					'link' => '#',
					'lang' => 'acp_menu_header_image_add',
				),
				//image manage
				array(
					'icon' => 'fa-th',
					'link' => '#',
					'lang' => 'acp_menu_header_image_manage',
				)
			)
		),
		//gallery
		array(
			'root' => array(
				'icon' => 'fa-indent text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_gallery',
				'type' => 'link',
			),
			'sub' => array(
				//create gallery
				array(
					'icon' => 'fa-puzzle-piece',
					'link' => '#',
					'lang' => 'acp_menu_header_gallery_add',
				),
				//gallery manage
				array(
					'icon' => 'fa-th',
					'link' => '#',
					'lang' => 'acp_menu_header_gallery_manage',
				)
			)
		),
		//video
		array(
			'root' => array(
				'icon' => 'fa-camera text-green',
				'link' => '#',
				'lang' => 'acp_menu_header_video',
				'type' => 'link',
			),
			'sub' => array(
				//upload video
				array(
					'icon' => 'fa-upload',
					'link' => '#',
					'lang' => 'acp_menu_header_video_add',
				),
				//video manage
				array(
					'icon' => 'fa-th',
					'link' => '#',
					'lang' => 'acp_menu_header_video_manage',
				)
			)
		),*/
	);
	class Admin{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			
			return true;
		}
		public function LoadSkinModule($module = false){
			global $CMS, $DB;
			if($module){
				$file = ADMIN_F_MODULE."/".$module."/skin/skin_".$module.".php";
				if(file_exists($file)){
					require($file);
				}else{
					echo "System error!!! {$file} not exist!";
				}
			}else{
				return false;
			}
		}
		public function LoadModule($module = false){
			global $CMS, $DB;
			if($module){
				$file = ADMIN_F_MODULE."/".$module."/index.php";
				if(file_exists($file)){
					require($file);
				}else{
					echo "System error!!! {$file} not exist!";
				}
			}else{
				return false;
			}
		}
		public function LoadLanguage($name = false){
			global $CMS, $DB;
			if($name){
				$file = ADMIN_LANGUAGE_FOLDER."/{$CMS->vars['language']}/{$name}.php";
				if(file_exists($file)){
					require($file);
				}else{
					echo "System error!!! {$file} not exist!";
				}
			}
			$CMS->vars['lang'] = array_merge($CMS->vars['lang'], $language);
			return $CMS->vars['lang'];
		}
		public function SpecialLoadLanguage($name = false){
			global $CMS, $DB;
			if($name){
				$file = ADMIN_LANGUAGE_FOLDER."/{$name}.php";
				if(file_exists($file)){
					require($file);
				}else{
					echo "System error!!! {$file} not exist!";
				}
			}
			return $language;
		}
		
		//test
		public function ShowMenuItem(){
			global $admin_menu;
			echo "<pre>";print_r($admin_menu);
		}
		//Get
		public function GetMenuItem(){
			global $admin_menu;
			return $admin_menu;
		}
		//Add
		public function AddMenuItem($item = false){
			global $admin_menu;
			if($item){
				$admin_menu = array_merge($admin_menu, $item);
			}else{
				return false;
			}
		}
	}