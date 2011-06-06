<?php
/**
 * WordPress core upgrade functionality.
 *
 * @package WordPress
 * @subpackage Administration
 * @since 2.7.0
 */

/**
 * Stores files to be deleted.
 *
 * @since 2.7.0
 * @global array $_old_files
 * @var array
 * @name $_old_files
 */
global $_old_files;

$_old_files = array(
'blogAdmin/bookmarklet.php',
'blogAdmin/css/upload.css',
'blogAdmin/css/upload-rtl.css',
'blogAdmin/css/press-this-ie.css',
'blogAdmin/css/press-this-ie-rtl.css',
'blogAdmin/edit-form.php',
'blogAdmin/link-import.php',
'blogAdmin/images/box-bg-left.gif',
'blogAdmin/images/box-bg-right.gif',
'blogAdmin/images/box-bg.gif',
'blogAdmin/images/box-butt-left.gif',
'blogAdmin/images/box-butt-right.gif',
'blogAdmin/images/box-butt.gif',
'blogAdmin/images/box-head-left.gif',
'blogAdmin/images/box-head-right.gif',
'blogAdmin/images/box-head.gif',
'blogAdmin/images/heading-bg.gif',
'blogAdmin/images/login-bkg-bottom.gif',
'blogAdmin/images/login-bkg-tile.gif',
'blogAdmin/images/notice.gif',
'blogAdmin/images/toggle.gif',
'blogAdmin/images/comment-stalk-classic.gif',
'blogAdmin/images/comment-stalk-fresh.gif',
'blogAdmin/images/comment-stalk-rtl.gif',
'blogAdmin/images/comment-pill.gif',
'blogAdmin/images/del.png',
'blogAdmin/images/media-button-gallery.gif',
'blogAdmin/images/media-buttons.gif',
'blogAdmin/images/tail.gif',
'blogAdmin/images/gear.png',
'blogAdmin/images/tab.png',
'blogAdmin/images/postbox-bg.gif',
'blogAdmin/includes/upload.php',
'blogAdmin/js/dbx-admin-key.js',
'blogAdmin/js/link-cat.js',
'blogAdmin/js/forms.js',
'blogAdmin/js/upload.js',
'blogAdmin/js/set-post-thumbnail-handler.js',
'blogAdmin/js/set-post-thumbnail-handler.dev.js',
'blogAdmin/js/page.js',
'blogAdmin/js/page.dev.js',
'blogAdmin/js/slug.js',
'blogAdmin/js/slug.dev.js',
'blogAdmin/profile-update.php',
'blogAdmin/templates.php',
'wp-includes/images/audio.png',
'wp-includes/images/css.png',
'wp-includes/images/default.png',
'wp-includes/images/doc.png',
'wp-includes/images/exe.png',
'wp-includes/images/html.png',
'wp-includes/images/js.png',
'wp-includes/images/pdf.png',
'wp-includes/images/swf.png',
'wp-includes/images/tar.png',
'wp-includes/images/text.png',
'wp-includes/images/video.png',
'wp-includes/images/zip.png',
'wp-includes/js/dbx.js',
'wp-includes/js/fat.js',
'wp-includes/js/list-manipulation.js',
'wp-includes/js/jquery/jquery.dimensions.min.js',
'wp-includes/js/tinymce/langs/en.js',
'wp-includes/js/tinymce/plugins/autosave/editor_plugin_src.js',
'wp-includes/js/tinymce/plugins/autosave/langs',
'wp-includes/js/tinymce/plugins/directionality/images',
'wp-includes/js/tinymce/plugins/directionality/langs',
'wp-includes/js/tinymce/plugins/inlinepopups/css',
'wp-includes/js/tinymce/plugins/inlinepopups/images',
'wp-includes/js/tinymce/plugins/inlinepopups/jscripts',
'wp-includes/js/tinymce/plugins/paste/images',
'wp-includes/js/tinymce/plugins/paste/jscripts',
'wp-includes/js/tinymce/plugins/paste/langs',
'wp-includes/js/tinymce/plugins/spellchecker/classes/HttpClient.class.php',
'wp-includes/js/tinymce/plugins/spellchecker/classes/TinyGoogleSpell.class.php',
'wp-includes/js/tinymce/plugins/spellchecker/classes/TinyPspell.class.php',
'wp-includes/js/tinymce/plugins/spellchecker/classes/TinyPspellShell.class.php',
'wp-includes/js/tinymce/plugins/spellchecker/css/spellchecker.css',
'wp-includes/js/tinymce/plugins/spellchecker/images',
'wp-includes/js/tinymce/plugins/spellchecker/langs',
'wp-includes/js/tinymce/plugins/spellchecker/tinyspell.php',
'wp-includes/js/tinymce/plugins/wordpress/images',
'wp-includes/js/tinymce/plugins/wordpress/langs',
'wp-includes/js/tinymce/plugins/wordpress/popups.css',
'wp-includes/js/tinymce/plugins/wordpress/wordpress.css',
'wp-includes/js/tinymce/plugins/wphelp',
'wp-includes/js/tinymce/themes/advanced/css',
'wp-includes/js/tinymce/themes/advanced/images',
'wp-includes/js/tinymce/themes/advanced/jscripts',
'wp-includes/js/tinymce/themes/advanced/langs',
'wp-includes/js/tinymce/tiny_mce_gzip.php',
'wp-includes/js/wp-ajax.js',
'blogAdmin/admin-db.php',
'blogAdmin/cat.js',
'blogAdmin/categories.js',
'blogAdmin/custom-fields.js',
'blogAdmin/dbx-admin-key.js',
'blogAdmin/edit-comments.js',
'blogAdmin/install-rtl.css',
'blogAdmin/install.css',
'blogAdmin/upgrade-schema.php',
'blogAdmin/upload-functions.php',
'blogAdmin/upload-rtl.css',
'blogAdmin/upload.css',
'blogAdmin/upload.js',
'blogAdmin/users.js',
'blogAdmin/widgets-rtl.css',
'blogAdmin/widgets.css',
'blogAdmin/xfn.js',
'wp-includes/js/tinymce/license.html',
'blogAdmin/cat-js.php',
'blogAdmin/edit-form-ajax-cat.php',
'blogAdmin/execute-pings.php',
'blogAdmin/import/b2.php',
'blogAdmin/import/btt.php',
'blogAdmin/import/jkw.php',
'blogAdmin/inline-uploading.php',
'blogAdmin/link-categories.php',
'blogAdmin/list-manipulation.js',
'blogAdmin/list-manipulation.php',
'wp-includes/comment-functions.php',
'wp-includes/feed-functions.php',
'wp-includes/functions-compat.php',
'wp-includes/functions-formatting.php',
'wp-includes/functions-post.php',
'wp-includes/js/dbx-key.js',
'wp-includes/js/tinymce/plugins/autosave/langs/cs.js',
'wp-includes/js/tinymce/plugins/autosave/langs/sv.js',
'wp-includes/js/tinymce/themes/advanced/editor_template_src.js',
'wp-includes/links.php',
'wp-includes/pluggable-functions.php',
'wp-includes/template-functions-author.php',
'wp-includes/template-functions-category.php',
'wp-includes/template-functions-general.php',
'wp-includes/template-functions-links.php',
'wp-includes/template-functions-post.php',
'wp-includes/wp-l10n.php',
'blogAdmin/import-b2.php',
'blogAdmin/import-blogger.php',
'blogAdmin/import-greymatter.php',
'blogAdmin/import-livejournal.php',
'blogAdmin/import-mt.php',
'blogAdmin/import-rss.php',
'blogAdmin/import-textpattern.php',
'blogAdmin/quicktags.js',
'wp-images/fade-butt.png',
'wp-images/get-firefox.png',
'wp-images/header-shadow.png',
'wp-images/smilies',
'wp-images/wp-small.png',
'wp-images/wpminilogo.png',
'wp.php',
'wp-includes/gettext.php',
'wp-includes/streams.php',
// MU
'blogAdmin/wpmu-admin.php',
'blogAdmin/wpmu-blogs.php',
'blogAdmin/wpmu-edit.php',
'blogAdmin/wpmu-options.php',
'blogAdmin/wpmu-themes.php',
'blogAdmin/wpmu-upgrade-site.php',
'blogAdmin/wpmu-users.php',
'wp-includes/wpmu-default-filters.php',
'wp-includes/wpmu-functions.php',
'wpmu-settings.php',
'index-install.php',
'README.txt',
'htaccess.dist',
'blogAdmin/css/mu-rtl.css',
'blogAdmin/css/mu.css',
'blogAdmin/images/site-admin.png',
'blogAdmin/includes/mu.php',
'wp-includes/images/wordpress-mu.png',
// 3.0
'blogAdmin/categories.php',
'blogAdmin/edit-category-form.php',
'blogAdmin/edit-page-form.php',
'blogAdmin/edit-pages.php',
'blogAdmin/images/wp-logo.gif',
'blogAdmin/js/wp-gears.dev.js',
'blogAdmin/js/wp-gears.js',
'blogAdmin/options-misc.php',
'blogAdmin/page-new.php',
'blogAdmin/page.php',
'blogAdmin/rtl.css',
'blogAdmin/rtl.dev.css',
'blogAdmin/update-links.php',
'blogAdmin/blogAdmin.css',
'blogAdmin/blogAdmin.dev.css',
'wp-includes/js/codepress',
'wp-includes/js/jquery/autocomplete.dev.js',
'wp-includes/js/jquery/interface.js',
'wp-includes/js/jquery/autocomplete.js',
'wp-includes/js/scriptaculous/prototype.js',
'wp-includes/js/tinymce/wp-tinymce.js',
'wp-content/themes/twentyten/searchform.php',
'blogAdmin/import',
'blogAdmin/images/ico-edit.png',
'blogAdmin/images/fav-top.png',
'blogAdmin/images/ico-close.png',
'blogAdmin/images/admin-header-footer.png',
'blogAdmin/images/screen-options-left.gif',
'blogAdmin/images/ico-add.png',
'blogAdmin/images/browse-happy.gif',
'blogAdmin/images/ico-viewpage.png',
);

