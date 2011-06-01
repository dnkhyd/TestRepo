<?php
	include 'config/constants.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="0">
<style type="text/css">
body{ margin:0; padding:0;color: black;font-family: inherit;font-size: 16px;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>MyKerala</title>
<link href=<?php echo 'http://'.ROOT.'/css/styles.css';?> rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mykerala.js"></script>
<script type="text/javascript" src="scripts/jquery-1.4.2.js"></script>
<script type="text/javascript" src="scripts/ajaxupload.js"></script>
<script type="text/javascript" src="scripts/jquery.tablednd_0_5.js"></script>
<script type="text/javascript">
var url = "<?php  echo 'http://'.ROOT.'/'; ?>";
$(function(){
	
	var myurl = url+"app/controllers/my_imagesController.php";
	var params	= "action=get&status=1&p=1";
	$.ajax({
		  url: myurl,
		  data : params,
		  success: function(data) {
		  $("#right").html(data);
		  prepareDragandDrop($("#table-1"));
		  }
		});
});
function sample(flag,Global_id,Global_id1)
{
	
	var Status_name =1;
 	var xmlhttp = GetXmlHttpObject();
 	
	if(flag){
		Status_name = flag;
	}else{
		if(document.getElementById('txtStatus')){
			var txtStatusName			=	document.getElementById('txtStatus');
			var index = txtStatusName.selectedIndex;
			Status_name = txtStatusName.options[index].value;
			
		}	
	}
	if(Global_id < 1){
		Global_id=1;
	}
	
 	var params	= "action=get&status="+Status_name+"&p="+Global_id;
	if (xmlhttp == null) {
		alert("Your Browser does not support Javascript.Enable Javascript.");
		return false;
	}
	var myurl = url+"app/controllers/my_imagesController.php";
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if(Global_id1=='selection'){
				document.getElementById("upload_area").innerHTML='';
			}
			document.getElementById("right").innerHTML=xmlhttp.responseText;
			prepareDragandDrop($("#table-1"),Status_name,Global_id);
		}
	};
	xmlhttp.open("POST", myurl, true);
	xmlhttp.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader("Cache-Control", "no-cache");
	xmlhttp.send(params);
}	

</script>

</head>
<body>
				
<table border="0" cellpadding="0" cellspacing="0" width="1003" align="center">
<tr>
	<td>
		<table width="958" cellpadding="0" cellspacing="0" border="0" align="center">
			<tr>
				<td class="con_bg_top"></td>
			</tr>
			<tr>
		        <td class="con_bg_mid" valign="top">
		        <?php 
			        if($_SESSION['user']){
		        		echo '<div><a class="gry_txt" style="float:right; padding-right:38px; padding-top:38px; outline:none;" href="index.php">Sign out</a></div>';
	                  }
			         ?>
                									<div  class="mykr_img logo"></div>
              </td>
		        </tr>
	        <tr>
	        	<td class="con_bg_bottom"></td>
			</tr>
		</table>
     </td>
</tr>
        <tr><td>
		<table  border="0" cellpadding="0" cellspacing="0" width="958" align="center">
			<tr>
			<td class="con_bg_top"></td>
			</tr>
			<tr>
			  <td class="con_bg_mid">
			  	<div id="image_div">
				     <table border="0" cellpadding="0" cellspacing="0" width="94%" align="center">          
				          <tr>
				        	  <td>
				        		  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				        			    <tr>
						                  	  <td align='right'>
						                  	  	  <div id="debugArea"></div>
						                   	  </td>
				                  		</tr>
				                		<tr>
				                			<td width="15%" align="left" class="gry_txt">
				                				<strong>Upload New File</strong>
				                			</td>
				        			  </tr>
                                        <tr>
                                                <td width="10%" align="left"  style="padding-bottom:0px; .padding-bottom:8px;">
                                                    (Please upload image of 1024X768  and size less than <?php echo ini_get('upload_max_filesize').'B'; ?> ) 
                                                </td>
                                          </tr>
				        			 	<tr>
				        				   <td class="blu_txt">
				        					    <form method="post" id = "upload_form" name="upload_form"  action="#" enctype="multipart/form-data"
				        					    		onsubmit="return getCheckedValue()" >
				        									 <p> <strong>Title: </strong><input type="text" name="title" size="15" id="Title"> </p> 
				        											<input type="hidden" name="maxSize" value="9999999999" />
				        											<input type="hidden" name="maxW" value="1024" />
				        											<input type="hidden" name="fullPath" value= <?php echo 'http://'.ROOT.'/uploads/'?>  />
				        											<input type="hidden" name="relPath" value= <?php echo 'http://'.ROOT.'/uploads/'?> />
				        											<input type="hidden" name="colorR" value="255" />
				        											<input type="hidden" name="colorG" value="255" />
				        											<input type="hidden" name="colorB" value="255" />
				        											<input type="hidden" name="maxH" value="768" />
				        											<input type="hidden" name="filename" value="filename" />
				        											<input type="hidden" name="realFileName" value="header" />
				        											<p>
<input type="file" id="file" name="filename" onChange="ajaxUpload(this.form,
				        											'<?php echo 'http://'.ROOT.'/';?>app/views/uploadImage.php?filename=name&maxSize=9999999999&maxW=1024;&fullPath=<?php echo 'http://'.ROOT.'/uploads/';?>&relPath=<?php echo 'http://'.ROOT.'/';?>uploads/&colorR=255&colorG=255&colorB=255&maxH=768;&realFileName=header;',
				        											'upload_area',
				        											'File Uploading Please Wait...<br /><img src=\'<?php echo 'http://'.ROOT.'/';?>images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' />','<img src=\'<?php echo 'http://'.ROOT.'/';?>images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /> Error in Upload, check settings and path info in source code.'); return false;" />
</p>
				        						 </form>
				        					    <div id="upload_area">
				        					    </div>
				        				   </td>         				   
				        			   </tr>
				        		   </table>
				        	   </td>
				          </tr>
				      </table> 
			    </div>
			    </td>
			    
			</tr>
			<tr><td class="con_bg_bottom"></td></tr>
		</table>
        </td></tr>
        <tr><td>
       <div id="right">
	   	<table border="0" cellpadding="0" cellspacing="0" width="958" align="center">
			<tr><td class="con_bg_top"></td></tr>
			<tr>
			<td class="con_bg_mid" align="center">
				   	 <img alt="Loading" src= <?php echo 'http://'.ROOT.'/images/loader_light_blue.gif'?> align="middle">  
				   
			</td>
			</tr>
			<tr><td class="con_bg_bottom"></td></tr>
		</table>  
</div>			
 		</td></tr>
