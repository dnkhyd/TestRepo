<?php


	include_once 'DAO/my_imagesDAO.php';
	include_once 'beans/my_imagesVO.php';
	
	/**
	 * @desc Implementation class for the my_imagesDAO.
	 * 
	 * Project name : MyKerala
	 * Created on   : 29-July-2010
	 * Module       : Admin Module
	 *
	 * @author K.Manjunath
	 * @version 1.0
	 * 
	 */

	class MyImagesImpl {
		
		private $imagesDao	=	null;
		private $imagesVo   =   null;
		
		
		/**
		 * @desc Default constructor which
		 *		 1.Instantiates objects used in this class
		 */
		 
		function __construct()
		{
			$this->imagesDao	=	new MyImagesDAO();
			$this->imagesVo		= 	new MyImagesVO();
		}
		
		/**
		 * @desc Saves Images Data
		 * 
		 * @param $img_src               source path of the image
		 * @param $img_title             title for the image
		 * @param $img_status            status of the image    
		 * @return  lastinserted id
		 */
		
		
		function saveImagesData ($img_src,$img_title,$img_status,$img_desc){
			
			$this->imagesVo->setImageSrc($img_src);
			$this->imagesVo->setImageTitle($img_title);
			$this->imagesVo->setStatus($img_status);
			$this->imagesVo->setImageDesc($img_desc);
			 $order = $this->imagesDao->getOrder();
			 $img_order = $order[0]['order_data'];
			 if($img_order>0){
			 	$img_order=$img_order+1;
					$this->imagesVo->setOrder($img_order);
			 }else{
			 	$this->imagesVo->setOrder(1);
			 }
			$result = $this->imagesDao->saveImages($this->imagesVo);
			return $result;
						
		}
		
		/**
		 * @desc Get the Images array whose status is 1 
		 * 
		 * @param $status                 status of the image
		 * @param $pageno                 page number which is 1
		 * @return array object of Images Data
		 */
		
		function getImagesData ($status,$pageno){
			
			$Images  = $this->imagesDao->getImages($status,$pageno);
			
			return $Images;
		}
		
	  /**
		 * @desc Get the Images Ids array whose status is 1 
		 * 
		 * @return array object of Images Ids 
		 */
		
		function getImagesIdData (){
			
			$Images  = $this->imagesDao->getImagesIds();
			
			return $Images;
		}
		
		/**
		 * @desc Total Images Count whose status is 1 
		 * 
		 * @param $status                 status of the image
		 * @return array object of Images Data
		 */
		
		function getImagesDataCount ($status){
			
			$Images  = $this->imagesDao->getImagesCount($status);
			
			return $Images[0]['total'];
		}
		
		
	  /**
		 * @desc Updates Image Data for the respective $image_id
		 * @param  $image_id              id of the image stored in the database
		 * @param  $img_title             title of the image
		 * @param  $img_order             Order of the image
		 * @return  rows affected
		 */
		
		function updateImageData ($image_id,$img_title,$img_desc){
			
			$this->imagesVo->setImageid($image_id);
			$this->imagesVo->setImageTitle($img_title);
			$this->imagesVo->setImageDesc($img_desc);
			$result = $this->imagesDao->updateImage($this->imagesVo);
			return $result;
						
		}
		/**
		 * @desc Updates Images Order
		 * @param  $images                 images array
		 * @param  $page                   page number which is 1
		 * @return  rows affected
		 */
		
		function updateImagesOrder ($images,$page){
				
			$result = $this->imagesDao->updateImageOrder($images,$page);
			return $result;
						
		}
		
		
		
		/**
		 * @desc Delete Image Data for the respective $image_id
		 * @param  $image_id               id of the image stored in the database
		 * @return  rows affected
		 */
		
		function deleteImageData ($image_id){
			
			$result = $this->imagesDao->deleteImage($image_id);
			return $result;
						
		}
		
		/**
		 * @desc Activate Image  for the respective $image_id
		 * @param  $image_id               id of the image stored in the database
		 * @return  rows affected
		 */
		
		function activateImageData ($image_id){
			
			$result = $this->imagesDao->activateImage($image_id);
			return $result;
						
		}
		
		/**
		 * @desc Inactivate Image for the respective $image_id
		 * @param  $image_id               id of the image stored in the database
		 * @return  rows affected
		 */
		
		function inActivateImageData ($image_id){
			
			$result = $this->imagesDao->inActivateImage($image_id);
			return $result;
						
		}
	
	  /**
		 * @desc get Images to be displayed in the home page.
		 * @param  $count               Number of images to be displayed
		 * @return  $Images array
		 */
		
		function getHomeImages ($count,$exclude){
				
			$result = $this->imagesDao->getHomeImages($count,$exclude);
			return $result;
						
		}
		
	  /**
		 * @desc Get Settings will get the settings details 
		 * @return  settings array  
		 */
		
		function getSettingsData (){
				
			$result = $this->imagesDao->getSettings();
			return $result;
						
		}
		
		/**
		 * @desc Update the  Settings table 
		 * 
		 * @return numbers of rows effected  
		 */
		function saveSettingsData($settingId){
			$result = $this->imagesDao->saveSettings($settingId);
			return $result;
		}
		
	}
?>