<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->ACP_AttachmentFile = new ACP_AttachmentFile();
	$CMS->ACP_AttachmentFile->Autorun();
	class ACP_AttachmentFile{
		public function __construct(){
			return true;
		}
		public function Autorun(){
			global $CMS, $DB;
			switch($CMS->input['action']){
				case 'upload_image':
					$this->ImageUpload();
					break;
				case 'video_image':
					$this->VideoUpload();
					break;
				case 'image_list':
					$this->ImageList();
					break;
				default:
					$this->FileUpload();
					break;
			}
			return true;
		}
		public function WebdataFreeSize(){
			global $CMS, $DB;
			return $CMS->main_attachment->SizeCounter();
		}
		public function SaveAttachmentData($data){
			global $CMS, $DB;
			$CMS->main_attachment->SaveAttachmentData("1", $data);
			return;
		}
		public function ImageList(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('attachment');
			echo $CMS->admin['skin_global']->ListAttachment();exit;
			return;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('attachment');
			echo $CMS->skin_attachment->PageDefault();exit;
			return;
		}
		public function ImageUpload(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('attachment');
			//start upload
			$data = $CMS->files->upload($_FILES['files'], array(
				'limit' => 10, //Maximum Limit of files. {null, Number}
				'maxSize' => $this->WebdataFreeSize(), //Maximum Size of files {null, Number(in MB's)}
				'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
				'required' => false, //Minimum one file is required for upload {Boolean}
				'uploadDir' => 'data/'.WEBSITE_FNAME.'/upload/images/', //Upload directory {String}
				'title' => array('auto', 10), //New file name {null, String, Array} *please read documentation in README.md
				'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
				'perms' => null, //Uploaded file permisions {null, Number}
				'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
				'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
				'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
				'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
				'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
				'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
			));
			if($data['isComplete']){
				// echo "OK";
				// $files = $data['data'];
				// print_r($files);
				$this->SaveAttachmentData($data['data']);
				$total = ceiling($CMS->vars['webdata_size']/(1024*1024),0.5);
				$used = ceiling($this->WebdataFreeSize()/(1024*1024),0.5);
				$percent = ceil($used*100/$total);
				$res = array(
					"status" => "success",
					"total" => $total,
					"used" => $used,
					"percent" => $percent,
				);
				echo json_encode($res);
			}

			if($data['hasErrors']){
				// echo "False";
				// $errors = $data['errors'];
				// print_r($errors);
				$res = array(
					"status" => "false",
				);
				echo json_encode($res);
			}
			return;
		}
		public function VideoUpload(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('attachment');
			//start upload
			return;
		}
		public function FileUpload(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadSkinModule('attachment');
			//start upload
			return;
		}
	}