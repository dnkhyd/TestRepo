<?php
/*
Copyright 2009 Brian Ellin  (email : brian@janrain.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
Plugin Name: rpx
Plugin URI: http://rpxwiki.com/WordpressPlugin
Description: Plugin to use OpenID/Facebook/Twitter/MySpace authentication via the RPX web service.
Version: 0.3.1
Author: Brian Ellin, Forest Basford
Author URI: http://janrain.com/
*/
/*
Upgraded for Wordpress 3.0 by Forest Basford ##FWB##
*/

$root = dirname(dirname(dirname(dirname(__FILE__))));
if (file_exists($root.'/wp-load.php')) {
  // WP 2.6
  require_once($root.'/wp-load.php');
} else {
  // Before 2.6
  require_once($root.'/wp-config.php');
}
require_once($root . '/wp-includes/registration.php');
require_once($root . '/wp-includes/pluggable.php');

/* configurable options */
define('RPX_API_KEY_OPTION', 'rpx_api_key_option');
define('RPX_REALM_OPTION', 'rpx_realm_option');
define('RPX_REALM_SCHEME', 'rpx_realm_scheme');
define('RPX_COMMENTS_AUTH_OPTION', 'rpx_comments_auth_option');
define('RPX_COMMENTS_AUTH_OPTION_DEFAULT', true);
define('RPX_COMMENTS_HINT_OPTION', 'rpx_comments_hint_option');
define('RPX_COMMENTS_HINT_OPTION_DEFAULT', true);
define('RPX_ADMIN_URL_OPTION', 'rpx_admin_url_option');
define('RPX_NONCE', 'rpx_nonce');
define('RPX_CSRF_TOKEN', 'rpx_csrf_token');
define('RPX_SERVER', 'https://rpxnow.com');

require_once('rpx_fetcher.php');
require_once('rpx_user.php');

register_activation_hook(__FILE__, 'rpx_activate');

//initialize user info globals##FWB##
global $current_user;
get_currentuserinfo();

/* this function is also called upon upgrading through wordpress admin */
function rpx_activate()
{
	$api_key = get_option(RPX_API_KEY_OPTION);
	if (!empty($api_key))
	{
  
		/* the submitted an api key, so make the API call to get the rest
		 of the configuration */
	
	  
		$post_data = array('apiKey' => get_option(RPX_API_KEY_OPTION),
				   'format' => 'json');
		$raw = rpx_http_post(RPX_SERVER.'/plugin/lookup_rp', $post_data);
		$r = rpx_parse_lookup_rp($raw);
	
		if($r)
		{
			update_option(RPX_API_KEY_OPTION, $r['apiKey']);
			update_option(RPX_REALM_OPTION, $r['realm']);
			update_option(RPX_REALM_SCHEME, $r['realmScheme']);
			update_option(RPX_ADMIN_URL_OPTION, $r['adminUrl']);
		} 
	}
}

function rpx_init() {
  global $current_user;

  if (rpx_is_configured()) {

    // add the sign in using these providers hint to the comment ui
    if(get_option(RPX_COMMENTS_HINT_OPTION)) {
      if(get_option(RPX_COMMENTS_AUTH_OPTION)) {
	add_action('wp_footer', 'rpx_alter_comment_ui');
      } else {
	add_action('wp_footer', 'rpx_alter_comment_ui_with_existing');
      }
      
    }
	
    // add a handler for the token url
    add_action('parse_request', 'rpx_process_token');   

    // the RPX iframe to the login form on wp-login.php
    add_action('login_head', 'rpx_login_head');

    // add the "change/add an OpenID" to the user edit page
    add_action('show_user_profile', 'rpx_edit_user_page');

    add_filter('get_comment_author', 'rpx_get_comment_author_filter');
  }

  // add the settings menu item
  add_action('admin_menu', 'rpx_add_options_to_admin');

}

