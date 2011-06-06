<?php

/**
 * @desc Created this bean class in reference to my_images table in the database.
 * Project name : MyKerala
 * Created on   : 29-July-2010
 * Module       : Admin Module
 *
 * @author K.Manjunath
 * @version 1.0
 */

class MyImagesVO{

	private $imageid;       	//Image Id.
	private $img_src;       	//location of the image.
	private $img_title;			//Title of the image.
	private $status;			//status of the image.
	private $order;				//display order.
	private $created_date;		//image created date.
	private $updated_date;		//image modified date.
	private $img_desc;				//image description.


	
	
	
	/**
	 * @desc Setter method for the imageid.
	 * 
	 * @param $imageid       Image Id.
	 */

	public function setImageid($imageid){
		$this->imageid = $imageid;
	}

	/**
	 * @desc Getter method for the imageid.
	 * 
	 * @return $imageid       Image Id.
	 */
	public function getImageid(){
		return $this->imageid;
	}


	/**
	 * @desc Setter method for the image source.
	 * 
	 * @param $img_src   Image Source path
	 */

	public function setImageSrc($img_src){
		$this->img_src = $img_src;
	}


	/**
	 * @desc Getter method for the image source.
	 * 
	 * @return $img_src     Image Source path
	 */
	public function getImageSrc(){
		return $this->img_src;
	}


	/**
	 * @desc Setter method for the image title.
	 * 
	 * @param $img_title        Image Title
	 */

	public function setImageTitle($img_title){
		$this->img_title = $img_title;
	}

	/**
	 * @desc Getter method for the image title.
	 * 
	 * @return $img_title.       Image Title
	 *
	 */
	public function getImageTitle(){
		return $this->img_title;
	}

	/**
	 * @desc Setter method for the status.
	 * 
	 * @param $status     Status of the Image
	 *
	 */
	public function setStatus($status){
		$this->status = $status;
	}

	/**
	 * @desc Getter method for the status.
	 * 
	 * @return $status      Status of the Image
	 */
	public function getStatus(){
		return $this->status;
	}


	/**
	 * @desc Setter method for the order.
	 * 
	 * @param $order   Order of the image
	 */

	public function setOrder($order){
		$this->order = $order;
	}

	/**
	 * @desc Getter method for the order.
	 * 
	 * @return $order      Order of the image
	 */
	public function getOrder(){
		return $this->order;
	}

	/**
	 * @desc Setter method for the created date.
	 * 
	 * @param $created_date   Image created date
	 */

	public function setCreatedDate($created_date){
		$this->created_date = $created_date;
	}
	/**
	 * @desc Getter method for the created date.
	 * 
	 * @return $created_date  Image created date
	 */
	public function getCreatedDate(){
		return $this->created_date;
	}

	/**
	 * @desc Setter method for the updated date.
	 * 
	 * @param $updated_date   Image updated date
	 */

	public function setUpdatedDate($updated_date){
		$this->updated_date = $updated_date;
	}
	/**
	 * @desc Getter method for the updated date.
	 * 
	 * @return updated_date   Image updated date
	 */
	public function getUpdatedDate(){
		return $this->updated_date;
	}
	
	/**
	 * @desc Setter method for the imageid.
	 * 
	 * @param $imageid       Image Id.
	 */

	public function setImageDesc($img_desc){
		$this->img_desc = $img_desc;
	}

	/**
	 * @desc Getter method for the imageid.
	 * 
	 * @return $imageid       Image Id.
	 */
	public function getImageDesc(){
		return $this->img_desc;
	}
}


?>