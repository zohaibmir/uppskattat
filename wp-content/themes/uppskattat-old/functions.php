<?php
/*-----------------------------------------------------------------------------------*/
/*	Do not remove these lines, sky will fall on your head.
/*-----------------------------------------------------------------------------------*/
define( 'MTS_THEME_NAME', 'sociallyviral' );
require_once( dirname( __FILE__ ) . '/theme-options.php' );
if ( ! isset( $content_width ) ) $content_width = 1060;

/*-----------------------------------------------------------------------------------*/
/*	Load Options
/*-----------------------------------------------------------------------------------*/
$mts_options = get_option( MTS_THEME_NAME );

/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/
load_theme_textdomain( 'mythemeshop', get_template_directory().'/lang' );

// Custom translations
if ( !empty( $mts_options['translate'] )) {
    $mts_translations = get_option( 'mts_translations_'.MTS_THEME_NAME );//$mts_options['translations'];
    function mts_custom_translate( $translated_text, $text, $domain ) {
        if ( $domain == 'mythemeshop' || $domain == 'nhp-opts' ) {
            global $mts_translations;
            if ( !empty( $mts_translations[$text] )) {
                $translated_text = $mts_translations[$text];
            }
        }
    	return $translated_text;
        
    }
    add_filter( 'gettext', 'mts_custom_translate', 20, 3 );
}

if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/*	Disable theme updates from WordPress.org theme repository
/*-----------------------------------------------------------------------------------*/
function mts_disable_theme_update( $r, $url ) {
    if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}
add_filter( 'http_request_args', 'mts_disable_theme_update', 5, 2 );
add_filter( 'auto_update_theme', '__return_false' );

/*-----------------------------------------------------------------------------------*/
/*	Post Thumbnail Support
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 379, 297, true );
	add_image_size( 'featured', 370, 297, true ); //featured
    add_image_size( 'featuredbig', 770, 297, true); //featured big
	add_image_size( 'related', 235, 190, true ); //related
	add_image_size( 'widgetthumb', 75, 75, true ); //widget
    add_image_size( 'widgetfull', 300, 172, true ); //sidebar full width
}

function mts_get_thumbnail_url( $size = 'full' ) {
    global $post;
    if (has_post_thumbnail( $post->ID ) ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
        return $image[0];
    }
    
    // use first attached image
    $images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
    if (!empty($images)) {
        $image = reset($images);
        $image_data = wp_get_attachment_image_src( $image->ID, $size );
        return $image_data[0];
    }
        
    // use no preview fallback
    if ( file_exists( get_template_directory().'/images/nothumb-'.$size.'.png' ) )
        return get_template_directory_uri().'/images/nothumb-'.$size.'.png';
    else
        return '';
}

/*-----------------------------------------------------------------------------------*/
/*  CREATE AND SHOW COLUMN FOR FEATURED IN PORTFOLIO ITEMS LIST ADMIN PAGE
/*-----------------------------------------------------------------------------------*/

//Get Featured image
function mts_get_featured_image($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {  
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'widgetfull');  
        return $post_thumbnail_img[0];  
    }  
} 
function mts_columns_head($defaults) {  
    if (get_post_type() == 'post')
        $defaults['is_featured_post'] = '<div class="dashicons dashicons-star-filled" title="'.__('Featured Post').'"></div>';

    if (get_post_type() == 'post' || get_post_type() == 'page')
        $defaults['featured_image'] = __('Featured Image', 'mythemeshop');

    return $defaults;  
}  
function mts_columns_content($column_name, $post_ID) {  
    if ($column_name == 'featured_image') {  
        $post_featured_image = mts_get_featured_image($post_ID);  
        if ($post_featured_image) {  
            echo '<img width="150" height="100" src="' . $post_featured_image . '" />';  
        }  
    } elseif ($column_name == 'is_featured_post') {  
        if (get_post_meta( $post_ID, 'mts_featured', true )) {
            echo '<div class="dashicons dashicons-star-filled" title="'.__('Featured Post').'"></div>';
        } else {
            echo '<div class="dashicons dashicons-star-empty" title="'.__('Not a Featured Post').'"></div>';
        }
    }  
}
function mts_posts_admin_head() {
    echo '<style type="text/css">';
    echo 'td.column-is_featured_post, #is_featured_post { width: 20px; }';
    echo '#is_featured_post .dashicons { color: #222; }';
    echo '.column-is_featured_post .dashicons { color: #888; }';
    echo '</style>';
}
add_action('admin_head-edit.php', 'mts_posts_admin_head');
add_filter('manage_posts_columns', 'mts_columns_head');  
add_action('manage_posts_custom_column', 'mts_columns_content', 10, 2);

