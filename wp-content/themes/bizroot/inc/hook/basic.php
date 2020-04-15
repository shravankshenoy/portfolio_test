<?php
/**
 * Basic theme functions.
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package Bizroot
 */

if ( ! function_exists( 'bizroot_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function bizroot_implement_excerpt_length( $length ) {

		$excerpt_length = bizroot_get_option( 'excerpt_length' );
		if ( empty( $excerpt_length ) ) {
			$excerpt_length = $length;
		}
		return apply_filters( 'bizroot_filter_excerpt_length', esc_attr( $excerpt_length ) );

	}

endif;

if ( ! function_exists( 'bizroot_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function bizroot_implement_read_more( $more ) {

		$flag_apply_excerpt_read_more = apply_filters( 'bizroot_filter_excerpt_read_more', true );
		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more;
		}

		$output = $more;
		$read_more_text = bizroot_get_option( 'read_more_text' );
		if ( ! empty( $read_more_text ) ) {
			$output = ' <a href="'. esc_url( get_permalink() ) . '" class="read-more">' . esc_html( $read_more_text ) . '</a>';
			$output = apply_filters( 'bizroot_filter_read_more_link' , $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'bizroot_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function bizroot_content_more_link( $more_link, $more_link_text ) {

		$flag_apply_excerpt_read_more = apply_filters( 'bizroot_filter_excerpt_read_more', true );
		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more_link;
		}

		$read_more_text = bizroot_get_option( 'read_more_text' );
		if ( ! empty( $read_more_text ) ) {
			$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
		}

		return $more_link;

	}

endif;

if ( ! function_exists( 'bizroot_custom_body_class' ) ) :
	/**
	 * Custom body class
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $input One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function bizroot_custom_body_class( $input ) {

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$input[] = 'group-blog';
		}

		$home_content_status =	bizroot_get_option( 'home_content_status' );
		if( true !== $home_content_status ){
			$input[] = 'home-content-not-enabled';
		}

		// Global layout.
		global $post;
		$global_layout = bizroot_get_option( 'global_layout' );
		$global_layout = apply_filters( 'bizroot_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post  && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'bizroot_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}

		$input[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
		  case 'three-columns':
		    $input[] = 'three-columns-enabled';
		    break;

		  default:
		    break;
		}

		// Overlap class.
		$overlap_class = 'header-overlap';
		if ( is_singular( array( 'post', 'page' ) ) ) {
			// Post specific.
			$values = get_post_meta( $post->ID, 'bizroot_theme_settings', true );
			$disable_overlap = isset( $values['disable_overlap'] ) ? $values['disable_overlap'] : '';
			if ( 1 === absint( $disable_overlap ) ) {
				$overlap_class = '';
			}
		}
		if ( ! empty( $overlap_class ) ) {
			$input[] = $overlap_class;
		} else {
			$input[] = 'header-overlap-disabled';
		}

		return $input;

	}
endif;

add_filter( 'body_class', 'bizroot_custom_body_class' );

if ( ! function_exists( 'bizroot_featured_image_instruction' ) ) :

	/**
	 * Message to show in the Featured Image Meta box.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Admin post thumbnail HTML markup.
	 * @param int    $post_id Post ID.
	 * @return string HTML.
	 */
	function bizroot_featured_image_instruction( $content, $post_id ) {

		$allowed = array( 'page' );
		if ( in_array( get_post_type( $post_id ), $allowed ) ) {
			$content .= '<strong>' . __( 'Recommended Image Sizes', 'bizroot' ) . ':</strong><br/>';
			$content .= __( 'Slider Image', 'bizroot' ) . ' : 1350px X 590px';
		}

		return $content;

	}

endif;
add_filter( 'admin_post_thumbnail_html', 'bizroot_featured_image_instruction', 10, 2 );

if ( ! function_exists( 'bizroot_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 1.0.0
	 */
	function bizroot_custom_content_width() {

		global $post, $wp_query, $content_width;

		$global_layout = bizroot_get_option( 'global_layout' );
		$global_layout = apply_filters( 'bizroot_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post  && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'bizroot_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = esc_attr( $post_options['post_layout'] );
			}
		}
		switch ( $global_layout ) {

			case 'no-sidebar':
				$content_width = 1220;
				break;

			case 'three-columns':
				$content_width = 570;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 895;
				break;

			default:
				break;
		}

	}
endif;

add_filter( 'template_redirect', 'bizroot_custom_content_width' );

if ( ! function_exists( 'bizroot_hook_read_more_filters' ) ) :

	/**
	 * Hook read more filters.
	 *
	 * @since 1.0.0
	 */
	function bizroot_hook_read_more_filters() {
		if ( is_home() || is_category() || is_tag() || is_author() || is_date() ) {

			add_filter( 'excerpt_length', 'bizroot_implement_excerpt_length', 999 );
			add_filter( 'the_content_more_link', 'bizroot_content_more_link', 10, 2 );
			add_filter( 'excerpt_more', 'bizroot_implement_read_more' );

		}
	}
endif;

add_action( 'wp', 'bizroot_hook_read_more_filters' );
