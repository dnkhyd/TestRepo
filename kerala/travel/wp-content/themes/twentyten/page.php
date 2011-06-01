<?php

/**

 * The template for displaying all pages.

 *

 * This is the template that displays all pages by default.

 * Please note that this is the wordpress construct of pages

 * and that other 'pages' on your wordpress site will use a

 * different template.

 *

 * @package WordPress

 * @subpackage Twenty_Ten

 * @since Twenty Ten 1.0

 */


if(isset($_GET['dId']) && $_GET['dId']!=null){
include_once $_SERVER['DOCUMENT_ROOT'].'/configurations.php';

 $APPLICATION_URL="http://".$_SERVER["HTTP_HOST"].'/';

 $cssPath=$APPLICATION_URL.$TFOLDER.'/wp-content/themes/twentyten/styles1.css';

?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

 <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

 <link rel="stylesheet" type="text/css" media="all" href="<?php echo $cssPath;?>" />
 <!-- <link href="<?php echo $cssPath;?>" rel="stylesheet" type="text/css" /> -->
<script type="text/javascript" src="<?php echo $APPLICATION_URL;?>js/jquery-1.4.2.js"></script>
<?php

wp_head();
?>

  <style type="text/css">

	margin-top:0px;

	margin-left:0px;

	padding:0px;

	text-align:left;

	</style>
<?php

}else{

get_header();

}?>
<style type='text/css'>
.bookNowClass{background:url(http://www.mykeralahotels.in/images/mkh_btns_2.png) no-repeat left top;}
	
.bk_nw_btn{background-position:0px -330px; background-repeat:no-repeat; width:141px; height:60px;border:0px;cursor:pointer;}
		
.blu_txt{ font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#3b5998; text-decoration:none; font-weight:bold;}
	 
 </style>





		<!-- div id="container"> -->

<?php if(isset($_GET['dId']) && $_GET['dId']!=null){ ?>

	<div id="container" style="background:none repeat scroll 0 0 #FFFFFF !important">

	<?php }else {?>

	<div id="container">

	<?php }?>

			<div id="content" role="main">



<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( is_front_page() ) { ?>

						<h2 class="entry-title"><?php the_title(); ?></h2>

					<?php } else { ?>	

						<h1 class="entry-title"><?php the_title(); ?></h1>

					<?php } ?>				



					<div class="entry-content">

						<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>

						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>

					</div><!-- .entry-content -->

				</div><!-- #post-## -->



				<?php 

				if(isset($_GET['dId']) && $_GET['dId']!=null){

						

						}else{

							comments_template( '', true ); 

						}

				 ?>




<?php endwhile; ?>



			</div><!-- #content -->

		</div><!-- #container -->
<?php 

if(isset($_GET['dId']) && $_GET['dId']!=null){

						

						}else{

							get_sidebar();

						}

 ?>

<?php if(isset($_GET['dId']) && $_GET['dId']!=null){
?>

	<style type="text/css">

	.social_bookmark{margin-top:-130px;

	margin-left:80px;

	padding:0px;

	text-align:left;}

	</style>


					<?php
						

						}else{

							get_footer();

						} ?>
<?php
/**
 * Assigning functionality for Booknow button
 */

?>


<script>
	$(function(){
	$("#bookingBottom").click(function(){
	<?php 
	if(isset($_GET['dId']) && $_GET['dId']!=null){ 
	?>
		
		window.parent.closeDialogFromInnerFrame();
		window.parent.getuserDetails();
	
<?php }else{
		?>
			window.parent.setPostid('<?php echo $post->ID;?>');
		    window.parent.showContactPopup('2');
			
			
		
		
		<?php }?>

			});
	
	});
	$(function(){
	$("#bookingTop").click(function(){
	<?php 
	if(isset($_GET['dId']) && $_GET['dId']!=null){ 
	?>
		
		window.parent.closeDialogFromInnerFrame();
	    window.parent.getuserDetails();
	
<?php }else{
		?>
			window.parent.setPostid('<?php echo $post->ID;?>');			
			window.parent.showContactPopup('2');
			
			
		
		
		<?php }?>

			});
	
	});
	$(function(){
	$("#contactForm").click(function(){
	<?php 
	if(isset($_GET['dId']) && $_GET['dId']!=null){ 
	?>
		window.parent.showContactPopup('2');
	
	
<?php }else{
		?>
			
		    window.parent.showContactPopup('2');
			
			
		
		
		<?php }?>

			});
	
	});
</script>