/*-----------------------------------------------------------------------------------*/
/*	Use first attached image as post thumbnail (fallback)
/*-----------------------------------------------------------------------------------*/
add_filter( 'post_thumbnail_html', 'mts_post_image_html', 10, 5 );
function mts_post_image_html( $html, $post_id, $post_image_id, $size, $attr ) {
    if ( has_post_thumbnail() )
        return $html;
    
    // use first attached image
    $images = get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post_id );
    if (!empty($images)) {
        $image = reset($images);
        return wp_get_attachment_image( $image->ID, $size, false, $attr );
    }
        
    // use no preview fallback
    if ( file_exists( get_template_directory().'/images/nothumb-'.$size.'.png' ) )
        return '<img src="'.get_template_directory_uri().'/images/nothumb-'.$size.'.png" class="attachment-'.$size.' wp-post-image" alt="'.get_the_title().'">';
    else
        return '';
    
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Menu Support
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'primary-menu' => __( 'Header Menu', 'mythemeshop' ),
          'footer-menu' => __( 'Footer Menu', 'mythemeshop' ),
		 )
	 );
}

/*-----------------------------------------------------------------------------------*/
/*	Enable Widgetized sidebar and Footer
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'register_sidebar' ) ) {   
    function mts_register_sidebars() {
        $mts_options = get_option( MTS_THEME_NAME );
        
        // Default sidebar
        register_sidebar( array(
            'name' => 'Sidebar',
            'description'   => __( 'Default sidebar.', 'mythemeshop' ),
            'id' => 'sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        // Homepage Widget
        register_sidebar(array(
            'name' => 'Homepage Widget Area',
            'description'   => __( 'Appears on the homepage, after second or third post', 'mythemeshop' ),
            'id' => 'widget-home',
            'before_widget' => '<div id="%1$s" class="widget-home">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        // Top level footer widget areas
        if ( !empty( $mts_options['mts_top_footer'] )) {
            if ( empty( $mts_options['mts_top_footer_num'] )) $mts_options['mts_top_footer_num'] = 4;
            register_sidebars( $mts_options['mts_top_footer_num'], array(
                'name' => __( 'Top Footer %d', 'mythemeshop' ),
                'description'   => __( 'Appears at the top of the footer.', 'mythemeshop' ),
                'id' => 'footer-top',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ) );
        }
        
        // Custom sidebars
        if ( !empty( $mts_options['mts_custom_sidebars'] ) && is_array( $mts_options['mts_custom_sidebars'] )) {
            foreach( $mts_options['mts_custom_sidebars'] as $sidebar ) {
                if ( !empty( $sidebar['mts_custom_sidebar_id'] ) && !empty( $sidebar['mts_custom_sidebar_id'] ) && $sidebar['mts_custom_sidebar_id'] != 'sidebar-' ) {
                    register_sidebar( array( 'name' => ''.$sidebar['mts_custom_sidebar_name'].'', 'id' => ''.sanitize_title( strtolower( $sidebar['mts_custom_sidebar_id'] )).'', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ));
                }
            }
        }
    }
    
    add_action( 'widgets_init', 'mts_register_sidebars' );
}

function mts_custom_sidebar() {
    $mts_options = get_option( MTS_THEME_NAME );
    
	// Default sidebar
	$sidebar = 'Sidebar';

	if ( is_home() && !empty( $mts_options['mts_sidebar_for_home'] )) $sidebar = $mts_options['mts_sidebar_for_home'];	
    if ( is_single() && !empty( $mts_options['mts_sidebar_for_post'] )) $sidebar = $mts_options['mts_sidebar_for_post'];
    if ( is_page() && !empty( $mts_options['mts_sidebar_for_page'] )) $sidebar = $mts_options['mts_sidebar_for_page'];
    
	// Page/post specific custom sidebar
	if ( is_page() || is_single() ) {
		wp_reset_postdata();
		global $post;
        $custom = get_post_meta( $post->ID, '_mts_custom_sidebar', true );
		if ( !empty( $custom )) $sidebar = $custom;
	}

	return $sidebar;
}

/*-----------------------------------------------------------------------------------*/
/*  Load Widgets, Actions and Libraries
/*-----------------------------------------------------------------------------------*/

// Add the 125x125 Ad Block Custom Widget
include_once( "functions/widget-ad125.php" );

// Add the 300x250 Ad Block Custom Widget
include_once( "functions/widget-ad300.php" );

// Add the Latest Tweets Custom Widget
include_once( "functions/widget-tweets.php" );

// Add Recent Posts Widget
include_once( "functions/widget-recentposts.php" );

// Add Related Posts Widget
include_once( "functions/widget-relatedposts.php" );

