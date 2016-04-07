<?php
/***************** EXCERPT LENGTH ************/
function advertica_lite_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'advertica_lite_excerpt_length');

/***************** READ MORE ****************/
function advertica_lite_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'advertica_lite_excerpt_more');

/************* CUSTOM PAGE TITLE ***********/
add_filter( 'wp_title', 'advertica_lite_title' );
function advertica_lite_title($title)
{
	$advertica_lite_title = $title;
	if ( is_home() && !is_front_page() ) {
		$advertica_lite_title .= get_bloginfo('name');
	}
	if ( is_front_page() ){
		$advertica_lite_title .=  get_bloginfo('name');
		$advertica_lite_title .= ' | '; 
		$advertica_lite_title .= get_bloginfo('description');
	}
	if ( is_search() ) {
		$advertica_lite_title .=  get_bloginfo('name');
	}
	if ( is_author() ) { 
		global $wp_query;
		$curauth = $wp_query->get_queried_object();	
		$advertica_lite_title .= __('Author: ','advertica-lite');
		$advertica_lite_title .= $curauth->display_name;
		$advertica_lite_title .= ' | ';
		$advertica_lite_title .= get_bloginfo('name');
	}
	if ( is_single() ) {
		$advertica_lite_title .= get_bloginfo('name');
	}
	if ( is_page() && !is_front_page() ) {
		$advertica_lite_title .= get_bloginfo('name');
	}
	if ( is_category() ) {
		$advertica_lite_title .= get_bloginfo('name');
	}
	if ( is_year() ) { 
		$advertica_lite_title .= get_bloginfo('name');
	}
	if ( is_month() ) {
		$advertica_lite_title .= get_bloginfo('name');
	}
	if ( is_day() ) {
		$advertica_lite_title .= get_bloginfo('name');
	}
	if (function_exists('is_tag')) { 
		if ( is_tag() ) {
			$advertica_lite_title .= get_bloginfo('name');
		}
		if ( is_404() ) {
			$advertica_lite_title .= get_bloginfo('name');
		}					
	}
	return $advertica_lite_title;
}

/**
 * SETS UP THE CONTENT WIDTH VALUE BASED ON THE THEME'S DESIGN.
 */
if ( ! isset( $content_width ) ){
    $content_width = 900;
}
add_filter('body_class','advertica_lite_class_name');
function advertica_lite_class_name($classes) {
	$classes[] = 'advertica-lite';
	return $classes;
}