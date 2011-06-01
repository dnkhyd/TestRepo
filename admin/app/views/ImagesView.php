<?php 
	include '../../config/constants.php';
	
	/**
	 * 
     * @desc This is the image view page where we display all the images onmouseover
	 * 1. Activate/Inactivate the images
	 * 2. Drag and Drop the order of the images.
	 * 3. View the Active and Inactive images by selecting the dropdown list.
	 * 
	 * 
	 * Project name : MyKerala
	 * Created on   : 29-July-2010
	 * Module       : Admin Module
	 *
	 * @author K.Manjunath
	 * @version 1.0
	 *
	 *
	 */
	function getUploadedImageSizes($img){
			$fullPath= $_SERVER[DOCUMENT_ROOT]."/".PROJECT_NAME."/uploads/";
			$filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
			$filename = basename($img);
			$size = filesize($fullPath.$filename);
			return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 0) . $filesizename[$i] : '0 Bytes';
		}
	$sPattern = '/\s*/m';
	$sReplace = '';
?>

<table border="0" cellpadding="0" cellspacing="0" width="958" align="center">
<tr><td class="con_bg_top"></td></tr>
<tr><td class="con_bg_mid">
<table border="0" cellpadding="0" cellspacing="0" width="95%" align="center">
<tr>
<td>
	<table border="0" cellpadding="2" cellspacing="2" align="right" width="100%">
		<tr>
		<td class="label gry_txt" align="right" valign="middle" width="20%"><strong>Status :</strong></td>
        <td width="30%">
		<input type="hidden" id = "page"  value= <?php  echo $request;?> ></input>
		   <select name='txtStatus' id='txtStatus' onchange="sample('','0','selection');">
		   		<?php 
		   			if($status=='1'){
		   				echo "<option value='1' selected>Active</option>";
				        echo "<option value='0'>Inactive</option>";
		   			}
		   			if($status=='0'){
		   				echo "<option value='1'>Active</option>";
				        echo "<option value='0' selected>Inactive</option>";
		   			}
		   		?>
		   		
		   </select>
         </td>
         <td class="label gry_txt" align="right" valign="middle"  width="20%"><strong>Image Display:</strong></td>
         <td width="30%" >
         <div id="checkBox">
	         <?php 
	         	for ($i=0;$i<sizeof($imageSettings);$i++){
	         		if($imageSettings[$i]['active']==1){
	  			     	echo '<input id="'.$imageSettings[$i]['setting_name'].'" type="radio" checked="true" onClick="updateImageDisplayOrder(id)">'.$imageSettings[$i]['setting_name'];
	         		}else{
	         			echo '<input id="'.$imageSettings[$i]['setting_name'].'" type="radio"  onClick="updateImageDisplayOrder(id)">'.$imageSettings[$i]['setting_name'];
	         		}
			 	}
			 ?>
		 </div>
         </td>
        </tr>
     </table>
	</td>
</tr>
<tr>
	<td>
  	<table  align="center" width="99%" border="0" cellpadding="0" cellspacing="0" > 
      <tr bgcolor="#b8d6e3" height="25">
            <td width="5%" align="center" class="gry_txt"><strong>S.No</strong></td>         
		    <td width="13%" align="center" class="gry_txt"><strong>Title</strong></td>		    
		    <td width="13%" align="center" class="gry_txt"><strong>Size</strong></td>
		    <td width="13%" align="center" class="gry_txt"><strong>Status</strong></td>
		  	<td width="13%" align="center" class="gry_txt"><strong>Description</strong></td>
		  		    
        <?php  if($status == 1) {?>
        <td width="13%" align="center" class="gry_txt"><strong>Order</strong></td>  
        <td width="13%" align="center" class="gry_txt"><strong>Edit</strong></td>		    
        <?php  }?>
        	
     </tr></table>
     </td>
