<?php
class OlussierFSP_LikeBox extends WP_Widget {

  function OlussierFSP_LikeBox() {
    parent::WP_Widget(false, "FB Like Box", array('description' => "Enables Facebook Page owners to attract and gain Likes from their own website."));  
  }

  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    echo $before_widget;
    if ($title) { echo $before_title.$title.$after_title; }
 
    $pageId = $instance['pageid'];
    $width = (intval($instance['width']) > 0 ? intval($instance['width']) : 300);
    $height = (intval($instance['height']) > 0 ? intval($instance['height']) : 0);
    $connections = intval($instance['connections']);
    $showHeader = ($instance['showheader'] == "true" ? "true" : "false");
    $showStream = ($instance['showstream'] == "true" ? "true" : "false");
      
    $options = get_option('olussier-facebook-social-plugins');
    if (!empty($options['application_id'])) {
    	echo "<fb:like-box profile_id=\"";
      echo $pageId;
      echo "\" width=\"";
      echo $width;
      if ($height) {
	      echo "\" height=\"";
	      echo $height;
      }
      echo "\" connections=\"";
      echo $connections;
      echo "\" stream=\"";
      echo $showStream;
      echo "\" header=\"";
      echo $showHeader;
      echo "\"></fb:like-box>\r\n";
    } else {
      echo "<iframe src=\"http://www.facebook.com/plugins/likebox.php?profile_id=";
      echo $pageId;
      echo "&amp;width=";
      echo $width;
      if ($height) {
        echo "&amp;height=";
        echo $height;
      }
      echo "&amp;connections=";
      echo $connections;
      echo "&amp;stream=";
      echo $showStream;
      echo "&amp;header=";
      echo $showHeader;
      echo "&amp;locale=";
      echo OlussierFacebookSocialPlugins::GetLanguage();
      echo "\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" style=\"border:none; overflow:hidden; width:";
      echo $width;
      if ($height) {
	      echo "px; height:";
	      echo $height;
      }
      echo "px\"></iframe>\r\n";
    }
        
    echo $after_widget;
  }
  
  function update($new_instance, $old_instance) {       
    return $new_instance;
  }
  
  function form($instance) {
  if (array_key_exists('title',$instance)) {
      $title = esc_attr($instance['title']);
    } else {
      $title = "Find us on Facebook";
    }
    
    if (!array_key_exists('connections',$instance)) {
      $instance['connections'] = 10;
    }
    
    echo "<p><label for=\"".$this->get_field_id('title')."\">"._e('Title:')." <input class=\"widefat\" id=\"".$this->get_field_id('title')."\" name=\"".$this->get_field_name('title')."\" type=\"text\" value=\"".wp_specialchars($title)."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('pageid')."\">"._e('Facebook Page ID:')." <input class=\"widefat\" id=\"".$this->get_field_id('pageid')."\" name=\"".$this->get_field_name('pageid')."\" type=\"text\" value=\"".wp_specialchars($instance['pageid'])."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('width')."\">"._e('Width:')." <input class=\"widefat\" id=\"".$this->get_field_id('width')."\" name=\"".$this->get_field_name('width')."\" type=\"text\" value=\"".wp_specialchars($instance['width'])."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('height')."\">"._e('Height:')." <input class=\"widefat\" id=\"".$this->get_field_id('height')."\" name=\"".$this->get_field_name('height')."\" type=\"text\" value=\"".wp_specialchars($instance['height'])."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('connections')."\">"._e('Connections:')." <input class=\"widefat\" id=\"".$this->get_field_id('connections')."\" name=\"".$this->get_field_name('connections')."\" type=\"text\" value=\"".wp_specialchars($instance['connections'])."\" /></label></p>\r\n";
    echo "<p><input type=\"checkbox\" id=\"".$this->get_field_id('showheader')."\" name=\"".$this->get_field_name('showheader')."\" value=\"true\"".($instance['showheader'] == "true" ? " checked" : "")." /> <label for=\"".$this->get_field_id('showheader')."\">Show header</label></p>\r\n";
    echo "<p><input type=\"checkbox\" id=\"".$this->get_field_id('showstream')."\" name=\"".$this->get_field_name('showstream')."\" value=\"true\"".($instance['showstream'] == "true" ? " checked" : "")." /> <label for=\"".$this->get_field_id('showstream')."\">Show stream</label></p>\r\n";
  }
}
?>