// Add Author Posts Widget
include_once( "functions/widget-authorposts.php" );

// Add Popular Posts Widget
include_once( "functions/widget-popular.php" );

// Add Facebook Like box Widget
include_once( "functions/widget-fblikebox.php" );

// Add Social Profile Widget
include_once( "functions/widget-social.php" );

// Add Category Posts Widget
include_once( "functions/widget-catposts.php" );

// Add Welcome message
include_once( "functions/welcome-message.php" );

// Template Functions
include_once( "functions/theme-actions.php" );

// Post/page editor meta boxes
include_once( "functions/metaboxes.php" );

// TGM Plugin Activation
include_once( "functions/plugin-activation.php" );

// AJAX Contact Form - mts_contact_form()
include_once( 'functions/contact-form.php' );

// Custom menu walker
include_once( 'functions/nav-menu.php' );


if ( class_exists( 'wp_review_tab_widget' ) ) {
    add_action( 'widgets_init', 'unregister_wp_review_tab_widget', 15 );
    add_action( 'widgets_init', 'sociallyviral_review_tab_widget', 1 );
}

function unregister_wp_review_tab_widget() {
    unregister_widget( 'wp_review_tab_widget' );
}
function sociallyviral_review_tab_widget() {
    include_once( 'functions/widget-review-tab.php' );
    register_widget( 'nt_wp_review_tab_widget' );
}

if ( class_exists( 'wpt_widget' ) ) {

    add_action( 'widgets_init', 'unregister_wp_tab_widget', 15 );
    add_action( 'widgets_init', 'sociallyviral_tabs_widget', 1 );
}

function unregister_wp_tab_widget() {
    unregister_widget( 'wpt_widget' );
}
function sociallyviral_tabs_widget() {
    include("functions/widget-tabs.php");
    register_widget( 'sociallyviral_tabs_widget' );
}

/*-----------------------------------------------------------------------------------*/
/*	RTL language support - also in mts_load_footer_scripts()
/*-----------------------------------------------------------------------------------*/
if ( ! empty( $mts_options['mts_rtl'] ) ) {
    function mts_rtl() {
        global $wp_locale, $wp_styles;
        $wp_locale->text_direction = 'rtl';
    	if ( ! is_a( $wp_styles, 'WP_Styles' ) ) {
    		$wp_styles = new WP_Styles();
    		$wp_styles->text_direction = 'rtl';
    	}
    }
    add_action( 'init', 'mts_rtl' );
}

/*-----------------------------------------------------------------------------------*/
/*	Filters customize wp_title
/*-----------------------------------------------------------------------------------*/
function mts_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'mythemeshop' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'mts_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/*	Javascript
/*-----------------------------------------------------------------------------------*/
function mts_nojs_js_class() {
    echo '<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace( /\bno-js\b/,\'js\' );</script>';
}
add_action( 'wp_head', 'mts_nojs_js_class', 1 );

