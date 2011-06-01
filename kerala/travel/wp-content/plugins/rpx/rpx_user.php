<?php
// via
// http://planetozh.com/blog/2008/07/what-plugin-coders-must-know-about-wordpress-26/
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
require_once($root . '/wp-content/plugins/rpx/CustomerManagement.php');
//initialize user info globals##FWB##
global $current_user;
get_currentuserinfo();


function rpx_signin_user($auth_info) {
  global $current_user;
  $identifier = $auth_info['profile']['identifier'];    
  $email = $auth_info['profile']['email'];
  if ( $email == '' ){
    $rpx_msg = 'noemail';
    rpx_redirect_to_login_page($rpx_msg);
  }else{
    if ( $current_user instanceof WP_User ){//Only bother if we can get the user object data.##FWB##
      if ( $current_user->ID == 0 ){
        $wpuid = rpx_get_wpuid_by_identifier($identifier);
        if (!$wpuid){
          if (email_exists($email)){//Check for existing email to direct user to login and link to RPX.##FWB##
           /* $rpx_msg = 'email';
            rpx_redirect_to_login_page($rpx_msg); */ 
          	$wpuid=rpx_get_wpuid_by_email($email);
				$wpuid=rpx_update_wp_user($auth_info,$wpuid);				
				rpx_upgrade_user($auth_info, $wpuid);
            	
          }else{//No existing rpx or email, create new user.##FWB##
            $wpuid = rpx_create_wp_user($auth_info);
          }
        }
      }else{//User is logged in and is not setup with RPX token so upgrade the usermeta. I doubt this will ever get called.##FWB##
        wp_set_auth_cookie($wpuid, true, false);
        wp_set_current_user($wpuid);
        get_currentuserinfo();
        $wpuid = rpx_upgrade_user($auth_info, $current_user->ID);
      }

     // echo "Test"."wordpress_logged_in_provider_".COOKIEHASH."".$auth_info['profile']["providerName"];
       setcookie("wordpress_logged_in_provider_".COOKIEHASH,$auth_info['profile']["providerName"],time()+ 1209600,"/");
    
      if($auth_info['profile']["providerName"]=="Facebook")
      {
      	$outhSplit=str_split($auth_info['accessCredentials']["accessToken"],30);
		for($i=0;$i<count($outhSplit);$i++)
	{
	 setcookie("oauth_".$i,$outhSplit[$i],time() + 1209600,"/");	
	}	
	setcookie("oauth_length",count($outhSplit),time()+ 1209600,"/");
	  	
      }
   
  /* echo "SELECT user_registered FROM $wpdb->users where ID=".$wpuid;  
	 $usernames = $wpdb->get_results("SELECT user_registered FROM $wpdb->users where ID=".$wpuid);
	 
	 var_dump($usernames);
	 die();   */
		
        
		      /* sign the user in */
		  makeWebserviceCall($wpuid,$auth_info['profile']);
      wp_set_auth_cookie($wpuid, true, false);
      wp_set_current_user($wpuid);
   	  get_currentuserinfo();
   	  
    }
    
    
  }
  rpx_redirect();//Broke redirect into a function##FWB##
  die();
}

function makeWebserviceCall($wpUserID,$janrainObj)
{

	  global $wpdb;
  $sql = "SELECT user_registered FROM $wpdb->users where ID=%s";
  $r = $wpdb->get_var($wpdb->prepare($sql, $wpUserID));
  $cms=new CustomerManagement();
  $customer=new Customer();
  $customerLogin=new CustomerLogin();
  $customer->customerName=$janrainObj["name"]["formatted"];
  $customerLogin->LoginId=$janrainObj["email"];
  $customerLogin->LoginDomain=strtoupper($clean = preg_replace("/^[^a-z0-9]?(.*?)[^a-z0-9]?$/i", "$1", $janrainObj["providerName"]));
  $customerLogin->LoginSetupOnDate=date("Y-m-d",strtotime($r)) . 'T' . date("H:i:s",strtotime($r));
  $customer->customerLoginDetails=array($customerLogin);
  $recordLogin=new recordLogin();
  $recordLogin->customer=$customer;
  $responce=new recordLoginResponse();
 
  $responce=$cms->recordLogin($recordLogin);
  error_log($responce->recordLoginResult);
        return;
}
function rpx_redirect(){//Redirect as a function.##FWB##
  /* redirect them back to the page they were originally on */
  if ( isset( $_REQUEST['redirect_to'] ) ) {
      $redirect_to = $_REQUEST['redirect_to'];
      if(!strpos($redirect_to, 'blogAdmin')){
          $redirect_to = $_REQUEST['redirect_to'];
      }else{
        $redirect_to = admin_url();
      }
  }else{
    $redirect_to = get_option('home');
  }
  wp_safe_redirect($redirect_to);
  return;
}

