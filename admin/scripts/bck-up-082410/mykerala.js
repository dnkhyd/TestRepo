var xmlhttp;
//var url="http://mykeralahotels.in/admin/";
var rowsArray;
var image_loader = '<table border="0" cellpadding="0" cellspacing="0" width="958" align="center">';
	image_loader+='<tr><td class="con_bg_top"></td></tr>';
	image_loader+='<tr>';
	image_loader+='<td class="con_bg_mid" align="center">';
	image_loader+='<img alt="Loading" src="http://mykeralahotels.in/admin/images/loader_light_blue.gif" align="middle">';  
	image_loader+='</td></tr><tr><td class="con_bg_bottom"></td></tr></table>';
function GetXmlHttpObject() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject) {
		// code for IE6, IE5
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}

function inActivateImages(imageid,tableID,txtStatus,page_id,flag){
	var xmlhttp = GetXmlHttpObject();
	var params	= "action=inactive&imageid="+imageid;
	    
	if (xmlhttp == null) {
		alert("Your Browser does not support Javascript.Enable Javascript.");
		return false;
	}
	
	if(document.getElementById(txtStatus)){
		var txtStatusName			=	document.getElementById(txtStatus);
		var index = txtStatusName.selectedIndex;
		var Status_name = txtStatusName.options[index].value;	
		
	}
	
	if(document.getElementById(page_id)){
		var page = document.getElementById(page_id).value; 
	}	
	
	var myurl = url+"app/controllers/my_imagesController.php";
	xmlhttp.onreadystatechange = function() {
		document.getElementById("right").innerHTML=image_loader;
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("upload_area").innerHTML='';
			//document.getElementById("right").innerHTML=xmlhttp.responseText;
			sample(Status_name,'1');
		}
	};
	xmlhttp.open("POST", myurl, true);
	xmlhttp.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader("Cache-Control", "no-cache");
	xmlhttp.send(params);
}

function activateImages(imageid,tableID,txtStatus,page_id,flag){
	var xmlhttp = GetXmlHttpObject();
	var params	= "action=active&imageid="+imageid;
	
	if (xmlhttp == null) {
		alert("Your Browser does not support Javascript.Enable Javascript.");
		return false;
	}
	
	if(document.getElementById(txtStatus)){
		var txtStatusName			=	document.getElementById(txtStatus);
		var index = txtStatusName.selectedIndex;
		var Status_name = txtStatusName.options[index].value;	
		
	}
	
	if(document.getElementById(page_id)){
		var page = document.getElementById(page_id).value; 
	}	
	
	var myurl = url+"app/controllers/my_imagesController.php";
	xmlhttp.onreadystatechange = function() {
		document.getElementById("right").innerHTML=image_loader;
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("upload_area").innerHTML='';
			//document.getElementById("right").innerHTML=xmlhttp.responseText;
			sample(Status_name,'1');
		}
	};
	xmlhttp.open("POST", myurl, true);
	xmlhttp.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader("Cache-Control", "no-cache");
	xmlhttp.send(params);
}

function ShowPopup(imgName)
{
	var DivImage = document.getElementById('DivImg');
	var imag_html = "<table cellpadding='0' cellspacing='0' bgcolor='#ffffff' class='brdr_div'><tr><td><img src='"+imgName+"' width= '400' height='400' /></td></tr></table>";
	DivImage.innerHTML = imag_html;
	DivImage.style.visibility="visible";
}

function HidePopup(tableID)
{
	var DivImage = document.getElementById('DivImg');
	var imag_html = "<img src='' width= 0 height= 0 />";
	DivImage.innerHTML = imag_html;
	DivImage.style.visibility="Hidden";
}


function prepareDragandDrop(tblObj)
{
	if(document.getElementById('txtStatus')){
 		var txtStatusName			=	document.getElementById('txtStatus');
 		var index = txtStatusName.selectedIndex;
 		Status_name = txtStatusName.options[index].value;		
 	}
	 
	 if(Status_name==1){
		 rowsArray = new Array();
		$(tblObj).tableDnD({onDragClass: "myDragClass",
		    onDrop: function(table, row) {
	        var rows = table.tBodies[0].rows;
	        var debugStr = "Row dropped was "+row.id+". New order: ";
	        for (var i=0; i<rows.length; i++) {
	        	rowsArray[i]	=	rows[i].id;
	        	debugStr 	+= 	rows[i].id+" ";
	            
	        }
	    	addNewOrder('1','1'); }
		});
	 }
}

function addNewOrder(Status_name,page){
	
	var xmlhttp = GetXmlHttpObject();
	var params	= "action=update&imageid="+rowsArray+"&p="+page;
	if (xmlhttp == null) {
		alert("Your Browser does not support Javascript.Enable Javascript.");
		return false;
	}
	var myurl = url+"app/controllers/my_imagesController.php";
	xmlhttp.onreadystatechange = function() {
		document.getElementById("right").innerHTML=image_loader;
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("upload_area").innerHTML='';
			//document.getElementById("right").innerHTML=xmlhttp.responseText;
			 sample(Status_name,page);
		}
	};
	xmlhttp.open("POST", myurl, true);
	xmlhttp.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader("Cache-Control", "no-cache");
	xmlhttp.send(params);
	   
}

function detectBrowser(){
	var browserName='';
	if(/MSIE[\/\s](\d+\.\d+)/.test(navigator.userAgent)){
		browserName='MSIE';
	}
	return browserName;
}
function getCheckedValue(){
		
	if(document.getElementById('Title'))
		var txtTitle	=	document.getElementById('Title').value;
	
	if(txtTitle.length >200){
		alert("Title length must be less than 200 characters");
		document.getElementById('Title').value='';
		return false;
	}
	
	if(!txtTitle){
		alert("Please enter title");
		document.getElementById('Title').value='';
		return false;
	}
	if(document.getElementById('file').value);
		var file=document.getElementById('file').value;
	if(file==''){
		alert("You have to Select file for uploading");
		return false;
	}

}

