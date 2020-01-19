<?php
/**
 * swc functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package swc
 */

require_once __DIR__ . '/lib/setup.php';

/**
 * Returns the theme version string
 * 
 * @return string
 */
function swc_get_theme_version() {
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		return (string) time();
	}

	static $version;

	if ( is_null( $version ) ) {
		$version = wp_get_theme()->get( 'Version' );
	}

	return $version;
}

function swc_get_theme_option_default( $option = '' ) {
	$defaults = [
		'footer_widgets'		=> 3,
		'footer_credits'		=> '<p>&copy; [current-year] [site-title]. All rights reserved</p>'
	];

	if ( $option && array_key_exists( $option, $defaults ) ) {
		return $defaults[ $option ];
	}

	return $defaults;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function swc_setup() {

	load_theme_textdomain( 'swc', get_template_directory() . '/languages' );

	add_post_type_support( 'post', 'post-options' );
	add_post_type_support( 'page', 'post-options' );

	add_post_type_support( 'post', 'hero-section' );
	add_post_type_support( 'page', 'hero-section' );

	add_post_type_support( 'page', 'post-thumbnails' );

	$theme_support = [
		'automatic-feed-links',
		'title-tag',
		'editor-styles',
		'custom-sticky-logo',
		'post-thumbnails',
		'gutenberg'	=> [
			'wide_images' => true 
		],
		'custom-header' => [
			'header-selector'  => '.hero-section',
			'default_image'    => get_theme_file_uri( 'assets/img/hero.jpg' ),
			'header-text'      => false,
			'width'            => 1280,
			'height'           => 720,
			'flex-height'      => true,
			'flex-width'       => true,
			'uploads'          => true,
			'video'            => true,
			'wp-head-callback' => 'swc_custom_header'
		],
		'responsive-embeds',
		'woocommerce',
		'wc-product-gallery-zoom',
		'wc-product-gallery-lightbox',
		'wc-product-gallery-slider',
		'align-wide',
		'wp-block-styles',
		'editor-font-sizes' => [
			[
				'name'      => __( 'Small', 'swc' ),
				'shortName' => __( 'S', 'swc' ),
				'size'      => 13,
				'slug'      => 'small'
			],
			[
				'name'      => __( 'Normal', 'swc' ),
				'shortName' => __( 'N', 'swc' ),
				'slug'      => 'normal'
			],
			[
				'name'      => __( 'Medium', 'swc' ),
				'shortName' => __( 'M', 'swc' ),
				'size'      => 18,
				'slug'      => 'medium'
			],
			[
				'name'      => __( 'Large', 'swc' ),
				'shortName' => __( 'L', 'swc' ),
				'size'      => 20,
				'slug'      => 'large'
			],
			[
				'name'      => __( 'Huge', 'swc' ),
				'shortName' => __( 'H', 'swc' ),
				'size'      => 48,
				'slug'      => 'huge'
			]
		],
		'html5' => [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		],
		'custom-background' => [
			'default-color' => 'ffffff',
			'default-image' => '',
		],
		'customize-selective-refresh-widgets',
		'custom-logo' => [
			'height'      => 41,
			'width'       => 98,
			'flex-width'  => true,
			'flex-height' => true,
		]
	];

	// Add theme support
	array_walk( $theme_support, function ( $value, $key ) {
		is_int( $key ) ? add_theme_support( $value ) : add_theme_support( $key, $value );
	} );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'swc' ),
	) );

	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'content_width', 1152 );
}
add_action( 'after_setup_theme', 'swc_setup', 5 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function swc_widgets_init() {
	$footer_widgets = get_theme_mod( 'footer_widgets', 3 );

	if ( $footer_widgets ) {
		$footer_widgets = array_fill( 1, $footer_widgets, null );

		array_walk( $footer_widgets, function( $n, $i ) {
			register_sidebar( array(
				'name'          => sprintf( esc_html__( 'Footer %d', 'swc' ), $i ),
				'id'            => 'footer-' . $i,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3><div class="widget-wrap">',
			) );
		} );
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'swc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'swc' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'swc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function swc_scripts() {
	wp_dequeue_style( 'edd-styles' );

    wp_enqueue_style( 'swc-style', get_stylesheet_uri(), [], swc_get_theme_version() );
    wp_enqueue_style( 'swc-style-main', get_template_directory_uri() . '/assets/css/main.css', [], swc_get_theme_version() );

	wp_enqueue_script( 'swc-superfish', get_template_directory_uri() . '/assets/js/min/superfish.js', [ 'jquery' ], swc_get_theme_version(), true );
	wp_enqueue_script( 'swc-scripts', get_template_directory_uri() . '/assets/js/min/main.js', [ 'jquery' ], swc_get_theme_version(), true );

	if ( wp_script_is( 'swc-superfish', 'enqueued' ) ) {
		wp_enqueue_script( 'swc-superfish-args', get_template_directory_uri() . '/assets/js/min/superfish-args.js', [ 'jquery' ], swc_get_theme_version(), true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'swc_scripts', 15 );

add_action( 'admin_enqueue_scripts', function() {
	wp_enqueue_media();
} );

/**
 * Update nav menu item with image
 * 
 * @param int   $menu_id         ID of the updated menu.
 * @param int   $menu_item_db_id ID of the updated menu item.
 * @param array $args            An array of arguments used to update a menu item.
 */
add_action( 'wp_update_nav_menu_item', function( $menu_id, $menu_item_db_id, $args ) {
	if ( isset( $_POST[ 'menu-item-image-id' ][ $menu_item_db_id ] ) ) {
		update_post_meta( $menu_item_db_id, '_menu_item_image_id', absint( $_POST[ 'menu-item-image-id' ][ $menu_item_db_id ] ) );
	}
}, 10, 3 );

add_action( 'admin_footer', function() {
	?>

	<script type="text/template" id="nav-menu-item-image-field">
		<p class="field-image-attribute description description-wide">
			<span class="menu-item-image-container" style="float: left; margin: 0 15px 0 0;"></span>
			<label style="display: inline-block; margin: 0 0 5px;"><?php _e( 'Navigation Image' ); ?></label><br>
			<button class="button-secondary select-menu-item-image"><?php _e( 'Select Image' ); ?></button>
			<input type="hidden" name="menu-item-image-id[%d]" value="" />
		</p>
	</script>

	<script>
		( function( $ ) {

			$( document ).on( 'ready menu-item-added', function() {
				$nav_items = $( '.menu-item-settings' );

				$.each( $nav_items, function( i, el ) {
					id = $( el ).find( '.menu-item-data-db-id' ).val();

					if ( $( el ).find( '.field-image-attribute' ).length < 1 ) {
						$( el ).find( '.field-move' ).before( $( '#nav-menu-item-image-field' ).clone().html().replace( '%d', id ) );

					}
				} );
			} );

			$( '#menu-to-edit' ).on( 'click', '.select-menu-item-image', function( e ) {
				e.preventDefault();

				var $nav_item = $( this ).closest( '.menu-item-settings' );

				var uploader = wp.media( {
						title: 'test',
						button: { text: 'test2' },
						multiple: false
					} ).on( 'select', function () {
						var attachment = uploader.state().get( 'selection' ).first().toJSON();

						$nav_item.find( '[name="menu-item-data-image-id"]' ).val( attachment.id );
						$nav_item.find( '.menu-item-image-container' ).html( '<img src="' + attachment.sizes.thumbnail.url + '" height="75" width="auto" />' );

						console.log( attachment );
						//menuImageUpdate( item_id, attachment.id, is_hover );
					} ).open();
			} );

		} )( jQuery );
	</script>

	<?php
} );