/**
 * Upgrade the core of WordPress.
 *
 * This will create a .maintenance file at the base of the WordPress directory
 * to ensure that people can not access the web site, when the files are being
 * copied to their locations.
 *
 * The files in the {@link $_old_files} list will be removed and the new files
 * copied from the zip file after the database is upgraded.
 *
 * The steps for the upgrader for after the new release is downloaded and
 * unzipped is:
 *   1. Test unzipped location for select files to ensure that unzipped worked.
 *   2. Create the .maintenance file in current WordPress base.
 *   3. Copy new WordPress directory over old WordPress files.
 *   4. Upgrade WordPress to new version.
 *   5. Delete new WordPress directory path.
 *   6. Delete .maintenance file.
 *   7. Remove old files.
 *   8. Delete 'update_core' option.
 *
 * There are several areas of failure. For instance if PHP times out before step
 * 6, then you will not be able to access any portion of your site. Also, since
 * the upgrade will not continue where it left off, you will not be able to
 * automatically remove old files and remove the 'update_core' option. This
 * isn't that bad.
 *
 * If the copy of the new WordPress over the old fails, then the worse is that
 * the new WordPress directory will remain.
 *
 * If it is assumed that every file will be copied over, including plugins and
 * themes, then if you edit the default theme, you should rename it, so that
 * your changes remain.
 *
 * @since 2.7.0
 *
 * @param string $from New release unzipped path.
 * @param string $to Path to old WordPress installation.
 * @return WP_Error|null WP_Error on failure, null on success.
 */
