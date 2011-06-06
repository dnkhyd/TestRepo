<?php
class OlussierFSP_Comments extends WP_Widget {

  function OlussierFSP_Comments() {
    parent::WP_Widget(false, "FB Comments", array('description' => "Easily enables your users to comment on your site's content."));  
  }

  function widget($args, $instance) {
  	$options = get_option('olussier-facebook-social-plugins');
  	
  	if (!empty($options['application_id'])) {
	    extract($args);
	    $title = apply_filters('widget_title', $instance['title']);
	    echo $before_widget;
	    if ($title) { echo $before_title.$title.$after_title; }
	 
	    $width = (intval($instance['width']) > 0 ? intval($instance['width']) : 300);
	    $numPosts = (intval($instance['numposts']) > 0 ? intval($instance['numposts']) : 5);
	    
      echo "<fb:comments xid=\"";
      echo urlencode(get_permalink());
      echo "\" numposts=\"";
      echo $numPosts;
      echo "\" width=\"";
      echo $width;
      echo "\"></fb:comments>\r\n";
	        
	    echo $after_widget;
    }
  }
  
  function update($new_instance, $old_instance) {       
    return $new_instance;
  }
  
  function form($instance) {
  if (array_key_exists('title',$instance)) {
      $title = esc_attr($instance['title']);
    } else {
      $title = "Comments";
    }
    
    if (!array_key_exists('numposts',$instance)) {
      $instance['numposts'] = 5;
    }
       
    echo "<p><label for=\"".$this->get_field_id('title')."\">"._e('Title:')." <input class=\"widefat\" id=\"".$this->get_field_id('title')."\" name=\"".$this->get_field_name('title')."\" type=\"text\" value=\"".wp_specialchars($title)."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('width')."\">"._e('Width:')." <input class=\"widefat\" id=\"".$this->get_field_id('width')."\" name=\"".$this->get_field_name('width')."\" type=\"text\" value=\"".wp_specialchars($instance['width'])."\" /></label></p>\r\n";
    echo "<p><label for=\"".$this->get_field_id('numposts')."\">"._e('Number of comments:')." <input class=\"widefat\" id=\"".$this->get_field_id('numposts')."\" name=\"".$this->get_field_name('numposts')."\" type=\"text\" value=\"".wp_specialchars($instance['numposts'])."\" /></label></p>\r\n";
  }
}
?>