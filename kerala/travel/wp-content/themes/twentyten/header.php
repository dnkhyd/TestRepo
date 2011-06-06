<?php
@session_start(void);

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
$tab="blog";
$isWPTemplet=true;
	include_once $_SERVER[DOCUMENT_ROOT].'/configurations.php';
	include_once $_SERVER[DOCUMENT_ROOT].'/views/header.php';
	
?>
	<div id="main" style="top:135px;">
    