function mts_add_scripts() {
	$mts_options = get_option( MTS_THEME_NAME );

	wp_enqueue_script( 'jquery' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_register_script( 'customscript', get_template_directory_uri() . '/js/customscript.js', true );
    if ( ! empty( $mts_options['mts_show_primary_nav'] ) ) {
        $nav_menu = 'both';
    } else {
        $nav_menu = 'footer';
    }
    wp_localize_script(
    	'customscript',
    	'mts_customscript',
    	array(
			'responsive' => ( empty( $mts_options['mts_responsive'] ) ? false : true ),
            'nav_menu' => $nav_menu
    	 )
    );
	wp_enqueue_script( 'customscript' );

	global $is_IE;
    if ( $is_IE ) {
        wp_register_script ( 'html5shim', "http://html5shim.googlecode.com/svn/trunk/html5.js" );
        wp_enqueue_script ( 'html5shim' );
	}
    
}
add_action( 'wp_enqueue_scripts', 'mts_add_scripts' );
   
function mts_load_footer_scripts() {  
	$mts_options = get_option( MTS_THEME_NAME );
	
    // Parallax pages and posts
    if (is_singular()) {
        if ( basename( mts_get_post_template() ) == 'singlepost-parallax.php' || basename( get_page_template() ) == 'page-parallax.php' ) {
            wp_register_script ( 'jquery-parallax', get_template_directory_uri() . '/js/parallax.js' );
            wp_enqueue_script ( 'jquery-parallax' );
        }
    }

	//Lightbox
	if ( ! empty( $mts_options['mts_lightbox'] ) ) {
		wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', true );
		wp_enqueue_script( 'prettyPhoto' );
	}
	
	//Sticky Nav
	if ( ! empty( $mts_options['mts_sticky_nav'] ) ) {
		wp_register_script( 'StickyNav', get_template_directory_uri() . '/js/sticky.js', true );
		wp_enqueue_script( 'StickyNav' );
	}
    
    // Ajax Load More and Search Results
    wp_register_script( 'mts_ajax', get_template_directory_uri() . '/js/ajax.js', true );
	if( ! empty( $mts_options['mts_pagenavigation_type'] ) && $mts_options['mts_pagenavigation_type'] >= 2 && !is_singular() ) {
		wp_enqueue_script( 'mts_ajax' );
        
        wp_register_script( 'historyjs', get_template_directory_uri() . '/js/history.js', true );
        wp_enqueue_script( 'historyjs' );
        
        // Add parameters for the JS
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
        $autoload = ( $mts_options['mts_pagenavigation_type'] == 3 );
        wp_localize_script(
        	'mts_ajax',
        	'mts_ajax_loadposts',
        	array(
        		'startPage' => $paged,
        		'maxPages' => $max,
        		'nextLink' => next_posts( $max, false ),
                'autoLoad' => $autoload,
                'i18n_loadmore' => __( 'Load More', 'mythemeshop' ),
                'i18n_loading' => __('Loading...', 'mythemeshop'),
                'i18n_nomore' => __( 'No more posts.', 'mythemeshop' )
        	 )
        );
	}
    if ( ! empty( $mts_options['mts_ajax_search'] ) ) {
        wp_enqueue_script( 'mts_ajax' );
        wp_localize_script(
        	'mts_ajax',
        	'mts_ajax_search',
        	array(
				'url' => admin_url( 'admin-ajax.php' ),
        		'ajax_search' => '1'
        	 )
        );
    }
    
}  
add_action( 'wp_footer', 'mts_load_footer_scripts' );  

if( !empty( $mts_options['mts_ajax_search'] )) {
    add_action( 'wp_ajax_mts_search', 'ajax_mts_search' );
    add_action( 'wp_ajax_nopriv_mts_search', 'ajax_mts_search' );
}

/*-----------------------------------------------------------------------------------*/
/* Enqueue CSS
/*-----------------------------------------------------------------------------------*/
function mts_enqueue_css() {
	$mts_options = get_option( MTS_THEME_NAME );

    wp_enqueue_style( 'stylesheet', get_stylesheet_directory_uri() . '/style.css', 'style' );
	
	// Lightbox
	if ( ! empty( $mts_options['mts_lightbox'] ) ) {
		wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'style' );
		wp_enqueue_style( 'prettyPhoto' );
	}
	
	//Font Awesome
	wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', 'style' );
	wp_enqueue_style( 'fontawesome' );
	
	//Responsive
	if ( ! empty( $mts_options['mts_responsive'] ) ) {
        wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', 'style' );
	}

    // RTL
    if ( ! empty( $mts_options['mts_rtl'] ) ) {
        wp_register_style( 'mts_rtl', get_template_directory_uri() . '/css/rtl.css', 'style', true );
        wp_enqueue_style( 'mts_rtl' );
    }
	
    $mts_bg = '';
	if ( $mts_options['mts_bg_pattern_upload'] != '' ) {
		$mts_bg = $mts_options['mts_bg_pattern_upload'];
	} else {
		if( !empty( $mts_options['mts_bg_pattern'] )) {
			$mts_bg = get_template_directory_uri().'/images/'.$mts_options['mts_bg_pattern'].'.png';
		}
	}
	$mts_sclayout = '';
	$mts_shareit_left = '';
	$mts_shareit_right = '';
	$mts_author = '';
	$mts_header_section = '';
    if ( is_page() || is_single() ) {
        $mts_sidebar_location = get_post_meta( get_the_ID(), '_mts_sidebar_location', true );
    } else {
        $mts_sidebar_location = '';
    }
	if ( $mts_sidebar_location != 'right' && ( $mts_options['mts_layout'] == 'sclayout' || $mts_sidebar_location == 'left' )) {
		$mts_sclayout = '.article { float: right;}
		.sidebar.c-4-12 { float: left; }';
		if( isset( $mts_options['mts_social_button_position'] ) && $mts_options['mts_social_button_position'] == 'floating' ) {
			$mts_shareit_right = '.shareit { margin: 0 760px 0; border-left: 0; }';
		}
	}
	if ( empty( $mts_options['mts_header_section2'] ) ) {
		$mts_header_section = '.logo-wrap { display: none; } #header .header-search { float: left; margin-left: 25px; }';
	}
	if ( isset( $mts_options['mts_social_button_position'] ) && $mts_options['mts_social_button_position'] == 'floating' ) {
		$mts_shareit_left = '.shareit { top: 282px; left: auto; z-index: 0; margin: 0 0 0 -123px; width: 90px; position: fixed; overflow: hidden; padding: 5px; border:none; border-right: 0;}
		.share-item {margin: 2px;}';
	}
	if ( ! empty( $mts_options['mts_author_comment'] ) ) {
		$mts_author = '.bypostauthor {padding: 3%!important; background: #FAFAFA; width: 94%!important;}
		.bypostauthor:after { content: "'.__( 'Author', 'mythemeshop' ).'"; position: absolute; right: -1px; top: -1px; padding: 1px 10px; background: #818181; color: #FFF; }';
	}
	$custom_css = "
		body, .sidebar.c-4-12, #commentform textarea, input#author, input#email, input#url {background-color:{$mts_options['mts_bg_color']}; }
		body {background-image: url( {$mts_bg} );}
        .pace .pace-progress, #mobile-menu-wrapper ul li a:hover { background: {$mts_options['mts_color_scheme']}; }
		.single_post a, .widget .textwidget a, #logo a, .pnavigation2 a, .sidebar.c-4-12 a:hover, footer .widget li a:hover, .sidebar.c-4-12 a:hover, .related-posts a:hover, .title a:hover, .comm, #tabber .inside li a:hover, .readMore a:hover, .fn a, a, span.author-posts a:hover { color:{$mts_options['mts_color_scheme']}; }	
			nav a#pull, .mts-subscribe input[type='submit'], #move-to-top:hover, #navigation ul .current-menu-item a, .pagination a, #tabber ul.tabs li a.selected, .tagcloud a:hover, #navigation ul .sfHover a, .primary-navigation, #navigation ul ul, .single_post .thecategory, .single-prev-next a:hover, #commentform input#submit:hover, .contactform #submit:hover, .latestPost .latestPost-review-wrapper, .latestPost .review-type-circle.latestPost-review-wrapper, .post-label, .widget .review-total-only, #wpmm-megamenu .review-total-only { background-color:{$mts_options['mts_color_scheme']}; color: #fff!important; }
        a:hover, .copyrights a:hover, .latestPost .title a:hover, span.author-posts a, .single_post .post-info a:hover { color: {$mts_options['mts_color_scheme_2']}; }
        #searchform .fa-search, .currenttext, .pagination a:hover, .pagination .nav-previous a:hover, .pagination .nav-next a:hover, .single-prev-next a , #commentform input#submit, .contactform #submit, .tagcloud a { background: {$mts_options['mts_color_scheme_2']}; color: #fff; }
        input#author:hover, input#email:hover, input#url:hover, #comment:hover, .contact-form input:hover, .contact-form textarea:hover { border-color: {$mts_options['mts_color_scheme_2']}; }
		{$mts_sclayout}
		{$mts_shareit_left}
		{$mts_shareit_right}
		{$mts_author}
		{$mts_header_section}
		{$mts_options['mts_custom_css']}
			";
	wp_add_inline_style( 'stylesheet', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'mts_enqueue_css', 99 );

/*-----------------------------------------------------------------------------------*/
/*	Wrap videos in .responsive-video div
/*-----------------------------------------------------------------------------------*/
function mts_responsive_video( $data ) {
    return '<div class="flex-video">' . $data . '</div>';
}
add_filter( 'embed_oembed_html', 'mts_responsive_video' );

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'the_content_rss', 'do_shortcode' );

/*-----------------------------------------------------------------------------------*/
/*	Custom Comments template
/*-----------------------------------------------------------------------------------*/
function mts_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; 
    $mts_options = get_option( MTS_THEME_NAME ); ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" itemprop="comment" itemscope itemtype="http://schema.org/UserComments">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment->comment_author_email, 60 ); ?>
				<?php printf( '<span class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person"><span itemprop="name">%s</span></span>', get_comment_author_link() ) ?> 
				<?php if ( ! empty( $mts_options['mts_comment_date'] ) ) { ?>
					<span class="ago"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . __(' ago','mythemeshop'); ?></span>
				<?php } ?>
				<span class="comment-meta">
					<?php edit_comment_link( __( '( Edit )', 'mythemeshop' ), '  ', '' ) ?>
				</span>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'mythemeshop' ) ?></em>
				<br />
			<?php endif; ?>
			<div class="commentmetadata">
                <div class="commenttext" itemprop="commentText">
				    <?php comment_text() ?>
                </div>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] )) ) ?>
				</div>
			</div>
		</div>
	</li>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Excerpt
