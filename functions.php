<?php
/**
 * thenow functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package thenow
 */

if ( ! function_exists( 'thenow_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thenow_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thenow, use a find and replace
		 * to change 'thenow' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'thenow', get_template_directory() . '/languages' );

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
			'main-menu' => esc_html__( 'Main menu', 'thenow' ),
			'footer-menu' => esc_html__( 'Footer menu', 'thenow' ),
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
		add_theme_support( 'custom-background', apply_filters( 'thenow_custom_background_args', array(
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
add_action( 'after_setup_theme', 'thenow_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thenow_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'thenow_content_width', 640 );
}
add_action( 'after_setup_theme', 'thenow_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thenow_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'thenow' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'thenow' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'thenow_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thenow_scripts() {
	// style css
	$style_ver = filemtime( get_stylesheet_directory() . '/style.css' );
	$custom_js = filemtime( get_stylesheet_directory() . '/js/custom.js' );
	wp_enqueue_style( 'blanktheme-style', get_stylesheet_uri(),'',$style_ver );

	//bootstrap css
	wp_enqueue_style( 'bootstrap-blanktheme', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '20151215', false );
	//font-awesome
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '20151215', false );
	//owl css
	wp_enqueue_style( 'owl-default', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), '20151215', false );
	//owl theme default
	wp_enqueue_style( 'owl-default', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array(), '20151215', false );

	//jquery library
	wp_enqueue_script( 'slim-min', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '20151215', true );
	//popper 
	wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), '20151215', true );
	// bootstrap js
	wp_enqueue_script( 'bootstrap-min', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), '20151215', true );
	// owl js
	wp_enqueue_script( 'owl-min', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array(), '20151215', true );
	// owl js
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array(), $custom_js, true );
	// navigation js
	wp_enqueue_script( 'thenow-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	// skip-link-focus-fix js
	wp_enqueue_script( 'thenow-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thenow_scripts' );

/**
 * Classic editor
 */
add_filter( 'use_block_editor_for_post', '__return_false' );

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
 * Create custom post type
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Create taxonomy
 */
require get_template_directory() . '/inc/taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Resize image
 * how to use: get_image(array(600,400),$class='',$url = '',$title = '');
 */
require get_template_directory() . '/inc/aq_resizer.php';