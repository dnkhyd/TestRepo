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
<span style="line-height: 50px; padding-left: 30px; float:left;">Featured Packages</span><div style="position: relative; float: right; top: 6px; left: -10px; " class="mykr_img arrow_img" id="arrowImg"></div>
</div>
<div style="z-index: 9; position: absolute; top: 50px; left: 0px; display: none; width: 245px;"  id="floatingContent">
<div class="mykr_img txtmsg_bg"> <div style="padding: 0px 0px 0px 12px; .padding: 0px 0px 0px 0px;width:221px;">
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="adventureAnc1" href="<?php echo get_permalink( '855' ); ?>" onclick="preventDefaultAction('#adventureAnc1');stopAnimation();showPageContent('#adventureAnc1','<?php echo get_permalink( '855' ); ?>/','500','900','855');return false;"
	title="Adventure in Vagamon"
	class="thickbox wht_txt">Adventure in Vagamon</a>
	</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="cmtakAnc1" href="<?php echo get_permalink( '527' ); ?>" onclick="preventDefaultAction('#cmtakAnc1');stopAnimation();showPageContent('#cmtakAnc1','<?php echo get_permalink( '527' ); ?>/','500','900','527');return false;"
	title="Hills & Beaches 6 Nights"
	class="thickbox wht_txt">Hills & Beaches 6 Nights</a>
	</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="camkkkAnc1" href="<?php echo get_permalink( '572' ); ?>" onclick="preventDefaultAction('#camkkkAnc1');stopAnimation();showPageContent('#camkkkAnc1','<?php echo get_permalink( '572' ); ?>/','500','900','572');return false;" class="thickbox wht_txt" title="Hills & Falls 4 Nights">Hills & Falls 4 Nights</a>


</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="cmtaAnc1" href="<?php echo get_permalink( '500' ); ?>" onclick="preventDefaultAction('#cmtaAnc1');stopAnimation();showPageContent('#cmtaAnc1','<?php echo get_permalink( '500' ); ?>/','500','900','500');return false;"
	title="Hills & Wildlife 5 Nights"
	class="thickbox wht_txt">Hills & Wildlife 5 Nights</a>
	</div>

<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="cmhAnc1" href="<?php echo get_permalink( '555' ); ?>" onclick="preventDefaultAction('#cmhAnc1');stopAnimation();showPageContent('#cmhAnc1','<?php echo get_permalink( '555' ); ?>/','500','900','555');return false;"
	title="Houseboat Honeymoon 4 Nights"
	class="thickbox wht_txt">Houseboat Honeymoon 4 Nights</a>
	</div>    
<div  style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="monsoonAnc1" href="<?php echo get_permalink( '953' ); ?>" onclick="preventDefaultAction('#monsoonAnc1');stopAnimation();showPageContent('#monsoonAnc1','<?php echo get_permalink( '953' ); ?>/','500','900','953');return false;"
	title="Monsoon Rejuvenation"
	class="thickbox wht_txt">Monsoon Rejuvenation</a>
	</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="munnarAnc1" href="<?php echo get_permalink( '484' ); ?>" onclick="preventDefaultAction('#munnarAnc1');stopAnimation();showPageContent('#munnarAnc1','<?php echo get_permalink( '484' ); ?>/','500','900','484');return false;"
	title="Munnar Romance 2 Nights" class="thickbox wht_txt">Munnar Romance 2 Nights</a>
	</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="thegreatAnc1" href="<?php echo get_permalink( '910' ); ?>" onclick="preventDefaultAction('#thegreatAnc1');stopAnimation();showPageContent('#thegreatAnc1','<?php echo get_permalink( '910' ); ?>/','500','900','910');return false;"
	title="The Great Escape for Teams"
	class="thickbox wht_txt">The Great Escape for Teams</a>
	</div>
<div style="border-bottom:1px dotted #FFFFFF;">
<a style="font-size:12px;" id="tripAnc1" href="<?php echo get_permalink( '418]' );?>" onclick="preventDefaultAction('#tripAnc1');stopAnimation();showPageContent('#tripAnc1','<?php echo get_permalink( '418]' );?>/','500','900','418');return false;"
	title="TripAdvisor Award Winners"
	class="thickbox wht_txt">TripAdvisor Award Winners</a>
	</div>
<div style="margin-top:0px; .margin-top:-3px;">
<a style="font-size:12px;" id="Wayanad2NightsAnc1" href="<?php echo get_permalink( '588' );?>" onclick="preventDefaultAction('#Wayanad2NightsAnc1');stopAnimation();showPageContent('#Wayanad2NightsAnc1','<?php echo get_permalink( '588' );?>/','500','900','588');return false;"
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
