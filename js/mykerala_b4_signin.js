/**
 * @desc Handles following actions
 * 1. Loading the MyKerala fan page streams.
 * 2. Posting the Comments to MyKerala Page
 * 3. Checking the User Login Status
 * 4. Asking Permissions for read_stream and write_stream
 * 
 * @author rajasekhar
 * @project	MyKerala
 * @module Share
 * @version 1.0
 * @createdon July 20th 2010 
 */



/**
 * @desc loads the feed from MyKerala fan page and prepare the table and appends it to 
 * 		 facebookComments div of the share page
 * @return html element
 */
 var currentBackGroundImg=1;
  var emailIdC='';
var sucX=0;

var sucY=0;
/**
 * @desc loads the Footer Modal window
 * 		
 * @return 
 */

var myHash=null;
var setFooterLink = null; 
var footerLinkId = null; 


/**
 * @desc setting the seo friendly url after closing the footer popup
 * 		
 * @return 
 */
function setSeoFooterLink(){
	
$(footerLinkId).attr("href",setFooterLink);
footerLinkId=null;
footerLinkId = null;

}
/**
 * @desc setting the postId when clicking the Footer Modal window(Featured packages)
 * 		
 * @return 
 */
function setPostid(postid){
	pageiid=postid;
}

/**
 * @desc opens modal window when clicking the Footer links
 * 		
 * @return 
 */
  function showPageContent(aid,url,h,w,pid){

	if(pid){
	pageiid=pid;
}
setFooterLink = url;
	footerLinkId = aid;
	$(aid).attr("href",url+'?dId=2&KeepThis=true&TB_iframe=true&height='+h+'&width='+w);

}

/**
 * @desc Tracking Google Adwords
 * 		
 * @return 
 */
function googleAdwords() {
$.getScript('http://www.mykeralahotels.in/views/thankyou.html', function() {

});

}
  function showCopyMailIdPoup(action){

	

	 if(action=='close'){

		 resumeAnimation();

		 $("#chkCopyEmailId").attr('checked', false);

		 $('#modalDivEmail').css('display','none');

		

		 $('#modalContentDivEmail').css('display','none');

		

		 $('#headingDivEmail').html('');

		 $('#mainDivEmail').css('display','none');

		 $("#txtCopyMailId").val('');

		

	 }

	 else if(action=='checkmail'){

		 var copyMailId=$("#txtCopyMailId").val();

		 	if(copyMailId.length<1)

		 	{		

		 		alert("Please provide your E-mail Address.");

		 		$("#txtCopyMailId").focus();

		 		return false;

		 	}else{

		 		if(!echeck(copyMailId)){

		 			$("#txtCopyMailId").focus();

		 			return false;

		 		}

		 	}

		 	emailIdC=copyMailId;

		 $('#modalDivEmail').css('display','none');

		

		 $('#modalContentDivEmail').css('display','none');

		

		 $('#headingDivEmail').html('');

		 $('#mainDivEmail').css('display','none');

		 $("#chkCopyEmailId").attr('disabled', 'disabled');

		 $("#chkCopyEmailId").attr('checked', true);



	 }else{

		 $('#mainDivEmail').css('display','block');

		 $('#grayOut').css('display','block');

		 $('#modalContentDivEmail').css('display','block');

		 $('#modalDivEmail').css('display','block');		 

		 $('#headingDivEmail').html('');

		 $("#txtCopyMailId").val('');

	 }

	 

 }

 function BlankTextFieldValidatorFormMail()

 {

 	

 	var fName=$("#txtFName").val();

 	var lName=$("#txtLName").val();

 	var email=$("#txtEmail").val();

 	var catSel=$("#Category option:selected").val();

 	var inquiry =$("#txtInquiry").val();

 	var copyMailId='';

 	if(fName.length<3)

 	{		

 		alert("Please provide your Name.");

 		$("#txtFName").focus();

 		return false;

 	}

 	if(lName.length<1)

 	{		

 		alert("Please enter your last name.");

 		$("#txtLName").focus();

 		return false;

 	}

 	if(email.length<1)

 	{		

 		alert("Please provide your E-mail Address.");

 		$("#txtEmail").focus();

 		return false;

 	}else{

 		if(!echeck(email)){

 			$("#txtEmail").focus();

 			return false;

 		}

 	}

 	if(catSel<1)

 	{

 		alert("Please select category.");

 		return false;

 	}

 	if(inquiry.length<3)

 	{		

 		alert("Please enter a value for the \" Inquiry \" field.");

 		$("#txtInquiry").focus();

 		return false;

 	}

	if ($('#chkCopyEmailId').attr('checked')) {

   copyMailId=$("#txtEmail").val();

}

else

{

    copyMailId='';

}



 	$.post("http://www.mykeralahotels.in/views/webMail.php",

			  { fName: fName, lName: lName,email:email,catSel:$("#Category option:selected").text(),inquiry:inquiry,bookingID:$("#BookingID").val(),copyMailId:copyMailId },

			  function(data){

			   

			      	$("#txtFName").val("");

            $("#txtLName").val("");

	            $("#txtEmail").val("");

	            $("#Category ").val(0);

	            $("#txtInquiry").val("");

	            $("#BookingID").val("");

				  //emailIdC='';

	            //$('#modalContentDivCont').html('Mail Sent. Thank you.');

	            //$("#txtCopyMailId").val('');

				 closeContactPopup('open');

	            successMessagePopup('open');

			  }

			);



 	

 }

   function successMessagePopup(action){

	 

	  if(action=='close'){

		  resumeAnimation();

		  $('#mainDivEmailSuc').css('display','none');

			 $('#grayOut').css('display','none');

			 $('#modalContentDivEmailSuc').css('display','none');

			 $('#modalDivEmailSuc').css('display','none');		 

//			 $('#headingDivEmailSuc').html('');

	  }else{

	  $('#mainDivEmailSuc').css('display','block');

		 $('#grayOut').css('display','block');

		 $('#modalContentDivEmailSuc').css('display','block');

		 $('#modalDivEmailSuc').css('display','block');		 

//		 $('#headingDivEmailSuc').html('');
                 googleAdwords();

	  }
          sucX=0;

	  sucY=0;

		

  }

 function echeck(str) {



 	var at="@";

 	var dot=".";

 	var lat=str.indexOf(at);

 	var lstr=str.length;

 	var ldot=str.indexOf(dot);

 	var errorText="Invalid E-mail, please provide your E-mail Address.";

 	if (str.indexOf(at)==-1){

 	   alert(errorText);

 	   return false;

 	}



 	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){

 	   alert(errorText);

 	   return false;

 	}



 	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){

 	    alert(errorText);

 	    return false;

 	}



 	 if (str.indexOf(at,(lat+1))!=-1){

 	    alert(errorText);

 	    return false;

 	 }



 	 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){

 	    alert(errorText);

 	    return false;

 	 }



 	 if (str.indexOf(dot,(lat+2))==-1){

 	    alert(errorText);

 	    return false;

 	 }

 	

 	 if (str.indexOf(" ")!=-1){

 	    alert(errorText);

 	    return false;

 	 }



 		 return true;					

 }

function closeContactPopup(action){

	//resumeAnimation();
        if(document.getElementById('mainDivEmailSuc').style.display=='block'){
		
	}else{
	resumeAnimation();
	}
	if(action=='close'){
		resumeAnimation();
	}


	//showCopyMailIdPoup('close');

	 //$('#modalContentDivEmail').css('display','none');

		 $('#grayOut').css('display','none');

		 $('#modalDivCont').css('display','none');

		 $('#modalContentDivCont').css('display','none');

		 $('#modalContentDivCont').html('');

//		 $('#headingDivCont').html('');

		 $('#mainDivCont').css('display','none');

		 $('#loaderFootCont').css('display','none');

	

	

}

/*
function showContactPopup(headingtext){

	try 

	{

	 $('#mainDivCont').css('display','block');

	 $('#grayOut').css('display','block');

	 $('#modalContentDivCont').css('display','block');

	 $('#modalDivCont').css('display','block');

	 $('#loaderFootCont').css('display','block');

	 //$('#headingDivCont').html(headingtext);
var dId='2';


		

	$.post("http://www.mykeralahotels.in/views/contact.php",

			  { dId: dId},

			  function(data){

	 

		 $('#loaderFootCont').css('display','none');

		 $('#modalContentDivCont').html(data);

			   

			  }

			);

	}

	catch (err) 

	{

		alert("Error Occured: " + err.message);

	}

}
*/

 var currentPopupID=null;
 function closeDialogFromInnerFrame()
{
 
tb_remove();
showContactPopup('2');
if(currentPopupID!=null)
	{
	
	}else{
		
	}
}
var pageiid=null;

