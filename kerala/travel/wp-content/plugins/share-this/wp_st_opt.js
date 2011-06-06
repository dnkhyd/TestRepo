if (!window.console || !console.firebug) {
	var names = ["log", "debug", "info", "warn", "error", "assert", "dir", "dirxml", "group", "groupEnd",
				 "time", "timeEnd", "count", "trace", "profile", "profileEnd"];
	window.console = {};
	for (var i = 0; i < names.length; ++i) window.console[names[i]] = function() {};
}


var startPos=1;

function getStartPos(){
	var arr=[];
	arr['_large']=1;
	arr['_hcount']=2;
	arr['_vcount']=3;
	arr['classic']=4;
	arr['chicklet']=5;
	arr['chicklet2']=6;
	arr['_buttons']=7;
	if(typeof(arr[st_current_type])!=="undefined"){
		startPos=arr[st_current_type];
	}
}


jQuery(document).ready(function() {
	getStartPos();
	if(/updated=true/.test(document.location.href)){
		$('#st_updated').show();
	}
    jQuery("#carousel").jcarousel({
		size:7,
		scroll:1,
		visible:1,
		start:startPos,
		wrap:"circular",
		itemFirstInCallback: {
		  onAfterAnimation: carDoneCB
		},
		itemFallbackDimension:460
	});

	$('#st_services').bind('keyup', function(){
		clearTimeout(stkeytimeout);
		stkeytimeout=setTimeout(function(){makeTags();},500);
	})
	
	$('#st_pkey').bind('keyup', function(){
		clearTimeout(stpkeytimeout);
		stpkeytimeout=setTimeout(function(){makeHeadTag();},500);
	})

});

var stkeytimeout=null;
var stpkeytimeout=null;

function makeHeadTag(){
	var val=$('#st_pkey').val();
	var tag=$('#st_widget').val();
	var reg=new RegExp("(publisher:)('|\")(.*?)('|\")",'gim');
	var b=tag.replace(reg,'$1$2'+val+'$4');
	$('#st_widget').val(b);
}


function makeTags(){
	var services=$('#st_services').val();
	var type=$('#curr_type').html();
	svc=services.split(",");
	var tags=""
	var dt="displayText='share'";
	if(type=="chicklet2"){
		dt="";
	}else if(type=="classic"){
		tags="<span class='st_sharethis' st_title='{title}' st_url='{url}' displayText='ShareThis'></span>";
		$('#st_tags').val(tags);
		return true;
	}
	if(type=="chicklet" || type=="chicklet2" || type=="classic"){
		type="";
	}
	for(var i=0;i<svc.length;i++){
		if(svc[i].length>2){
			tags+="<span class='st_"+svc[i]+type+"' st_title='{TITLE}' st_url='{URL}' "+dt+"></span>";
		}
	}
	$('#st_tags').val(tags);

}


function carDoneCB(a,elem){
	var type=elem.getAttribute("st_type");
	$('.services').show()
	if(type=="vcount"){
		$('#curr_type').html("_vcount");$("#st_current_type").val("_vcount");
		$('#currentType').html("<span class='type_name'>Vertical Count</span>");
	}else if(type=="hcount"){
			$('#curr_type').html("_hcount");$("#st_current_type").val("_hcount");
			$('#currentType').html("<span class='type_name'>Horizontal Count</span>");
	}else if(type=="buttons"){
			$('#curr_type').html("_buttons");$("#st_current_type").val("_buttons");
			$('#currentType').html("<span class='type_name'>Buttons</span>");
	}else if(type=="large"){
			$('#curr_type').html("_large");$("#st_current_type").val("_large");
			$('#currentType').html("<span class='type_name'>Large Icons</span>");
	}else if(type=="chicklet"){
			$('#curr_type').html("chicklet");$("#st_current_type").val("chicklet");
			$('#currentType').html("<span class='type_name'>Regular Buttons</span>");
	}else if(type=="chicklet2"){
			$('#curr_type').html("chicklet2");$("#st_current_type").val("chicklet2");
			$('#currentType').html("<span class='type_name'>Regular Buttons No-Text</span>");
	}else if(type=="sharethis"){
			$('.services').hide();
			$('#curr_type').html("classic");$("#st_current_type").val("classic");
			$('#currentType').html("<span class='type_name'>Classic</span>");
	}	
	makeTags();	
}


