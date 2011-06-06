<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
       </div>   <!-- #main -->
	
<?php
include $_SERVER[DOCUMENT_ROOT].'/configurations.php'; 
include_once $_SERVER[DOCUMENT_ROOT].'/views/footer.php'; ?>
<script type="text/javascript">
$(function(){
		   var containerContent=$("#main").html();
		 //  alert(containerContent);
		   containerContent="<table border='0'  cellpadding='0' cellspacing='0' ><tr><td><div style='background:url(http://mykeralahotels.in/kerala/travel/wp-content/themes/twentyten/images/top_1.png) no-repeat; width:1003px; height:37px; display:block;'></div></td></tr><tr><td style='background:url(http://mykeralahotels.in/kerala/travel/wp-content/themes/twentyten/images/bg_pix.png) repeat-y;'>"+containerContent+"</td></tr><tr><td><div style='background:url(http://mykeralahotels.in/kerala/travel/wp-content/themes/twentyten/images/bottom_1.png) no-repeat; width:1003px;height:37px; display:block;'></div></td></tr></table>";
		   $("#main").html(containerContent);
		  //  $("#slideshowImages").show(); //Code for  avoiding  background image flash before text 
		   });
</script>
<?php
wp_footer();

?>
</body>
</html>