function rpx_upgrade_user($auth_info,$current_user_id){//Created function to add RPX usermeta to account enabling RPX.##FWB##
 	$rpx_id = $auth_info['profile']['identifier'];
  if ( $rpx_id != '' ){
	    $result = update_user_meta($current_user_id, 'rpx_identifier', $rpx_id);
  }
 
  if ( $result == true ){
    return $current_user_id;
  }else{
   // return false;
  }
}

function rpx_get_wpuid_by_identifier($identifier) {
  global $wpdb;
  $sql = "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'rpx_identifier' AND meta_value = %s";
  $r = $wpdb->get_var($wpdb->prepare($sql, $identifier));
  
  if ($r) {
    return $r;
  } else {
    return null;
  }
}

function rpx_get_wpuid_by_email($email) {
  global $wpdb;
  $sql = "SELECT ID FROM $wpdb->users WHERE user_email = %s";
  $r = $wpdb->get_var($wpdb->prepare($sql, $email));
  
  if ($r) {
    return $r;
  } else {
    return null;
  }
}



function rpx_get_identifier_by_wpuid($wpuid) {
  return get_usermeta($wpuid, 'rpx_identifier');
}

function rpx_get_user_login_name($identifier) {
  return 'rpx'.md5($identifier);
}

function rpx_username_taken($username) {
  $user = get_userdatabylogin($username);
  return $user != false;
}

// create a new user based on the 
function rpx_create_wp_user($auth_info) {
  $p = $auth_info['profile'];
  $rid = $p['identifier'];
  $provider_name = $p['providerName'];

  $username = $p['preferredUsername'];
  if(!$username or rpx_username_taken($username)) {
    $username = rpx_get_user_login_name($rid);
  }   

  $last_name = null;
  $first_name = null;
  if($p['name']) {
    $first_name = $p['name']['givenName'];
    $last_name = $p['name']['familyName'];
  }

  $userdata = array(
     'user_pass' => wp_generate_password(),
     'user_login' => $username,
     'display_name' => $p['displayName'],
     'user_url' => $p['url'],
     'user_email' => $p['email'],
     'first_name' => $first_name,
     'last_name' =>  $last_name,
     'nickname' => $p['displayName']);
  
  $wpuid = wp_insert_user($userdata);
  if ( ! is_wp_error($wpuid) && is_int($wpuid) ) { //Updated error checking to account for object error handling.##FWB##
    update_usermeta($wpuid, 'rpx_identifier', $rid);
  }
  return $wpuid;
}

function rpx_update_wp_user($auth_info,$userID)
{
	$p = $auth_info['profile'];
  $rid = $p['identifier'];
  $provider_name = $p['providerName'];

   

  $last_name = null;
  $first_name = null;
  if($p['name']) {
    $first_name = $p['name']['givenName'];
    $last_name = $p['name']['familyName'];
  }

  $userdata = array( 
  	'ID'			=> $userID,   
     'display_name' => $p['displayName'],
     'user_url' => $p['url'],
     'user_email' => $p['email'],
     'first_name' => $first_name,
     'last_name' =>  $last_name,
     'nickname' => $p['displayName']);
 
  $wpuid = wp_update_user($userdata);
  return $wpuid;
}

function rpx_edit_user_page() {
  global $current_user;
  $user = $current_user;
  $rpx_identifier = $user->rpx_identifier;
  $login_provider = $user->rpx_provider;
 
  echo '<h3 id="rpx">Sign-in Provider</h3>';
  
  if ($rpx_identifier) {
    
    // extract the provider domain
    $pieces = explode('/', $rpx_identifier);
    $host = $pieces[2];

    echo '<p>You are currently using <b>'. $host .'</b> as your sign-in provider.  You may change this by choosing a different provider or OpenID below and clicking "Sign-In."</p>';

  } else {
    
    echo '<p>You can sign in to this blog without a password by choosing a provider below.</p>';

  }

  $token_url_params = '&attach_to=' . $user->ID;

  rpx_iframe('border:1px solid #aaa;padding:2em;background-color:white;',
	     $token_url_params);
}


?>
