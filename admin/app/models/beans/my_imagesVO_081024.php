<?php

/*
 * @author K.Manjunath
 * 
 * @desc  Created this bean class for storing and fetching the details from the my_images table
 * 
 */

class MyImagesVO{
	
	//imageid,img_src,img_title,status,order,created_date,updated_date;
	
	private $imageid;       	//Image Id.
	private $img_src;       	//To store the location of the image.
	private $img_title;			//Title of the image.
	private $status;			//To store the status of the image.
	private $order;				//To store the display order.
	private $created_date;		//To store the image created date.
	private $updated_date;		//To store the image modified date.
	
	/*
	 * Setter and Getter method for the $imageid variable; 
	 * 
	 */
	
	public function setImageid($imageid){
		$this->imageid = $imageid;
	}
	public function getImageid(){
		return $this->imageid;
	}

	
	/*
	 * Setter and Getter method for the $img_src variable; 
	 * 
	 */
		
	public function setImageSrc($img_src){
		$this->img_src = $img_src;
	}
	public function getImageSrc(){
		return $this->img_src;
	}
	
	/*
	 * Setter and Getter method for the $img_title variable; 
	 * 
	 */
		
	public function setImageTitle($img_title){
		$this->img_title = $img_title;
	}
	public function getImageTitle(){
		return $this->img_title;
	}
	
	/*
	 * Setter and Getter method for the $status variable; 
	 * 
	 */
		
	public function setStatus($status){
		$this->status = $status;
	}
	public function getStatus(){
		return $this->status;
	}
	
	
	/*
	 * Setter and Getter method for the $order variable; 
	 * 
	 */
		
	public function setOrder($order){
		$this->order = $order;
	}
	public function getOrder(){
		return $this->order;
	}
	
	/*
	 * Setter and Getter method for the $created_date variable; 
	 * 
	 */
		
	public function setCreatedDate($created_date){
		$this->created_date = $created_date;
	}
	public function getCreatedDate(){
		return $this->created_date;
	}
	
	/*
	 * Setter and Getter method for the $updated_date variable; 
	 * 
	 */
		
	public function setUpdatedDate($updated_date){
		$this->updated_date = $updated_date;
	}
	public function getUpdatedDate(){
		return $this->updated_date;
	}
}


?>