function showContactPopup(option){

	try {

		$('#mainDivCont').css('display', 'block');

		$('#grayOut').css('display', 'block');

		$('#modalContentDivCont').css('display', 'block');

		

		//$('#headingDivCont').html(headingtext);





var totalH = $(window).height();

		var totalW = $(window).width();

		

		var modX;

		var modY;

		

		if (totalH > $("#modalDivCont").height()) {

			modX = (totalH - $("#modalDivCont").height()) / 2;



		} else {

			modX = 0;



			$("#modalContentDivCont").css("height", totalH);

		}

		if (totalW > $("#modalDivCont").width()) {

			modY = (totalW - $("#modalDivCont").width()) / 2;

		} else {

			modY = 0;

			$("#modalContentDivCont").css("height", totalW);

		}



		$("#modalDivCont").css( {

			"top" : modX,

			"left" : modY

		});

		

		var realH=modX+($("#modalDivCont").height()-$('#loaderFoot').height())/2;

		var realW=modY+($("#modalDivCont").width()-$('#loaderFootCont').width())/2;

		var isIE5Min = getIEVersionNumber();

		

		if(isIE5Min==7){

			realH=20;

			realW=realW-80;

		}

		if (((screen.width>1024) && (screen.height>768)) && (isIE5Min==7))

		{

			//realH=10;

		}

		$('#loaderFootCont').css('display', 'block');

		//$('#loaderFootCont').css({'top':modX+($("#modalDivCont").height()-$('#loaderFoot').height())/2,'left':modY+($("#modalDivCont").width()-$('#loaderFootCont').width())/2});

		$('#loaderFootCont').css({'top':realH,'left':realW});







		var dId='2';


		

	$.post("http://www.mykeralahotels.in/views/contact.php",

			  { dId: dId},

			  function(data){

			$('#modalDivCont').css('display', 'block');	

			$('#loaderFootCont').css('display', 'none');

			$('#modalContentDivCont').html(data);

			var totalH = $(window).height();

			var totalW = $(window).width();

			var modX;

			var modY;

			if (totalH > $("#modalDivCont").height()) {

				modX = (totalH - $("#modalDivCont").height()) / 2;



			} else {

				modX = 0;



				$("#modalContentDivCont").css("height", totalH);

			}

			if (totalW > $("#modalDivCont").width()) {

				modY = (totalW - $("#modalDivCont").width()) / 2;

			} else {

				modY = 0;

			}



			$("#modalDivCont").css( {

				"top" : modX,

				"left" : modY

			});
                        sucX=modX;

                        sucY=modY;

			document.getElementById('modalDivEmailSuc').style.top=sucX+'px';

			document.getElementById('modalDivEmailSuc').style.left=sucY+'px';

                        if(option=='2'){
				document.getElementById("Category").options[2].selected=true;
				getuserDetails();
			}else{
				document.getElementById("Category").options[0].selected=true;
			}



		});



	} catch (err) {

		alert("Error Occured: " + err.message);

	}

}

function getSiteMapContent(headingtext, targeturl,action) {

	try {

	if (action == 'close') {

		resumeAnimation();

		$('#mainDivSitemap').css('display', 'none');

		$('#grayOut').css('display', 'none');

		$('#modalContentDivSitemap').css('display', 'none');	

		

		$('#mainDivSitemap').css('display', 'none');

		$('#modalContentDivSitemap').html('');

		$('#loaderFootSitemap').css('display', 'none');

		

		

	}else{
		$('#mainDivSitemap').css('display', 'block');

		$('#grayOut').css('display', 'block');

		$('#modalContentDivSitemap').css('display', 'block');		

		var totalH = $(window).height();

		var totalW = $(window).width();

		

		var modX;

		var modY;

		

		if (totalH > $("#modalDivSitemap").height()) {

			modX = (totalH - $("#modalDivSitemap").height()) / 2;



		} else {

			modX = 0;			

			var het=totalH-100;

			$("#modalContentDivSitemap").css("height", het);

		}

		if (totalW > $("#modalDivSitemap").width()) {

			modY = (totalW - $("#modalDivSitemap").width()) / 2;

		} else {

			modY = 0;

			$("#modalContentDivSitemap").css("height", totalW);

		}



		$("#modalDivSitemap").css( {

			"top" : modX,

			"left" : modY

		});

		$('#loaderFootSitemap').css('display', 'block');

		$('#loaderFootSitemap').css({'top':modX+($("#modalDivSitemap").height()-$('#loaderFootSitemap').height())/2,'left':modY+($("#modalDivSitemap").width()-$('#loaderFootSitemap').width())/2});

		

		var xmlhttp = null;

		xmlhttp = GetXmlHttpObject();

		var params = "dId=2";



		if (xmlhttp == null) {

			alert("Your Browser does not support Javascript.Enable Javascript.");

			return false;

		}

		var url = targeturl;

		xmlhttp.onreadystatechange = function() {

			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

				$('#loaderFootSitemap').css('display', 'none');	

				$('#mainDivSitemap').css('display', 'block');

				$('#modalDivSitemap').css('display', 'block');			

				$('#modalContentDivSitemap').html(xmlhttp.responseText);

			}

		};



		xmlhttp.open("POST", url, true);

		xmlhttp.setRequestHeader('Content-Type',

				'application/x-www-form-urlencoded');

		xmlhttp.send(params);

	}

	}

	 catch (err) {

			alert("Error Occured: " + err.message);

		}
}

function getPageNewStreams() {

         if(document.getElementById("mykeralaSpan").className == 'mkh_sh_btns mkh_sel'){		 

		 return false;

	 }


	showLoader('block'); 
	document.getElementById("divPost").style.display = 'block';
	document.getElementById("facebookComments").innerHTML = '';
	selectTab('mykeralaSpan');
	
	try {
		FB
				.api('/MyKerala/feed?access_token='+getFBOauth()+'&limit='
						+ feedCount, // for getting MyKerala + Others, Limit
						// works
						// FB.api('/MyKerala/posts', { limit: 3 }, // for
						// getting only MyKerala limit is not working here
						function(response) {
							if (!response || response.error) {
							//	getPageNewStreams();
							newStreams();
							} else {
								(response.data) ? feedResponse = response.data
										: feedResponse = "";
									
								if (feedResponse != "") {
									comments = feedResponse;

									var commentsElement = "<div style='clear:both;'>";
									for ( var i = 0; i < comments.length; i++) {

										commentsElement += prepareElementNew(comments[i],i);

									}
									commentsElement += "</div>";
									if (document
											.getElementById('facebookComments'))
										document
												.getElementById('facebookComments').innerHTML = commentsElement;
									

								}								
								showLoader('none');
								myKeralaImage();
						 		getTotalAlbumsCount(); 		
						 		albumDetails(); 
						 		
								

							}

						});
	} catch (err) {
		alert("Error Occured: " + err.message);
	}
}
function showLoader(loaddis){
	document.getElementById("loaderDiv").style.display=loaddis;
	//document.getElementById("grayOut").style.display=loaddis;
}

