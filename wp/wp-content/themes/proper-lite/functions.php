<?php
/**
 * proper-lite functions and definitions
 *
 * @package proper-lite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */ 
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'proper_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function proper_lite_setup() {  

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on proper-lite, use a find and replace
	 * to change 'proper-lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'proper-lite', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'proper-lite-max-control', 1600 );
	add_image_size( 'proper-lite-client-thumb', 250 );
	add_image_size( 'proper-lite-project-thumb', 800, 800, array( 'center', 'center' ) );
	add_image_size( 'proper-lite-team-thumb', 300, 300, array( 'center', 'center' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'proper-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'proper_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // proper-lite_setup
add_action( 'after_setup_theme', 'proper_lite_setup' );


/*-----------------------------------------------------------------------------------------------------//
	Register Widgets
	
	@link http://codex.wordpress.org/Function_Reference/register_sidebar
-------------------------------------------------------------------------------------------------------*/


function proper_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'proper-lite' ), 
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area #1', 'proper-lite' ),
		'id'            => 'home-widget-area-one',
		'description'   => esc_html__( 'Use this widget area to display home page content', 'proper-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area #2', 'proper-lite' ),
		'id'            => 'home-widget-area-two',
		'description'   => esc_html__( 'Use this widget area to display home page content', 'proper-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Social Widget Area', 'proper-lite' ),
		'id'            => 'social-widget-area', 
		'description'   => esc_html__( 'Drag the MT - Social Icons widget here.', 'proper-lite' ),
		'before_widget' => '',
		'after_widget'  => '', 
		'before_title'  => '',
		'after_title'   => '',
	) ); 
	
	
	//Register the sidebar widgets   
	register_widget( 'proper_lite_Video_Widget' ); 
	register_widget( 'proper_lite_Contact_Info' );
	register_widget( 'proper_lite_social' );
	register_widget( 'proper_lite_action' );
	register_widget( 'proper_lite_home_news' );
	
	
}
add_action( 'widgets_init', 'proper_lite_widgets_init' ); 

/*-----------------------------------------------------------------------------------------------------//
	Scripts
-------------------------------------------------------------------------------------------------------*/

function proper_lite_scripts() {
	wp_enqueue_style( 'proper-lite-style', get_stylesheet_uri() );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts'));
	
	if( $headings_font ) {
		wp_enqueue_style( 'proper-lite-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );	
	} else {
		wp_enqueue_style( 'proper-lite-open-headings', '//fonts.googleapis.com/css?family=Playfair+Display:400,400italic|Source+Sans+Pro:400,600,300italic|Montserrat:700');   
	}	
	if( $body_font ) {
		wp_enqueue_style( 'proper-lite-body-fonts', '//fonts.googleapis.com/css?family='. $body_font ); 	
	} else {
		wp_enqueue_style( 'proper-lite-open-body', '//fonts.googleapis.com/css?family=Playfair+Display:400,400italic|Source+Sans+Pro:400,600,300italic|Montserrat:700');  
	}


	if ( get_theme_mod('proper_lite_animate') != 1 ) { 
	
	wp_enqueue_style( 'proper-lite-animate', get_template_directory_uri() . '/css/animate.css' );
	
	}  
		
    wp_enqueue_style( 'proper-lite-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.css' );

	wp_enqueue_style( 'proper-lite-sidr', get_template_directory_uri() . '/css/jquery.sidr.dark.css' );
	
	wp_enqueue_style( 'proper-lite-slick', get_template_directory_uri() . '/css/slick.css' );
	
	wp_enqueue_style( 'proper-lite-column-clear', get_template_directory_uri() . '/css/mt-column-clear.css' );

	wp_enqueue_script( 'proper-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'proper-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'proper-lite-sidr', get_template_directory_uri() . '/js/jquery.sidr.js', array('jquery'), false, true );

	wp_enqueue_script( 'proper-lite-menu-script', get_template_directory_uri() . '/js/menu.script.js', array(), false, true );

	wp_enqueue_script( 'proper-lite-parallax', get_template_directory_uri() . '/js/parallax.min.js', array('jquery'), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'proper_lite_scripts' );

/**
 * Load html5shiv
 */
function proper_lite_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'proper_lite_html5shiv' );


/*-----------------------------------------------------------------------------------------------------//
	Includes
-------------------------------------------------------------------------------------------------------*/ 

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';
require get_template_directory() . '/panel/theme-admin-page.php'; 

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php';  

/**
 * register your custom widgets
 */ 
 
include( get_template_directory() . '/inc/widgets.php' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/proper-lite-styles.php';
require get_template_directory() . '/inc/proper-lite-sanitize.php';
require get_template_directory() . '/inc/proper-lite-active-options.php';

/**
 * Sidebar widget columns
 */
require get_template_directory() . '/inc/proper-lite-sidebar-columns.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
