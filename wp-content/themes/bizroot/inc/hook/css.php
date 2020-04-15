<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package Bizroot
 */

if ( ! function_exists( 'bizroot_trigger_custom_css_action' ) ) :

	/**
	 * Do action theme custom CSS.
	 *
	 * @since 1.0.0
	 */
	function bizroot_trigger_custom_css_action() {

		/**
		 * Hook - bizroot_action_theme_custom_css.
		 */
		do_action( 'bizroot_action_theme_custom_css' );

	}

endif;

add_action( 'wp_head', 'bizroot_trigger_custom_css_action', 99 );
