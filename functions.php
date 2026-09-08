<?php
/** 
 * Functions for theme Hello-Theme
 * Sets up theme defaults and registers support for various WordPress features.
 * 
 * @package    ClassicPress
 * @subpackage Hello Theme
 * @since      1.0.1
 *
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !defined ( 'STARTMEUP_VER' ) ) { define ( 'STARTMEUP_VER', '1.0.0' ); }

/** 
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own startmeup_child_setup() function to override in a child theme.
 * 
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * @since Hello Theme 1.0
 */
if ( ! function_exists( 'startmeup_theme_setup' ) ) :

function startmeup_theme_setup() {
    /**
     * Not used in ClassicPress > 2.0 
     * to output valid HTML5.
     */ 
    if ( function_exists( 'is_classicpress' ) && version_compare( '2.0', $cp_version, '<' ) ) {
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )); 
    }
           
    /**
	* Make theme available for translation.
	* Translations can be added to the /languages/ directory.
	*/
    load_theme_textdomain( 'startmeup', get_template_directory_uri() . '/languages' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Main Menu', 'hello-theme' ),
        )
    );

    /*
		 * Let ClassicPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		add_theme_support( 'post-thumbnails', array( 'post', 'page') );
		// register new phone-landscape featured image size. @width, @height, and @crop
		add_image_size( 'startmeup-featured', 520, 300, false);

        /*
		 * Enable support for custom logo.
		 *
		 *  @since Classic Sixteen 1.2
		 */
		add_theme_support( 'custom-logo' );

		//page background image and color support
		add_theme_support( 'custom-background', 
			array( 
		   'default-color'      => '#fcfcfc',
		   'default-image'       => '',
		   'wp-head-callback'     => '_custom_background_cb',
		   'admin-head-callback'   => '',
		   'admin-preview-callback' => ''
		) );
		//add_theme_support( 'custom-logo' );
}

add_action( 'after_setup_theme', 'startmeup_theme_setup' );
endif;


/**
 * `wp_body_open` Tag may or may not be needed but accommodate for it.
 * 
 * @since 1.0
 */
if ( ! function_exists( 'wp_body_open' ) ) :
    /**
    * Add backwards compatibility support for wp_body_open function.
    */
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
endif;

/** 
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since 1.0
 */
function startmeup_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters( 'startmeup_content_width', 680 );
}

add_action( 'after_setup_theme',        'startmeup_theme_content_width', 0 ); 

/** 
 * Enqueues scripts and styles.
 *
 * @since 1.0.0 
 */
function startmeup_enqueue_styles() {
	wp_enqueue_style( 
		'hello-theme-style', 
		get_stylesheet_directory_uri() .'/style.css',
		array(),
		STARTMEUP_VER
	);
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 
			'comment-reply' 
		);
	}
}
add_action( 'wp_enqueue_scripts',       'startmeup_enqueue_styles' );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since 1.0
 */
function startmeup_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'hello-theme' ),
			'id'            => 'sidebar-page',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'hello-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init',             'startmeup_widgets_init' );

/** 
 * Attachment render for excerpts
 *
 * @since 1.0.2
 * @return HTML
 */

function startmeup_excerpt_attachment_toanchor(){

	?>                 
		<figure class="linked-attachment-container-sm">
		<a class="exceprtwrap-link"
		   href ="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>" 
		   title="<?php the_title_attribute( 'before=Permalink to: &after=' ); ?>">
		<?php 
		the_post_thumbnail( 'startmeup-featured', array( 
				'itemprop' => 'image', 
				'class'  => 'startmeup-featured',
				'alt'  => get_the_title()
			) 
		); ?></a>
		</figure><?php 
}
add_action( 'startmeup_excerpt_attachment', 'startmeup_excerpt_attachment_toanchor' );

/**
 * Support for logo upload, output. 
 *
 * @since 1.0.1 
 */
function startmeup_theme_custom_logo() {
    $output = '';

    if ( function_exists( 'the_custom_logo' ) ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo           = wp_get_attachment_image_src( $custom_logo_id , 'full' );

        if ( has_custom_logo() ) {
            $output = '<div class="header-logo"><img src="'. esc_url( $logo[0] ) .'" 
            alt="'. get_bloginfo( 'name' ) .'"></div>'; 
        } else { 
            $output = ''; 
        }
    }

        // Output sanitized in header to assure all html displays.
        return $output;
}

/** 
 * Customizer
 * suport footer background & text color
 * header background & color
 * page background & color
 */

/* Adding files here to apply to the following functions below */
//require get_template_directory() . '/inc/customizer.php';
