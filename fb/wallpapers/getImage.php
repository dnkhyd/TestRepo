<?php

$dw = $_GET['w'];
$dh = $_GET['h'];

if ($_GET['src'] == 'current.jpg')
{
	$src = strtolower(date("Fy").".jpg");
}
else
{
	$src = $_GET['src'];
}

$srcFile = 'source/'.$src;
$filePath = 'watermarked/'.$dw.'-'.$dh.'-'.$src;
$doMark = $dw > 640 && $dh > 480;

header('Content-Type: image/jpeg');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$src);
header("Content-Transfer-Encoding: binary");

//die($filePath.' = '.file_exists($filePath));

if (file_exists($filePath))
{
	$image = imagecreatefromjpeg($filePath);
}
else
{
	$watermark = imagecreatefrompng('watermark.png');  
	$size = getimagesize('watermark.png');
	$ww = $size[0];  
	$wh = $size[1];  
	//$image = imagecreatetruecolor($watermark_width, $watermark_height);
	$simage = imagecreatefromjpeg($srcFile);
	$image = imagecreatetruecolor($dw, $dh);  
	$size = getimagesize($srcFile);
	$sr = $size[0]/$size[1]; //1.5
	$dr = $dw/$dh; // 2.5
	if ($sr > $dr)
	{
		$i = $dh/$size[1]*$size[0];
		imagecopyresampled($image,$simage,0,0,($i-$dw)/2,0,$dw,$dh,$dw*$size[0]/$i,$size[1]);
	}
	else
	{
		$i = $dw/$size[0]*$size[1];
		imagecopyresampled($image,$simage,0,0,0,($i-$dh)/2,$dw,$dh,$size[0],$dh*$size[1]/$i);
	}
	$dest_x = $dw - $ww;  
	$dest_y = $dh - $wh - $dh/15;  
	if ($doMark) imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $ww, $wh, 80);  
	imagejpeg($image, $filePath, 85);
	imagedestroy($simage);
	imagedestroy($watermark);
}

imagejpeg($image, null, 100);
imagedestroy($image);

?>