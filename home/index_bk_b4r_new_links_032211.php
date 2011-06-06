 <?php 
 
/*Implementation class for the my_adminDAO.
 	 
Project name : MyKerala
Created on   : 29-July-2010
Module       : Main Content

@author Kiran Kumar.B
@version 1.0*/

?>
		<?php
			$tab	=	"home"; 
					include_once $_SERVER[DOCUMENT_ROOT].'/configurations.php';
			include_once $APPLICATION_PATH.'views/header.php';
			include_once($_SERVER['DOCUMENT_ROOT'].'/views/modalpopup.php');


$TFOLDER='/kerala/travel/';

$APPLICATION_URL_NEW="http://".$_SERVER["HTTP_HOST"];

if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$TFOLDER.'wp-load.php')) { 
  require_once($_SERVER['DOCUMENT_ROOT'].'/'.$TFOLDER.'wp-load.php');
} else { 
  require_once($_SERVER['DOCUMENT_ROOT'].'/'.$TFOLDER.'wp-config.php');
}
include_once $_SERVER['DOCUMENT_ROOT'].'/'.$TFOLDER.'wp-includes/post.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/'.'/configurations.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mkhtest/configurations.php';


$POST_IDS				= array(54,212,219,223,229,247,249,235,252,256,145,152,254,101,613,323,287,318,306,309,375,365,390,484,572,555,500,527,418,588);

$id_nums = $POST_IDS;

$id_nums = implode(", ", $id_nums);               

$sqlquery = "select ID, post_name  FROM $wpdb->posts where ID IN ($id_nums) order by ID ";

$content = $wpdb->get_results($sqlquery);

$footerLinks=array();


$n=0;

foreach ($content as $actualContent) {
if ($n==0){
	$footerLinks[$n]=$APPLICATION_URL_NEW.$TFOLDER.$actualContent->post_name;
	$arraylink[$actualContent->ID]=$n;

}
else {
        $footerLinks[$n]=$APPLICATION_URL_NEW.$TFOLDER.'kerala/'.$actualContent->post_name;
	$arraylink[$actualContent->ID]=$n;
}

	$n++;

}


    	?>
        
	     	<div style="height:697px; .height:590px; width:1003px;">
            <div style="float: right; padding-top:0px; padding-left: 0px;">
<div style="padding-right: 14px;">
<div style="position: relative; float: left;">
<div class="mykr_img cmgsn_bg" id="animateContent">
<span style="line-height: 50px; padding-left: 40px; float:left;">Featured Packages</span><div style="position: relative; float: right; top: 6px; left: -10px; " class="mykr_img arrow_img" id="arrowImg"></div>
</div>
<div style="z-index: 9; position: absolute; top: 50px; left: 0px; display: none; width: 245px;"  id="floatingContent">
<div class="mykr_img txtmsg_bg"> <div style="padding: 0px 0px 0px 12px; .padding: 0px 0px 0px 0px;width:221px;">
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="campNoelAnc1" href="<?php echo $footerLinks[$arraylink[484]];?>" onclick="preventDefaultAction('#campNoelAnc1');stopAnimation();showPageContent('#campNoelAnc1','<?php echo $footerLinks[$arraylink[484]];?>/','500','900','484');return false;"
	title="Munnar Romance 2 Nights" class="thickbox wht_txt">Munnar Romance 2 Nights</a>
	</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="camkkkAnc1" href="<?php echo $footerLinks[$arraylink[572]];?>" onclick="preventDefaultAction('#camkkkAnc1');stopAnimation();showPageContent('#camkkkAnc1','<?php echo $footerLinks[$arraylink[572]];?>/','500','900','572');return false;" class="thickbox wht_txt" title="Hills & Falls 4 Nights">Hills & Falls 4 Nights</a>
</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="cmhAnc1" href="<?php echo $footerLinks[$arraylink[555]];?>" onclick="preventDefaultAction('#cmhAnc1');stopAnimation();showPageContent('#cmhAnc1','<?php echo $footerLinks[$arraylink[555]];?>/','500','900','555');return false;"
	title="Houseboat Honeymoon 4 Nights"
	class="thickbox wht_txt">Houseboat Honeymoon 4 Nights</a>
	</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="cmtaAnc1" href="<?php echo $footerLinks[$arraylink[500]];?>" onclick="preventDefaultAction('#cmtaAnc1');stopAnimation();showPageContent('#cmtaAnc1','<?php echo $footerLinks[$arraylink[500]];?>/','500','900','500');return false;"
	title="Hills & Wildlife 5 Nights"
	class="thickbox wht_txt">Hills & Wildlife 5 Nights</a>
	</div>

<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="cmtakAnc1" href="<?php echo $footerLinks[$arraylink[527]];?>" onclick="preventDefaultAction('#cmtakAnc1');stopAnimation();showPageContent('#cmtakAnc1','<?php echo $footerLinks[$arraylink[527]];?>/','500','900','527');return false;"
	title="Hills & Beaches 6 Nights"
	class="thickbox wht_txt">Hills & Beaches 6 Nights</a>
	</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="cmk6nAnc1" href="<?php echo $footerLinks[$arraylink[418]];?>" onclick="preventDefaultAction('#cmk6nAnc1');stopAnimation();showPageContent('#cmk6nAnc1','<?php echo $footerLinks[$arraylink[418]];?>/','500','900','418');return false;"
	title="TripAdvisor Award Winners  6 Nights"
	class="thickbox wht_txt">TripAdvisor Award Winners  6 Nights</a>
	</div>
<div><a style="font-size:12px;" id="Wayanad2NightsAnc1" href="<?php echo $footerLinks[$arraylink[588]];?>" onclick="preventDefaultAction('#Wayanad2NightsAnc1');stopAnimation();showPageContent('#Wayanad2NightsAnc1','<?php echo $footerLinks[$arraylink[588]];?>/','500','900','588');return false;"
	title="Wayanad 2 Nights"
	class="thickbox wht_txt">Wayanad 2 Nights</a>
	</div>

</div></div>
</div>

</div></div></div>
            </div>
	        <?php 
        		include_once $APPLICATION_PATH.'views/footer.php';
        	?>
        </div>
      
       
</div>
</body>
</html>
