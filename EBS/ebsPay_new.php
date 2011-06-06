<?php
     	include_once $_SERVER['DOCUMENT_ROOT'].'/configurations.php';
			include_once $APPLICATION_PATH.$FOLDER_NAME.'views/header.php';
			include_once($_SERVER['DOCUMENT_ROOT'].'/views/modalpopup.php');

      $FOLDER_NAME='';
      $TFOLDER='/kerala/travel/';
      
      $APPLICATION_URL_NEW="http://".$_SERVER["HTTP_HOST"];
       
?>

<div style="margin-left:auto; margin-right:auto; width:1003px;">
<div class="bg_top" style="float:left; display:block;"></div>
<div class="bg_mid" style="float:left; display:block;">
  <div align="center" style="padding:50px 0px 50px 0px;">
   <iframe src="<?php echo $APPLICATION_URL_NEW."/".$FOLDER_NAME ;?>/EBS/pay.php?>"  height="900" frameborder="0" width="1003"  style="overflow-y: hidden;" id="mainIframe"></iframe>
  </div>
</div>
<div class="bg_bottom" style="clear:both;"></div>

<?php 
 
	include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php';
?>