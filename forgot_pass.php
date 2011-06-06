<?php $root_url='http://www.mykeralahotels.in';
//print_r($_REQUEST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Kerala</title>
<link href="<?php echo $root_url;?>/css/thickbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $root_url;?>/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/jquery.cycle.all.2.74.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/BrowserCheck.js"></script>
<script type="text/javascript" src="<?php echo $root_url;?>/js/mykerala.js?t=<?php echo $time;?>"></script>
</head>

<body>
<div style=" margin-left:auto; margin-right:auto;">
	<div class="login_bg_top">
		<div style="float:right; padding:10px 14px 0px 0px;"><span class="mkh_sh_btns close_btn" onclick="closeFPPopup('close')"></span></div>
	</div>
	<div class="login_bg_mid_2" style="width:610px; padding-left:40px; overflow:hidden;" name="main_login">	                		
		<div style="padding:15px 15px 0px 0px; overflow:hidden; width:550px;">
			<div class="trv_txt_1" style="font-size:14px; padding:0px 0px 20px 0px; clear:both; font-size:18px; ">Forgot Password?</div>
			<div style="clear:both;">
				<div name="left">
					<div>
						<div class="trv_txt_1" style="font-size:14px;">We'll send you an e-mail to reset it.</div>
						<div class="gry_txt_sm" style="padding:8px 0px 0px 0px;">E-mail address </div>
						<div style="padding:0px 0px 8px 0px;">
							<input type="text" name="emailfp" id="emailfp" style="width:280px; font-family:Arial;" value="" />
						</div>
						<div style="float:right; padding:8px 10px 0px 0px;">
							<input class="mkh_btns_2 sbmt_btn" type="button" name="fpbutton" id="fpbutton" value="" onclick="submitEmail()" />
						</div>
						<br/>
						<span id="errMsg" style="display: block; line-height: 14px; color: rgb(255, 0, 0); font-size: 12px; font-family: Arial;"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="login_bg_bot"></div>
</div>
</body>
</html>