function prepareElementNew(commentData,m) {
	try {

		(commentData.name) ? cTitle = commentData.name : cTitle = '';
		(commentData.link) ? cTitleLink = commentData.link : cTitleLink = '';

		(commentData.picture) ? cPic = commentData.picture : cPic = '';
		//(commentData.likes) ? cLikes = commentData.likes : cLikes = '';
                (commentData.likes) ? cLikes = commentData.likes.count : cLikes = '';
		(commentData.message) ? cMessage = commentData.message : cMessage = '';
		(commentData.from) ? cFrom = commentData.from : cFrom = '';
		(cFrom) ? cId = cFrom.id : cId = '';
		(cFrom) ? cName = cFrom.name : cName = '';

		(commentData.type) ? cType = commentData.type : cType = '';
		
		if (cType == 'video' || cType == 'photo' || cType == 'link') {
			(commentData.caption) ? capText = commentData.caption
					: capText = '';
			(commentData.name) ? comName = commentData.name : comName = '';
			/*(commentData.description) ? comDesc = commentData.description
					: comDesc = '';*/
			//new change from facebook
			(commentData.message) ? comDesc = commentData.message
					: comDesc = '';
			(commentData.picture) ? comPic = commentData.picture : comPic = '';
			(commentData.link) ? comLink = commentData.link : comLink = '';

		}

		(commentData.comments) ? cCommentsCount = commentData.comments
				: cCommentsCount = '';
		(cCommentsCount) ? totalComments = cCommentsCount.count
				: totalComments = '';
		if (cCommentsCount) {
			(cCommentsCount.data) ? comMes = cCommentsCount.data : comMes = '';

			if (totalComments > 0) {
				for ( var j = 0; j < comMes.length; j++) {

					(comMes[j].message) ? commentMess = comMes[j].message
							: commentMess = '';
					(comMes[j].from.name) ? commentedUserName = comMes[j].from.name
							: commentedUserName = '';

					(comMes[j].from.id) ? commentedPId = comMes[j].from.id
							: commentedPId = '';

				}
			}

		}
		
		
		var profileURL = "http://www.facebook.com/profile.php?id=" + cId;
		if (cType == 'video' || cType == 'photo' || cType == 'link') {
			var elementData = '';
			if (cType == 'photo') {
				elementData += '<div id="image"><div style="overflow:hidden; padding-left:10px;"><div style="clear:both;"><div style="width:68px; float:left;"><a href="'
						+ profileURL
						+ '" target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
						+ cId
						+ '/picture"></a></div><div><div style="float:right; width:466px;"><div style="width:448px;"><span ><a href="'
						+ profileURL
						+ '" target="_blank" class="trv_txt_4" style="border:0px;">'
						+ cName
						+ ' </a></span><span class="gry_txt_sm">'
						+ unescape(cMessage.substring(0, limitTextCount));
				if (cMessage.length > limitTextCount) {
					elementData += '<span id="disp_less_'
							+ m
							+ '"  style="display:inline;">...</span><span id="less_'
							+ m
							+ '"  style="display:none;">'
							+ unescape(cMessage.substring(limitTextCount,
									cMessage.length))
							+ '</span><span  id="'
							+ m
							+ '" onclick=\'more(\"'
							+ m
							+ '\")\' style="display:block;cursor:pointer;width:48px;" class="trv_txt_3">See More</span></span>';
				} else {
					elementData += '</span>';
				}
				if (comPic && cType == 'photo') {
					elementData += '<div><a target="_blank" href="' + comLink
							+ '" target="_blank"><img border="0" src="'
							+ comPic + '" class="up_pic"></a>';
					if(cLikes && totalComments){
						elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
						elementData += ' <span class="trv_txt_3">Comments:' + totalComments + '</span>';
					}else{
							if (cLikes) {
								elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
							}
							if (totalComments) {
								elementData += '<br /><span class="trv_txt_3">Comments:' + totalComments + '</span>';
							}
					}
					elementData += '</div></div>';

				}
				elementData += '</div></div></div></div></div> <div style="padding:10px;"><div  style="border-bottom:1px solid #cccccc;"></div></div></div>';
			} else if (cType == 'link') {

				if (comLink
						&& comLink != 'http://www.mykeralahotels.in/socialize/') {
					if (cMessage) {
						elementData += '<div id="Link"><div style="overflow:hidden; padding-left:10px;"><div style="width:68px; float:left;"><a href="'
								+ profileURL
								+ '" target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
								+ cId
								+ '/picture"></a></div><div style="float:right; width:466px;"><div style="width:448px;"><span><a class="trv_txt_4" style="border:0px;" href="'
								+ profileURL
								+ '" target="_blank">'
								+ cName
								+ ' </a></span><span class="gry_txt_sm">'
								+ unescape(cMessage
										.substring(0, limitTextCount));
						if (cMessage.length > limitTextCount) {
							elementData += '<span id="disp_less_'
									+ m
									+ '"  style="display:inline;">...</span><span id="less_'
									+ m
									+ '"  style="display:none;">'
									+ unescape(cMessage.substring(
											limitTextCount, cMessage.length))
									+ '</span><span id="'
									+ m
									+ '" onclick=\'more(\"'
									+ m
									+ '\")\' style="display:block;cursor:pointer;width:48px;" class="trv_txt_3">See More</span></span>';
						} else {
							elementData += '</span>';
						}
						elementData += '<div><div style="float:left;">';
						if(comPic){
          	elementData +=  '<a class="trv_txt_4" style="border:0px;" href="'
								+ comLink
								+ '" target="_blank"><img border="0" src="'
								+ comPic + '" class="up_pic"></a>';
            }

					} else {
						elementData += '<div id="Link"><div style="overflow:hidden; padding-left:10px;"><div style="width:68px; float:left;"><a href="'
								+ profileURL
								+ '"  target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
								+ cId
								+ '/picture"></a></div><div style="float:right; width:466px;"><span ><a class="trv_txt_4" style="border:0px;" href="'
								+ profileURL
								+ '" target="_blank">'
								+ cName
								+ ' </a></span><div><div style="float:left;"><a class="trv_txt_4" style="border:0px;" href="'
								+ comLink
								+ '" target="_blank"><img border="0" src="'
								+ comPic + '" class="up_pic"></a>';

					}
					if (cLikes) {
						elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
					}
					if (totalComments) {
						elementData += ' <span class="trv_txt_3">Comments:' + totalComments + '</span>';
					}
					elementData += '</div></div><div style="word-wrap: break-word; float:left; padding-left:4px;" class="gry_txt_sm"><a target="_blank" href="'
							+ comLink
							+ '" class="blu_txt">'
							+ comLink.substring(0, 35)
							+ '..</a></div></div></div></div><div style="padding:10px;"><div  style="border-bottom:1px solid #cccccc;"></div></div></div>';

				} else {// for type status
					elementData = '<div id="stream"><div style="overflow:hidden; padding-left:10px;"><div style="clear:both;"><div style="width:68px; float:left;"><a href="'
							+ profileURL
							+ '"  target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
							+ cId + '/picture"></a></div><div>';
					elementData += '<div style="float:right; width:466px;"><div style="width:448px;"><span><a class="trv_txt_4" href="'
							+ profileURL
							+ '" style="border:0px;">'
							+ cName
							+ ' </a></span><span class="gry_txt_sm">'
							+ unescape(cMessage.substring(0, limitTextCount));
					if (cMessage.length > limitTextCount) {
						elementData += '<span id="disp_less_'
								+ m
								+ '"  style="display:inline;">...</span><span id="less_'
								+ m
								+ '"  style="display:none;">'
								+ unescape(cMessage.substring(limitTextCount,
										cMessage.length))
								+ '</span><span id="'
								+ m
								+ '" onclick=\'more(\"'
								+ m
								+ '\")\' style="display:block;cursor:pointer;width:48px;" class="trv_txt_3">See More</span></span>';
					} else {
						elementData += '</span>';
					}
					if(cLikes && totalComments){
						elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
						elementData += ' <span class="trv_txt_3">Comments:' + totalComments + '</span>';
					}else{
							if (cLikes) {
								elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
							}
							if (totalComments) {
								elementData += '<br /><span class="trv_txt_3">Comments:' + totalComments + '</span>';
							}
					}
					elementData += '</div></div></div></div></div><div style="padding:10px;"><div  style="border-bottom:1px solid #cccccc;"></div></div></div></div>';
				}
			} else if (cType == 'video') {	
      elementData +='<div id="video"><div style="overflow:hidden; padding-left:10px;"><div style="clear:both;"><div style="width:68px; float:left;"><a href="'
					+ profileURL
					+ '"  target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
					+ cId+ '/picture"></a></div><div style="width:466px; overflow:hidden;"><div><span class="trv_txt_4"><a class="trv_txt_4" style="border:0px;" href="'
					+ profileURL+ '" target="_blank">'+ cName+ ' </a></span><span class="gry_txt_sm">'
					+ unescape(comDesc
							.substring(0, limitTextCount));
			if (comDesc.length > limitTextCount) {
				elementData += '<span id="disp_less_'
						+ m
						+ '"  style="display:inline;">...</span><span id="less_'
						+ m
						+ '"  style="display:none;">'
						+ unescape(comDesc.substring(
								limitTextCount, comDesc.length))
						+ '</span><span id="'
						+ m
						+ '" onclick=\'more(\"'
						+ m
						+ '\")\' style="display:block;cursor:pointer;width:48px;" class="trv_txt_3">See More</span></span>';
			} else {
				elementData += '</span>';
			}
			elementData+='</div>';
			elementData+=' <div><div style="float:left;">';
		                        	elementData+='<a target="_blank" href="'
			+ comLink
			+ '" target="_blank"><img  src="'
			+ appPageURL
			+ 'images/i_play.gif" style="background-color: transparent; margin-top:0px; background-image: url('
			+ comPic
			+ '); background-repeat: no-repeat; width:130px; height:106px;  background-attachment: scroll; background-position: center center; -moz-background-size: auto auto; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; outline: medium none; border: 1px none;"/></a><br />';
		         if(cLikes && totalComments){
				elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
				elementData += ' <span class="trv_txt_3">Comments:' + totalComments + '</span>';
			}else{
					if (cLikes) {
						elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
					}
					if (totalComments) {
						elementData += '<br /><span class="trv_txt_3">Comments:' + totalComments + '</span>';
					}
			}               	
		     elementData+=' </div>';  
		     elementData+='<div style="width:300px; float:left; padding-left:4px;"><a target="_blank" href="'
				+ comLink
				+ '" class="blu_txt">'
				+ comName
				+ '</a></div>';
		     elementData+='</div> </div></div><div style="padding:10px;"><div  style="border-bottom:1px solid #cccccc;"></div></div></div>';}
			return elementData;
		} else {
			var elementData = '';
			elementData = '<div id="stream"><div style="overflow:hidden; padding-left:10px;"><div style="clear:both;"><div style="width:68px; float:left;"><a href="'
					+ profileURL
					+ '"  target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
					+ cId + '/picture"></a></div><div>';
			elementData += '<div style="float:right; width:466px;"><div style="width:448px;"><span><a class="trv_txt_4" href="'
					+ profileURL
					+ '" style="border:0px;">'
					+ cName
					+ ' </a></span><span class="gry_txt_sm">'
					+ unescape(cMessage.substring(0, limitTextCount));
			if (cMessage.length > limitTextCount) {
				elementData += '<span id="disp_less_'
						+ m
						+ '"  style="display:inline;">...</span><span id="less_'
						+ m
						+ '"  style="display:none;">'
						+ unescape(cMessage.substring(limitTextCount,
								cMessage.length))
						+ '</span><span id="'
						+ m
						+ '" onclick=\'more(\"'
						+ m
						+ '\")\' style="display:block;cursor:pointer;width:48px;" class="trv_txt_3">See More</span></span>';
			} else {
				elementData += '</span>';
			}
			if(cLikes && totalComments){
				elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
				elementData += ' <span class="trv_txt_3">Comments:' + totalComments + '</span>';
			}else{
					if (cLikes) {
						elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
					}
					if (totalComments) {
						elementData += '<br /><span class="trv_txt_3">Comments:' + totalComments + '</span>';
					}
			}
			elementData += '</div></div></div></div></div><div style="padding:10px;"><div  style="border-bottom:1px solid #cccccc;"></div></div></div></div>';
			return elementData;
		}

	} catch (err) {

	}
}
/**
 * @desc displays more/less link when the text is more than 297 characters.
 *           
 * @return 
 */