</tr>
<tr>
     <td>
     <?php  if($status == 1) {?>
     	<div id = 'DivImg' style='position:fixed;top:100px;left:450px;z-index:50;width:0px;height:0px;visibility:hidden;text-align:center;' >
     	</div>
      <?php  } else {?>
      	<div id = 'DivImg' style='position:fixed;top:100px;left:600px;z-index:50;width:0px;height:0px;visibility:hidden;text-align:center;' >
     	</div>
     	<?php  }?>
     
     	<div id="images_Div">
		<?php
		
		if(sizeof($images)>0){
			echo " <table id= 'table-1' width='99%' align='center' border='0' cellpadding='2' cellspacing='0'> ";
			for($i=0;$i<sizeof($images);$i++){
				$pagingno=$request-1;
				$id= $images[$i]['imageid'];
				echo "<tr id='".$id."' style='cursor: move;' >";
				echo "<td width='5%' class='blu_txt' align='center' style='border-bottom:1px solid #aaaaaa;'>".(($pagingno*10)+($i+1))."</td>";
		  		echo "<td  width='13%' class='blu_txt' align='center' style='border-bottom:1px solid #aaaaaa;height:50px;'>";
				echo "<span onmouseover=ShowPopup('".$images[$i]['img_src']."'); onMouseOut=HidePopup('DivImg','img'); style='cursor: pointer;'>".htmlentities($images[$i]['img_title'])."</span>";
				echo " </td>";
				echo "<td  class='blu_txt'width='13%' align='center' style='border-bottom:1px solid #aaaaaa;'>".getUploadedImageSizes($images[$i]['img_src'])."</td>";
				if($images[$i]['img_status']==1){
					echo "<td  class='blu_txt'width='13%' align='center' style='border-bottom:1px solid #aaaaaa;'><a href= '#' onclick='inActivateImages(".$id.",\"txtStatus\",\"page\")'>
									Inactivate</a></td>";
				}else{
					echo "<td  class='blu_txt'width='13%' align='center' style='border-bottom:1px solid #aaaaaa;'><a href= '#' onclick='activateImages(".$id.",\"txtStatus\",\"page\")'>
									Activate</a></td>";
				}
				$desc = ltrim($images[$i]['img_desc']," ");
				if (!empty($desc)){
					if($images[$i]['img_desc']!=''){
						echo "<td  width='13%' class='blu_txt' align='center' style='border-bottom:1px solid #aaaaaa;height:50px;'>";
						echo "<span><img src='http://".ROOT."/images/des.png' class='aaa' onmouseover=\"DescTooltip(&#39;".rawurlencode(htmlentities($images[$i]['img_desc']))."&#39;)\"; onMouseOut=HidePopup('dhtmltooltipa','none'); style='cursor: pointer;'></img></span>";
						echo " </td>";
					}
				}else{
					echo "<td  width='13%' class='blu_txt' align='center' style='border-bottom:1px solid #aaaaaa;height:50px;'>";
					echo "<span><img src='http://".ROOT."/images/des.png' class='aaa' onmouseover=\"DescTooltip(&#39;No Description&#39;)\"; onMouseOut=HidePopup('dhtmltooltipa','none'); style='cursor: pointer;'></img></span>";
					echo " </td>";
				}
				if($status==1){
					echo "<td  class='blu_txt'width='13%' align='center' style='border-bottom:1px solid #aaaaaa;'>".$images[$i]['img_order']."</td>";
					echo "<td  class='blu_txt'width='13%' align='center' style='border-bottom:1px solid #aaaaaa;' ><img src='http://".ROOT."/images/edit.png' onclick=\"editImages(".$id.",&#39;".rawurlencode($desc)."&#39;,&#39;".htmlentities($images[$i]['img_title'])."&#39;)\"  style='cursor: pointer;'></img></td>";
				}
				
				echo "</tr>";
			}
			echo "</table>";
		}else{
	 			echo "<tr><td align= 'center'><strong> NO IMAGES </strong></td></tr>";
	 	}
		?>
		</div>
	</td></tr>
</table>
</td>
</tr>      
<tr><td class="con_bg_bottom"></td></tr>         
</table>
