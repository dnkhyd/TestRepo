<?php
/*
Plugin Name: Facebook Social Plugins
Plugin URI: http://olussier.net/demo/facebook-social-plugins/
Description: Provides Facebook Social Plugins as widgets and Like button in articles 
Version: 1.2.3
Author: Olivier Lussier
Author URI: http://olussier.net
License: GPL2


Copyright 2010  Olivier Lussier  (email : olivier@olussier.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

/*** Widgets ***/
include("widgets/like-button.php");
include("widgets/activity-feed.php");
include("widgets/like-box.php");
include("widgets/recommendations.php");
include("widgets/comments.php");

#include("widgets/facepile.php");
#include("widgets/live-stream.php");
#include("widgets/login-button.php");

$options = get_option('olussier-facebook-social-plugins');

add_action('widgets_init', create_function('', 'return register_widget("OlussierFSP_Activity");'));
add_action('widgets_init', create_function('', 'return register_widget("OlussierFSP_LikeButton");'));
add_action('widgets_init', create_function('', 'return register_widget("OlussierFSP_LikeBox");'));
add_action('widgets_init', create_function('', 'return register_widget("OlussierFSP_Recommendations");'));
   
if (!empty($options['application_id'])) {
	add_action('widgets_init', create_function('', 'return register_widget("OlussierFSP_Comments");'));
}

/*** Plugin ***/
class OlussierFacebookSocialPlugins { 
  var $defaultSettings = array('application_id' => "",
                               'like_before_layout' => "standard",
                               'like_before_show_faces' => "yes",
                               'like_before_action' => "like",
                               'like_before_colorscheme' => "light",
                               'like_after_layout' => "standard",
                               'like_after_show_faces' => "yes",
                               'like_after_action' => "like",
                               'like_after_colorscheme' => "light",
                               'like_show_main' => "after",
                               'like_show_post' => "after",
                               'like_show_page' => "after",
                               'like_show_page_not' => "",
                               'like_show_category' => "after",
                               'like_show_tag' => "after",
                               'like_show_date' => "after",
                               'like_show_author' => "after",
                               'like_show_search' => "after"
  );
    
	function OlussierFacebookSocialPlugins() {
		$this->CheckOptions();
	  add_action('admin_menu', array(&$this, 'SettingsMenu'));
	  add_filter('language_attributes', array(&$this, 'AddNamespace'));
	  add_action('wp_head', array(&$this, 'AddMetas'));
	  add_filter('the_content', array(&$this, 'LikeButton'));
	  add_action('wp_footer', array(&$this, 'Footer'));
	}
	
	function CheckOptions() {
		$currentOptions = get_option('olussier-facebook-social-plugins');

		if (!is_array($currentOptions)) {
			$currentOptions = array();
		}
				
		// Old options
	  if (array_key_exists('show_like',$currentOptions)) {
      $currentOptions['like_show_post'] = ($currentOptions['show_like'] == "yes" ? "after" : "none"); 
      $currentOptions['like_show_page'] = ($currentOptions['show_like'] == "yes" ? "after" : "none"); 
      $currentOptions['like_after_show_faces'] = $currentOptions['like_show_faces'];
      $currentOptions['like_after_action'] = $currentOptions['like_action'];
      $currentOptions['like_after_colorscheme'] = $currentOptions['like_colorscheme'];
    }
    
    $options = array();
    foreach ($this->defaultSettings as $key => $default) {
    	if (array_key_exists($key,$currentOptions)) {
    		$options[$key] = $currentOptions[$key];
    	} else {
    		$options[$key] = $default;
    	}
    }
	  
	  update_option('olussier-facebook-social-plugins',$options);
	}
	 
	function SettingsMenu() {
		add_options_page('Facebook Social Plugins Options', 'FB Social Plugins', 'administrator', 'olussier-facebook-social-plugins-options', array(&$this, 'Settings'));
	}
	
	function AddNamespace($output) {
		$options = get_option('olussier-facebook-social-plugins');
    
    if (!empty($options['application_id'])) {
    	$output = "xmlns:og=\"http://opengraphprotocol.org/schema/\" xmlns:fb=\"http://www.facebook.com/2008/fbml\" ".$output;
    }
    
    return $output;
	}
	
