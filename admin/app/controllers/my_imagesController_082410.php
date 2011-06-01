<?php

	include_once '../models/my_imagesImpl.php';
	include '../../config/constants.php';
/**
 * This controller handles Image Funtionality 
 * 
 * @author K.Manjunath
 * @version 1.0
 *
 */
class MyImagesController {

	private $myimages = null;
	
	/**
	 * Default constructor which
	 * -Instantiates objects used in this class
	 * -Receives request params
	 * -Calls business function based on the action parameter received
	 */

	function __construct()
	{
		$action		    = 	!empty($_REQUEST['action'])?$_REQUEST['action']:'';
		$this->myimages	=	 new MyImagesImpl();
		switch ($action)
		{
			case 'save'  		: 	self::saveImagesData();
									break;
			case 'delete'		:	self::deleteImagesData();
									break;
			case 'get'	 		:	self::getImagesData();
									break;
			case 'active'		:	self::getImageActivate();
									break;
			case 'inactive'		:	self::getImageInActivate();
									break;
			case 'update'		:   self::getImagesOrderUpdate();
									break;
			case 'homeimg'		:   self::getHomeImages();
									break;
			default		 		:	self::noDataFound();
									break;
		}
	}
	
	/*
		 * @author K.Manjunath
		 * @desc Saves the  Image Data
		 * Receives request params
		 * @return  rows affected
	*/
	
	function saveImagesData(){
		$img_src	=	!empty($_REQUEST['imageurl'])?$_REQUEST['imageurl']:'';
		$img_title	=	!empty($_REQUEST['title'])?$_REQUEST['title']:'';
		$result = $this->myimages->saveImagesData($img_src,$img_title,1);
		
	}
	
	/*
		 * @author K.Manjunath
		 * @desc Get all the  Image Data based on the status bases on the page
		 * Receives request params
		 * @return  Array of images
	*/
	
	
	function getImagesData(){
			
		$status	=	isset($_REQUEST['status'])?$_REQUEST['status']:'';
		
		$request = $_REQUEST["p"];
		$pageno			    =	$_REQUEST["p"];
		if($pageno<1){
			$_REQUEST["p"]=1;
			$pageno=1;
		}
		$pageno=$pageno-1;
		$pageno=$pageno*10;
		$imagesCount = $this->myimages->getImagesDataCount($status);
		$images = $this->myimages->getImagesData($status,$pageno);
		
		include BASE_FOLDER.'/app/views/ImagesView.php';
	}
	
	/*
		 * @author K.Manjunath
		 * @desc Activate Image Data
		 * Receives request params
		 * @return  rows affected
	*/
	
	function getImageActivate(){
		
		$img_id	=	!empty($_REQUEST['imageid'])?$_REQUEST['imageid']:'';
		$result = $this->myimages->activateImageData($img_id);
		if($result){
			$this->getImagesData();
		}
		
	}
	
	/*
		 * @author K.Manjunath
		 * @desc Inactivate Image Data
		 * Receives request params
		 * @return  rows affected
	 */
	
	function getImageInActivate(){
		$img_id	=	!empty($_REQUEST['imageid'])?$_REQUEST['imageid']:'';
		$result = $this->myimages->inActivateImageData($img_id);
		if($result){
			$images = $this->myimages->getImagesIdData();
			if(sizeof($images)>0){
				for($i=0;$i<sizeof($images);$i++){
					$imagesData.=$images[$i]['imageid'];
					if($i+1<sizeof($images))
					$imagesData.=",";
				}
			}
			$image_id = explode(",", $imagesData);
			$result = $this->myimages->updateImagesOrder($image_id,1);
			if($result){
				$this->getImagesData();
			}
		}
	}
	
	 /*
		 * @author K.Manjunath
		 * @desc Delete Image Data
		 * Receives request params
		 * @return  rows affected
	 */
	
	function deleteImagesData(){
		
		$img_id	=	!empty($_REQUEST['imageid'])?$_REQUEST['imageid']:'';
		$result = $this->myimages->deleteImageData($img_id);
		if($result){
			$this->getImagesData();
		}
		
	}
	
	/*
		 * @author K.Manjunath
		 * @desc Save the images in Order
		 * Receives request params
		 * @return  rows affected
	 */
	function getImagesOrderUpdate(){
		$img 	  =	!empty($_REQUEST['imageid'])?$_REQUEST['imageid']:'';
		$pageno	  =	$_REQUEST["p"];
		$image_id = explode(",", $img);
		$result = $this->myimages->updateImagesOrder($image_id,$pageno);
		
	}
	
	function getHomeImages()
	{
		try
		{
			$count 	  =	!empty($_REQUEST['count'])?$_REQUEST['count']:'a';
			$result   = $this->myimages->getHomeImages($count);
			if(!empty($result))
			{
			     $data = '';
			     for($i=0;$i<sizeof($result);$i++)
			     {
              $data .= '<div><img src="'.$result[$i]["img_src"].'" style="width:1024px; height:768px; overflow:auto;" /></div>';
           }
           echo $data;
			}
			else
			{
				echo 'no data';
			}
		}
		catch ( Exception $e)
		{
			echo $e->getMessage();	
		}
	}
}

$myImageController = new MyImagesController();
?>