function more(spanid, cont) {
	if ($("#disp_less_" + spanid + "").css('display') == "inline") {
		$("#disp_less_" + spanid + "").css('display', 'none');
		$("#less_" + spanid + "").css('display', 'inline');
	} else if ($("#disp_less_" + spanid + "").css('display') == "none") {
		$("#disp_less_" + spanid + "").css('display', 'inline');
		$("#less_" + spanid + "").css('display', 'none');
	}

	if ($("#" + spanid + "").html() == "See More") {
	              $("#" + spanid + "").css("width","25px");
		$("#" + spanid + "").html("Less");
	} else if ($("#" + spanid + "").html() == "Less") {
	$("#" + spanid + "").css("width","48px");
		$("#" + spanid + "").html("See More");
	}

}

/**
 * @desc returns the mykerala profile image.
 *           
 * @return 
 */

function myKeralaImage() {
	document.getElementById('keralaPic').innerHTML='<img src="'+appPageURL+'/images/Loading_small.gif"/>';
	
	try {
		FB
				.api(
						{
							method : 'fql.query',
							query : 'SELECT pic_large,page_id  FROM page WHERE page_id="' + pageId + '"',
							access_token : getFBOauth()
						},
						function(response) {

							document.getElementById('keralaPic').innerHTML = '<a href="'
									+ albumProfile
									+ '?profile=1&id='
									+ response[0].page_id
									+ '" target="_blank" style="border:0px;"><img src="'
									+ response[0].pic_large
									+ '"  width="200"  border="0"/></a>';
							;
						});
	} catch (err) {
		alert("Error Occured: " + err.message);
	}
	
}
/**
 * @desc returns total album count
 *            
 * @return 
 */

function getTotalAlbumsCount() {
	try {
		FB
				.api(
						{
							method : 'fql.query',
							query : 'SELECT aid  FROM album WHERE owner="' + pageId + '" and (type="mobile" OR type="profile" OR type="wall" OR type="normal")',
							access_token : getFBOauth()
						},
						function(response) {

							document.getElementById('totalAlbumsSpan').innerHTML = '<a class="trv_txt_3" href="http://www.facebook.com/MyKerala?v=photos" target="_blank" style="border:0px;">' + response.length + ' albums</a>';
							;
						});
	} catch (err) {
		alert("Error Occured: " + err.message);
	}
	
}
/**
 * @desc returns album details including date,album cover_id,albums id,etc..
 *            
 * @return 
 */
function albumDetails() {
	document.getElementById('photos').innerHTML='<img src="'+appPageURL+'/images/Loading_small.gif"/>';
	try {
		FB
				.api(
						{
							method : 'fql.multiquery',
							queries : '{"query1":"SELECT aid,cover_pid,aid,name,created  FROM album WHERE owner=' + pageId + ' order by created desc limit 2","query2":"SELECT pid,src_small,src,aid  FROM photo WHERE pid IN (SELECT cover_pid FROM #query1)"}',
							access_token : getFBOauth()
						},
						function(response) {

							var html = '';

							var resData = (response[0]['fql_result_set']);
							var resDataImage = (response[1]['fql_result_set']);

							for ( var n = 0; n < resData.length; n++) {

								var dt = new Date(resData[n].created * 1000);
								var time = dt.toString();
								var sTime = (time.split(" ", 3));
								sTime = ((sTime.toString()).replace(",", " "));
								sTime = ((sTime.toString()).replace(",", " "));
								var aid = new Array();
								aid = resData[n].aid.split("_");
								html += '<div id="loop'
										+ n
										+ '" style="clear:both;"><div style="float:left;" id="'
										+ n
										+ 'photo"></div>  <div style="float:right; width:109px;"><span><span><a class="trv_txt_4" href="'
										+ albumProfile
										+ '?aid='
										+ aid[1]
										+ '&id='
										+ aid[0]
										+ '" target="_blank" style=" border:0px;word-wrap:break-word;">'
										+ resData[n].name
										+ '</a></span><br/><span class="trv_txt_5">Created on '
										+ sTime + '</span></span> </div></div>';

							}
							document.getElementById('photos').style.display='none';
							document.getElementById("photosCount").style.display='block';
							document.getElementById("photos").innerHTML = html;

							for ( var i = 0; i < resDataImage.length; i++) {
								var aid = new Array();
								aid = resDataImage[i].aid.split("_");
								document.getElementById(i + 'photo').innerHTML = '<span><a href="'
										+ albumProfile
										+ '?aid='
										+ aid[1]
										+ '&id='
										+ aid[0]
										+ '" target="_blank" style=" border:0px;"><img src="'
										+ resDataImage[i].src
										+ '"   border="0" style="width:75px;padding:4px; " /></a></span>';
							}
							document.getElementById('photos').style.display='block';
						});
	} catch (err) {
		alert("Error Occured: " + err.message);
	}

}

/**
 * @desc returns mykerala notes details
 *            
 * @return 
 */
