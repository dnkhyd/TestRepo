<?php
/*
Plugin Name: No WWW
Plugin URI: http://wordpress.org/#
Description: WWW checks in, it doesn't check out.
Author: Matt Mullenweg
Version: 1.0
Author URI: http://photomatt.net/
*/

if ( !strstr( $_SERVER['HTTP_HOST'], 'www.' ) )
        return;

header('HTTP/1.1 301 Moved Permanently');
header('Location: http://' . substr($_SERVER['HTTP_HOST'], 4) . $_SERVER['REQUEST_URI']);
exit();

?>