<?php 
	$root_url='http://www.mykeralahotels.in';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 	xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Kerala</title>
<!--<link href="<?php echo $root_url;?>/css/styles.css" rel="stylesheet" type="text/css" />-->
<?
//$tab	=	"home"; 

$FOLDER_NAME='mkhtest';
$TFOLDER='/kerala/travel/';

$APPLICATION_URL_NEW="http://".$_SERVER["HTTP_HOST"];

if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$FOLDER_NAME.$TFOLDER.'wp-load.php')) { 
  require_once($_SERVER['DOCUMENT_ROOT'].'/'.$FOLDER_NAME.$TFOLDER.'wp-load.php');
} else { 
  require_once($_SERVER['DOCUMENT_ROOT'].'/'.$FOLDER_NAME.$TFOLDER.'wp-config.php');
}
include_once $_SERVER['DOCUMENT_ROOT'].'/'.$FOLDER_NAME.$TFOLDER.'wp-includes/post.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/'.$FOLDER_NAME.'/configurations.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mkhtest/configurations.php';
?>
<script>
<?
$current_user = wp_get_current_user();
	echo "var loggedInUser = '".$current_user->user_login."';";
?>
</script>
<link href="<?php echo $root_url;?>/css/thickbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $root_url;?>/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/jquery.cycle.all.2.74.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/BrowserCheck.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/mykerala.js?t=<?php echo $time;?>"></script>


</head>
<body>
<!--<form id="loginfrm" name="loginfrm" action="http://www.mykeralahotels.in/kerala/travel/authenticate.php" method="post">
<input type="hidden" name="redirect_to" value="http://www.mykeralahotels.in/kerala/travel/authenticate.php" />-->
<input type="hidden" id="identifier" name="identifier" value="" />

<div style=" margin-left:auto; margin-right:auto;overflow-x:hidden; overflow-y:hidden; height:600px;">
		<div class="login_bg_top">
        <div style="float:right; padding:10px 14px 0px 0px;"><span class="mkh_sh_btns close_btn" onclick="closeSigninPopup('close')"></span></div>
        </div>
    	<div class="login_bg_mid_2" style="width:610px; padding-left:40px; overflow:hidden;" name="main_login">
                		
                    <div style="padding:10px; overflow:hidden; width:550px;">
                    	<div class="trv_txt_1" style="font-size:14px; padding:0px 0px 8px 0px; clear:both; ">Sign in using your Facebook account</div>
                        <div class="gry_txt_sm" style="padding:0px 0px 30px 0px;">
							<div id='fb-root'></div>
							<script src="http://connect.facebook.net/en_US/all.js" ></script>
							 <div style="float: left;"><img src="<?php echo $root_url;?>/images/fb_con.jpg" onclick="javascript:connect();"  id="login"></img></div><div style="color:#ff6600;float: left; margin-top: 1px; padding-left: 4px;">(Recommended)</div>
							<img src="logout_medium.gif" onclick="clearSession()" style="display:none;"  id="logout"></img>
						</div>
                        <div style="clear:both;">
                        	<div name="left" style="width:260px; float:left;">
							   	<div style="width:255px; border-right:2px solid #3e3e3e; padding-right:5px; height:312px;.height:305px;"><div class="trv_txt_1" style="font-size:14px;">or sign in to your My Kerala account</div>
								<div class="gry_txt_sm" style="height:14px;"> </div>
								<div class="gry_txt_sm" style="padding:8px 0px 0px 0px;">E-mail address </div>
                                <div style="padding:0px 0px 8px 0px;"><input type="text" name="log" id="log" value="<?php if(isset($_COOKIE["rm"])) echo $_COOKIE["rm"]; ?>" /></div>
                                <div class="gry_txt_sm">Password </div>
                                <div><input type="password" name="pwd" id="pwd" value="" style=".width:149px;"/></div>
                                <div><div style="float:left;"><input type="checkbox" name="rememberme" id="rememberme" /></div>
                                    <div style="float:left; padding-top:2px;" class="gry_txt_sm">Remember me</div>
								</div>
                                <div style="clear:both; padding:8px 0px 0px 0px;"><a id="forgotPwd" class="blu_txt_sm" href="javascript:void(0);" onclick = "showFPPopup();" >Forgot Password</a></div>

                                <div style="float:right; padding:8px 104px 0px 0px; .padding:8px 95px 0px 0px;"><input onclick="submitForm('log')" class="mkh_btns_2 signin_btn" type="button" name="loginBtn" id="loginBtn" value="" /></div>
								
								</div>
                            </div>
                            <div name="right" style="width:280px; padding-left:10px; float:left;">
                            	<div style="width:240px;"><div class="trv_txt_1" style="font-size:14px;">Don't have a account?</div>
								<div style="font-size: 11px;" class="gry_txt_sm">All fields are mandatory </div>
                                <div style="padding-left:20px;">
									
                                    <div class="gry_txt_sm" style="padding:8px 0px 0px 0px;">First Name </div>
                                <div style="padding:0px 0px 8px 0px;"><input type="text" name="fname" id="fname"  value=""/></div>
                                <div class="gry_txt_sm" >Last Name </div>
                                <div style="padding:0px 0px 8px 0px;"><input type="text" name="lname" id="lname"  value=""/></div>
                                <div class="gry_txt_sm" >Display Name</div>
                                <div style="padding:0px 0px 8px 0px;"><input type="text" name="dispName" id="dispName" value="" /></div>
                               	<div class="gry_txt_sm" >E-mail address </div>
                                <div style="padding:0px 0px 8px 0px;"><input type="text" name="email" id="email" /></div>
                                <div class="gry_txt_sm" >Password </div>
                                <div style="padding:0px 0px 8px 0px;"><input type="password" name="password" id="password"  value="" style=".width:149px;"/></div>
                                <div class="gry_txt_sm" >Confirm Password</div>
                                <div style="padding:0px 0px 8px 0px;"><input type="password" name="confPwd" id="confPwd"  value="" style=".width:149px;"/></div>
								 <div style="float:right; padding:8px 69px 0px 0px; .padding:8px 60px 0px 0px;"><input class="mkh_btns_2 signup_btn" type="button" name="regBtn" id="regBtn" value="" onclick="submitForm('reg')"/>
								</div>
                           </div>
						</div>
					</div>
				</div>
				<div style=" top: -30px;"><span id="errMsg" style="display: block; line-height: 14px; color: rgb(255, 0, 0); font-size: 12px; font-family: Arial;"></span></div>
			</div>
		</div>
	<div class="login_bg_bot"></div>
</div>

<!--</form>-->
</body>
</html>