/*-----------------------------------------------------------------------------------*/

// Increase max length
function mts_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'mts_excerpt_length', 20 );

// Remove [...] and shortcodes
function mts_custom_excerpt( $output ) {
  return preg_replace( '/\[[^\]]*]/', '', $output );
}
add_filter( 'get_the_excerpt', 'mts_custom_excerpt' );

// Truncate string to x letters/words
function mts_truncate( $str, $length = 40, $units = 'letters', $ellipsis = '&nbsp;&hellip;' ) {
    if ( $units == 'letters' ) {
        if ( mb_strlen( $str ) > $length ) {
            return mb_substr( $str, 0, $length ) . $ellipsis;
        } else {
            return $str;
        }
    } else {
        $words = explode( ' ', $str );
        if ( count( $words ) > $length ) {
            return implode( " ", array_slice( $words, 0, $length ) ) . $ellipsis;
        } else {
            return $str;
        }
    }
}

if ( ! function_exists( 'mts_excerpt' ) ) {
    function mts_excerpt( $limit = 40 ) {
      return mts_truncate( get_the_excerpt(), $limit, 'words' );
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Remove more link from the_content and use custom read more
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_content_more_link', 'mts_remove_more_link', 10, 2 );
function mts_remove_more_link( $more_link, $more_link_text ) {
	return '';
}
// shorthand function to check for more tag in post
function mts_post_has_moretag() {
    global $post;
    return strpos( $post->post_content, '<!--more-->' );
}

if ( ! function_exists( 'mts_readmore' ) ) {
    function mts_readmore() {
        ?>
        <div class="readMore">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow">
                <?php _e( 'Read More', 'mythemeshop' ); ?>
            </a>
        </div>
        <?php 
    }
}

/*-----------------------------------------------------------------------------------*/
/* nofollow to next/previous links
/*-----------------------------------------------------------------------------------*/
function mts_pagination_add_nofollow( $content ) {
    return 'rel="nofollow"';
}
add_filter( 'next_posts_link_attributes', 'mts_pagination_add_nofollow' );
add_filter( 'previous_posts_link_attributes', 'mts_pagination_add_nofollow' );

/*-----------------------------------------------------------------------------------*/
/* Nofollow to category links
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_category', 'mts_add_nofollow_cat' ); 
function mts_add_nofollow_cat( $text ) {
    $text = str_replace( 'rel="category tag"', 'rel="nofollow"', $text ); return $text;
}

/*-----------------------------------------------------------------------------------*/	
/* nofollow post author link
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_author_posts_link', 'mts_nofollow_the_author_posts_link' );
function mts_nofollow_the_author_posts_link ( $link ) {
    return str_replace( '<a href=', '<a rel="nofollow" href=', $link ); 
}

/*-----------------------------------------------------------------------------------*/	
/* nofollow to reply links
/*-----------------------------------------------------------------------------------*/
function mts_add_nofollow_to_reply_link( $link ) {
    return str_replace( '" )\'>', '" )\' rel=\'nofollow\'>', $link );
}
add_filter( 'comment_reply_link', 'mts_add_nofollow_to_reply_link' );

/*-----------------------------------------------------------------------------------*/
/* removes the WordPress version from your header for security
/*-----------------------------------------------------------------------------------*/
function mts_remove_wpversion() {
	return '<!--Theme by MyThemeShop.com-->';
}
add_filter( 'the_generator', 'mts_remove_wpversion' );
	
/*-----------------------------------------------------------------------------------*/
/* Removes Trackbacks from the comment count
/*-----------------------------------------------------------------------------------*/
add_filter( 'get_comments_number', 'mts_comment_count', 0 );
function mts_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
        $comments = get_comments( 'status=approve&post_id=' . $id );
        $comments_by_type = separate_comments( $comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

/*-----------------------------------------------------------------------------------*/
/* adds a class to the post if there is a thumbnail
/*-----------------------------------------------------------------------------------*/
function has_thumb_class( $classes ) {
	global $post;
	if( has_post_thumbnail( $post->ID ) ) { $classes[] = 'has_thumb'; }
		return $classes;
}
add_filter( 'post_class', 'has_thumb_class' );

/*-----------------------------------------------------------------------------------*/	
/* AJAX Search results
/*-----------------------------------------------------------------------------------*/
function ajax_mts_search() {
    $query = $_REQUEST['q']; // It goes through esc_sql() in WP_Query
    $search_query = new WP_Query( array( 's' => $query, 'posts_per_page' => 3 )); 
    $search_count = new WP_Query( array( 's' => $query, 'posts_per_page' => -1 ));
    $search_count = $search_count->post_count;
    if ( !empty( $query ) && $search_query->have_posts() ) : 
        //echo '<h5>Results for: '. $query.'</h5>';
        echo '<ul class="ajax-search-results">';
        while ( $search_query->have_posts() ) : $search_query->the_post();
            ?><li>
    			<a href="<?php the_permalink(); ?>">
				    <?php the_post_thumbnail( 'widgetthumb', array( 'title' => '' )); ?>
    				<?php the_title(); ?>	
    			</a>
    			<div class="meta">
    				<span class="thetime"><?php the_time( 'F j, Y' ); ?></span>
    			</div> <!-- / .meta -->

    		</li>	
    		<?php
        endwhile;
        echo '</ul>';
        echo '<div class="ajax-search-meta"><span class="results-count">'.$search_count.' '.__( 'Results', 'mythemeshop' ).'</span><a href="'.get_search_link( $query ).'" class="results-link">Show all results</a></div>';
    else:
        echo '<div class="no-results">'.__( 'No results found.', 'mythemeshop' ).'</div>';
    endif;
        
    exit; // required for AJAX in WP
}

/*-----------------------------------------------------------------------------------*/
/* Redirect feed to feedburner
/*-----------------------------------------------------------------------------------*/

if ( $mts_options['mts_feedburner'] != '' ) {
function mts_rss_feed_redirect() {
    $mts_options = get_option( MTS_THEME_NAME );
    global $feed;
    $new_feed = $mts_options['mts_feedburner'];
    if ( !is_feed() ) {
            return;
    }
    if ( preg_match( '/feedburner/i', $_SERVER['HTTP_USER_AGENT'] )){
            return;
    }
    if ( $feed != 'comments-rss2' ) {
            if ( function_exists( 'status_header' )) status_header( 302 );
            header( "Location:" . $new_feed );
            header( "HTTP/1.1 302 Temporary Redirect" );
            exit();
    }
}
add_action( 'template_redirect', 'mts_rss_feed_redirect' );
}

/*-----------------------------------------------------------------------------------*/
/* Single Post Pagination - Numbers + Previous/Next
/*-----------------------------------------------------------------------------------*/
function mts_wp_link_pages_args( $args ) {
    global $page, $numpages, $more, $pagenow;
    if ( !$args['next_or_number'] == 'next_and_number' )
        return $args; 
    $args['next_or_number'] = 'number'; 
    if ( !$more )
        return $args; 
    if( $page-1 ) 
        $args['before'] .= _wp_link_page( $page-1 )
        . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'
    ;
    if ( $page<$numpages ) 
    
        $args['after'] = _wp_link_page( $page+1 )
        . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
        . $args['after']
    ;
    return $args;
}
add_filter( 'wp_link_pages_args', 'mts_wp_link_pages_args' );

/*-----------------------------------------------------------------------------------*/
/* add <!-- next-page --> button to tinymce
/*-----------------------------------------------------------------------------------*/
add_filter( 'mce_buttons', 'wysiwyg_editor' );
function wysiwyg_editor( $mce_buttons ) {
   $pos = array_search( 'wp_more', $mce_buttons, true );
   if ( $pos !== false ) {
       $tmp_buttons = array_slice( $mce_buttons, 0, $pos+1 );
       $tmp_buttons[] = 'wp_page';
       $mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos+1 ));
   }
   return $mce_buttons;
}

/*-----------------------------------------------------------------------------------*/
/*	Alternative post templates
/*-----------------------------------------------------------------------------------*/
function mts_get_post_template( $default = 'default' ) {
    global $post;
    $single_template = $default;
    $posttemplate = get_post_meta( $post->ID, '_mts_posttemplate', true );
    
    if ( empty( $posttemplate ) || ! is_string( $posttemplate ) )
        return $single_template;
    
    if ( file_exists( dirname( __FILE__ ) . '/singlepost-'.$posttemplate.'.php' ) ) {
        $single_template = dirname( __FILE__ ) . '/singlepost-'.$posttemplate.'.php';
    }
    
    return $single_template;
}
function mts_set_post_template( $single_template ) {
     return mts_get_post_template( $single_template );
}
add_filter( 'single_template', 'mts_set_post_template' );

/*-----------------------------------------------------------------------------------*/
/*	Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/
function mts_custom_gravatar( $avatar_defaults ) {
    $mts_avatar = get_template_directory_uri() . '/images/gravatar.png';
    $avatar_defaults[$mts_avatar] = 'Custom Gravatar ( /images/gravatar.png )';
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'mts_custom_gravatar' );

/*-----------------------------------------------------------------------------------*/
/*  WP Review Support
/*-----------------------------------------------------------------------------------*/

// Set default colors for new reviews
function new_default_review_colors( $colors ) {
    $colors = array(
        'color' => '#fff',
        'fontcolor' => '#fff',
        'bgcolor1' => '#33BCF2',
        'bgcolor2' => '#33BCF2',
        'bordercolor' => '#33BCF2'
    );
  return $colors;
}
add_filter( 'wp_review_default_colors', 'new_default_review_colors' );
 
// Set default location for new reviews
function new_default_review_location( $position ) {
  $position = 'top';
  return $position;
}
add_filter( 'wp_review_default_location', 'new_default_review_location' );


/*-----------------------------------------------------------------------------------*/
/*  Thumbnail Upscale
/*  Enables upscaling of thumbnails for small media attachments, 
/*  to make sure it fits into it's supposed location.
/*  Cannot be used in conjunction with Retina Support.
/*-----------------------------------------------------------------------------------*/
function mts_image_crop_dimensions( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ) {
    if( !$crop )
    	return null; // let the wordpress default function handle this

    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

    $crop_w = round( $new_w / $size_ratio );
    $crop_h = round( $new_h / $size_ratio );

    $s_x = floor( ( $orig_w - $crop_w ) / 2 );
    $s_y = floor( ( $orig_h - $crop_h ) / 2 );

    return array( 0, 0, ( int ) $s_x, ( int ) $s_y, ( int ) $new_w, ( int ) $new_h, ( int ) $crop_w, ( int ) $crop_h );
}
add_filter( 'image_resize_dimensions', 'mts_image_crop_dimensions', 10, 6 );

/*-----------------------------------------------------------------------------------*/
/*  WP Mega Menu Configuration
/*-----------------------------------------------------------------------------------*/
function megamenu_parent_element( $selector ) {
    return '.primary-navigation';
}
add_filter( 'wpmm_container_selector', 'megamenu_parent_element' );

function menu_item_color( $item_output, $item_color, $item, $depth, $args ) {
    $mts_options = get_option( MTS_THEME_NAME );
    if (!empty($item_color))
        return $item_output.'<style>.menu-item-'. $item->ID . '-megamenu .wpmm-posts p.wpmm-post-excerpt, .menu-item-'. $item->ID . '-megamenu .wpmm-posts .wpmm-entry-date, #wpmm-megamenu.menu-item-'. $item->ID . '-megamenu .wpmm-posts .wpmm-entry-title a, #wpmm-megamenu.menu-item-'. $item->ID . '-megamenu .wpmm-posts .wpmm-entry-author, #wpmm-megamenu.menu-item-'. $item->ID . '-megamenu .wpmm-posts .wpmm-entry-author a, #wpmm-megamenu.menu-item-'. $item->ID . '-megamenu .wpmm-subcategories a { color: #fff!important; }.menu-item-'. $item->ID . '-megamenu, .wpmm-megamenu-showing { background-color: ' . $mts_options['mts_color_scheme'] . ' !important; color: #fff; } #wpmm-megamenu.wpmm-light-scheme .wpmm-3-posts { border-left: 1px solid rgba(255, 255, 255, 0.24); } #wpmm-megamenu.menu-item-'. $item->ID . '-megamenu.wpmm-visible { border-top: 1px solid rgba(255, 255, 255, 0.24);} #wpmm-megamenu .review-total-only { background:' . $mts_options['mts_color_scheme_2'] . '; color: #fff; }</style>';
    else
        return $item_output;
}
add_filter( 'wpmm_color_output', 'menu_item_color', 10, 5 );

function megamenu_exclude( $exclude, $args ) {
    if ( $args['theme_location'] == 'footer-menu' )
        $exclude = true;

    return $exclude;
}
add_filter( 'wpmm_exclude_menu', 'megamenu_exclude', 10, 2 );

/* Change image size */
function megamenu_thumbnails( $thumbnail_html, $post_id ) {
	$thumbnail_html = '<div class="wpmm-thumbnail">';
	$thumbnail_html .= '<a title="'.get_the_title( $post_id ).'" href="'.get_permalink( $post_id ).'">';
	if(has_post_thumbnail($post_id)):
		$thumbnail_html .= get_the_post_thumbnail($post_id, 'widgetfull', array('title' => ''));
	else:
		$thumbnail_html .= '<img src="'.get_template_directory().'/images/nothumb-widgetfull.png" alt="'.__('No Preview', 'wpmm').'"  class="wp-post-image" />';
	endif;
	$thumbnail_html .= '</a>';
	
	// WP Review
	$thumbnail_html .= (function_exists('wp_review_show_total') ? wp_review_show_total(false) : '');
	
	$thumbnail_html .= '</div>';

	return $thumbnail_html;
}
add_filter( 'wpmm_thumbnail_html', 'megamenu_thumbnails', 10, 2 );

?>