function notes() {

        if(document.getElementById("notesSpan").className == 'mkh_sh_btns notes_sel'){

		return false;

	}


	selectTab('notesSpan');
	showLoader('block');
	document.getElementById("divPost").style.display='none';
	document.getElementById("facebookComments").innerHTML = '';
	try {

		$.get(appPageURL + 'views/notes.php', {

			access_token : getFBOauth()
		}, function(response) {
				if(response=='error'){
					alert("May be Your Session has been expired");
					//return false;
				}else{
					document.getElementById("facebookComments").innerHTML = response;
				}
				showLoader('none');
				var totalNotes=0;
				$(".psudo_notes_loop").each(function(index){
					totalNotes=index+1;
					
					
					$(this).find("a img").each(function(imgIndex){
						
						$(this).parent().remove();
						
						
					});
					$(this).find("img").each(function(imgIndex){
						$(this).remove();
						
					});
					
					$('h1,h2,h3,h4,h5,h6').each(function(){
						$(this).replaceWith("<strong>"+$(this).html()+"</strong>");
						
						
					});
					
					$(this).find("div.trv_txt_2").html($(this).find("div.trv_txt_2").html().substring(0,455)+"...");
					$(this).css("display","block");
				});
				
			});

	} catch (err) {
		alert("Error Occured: " + err.message);
	}

}

/**
 * @desc applies the css class for the selected tab.
 * @return 
 */
function selectTab(selectid) {
	if (selectid == 'mykeralaSpan') {
		document.getElementById("mykeralaSpan").className = 'mkh_sh_btns mkh_sel';
		document.getElementById("eventsSpan").className = 'mkh_sh_btns events';
		if(getFBOauth()!=''){
		document.getElementById("notesSpan").className = 'mkh_sh_btns notes';
		document.getElementById("notesSpan").onclick=notes;
		}else{
			document.getElementById("notesSpan").className = 'mkh_sh_btns notes_dul';
			document.getElementById("notesSpan").onclick='';
		}

	} else if (selectid == 'eventsSpan') {
		document.getElementById("mykeralaSpan").className = 'mkh_sh_btns mkh';
		document.getElementById("eventsSpan").className = 'mkh_sh_btns events_sel';
		if(getFBOauth()!=''){
			document.getElementById("notesSpan").className = 'mkh_sh_btns notes';
			document.getElementById("notesSpan").onclick=notes;
			}else{
				
				document.getElementById("notesSpan").className = 'mkh_sh_btns notes_dul';
				document.getElementById("notesSpan").onclick='';
			}
	} else if (selectid == 'notesSpan') {
		document.getElementById("mykeralaSpan").className = 'mkh_sh_btns mkh';
		document.getElementById("eventsSpan").className = 'mkh_sh_btns events';
		document.getElementById("notesSpan").className = 'mkh_sh_btns notes_sel';
	}

}
/**
 * @desc prepares events view.
 * @return 
 */
function events() {


        if(document.getElementById("eventsSpan").className == 'mkh_sh_btns events_sel'){

		return false;

	}
	selectTab('eventsSpan');
	showLoader('block');
	document.getElementById("divPost").style.display = 'none';	
	document.getElementById("facebookComments").innerHTML='';
	try {

		$.get(appPageURL + 'views/events.php', {

			uid : pageId
		}, function(response) {
			if(response=='error'){
				alert('May be Your session has expired');
			}else{
			document.getElementById("facebookComments").innerHTML = response;
			
			}
			showLoader('none');	
			});

	} catch (err) {
		alert("Error Occured: " + err.message);
	}
}







/**
 * @desc validate the user posted comment and post the feed to 
 * 		 MyKerala facebook fan page 
 * @return status of the submit feed
 */
function postFeed() 
{
	
	try 
	{
		var num	=	validateText();
		if(num==0)
		{
			return false;
		}
		
		xmlhttp	=	null;	
		xmlhttp=GetXmlHttpObject();	
		var params = "access_token="+getFBOauth()+"&message="+escape(num.substring(0, 1000));
		
		if(xmlhttp == null){
			alert("Your Browser does not support Javascript.Enable Javascript.");
			return false;
		}
		var url = appPageURL+'views/fbStreamPost.php';		
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status == 200){
			
				postFeedResponce(JSON.parse(xmlhttp.responseText));
					
			}
		};	
		
		xmlhttp.open("POST",url,true);
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlhttp.send(params);	
	} 
	catch (err) 
	{
		alert("Error Occured: " + err.message);
	}
}
/**
 * @desc validate response back from the Facebook after feed posting with postFeed()
 * 		 
 */
function postFeedResponce(response) 
{
	if (!response || response.error) 
	{
	
	   if(response.error.type=="OAuthException")
	   {
	   alert("It seems your Facebook Session expired , please login again using Facebook.");
     }
     else{
		alert("First Become the fan of the My Kerala Page");
		}
		return;
	} 
	else 
	{
		
		unClearText('txtComments',"");
                document.getElementById("mykeralaSpan").className = 'mkh_sh_btns mkh';
                getPageNewStreams();
		
	}
}
function refreshFans()
{
	var fansData	='<fb:like-box profile_id="'+pageId+'" width="422" header="false" stream="false" connections="25"  height="420"></fb:like-box>';
	if(document.getElementById('likeboxdiv'))
		document.getElementById('likeboxdiv').innerHTML	= fansData;
}

/**
 * @desc validate the comments text box. 
 * @return 0 or comments text on success 
 */
function validateText()
{
	if (document.getElementById('txtComments'))
		var comments = trim(document.getElementById('txtComments').value);
	else
		var comments = '';
	if (!comments) 
	{
		alert("Enter text to post to My Kerala Page");
		document.getElementById('txtComments').value = "";
		return 0;
	}
	else if (comments == defaultText) 
	{
		alert("Enter text to post to My Kerala Page.");
		return 0;
	}
	else if (comments.length > 1000) 
	{
		alert("Sorry, wall posts cannot be longer than 1,000 characters.");
		return 0;
	}
	return comments;
}
// Removes leading whitespaces
function LTrim(value) 
{
	var re = /\s*((\S+\s*)*)/;
	return value.replace(re, "$1");
}

// Removes ending whitespaces
function RTrim(value) 
{
	var re = /((\s*\S+)*)\s*/;
	return value.replace(re, "$1");
}

// Removes leading and ending whitespaces
function trim(value) 
{
	return LTrim(RTrim(value));
}

/**
 * @desc clear the text of the text area when user focus on the textarea.
 * @param id id of the element 
 * @param value "value" of the textarea
 */
function clearText(id,value)
{
	if(	trim(value) == trim(defaultText))
	{
		document.getElementById(id).value="";
		document.getElementById(id).className='in_txt';
	}
}

/**
 * @desc unclear the text of the text area blur event of the textarea
 * @param id id of the element 
 * @param value "value" of the textarea
 */
function unClearText(id,value)
{
	if (trim(value) == "") {
		document.getElementById(id).value = defaultText;
		document.getElementById(id).className = 'wrt_txt_new';
	}
}

/**
 * @desc This can be used to shorten the url to post the feed to facebook and twitter.
 * 		  Here We are using the bit.ly api to shorten the url. When any one click this url eigther from  facebook or
 * 		  twitter that will redirect the user to mykerla web site
 * 
 */
function prepareShare()
{
		BitlyCB.alertResponse = function(data) {
	            var s = '';
	            var first_result;
	            // Results are keyed by longUrl, so we need to grab the first one.
	            for     (var r in data.results) {
	                    first_result = data.results[r]; break;
	            }
	            twitURL = first_result["shortUrl"].toString();	 
	            var shareData	=	'<div style="float: left; width: 20px;"><a class="mykr_img fb_icon" title="Share this post in Facebook"';
	            shareData		+=	' alt="Share this post in Facebook" target="_blank"';
	            shareData		+=	'href="http://www.facebook.com/share.php?u='+encodeURIComponent(twitURL)+'&t='+shareText+'"></a></div>';
	        	shareData		+=	'<div style="padding-left: 25px;"><a class="mykr_img twit_icon" title="Share this post in Twitter" ';
	        	shareData		+=	' target="_blank" href="http://twitter.com/home?status='+shareText+'%20-%20'+twitURL+'"></a></div>';
	        	if(document.getElementById('shareIcons'))
	        		document.getElementById('shareIcons').innerHTML	=shareData;
	            
	    };
		BitlyClient.call('shorten', {'longUrl': applicationUrl}, 'BitlyCB.alertResponse');	  	
	
}

