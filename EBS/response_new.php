<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/configurations.php';
		include_once $APPLICATION_PATH.$FOLDER_NAME.'views/headerebs.php';
		include_once($_SERVER['DOCUMENT_ROOT'].'/views/modalpopup.php');

    $FOLDER_NAME='';
    $TFOLDER='/kerala/travel/';
    
    $APPLICATION_URL_NEW="http://".$_SERVER["HTTP_HOST"];
    
	 $secret_key = "7ab90f163e07ad50edfaf8b0a2b09200";	 // Your Secret Key
if(isset($_GET['DR'])) {
	 require('Rc43.php');
	 $DR = preg_replace("/\s/","+",$_GET['DR']);

	 $rc4 = new Crypt_RC4($secret_key);
 	 $QueryString = base64_decode($DR);
	 $rc4->decrypt($QueryString);
	 $QueryString = split('&',$QueryString);

	 $response = array();
	 foreach($QueryString as $param){
	 	$param = split('=',$param);
		$response[$param[0]] = urldecode($param[1]);
	 }
}
?>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="shortcut icon"  href="<?php echo $APPLICATION_URL_NEW."/".$FOLDER_NAME;?>images/favicon.ico"  />
<link href="<?php echo $APPLICATION_URL_NEW;?>/kerala/travel/wp-content/themes/twentyten/styles1.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $APPLICATION_URL_NEW."/".$FOLDER_NAME;?>/css/styles.css?t=<?php echo $time;?>" rel="stylesheet" type="text/css" />

<div style="margin-left:auto; margin-right:auto; width:500px;"  >
    <table width="100%" cellpadding="2" cellspacing="0"  style="border:4px solid #525252; ">
        <tr>
            <th colspan="2" class="selectd" >Transaction Details</th>
        </tr>
<?php
		$i=0;
		$arrResponse = array();
		foreach( $response as $key => $value) {
			$searchKey = 0;
      $arrResponse[$key] = $value;
		  $searchKey =  strripos($key,"livery");
		  if($searchKey==false){
		    if($key != "Mode" && $key != "IsFlagged"  && $key != "ResponseCode" )   {
?>			
        <tr>
            <td class = "ebs_infotxt" style="padding-left:50px; " width="50%"><?php echo $key; ?></td>
            <td class = "ebs_infotxt" align="left" width="50%"><strong>: </strong><?php echo $value; ?></td>
        </tr>
<?php
        }
      }  
      $i++;
		}
		$arrResponse["returnUrl"] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$arrResponse["JSONObject"] = json_encode($response);

		$link = mysql_connect('192.168.169.60', 'sapplica', 's@pplic@2008#');
	    if (!$link) {
	        die('Could not connect: ' . mysql_error());
	    }
	    mysql_select_db("mkhlivetest",$link);
	   	
	    function mysql_insert($inserts) {
		    $values = array_map('mysql_real_escape_string', array_values($inserts));
		    $keys = array_keys($inserts);
		       
		    return mysql_query('INSERT INTO `ebs_transaction_details` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
		}
		mysql_insert($arrResponse);
	    mysql_close($link);
?>		
	</table>
</div>


