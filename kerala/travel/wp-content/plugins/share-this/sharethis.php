<?php

// ShareThis
//
// Copyright (c) 2010 ShareThis, Inc.
// http://sharethis.com
//
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// This is an add-on for WordPress
// http://wordpress.org/
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// *****************************************************************

/*
 Plugin Name: ShareThis
 Plugin URI: http://sharethis.com
 Description: Let your visitors share a post/page with others. Supports e-mail and posting to social bookmarking sites. <a href="options-general.php?page=sharethis.php">Configuration options are here</a>. Questions on configuration, etc.? Make sure to read the README.
 Version: 4.0.4
 Author: ShareThis, Manu Mukerji <manu@sharethis.com>
 Author URI: http://sharethis.com
 */

load_plugin_textdomain('sharethis');


function install_ShareThis(){
	$publisher_id = get_option('st_pubid'); //pub key value
	$widget = get_option('st_widget'); //entire script tag
	$newUser=false;

	if(empty($publisher_id)){
		if(!empty($widget)){
			$newPkey=getKeyFromTag();
			if($newPkey==false){
				$newUser=true;
				update_option('st_pubid',trim(makePkey()));
			}else{
				update_option('st_pubid',$newPkey); //pkey found set old key
			}
		}else{
			$newUser=true;
			update_option('st_pubid',trim(makePkey()));
		}
	}
	
	if($widget==false || !preg_match('/stLight.options/',$widget)){
		$pkey2=get_option('st_pubid'); 
		$widget="<script charset=\"utf-8\" type=\"text/javascript\" src=\"http://w.sharethis.com/button/buttons.js\"></script>";
		$widget.="<script type=\"text/javascript\">stLight.options({publisher:'$pkey2',offsetTop:'150'
});var st_type='wordpress".trim(get_bloginfo('version'))."';</script>";
		update_option('st_widget',$widget);
	}
	
	
	$st_sent=get_option('st_sent');
	if(empty($st_sent)){
		update_option('st_sent','true');
		$st_sent=get_option('st_sent'); //confirm if value has been set
		if(!(empty($st_sent))){
			sendWelcomeEmail($newUser);
		}
	}

	if (get_option('st_add_to_content') == '') {
		update_option('st_add_to_content', 'yes');
	}
	if (get_option('st_add_to_page') == '') {
		update_option('st_add_to_page', 'yes');
	}

		
}

function getKeyFromTag(){
	$widget = get_option('st_widget');
	$pattern = "/publisher\=([^\&\"]*)/";
	preg_match($pattern, $widget, $matches);
	$pkey = $matches[1];
	if(empty($pkey)){
		return false;
	}
	else{
		return $pkey;
	}
}


function getNewTag($oldTag){
	$pattern = '/(http\:\/\/*.*)[(\')|(\")]/';
	preg_match($pattern, $oldTag, $matches);
	$url=$matches[1];

	$pattern = '/(type=)/';
	preg_match($pattern, $url, $matches);
	if(empty($matches)){
		$url.="&amp;type=wordpress".get_bloginfo('version');
	}

	$qs=parse_url($url);
	if($qs['query']){
		$qs=$qs['query'];
		$newUrl="http://w.sharethis.com/button/sharethis.js#$qs";
	}
	else{
		$newUrl=$url;
	}
	return $newTag='<script type="text/javascript" charset="utf-8" src="'.$newUrl.'"></script>';
}




if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
	install_ShareThis();
}

function st_widget_head() {
	$widget = get_option('st_widget');
	if ($widget == '') {
	}
	else{
		//$widget = st_widget_add_wp_version($widget);
		$widget = st_widget_fix_domain($widget);
		$widget = preg_replace("/\&/", "&amp;", $widget);
	}

	print($widget);
}


