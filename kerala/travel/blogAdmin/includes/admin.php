<?php
/**
 * Includes all of the WordPress Administration API files.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Bookmark Administration API */
require_once(ABSPATH . 'blogAdmin/includes/bookmark.php');

/** WordPress Comment Administration API */
require_once(ABSPATH . 'blogAdmin/includes/comment.php');

/** WordPress Administration File API */
require_once(ABSPATH . 'blogAdmin/includes/file.php');

/** WordPress Image Administration API */
require_once(ABSPATH . 'blogAdmin/includes/image.php');

/** WordPress Media Administration API */
require_once(ABSPATH . 'blogAdmin/includes/media.php');

/** WordPress Import Administration API */
require_once(ABSPATH . 'blogAdmin/includes/import.php');

/** WordPress Misc Administration API */
require_once(ABSPATH . 'blogAdmin/includes/misc.php');

/** WordPress Plugin Administration API */
require_once(ABSPATH . 'blogAdmin/includes/plugin.php');

/** WordPress Post Administration API */
require_once(ABSPATH . 'blogAdmin/includes/post.php');

/** WordPress Taxonomy Administration API */
require_once(ABSPATH . 'blogAdmin/includes/taxonomy.php');

/** WordPress Template Administration API */
require_once(ABSPATH . 'blogAdmin/includes/template.php');

/** WordPress Theme Administration API */
require_once(ABSPATH . 'blogAdmin/includes/theme.php');

/** WordPress User Administration API */
require_once(ABSPATH . 'blogAdmin/includes/user.php');

/** WordPress Update Administration API */
require_once(ABSPATH . 'blogAdmin/includes/update.php');

/** WordPress Registration API */
require_once(ABSPATH . WPINC . '/registration.php');

/** WordPress Deprecated Administration API */
require_once(ABSPATH . 'blogAdmin/includes/deprecated.php');

/** WordPress Multi-Site support API */
if ( is_multisite() ) {
	require_once(ABSPATH . 'blogAdmin/includes/ms.php');
	require_once(ABSPATH . 'blogAdmin/includes/ms-deprecated.php');
}

?>
