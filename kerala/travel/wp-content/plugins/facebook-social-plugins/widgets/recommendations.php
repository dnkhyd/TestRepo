<?php
class OlussierFSP_Recommendations extends WP_Widget {

  function OlussierFSP_Recommendations() {
    parent::WP_Widget(false, "FB Recommendations", array('description' => "Shows personalized recommendations to your users."));  
  }

  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    echo $before_widget;
    if ($title) { echo $before_title.$title.$after_title; }
 
    $width = (intval($instance['width']) > 0 ? intval($instance['width']) : 300);
    $height = (intval($instance['height']) > 0 ? intval($instance['height']) : 0);
    $showHeader = ($instance['showheader'] == "true" ? "true" : "false");
    $colorScheme = $instance['colorscheme'];
    $borderColor = $instance['bordercolor'];
      
    $url = parse_url(get_permalink());
    
    $options = get_option('olussier-facebook-social-plugins');
    if (!empty($options['application_id'])) {
      echo "<fb:recommendations site=\"";
      echo $url['host'];
      echo "\" width=\"";
      echo $width;
      if ($height) {
	      echo "\" height=\"";
	      echo $height;
      }
      echo "\" header=\"";
      echo $showHeader;
      echo "\" colorscheme=\"";
      echo $colorScheme;
      echo "\" border_color=\"";
      echo $borderColor;
      echo "\"></fb:recommendations>\r\n";
    } else {
      echo "<iframe src=\"http://www.facebook.com/plugins/recommendations.php?site=";
      echo $url['host'];
      echo "&amp;width=";
      echo $width;
      if ($height) {
        echo "&amp;height=";
        echo $height;
      }
      echo "&amp;header=";
      echo $showHeader;
      echo "&amp;colorscheme=";
      echo $colorScheme;
      echo "&amp;border_color=";
      echo urlencode($borderColor);
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
      $title = "Recommendations";
    }
       
    echo "<p><label for=\"".$this->get_field_id('title')."\">"._e('Title:')." <input class=\"widefat\" id=\"".$this->get_field_id('title')."\" name=\"".$this->get_field_name('title')."\" type=\"text\" value=\"".wp_specialchars($title)."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('width')."\">"._e('Width:')." <input class=\"widefat\" id=\"".$this->get_field_id('width')."\" name=\"".$this->get_field_name('width')."\" type=\"text\" value=\"".wp_specialchars($instance['width'])."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('height')."\">"._e('Height:')." <input class=\"widefat\" id=\"".$this->get_field_id('height')."\" name=\"".$this->get_field_name('height')."\" type=\"text\" value=\"".wp_specialchars($instance['height'])."\" /></label></p>\r\n";
    echo "<p><input type=\"checkbox\" id=\"".$this->get_field_id('showheader')."\" name=\"".$this->get_field_name('showheader')."\" value=\"true\"".($instance['showheader'] == "true" ? " checked" : "")." /> <label for=\"".$this->get_field_id('showheader')."\">Show header</label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('colorscheme')."\">"._e('Color scheme:')." <select class=\"widefat\" id=\"".$this->get_field_id('colorscheme')."\" name=\"".$this->get_field_name('colorscheme')."\"><option value=\"light\"".($instance['colorscheme'] == "light" ? " selected" : "").">Light</option><option value=\"dark\"".($instance['colorscheme'] == "dark" ? " selected" : "").">Dark</option></select></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('bordercolor')."\">"._e('Border color:')." <input class=\"widefat\" id=\"".$this->get_field_id('bordercolor')."\" name=\"".$this->get_field_name('bordercolor')."\" type=\"text\" value=\"".wp_specialchars($instance['bordercolor'])."\" /></label></p>\r\n";
  }
}
?>