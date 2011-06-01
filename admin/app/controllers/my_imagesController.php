<?php

	include_once '../models/my_imagesImpl.php';
	include '../../config/constants.php';
/**
 * @desc This controller handles Image funtionality
 * 1. Getting the images and redirecting to the ImageView page.
 * 2. Activating the images.
 * 3. Inactivating the images.
 * 4. Setting the Order to the images.
 * 5. Gettng the images to the HomePage
 *
 * Project name : MyKerala
 * Created on   : 29-July-2010
 * Module       : Admin Module
 *
 * @author K.Manjunath
 * @version 1.0
 *
 */
class MyImagesController {

	private $myimages = null;
	
	/**
	 * @desc Default constructor which
	 *		 1.Instantiates objects used in this class
	 * 		 2.Receives request params
	 * 		 3.Calls business function based on the action parameter received
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
			case 'settings'		:   self::saveImageSettings();
			            break;
			case 'imgUpdate'	:   self::setImageUpdate();
			            break;
			default		 		:	self::noDataFound();
									break;
		}
	}
	
		function setImageUpdate (){
		$img_desc	=	!empty($_REQUEST['desc'])?$_REQUEST['desc']:'';
		$img_title	=	!empty($_REQUEST['title'])?$_REQUEST['title']:'';
		$img_id	 =	!empty($_REQUEST['imageid'])?$_REQUEST['imageid']:'';

		$result     =   $this->myimages->updateImageData($img_id,$img_title,$img_desc);
		return $result;
	}

  /**
	 * @desc Receives the request params image-url,title and save them into the database.
	 * @return last inserted id
	 */
	
	function saveImagesData(){
		$img_src	=	!empty($_REQUEST['imageurl'])?$_REQUEST['imageurl']:'';
		$img_title	=	!empty($_REQUEST['title'])?$_REQUEST['title']:'';
		$result = $this->myimages->saveImagesData($img_src,$img_title,1);
		
	}
	
	
	/**
	 * @desc Receives request params and get all the  Image Data
	 * 		 based on the status
	 *
	 * @return  Result (redirected) to the ImageView.php
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
		$imageSettings = $this->myimages->getSettingsData();
		include BASE_FOLDER.'/app/views/ImagesView.php';
	}
	
	/**
	 * @desc Receives request param imageid and update status for the imageid in the database to 1.
	 * @return  rows affected
	 */

	function getImageActivate(){
		
		$img_id	=	!empty($_REQUEST['imageid'])?$_REQUEST['imageid']:'';
		$result = $this->myimages->activateImageData($img_id);
		if($result){
			$this->getImagesData();
		}
		
	}
	
	/**
	 * @desc Receives request param imageid and update status for the imageid in the database to 0.
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
	
	/**
	 * @desc Receives request param imageid and delete the image from the database.
	 * @return  rows affected
	 */
	
	function deleteImagesData(){
		
		$img_id	=	!empty($_REQUEST['imageid'])?$_REQUEST['imageid']:'';
		$result = $this->myimages->deleteImageData($img_id);
		if($result){
			$this->getImagesData();
		}
		
	}
	
  /**
	 * @desc  Receives request params image id's and updates the order of images.
	 * @return  rows affected
	 */
	function getImagesOrderUpdate(){
		$img 	  =	!empty($_REQUEST['imageid'])?$_REQUEST['imageid']:'';
		$pageno	  =	$_REQUEST["p"];
		$image_id = explode(",", $img);
		$result = $this->myimages->updateImagesOrder($image_id,$pageno);
		
	}
	
  /**
	 * @desc  Receives request params count for display of images in the homepage 
	 * 		  (default value 5)
	 * @return Images div.
	 */
	function getHomeImages()
	{
		try
		{
			$count 	  =	!empty($_REQUEST['count'])?$_REQUEST['count']:'a';
			$exclude 	  =	!empty($_REQUEST['exclude'])?$_REQUEST['exclude']:'a';
			$result   = $this->myimages->getHomeImages($count,$exclude);
			$indexCount=1;
			if(!empty($result))
			{
			     $data = '';
			     if($exclude!=a)
			     {
			         $indexCount=2;
           }
			     for($i=0;$i<sizeof($result);$i++)
				{
					$data .= '<div ><img class="imgCyclePseudoClass" src="'.$result[$i]["img_src"].'" style="width:1003px; height:768px; overflow:auto;" />
              				  <input type="hidden" id="img_desc_'.$indexCount.'" value="'.rawurlencode($result[$i]["img_desc"]).'" />
              </div>';
              $indexCount++;
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
	
	/**
	 * @desc This method is for updating the settings tab.
	 * @return updated html for check boxes
	 */
	function saveImageSettings(){
		$settingId 	  =	!empty($_REQUEST['id'])?$_REQUEST['id']:'';
		$result = $this->myimages->saveSettingsData($settingId);
		if($result){
			$imageSettings = $this->myimages->getSettingsData();
			$html='';
			for ($i=0;$i<sizeof($imageSettings);$i++){
	         		if($imageSettings[$i]['active']==1){
	  			     	$html.= '<input id="'.$imageSettings[$i]['setting_name'].'" type="radio" name="orderGroup" checked="true" onClick="updateImageDisplayOrder(id);">'.$imageSettings[$i]['setting_name'];
	         		}else{
	         			$html.= '<input id="'.$imageSettings[$i]['setting_name'].'" type="radio"  name="orderGroup" onClick="updateImageDisplayOrder(id);">'.$imageSettings[$i]['setting_name'];
	         		}
			 	}
			 echo $html;
			 exit;
			}
	}
}

$myImageController = new MyImagesController();
?>
