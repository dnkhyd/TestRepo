<?php
	
/*
 * Author : K.Manjunath
 * 
 * @desc: For making the Database Transactions DAO class for the my_images table
 * 
 * 1. Save the image in the my_images table.
 * 2. Getting the images from the my_images table.
 * 3. Updating the image in the my_images table for a particulat imageid.
 * 
 */	
include_once 'dbConnection.php';

 class MyImagesDAO extends DbConnection {
 	
 	/**
	 * getting datbase connection object
	 */ 	
	 	function __construct(){
				parent::__construct();
		}
	
	
 	/**
	 * @author K.Manjuanth
	 * @param $imagesVo - Holds Complete Images Data
	 * @desc inserts the Images data to my_images table
	 * @return lastinserted id
	 */
	function saveImages(MyImagesVO $imagesVo)
	{

		try
		{
			
			$sqlcmd = "	INSERT INTO ".TBL_IMAGES."
					(img_src,img_title,img_status,img_order,created_date,updated_date)
				   	VALUES(
				   	\"".$imagesVo->getImageSrc()."\",
				   	\"".$imagesVo->getImageTitle()."\",
				   	\"".$imagesVo->getStatus()."\",
				   	\"".$imagesVo->getOrder()."\",
				   	NOW(),
				   	NOW()
				   	)";			
			return parent::insert($sqlcmd);
		}
		catch ( Exception $e )
		{
			error_log('Function: saveImagesData -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
 	/**
	 * @author K.Manjunath
	 * @param $imagesVo - Holds Complete Images Data
	 * @desc update the Image data for existing Image
	 * @return return numbers of rows effected
	 */
	function updateImage(MyImagesVO $imagesVo)
	{
		try
		{
			$sqlcmd = "	UPDATE ".TBL_IMAGES."
						SET 
						img_title=\"".$imagesVo->getImageTitle()."\",
						img_order=\"".$imagesVo->getOrder()."\",
						updated_date=NOW()
						WHERE imageid=\"".$imagesVo->getImageid()."\"";			
			return parent::update($sqlcmd);
		}
		catch ( Exception $e )
		{
			error_log('Function: updateImageData -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
 	
	
 	/**
	 * @author K.Manjunath
	 * @param array of images Ids
	 * @desc update the Image data for existing Image
	 * @return return numbers of rows effected
	 */
	function updateImageOrder($images,$page)
	{
		$pagingno=$page-1;
		try
		{
			for($i=0;$i<sizeof($images);$i++){

				$sqlcmd = "UPDATE  ".TBL_IMAGES." SET img_order= \"".(($pagingno*10)+($i+1))."\" 	WHERE imageid=\"".$images[$i]."\" and  img_status = 1";
			  	parent::update($sqlcmd);
			}
		}
		catch ( Exception $e )
		{
			error_log('Function: updateImageOrder -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
	
	
 	/**
	 * @author K.Manjunath
	 * @param imageid 
	 * @desc delete the Image from the my_images table by making status to 0
	 * @return return numbers of rows effected
	 */
	function deleteImage($imageid)
	{
		try
		{
			$sqlStmt1=" DELETE  FROM   ".TBL_IMAGES."	 WHERE imageid=".$imageid;                    		  
			return parent::update($sqlStmt1);
		}
		catch ( Exception $e )
		{
			error_log('Function: deleteImage -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
	
 	/**
	 * @author K.Manjunath
	 * @param imageid 
	 * @desc Activate/Inactivate the Image from the my_images table by making status to 0/1
	 * @return return numbers of rows effected
	 */
	function activateImage($imageid)
	{
		try
		{
			$Order = $this->getOrder();
			
			$maxOrder = $Order[0]['order_data'];
			
			$sqlStmt1=" UPDATE  ".TBL_IMAGES."	SET img_status = 1,img_order = ".($maxOrder+1)."  WHERE imageid=".$imageid;                    		  
			return parent::update($sqlStmt1);
		}
		catch ( Exception $e )
		{
			error_log('Function: ActivateImage -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
	 /**
	 * @author K.Manjunath
	 * @param imageid 
	 * @desc Inactivate the Image from the my_images table by making status to 0/1
	 * @return return numbers of rows effected
	 */
	function inActivateImage($imageid)
	{
		try
		{
			$actives = $this->getImagesCount(1);
			$activesCount = $actives[0]['total'];
			if($activesCount>0){
				$sqlStmt1=" UPDATE  ".TBL_IMAGES."	SET img_status = 0, img_order=0	WHERE imageid=".$imageid;   		  
				return parent::update($sqlStmt1);
			}else{
				return 0;
			}
		}
		catch ( Exception $e )
		{
			error_log('Function: ActivateImage -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
 	/**
	 * @author K.Manjunath
	 * 
	 * 
	 * @desc return the Images participants from the my_images table
	 */
	function getImages($status,$pageno)
	{
		try
		{
			$sqlStmt1="SELECT imageid,img_src,img_title,img_status,img_order FROM ".TBL_IMAGES ;
			
			$sqlStmt1.=" where img_status = ".$status;
			
			$sqlStmt1.=" order by img_order limit 25 ";  //offset ".$pageno; 
			
			return parent::select($sqlStmt1);
		}
		catch ( Exception $e )
		{
			error_log('Function: getImages -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
 	/**
	 * @author K.Manjunath
	 * 
	 * 
	 * @desc return the Images participants from the my_images table
	 */
	function getImagesIds()
	{
		try
		{
			$sqlStmt1="SELECT imageid FROM ".TBL_IMAGES ;
			
			$sqlStmt1.=" where img_status = 1";
			
			$sqlStmt1.=" order by img_order limit 25 ";  //offset ".$pageno; 
			
			return parent::select($sqlStmt1);
		}
		catch ( Exception $e )
		{
			error_log('Function: getImages -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
	
 	/**
	 * @author K.Manjunath
	 * 
	 * 
	 * @desc return the Images participants from the my_images table
	 */
	function getImagesCount($status)
	{
		try
		{
			$sqlStmt1="SELECT count(*) as total FROM ".TBL_IMAGES ;
			
			$sqlStmt1.=" where img_status = ".$status;
			
			$sqlStmt1.=" order by img_order"; 
						 
						                    		  
			return parent::select($sqlStmt1);
		}
		catch ( Exception $e )
		{
			error_log('Function: getImages -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
   /**
	 * @author K.Manjunath
	 * 
	 * 
	 * @desc return the Images participants from the my_images table
	 */
	function getOrder()
	{
		try
		{
			$sqlStmt1="SELECT max(img_order) as order_data  FROM ".TBL_IMAGES." where img_status = 1"; 
									                    		  
			return parent::select($sqlStmt1);
		}
		catch ( Exception $e )
		{
			error_log('Function: getOrder -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
  	/**
	 * @author K.Manjunath
	 * 
	 * 
	 * @desc return the Images participants from the my_images table
	 */
	function getHomeImages($count)
	{
		try
		{
			$sqlStmt1="
			select * from my_images
			where img_status =1
			order by img_order";
                        if($count!='a')
			$sqlStmt1.=" limit ".$count;
			return parent::select($sqlStmt1);
		}
		catch ( Exception $e )
		{
			error_log('Function: getHomeImages -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
 }

?>