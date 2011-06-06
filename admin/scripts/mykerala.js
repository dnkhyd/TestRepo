/**
 * The Javascript file used for the mykerala admin module
 * 
 * Project name : MyKerala
 * Created on   : 29-July-2010
 * Module       : Admin Module
 *
 * @author K.Manjunath
 * @version 1.0
 *
 */
var xmlhttp;
var rowsArray;
var editingImgID=0;
var image_loader = '<table border="0" cellpadding="0" cellspacing="0" width="958" align="center">';
	image_loader+='<tr><td class="con_bg_top"></td></tr>';
	image_loader+='<tr>';
	image_loader+='<td class="con_bg_mid" align="center">';
	image_loader+='<img alt="Loading" src="http://www.mykeralahotels.in/admin/images/loader_light_blue.gif" align="middle">';  
	image_loader+='</td></tr><tr><td class="con_bg_bottom"></td></tr></table>';
	
/**
 * @desc This method is used for getting the request object
 * @return http request object for IE7+, Firefox, Chrome, Opera, Safari and 
 *         for IE6, IE5  ActiveXObject else null
 */
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
/**
 * 
 * @desc This method is used for the inactivating the image.
 * 
 * @param imageid     Image Id for inactivating
 * @param txtStatus   Status whether in activation or inactivation mode
 * @param page_id     Page_id for pagination
 * @return            to the Image View page after the inactivation of the image
 */
function inActivateImages(imageid,txtStatus,page_id){
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
			sample(Status_name,'1');
		}
	};
	xmlhttp.open("POST", myurl, true);
	xmlhttp.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader("Cache-Control", "no-cache");
	xmlhttp.send(params);
}
/**
 * 
 * @desc This method is used for the activating the image.
 * 
 * @param imageid     Image Id for activating
 * @param txtStatus   Status whether in activation or inactivation mode
 * @param page_id     Page_id for pagination
 * @return            to the Image View page after the activation of the image
 */
function activateImages(imageid,txtStatus,page_id){
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
			sample(Status_name,'1');
		}
	};
	xmlhttp.open("POST", myurl, true);
	xmlhttp.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader("Cache-Control", "no-cache");
	xmlhttp.send(params);
}
/**
 * @desc This method is used to show image when mouseover on the image title
 * 
 * @param imageName   contains the actual path of image where it is stored
 * 
 * @return display the image in a html
 */
function ShowPopup(imgName)
{
	var DivImage = document.getElementById('DivImg');
	var imag_html = "<table cellpadding='0' cellspacing='0' bgcolor='#ffffff' class='brdr_div'><tr><td><img src='"+imgName+"' width= '400' height='400' /></td></tr></table>";
	DivImage.innerHTML = imag_html;
	DivImage.style.visibility="visible";
}
/**
 * @desc This method will hide the image div on mouse out.
 * 
 * @return make the image display div hidden
 */
function HidePopup(id,img)
{
	var DivImage = document.getElementById(id);
	if(img=="img"){
		var imag_html = "<img src='' width= 0 height= 0 />";
		DivImage.innerHTML = imag_html;
	}
	DivImage.style.visibility="Hidden";
	
		
}


/**
 * @desc This method is used for table row drag and drop functionality.When an row is dragged and dropped the order of the image
 * 			ids is fetched and stored in an array.
 * 
 * @param tblObj Table div id
 * @return
 */
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
/**
 * @desc This method will add the new order for the images.
 * 
 * @param Status_name  Status (active or inactive)
 * @param page Page number for pagination
 * @return new order of images in the Images View page.
 */

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
/**
 * @desc This method is used to detect the browser
 * 
 * @return browser name
 */
function detectBrowser(){
	var browserName='';
	if(/MSIE[\/\s](\d+\.\d+)/.test(navigator.userAgent)){
		browserName='MSIE';
	}
	return browserName;
}

/**
 * @desc This method is used for validating the title and file fields during Uplaod.
 * @return
 */
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

/**
 * @desc This method is used for updating the settings 
 * @param  checkId   the check box selected example: random or ordered
 * @return
 */

function updateImageDisplayOrder(checkId){
	          
	            
	var xmlhttp = GetXmlHttpObject();
	var params	= "action=settings&id="+checkId;
	if (xmlhttp == null) {
		alert("Your Browser does not support Javascript.Enable Javascript.");
		return false;
	}
	var myurl = url+"app/controllers/my_imagesController.php";
	xmlhttp.onreadystatechange = function() {
		document.getElementById("checkBox").innerHTML='<img alt="Loading" src="http://www.mykeralahotels.in/admin/images/loader_light_blue.gif" align="middle">';
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("checkBox").innerHTML='';
			document.getElementById("checkBox").innerHTML=xmlhttp.responseText;
		}
	};
	xmlhttp.open("POST", myurl, true);
	xmlhttp.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader("Cache-Control", "no-cache");
	xmlhttp.send(params);
	
}


                                
function imposeMaxLength(Object, MaxLen)
{
  return (Object.value.length <= MaxLen);
}


function leftChar(id,value)
{
	var maxlength = 80;
	
	var chars=maxlength-parseInt(document.getElementById(id).value.length);
	if(chars<0)
	{
		document.getElementById(id).value=document.getElementById(id).value.substring(0,maxlength);
		return false;
	}

}

function editImages(objectID,desc,title)
{
	document.getElementById("fileBrowse").style.display="none";
	document.getElementById("recordUpdate").style.display="block";
	document.getElementById("txtDescription").value = unescape(desc);
	document.getElementById("Title").value = title;
	 editingImgID=objectID;
	
	

}
function cancelEditImages()
{
	document.getElementById("recordUpdate").style.display="none";
	document.getElementById("fileBrowse").style.display="block";
	document.getElementById("txtDescription").value = "";
	document.getElementById("Title").value = "";
	 editingImgID=0;
	 
}

function updateImageData(){
	
	imageid=editingImgID;
	if(document.getElementById('Title'))
		title	=	document.getElementById('Title').value;
	
	if(title.length >200){
		alert("Title length must be less than 200 characters");
		document.getElementById('Title').value='';
		return false;
	}
	
	if(!title){
		alert("Please enter title");
		document.getElementById('Title').value='';
		return false;
	}
	if(getTitle(title)==''){
		alert("Please enter title");
		return;
	}
	
	if(document.getElementById('txtDescription')){
		desc			=	document.getElementById('txtDescription').value;
		if(desc.length >80){
			alert("Description length must be less than 80 characters");
			return;
		}
	}
	//desc=document.getElementById("txtDescription").value;
	//title=document.getElementById("Title").value;
	var xmlhttp = GetXmlHttpObject();
	var params	= "action=imgUpdate&imageid="+imageid+"&desc="+escape(desc)+"&title="+escape(title);
	if (xmlhttp == null) {
		alert("Your Browser does not support Javascript.Enable Javascript.");
		return false;
	}
	var myurl = url+"app/controllers/my_imagesController.php";
	xmlhttp.onreadystatechange = function() {
		document.getElementById("upload_area").innerHTML='<img alt="Loading" src="http://www.mykeralahotels.in/admin/images/loader_light_blue.gif" align="middle">';
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("upload_area").innerHTML='';
			sample('1','1');
			cancelEditImages();
		}
	};
	xmlhttp.open("POST", myurl, true);
	xmlhttp.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader("Cache-Control", "no-cache");
	xmlhttp.send(params);
	
}


