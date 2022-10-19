<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package appzend
 */

if ( ! function_exists( 'appzend_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function appzend_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			//esc_html_x( 'On %s', 'post date', 'appzend' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<div><span class="posted-on">' . $posted_on . '</span></div>'; // WPCS: XSS OK.

	}

endif;

if ( ! function_exists( 'appzend_posted_by' ) ) :

	/**
	 * Prints HTML with meta information for the current author.
	 */
	function appzend_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			//esc_html_x( 'by %s', 'post author', 'appzend' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<div><span class="byline">' . $byline . '</span></div>'; // WPCS: XSS OK.

	}

endif;

if ( ! function_exists( 'appzend_comments' ) ) :

	/**
	 * Prints HTML with meta information for the current author.
	 */
	function appzend_comments() {

		echo '<div><span class="comments-link"><i class="fa fa-comments"></i> ';
			
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'appzend' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

		echo '</span></div>'; // WPCS: XSS OK.

	}

endif;

if ( ! function_exists( 'appzend_category_list' ) ) :

	/**
	 * Prints HTML with meta information for the current author.
	 */
	function appzend_category_list() {

		$categories_list = get_the_category_list( esc_html__( ', ', 'appzend' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<div><span class="cat-links">' . esc_html__( 'in %1$s', 'appzend' ) . '</span></div>', $categories_list ); // WPCS: XSS OK.
		} // WPCS: XSS OK.

	}

endif;

if ( ! function_exists( 'appzend_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function appzend_post_thumbnail() {

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) : ?>

			<div class="blog-post-thumbnail">
				<div class="post-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div><!-- .post-thumbnail -->
			</div>

		<?php else : ?>

			<div class="blog-post-thumbnail">
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php
						the_post_thumbnail( 'post-thumbnail' );
					?>
				</a>
			</div>
			
		<?php
		endif; // End is_singular().
	}
endif;

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function appzend_excerpt_length( $length ) {

	$excerpt_length = get_theme_mod( 'appzend_post_excerpt_length', 35 );

	if( is_admin() ){

		return $length;

	}elseif( is_front_page() ){

		return 25;

	}else{

		return $excerpt_length;

	}

}
add_filter( 'excerpt_length', 'appzend_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function appzend_excerpt_more( $more ) {

    if( is_admin() ){

        return $more;
    }

    return '&hellip;';
}
add_filter( 'excerpt_more', 'appzend_excerpt_more' );


if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