/* filter for showing a favicon of the user's provider next to their name */
function rpx_get_comment_author_filter($a) {

  if (strpos($_SERVER['REQUEST_URI'], 'blogAdmin')) {
    return;
  }

  global $comment;
  $identifier = rpx_get_identifier_by_wpuid($comment->user_id);

  if (!$identifier) {
    return $a;
  }
  
  $imgdir = get_option('siteurl') . '/wp-content/plugins/rpx/images/';
  
  $img = 'openid.png';
/*
  if (strpos($identifier, 'openid.aol.com')) {
      $img = 'aol.png';
  } else if (strpos($identifier, 'google.com')) {
    $img = 'google.png';
  } else if (strpos($identifier, 'yahoo.com')) {
      $img = 'yahoo.png';
  } else if (strpos($identifier, 'facebook.com')) {
      $img = 'facebook.png';
  } else if (strpos($identifier, 'twitter.com')) {
      $img = 'twitter.png';
  } else if (strpos($identifier, 'myspace.com')) {
      $img = 'myspace.png';
  } else if (strpos($identifier, 'live.com')) {
      $img = 'live.png';
  }
*/
  if (strpos($identifier, 'google.com')) {
    $img = 'google.png';
  } else if (strpos($identifier, 'yahoo.com')) {
      $img = 'yahoo.png';
  } else if (strpos($identifier, 'facebook.com')) {
      $img = 'facebook.png';
  }


  $img = $imgdir . $img;
  return "<img src='$img'/> " . $a; 
}

function rpx_process_auth_info($auth_info) {
  global $current_user;

  /* a user is already signed in and is changing their OpenID */
  if ($_REQUEST['attach_to']) {
    $wpuid = $_REQUEST['attach_to'];
    wp_set_auth_cookie($wpuid, true, false);
    wp_set_current_user($wpuid);
    get_currentuserinfo();

    /* make sure the actually initiated the sign-in request */
    if(($current_user instanceof WP_User) && $wpuid == $current_user->ID) {//Added correct test for user object.##FWB##
      $wpuid = rpx_upgrade_user($auth_info, $wpuid);
      if ( ! $wpuid == $current_user->ID ){
        echo 'RPX user meta upgrade failed.';
      }
    } 

    rpx_redirect();//Redirect back to last page.##FWB##

  /* a user is not signed-in, so we sign them in */
  } else {
 
    rpx_signin_user($auth_info);
  }

}

function rpx_current_url() {
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {                    
    $proto = "https";
    $standard_port = '443';                                                 
  } else {                                                                    
    $proto = 'http';                                                        
    $standard_port = '80';                                                  
  }                                                                           
  
  $authority = $_SERVER['HTTP_HOST'];                                         
  if (strpos($authority, ':') === FALSE &&                                    
      $_SERVER['SERVER_PORT'] != $standard_port) {                            
    $authority .= ':' . $_SERVER['SERVER_PORT'];                            
  }                                                                           
  
  if (isset($_SERVER['REQUEST_URI'])) {                                       
    $request_uri = $_SERVER['REQUEST_URI'];                                 
  } else {                                                                    
    $request_uri = $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];         
    $query = $_SERVER['QUERY_STRING'];                                      
    if (isset($query)) {                                                    
      $request_uri .= '?' . $query;                                       
    }                                                                       
  }                                                                           
  
  return $proto . '://' . $authority . $request_uri;                          
}                                                                                

function rpx_process_token() {

  if (empty($_REQUEST['rpx_response']) || empty($_REQUEST['token'])) {
    return;
  }
 
  $post_data = array('token' => $_REQUEST['token'],
		     'apiKey' => get_option(RPX_API_KEY_OPTION),
		     'format' => 'json');

  $raw_response = rpx_http_post(RPX_SERVER.'/api/v2/auth_info', $post_data);

  // parse the json or xml response into an associative array
  $auth_info = rpx_parse_auth_info($raw_response);

  // process the auth_info response
  if ($auth_info['stat'] == 'ok') {

    rpx_process_auth_info($auth_info);

  } else {
    
    echo 'An error occured.';
}

}

