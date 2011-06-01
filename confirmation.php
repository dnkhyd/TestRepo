<?php
$root_url='http://www.mykeralahotels.in';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Kerala</title>
<link href="<?echo $root_url;?>/css/thickbox.css" rel="stylesheet" type="text/css" />
<script>
function validate()
{
	if(document.getElementById('confirmPwd'))
	{
		if(document.getElementById('confirmPwd').value == ""){
			document.getElementById('errMsg').innerHTML = "Please provide the password.";
			return;
		}
		document.getElementById('actFrm').submit();
	}
}

</script>
</head>

<body>
<link href="<?echo $root_url;?>/css/styles.css" rel="stylesheet" type="text/css" />
<form id="actFrm" name="actFrm" action="" method="POST">
<!--<div id="fbDataPost" style="display:none;">
<input type="hidden" name="redirect_to" value="http://www.mykeralahotels.in/" /><input type="hidden" name="log" id="log" value="" /><input type="hidden" name="pwd" id="pwd" value="" />-->
</div>
<div style="width:610px; margin-left:auto; margin-right:auto;">
		<div class="login_bg_top">
        <div style="float:right;padding:10px 14px 0px 0px;"><!--<span class="mkh_sh_btns close_btn_1" onclick="closeSigninPopup('close')"></span>--></div>
        </div>
    	<div class="login_bg_mid_2" style="width:610px; padding-left:40px; overflow:hidden;" name="main_login">
                		
                    <div style="padding:0px 15px 0px 0px; overflow:hidden; width:550px;">
                    <div class="mykr_img logo" style="float: left;"><div><a title="MyKerala" href="http://www.mykeralahotels.in" target="_self"  style="width:250px; height:94px; outline:none; display:block;"></a></div></div>
                    <div style="padding-left:7px;">	
                        <div class="trv_txt_1" style="font-size:14px; padding:0px 0px 8px 0px; clear:both; font-size:18px;color:#343434; ">Please provide the password to activate your account
</div>
                        <div style="clear:both;">
                        	<div style="width:580px; float:left;">
                            	<div>
                                	<div>
                                <div style="float:left; padding:4px 0px 0px 0px;"><input style="width:200px;" type="password" name="confirmPwd" id="confirmPwd" />
                                </div>
                                <div style="float:left; padding-left:8px; padding-right:8px;"><input onclick="validate()" class="mkh_btns_2 sbmt_btn" type="button" name="button" id="button" value="" /> </div>
								
								<div id="errMsg" style="padding:6px 0px 0px 20px;display: block; line-height: 14px; color: rgb(255, 0, 0); font-size: 12px; font-family: Arial;"></div>
                                	</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    </div>
                </div>
   		<div class="login_bg_bot"></div>
</div>
</form>
<?
//print_r($_REQUEST);
if(isset($_POST))
{
	if($_POST["confirmPwd"])
	{
		//print_r($_REQUEST);
		//echo $curPageURL = curPageURL();
		/*** db connection strat ***/
		$con = mysql_connect("mysql50-56.wc2.dfw1.stabletransit.com","488180_blog","mykera1A");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("488180_blog", $con);
		/*** db connection end ***/

		//echo $sql="SELECT * FROM mkh_authenticate WHERE ag_id = '".$_REQUEST['agId']."' AND token = '".$_REQUEST['confirmPwd']."' AND identifier = 'mkh' AND status=0;";


$sql="SELECT * FROM wp_users WHERE user_email= (SELECT email FROM mkh_authenticate WHERE ag_id = '".$_REQUEST['agId']."' AND token = '".$_REQUEST['confirmPwd']."' AND identifier = 'mkh' AND STATUS=0);";

		$result = mysql_query($sql,$con);

		if(mysql_error())
		{
			die('Error: ' . mysql_error());
		}
		else
		{
			if(mysql_num_rows($result)>0)
			{
				//$curPageURL = curPageURL();
				$row = mysql_fetch_assoc($result);
				$agId = $_REQUEST['agId'];
				$email = $row['user_email'];
				$username = $row['user_login'];

				$sql="UPDATE mkh_authenticate SET status = 1, timestamp = now() WHERE email = '".$email."' AND ag_id = '".$agId."' AND identifier = 'mkh';";
				$result = mysql_query($sql,$con);

				if(mysql_error())
				{
					die('Error: ' . mysql_error());
				}
				else
				{
					/*** generating password md5 start ***/
						$pass = md5($email.$agId);
					/*** generating password md5 end ***/
					?>
					<script>
					var divTag = document.createElement("div");
					divTag.id = "fbDataPost";
					divTag.style.display = "none";
					divTag.innerHTML = '<form id="loginfrm" name="loginfrm" action="http://www.mykeralahotels.in/kerala/travel/wp-login.php" method="post" ><input type="hidden" name="redirect_to" value="http://www.mykeralahotels.in/" /><input type="text" name="log" id="log" value="<?echo $username;?>" /><input type="password" name="pwd" id="pwd" value="<?echo $pass;?>" /></form>';
					document.body.appendChild(divTag);
					//document.getElementById("actFrm").action ="http://www.mykeralahotels.in/kerala/travel/wp-login.php";

					document.getElementById("loginfrm").submit();
					</script>
					
					<?
				}
			}
			else
			{
			
				echo "<script>document.getElementById('errMsg').innerHTML='Wrong password.';</script>";
			}
		}

	}
}
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>

</body>
</html>