function GetXmlHttpObject()
{
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject){
		// code for IE6, IE5
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}
function loadBackGround()
{
	xmlhttp	=	null;	
	xmlhttp=GetXmlHttpObject();	
	var params = "action=homeimg";
	if(xmlhttp == null){
		alert("Your Browser does not support Javascript.Enable Javascript.");
		return false;
	}
	var url = appPageURL+"admin/app/controllers/my_imagesController.php?exclude="+escape($(".imgCyclePseudoClass").attr("src"));		
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status == 200){
			if(document.getElementById("slideshowImages"))
			{
				var currentImage=$("#slideshowImages").html();
				$("#slideshowImages").html(currentImage+xmlhttp.responseText);
				animateElement();
			}
				
		}
	};		
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xmlhttp.send(params);	
}
function animateElement()
{
	$('.slideshow').cycle({
		fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		prev:   '#navRight', 
	  next:   '#navLeft',
	  after: updateContent
	});		
	$('#ad_slider').css({"visibility":"visible"});		
}

function resumeAnimation(){
	$('.slideshow').cycle('resume');
}
function stopAnimation(){
	$('.slideshow').cycle('pause');
}

function updateContent(curr,next,opts)
{
	//alert('Image ' + (opts.currSlide + 1) + ' of ' + opts.slideCount);
	//alert($(opts.currSlide));
	currentBackGroundImg=(opts.currSlide + 1);
	var content=unescape($("#img_desc_"+currentBackGroundImg).val());
	
	//console.log($(".info_box").css("display"));
	if(content.length>2)
	{
	$("#infodiv_content_div").html(content);
	}
	else{
		if($(".info_box").css("display")!="none")
		{
			$(".info_box").toggle("slow");
		}
	}
	
}
/*
 * @Desc takes Wordpress cookie hash parameter iterates through site cookies looks 
 *  whether user logged in using Facebook or not.
 *  Changes the post button accordingly.
*/
function checkFBLogin(cookieHash)
{
	if($.cookie('wordpress_logged_in_provider_'+cookieHash)=="Facebook")
	{
		$("#txtComment").css({'display':'block'});
		$("#txtCommentDisabled").css({'display':'none'});
	}
	else{
		$("#txtComment").css({'display':'none'});
		$("#txtCommentDisabled").css({'display':'block'});
    	
	}
}
/*
 * @Desc If user logged in using Facebook retrives the Access token stored in cookie.
 * @return Facebook Accesstoken :string.  
*/
function getFBOauth()
{
	var cookieChunkLength=parseInt($.cookie('oauth_length'));	
	var fbOAuthtoken='';
	for(i=0;i<cookieChunkLength;i++)
	{
		
		var oAuthText=$.cookie('oauth_'+i);		
		fbOAuthtoken=fbOAuthtoken+oAuthText;
	}	
	return fbOAuthtoken;
}