function rpx_widget_js() {
  /* don't render the sign-in link if we are already signed in */
  $rpx_realm = get_option(RPX_REALM_OPTION);
  $token_url = rpx_token_url();
?>
<script src="<?php echo RPX_SERVER; ?>/openid/v2/widget" type="text/javascript"></script>
<script type="text/javascript">
RPXNOW.token_url = "<?php echo $token_url ?>";
RPXNOW.realm = "<?php echo $rpx_realm ?>";
RPXNOW.overlay = true;
RPXNOW.ssl = <?php echo _rpx_ssl() ?>;
RPXNOW.language_preference = 'en';
</script>
<?php
}

function _rpx_ssl() {  
    return (get_option(RPX_REALM_SCHEME) == 'https') ? 'true' : 'false';
}

function rpx_comment_hint($rpxjs=false) {
  $login_url = get_option('siteurl') . '/wp-login.php';
  $imgdir = get_option('siteurl') . '/wp-content/plugins/rpx/images/';

  echo "<div class='rpx_comment_hint' id='rpx_comment_hint' style='display:none;'><a href='$login_url' class='rpxnow' id='rpx_comment_hint_link'>Leave a verified comment using</a> <span id='rpx_provider_wrap'>";

  $providers = array(
		     array("Facebook", "facebook"),
		     array("Google", "google"),
		     array("Yahoo!", "yahoo")
		     );

  for($i=0; $i<count($providers); $i++) {
    $pt = $providers[$i][0];
    $pn = $providers[$i][1];
    echo "<a href='$login_url' class='rpxnow'><img src='$imgdir$pn.png' class='rpx_provider_image' style='padding:5px;padding-bottom:0;border: 0pt none ;'/></a>";
  }
  echo '</span> </div>';

  if ($rpxjs) {
    rpx_widget_js();
  }
}

function rpx_alter_comment_ui_with_existing() {
  global $current_user;
  $wpuser = $current_user;
  if(!($wpuser->ID == '0')) return;
  

  rpx_comment_hint(true);
  
  echo <<<EOF
<script type="text/javascript">
var hint = document.getElementById('rpx_comment_hint');
var respond_div = document.getElementById("commentformbox");
if (!respond_div) {
  respond_div = document.getElementById("respond");
}
if (respond_div) {
  respond_div.insertBefore(hint,respond_div.firstChild.nextSibling.nextSibling);  
  hint.style.display='block';
}
</script>
EOF;
}

function rpx_alter_comment_ui() {
  global $current_user;
  $wpuser = $current_user;
  if(!($wpuser->ID == '0')) return;

  rpx_comment_hint(true);

echo <<<EOF
<script type="text/javascript">
var rpx_hint = document.getElementById("rpx_comment_hint");
var respond_div = document.getElementById("commentformbox");
if (!respond_div) {
  respond_div = document.getElementById("respond");
}

if (respond_div) {
  respond_div.innerHTML = "<h3>Leave a Reply</h3>";
  respond_div.appendChild(rpx_hint);
  rpx_hint.style.display='block';
}
</script>
EOF;


}

