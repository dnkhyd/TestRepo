<?php	

	include '../../config/constants.php';
	
	include_once  BASE_FOLDER.'/app/models/my_imagesImpl.php';
		
	$fullPath= $_SERVER[DOCUMENT_ROOT]."/admin/uploads/";
	
	
	
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
		// Code commented  for real Image upload , removing GD manipulation. 
	/*	if($filesize > 0){	
			$filename = strtolower($_FILES[$fileName]['name']);
			$filename = preg_replace('/\s/', '_', $filename);
		   	if($filesize < 1){ 
				$errorList[] = "File size is empty.";
			}
			if($filesize > $maxlimit){ 
				$errorList[] = "File size is too big.";
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
						$save = $folder.$newfilename;
						//------------- FILE NOT EXISTS--------------------------/
							if(file_exists($save)){
								@imagedestroy($filename);
							}
							list($width_orig, $height_orig) = getimagesize($_FILES[$fileName]['tmp_name']);
							
							if($width_orig!=1024){
								$errorList[]= "Please upload image of 1024 X 768 size";
				 			  	return '0';
							}
							if($height_orig!=768){
								$errorList[]= "Please upload image of 1024 X 768 size";
		   						return '0';
							}
							if($maxH == null)
							{
								if($width_orig < $maxW)
								{
									$fwidth = $width_orig;
								}
								else
								{
									$fwidth = $maxW;
								}
								$ratio_orig = $width_orig/$height_orig;
								$fheight = $fwidth/$ratio_orig;
								
								$blank_height = $fheight;
								$top_offset = 0;									
							}
							else
							{
								if($width_orig <= $maxW && $height_orig <= $maxH)
								{
									$fheight = $height_orig;
									$fwidth = $width_orig;
								}
								else
								{
									if($width_orig > $maxW)
									{
										$ratio = ($width_orig / $maxW);
										$fwidth = $maxW;
										$fheight = ($height_orig / $ratio);
										if($fheight > $maxH)
										{
											$ratio = ($fheight / $maxH);
											$fheight = $maxH;
											$fwidth = ($fwidth / $ratio);
										}
									}
									if($height_orig > $maxH)
									{
										$ratio = ($height_orig / $maxH);
										$fheight = $maxH;
										$fwidth = ($width_orig / $ratio);
										if($fwidth > $maxW)
										{
											$ratio = ($fwidth / $maxW);
											$fwidth = $maxW;
											$fheight = ($fheight / $ratio);
										}
									}
								}
								if($fheight == 0 || $fwidth == 0 || $height_orig == 0 || $width_orig == 0)
								{
									die("FATAL ERROR REPORT ERROR CODE [add-pic-line-67-orig] to <a href='http://www.sapplica.com'>AT WEB RESULTS</a>");
								}
								if($fheight < 45)
								{
									$blank_height = 45;
									$top_offset = round(($blank_height - $fheight)/2);
								}
								else
								{
									$blank_height = $fheight;
								}
							}
							$image_p = imagecreatetruecolor($fwidth, $blank_height);
							$white = imagecolorallocate($image_p, $colorR, $colorG, $colorB);
							imagefill($image_p, 0, 0, $white);
							switch($filetype)
							{
								case "gif":
									$image = @imagecreatefromgif($_FILES[$fileName]['tmp_name']);
								break;
								case "jpg":
									$image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
								break;
								case "jpeg":
									$image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
								break;
								case "png":
									$image = @imagecreatefrompng($_FILES[$fileName]['tmp_name']);
									
								break;
							}
							@imagecopyresampled($image_p, $image, 0, $top_offset, 0, 0, $fwidth, $fheight, $width_orig, $height_orig);
						
							switch($filetype)
							{
								case "gif":
									if(!@imagegif($image_p, $save)){
										$errorList[]= "PERMISSION DENIED [GIF]";
									}
								break;
								case "jpg":
									if(!@imagejpeg($image_p, $save, 100)){
										$errorList[]= "PERMISSION DENIED [JPG]";
									}
								break;
								case "jpeg":
									if(!@imagejpeg($image_p, $save, 100)){
										$errorList[]= "PERMISSION DENIED [JPEG]";
									}
								break;
								case "png":
									if(!@imagepng($image_p, $save, 0)){
										$errorList[]= "PERMISSION DENIED [PNG]";
									}
								break;
							}
							@imagedestroy($filename);
						
					}
				}		
			}
		} */
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
  }
    else{
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
			$result = $myimages->saveImagesData($actualpath,addslashes(rawurldecode($img_title)),1);
		}		
	}
	else{
		echo '<span style="position:absolute;">';
		echo '<img src="http://mykeralahotels.in/admin/images/error.gif" width="16" height="16px" border="0" style="marin-bottom: -3px;" />';
		echo '</span> <span style="padding-left:20px;">';
		echo 'Error(s) Found: ';
		
		for($i=0;$i<sizeof($errorList);$i++){
			echo $errorList[$i];
			if($i+1<sizeof($errorList))
				echo ', ';
		}
		echo '</span>';
	}
	
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