function newStreams(){
	try {
		FB.api(
						{
							method : 'fql.multiquery',

							queries : '{"query1":"SELECT viewer_id,attribution,post_id,actor_id, message,attachment,app_data,action_links,permalink,comments,likes FROM stream WHERE source_id =164833580058 limit 10","query2":"SELECT id,name FROM profile WHERE id  IN (SELECT actor_id FROM #query1)"}',
							access_token : getFBOauth()
						},
						function(response) {
							
									if (!response || response.error) {
									getPageNewStreams();
									} else {
										feedResponse= (response[0]['fql_result_set']);
										var nameArray=response[1]['fql_result_set'];
										 

										if (feedResponse != "") {
											
											comments = feedResponse;
											
											var commentsElement = "<div style='clear:both;'>";
											for ( var i = 0; i < comments.length; i++) {
												for(var j=0;j<nameArray.length;j++)
												 {
													 if(nameArray[j].id==comments[i].actor_id)
													 {
														 nameArray[j].name; 
														 break;
													 }
												 }
												commentsElement += prepareFeedsData(comments[i],i, nameArray[j].name);

											}
											commentsElement += "</div>";
											if (document
													.getElementById('facebookComments'))
												document
														.getElementById('facebookComments').innerHTML = commentsElement;
											

										}								
										showLoader('none');
										myKeralaImage();
								 		getTotalAlbumsCount(); 		
								 		albumDetails(); 
								 		
										

									}

								});
	} catch (err) {
		alert("Error Occured: " + err.message);
	}
}
function prepareFeedsData(commentData,m,actor_name){
	var cLikes="";
	var cType="";
	
	commentData.actor_id?cId=commentData.actor_id:cId='';
	
	(commentData['attachment']) ? attach = commentData['attachment'] : attach = '';
	
	
	if(attach.media){
		if(attach.media[0]){
			attach.media[0].type?cType=attach.media[0].type:cType='';
			if(cType=='photo' || cType=='link'){
				
				if(attach.media[0].href){
					comLink=attach.media[0].href;
				}
				if(attach.media[0].src){
					comPic=attach.media[0].src;
				}
				
				
			}
			
	
		}
		else{
		cType='status';
		
	}
	}else{
		cType='status';
		
	}
	commentData.message?cMessage=commentData.message:cMessage='';
	if(commentData.likes.count){
	(commentData.likes.count) ? cLikes = commentData.likes.count : cLikes = '';
	}
	if(commentData.comments.count){
	(commentData.comments.count) ? totalComments = commentData.comments.count : totalComments = '';
	}
	
	cName=actor_name;
	
	
	var profileURL = "http://www.facebook.com/profile.php?id=" + cId;
	if(cType=='status'){
	
	var elementData = '';
	elementData = '<div id="stream"><div style="overflow:hidden; padding-left:10px;"><div style="clear:both;"><div style="width:68px; float:left;"><a href="'
			+ profileURL
			+ '"  target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
			+ cId + '/picture"></a></div><div>';
	elementData += '<div style="float:right; width:466px;"><span><a class="trv_txt_4" href="'
			+ profileURL
			+ '" style="border:0px;">'
			+ cName
			+ ' </a></span><span class="gry_txt_sm">'
			+ unescape(cMessage.substring(0, limitTextCount));
	if (cMessage.length > limitTextCount) {
		elementData += '<span id="disp_less_'
				+ m
				+ '"  style="display:inline;">...</span><span id="less_'
				+ m
				+ '"  style="display:none;">'
				+ unescape(cMessage.substring(limitTextCount,
						cMessage.length))
				+ '</span><span id="'
				+ m
				+ '" onclick=\'more(\"'
				+ m
				+ '\")\' style="display:block;cursor:pointer;" class="trv_txt_3">See More</span></span>';
	} else {
		elementData += '</span>';
	}
	if((cLikes!=='0' && cLikes!='') && (totalComments!='0' && totalComments!='')){
		elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
		elementData += ' <span class="trv_txt_3">Comments:' + totalComments + '</span>';
	}else{
			if (cLikes!=='0' && cLikes!='') {
				elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
			}
			if (totalComments!=='0' && totalComments!='') {
				elementData += '<br /><span class="trv_txt_3">Comments:' + totalComments + '</span>';
			}
	}
	elementData += '</div></div></div></div><div style="padding:10px;"><div  style="border-bottom:1px solid #cccccc;"></div></div></div></div>';
	return elementData;
	
	}
	var elementData = '';
	if (cType == 'photo') {
		elementData += '<div id="image"><div style="overflow:hidden; padding-left:10px;"><div style="clear:both;"><div style="width:68px; float:left;"><a href="'
				+ profileURL
				+ '" target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
				+ cId
				+ '/picture"></a></div><div><div style="float:right; width:466px;"><span ><a href="'
				+ profileURL
				+ '" target="_blank" class="trv_txt_4" style="border:0px;">'
				+ cName
				+ ' </a></span><span class="gry_txt_sm">'
				+ unescape(cMessage.substring(0, limitTextCount));
		if (cMessage.length > limitTextCount) {
			elementData += '<span id="disp_less_'
					+ m
					+ '"  style="display:inline;">...</span><span id="less_'
					+ m
					+ '"  style="display:none;">'
					+ unescape(cMessage.substring(limitTextCount,
							cMessage.length))
					+ '</span><span  id="'
					+ m
					+ '" onclick=\'more(\"'
					+ m
					+ '\")\' style="display:block;cursor:pointer;" class="trv_txt_3">See More</span></span>';
		} else {
			elementData += '</span>';
		}
		comLink=comLink.replace(/api-read./i, "");
		if (comPic && cType == 'photo') {
			elementData += '<div><a target="_blank" href="' + comLink
					+ '" target="_blank"><img border="0" src="'
					+ comPic + '" class="up_pic"></a>';
			if((cLikes!=='0' && cLikes!='') && (totalComments!='0' && totalComments!='')){
				elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
				elementData += ' <span class="trv_txt_3">Comments:' + totalComments + '</span>';
			}else{
					if (cLikes!=='0' && cLikes!='') {
						elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
					}
					if (totalComments!=='0' && totalComments!='') {
						elementData += '<br /><span class="trv_txt_3">Comments:' + totalComments + '</span>';
					}
			}
			elementData += '</div>';

		}
		elementData += '</div></div></div></div> <div style="padding:10px;"><div  style="border-bottom:1px solid #cccccc;"></div></div></div>';
		return elementData;
	}

	if(cType=='link'){
		var HWString="";
		if(comPic.substring(0,1)=="/")
		{
			HWString=" height="+$.urlParam("h",comPic)+" width="+$.urlParam("w",comPic)+" ";
			comPic=unescape($.urlParam("url",comPic));
			
			
		}
		
		if (comLink
				&& comLink != 'http://www.mykeralahotels.in/socialize/') {
			if (cMessage) {
				elementData += '<div id="Link"><div style="overflow:hidden; padding-left:10px;"><div style="width:68px; float:left;"><a href="'
						+ profileURL
						+ '" target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
						+ cId
						+ '/picture"></a></div><div style="float:right; width:466px;"><span><a class="trv_txt_4" style="border:0px;" href="'
						+ profileURL
						+ '" target="_blank">'
						+ cName
						+ ' </a></span><span class="gry_txt_sm">'
						+ unescape(cMessage
								.substring(0, limitTextCount));
				if (cMessage.length > limitTextCount) {
					elementData += '<span id="disp_less_'
							+ m
							+ '"  style="display:inline;">...</span><span id="less_'
							+ m
							+ '"  style="display:none;">'
							+ unescape(cMessage.substring(
									limitTextCount, cMessage.length))
							+ '</span><span id="'
							+ m
							+ '" onclick=\'more(\"'
							+ m
							+ '\")\' style="display:block;cursor:pointer;" class="trv_txt_3">See More</span></span>';
				} else {
					elementData += '</span>';
				}
				elementData += '<div><div style="float:left;"><a class="trv_txt_4" style="border:0px;" href="'
						+ comLink
						+ '" target="_blank"><img border="0" src="'
						+ comPic + '" class="up_pic" '+HWString+'></a>';

			} else {
				elementData += '<div id="Link"><div style="overflow:hidden; padding-left:10px;"><div style="width:68px; float:left;"><a href="'
						+ profileURL
						+ '"  target="_blank"><img class="us_pic"  border="0" alt="'+cName+'" src="http://graph.facebook.com/'
						+ cId
						+ '/picture"></a></div><div style="float:right; width:466px;"><span ><a class="trv_txt_4" style="border:0px;" href="'
						+ profileURL
						+ '" target="_blank">'
						+ cName
						+ ' </a></span><div><div style="float:left;"><a class="trv_txt_4" style="border:0px;" href="'
						+ comLink
						+ '" target="_blank"><img border="0" src="'
						+ comPic + '" class="up_pic" '+HWString+'></a>';

			}
			
					if (cLikes!=='0' && cLikes!='') {
						elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
					}
					if (totalComments!=='0' && totalComments!='') {
						elementData += '<br /><span class="trv_txt_3">Comments:' + totalComments + '</span>';
					}
			
			elementData += '</div><div style="word-wrap: break-word; float:left; padding-left:4px;" class="gry_txt_sm"><a target="_blank" href="'
					+ comLink
					+ '" class="blu_txt">'
					+ comLink.substring(0, 35)
					+ '..</a></div></div></div></div><div style="padding:10px;"><div  style="border-bottom:1px solid #cccccc;"></div></div></div>';

		} else {// for type status
			elementData = '<div id="stream"><div style="overflow:hidden; padding-left:10px;"><div style="clear:both;"><div style="width:68px; float:left;">';
						if(comPic){
          	elementData +=  '<a class="trv_txt_4" style="border:0px;" href="'
								+ comLink
								+ '" target="_blank"><img border="0" src="'
								+ comPic + '" class="up_pic"></a>';
            }

			elementData += '<div style="float:right; width:466px;"><span><a class="trv_txt_4" href="'
					+ profileURL
					+ '" style="border:0px;">'
					+ cName
					+ ' </a></span><span class="gry_txt_sm">'
					+ unescape(cMessage.substring(0, limitTextCount));
			if (cMessage.length > limitTextCount) {
				elementData += '<span id="disp_less_'
						+ m
						+ '"  style="display:inline;">...</span><span id="less_'
						+ m
						+ '"  style="display:none;">'
						+ unescape(cMessage.substring(limitTextCount,
								cMessage.length))
						+ '</span><span id="'
						+ m
						+ '" onclick=\'more(\"'
						+ m
						+ '\")\' style="display:block;cursor:pointer;" class="trv_txt_3">See More</span></span>';
			} else {
				elementData += '</span>';
			}
			if((cLikes!=='0' && cLikes!='') && (totalComments!='0' && totalComments!='')){
				elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
				elementData += ' <span class="trv_txt_3">Comments:' + totalComments + '</span>';
			}else{
					if (cLikes!=='0' && cLikes!='') {
						elementData += '<br /><span class="trv_txt_3">Likes:' + cLikes + '</span>';
					}
					if (totalComments!=='0' && totalComments!='') {
						elementData += '<br /><span class="trv_txt_3">Comments:' + totalComments + '</span>';
					}
			}
			elementData += '</div></div></div></div><div style="padding:10px;"><div  style="border-bottom:1px solid #cccccc;"></div></div></div></div>';
			
		}
		return elementData;
	}
	
	
}





 function closeFooterLink(){

	 resumeAnimation();

	 $('#grayOut').css('display','none');

	 $('#modalDiv').css('display','none');

	 $('#modalContentDiv').css('display','none');

	 $('#modalContentDiv').html('');

	 $('#headingDiv').html('');

	 $('#mainDiv').css('display','none');

	 $('#loaderFoot').css('display','none');

	

 }





/*
function getFooterContent(headingtext,targeturl){	

	 try 

		{

		 $('#mainDiv').css('display','block');

		 $('#grayOut').css('display','block');

		 $('#modalContentDiv').css('display','block');

		 $('#modalDiv').css('display','block');

		 $('#loaderFoot').css('display','block');

		 $('#headingDiv').html(headingtext);

			var xmlhttp	=	null;	

			xmlhttp=GetXmlHttpObject();	

			var params = "dId=2";

			

			if(xmlhttp == null){

				alert("Your Browser does not support Javascript.Enable Javascript.");

				return false;

			}

			var url = targeturl;		

			xmlhttp.onreadystatechange=function(){

				if (xmlhttp.readyState==4 && xmlhttp.status == 200){

					

					 $('#loaderFoot').css('display','none');

					 $('#modalContentDiv').html(xmlhttp.responseText);

											

				}

			};	

			

			xmlhttp.open("POST",url,true);

			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

			xmlhttp.send(params);	

		} 

		catch (err) 

		{

			alert("Error Occured: " + err.message);

		}

	

 

 }

*/
function getFooterContent(headingtext,targeturl){	

		try {



			$('#mainDiv').css('display', 'block');

			$('#grayOut').css('display', 'block');

			$('#modalContentDiv').css('display', 'block');		

			$('#headingDiv').html(headingtext);

			

			var totalH = $(window).height();

			var totalW = $(window).width();

			

			var modX;

			var modY;

			

			if (totalH > $("#modalDiv").height()) {

				modX = (totalH - $("#modalDiv").height()) / 2;



			} else {

				modX = 0;

				var het=totalH-100;

				$("#modalContentDiv").css("height", het);

			}

			if (totalW > $("#modalDiv").width()) {

				modY = (totalW - $("#modalDiv").width()) / 2;

			} else {

				modY = 0;

				$("#modalContentDiv").css("height", totalW);

			}



			$("#modalDiv").css( {

				"top" : modX,

				"left" : modY

			});

			$('#loaderFoot').css('display', 'block');

			$('#loaderFoot').css({'top':modX+($("#modalDiv").height()-$('#loaderFoot').height())/2,'left':modY+($("#modalDiv").width()-$('#loaderFoot').width())/2});

			

			var xmlhttp = null;

			xmlhttp = GetXmlHttpObject();

			var params = "dId=2";



			if (xmlhttp == null) {

				alert("Your Browser does not support Javascript.Enable Javascript.");

				return false;

			}

			var url = targeturl;

			xmlhttp.onreadystatechange = function() {

				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					$('#modalDiv').css('display', 'block');		

					$('#loaderFoot').css('display', 'none');

					$('#modalContentDiv').html(xmlhttp.responseText);

					

				



				}

			};



			xmlhttp.open("POST", url, true);

			xmlhttp.setRequestHeader('Content-Type',

					'application/x-www-form-urlencoded');

			xmlhttp.send(params);

		} catch (err) {

			alert("Error Occured: " + err.message);

		}

 

 }