function rpx_login_head() {
  $realm = get_option(RPX_REALM_OPTION);
  $realm_scheme = get_option(RPX_REALM_SCHEME);
  $turl = rpx_token_url();
  if ($_REQUEST['return_to']) {
    $turl .= '&goback=' . urlencode($_REQUEST['return_to']); 
  } 

  $iframe_src = $realm_scheme.'://' . $realm . '/openid/embed?token_url=' . urlencode($turl); 
  
  echo '<script type="text/javascript">';
//Quick GET passed message handler##FWB##
  $rpx_error = '';
  switch ( $_GET[rpxmsg] ){
    case 'email':
      $rpx_error = '<p style=\"color : #660000;\">An account with this email address has already been registered.<br />Please login with your username and password below.<br />You can then select a login provider in your account settings.</p>';
      break;
    case 'noemail':
      $rpx_error = '<p style=\"color : #660000;\">This account did not provide an email address. <br />Please update the account with that service or use another service.</p>';
      break;
  }
//Added $rpx_error to rpx_up_h3.innerHTML ##FWB##
echo'

window.onload = function() {

wrapUp();

var rpx_lf = document.getElementById("loginform");
rpx_lf.style.width = "400px";
rpx_lf.style.backgroundColor = "#fff";

var rpx_up_h3 = document.createElement("P");
rpx_up_h3.innerHTML = "<div id=\"rpx_password\">'.$rpx_error.'<p><a href=\"#\" onclick=\"showUP();return false;\">sign in with username and password</a></p></div>";
rpx_lf.insertBefore(document.createElement("BR"), rpx_lf.firstChild);
rpx_lf.insertBefore(rpx_up_h3, rpx_lf.firstChild );


/* create a wrapper div for all the rpx stuff */
var rpx_wrap = document.createElement("DIV");
rpx_wrap.id = "rpx_wrap";
rpx_lf.insertBefore(rpx_wrap, rpx_lf.firstChild);

var sign_in = document.createElement("H2");
sign_in.id = "rpx_signin_h3";
sign_in.innerHTML = "Sign In";
rpx_wrap.appendChild(sign_in);

var rpx_iframe = document.createElement("IFRAME");
rpx_iframe.id = "rpx_iframe";
rpx_iframe.src = "'. $iframe_src .'";
rpx_iframe.style.width = "400px";
rpx_iframe.style.height = "240px";
rpx_iframe.scrolling = "no";
rpx_iframe.frameBorder = "no";
rpx_wrap.appendChild(rpx_iframe);

/*
var hr = document.createElement("HR");
hr.id = "rpx_hr";
hr.style.border = "none";
hr.style.borderTop = "1px solid #ccc";
rpx_wrap.appendChild(hr);
*/

hideUP();
}

function wrapUp() {
  var rpx_lf = document.getElementById("loginform");
  var lf_wrap = document.createElement("DIV");
  lf_wrap.id = "rpx_loginform_wrap";

  //normalize the padding
  lf_wrap.style.paddingBottom = "40px";  
  rpx_lf.style.paddingBottom = "5px";

  while (rpx_lf.childNodes.length > 0) {
    var n = rpx_lf.childNodes[0];
    lf_wrap.appendChild(n);
  }

  rpx_lf.appendChild(lf_wrap);
}

function hideUP() {
  var lf_wrap = document.getElementById("rpx_loginform_wrap");
  lf_wrap.style.display = "none";
}

function showUP() {
  var lf_wrap = document.getElementById("rpx_loginform_wrap");
  lf_wrap.style.display = "block";
  document.getElementById("rpx_password").style.display = "none";
  try{document.getElementById("user_login").focus();}catch(e){}
}
</script>';


}


function rpx_iframe($style='', $token_url_params='') {
  $realm = get_option(RPX_REALM_OPTION);
  $realm_scheme = get_option(RPX_REALM_SCHEME);
  $turl = rpx_token_url() . $token_url_params;
  $iframe_src = $realm_scheme.'://' . $realm . '/openid/embed?token_url=' . urlencode($turl); 

echo '  
<iframe src="' . $iframe_src . '"
  scrolling="no" frameBorder="no" style="width:400px;height:240px;' .$style . '">
</iframe>
  ';

}

function rpx_add_options_to_admin() {
  add_options_page('RPX Options', 'RPX', 8, __FILE__, 'rpx_options_page');
}

