<?php
/*
Plugin Name:  Simple Spoiler
Plugin URI:   https://developer.wordpress.org/plugins/simple-spoiler/
Description:  The plugin allows to create simple spoilers with shortcode.
Version:      1.0
Author:       Webliberty
Author URI:   https://webliberty.ru/
License:      GPLv3
License URI:  https://www.gnu.org/licenses/gpl-3.0.html
Text Domain:  simple-spoiler
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

function s_spoiler($atts, $content) {
	if ( ! isset($atts[name]) ) {
		$sp_name = __( 'Spoiler', 'simple-spoiler' );
	} else {
		$sp_name = $atts[name];
	}
	return '<div class="spoiler-wrap">
			<div class="spoiler-head folded">'.$sp_name.'</div>
			<div class="spoiler-body">'.$content.'</div>
		</div>';
}
add_shortcode( 'spoiler', 's_spoiler' );

add_action( 'wp_enqueue_scripts', 'do_s_spoiler' );
function do_s_spoiler() {
	global $post;
	wp_register_style( 's_spoiler_style', plugins_url( 'css/simple-spoiler.css', __FILE__ ), null, '1.0' );
	wp_register_script( 's_spoiler_script', plugins_url( 'js/simple-spoiler.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	if ( has_shortcode( $post->post_content, 'spoiler' ) ) {
		wp_enqueue_style( 's_spoiler_style' );
		wp_enqueue_script( 's_spoiler_script' );
	}
}
