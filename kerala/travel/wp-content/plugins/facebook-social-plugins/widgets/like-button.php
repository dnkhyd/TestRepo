<?php
class OlussierFSP_LikeButton extends WP_Widget {

  function OlussierFSP_LikeButton() {
    parent::WP_Widget(false, "FB Like Button", array('description' => "Enables users to make connections to your pages and share content back to their friends on Facebook with one click."));  
  }

  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    echo $before_widget;
    if ($title) { echo $before_title.$title.$after_title; }
 
    $width = (intval($instance['width']) > 0 ? intval($instance['width']) : 300);
    $height = (intval($instance['height']) > 0 ? intval($instance['height']) : 80);
    $showFaces = ($instance['faces'] == "true" ? "true" : "false");
    $layout = $instance['layout'];
    $buttonLabel = $instance['buttonlabel'];
    $colorScheme = $instance['colorscheme'];
      
    $options = get_option('olussier-facebook-social-plugins');
    if (!empty($options['application_id'])) {
      echo "<fb:like href=\"";
      echo urlencode(get_permalink());
      echo "\" layout=\"";
      echo $layout;
      echo "\" show_faces=\"";
      echo $showFaces;
      echo "\" width=\"";
      echo $width;
      echo "\" action=\"";
      echo $buttonLabel;
      echo "\" colorscheme=\"";
      echo $colorScheme;
      echo "\"></iframe>\r\n";
    } else {
	    echo "<iframe src=\"http://www.facebook.com/plugins/like.php?href=";
	    echo urlencode(get_permalink());
	    echo "&amp;layout=";
      echo $layout;
      echo "&amp;show_faces=";
	    echo $showFaces;
	    echo "&amp;width=";
	    echo $width;
	    echo "&amp;action=";
	    echo $buttonLabel;
	    echo "&amp;colorscheme=";
	    echo $colorScheme;
	    echo "&amp;locale=";
      echo OlussierFacebookSocialPlugins::GetLanguage();
	    echo "\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" style=\"margin-top: 10px; border:none; overflow:hidden; width:";
	    echo $width;
	    echo "px; height: ";
	    echo $height;
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
      $title = "Share this Article";
    }
    
    echo "<p><label for=\"".$this->get_field_id('title')."\">"._e('Title:')." <input class=\"widefat\" id=\"".$this->get_field_id('title')."\" name=\"".$this->get_field_name('title')."\" type=\"text\" value=\"".wp_specialchars($title)."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('width')."\">"._e('Width:')." <input class=\"widefat\" id=\"".$this->get_field_id('width')."\" name=\"".$this->get_field_name('width')."\" type=\"text\" value=\"".wp_specialchars($instance['width'])."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('height')."\">"._e('Height:')." <input class=\"widefat\" id=\"".$this->get_field_id('height')."\" name=\"".$this->get_field_name('height')."\" type=\"text\" value=\"".wp_specialchars($instance['height'])."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('layout')."\">"._e('Layout:')." <select class=\"widefat\" id=\"".$this->get_field_id('layout')."\" name=\"".$this->get_field_name('layout')."\"><option value=\"standard\"".($instance['layout'] == "standard" ? " selected" : "").">Standard</option><option value=\"button_count\"".($instance['layout'] == "button_count" ? " selected" : "").">Button &amp; count</option></select></label></p>\r\n";
    echo "<p><input type=\"checkbox\" id=\"".$this->get_field_id('faces')."\" name=\"".$this->get_field_name('faces')."\" value=\"true\"".($instance['faces'] == "true" ? " checked" : "")." /> <label for=\"".$this->get_field_id('faces')."\">Show faces</label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('colorscheme')."\">"._e('Color scheme:')." <select class=\"widefat\" id=\"".$this->get_field_id('colorscheme')."\" name=\"".$this->get_field_name('colorscheme')."\"><option value=\"light\"".($instance['colorscheme'] == "light" ? " selected" : "").">Light</option><option value=\"dark\"".($instance['colorscheme'] == "dark" ? " selected" : "").">Dark</option></select></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('buttonlabel')."\">"._e('Button label:')." <select class=\"widefat\" id=\"".$this->get_field_id('buttonlabel')."\" name=\"".$this->get_field_name('buttonlabel')."\"><option value=\"like\"".($instance['buttonlabel'] == "like" ? " selected" : "").">Like</option><option value=\"recommend\"".($instance['buttonlabel'] == "recommend" ? " selected" : "").">Recommend</option></select></label></p>\r\n";
  }
}
?>