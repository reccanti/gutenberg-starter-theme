<?php
/**
 * gutenberg-starter-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gutenberg-starter-theme
 */

if ( ! function_exists( 'gutenberg_starter_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gutenberg_starter_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on gutenberg-starter-theme, use a find and replace
		 * to change 'gutenberg-starter-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gutenberg-starter-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'gutenberg-starter-theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'gutenberg_starter_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gutenberg_starter_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gutenberg_starter_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'gutenberg_starter_theme_content_width', 0 );

/**
 * Register Google Fonts
 */
function gutenberg_starter_theme_fonts_url() {
	$fonts_url = '';

	/*
	 *Translators: If there are characters in your language that are not
	 * supported by Noto Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$notoserif = esc_html_x( 'on', 'Noto Serif font: on or off', 'gutenberg-starter-theme' );

	if ( 'off' !== $notoserif ) {
		$font_families = array();
		$font_families[] = 'Noto Serif:400,400italic,700,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

/**
 * Enqueue scripts and styles.
 */
function gutenberg_starter_theme_scripts() {
	wp_enqueue_style( 'gutenbergbase-style', get_stylesheet_uri() );

	wp_enqueue_style( 'gutenberg-starter-themeblocks-style', get_template_directory_uri() . '/css/blocks.css' );

	wp_enqueue_style( 'gutenberg-starter-theme-fonts', gutenberg_starter_theme_fonts_url() );

	wp_enqueue_script( 'gutenberg-starter-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'gutenberg-starter-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gutenberg_starter_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Theme Settings
 */
require get_template_directory() . '/inc/theme-options.php';


/**
 * @TODO I'M JUST PUTTING THIS HERE FOR NOW!!!
 * 
 * In the future, we might need to clean up this file and figue
 * out what scripts we ACTUALLY want to put here. For now, I'm
 * just leaving it all in so I don't break anything 😬
 * ~reccanti 4/14/2021
 */
function apple_2000_setup() {
	wp_enqueue_style( 'apple2000', get_template_directory_uri() . '/node_modules/@meteorcity/apple2000/dist/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'apple_2000_setup' );


function apple_2000_customize_register( $wp_customize ) {
	// register the new section
	$wp_customize->add_section( 'apple_2000_identity' , array(
    'title'      => __( 'Apple 2000', 'Apple 2000' ),
    'priority'   => 1000,
	) );

	// register the field to enter this
	$wp_customize->add_setting('apple_2000_banner', array());
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'apple_2000_banner',
		array(
				'label'      => __( 'Banner', 'textdomain' ),
				'description' => __( 'Banner that will appear at the top and bottom of the site', 'textdomain' ),
				'settings'   => 'apple_2000_banner',
				'priority'   => 10,
				'section'    => 'apple_2000_identity',
				'type'       => 'text',
		)
	) );
}
add_action( 'customize_register', 'apple_2000_customize_register' );

function apple_2000_customize_comic_image($attributes) {
	if (is_webcomic()) {
		$attributes["class"] = "Comic-image";
	}
	return $attributes;
}
add_filter('wp_get_attachment_image_attributes', 'apple_2000_customize_comic_image');

function apple_2000_customize_comic_links($classes, $args, $comic) {
	$classes[] = "link-button";
	if ($args["relation"] == "first")    : $classes[] = "Comic-firstLink";    endif;
	if ($args["relation"] == "previous") : $classes[] = "Comic-previousLink"; endif;
	if ($args["relation"] == "next")     : $classes[] = "Comic-nextLink";     endif;
	if ($args["relation"] == "last")     : $classes[] = "Comic-lastLink";     endif;
	return $classes;
}
add_filter('get_webcomic_link_class', 'apple_2000_customize_comic_links', 10, 3);