function sendWelcomeEmail($newUser){
	$to=get_option('admin_email');
	$updatePage=get_option('siteurl');
	$updatePage.="/blogAdmin/options-general.php?page=sharethis.php";

	$body = "The ShareThis plugin on your website has been activated on ".get_option('siteurl')."\n\n"
	."If you would like to customize the look of your widget, go to the ShareThis Options page in your WordPress administration area. $updatePage\n\n" 
	."Get more information on customization options at http://help.sharethis.com/integration/wordpress." 
	."To get reporting on share data login to your account at http://sharethis.com/account and choose options in the Analytics section\n\n"
    ."If you have any additional questions or need help please email us at support@sharethis.com\n\n--The ShareThis Team";

	$subject = "ShareThis WordPress Plugin";

	if(empty($to)){
		return false;
	}
	if($newUser){
		$subject = "ShareThis WordPress Plugin Activation";
		$body ="Thanks for installing the ShareThis plugin on your blog.\n\n" 
		."If you would like to customize the look of your widget, go to the ShareThis Options page in your WordPress administration area. $updatePage\n\n" 
		."Get more information on customization options at http://help.sharethis.com/integration/wordpress.\n\n" 		
		."If you have any additional questions or need help please email us at support@sharethis.com\n\n--The ShareThis Team";
	}
	$headers = "From: ShareThis Support <support@sharethis.com>\r\n" ."X-Mailer: php";
	update_option('st_sent','true');
	mail($to, $subject, $body, $headers);
}



function st_link() {
	
	global $post;

	$sharethis = '<p><a href="http://sharethis.com/item?&wp='
	.get_bloginfo('version').'&amp;publisher='
	.get_option('st_pubid').'&amp;title='
	.urlencode(get_the_title()).'&amp;url='
	.urlencode(get_permalink($post->ID)).'">ShareThis</a></p>';

	return $sharethis;
}

function sharethis_button() {
	echo st_makeEntries();
}

function st_remove_st_add_link($content) {
	remove_action('the_content', 'st_add_link');
	remove_action('the_content', 'st_add_widget');
	return $content;
}

function st_add_widget($content) {
	if ((is_page() && get_option('st_add_to_page') != 'no') || (!is_page() && get_option('st_add_to_content') != 'no')) {
		if (!is_feed()) {
			return $content.'<p style="clear:both;">'.st_makeEntries().'</p>';
		}
	}

	return $content;
}

// 2006-06-02 Renamed function from st_add_st_link() to st_add_feed_link()
function st_add_feed_link($content) {

	if (is_feed()) {
		$content .= st_link();
	}

	return $content;
}

// 2006-06-02 Filters to Add Sharethis widget on content and/or link on RSS
// 2006-06-02 Expected behavior is that the feed link will show up if an option is not 'no'
if (get_option('st_add_to_content') != 'no' || get_option('st_add_to_page') != 'no') {
	add_filter('the_content', 'st_add_widget');

	// 2008-08-15 Excerpts don't play nice due to strip_tags().
	add_filter('get_the_excerpt', 'st_remove_st_add_link',9);
	add_filter('the_excerpt', 'st_add_widget');
}

function st_widget_fix_domain($widget) {
	return preg_replace(
		"/\<script\s([^\>]*)src\=\"http\:\/\/sharethis/"
		, "<script $1src=\"http://w.sharethis"
		, $widget
		);
}

function st_widget_add_wp_version($widget) {
	preg_match("/([\&\?])wp\=([^\&\"]*)/", $widget, $matches);
	if ($matches[0] == "") {
		$widget = preg_replace("/\"\>\s*\<\/\s*script\s*\>/", "&wp=".get_bloginfo('version')."\"></script>", $widget);
		$widget = preg_replace("/widget\/\&wp\=/", "widget/?wp=", $widget);
	}
	else {
		$widget = preg_replace("/([\&\?])wp\=([^\&\"]*)/", "$1wp=".get_bloginfo('version'), $widget);
	}
	return $widget;
}


if (!function_exists('ak_can_update_options')) {
	function ak_can_update_options() {
		if (function_exists('current_user_can')) {
			if (current_user_can('manage_options')) {
				return true;
			}
		}
		else {
			global $user_level;
			get_currentuserinfo();
			if ($user_level >= 8) {
				return true;
			}
		}
		return false;
	}
}