function rpx_handle_options_page_submit() {

  if ( $_REQUEST['rpx_submit'] != 'Y' ) return;
  
  /* make sure the "register" page isn't ever shown */
  update_option('users_can_register', 0);

  if ( $_POST[RPX_API_KEY_OPTION] ) {
    rpx_check_csrf_token();

    /* the submitted an api key, so make the API call to get the rest
     of the configuration */
    $post_data = array('apiKey' => $_POST[RPX_API_KEY_OPTION],
		       'format' => 'json');
    $raw = rpx_http_post(RPX_SERVER.'/plugin/lookup_rp', $post_data);
    $r = rpx_parse_lookup_rp($raw);

    if($r) {
      update_option(RPX_API_KEY_OPTION, $r['apiKey']);
      update_option(RPX_REALM_OPTION, $r['realm']);
      update_option(RPX_REALM_SCHEME, $r['realmScheme']);
      update_option(RPX_ADMIN_URL_OPTION, $r['adminUrl']);

      $message = 'success';
      rpx_redirect_to_options_page($message);
    } else {

      $message = 'error';
      rpx_redirect_to_options_page($message);
    }

  } else if ($_POST['rpx_auto_config']) {
    rpx_check_csrf_token();

    $nonce = strval(rand());
    update_option(RPX_NONCE, $nonce);

    $site_base = get_option('siteurl');
    $return_to = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('%7E', '~', $_SERVER['REQUEST_URI']) . '&rpx_process_auto_config=Y&rpx_submit=Y';

    $redirect_to = RPX_SERVER.'/plugin/create_rp?' . 
      'return=' . urlencode($return_to) . 
      '&base=' . urlencode($site_base) . 
      '&requestId=' . urlencode($nonce);

    echo <<<EOF
<script type="text/javascript">window.location='$redirect_to';</script>
EOF;

    // auto config started
  } else if ($_GET['rpx_process_auto_config'] == 'Y') {

    $nonce = get_option(RPX_NONCE);
    update_option(RPX_NONCE, null);
    if(empty($nonce)) {
      echo 'no nonce found';
      die();
      }

    $post_data = array('token' => $_REQUEST['token']);
    $raw_json = rpx_http_post(RPX_SERVER.'/plugin/lookup_rp', $post_data);
    $json = rpx_parse_lookup_rp($raw_json);

    /* make sure it's legit */
    if ($json['requestId'] != $nonce) {
      echo 'nonce mismatch';
      die();
    }
    
    update_option(RPX_API_KEY_OPTION, $json['apiKey']);
    update_option(RPX_REALM_OPTION, $json['realm']);
    update_option(RPX_ADMIN_URL_OPTION, $json['adminUrl']);

    $message = 'success';
    rpx_redirect_to_options_page($message);
    
  } else if ( $_POST['rpx_clear_config'] == 'Y' ) {    
    rpx_check_csrf_token();
    rpx_clear_config();
    $message = 'cleared';
    rpx_redirect_to_options_page($message);

  } else if ($_POST['rpx_comment_settings'] == 'Y') {
    rpx_check_csrf_token();

    $rpx_comments_auth = !empty($_POST['rpx_comments_auth']);
    update_option(RPX_COMMENTS_AUTH_OPTION, $rpx_comments_auth);
    if (!$rpx_comments_auth) {
      // make sure comment registration is off
      update_option('comment_registration', 0);
    }

    $rpx_comments_hint = !empty($_POST['rpx_comments_hint']);
    update_option(RPX_COMMENTS_HINT_OPTION, $rpx_comments_hint);
	
  }

}

function rpx_check_csrf_token() {
  $csrf_token = get_option(RPX_CSRF_TOKEN);
  if ($_REQUEST[RPX_CSRF_TOKEN] != $csrf_token) {
    echo 'CSRF detected';
    die();
  }
}

function rpx_options_page_url() {
  return get_option('siteurl') . '/blogAdmin/options-general.php?page=rpx/rpx.php';
}