	function AddMetas() {		
		if (is_single() || is_page()) {
			global $post;
			
			if($post->ID == "249"|| $post->ID == "247" || $post->ID == "235" || $post->ID == "252")
			{
				$og_con = "City"; //destination
			}
			else if($post->ID == "256" || $post->ID == "145" || $post->ID == "254" || $post->ID == "101")
			{
				$og_con = "Activity"; //Experience
			}
			else 
			{
				$og_con = "Article"; //Blog
			}
			
		  echo "<meta property=\"og:site_name\" content=\"".wp_specialchars(get_option('blogname'))."\" />\r\n";
      echo "<meta property=\"og:title\" content=\"".wp_specialchars($post->post_title)."\" />\r\n";
//      echo "<meta property=\"og:type\" content=\"article\" />\r\n";
      echo "<meta property=\"og:type\" content=\"".$og_con."\" />\r\n";
      echo "<meta property=\"og:url\" content=\"".get_permalink()."\" />\r\n";
      echo '<meta property="fb:admins" content="1596446139" />';
      
      
      $imgs = $this->getImages();
      if (count($imgs) > 0) {
      	echo "<meta property=\"og:image\" content=\"".wp_get_attachment_thumb_url($imgs[0]->ID)."\" />\r\n";
      }
		}
	}
	