function getIEVersionNumber() {

    var ua = navigator.userAgent;

    var MSIEOffset = ua.indexOf("MSIE ");

    

    if (MSIEOffset == -1) {

        return 0;

    } else {

        return parseFloat(ua.substring(MSIEOffset + 5, ua.indexOf(";", MSIEOffset)));

    }

}


 function getAboutUsContent(headingtext, targeturl,action) {

	try {

	if (action == 'close') {

		resumeAnimation();

		$('#mainDiv1').css('display', 'none');

		$('#grayOut').css('display', 'none');

		$('#modalContentDiv1').css('display', 'none');	

		//$('#mainDiv1').css('display', 'block');

		$('#mainDiv1').css('display', 'none');

		$('#modalContentDiv1').html('');

		$('#loaderFoot1').css('display', 'none');

		

		

	}else{

		

	



		$('#mainDiv1').css('display', 'block');

		$('#grayOut').css('display', 'block');

		$('#modalContentDiv1').css('display', 'block');		

		//$('#headingDiv1').html(headingtext);

		

		var totalH = $(window).height();

		var totalW = $(window).width();

		

		var modX;

		var modY;

		

		if (totalH > $("#modalDiv1").height()) {

			modX = (totalH - $("#modalDiv1").height()) / 2;



		} else {

			modX = 0;			

			var het=totalH-100;

			$("#modalContentDiv1").css("height", het);

		}

		if (totalW > $("#modalDiv1").width()) {

			modY = (totalW - $("#modalDiv1").width()) / 2;

		} else {

			modY = 0;

			$("#modalContentDiv1").css("height", totalW);

		}



		$("#modalDiv1").css( {

			"top" : modX,

			"left" : modY

		});

		$('#loaderFoot1').css('display', 'block');

		$('#loaderFoot1').css({'top':modX+($("#modalDiv1").height()-$('#loaderFoot1').height())/2,'left':modY+($("#modalDiv1").width()-$('#loaderFoot1').width())/2});

		

		var xmlhttp = null;

		xmlhttp = GetXmlHttpObject();

		var params = "dId=2";



		if (xmlhttp == null) {

			alert("Your Browser does not support Javascript.Enable Javascript.");

			return false;

		}

		var url = targeturl;

		xmlhttp.onreadystatechange = function() {

			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

				$('#loaderFoot1').css('display', 'none');	

				$('#mainDiv1').css('display', 'block');

				$('#modalDiv1').css('display', 'block');			

				$('#modalContentDiv1').html(xmlhttp.responseText);

			}

		};



		xmlhttp.open("POST", url, true);

		xmlhttp.setRequestHeader('Content-Type',

				'application/x-www-form-urlencoded');

		xmlhttp.send(params);

	}

	}

	 catch (err) {

			alert("Error Occured: " + err.message);

		}

	



}

function preventDefaultAction(id){

	$(id).click(function(event) {

		  event.preventDefault();

		  

		});

}

function showRedactPopup(headingtext){
	
	
	try {
		$('#mainDivRed').css('display', 'block');
		$('#grayOut').css('display', 'block');
		$('#modalRedentDivRed').css('display', 'block');
		
		

var totalH = $(window).height();
		var totalW = $(window).width();
		
		var modX;
		var modY;
		
		if (totalH > $("#modalDivRed").height()) {
			modX = (totalH - $("#modalDivRed").height()) / 2;

		} else {
			modX = 0;

			$("#modalRedentDivRed").css("height", totalH);
		}
		if (totalW > $("#modalDivRed").width()) {
			modY = (totalW - $("#modalDivRed").width()) / 2;
		} else {
			modY = 0;
			$("#modalRedentDivRed").css("height", totalW);
		}

		$("#modalDivRed").css( {
			"top" : modX,
			"left" : modY
		});
		
		var realH=modX+($("#modalDivRed").height()-$('#loaderFootRed').height())/2;
		var realW=modY+($("#modalDivRed").width()-$('#loaderFootRed').width())/2;
		var isIE5Min = getIEVersionNumber();
		
		if(isIE5Min==7){
			realH=20;
			realW=realW-80;
		}
		if (((screen.width>1024) && (screen.height>768)) && (isIE5Min==7) )
		{
			realH=10;
		}
		$('#loaderFootRed').css({'top':realH,'left':realW});
		$('#loaderFootRed').css('display', 'block');
		



		$.post("http://www.mykeralahotels.in/views/sitemap.php", function(
				data) {
			$('#modalDivRed').css('display', 'block');	
			$('#loaderFootRed').css('display', 'none');
			$('#modalRedentDivRed').html(data);
			var totalH = $(window).height();
			var totalW = $(window).width();
			var modX;
			var modY;
			if (totalH > $("#modalDivRed").height()) {
				modX = (totalH - $("#modalDivRed").height()) / 2;

			} else {
				modX = 0;

				$("#modalRedentDivRed").css("height", totalH);
			}
			if (totalW > $("#modalDivRed").width()) {
				modY = (totalW - $("#modalDivRed").width()) / 2;
			} else {
				modY = 0;
			}

			$("#modalDivRed").css( {
				"top" : modX,
				"left" : modY
			});
			document.getElementById('modalDivEmailSuc').style.top=sucX+'px';
			document.getElementById('modalDivEmailSuc').style.left=sucY+'px';
			sucX=modX;
			sucY=modY;

		});

	} catch (err) {
		alert("Error Occured: " + err.message);
	}
}

function closeRedactPopup(action){	
	
	if(document.getElementById('mainDivEmailSuc').style.display=='block'){
		
	}else{
	resumeAnimation();
	}
	if(action=='close'){
		resumeAnimation();
	}
	
	//showCopyMailIdPoup('close');
	 //$('#modalContentDivEmail').css('display','none');
		 $('#grayOut').css('display','none');
		 $('#modalDivRed').css('display','none');
		 $('#modalRedentDivRed').css('display','none');
		 $('#modalRedentDivRed').html('');
		// $('#headingDivRed').html('');
		 $('#mainDivRed').css('display','none');
		 $('#loaderFootRed').css('display','none');
	
	
}

$.urlParam = function(name,url){
	var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(url);
	if (!results) { return 0; }
	return results[1] || 0;};

/**
 * @desc returns user details when clicking BookNow button
 * 		
 * @return 
 */
function getuserDetails(){
	
var 	details=$.cookie('wordpress_logged_in_'+myHash);
var datapp=null;
	if(details){
		$.getJSON("http://www.mykeralahotels.in/views/getWpUserDetails.php",  { actiong: 'getuser',userid: details.split('|')[0] }, function(
				data) {				
					$('#txtEmail').val(data.email);
					$('#txtFName').val(data.first_name);
					$('#txtLName').val(data.last_name);

});
	}
	getpackageDetails();	
	
}

/**
 * @desc returns package title when clicking BookNow button
 * 		
 * @return 
 */
function getpackageDetails(){	
		$.getJSON("http://www.mykeralahotels.in/views/postdetails.php",  { pageId: pageiid }, function(

				data) {				
					
					if($('#txtInquiry')){
					$('#txtInquiry').val(data.post_title);
					}
					
					if(document.getElementById('chkCopyEmailId')){
					document.getElementById('chkCopyEmailId').checked=true;
					}
				
});
	
	
}
