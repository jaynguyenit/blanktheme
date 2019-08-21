<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package thenow
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function thenow_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'thenow_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function thenow_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'thenow_pingback_header' );

/**
 * aq_resize function
 */
if(!function_exists('aq_resize')) {
    function aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = true ) {
        if ( defined( 'ICL_SITEPRESS_VERSION' ) ){
            global $sitepress;
            $url = $sitepress->convert_url( $url, $sitepress->get_default_language() );
        }
        $aq_resize = Aq_Resize::getInstance();
        return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
    }
}

/**
 * get resize img
 */
if(!function_exists('get_image')) {
    function get_image($size=array(600,400),$class='',$url = '',$title = '') {
        $url = ($url!='')?$url:get_the_post_thumbnail_url(get_the_ID(),'full');
        $imgurl = aq_resize($url,$size[0],$size[1],true);
        return '<img src="'.$imgurl.'" class="'.$class.'" alt="'.$title.'">';
    }
}