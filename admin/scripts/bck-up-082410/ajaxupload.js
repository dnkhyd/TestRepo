function $m(theVar){
	return document.getElementById(theVar);
}
function remove(theVar){

		var theParent = theVar.parentNode;
		theParent.removeChild(theVar);
	
}
function addEvent(obj, evType, fn){
	if(obj.addEventListener)
	    obj.addEventListener(evType, fn, true);
	if(obj.attachEvent)
	    obj.attachEvent("on"+evType, fn);
}
function removeEvent(obj, type, fn){
	if(obj.detachEvent){
		obj.detachEvent('on'+type, fn);
	}else{
		obj.removeEventListener(type, fn, false);
	}
}
function isWebKit(){
	return RegExp(" AppleWebKit/").test(navigator.userAgent);
}
function ajaxUpload(form,url_action,id_element,html_show_loading,html_error_http)
{
	if(document.getElementById('Title'))
	var txtTitle	=	document.getElementById('Title').value;
	var Status ;
	if(document.getElementById('txtStatus')){
		var txtStatusName			=	document.getElementById('txtStatus');
		var index = txtStatusName.selectedIndex;
		Status = txtStatusName.options[index].value;
	}
	
	if(document.getElementById("page")){
		var page = document.getElementById("page").value; 
	}
	if(getTitle(txtTitle)==''){
		alert("Please enter title");
		form.reset();
		txtTitle.focus();
		return;
	}
	if(txtTitle.length >200){
		alert("Title length must be less than 200 characters");
		form.reset();
		txtTitle.focus();
		return;
	}
	
	if(!txtTitle){
		alert("Please enter title");
		form.reset();
		txtTitle.focus();
		return;
	}
	if(document.getElementById("file")){
		if(!checkPhoto("file")){
			form.reset();
			return;
		}
	}
		 	
	
	var detectWebKit = isWebKit();
	form = typeof (form) == "string" ? $m(form) : form;
	var erro = "";
	if (form == null || typeof (form) == "undefined") {
		erro += "The form of 1st parameter does not exists.\n";
	} else if (form.nodeName.toLowerCase() != "form") {
		erro += "The form of 1st parameter its not a form.\n";
	}
	if ($m(id_element) == null) {
		erro += "The element of 3rd parameter does not exists.\n";
	}
	if (erro.length > 0) {
		alert("Error in call ajaxUpload:\n" + erro);
		return;
	}
	var iframe = document.createElement("iframe");
	iframe.setAttribute("id", "ajax-temp");
	iframe.setAttribute("name", "ajax-temp");
	iframe.setAttribute("width", "0");
	iframe.setAttribute("height", "0");
	iframe.setAttribute("border", "0");
	iframe.setAttribute("style", "width: 0; height: 0; border: none;");
	form.parentNode.appendChild(iframe);
	window.frames['ajax-temp'].name = "ajax-temp";
	var doUpload = function(data) {
		removeEvent($m('ajax-temp'), "load", doUpload);
		var cross = "javascript: ";
		cross += "window.parent.$m('" + id_element
				+ "').innerHTML = document.body.innerHTML; void(0);";
		$m(id_element).innerHTML = "";
		$m('ajax-temp').src = cross;

		if (detectWebKit) {
			remove($m('ajax-temp'));

		} else {
			setTimeout(function() {
				remove($m('ajax-temp'));
			}, 250);
		}


		form.reset();
		if(Status=='1'){
			 sample(Status,page);
		}else{
			 sample('1','1');
		}

	};

	
	addEvent($m('ajax-temp'), "load", doUpload);
	form.setAttribute("target", "ajax-temp");
	form.setAttribute("action", url_action);
	form.setAttribute("method", "post");
	form.setAttribute("enctype", "multipart/form-data");
	form.setAttribute("encoding", "multipart/form-data");
	if (html_show_loading.length > 0) {
		$m(id_element).innerHTML = html_show_loading;
	}
	form.submit();
	
}

function checkPhoto(picField) {
	 var picFile = picField;
	 var imageName = document.getElementById(picFile).value;
	 var pathLength = imageName.length;
	 var lastDot = imageName.lastIndexOf(".");
	 var fileType = imageName.substring(lastDot,pathLength);
	 if((fileType == ".gif") || (fileType == ".jpg") || (fileType == ".png") || (fileType == ".GIF") || (fileType == ".JPG") || (fileType == ".PNG")) {
	  return true;
	 } else {
	  alert("We support .JPG, .PNG, and .GIF image formats. Your file-type is " + fileType + ".");
	  return false;
	 }
}

function getTitle(generalTitle){
	if(generalTitle!=undefined){
		var genTitleString =generalTitle.replace(/^\s+/,'').replace(/\s+$/,'');
		return genTitleString;
	}
}
