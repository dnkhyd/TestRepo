<head>
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="0">
<script type="text/javascript" >
function CheckLoginFrm()
{
	frm = document.loginForm;
	username = frm.txtUserName;password = frm.txtPassWord;
	if(username.value=="" || username.value==null){
		document.getElementById('error').innerHTML = "Please enter your username";
		//alert("Please enter your username");
		username.focus();
		return false;
	}
	if(password.value=="" || password.value==null){
		document.getElementById('error').innerHTML = "Please enter your password";
		//alert("Please enter your password");
		password.focus();
		return false;
	}
	return true;
}
</script>
<link href=<?php echo 'http://'.ROOT.'/css/styles.css';?> rel="stylesheet" type="text/css" />
</head>
<body onLoad="javascript:document.getElementById('txtUserName').focus()">
<table border="0" cellpadding="0" cellspacing="0" width="503" align="center">
<tr><td class="con_1_img con_1_top"></td></tr>
<tr><td class="con_1_img con_1_mid" valign="top">
    <table width="503" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr><td align="center" valign="top"><div  class="mykr_img logo"></div></td></tr>
      <tr>
        <td align="center" valign="middle" >
            <form id="loginForm" name="loginForm" method="post" action="index.php" onSubmit="return CheckLoginFrm();">
                <table border="0" cellspacing="0" cellpadding="0"><tr>
                <td style='font-family:Verdana; font-size:12px; font-weight:normal; color:red; text-align: center' >
                <div id="error">
                    <?php 
                         if($Login>0){
                         	 echo " User Name and Password are not Valid	";
	                    }
                    ?>
                   </div>
                  </td>
                  </tr>                 
                  </table>
            <table border="0" cellspacing="2" cellpadding="2"  align="center">
                <tr>
                  <td align="left" valign="middle"><strong>User Name:</strong></td>
                  <td align="left" valign="middle">
                  <input name="txtUserName" type="text" id="txtUserName"  style="width:155px;"/></td>
                </tr>
                <tr>
                  <td align="left" valign="middle"><strong>Password:</strong></td>
                 <td align="left" valign="middle">
                  <input name="txtPassWord" type="password" id="txtPassWord" style="width:155px;"/></td>
                </tr>
                <tr>
                  <td></td>	
                  <td align="left" valign="middle">
                   <input type="submit" name="btnSubmit" value="" class="mykr_img sign_btn" style="outline:none;" /> 
                  <input name="hdnAction" type="hidden"  id="hdnAction" value="login"/>
                  </td>
                </tr>
              </table>
            </form>
         </td>
      </tr>
    </table>
    </td></tr>
<tr><td class="con_1_img con_1_bot"></td></tr>
</table>
    
</body>