	function getImages() {
		global $post;
		$imgs = get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID);
		if (is_array($imgs)) {
		  return array_values($imgs);
		} else {
			return array();
		}
	}
	
	function LikeButton($content) {	
		$options = get_option('olussier-facebook-social-plugins');
		   		
		$display = "none";
	  if (is_home()) { $display = $options['like_show_main']; }
	  else if (is_single()) { $display = $options['like_show_post']; }
	  else if (is_page() && !is_page(explode(",",$options['like_show_page_not']))) { $display = $options['like_show_page']; }
		else if (is_category()) { $display = $options['like_show_category']; }
    else if (is_tag()) { $display = $options['like_show_tag']; }
    else if (is_author()) { $display = $options['like_show_author']; }
    else if (is_date()) { $display = $options['like_show_date']; }
    else if (is_search()) { $display = $options['like_show_search']; }
		
	  if (($display == "before") || ($display == "both")) {
      $tag = "";
	    if (!empty($options['application_id'])) {
	      $tag .= "\r\n<p class=\"FacebookLikeButton\"><fb:like href=\"";
	      $tag .= urlencode(get_permalink());
	      $tag .= "\" layout=\"";
	      $tag .= $options['like_before_layout'];
	      $tag .= "\" show_faces=\"";
	      $tag .= $options['like_before_show_faces'];
	      $tag .= "\" width=\"450\" action=\"";
	      $tag .= $options['like_before_action'];
	      $tag .= "\" colorscheme=\"";
	      $tag .= $options['like_before_colorscheme'];
	      $tag .= "\"></fb:like></p>\r\n";
	    } else {
	    	$height = ($options['like_before_show_faces'] == "true" ? 60 : 25);
	      $tag .= "\r\n<p class=\"FacebookLikeButton\"><iframe src=\"http://www.facebook.com/plugins/like.php?href=";
	      $tag .= urlencode(get_permalink());
	      $tag .= "&layout=";
	      $tag .= $options['like_before_layout'];
	      $tag .= "&show_faces=";
	      $tag .= $options['like_before_show_faces'];
	      $tag .= "&width=450&action=";
	      $tag .= $options['like_before_action'];
	      $tag .= "&colorscheme=";
	      $tag .= $options['like_before_colorscheme'];
	      $tag .= "&locale=";
	      $tag .= OlussierFacebookSocialPlugins::GetLanguage();
	      $tag .= "\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" style=\"border:none; overflow:hidden; width:450px; height: ";
	      $tag .= $height;
	      $tag .= "px\"></iframe></p>\r\n";
	    }
    
      $content = $tag.$content;
    }
    
	  if (($display == "after") || ($display == "both")) {
	    $tag = "";
      if (!empty($options['application_id'])) {
        $tag .= "\r\n<p class=\"FacebookLikeButton\"><fb:like href=\"";
        $tag .= urlencode(get_permalink());
        $tag .= "\" layout=\"";
        $tag .= $options['like_after_layout'];
        $tag .= "\" show_faces=\"";
        $tag .= $options['like_after_show_faces'];
        $tag .= "\" width=\"450\" action=\"";
        $tag .= $options['like_after_action'];
        $tag .= "\" colorscheme=\"";
        $tag .= $options['like_after_colorscheme'];
        $tag .= "\"></fb:like></p>\r\n";
      } else {
      	$height = ($options['like_before_show_faces'] == "true" ? 60 : 25);
        $tag .= "\r\n<p class=\"FacebookLikeButton\"><iframe src=\"http://www.facebook.com/plugins/like.php?href=";
        $tag .= urlencode(get_permalink());
        $tag .= "&layout=";
        $tag .= $options['like_after_layout'];
        $tag .= "&show_faces=";
        $tag .= $options['like_after_show_faces'];
        $tag .= "&width=450&action=";
        $tag .= $options['like_after_action'];
        $tag .= "&colorscheme=";
        $tag .= $options['like_after_colorscheme'];
        $tag .= "&locale=";
        $tag .= OlussierFacebookSocialPlugins::GetLanguage();
        $tag .= "\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" style=\"border:none; overflow:hidden; width:450px; height: ";
        $tag .= $height;
        $tag .= "px\"></iframe></p>\r\n";
      }
      
      $content .= $tag;
    }
    
		return $content;
	}
	
	function Footer() {
		$options = get_option('olussier-facebook-social-plugins');
		
		if (!empty($options['application_id'])) {
			?>
<!-- Facebook Social Plugins -->
<div id="fb-root"></div>
<script type="text/javascript">
  window.fbAsyncInit = function() { FB.init({appId: '<?php echo $options['application_id']; ?>', status: true, cookie: true, xfbml: true}); };
  (function() {
    var e = document.createElement('script');
    e.type = 'text/javascript';
    e.src = document.location.protocol + '//connect.facebook.net/<?php echo OlussierFacebookSocialPlugins::GetLanguage(); ?>/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
<?php
		}
	}
	
	function GetLanguage() {
		$fbLangs = array('af' => array('af_ZA'),'ar' => array('ar_AR'),'bg' => array('bg_BG'),'bn' => array('bn_IN'),'ca' => array('ca_ES'),'cs' => array('cs_CZ'),'cy' => array('cy_GB'),'da' => array('da_DK'),'de' => array('de_DE'),'el' => array('el_GR'),'en' => array('en_US','en_GB','en_UD'),'es' => array('es_LA','es_ES'),'fi' => array('fi_FI'),'fr' => array('fr_FR','fr_CA'),'he' => array('he_IL'),'hi' => array('hi_IN'),'hr' => array('hr_HR'),'hu' => array('hu_HU'),'id' => array('id_ID'),'it' => array('it_IT'),'ja' => array('ja_JP'),'ko' => array('ko_KR'),'lt' => array('lt_LT'),'ml' => array('ml_IN'),'ms' => array('ms_MY'),'nb' => array('nb_NO'),'nl' => array('nl_NL'),'pa' => array('pa_IN'),'pl' => array('pl_PL'),'pt' => array('pt_PT','pt_BR'),'ro' => array('ro_RO'),'ru' => array('ru_RU'),'sk' => array('sk_SK'),'sl' => array('sl_SI'),'sr' => array('sr_RS'),'sv' => array('sv_SE'),'ta' => array('ta_IN'),'te' => array('te_IN'),'th' => array('th_TH'),'tl' => array('tl_PH'),'tr' => array('tr_TR'),'vi' => array('vi_VN'),'zh' => array('zh_CN','zh_TW','zh_HK'));
		
		$wpLang = get_bloginfo('language');

		if (strlen($wpLang) >= 2) {
			$langCode = substr($wpLang,0,2);
		
			if (array_key_exists($langCode,$fbLangs)) {
				$pos = array_search(str_replace("-","_",$wpLang),$fbLangs[$langCode]);
				if ($pos === false) {
					$pos = 0;
				}
				$lang = $fbLangs[$langCode][$pos];
			} else {
				$lang = "en_US";
			}
		} else {
			$lang = "en_US";
		}		
		return $lang;
	}
	
	function Settings() {
		$options = get_option('olussier-facebook-social-plugins');
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      foreach ($_POST as $key => $val) {
      	$options[$key] = trim($val);
      }     
      
      update_option('olussier-facebook-social-plugins',$options);
      echo "<div id=\"message\" class=\"updated fade\"><p><strong>Settings saved.</strong></p></div>\r\n";
		}
?>
<div class="wrap">
<h2>Facebook Social Plugins</h2>

<form method="post">
<h3>General</h3>
<table class="form-table">
<tr>
  <th>Facebook Application ID:</th>
  <td>
    <input type="text" name="application_id" value="<?php echo wp_specialchars($options['application_id']); ?>" />
    <span class="description">Required to use XFBML. Don't have one? Easily get one <a href="http://developers.facebook.com/setup/" target="_blank">here</a>.</span>
  </td>
</tr>
</table>
<h3>Like Button</h3>
<h4>Style</h4>
<table class="form-table">
<tr>
  <th>Top of article:</th>
  <td>
    <table class="form-table">
    <tr>
      <th>Layout</th>
      <td>
        <select name="like_before_layout">
          <option value="standard"<?php echo ($options['like_before_layout'] == "standard" ? " selected" : ""); ?>>Standard</option>
          <option value="button_count"<?php echo ($options['like_before_layout'] == "button_count" ? " selected" : ""); ?>>Button & count</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Show faces</th>
      <td>
        <select name="like_before_show_faces">
          <option value="true"<?php echo ($options['like_before_show_faces'] == "true" ? " selected" : ""); ?>>Yes</option>
          <option value="false"<?php echo ($options['like_before_show_faces'] == "false" ? " selected" : ""); ?>>No</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Action</th>
      <td>
        <select name="like_before_action">
          <option value="like"<?php echo ($options['like_before_action'] == "like" ? " selected" : ""); ?>>Like</option>
          <option value="recommend"<?php echo ($options['like_before_action'] == "recommend" ? " selected" : ""); ?>>Recommend</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Color scheme</th>
      <td>
        <select name="like_before_colorscheme">
          <option value="light"<?php echo ($options['like_before_colorscheme'] == "light" ? " selected" : ""); ?>>Light</option>
          <option value="dark"<?php echo ($options['like_before_colorscheme'] == "dark" ? " selected" : ""); ?>>Dark</option>
        </select>
      </td>
    </tr>
    </table>
  </td>
</tr>
<tr>
  <th>Bottom of article:</th>
  <td>
    <table class="form-table">
    <tr>
      <th>Layout</th>
      <td>
        <select name="like_after_layout">
          <option value="standard"<?php echo ($options['like_after_layout'] == "standard" ? " selected" : ""); ?>>Standard</option>
          <option value="button_count"<?php echo ($options['like_after_layout'] == "button_count" ? " selected" : ""); ?>>Button & count</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Show faces</th>
      <td>
        <select name="like_after_show_faces">
          <option value="true"<?php echo ($options['like_after_show_faces'] == "true" ? " selected" : ""); ?>>Yes</option>
          <option value="false"<?php echo ($options['like_after_show_faces'] == "false" ? " selected" : ""); ?>>No</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Action</th>
      <td>
        <select name="like_after_action">
          <option value="like"<?php echo ($options['like_after_action'] == "like" ? " selected" : ""); ?>>Like</option>
          <option value="recommend"<?php echo ($options['like_after_action'] == "recommend" ? " selected" : ""); ?>>Recommend</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Color scheme</th>
      <td>
        <select name="like_after_colorscheme">
          <option value="light"<?php echo ($options['like_after_colorscheme'] == "light" ? " selected" : ""); ?>>Light</option>
          <option value="dark"<?php echo ($options['like_after_colorscheme'] == "dark" ? " selected" : ""); ?>>Dark</option>
        </select>
      </td>
    </tr>
    </table>
  </td>
</tr>
</table>

<h4>Where to show</h4>
<table class="form-table">
<tr>
  <th>Main page:</th>
  <td>
	  <select name="like_show_main">
	    <option value="none">Hide</option>
	    <option value="before"<?php echo ($options['like_show_main'] == "before" ? " selected" : ""); ?>>Top of article</option>
	    <option value="after"<?php echo ($options['like_show_main'] == "after" ? " selected" : ""); ?>>Bottom of article</option>
	    <option value="both"<?php echo ($options['like_show_main'] == "both" ? " selected" : ""); ?>>Both</option>
	  </select>
  </td>
</tr>
<tr>
  <th>Individual posts:</th>
  <td>
	  <select name="like_show_post">
	    <option value="none">Hide</option>
	    <option value="before"<?php echo ($options['like_show_post'] == "before" ? " selected" : ""); ?>>Top of article</option>
	    <option value="after"<?php echo ($options['like_show_post'] == "after" ? " selected" : ""); ?>>Bottom of article</option>
	    <option value="both"<?php echo ($options['like_show_post'] == "both" ? " selected" : ""); ?>>Both</option>
	  </select>
  </td>
</tr>
<tr>
  <th>Pages:</th>
  <td>
	  <select name="like_show_page">
	    <option value="none">Hide</option>
	    <option value="before"<?php echo ($options['like_show_page'] == "before" ? " selected" : ""); ?>>Top of article</option>
	    <option value="after"<?php echo ($options['like_show_page'] == "after" ? " selected" : ""); ?>>Bottom of article</option>
	    <option value="both"<?php echo ($options['like_show_page'] == "both" ? " selected" : ""); ?>>Both</option>
	  </select>
	  <span class="description">Optionally enter a comma-separated list of page IDs where not to show it:</span>
	  <input type="text" name="like_show_page_not" value="<?php echo wp_specialchars($options['like_show_page_not']); ?>" />
  </td>
</tr>
<tr>
  <th>Category archives:</th>
  <td>
	  <select name="like_show_category">
	    <option value="none">Hide</option>
	    <option value="before"<?php echo ($options['like_show_category'] == "before" ? " selected" : ""); ?>>Top of article</option>
	    <option value="after"<?php echo ($options['like_show_category'] == "after" ? " selected" : ""); ?>>Bottom of article</option>
	    <option value="both"<?php echo ($options['like_show_category'] == "both" ? " selected" : ""); ?>>Both</option>
	  </select>
  </td>
</tr>
<tr>
  <th>Tag archives:</th>
  <td>
	  <select name="like_show_tag">
	    <option value="none">Hide</option>
	    <option value="before"<?php echo ($options['like_show_tag'] == "before" ? " selected" : ""); ?>>Top of article</option>
	    <option value="after"<?php echo ($options['like_show_tag'] == "after" ? " selected" : ""); ?>>Bottom of article</option>
	    <option value="both"<?php echo ($options['like_show_tag'] == "both" ? " selected" : ""); ?>>Both</option>
	  </select>
  </td>
</tr>
<tr>
  <th>Date-based archives:</th>
  <td>
	  <select name="like_show_date">
	    <option value="none">Hide</option>
	    <option value="before"<?php echo ($options['like_show_date'] == "before" ? " selected" : ""); ?>>Top of article</option>
	    <option value="after"<?php echo ($options['like_show_date'] == "after" ? " selected" : ""); ?>>Bottom of article</option>
	    <option value="both"<?php echo ($options['like_show_date'] == "both" ? " selected" : ""); ?>>Both</option>
	  </select>
  </td>
</tr>
<tr>
  <th>Author archives:</th>
  <td>
	  <select name="like_show_author">
	    <option value="none">Hide</option>
	    <option value="before"<?php echo ($options['like_show_author'] == "before" ? " selected" : ""); ?>>Top of article</option>
	    <option value="after"<?php echo ($options['like_show_author'] == "after" ? " selected" : ""); ?>>Bottom of article</option>
	    <option value="both"<?php echo ($options['like_show_author'] == "both" ? " selected" : ""); ?>>Both</option>
	  </select>
  </td>
</tr>
<tr>
  <th>Search results:</th>
  <td>
	  <select name="like_show_search">
	    <option value="none">Hide</option>
	    <option value="before"<?php echo ($options['like_show_search'] == "before" ? " selected" : ""); ?>>Top of article</option>
	    <option value="after"<?php echo ($options['like_show_search'] == "after" ? " selected" : ""); ?>>Bottom of article</option>
	    <option value="both"<?php echo ($options['like_show_search'] == "both" ? " selected" : ""); ?>>Both</option>
	  </select>
  </td>
</tr>
</table>

<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>

</form>
</div>

<?php
	}
}

add_action('init', create_function('', '$widget = new OlussierFacebookSocialPlugins();'));

?>