function update_core($from, $to) {
	global $wp_filesystem, $_old_files, $wpdb;

	@set_time_limit( 300 );

	$php_version    = phpversion();
	$mysql_version  = $wpdb->db_version();
	$required_php_version = '4.3';
	$required_mysql_version = '4.1.2';
	$wp_version = '3.0';
	$php_compat     = version_compare( $php_version, $required_php_version, '>=' );
	$mysql_compat   = version_compare( $mysql_version, $required_mysql_version, '>=' ) || file_exists( WP_CONTENT_DIR . '/db.php' );

	if ( !$mysql_compat || !$php_compat )
		$wp_filesystem->delete($from, true);

	if ( !$mysql_compat && !$php_compat )
		return new WP_Error( 'php_mysql_not_compatible', sprintf( __('The update cannot be installed because WordPress %1$s requires PHP version %2$s or higher and MySQL version %3$s or higher. You are running PHP version %4$s and MySQL version %5$s.'), $wp_version, $required_php_version, $required_mysql_version, $php_version, $mysql_version ) );
	elseif ( !$php_compat )
		return new WP_Error( 'php_not_compatible', sprintf( __('The update cannot be installed because WordPress %1$s requires PHP version %2$s or higher. You are running version %3$s.'), $wp_version, $required_php_version, $php_version ) );
	elseif ( !$mysql_compat )
		return new WP_Error( 'mysql_not_compatible', sprintf( __('The update cannot be installed because WordPress %1$s requires MySQL version %2$s or higher. You are running version %3$s.'), $wp_version, $required_mysql_version, $mysql_version ) );

	// Sanity check the unzipped distribution
	apply_filters('update_feedback', __('Verifying the unpacked files&#8230;'));
	$distro = '';
	$roots = array( '/wordpress', '/wordpress-mu' );
	foreach( $roots as $root ) {
		if ( $wp_filesystem->exists($from . $root . '/wp-settings.php') && $wp_filesystem->exists($from . $root . '/blogAdmin/admin.php') &&
			$wp_filesystem->exists($from . $root . '/wp-includes/functions.php') ) {
			$distro = $root;
			break;
		}
	}
	if ( !$distro ) {
		$wp_filesystem->delete($from, true);
		return new WP_Error('insane_distro', __('The update could not be unpacked') );
	}

	apply_filters('update_feedback', __('Installing the latest version&#8230;'));

	// Create maintenance file to signal that we are upgrading
	$maintenance_string = '<?php $upgrading = ' . time() . '; ?>';
	$maintenance_file = $to . '.maintenance';
	$wp_filesystem->delete($maintenance_file);
	$wp_filesystem->put_contents($maintenance_file, $maintenance_string, FS_CHMOD_FILE);

	// Copy new versions of WP files into place.
	$result = copy_dir($from . $distro, $to);
	if ( is_wp_error($result) ) {
		$wp_filesystem->delete($maintenance_file);
		$wp_filesystem->delete($from, true);
		return $result;
	}

	// Remove old files
	foreach ( $_old_files as $old_file ) {
		$old_file = $to . $old_file;
		if ( !$wp_filesystem->exists($old_file) )
			continue;
		$wp_filesystem->delete($old_file, true);
	}

	// Upgrade DB with separate request
	apply_filters('update_feedback', __('Upgrading database&#8230;'));
	$db_upgrade_url = admin_url('upgrade.php?step=upgrade_db');
	wp_remote_post($db_upgrade_url, array('timeout' => 60));

	// Remove working directory
	$wp_filesystem->delete($from, true);

	// Force refresh of update information
	if ( function_exists('delete_site_transient') )
		delete_site_transient('update_core');
	else
		delete_option('update_core');

	// Remove maintenance file, we're done.
	$wp_filesystem->delete($maintenance_file);
}

?>
