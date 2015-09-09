<?php


//Add thumbnail support
add_theme_support( 'post-thumbnails' );

//Add menu support and register main menu
if ( function_exists( 'register_nav_menus' ) ) {
  	register_nav_menus(
  		array(
  		  'main_menu' => 'Main Menu'
  		)
  	);
}

function next_posts_link_class() {
    return 'class="next page-numbers"';
}

function prev_posts_link_class() {
    return 'class="prev page-numbers"';
}

add_filter('stb_auto_hide_small_screens', '__return_false');

add_filter('next_posts_link_attributes', 'next_posts_link_class');
add_filter('previous_posts_link_attributes', 'prev_posts_link_class');

function vb_pagination( $query=null ) {

  global $wp_query;
  $query = $query ? $query : $wp_query;
  $big = 999999999;

  $paginate = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'type' => 'array',
    'total' => $query->max_num_pages,
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'prev_text' => __('Föregående sida'),
    'next_text' => __('Nästa sida'),
    )
  );

  if ($query->max_num_pages > 1) :
?>
<ul class="pagination">
  <?php
  foreach ( $paginate as $page ) {
    echo '<li>' . $page . '</li>';
  }
  ?>
</ul>
<?php
  endif;
}


//Making jQuery Google API
function modify_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', false, '1.8.1');
		wp_enqueue_script('jquery');

	}
}
add_action('init', 'modify_jquery');

function wpt_register_js() {
    wp_register_script(
        'jquery.bootstrap.min',
        get_template_directory_uri() . '/js/bootstrap.min.js',
        'jquery',
    '    jquery.iframetracker.js'
    );
    wp_enqueue_script('jquery.bootstrap.min');
}
add_action( 'init', 'wpt_register_js' );


// filter the Gravity Forms button type
add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
    return "<button class='button btn' id='gform_submit_button_{$form["id"]}'><span>{$form['button']['text']}</span></button>";
}

// fb-like before video in article
add_filter("the_content", "fb_like_before_video");
function fb_like_before_video($content) {
    if (!is_singular('post')) {
        return $content;
    }
    if(has_tag("djur")) {
    	$insert_code = '<hr class="fb-line" />
	<h5 style="color: #333; font-family: "Merriweather"; font-style: normal; font-weight: 100; "><i>Gillar du djur? Se då till att gilla oss på Facebook.</i></h5>
<div class="fb-like" data-href="https://www.facebook.com/pages/Uppskattat-Djur/1514965875438271" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
<hr class="fb-line" style="margin-bottom: -10px;" />';
    } else if(has_tag("DIY")) {
    	$insert_code = '<hr class="fb-line" />
	<h5 style="color: #333; font-family: "Merriweather"; font-style: normal; font-weight: 100; "><i>Gilla Uppskattat för fler liknande artiklar.</i></h5>
<div class="fb-like" data-href="https://www.facebook.com/pages/Uppskattat-DIY/819987638039132" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
<hr class="fb-line" style="margin-bottom: -10px;" />';
    } else {
    	$insert_code = '<hr class="fb-line" />
	<h5 style="color: #333; font-family: "Merriweather"; font-style: normal; font-weight: 100; "><i>Gilla Uppskattat för fler liknande artiklar.</i></h5>
<div class="fb-like" data-href="https://www.facebook.com/UppskattatSE" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
<hr class="fb-line" style="margin-bottom: -10px;" />';
    }
    

    $paragraphs = explode('</p>', $content);
    $modified_content = '';

    foreach ($paragraphs as $paragraph) {
        if (strpos($paragraph, '<iframe') !== false) {
            $modified_content = $modified_content . $insert_code . $paragraph . '</p>';
        } else {
            $modified_content = $modified_content . $paragraph . '</p>';
        }
    }

    return $modified_content;
}

// Add image sizes
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'big-image', 1239, 493, true);
	add_image_size( 'small-image', 615, 384, true);
}

// Register sidebar
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
 ));
}

function get_avatar_url($get_avatar){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return $matches[1];
}






// Bootstrap_Walker_Nav_Menu setup
/*

add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

	function bootstrap_setup(){

		add_action( 'init', 'register_menu' );

		function register_menu(){
			register_nav_menu( 'top-bar', 'Bootstrap Top Menu' );
		}

		class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


			function start_lvl( &$output, $depth ) {

				$indent = str_repeat( "\t", $depth );
				$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";

			}

			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$li_attributes = '';
				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = ($args->has_children) ? 'dropdown' : '';
				$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
				$classes[] = 'menu-item-' . $item->ID;


				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

			function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

				if ( !$element )
					return;

				$id_field = $this->db_fields['id'];

				//display this element
				if ( is_array( $args[0] ) )
					$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
				else if ( is_object( $args[0] ) )
					$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'start_el'), $cb_args);

				$id = $element->$id_field;

				// descend only when the depth is right and there are childrens for this element
				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

					foreach( $children_elements[ $id ] as $child ){

						if ( !isset($newlevel) ) {
							$newlevel = true;
							//start the child delimiter
							$cb_args = array_merge( array(&$output, $depth), $args);
							call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
						}
						$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
					}
						unset( $children_elements[ $id ] );
				}

				if ( isset($newlevel) && $newlevel ){
					//end the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
				}

				//end this element
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'end_el'), $cb_args);

			}

		}

	}

endif;
*/

add_action('admin_menu', 'custom_ad_options');
function custom_ad_options()
{
    add_options_page('Annonsinställningar', 'Annonsinställningar', 'manage_options', 'functions','add_opt_ad');
}

function add_opt_ad()
{
?>
    <div class="wrap">
        <h2>Annonsinställningar</h2>
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options') ?>
            <p><strong>Annonskod</strong><br />
                <input type="text" name="adCode" size="45" value="<?php echo get_option('adCode'); ?>" />
            </p>
            <p><input type="submit" name="Submit" value="Spara kod" /></p>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="adCode" />
        </form>
    </div>
<?php
}

function google_api_php_client_autoload($className) {
  $classPath = explode('_', $className);
  if ($classPath[0] != 'Google') {
    return;
  }
  if (count($classPath) > 3) {
    // Maximum class file path depth in this project is 3.
    $classPath = array_slice($classPath, 0, 3);
  }
  $filePath = dirname(__FILE__) . '/src/' . implode('/', $classPath) . '.php';
  if (file_exists($filePath)) {
    require_once($filePath);
  }
}
spl_autoload_register('google_api_php_client_autoload');