function rpx_redirect_to_options_page($msg='') {
  $url = rpx_options_page_url();
  $url .= '&rpxmsg='.urlencode($msg);
  echo <<<EOF
<script type="text/javascript">window.location='$url';</script>
EOF;
}

//Added for handling existing email account detection.##FWB##
function rpx_login_page_url() {
  return get_option('siteurl') . '/wp-login.php';
}

function rpx_redirect_to_login_page($msg='') {
  $url = rpx_login_page_url();
  $url .= '?rpxmsg='.urlencode($msg);
  echo <<<EOF
<script type="text/javascript">window.location='$url';</script>
EOF;
}
//##FWB##

function rpx_options_page() {
  global $current_user;
  $wpuser = $current_user;

  rpx_handle_options_page_submit();

  $is_configured = rpx_is_configured();
 
  $rpx_api_key = get_option(RPX_API_KEY_OPTION);
  $rpx_realm = get_option(RPX_REALM_OPTION);
  $rpx_admin_url = get_option(RPX_ADMIN_URL_OPTION);
  $rpx_api_key_name = RPX_API_KEY_OPTION;

  $rpx_comments_auth = get_option(RPX_COMMENTS_AUTH_OPTION);
  if (is_null($rpx_comments_auth == null)) $rpx_comments_auth = RPX_COMMENTS_AUTH_OPTION_DEFAULT;

  $rpx_comments_hint = get_option(RPX_COMMENTS_HINT_OPTION);
  if (is_null($rpx_comments_hint)) $rpx_comments_hint = RPX_COMMENTS_HINT_OPTION_DEFAULT;


  // protect the form we're about to render
  $csrf_token = strval(rand());
  update_option(RPX_CSRF_TOKEN, $csrf_token);
  
  $form_action = rpx_options_page_url();

  if ($_GET['rpxmsg']){ 
    $message = '';
    switch($_GET['rpxmsg']){
      case 'success':
        $message = 'Success! RPX sign-in is now activated for your blog.';
        break;
      case 'error':
        $message = 'An error occured, please try again.';
        break;
      case 'cleared':
        $message = 'Configuration cleared.  RPX sign-in is not activated.';
        break;
    }
    echo rpx_message($message);
  }

  // draw the page
  echo '<div class="wrap">';
  echo '<h2>RPX Dashboard</h2>';

  if ($is_configured) {
    echo '<h3>RPX is <span style="color:green;">activated</span> for <a href="'.$rpx_admin_url.'">'.$rpx_realm . '</a></h3>';
    echo <<<EOF
<form id="clear_form" action="$form_action" method="post">
<input type="hidden" name="rpx_submit" value="Y" />
<input type="hidden" name="rpx_clear_config" value="Y" />
<input type="hidden" name="rpx_csrf_token" value="$csrf_token" />
</form>
<p>If you haven't already, you may activate Facebook, Twitter, MySpace and Windows Live ID authentication support from your RPX control panel by clicking the link above.</p>
EOF;
    
    $identifier = get_usermeta($wpuser->ID, 'rpx_identifier');
    if(!$identifier) {
      echo '<div class="updated" style="padding:10px;margin-bottom:10px;width:30em;"><a href="'.get_option('siteurl').'/blogAdmin/profile.php#rpx'.'">Click here</a> to bind an OpenID to your Wordpress account.</div>';
          }

$cauth = $rpx_comments_auth ? 'checked="true"': '';
$chint = $rpx_comments_hint ? 'checked="true"': '';


  echo <<<EOF
<h2>RPX Options</h2>
<hr/>
<form id="clear_form" action="$form_action" method="post">
<input type="hidden" name="rpx_submit" value="Y" />
<input type="hidden" name="rpx_comment_settings" value="Y" />
<input type="hidden" name="rpx_csrf_token" value="$csrf_token" />

<p>
<input type="checkbox" name="rpx_comments_auth" $cauth /> <b>Require RPX authentication for comments</b>
<div style="margin-left:2em;">Checking this option will require each commenter on your blog to first verify themselves using RPX.  This will disable anonymous comments.</div>
</p>
<p>
<input type="checkbox" name="rpx_comments_hint" $chint /> <b>Insert RPX comment hints into my page automatically</b>
<div style="margin-left:2em;">
</p>
RPX can automatically insert markup into the comments section of your page like this:

<br/><br/>
EOF;

rpx_comment_hint(false);

echo <<<EOF
<script type="text/javascript">
document.getElementById('rpx_comment_hint').style.display = 'block';
</script>
<br/><br/>
If that does not work properly with your theme, or if you need greater control, you may use the <code>rpx_comment_hint(false)</code> function from your templates. It will insert the above markup into your tempate wherever you put it.  To do your own custom integration, see the <a href="$rpx_admin_url/quickstart" target="_blank">Quick Start</a> guide on RPX.
</div>

<br/><span class="submit"><input type="submit" value="Save Comment Options"/></span>
</form>


<h2>Disable RPX support</h2>
<hr/>
<p style="font-size:smaller;">To disable RPX support, <a href="javascript:if(confirm('Really disable RPX? Any users who have signed in will not be able to log in again.')){document.getElementById('clear_form').submit();}">click here</a>
</p>
EOF;
   
  } else { 

echo <<<EOF
<h3>Welcome to the RPX Wordpress Plugin!</h3>

<form name="form2" method="post" action="$form_action">
<input type="hidden" name="rpx_submit" value='Y' />
<input type="hidden" name="rpx_csrf_token" value="$csrf_token" />
<p>If you have already created a site on <a href="https://rpxnow.com/" target="_blank">rpxnow.com</a> for your blog, please enter the API key below.</p>
<p>
<b>RPX API Key</b>:
<input type="text" size="40" name="$rpx_api_key_name" value="$rpx_api_key" />
<span class="submit">
<input type="submit" name="Submit" value="Save"/>
</span>
</p>
</form>

<hr/>

<form name="form1" method="post" action="$form_action">
<p>
Or, <span class="submit"><input type="submit" class="button-primary" value="Get an RPX API Key" /></span> and begin configuration of your blog.
</p>
<input type="hidden" name="rpx_submit" value='Y' />
<input type="hidden" name="rpx_auto_config" value='Y' />
<input type="hidden" name="rpx_csrf_token" value="$csrf_token" />
</form>
EOF;

  }

  echo '</div>';

}

