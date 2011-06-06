<?php


	include_once 'DAO/my_imagesDAO.php';
	include_once 'beans/my_imagesVO.php';
	
	/*
	 * Author K.Manjunath
	 * 
	 * @desc Implementation class for the my_imagesDAO. 
	 * 
	 */

	class MyImagesImpl {
		
		private $imagesDao	=	null;
		private $imagesVo   =   null;
		
		function __construct()
		{
			$this->imagesDao	=	new MyImagesDAO();
			$this->imagesVo		= 	new MyImagesVO();
		}
		
		/*
		 * @author K.Manjunath
		 * @desc Saves Images Data
		 * @params  $img_src,$img_title,$img_status,$img_order
		 * @return  lastinserted id
		 */
		
		function saveImagesData ($img_src,$img_title,$img_status){
			
			$this->imagesVo->setImageSrc($img_src);
			$this->imagesVo->setImageTitle($img_title);
			$this->imagesVo->setStatus($img_status);
			
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
		 * @author  K.Manjunath
		 * @desc return Images Data
		 * @return array object of Images Data
		 */
		
		function getImagesData ($status,$pageno){
			
			$Images  = $this->imagesDao->getImages($status,$pageno);
			
			return $Images;
		}
		
		/**
		 * @author  K.Manjunath
		 * @desc return Images Data
		 * @return array object of Images Data
		 */
		
		function getImagesIdData (){
			
			$Images  = $this->imagesDao->getImagesIds();
			
			return $Images;
		}
		
		/**
		 * @author  K.Manjunath
		 * @desc return Images Data
		 * @return array object of Images Data
		 */
		
		function getImagesDataCount ($status){
			
			$Images  = $this->imagesDao->getImagesCount($status);
			
			return $Images[0]['total'];
		}
		
		
		/*
		 * @author K.Manjunath
		 * @desc Updates Image Data
		 * @params  $image_id,$img_title,$img_order
		 * @return  rows affected
		 */
		
		function updateImageData ($image_id,$img_title,$img_order){
			
			$this->imagesVo->setImageid($image_id);
			$this->imagesVo->setImageTitle($img_title);
			$this->imagesVo->setOrder($img_order);
			$result = $this->imagesDao->updateImage($this->imagesVo);
			return $result;
						
		}
		
		
		/*
		 * @author K.Manjunath
		 * @desc Updates Images Order
		 * @params  $images array
		 * @return  rows affected
		 */
		
		function updateImagesOrder ($images,$page){
				
			$result = $this->imagesDao->updateImageOrder($images,$page);
			return $result;
						
		}
		
		
		
		/*
		 * @author K.Manjunath
		 * @desc Delete Image Data
		 * @params  $image_id
		 * @return  rows affected
		 */
		
		function deleteImageData ($image_id){
			
			$result = $this->imagesDao->deleteImage($image_id);
			return $result;
						
		}
		
		/*
		 * @author K.Manjunath
		 * @desc Activate/Inactivate Image Data
		 * @params  $image_id
		 * @return  rows affected
		 */
		
		function activateImageData ($image_id){
			
			$result = $this->imagesDao->activateImage($image_id);
			return $result;
						
		}
		
		/*
		 * @author K.Manjunath
		 * @desc Inactivate Image Data
		 * @params  $image_id
		 * @return  rows affected
		 */
		
		function inActivateImageData ($image_id){
			
			$result = $this->imagesDao->inActivateImage($image_id);
			return $result;
						
		}
	
	  /*
		 * @author K.Manjunath
		 * @desc Updates Images Order
		 * @params  $images array
		 * @return  rows affected
		 */
		
		function getHomeImages ($count){
				
			$result = $this->imagesDao->getHomeImages($count);
			return $result;
						
		}
		
	}
?>