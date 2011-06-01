<?php	

	/**
	 * @desc In file is used for uploading images in  /uploads/ folder and saving 
	 *       path of image with title in  database
	 *       	
	 * Project name : MyKerala
	 * Created on   : 29-July-2010
	 * Module       : Admin Module
	 *
	 * @author K.Manjunath
	 * @version 1.0
	 *
	 *
	 */

	include '../../config/constants.php';
	
	include_once  BASE_FOLDER.'/app/models/my_imagesImpl.php';
		
	$fullPath= $_SERVER[DOCUMENT_ROOT]."/".PROJECT_NAME."/uploads/";
	
	/**
	 * @desc method used for uploading images.
	 * @param $actualFileName         with this name the file is uploaded
	 * @param $fileName               original file name 
	 * @param $maxSize                maximum size in the php_ini file settings for upload
	 * @param $maxW                   maximum width
	 * @param $fullPath               full path gives the correct location where the file has to be stored.
	 * @param $relPath                location where file is stored
	 * @param $colorR                  
	 * @param $colorG
	 * @param $colorB
	 * @param $maxH                   maximum height 
	 * @return image path if uploaded successsfully without any errors 
	 * 				else  if uploaded file dimensions are not in 1024X768 then return 0
	 * 				else  return array of errorslist
	 */
	
	function uploadImage($actualFileName,$fileName, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH = null)
	{
			
		define("NEW_FILE_NAME",$actualFileName);
		$folder = $fullPath;
		$maxlimit = $maxSize;
		$allowed_ext = "jpg,jpeg,gif,png,bmp";
		$match = "";
		$filesize = $_FILES[$fileName]['size'];
		//------------------file delete function added here ---------
		$exts = array('jpg', 'png', 'gif', 'jpeg', 'bmp');
		
		foreach($exts as $ext) {
			$sfile = $folder .$actualFileName.'.'.$ext;
			
			if (file_exists($sfile))
			{			 
				$fh = fopen($sfile, 'w') or die("can't open file");
				fclose($fh);
				unlink($sfile);	
				clearstatcache();			
			 	break;		 	
			}
		}
		//-----------------------------------------------------------
		if($filesize > 0){	
				$filename = strtolower($_FILES[$fileName]['name']);
				$filename = preg_replace('/\s/', '_', $filename);
			   	if($filesize < 1){ 
					$errorList[] = "File size is empty.";
				}
				if($filesize > $maxlimit){ 
					$errorList[] = "File size is too big.";
				}
	
				list($width_orig, $height_orig) = getimagesize($_FILES[$fileName]['tmp_name']);
				if($width_orig!=1024 && $height_orig!=768){
						$errorList[]= "Please upload image of 1024 X 768 size";
			 		  	return '0';
				}
				if(count($errorList)<1)
				{
					$file_ext = preg_split("/\./",$filename);
					$allowed_ext = preg_split("/\,/",$allowed_ext);
					foreach($allowed_ext as $ext)
					{
						if($ext==end($file_ext))
						{
							$match = "1"; // File is allowed
							$NUM = time();
							$front_name = substr($file_ext[0], 0, 15);
							$newfilename = NEW_FILE_NAME.".".end($file_ext);
							$filetype = end($file_ext);
							move_uploaded_file($_FILES[$fileName]['tmp_name'],$folder.$newfilename);
							
						}
					}		
				}
		}else{
			$errorList[]= "NO FILE SELECTED";
		}
		if(!$match){
		   	$errorList[]= "File type isn't allowed: $filename";
		}
		if(sizeof($errorList) == 0){
			return $relPath.$newfilename;
		}else{
			$eMessage = array();
			for ($x=0; $x<sizeof($errorList); $x++){
				$eMessage[] = $errorList[$x];
			}
		   	return $eMessage;
		}
	}
	/******************************************************************************************************/
	
	$fname=$_FILES["filename"]["name"];
	
	$filename = strip_tags($_REQUEST['filename']);
//	$maxSize = strip_tags($_REQUEST['maxSize']);
	$maxSize = let_to_num(ini_get('upload_max_filesize'));
	$maxW = strip_tags($_REQUEST['maxW']);
	$relPath = strip_tags($_REQUEST['relPath']);
	$colorR = strip_tags($_REQUEST['colorR']);
	$colorG = strip_tags($_REQUEST['colorG']);
	$colorB = strip_tags($_REQUEST['colorB']);
	$maxH = strip_tags($_REQUEST['maxH']);
	$actualFileName	= strip_tags($_FILES["filename"]["name"]);
	$filesize_image = $_FILES[$filename]['size'];
	$img_title	=	!empty($_REQUEST['title'])?$_REQUEST['title']:'404';
	$img_desc	=	!empty($_REQUEST['txtDescription'])?$_REQUEST['txtDescription']:'';
	$date= date("dmyHis", time()); 
	$mynewstring = (str_replace(" ", "", $fname)).$date;
	$imgUploaded = false;
	
	if($img_title!='404'){
		if($filesize_image > 0)
		{
			$upload_image = uploadImage($date,$filename, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH);
			
			if(is_array($upload_image)){
				foreach($upload_image as $key => $value) {
					if($value == "-ERROR-") {
						unset($upload_image[$key]);
					}
				}
				$document = array_values($upload_image);
				for ($x=0; $x<sizeof($document); $x++){
					$errorList[] = $document[$x];
				}
			
			}else {
				if($upload_image=='0'){
					$errorList[] = "Please upload image of 1024 X 768 size";
				}			
				else{
					$imgUploaded = true;
				}
			}
		}
		else
		{
			$errorList[] = "File Size Empty";
		}
	}
	else
	{
		$errorList[] = "Enter title for the image";
	}
	

	 
	if($imgUploaded)
	{
		$actualpath = $upload_image;
		if($img_title!='404'){
			$myimages	=	 new MyImagesImpl();
			$result = $myimages->saveImagesData($actualpath,addslashes(rawurldecode($img_title)),1,addslashes(rawurldecode($img_desc)));
		}		
	}
	else{
		echo '<span style="position:absolute;">';
		echo '<img src="http://'.ROOT.'/images/error.gif" width="16" height="16px" border="0" style="marin-bottom: -3px;" />';
		echo '</span> <span style="padding-left:20px;">';
		echo 'Error(s) Found: ';
		
		for($i=0;$i<sizeof($errorList);$i++){
			echo $errorList[$i];
			if($i+1<sizeof($errorList))
				echo ', ';
		}
		echo '</span>';
	}
	
	/**
	 * @desc convert the 2M into bytes
	 * @param $v
	 * @return converted value 
	 */
	function let_to_num($v){ 
	    $l = substr($v, -1);
	    $ret = substr($v, 0, -1);
	    switch(strtoupper($l)){
	    case 'P':
	        $ret *= 1024;
	    case 'T':
	        $ret *= 1024;
	    case 'G':
	        $ret *= 1024;
	    case 'M':
	        $ret *= 1024;
	    case 'K':
	        $ret *= 1024;
	        break;
	    }
	    return $ret;
	}
	
	
?>
