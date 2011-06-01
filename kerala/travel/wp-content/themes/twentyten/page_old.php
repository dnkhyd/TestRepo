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

include_once $_SERVER['DOCUMENT_ROOT'].'/configurations.php';

 $APPLICATION_URL="http://".$_SERVER["HTTP_HOST"].'/';

 $cssPath=$APPLICATION_URL.$TFOLDER.'/wp-content/themes/twentyten/styles1.css';



if(isset($_GET['dId']) && $_GET['dId']!=null){

?>

<link href="<?php echo $cssPath;?>" rel="stylesheet" type="text/css" />

<?php

}else{

get_header();

}?>



		<div id="container">

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

						<?php 

						if(isset($_GET['dId']) && $_GET['dId']!=null){

						

						}else{

							edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); 

						}

						?>

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

						

						}else{

							get_footer();

						} ?>