function st_request_handler() {
	if (!empty($_REQUEST['st_action'])) {
		switch ($_REQUEST['st_action']) {
			case 'st_update_settings':
				if (ak_can_update_options()) {
					if (!empty($_POST['st_widget'])) { // have widget
							$widget = stripslashes($_POST['st_widget']);
							$widget = preg_replace("/\&amp;/", "&", $widget);
							if(!preg_match('/buttons.js/',$widget)){			
								$pattern = "/publisher\=([^\&\"]*)/";
								preg_match($pattern, $widget, $matches);
								if ($matches[0] == "") { // widget does not have publisher parameter at all
									$publisher_id = get_option('st_pubid');
									if ($publisher_id != "") {
										$widget = preg_replace("/\"\>\s*\<\/\s*script\s*\>/", "&publisher=".$publisher_id."\"></script>", $widget);
										$widget = preg_replace("/widget\/\&publisher\=/", "widget/?publisher=", $widget);
									}
								}
								elseif ($matches[1] == "") { // widget does not have pubid in publisher parameter
									$publisher_id = get_option('st_pubid');
									if ($publisher_id != "") {
										$widget = preg_replace("/([\&\?])publisher\=/", "$1publisher=".$publisher_id, $widget);
									} else {
										$widget = preg_replace("/([\&\?])publisher\=/", "$1publisher=".$publisher_id, $widget);
									}
								} else { // widget has pubid in publisher parameter
									$publisher_id = get_option('st_pubid');
									if ($publisher_id != "") {
										if ($publisher_id != $matches[1]) {
											$publisher_id = $matches[1];
										}
									}  else {
										$publisher_id = $matches[1];
									}
								}
							}else{
								$publisher_id = get_option('st_pubid');
								$pkeyUpdated=false;
								if(!empty($_POST['st_pkey']) && $publisher_id!==$_POST['st_pkey'] ){
									update_option('st_pubid', $_POST['st_pkey']);
									$publisher_id=$_POST['st_pkey'];
									$pkeyUpdated=true;
								}
								
								if(!preg_match('/stLight.options/',$widget) || $pkeyUpdated==true){
									$widget="<script charset=\"utf-8\" type=\"text/javascript\" src=\"http://w.sharethis.com/button/buttons.js\"></script>";
									$widget.="<script type=\"text/javascript\">stLight.options({publisher:'$publisher_id',offsetTop:'150'
});var st_type='wordpress".trim(get_bloginfo('version'))."';</script>";
									update_option('st_widget',$widget);
								}
							}
					}
					else { // does not have widget
						$publisher_id = get_option('st_pubid');
					}

					preg_match("/\<script\s[^\>]*charset\=\"utf\-8\"[^\>]*/", $widget, $matches);
					if ($matches[0] == "") {
						preg_match("/\<script\s[^\>]*charset\=\"[^\"]*\"[^\>]*/", $widget, $matches);
						if ($matches[0] == "") {
							$widget = preg_replace("/\<script\s/", "<script charset=\"utf-8\" ", $widget);
						}
						else {
							$widget = preg_replace("/\scharset\=\"[^\"]*\"/", " charset=\"utf-8\"", $widget);
						}
					}
					preg_match("/\<script\s[^\>]*type\=\"text\/javascript\"[^\>]*/", $widget, $matches);
					if ($matches[0] == "") {
						preg_match("/\<script\s[^\>]*type\=\"[^\"]*\"[^\>]*/", $widget, $matches);
						if ($matches[0] == "") {
							$widget = preg_replace("/\<script\s/", "<script type=\"text/javascript\" ", $widget);
						}
						else {
							$widget = preg_replace("/\stype\=\"[^\"]*\"/", " type=\"text/javascript\"", $widget);
						}
					}

					// note: do not convert & to &amp; or append WP version here
					$widget = st_widget_fix_domain($widget);
					update_option('st_pubid', $publisher_id);
					update_option('st_widget', $widget);
					
					if(!empty($_POST['st_pkey'])){
						update_option('st_pubid', $_POST['st_pkey']);
					}
					if(!empty($_POST['st_tags'])){
						$tagsin=$_POST['st_tags'];
						$tagsin=preg_replace("/\\n|\\t/","</span>", $tagsin);
						$tagsin=preg_replace("/\\\'/","'", $tagsin);
						//$tagsin=htmlspecialchars_decode($tagsin);
						$tagsin=trim($tagsin);
						update_option('st_tags',$tagsin);
					}
					if(!empty($_POST['st_services'])){
						update_option('st_services', trim($_POST['st_services'],",") );
					}
						
					if(!empty($_POST['st_current_type'])){
						update_option('st_current_type', trim($_POST['st_current_type'],",") );
					}
					$options = array(
						'st_add_to_content'
						, 'st_add_to_page'
						);
						foreach ($options as $option) {
							if (isset($_POST[$option]) && in_array($_POST[$option], array('yes', 'no'))) {
								update_option($option, $_POST[$option]);
							}
						}
							
						header('Location: '.get_bloginfo('wpurl').'/blogAdmin/options-general.php?page=sharethis.php&updated=true');
						die();
				}

				break;
		}
	}
}


