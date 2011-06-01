<?php 
	include '../../config/constants.php';
?>
<table border="0" cellpadding="0" cellspacing="0" width="958" align="center">
<tr><td class="con_bg_top"></td></tr>
<tr><td class="con_bg_mid">
<table border="0" cellpadding="0" cellspacing="0" width="95%" align="center">
<tr>
<td>
	<table border="0" align="center" cellpadding="2" cellspacing="2" >
		<tr>
		<td class="label gry_txt" align="right" valign="middle" ><strong>Status :</strong></td>
        <td>
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
		    <td width="13%" align="center" class="gry_txt"><strong>Status</strong></td>		    
        <?php  if($status == 1) {?>
        <td width="13%" align="center" class="gry_txt"><strong>Order</strong></td>  		    
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
				echo "<span onmouseover=ShowPopup('".$images[$i]['img_src']."'); onMouseOut=HidePopup(\"table-1\"); style='cursor: pointer;'>".htmlentities($images[$i]['img_title'])."</span>";
				echo " </td>";
				if($images[$i]['img_status']==1){
					echo "<td  class='blu_txt'width='13%' align='center' style='border-bottom:1px solid #aaaaaa;'><a href= '#' onclick='inActivateImages(".$id.",\"table-1\",\"txtStatus\",\"page\")'>
									Inactivate</a></td>";
				}else{
					echo "<td  class='blu_txt'width='13%' align='center' style='border-bottom:1px solid #aaaaaa;'><a href= '#' onclick='activateImages(".$id.",\"table-1\",\"txtStatus\",\"page\")'>
									Activate</a></td>";
				}
				if($status==1){
					echo "<td  class='blu_txt'width='13%' align='center' style='border-bottom:1px solid #aaaaaa;'>".$images[$i]['img_order']."</td>";
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
