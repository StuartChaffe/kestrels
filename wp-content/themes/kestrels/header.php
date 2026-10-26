<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="/favicon.ico">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<?php wp_head(); ?>
<?php get_template_part( 'partials/global-analytics' ); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part('partials/global-browser-notice'); ?>

<a id="skip-nav" class="skip-nav" href="#content">Skip to main content</a>

<div class="global-container">
<?php get_template_part('partials/global-alert'); ?>
<?php get_template_part('partials/site-header'); ?>