function st_options_form() {
	$publisher_id = get_option('st_pubid');
	$services = get_option('st_services');
	$tags = get_option('st_tags');
	$st_current_type=get_option('st_current_type');
	if(empty($st_current_type)){
		$st_current_type="_large";
	}
	if(empty($services)){
		$services="facebook,twitter,email,sharethis";
	}
	if(empty($tags)){
		foreach(explode(',',$services) as $svc){
			$tags.="<span class='st_".$svc."_vcount' st_title='{title}' st_url='{url}' displayText='share'></span>";
		}
	}
	
	
	if(empty($publisher_id)){
		$toShow="";
	}
	else{
		$toShow=get_option('st_widget');
	}
	print('
		<script type="text/javascript" src="http://w.sharethis.com/widget/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="http://w.sharethis.com/widget/jquery.carousel.min.js"></script>
		<link rel="stylesheet" href="http://w.sharethis.com/widget/wp_ex.css" type="text/css" media="screen" />
		
			<div class="wrap">
			
				<h2>'.__('ShareThis Options', 'sharethis').'</h2>
				<div style="padding:10px;border:1px solid #aaa;background-color:#9fde33;text-align:center;display:none;" id="st_updated">Your options were successfully updated</div>
				<form id="ak_sharethis" name="ak_sharethis" action="'.get_bloginfo('wpurl').'/blogAdmin/index.php" method="post">
					<fieldset class="options">
						<div class="st_options">
													
							<div class="carousel_div">
								<span class="heading">Choose the display style for your social buttons.<br/>Selected Choice: <span id="curr_type" style="display:none"></span><span id="currentType"></span></span>
								<ul id="carousel" class="jcarousel-skin-tango">
									<li st_type="large"><div class="buttonType">Large Icons (1/7)</div><img src="http://w.sharethis.com/images/wp_ex4.png"  alt="" /></li>
									<li st_type="hcount"><div class="buttonType">Horizontal Count (2/7)</div><img src="http://w.sharethis.com/images/wp_ex2.png"  alt="" /></li>
									<li st_type="vcount"><div class="buttonType">Vertical Count (3/7)</div><img src="http://w.sharethis.com/images/wp_ex1.png"  alt="" /></li>
									<li st_type="sharethis"><div class="buttonType">Classic (4/7)</div><img src="http://w.sharethis.com/images/wp_ex7.png" alt="" /></li>
								    <li st_type="chicklet"><div class="buttonType">Regular Buttons (5/7)</div><img src="http://w.sharethis.com/images/wp_ex5.png"  alt="" /></li>								    
								    <li st_type="chicklet2"><div class="buttonType">Regular Button No-Text (6/7)</div><img src="http://w.sharethis.com/images/wp_ex6.png"  alt="" /></li>
								    <li st_type="buttons"><div class="buttonType">Buttons (7/7)</div><img src="http://w.sharethis.com/images/wp_ex3.png"  alt="" /></li>
								</ul>
							</div>
							<br/>
							<div class="services">
								<span class="heading" onclick="javascript:$(\'#st_services\').toggle(\'slow\');"><span class="headingimg">[+]</span>Click to change order of social buttons or modify list of buttons.</span>&nbsp;(<a href="http://help.sharethis.com/customization/chicklets#supported-services" target="_blank">?</a>)<br/>
								<textarea name="st_services" id="st_services" style="height: 30px; width: 400px;">'.htmlspecialchars($services).'</textarea>
							</div>
							<br/>
							<div class="tags">
								<span class="heading" onclick="javascript:$(\'#st_tags\').toggle(\'slow\');"><span class="headingimg">[+]</span>Click to view/modify the HTML tags.</span><br/>
								<textarea name="st_tags" id="st_tags" style="height: 100px; width: 500px;">'.htmlspecialchars(preg_replace("/<\/span>/","</span>\n", $tags)).'</textarea>
							</div>
							<br/>
							<div class="widget_code">
								<span class="heading" onclick="javascript:$(\'#st_widget\').toggle(\'slow\');">
									<span class="headingimg">[+]</span>
									Click to modify other widget options.
								</span>
								<br/>
								<textarea id="st_widget" name="st_widget" style="height: 80px; width: 500px;">'.htmlspecialchars($toShow).'</textarea>
							</div>
							<br/>
							<div>
								<span class="heading" onclick="javascript:$(\'#st_pkey\').toggle(\'slow\');"><span class="headingimg">[+]</span>Your Publisher Key:</span><br/>	
								<textarea name="st_pkey" id="st_pkey" style="height: 30px; width: 400px;">'.htmlspecialchars($publisher_id).'</textarea>
							</div>
							<input type="hidden" id="st_current_type" name="st_current_type" value="'.$st_current_type.'"/>
							
						</div>
						<script type="text/javascript">var st_current_type="'.$st_current_type.'";</script>
						
						
	');
	
	$plugin_location=WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	$opt_js_location=$plugin_location."wp_st_opt.js";
	print("<script type=\"text/javascript\" src=\"$opt_js_location\"></script>");
	
	$options = array(
		'st_add_to_content' => __('Automatically add ShareThis to your posts?*', 'sharethis')
	, 'st_add_to_page' => __('Automatically add ShareThis to your pages?*', 'sharethis')
	);
	foreach ($options as $option => $description) {
		$$option = get_option($option);
		if (empty($$option) || $$option == 'yes') {
			$yes = ' selected="selected"';
			$no = '';
		}
		else {
			$yes = '';
			$no = ' selected="selected"';
		}
		print('
						<p>
							<label for="'.$option.'">'.$description.'</label>
							<select name="'.$option.'" id="'.$option.'">
								<option value="yes"'.$yes.'>'.__('Yes', 'sharethis').'</option>
								<option value="no"'.$no.'>'.__('No', 'sharethis').'</option>
							</select>
						</p>
					 
		');		
	}
	echo '<br/><p>To learn more about other sharing features and available options, visit our <a href="http://help.sharethis.com/integration/wordpress" target="_blank">help center</a>.</p>';
	print('
						
					</fieldset>
					<p class="submit">
						<input type="submit" name="submit_button" value="'.__('Update ShareThis Options', 'sharethis').'" />
					</p>
					

					<input type="hidden" name="st_action" value="st_update_settings" />
				</form>
				
			</div>
	');
}


function st_menu_items() {
	if (ak_can_update_options()) {
		add_options_page(
		__('ShareThis Options', 'sharethis')
		, __('ShareThis', 'sharethis')
		, 8
		, basename(__FILE__)
		, 'st_options_form'
		);
	}
}


function st_makeEntries(){
	
	global $post;
	//$st_json='{"type":"vcount","services":"sharethis,facebook,twitter,email"}';
	
	$out="";
	$widget=get_option('st_widget');
	$tags=get_option('st_tags');
	if(!empty($widget)){
		if(preg_match('/buttons.js/',$widget)){
			if(!empty($tags)){
				
				/*$tags=preg_replace("/\\\'/","'", $tags);
				$tags=preg_replace("/{URL}/",get_permalink($post->ID), $tags);
				$tags=preg_replace("/{TITLE}/",strip_tags(get_the_title()), $tags);
				echo($tags);*/
				$tags="<span class='st_sharethis' st_title='".strip_tags(get_the_title())."' st_url='".get_permalink($post->ID)."' displayText='ShareThis'></span>";
			}else{
				
				$tags="<span class='st_sharethis' st_title='".strip_tags(get_the_title())."' st_url='".get_permalink($post->ID)."' displayText='ShareThis'></span>";
			}
			
			$out=$tags;	
		}else{
			
			$out = '<script type="text/javascript">SHARETHIS.addEntry({ title: "'.strip_tags(get_the_title()).'", url: "'.get_permalink($post->ID).'" });</script>';
		}
	}
	return $out;
}


function makePkey(){
	return "wp.".sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),mt_rand( 0, 0x0fff ) | 0x4000,mt_rand( 0, 0x3fff ) | 0x8000,mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
}

add_action('wp_head', 'st_widget_head');
add_action('init', 'st_request_handler', 9999);
add_action('admin_menu', 'st_menu_items');

?>