function rpx_clear_config() {
  update_option(RPX_API_KEY_OPTION, null);
  update_option(RPX_REALM_OPTION, null);
  update_option(RPX_ADMIN_URL_OPTION, null);
}

function rpx_is_configured() {
  $api_key = get_option(RPX_API_KEY_OPTION); 
  $realm = get_option(RPX_REALM_OPTION);
  $realm_scheme = get_option(RPX_REALM_SCHEME);
  return !empty($api_key) && !empty($realm) && !empty($realm_scheme);
}

function rpx_token_url() {
  $url = get_option('home');

  /* make sure there is a trailing slash */
  if ($url[-1] != '/') {
    $url .= '/';
  } 
  $token_url = $url . '?rpx_response=1';
  
  /* if we're not at the login page, define a goback to the page we are on */
  if (strpos($_SERVER['REQUEST_URI'], 'wp-login.php') == false) {

      $redirect_to = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
  /* otherwise, go to the admin apge */
  } else {
    
    if($_GET['redirect_to']) {
      $redirect_to = $_GET['redirect_to'];
    } else {
      $redirect_to = $_SERVER['HTTP_REFERER']; //$url . '/blogAdmin/';    
    }

  }

  return $token_url . '&redirect_to=' . urlencode($redirect_to);
}

function rpx_message($message) {
  return <<<EOF
<div class="updated"><p><strong>$message</strong></p></div>
EOF;
}

rpx_init();
?>
