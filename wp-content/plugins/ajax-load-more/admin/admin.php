<?php

/* Admin function */

add_action( 'plugins_loaded', 'alm_core_update' ); // Core Update
add_action( 'admin_head', 'alm_admin_vars' ); // Localized Vars
add_action( 'wp_ajax_alm_save_repeater', 'alm_save_repeater' ); // Ajax Save Repeater
add_action( 'wp_ajax_alm_update_repeater', 'alm_update_repeater' ); // Ajax Update Repeater
add_action( 'wp_ajax_alm_get_tax_terms', 'alm_get_tax_terms' ); // Ajax Get Taxonomy Terms
add_action( 'wp_ajax_alm_delete_cache', 'alm_delete_cache' ); // Delete Cache



/*
*  alm_admin_vars
*  Create admin variables and ajax nonce
*
*  @since 2.0.0
*/
function alm_admin_vars() { ?>
    <script type='text/javascript'>
	 /* <![CDATA[ */
    var alm_admin_localize = <?php echo json_encode( array( 
        'ajax_admin_url' => admin_url( 'admin-ajax.php' ),
        'alm_admin_nonce' => wp_create_nonce( 'alm_repeater_nonce' )
    )); ?>
    /* ]]> */
    </script>
<?php }



/**
* alm_core_update
* Update default repeater on plugin update.
* If plugin versions do not match or the plugin has been updated and we need to update our repeaters.
*
* @since 2.0.5
*/

function alm_core_update() {  
   
	if(!get_option( 'alm_version')){ // Add 'alm_version' to WP options table if it does not exist
		add_option( 'alm_version', ALM_VERSION ); 
	}  
	
	$alm_installed_ver = get_option( "alm_version" ); // Get value from WP Option tbl
	if ( $alm_installed_ver != ALM_VERSION ) {
		alm_run_update();	
	}  
}



/**
* alm_run_update
* Run the update on all 'blogs'
*
* @since 2.7.2
*/

function alm_run_update(){
   global $wpdb;	
   
   if ( is_multisite()) {           
   	$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );   	
      
   	// Loop all blogs and run update routine   	
      foreach ( $blog_ids as $blog_id ) {
         switch_to_blog( $blog_id );
         alm_update_template_files();
         restore_current_blog();
      }
      
   } else {
      alm_update_template_files();
   }
      
   update_option( "alm_version", ALM_VERSION ); // Update the WP Option tbl with the new version num
}



/**
* alm_update_template_files
* Update routine for template files
*
* @since 2.7.2
*/

function alm_update_template_files(){
   global $wpdb;	
	$table_name = $wpdb->prefix . "alm";
	$blog_id = $wpdb->blogid;	
   
	// Get all templates ($rows) where name is 'default' 
   $rows = $wpdb->get_results("SELECT * FROM $table_name WHERE name = 'default'"); 

   if($rows){
      foreach( $rows as $row ) { // Loop $rows
         
         $data = $wpdb->get_var("SELECT repeaterDefault FROM $table_name WHERE name = 'default'");
         
         if($blog_id > 1){
	         $dir = ALM_PATH. 'core/repeater/'. $blog_id;
			   if( !is_dir($dir) ){
			      mkdir($dir);
			   }			   
			   $f = ALM_PATH. 'core/repeater/'. $blog_id .'/default.php';
         }else{
            $f = ALM_PATH. 'core/repeater/default.php';
         }
         
         try {
            $o = fopen($f, 'w+'); //Open file
            if ( !$o ) {
              throw new Exception(__('[Ajax Load More] Error opening default repeater template - Please check your file path and ensure your server is configured to allow Ajax Load More to read and write files within the /ajax-load-more/core/repeater directory', ALM_NAME));
            } 
            $w = fwrite($o, $data); //Save the file
            if ( !$w ) {
              throw new Exception(__('[Ajax Load More] Error updating default repeater template - Please check your file path and ensure your server is configured to allow Ajax Load More to read and write files within the /ajax-load-more/core/repeater directory.', ALM_NAME));
            } 
            fclose($o); //now close it
            
         } catch ( Exception $e ) {
            // Display error message in console.
            if(!isset($options['_alm_error_notices']) || $options['_alm_error_notices'] == '1'){ 	 
               echo '<script>console.log("' .$e->getMessage(). '");</script>';
            }
         }
         
      }
   }
   
}




/**
* alm_admin_menu
* Create Admin Menu
*
* @since 2.0.0
*/

add_action( 'admin_menu', 'alm_admin_menu' );
function alm_admin_menu() {  
   $icon = 'dashicons-plus-alt';
   $icon = ALM_ADMIN_URL . "/img/alm-logo-16x16.png";
   
   $alm_page = add_menu_page( 
      'Ajax Load More', 
      'Ajax Load More', 
      'edit_theme_options', 
      'ajax-load-more', 
      'alm_settings_page',
      $icon
   );
   
   $alm_settings_page = add_submenu_page( 
      'ajax-load-more', 
      'Settings', 
      'Settings', 
      'edit_theme_options', 
      'ajax-load-more', 
      'alm_settings_page'
   ); 
   
   $alm_template_page = add_submenu_page( 
      'ajax-load-more', 
      'Repeater Templates', 
      'Repeater Templates', 
      'edit_theme_options', 
      'ajax-load-more-repeaters', 
      'alm_repeater_page'
   );
    
   $alm_shortcode_page = add_submenu_page( 
      'ajax-load-more', 
      'Shortcode Builder', 
      'Shortcode Builder', 
      'edit_theme_options', 
      'ajax-load-more-shortcode-builder', 
      'alm_shortcode_builder_page'
   );
   
   $alm_examples_page = add_submenu_page( 
      'ajax-load-more', 
      'Examples', 
      'Examples', 
      'edit_theme_options', 
      'ajax-load-more-examples', 
      'alm_example_page'
   );  	
   	
   $alm_addons_page = add_submenu_page( 
      'ajax-load-more', 
      'Add-ons', 
      'Add-ons', 
      'edit_theme_options', 
      'ajax-load-more-add-ons', 
      'alm_add_ons_page'
   ); 
   
   $alm_licenses_page = add_submenu_page(
      'ajax-load-more', 
      'Licenses', 
      'Licenses', 
      'edit_theme_options', 
      'ajax-load-more-licenses', 
      'alm_licenses_page'
   ); 
   
   if(has_action('alm_cache_installed')){
      $alm_cache_page = add_submenu_page( 
         'ajax-load-more', 
         'Cache', 
         '<span style="color: #f2f5bf; display:block; border-top: 1px solid #555; padding-top: 8px; border-radius: 3px;">Cache<span>', 
         'edit_theme_options', 
         'ajax-load-more-cache', 
         'alm_cache_page'
      );
      add_action( 'load-' . $alm_cache_page, 'alm_load_admin_js' );
      add_action( 'load-' . $alm_cache_page, 'alm_load_cache_admin_js' );
   }
   
   //Add our admin scripts
   add_action( 'load-' . $alm_settings_page, 'alm_load_admin_js' );
   add_action( 'load-' . $alm_template_page, 'alm_load_admin_js' );
   add_action( 'load-' . $alm_shortcode_page, 'alm_load_admin_js' );
   add_action( 'load-' . $alm_examples_page, 'alm_load_admin_js' );
   add_action( 'load-' . $alm_addons_page, 'alm_load_admin_js' );
   add_action( 'load-' . $alm_licenses_page, 'alm_load_admin_js' );
}   
      


/**
* alm_load_admin_js
* Load Admin JS
*
* @since 2.0.15
*/

function alm_load_admin_js(){
	add_action( 'admin_enqueue_scripts', 'alm_enqueue_admin_scripts' );
}
function alm_load_cache_admin_js(){
	add_action( 'admin_enqueue_scripts', 'alm_enqueue_cache_admin_scripts' );
}



/**
* alm_enqueue_admin_scripts
* Enqueue Admin JS
*
* @since 2.0.15
*/

function alm_enqueue_admin_scripts(){

   //Load Admin CSS
   wp_enqueue_style( 'alm-admin-css', ALM_ADMIN_URL. 'css/admin.css');
   wp_enqueue_style( 'alm-select2-css', ALM_ADMIN_URL. 'css/select2.css');
   wp_enqueue_style( 'alm-core-css', ALM_URL. '/core/css/ajax-load-more.css');
   wp_enqueue_style( 'alm-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
   
   //Load CodeMirror Syntax Highlighting if on Repater Template page 
   $screen = get_current_screen();
   if ( in_array( $screen->id, array( 'ajax-load-more_page_ajax-load-more-repeaters') ) ){  
      
      //CodeMirror CSS
      wp_enqueue_style( 'alm-codemirror-css', ALM_ADMIN_URL. 'codemirror/lib/codemirror.css' );
            
      //CodeMirror JS
      wp_enqueue_script( 'alm-codemirror', ALM_ADMIN_URL. 'codemirror/lib/codemirror.js');    
      wp_enqueue_script( 'alm-codemirror-matchbrackets', ALM_ADMIN_URL. 'codemirror/addon/edit/matchbrackets.js' );
      wp_enqueue_script( 'alm-codemirror-htmlmixed', ALM_ADMIN_URL. 'codemirror/mode/htmlmixed/htmlmixed.js' );
      wp_enqueue_script( 'alm-codemirror-xml', ALM_ADMIN_URL. 'codemirror/mode/xml/xml.js' );
      wp_enqueue_script( 'alm-codemirror-javascript', ALM_ADMIN_URL. 'codemirror/mode/javascript/javascript.js' );
      wp_enqueue_script( 'alm-codemirror-mode-css', ALM_ADMIN_URL. 'codemirror/mode/css/css.js' );
      wp_enqueue_script( 'alm-codemirror-clike', ALM_ADMIN_URL. 'codemirror/mode/clike/clike.js' );
      wp_enqueue_script( 'alm-codemirror-php', ALM_ADMIN_URL. 'codemirror/mode/php/php.js' );
      
   }
   
   //Load JS   
   wp_enqueue_script( 'jquery-form' );
   wp_enqueue_script( 'alm-select2', ALM_ADMIN_URL. 'js/libs/select2.min.js', array( 'jquery' ));
   wp_enqueue_script( 'alm-drops', ALM_ADMIN_URL. 'js/libs/jquery.drops.js', array( 'jquery' ));
   wp_enqueue_script( 'alm-admin', ALM_ADMIN_URL. 'js/admin.js', array( 'jquery' ));
   wp_enqueue_script( 'alm-shortcode-builder', ALM_ADMIN_URL. 'shortcode-builder/js/shortcode-builder.js', array( 'jquery' ));
}

function alm_enqueue_cache_admin_scripts(){
   wp_enqueue_script( 'alm-cache-admin', ALM_CACHE_URL. '/js/alm-cache.js', array( 'jquery' ));
}



/*
*  alm_settings_page
*  Settings page
*
*  @since 2.0.0
*/

function alm_settings_page(){ 
   include_once( ALM_PATH . 'admin/views/settings.php');
}



/*
*  alm_repeater_page
*  Custom Repeaters
*
*  @since 2.0.0
*/

function alm_repeater_page(){ 
   include_once( ALM_PATH . 'admin/views/repeater-templates.php');
}



/*
*  alm_shortcode_builder_page
*  Shortcode Builder
*
*  @since 2.0.0
*/

function alm_shortcode_builder_page(){ 
   include_once( ALM_PATH . 'admin/views/shortcode-builder.php');	
}



/*
*  alm_example_page
*  Examples Page
*
*  @since 2.0.0
*/

function alm_example_page(){ 
   include_once( ALM_PATH . 'admin/views/examples.php');		
}



/*
*  alm_add_ons_page
*  Ajax Load More Add-ons
*
*  @since 2.0.0
*/

function alm_add_ons_page(){ 
   include_once( ALM_PATH . 'admin/views/add-ons.php');
}



/*
*  alm_licenses_page
*  Ajax Load More Licenses
*
*  @since 2.7.0
*/

function alm_licenses_page(){ 
   include_once( ALM_PATH . 'admin/views/licenses.php');
}


/*
*  alm_cache_page
*  Cache Add-on page
*
*  @since 2.6.0
*/

function alm_cache_page(){ 
   include_once( ALM_CACHE_PATH . 'admin/views/cache.php');
}



/*
*  alm_delete_cache
*  Delete induvidual cached items
*
*  @return   null
*  @since 2.6.0
*/

function alm_delete_cache(){	
	$nonce = $_POST["nonce"];
	$cache = $_POST["cache"];
	// Check our nonce, if they don't match then bounce!
	if (! wp_verify_nonce( $nonce, 'alm_repeater_nonce' ))
		die('Get Bounced!');
	
	$dir = ALM_CACHE_PATH .'_cache/'.$cache;
	
	if (is_dir($dir)) {
      foreach (glob($dir."/*.*") as $filename) {
          if (is_file($filename)) {
              unlink($filename);
          }
      }
      rmdir($dir);
   }
	
	die();
}



/*
*  alm_save_repeater
*  Repeater Save function
*
*  @return   response
*  @since 2.0.0
*/

function alm_save_repeater(){
	
	global $wpdb;
	$table_name = $wpdb->prefix . "alm";
	$blog_id = $wpdb->blogid;	
	$options = get_option( 'alm_settings' ); //Get plugin options
	
	$nonce = $_POST["nonce"];
	// Check our nonce, if they don't match then bounce!
	if (! wp_verify_nonce( $nonce, 'alm_repeater_nonce' ))
		die('Error - unable to verify nonce, please try again.');
		
   // Get _POST Vars 
	$c = Trim(stripslashes($_POST["value"])); // Repeater Value
	$n = Trim(stripslashes($_POST["repeater"])); // Repeater name
	$t = Trim(stripslashes($_POST["type"])); // Repeater name
	$a = Trim(stripslashes($_POST["alias"])); // Repeater alias
	
	// Write to repeater templates 
	
	// (Default)
	if($t === 'default'){
		
		if($blog_id > 1){				
			$dir = ALM_PATH. 'core/repeater/'. $blog_id;
		   if( !is_dir($dir) ){
		      mkdir($dir);
		   }		   
		   $f = ALM_PATH. 'core/repeater/'. $blog_id .'/default.php';
		}else{
			$f = ALM_PATH. 'core/repeater/default.php';			
		}
		
   }
   // (Unlimited)
   elseif($t === 'unlimited'){
	      
	   if($blog_id > 1){
		   $dir = ALM_UNLIMITED_PATH. 'repeaters/'. $blog_id;
	   	if( !is_dir($dir) ){
	         mkdir($dir);
	      }
			$f = ALM_UNLIMITED_PATH. 'repeaters/'. $blog_id .'/'.$n .'.php';
		}else{
			$f = ALM_UNLIMITED_PATH. 'repeaters/'.$n .'.php';
		}
		
   }
   // (Unlimited v1)
	else{
		
		$f = ALM_REPEATER_PATH. 'repeaters/'.$n .'.php';
		
   }
	
   try {
      $o = fopen($f, 'w+'); //Open file
      if ( !$o ) {
        throw new Exception(__('[Ajax Load More] Unable to open repeater template - '.$f.' - Please check your file path and ensure your server is configured to allow Ajax Load More to read and write files.', ALM_NAME));
      } 
      $w = fwrite($o, $c); //Save the file
      if ( !$w ) {
        throw new Exception(__('[Ajax Load More] Error saving repeater template - '.$f.' - Please check your file path and ensure your server is configured to allow Ajax Load More to read and write files.', ALM_NAME));
      } 
      fclose($o); //now close it
      
   } catch ( Exception $e ) {
      // Display error message in console.
      if(!isset($options['_alm_error_notices']) || $options['_alm_error_notices'] == '1'){ 	 
         echo '<script>console.log("' .$e->getMessage(). '");</script>';
      }
   }
	
	//Save to database	
		
	if($t === 'default')	{	   
	   $data_update = array('repeaterDefault' => "$c", 'pluginVersion' => ALM_VERSION);
	   $data_where = array('name' => "default");
   }
   elseif($t === 'unlimited'){ // Unlimited Repeaters	  
      $table_name = $wpdb->prefix . "alm_unlimited"; 
	   $data_update = array('repeaterDefault' => "$c", 'alias' => "$a", 'pluginVersion' => ALM_UNLIMITED_VERSION);
	   $data_where = array('name' => $n);
   }
   else{ // Custom Repeaters
	   $data_update = array('repeaterDefault' => "$c", 'alias' => "$a", 'pluginVersion' => ALM_REPEATER_VERSION);
      $data_where = array('name' => $n);
   }
   
	$wpdb->update($table_name , $data_update, $data_where);
	
	//Our results
	if($w){
	    echo '<span class="saved">Template Saved Successfully</span>';
	} else {
	    echo '<span class="saved-error"><b>'. __('Error Writing File', ALM_NAME) .'</b></span><br/>Something went wrong and the data could not be saved.';
	}
	die();
}



/*
*  alm_update_repeater
*  Update repeater template from database
*
*  - User story: User deletes plugin, the installs again and the version has not change - their default repeater will be in the default state and unable to be updated.
*
*  @return   DB value
*  @since 2.5.0
*/

function alm_update_repeater(){
	$nonce = $_POST["nonce"];
	// Check our nonce, if they don't match then bounce!
	if (! wp_verify_nonce( $nonce, 'alm_repeater_nonce' ))
		die('Error - unable to verify nonce, please try again.');
		
   // Get _POST Vars  	
	$n = Trim(stripslashes($_POST["repeater"])); // Repeater name
	$t = Trim(stripslashes($_POST["type"])); // Repeater type (default | unlimited)
	
	
	// Get value from database
	global $wpdb;
	$table_name = $wpdb->prefix . "alm";	
		
	if($t === 'default')	$n = 'default';   
   if($t === 'unlimited') $table_name = $wpdb->prefix . "alm_unlimited";    
   
   $the_repeater = $wpdb->get_var("SELECT repeaterDefault FROM " . $table_name . " WHERE name = '$n'");
   
   echo $the_repeater; // Return repeater value
   
	die();
}



/*
*  alm_get_tax_terms
*  Get taxonomy terms for shortcode builder
*
*  @return   Taxonomy Terms
*  @since 2.1.0
*/

function alm_get_tax_terms(){	
	$nonce = $_GET["nonce"];
	// Check our nonce, if they don't match then bounce!
	if (! wp_verify_nonce( $nonce, 'alm_repeater_nonce' ))
		die('Get Bounced!');
		
	$taxonomy = (isset($_GET['taxonomy'])) ? $_GET['taxonomy'] : '';	
	$tax_args = array(
		'orderby'       => 'name', 
		'order'         => 'ASC',
		'hide_empty'    => false
	);	
	$terms = get_terms($taxonomy, $tax_args);
	$returnVal = '';
	if ( !empty( $terms ) && !is_wp_error( $terms ) ){		
		$returnVal .= '<ul>';
		foreach ( $terms as $term ) {
			//print_r($term);
			$returnVal .='<li><input type="checkbox" class="alm_element" name="tax-term-'.$term->slug.'" id="tax-term-'.$term->slug.'" data-type="'.$term->slug.'"><label for="tax-term-'.$term->slug.'">'.$term->name.'</label></li>';		
		}
		$returnVal .= '</ul>';		
		echo $returnVal;
		die();
	}else{
		echo "<p class='warning'>No terms exist within this taxonomy</p>";
		die();
	}
}


/*
*  admin_init
*  Initiate the plugin, create our setting variables.
*
*  @since 2.0.0
*/

add_action( 'admin_init', 'alm_admin_init');
function alm_admin_init(){

	register_setting( 
		'alm-setting-group', 
		'alm_settings', 
		'alm_sanitize_settings' 
	);
	
	add_settings_section( 
		'alm_general_settings',  
		'Global Settings', 
		'alm_general_settings_callback', 
		'ajax-load-more' 
	);
	
	add_settings_section( 
		'alm_admin_settings',  
		'Admin Settings', 
		'alm_admin_settings_callback', 
		'ajax-load-more' 
	);	
	
	add_settings_field( // Container type
	    '_alm_container_type',
	    __('Container Type', ALM_NAME ),
	    'alm_container_type_callback',
	    'ajax-load-more',
	    'alm_general_settings'
	);
	
	add_settings_field(  // Classnames
		'_alm_classname', 
		__('Container Classes', ALM_NAME ), 
		'alm_class_callback', 
		'ajax-load-more', 
		'alm_general_settings' 
	);
	
	add_settings_field(  // Disbale CSS
		'_alm_disable_css', 
		__('Disable CSS', ALM_NAME ), 
		'alm_disable_css_callback', 
		'ajax-load-more', 
		'alm_general_settings' 
	);
	
	add_settings_field(  // Btn color
		'_alm_btn_color', 
		__('Button Color', ALM_NAME ), 
		'alm_btn_color_callback', 
		'ajax-load-more', 
		'alm_general_settings' 
	);	
	
	add_settings_field(  // Button classes
		'_alm_btn_classname', 
		__('Button Classes', ALM_NAME ), 
		'alm_btn_class_callback', 
		'ajax-load-more', 
		'alm_general_settings' 
	);
	
	add_settings_field(  // Nonce security
		'_alm_nonce_security', 
		__('Ajax Security', ALM_NAME ), 
		'_alm_nonce_security_callback', 
		'ajax-load-more', 
		'alm_general_settings' 
	);	
	
	add_settings_field(  // Scroll to top on load
		'_alm_scroll_top', 
		__('Top of Page', ALM_NAME ), 
		'_alm_scroll_top_callback', 
		'ajax-load-more', 
		'alm_general_settings' 
	);	
	
	add_settings_field(  // Load dynamic queries
		'_alm_disable_dynamic', 
		__('Dynamic Content', ALM_NAME ), 
		'alm_disable_dynamic_callback', 
		'ajax-load-more', 
		'alm_admin_settings' 
	);	
	
	add_settings_field(  // Hide btn
		'_alm_hide_btn', 
		__('Editor Button', ALM_NAME ), 
		'alm_hide_btn_callback', 
		'ajax-load-more', 
		'alm_admin_settings' 
	);
	
	add_settings_field(  // Display error notices
		'_alm_error_notices', 
		__('Error Notices', ALM_NAME ), 
		'_alm_error_notices_callback', 
		'ajax-load-more', 
		'alm_admin_settings' 
	);	
	
	
	// CACHE
	if(has_action('alm_cache_settings')){	   
   	do_action('alm_cache_settings');   	
   }	
	
	
	// CUSTOM REPEATERS
	if(has_action('alm_unlimited_settings')){	   
   	do_action('alm_unlimited_settings');   	
   }
   
	
	// PAGINATION
	if(has_action('alm_paging_settings')){	   
   	do_action('alm_paging_settings');   	
   }
   
	
	// PREVIOUS POST
	if(has_action('alm_prev_post_settings')){	   
   	do_action('alm_prev_post_settings');   	
   }
   
	
	// PRELOADED
	if(has_action('alm_preloaded_settings')){	   
   	do_action('alm_preloaded_settings');   	
   }
   
   
	// SEO
	if(has_action('alm_seo_settings')){	
		do_action('alm_seo_settings');   	
	}
	
	
	// THEME REPEATERS
	if(has_action('alm_theme_repeaters_settings')){	   
   	do_action('alm_theme_repeaters_settings');   	
   }	
}



/*
*  alm_general_settings_callback
*  Some general settings text
*
*  @since 2.0.0
*/

function alm_general_settings_callback() {
    echo '<p>' . __('Customize the user experience of Ajax Load More by updating the fields below.', ALM_NAME) . '</p>';
}



/*
*  alm_admin_settings_callback
*  Some general admin settings text
*
*  @since 2.0.0
*/

function alm_admin_settings_callback() {
    echo '<p>' . __('The following settings affect the WordPress admin area only.', ALM_NAME) . '</p>';
}


/*
*  alm_sanitize_settings
*  Sanitize our form fields
*
*  @since 2.0.0
*/

function alm_sanitize_settings( $input ) {
    return $input;
}



/*
*  alm_disable_css_callback
*  Diabale Ajax Load More CSS.
*
*  @since 2.0.0
*/

function alm_disable_css_callback(){
	$options = get_option( 'alm_settings' );
	if(!isset($options['_alm_disable_css'])) 
	   $options['_alm_disable_css'] = '0';
	
	$html = '<input type="hidden" name="alm_settings[_alm_disable_css]" value="0" />';
	$html .= '<input type="checkbox" id="alm_disable_css_input" name="alm_settings[_alm_disable_css]" value="1"'. (($options['_alm_disable_css']) ? ' checked="checked"' : '') .' />';
	$html .= '<label for="alm_disable_css_input">'.__('I want to use my own CSS styles.', ALM_NAME).'<br/><span style="display:block;"><i class="fa fa-file-text-o"></i> &nbsp;<a href="'.ALM_URL.'/core/css/ajax-load-more.css" target="blank">'.__('View Ajax Load More CSS', ALM_NAME).'</a></span></label>';
	
	echo $html;
}



/*
*  alm_hide_btn_callback
*  Disbale the ALM shortcode button in the WordPress content editor
*
*  @since 2.2.1
*/

function alm_hide_btn_callback(){
	$options = get_option( 'alm_settings' );
	if(!isset($options['_alm_hide_btn'])) 
	   $options['_alm_hide_btn'] = '0';
	
	$html = '<input type="hidden" name="alm_settings[_alm_hide_btn]" value="0" /><input type="checkbox" id="alm_hide_btn" name="alm_settings[_alm_hide_btn]" value="1"'. (($options['_alm_hide_btn']) ? ' checked="checked"' : '') .' />';
	$html .= '<label for="alm_hide_btn">'.__('Hide shortcode button in WYSIWYG editor.', ALM_NAME).'</label>';	
	
	echo $html;
}



/*
*  _alm_error_notices_callback
*  Display admin error notices in browser console.
*
*  @since 2.7.2
*/

function _alm_error_notices_callback(){
	$options = get_option( 'alm_settings' );		
	if(!isset($options['_alm_error_notices'])) 
	   $options['_alm_error_notices'] = '1';
	
	$html =  '<input type="hidden" name="alm_settings[_alm_error_notices]" value="0" />';
	$html .= '<input type="checkbox" name="alm_settings[_alm_error_notices]" id="_alm_error_notices" value="1"'. (($options['_alm_error_notices']) ? ' checked="checked"' : '') .' />';
	$html .= '<label for="_alm_error_notices">'.__('Display error messaging regarding repeater template updates in the browser console.', ALM_NAME).'</label>';	
	
	echo $html;
}



/*
*  alm_disable_dynamic_callback
*  Disable the dynamic population of categories, tags and authors
*
*  @since 2.6.0
*/

function alm_disable_dynamic_callback(){
	$options = get_option( 'alm_settings' );		
	if(!isset($options['_alm_disable_dynamic'])) 
	   $options['_alm_disable_dynamic'] = '0';
	
	$html =  '<input type="hidden" name="alm_settings[_alm_disable_dynamic]" value="0" />';
	$html .= '<input type="checkbox" name="alm_settings[_alm_disable_dynamic]" id="_alm_disable_dynamic" value="1"'. (($options['_alm_disable_dynamic']) ? ' checked="checked"' : '') .' />';
	$html .= '<label for="_alm_disable_dynamic">'.__('Disable dynamic population of categories, tags and authors in the Shortcode Builder.<span style="display:block">Recommended if you have an extraordinary number of categories, tags and/or authors.', ALM_NAME).'</label>';	
	
	echo $html;
}


/*
*  alm_container_type_callback
*  The type of container ul or div
*
*  @since 2.0.0
*/
	
function alm_container_type_callback() {
 
    $options = get_option( 'alm_settings' );
    
    if(!isset($options['_alm_container_type'])) 
	   $options['_alm_container_type'] = '1';
     
    $html = '<input type="radio" id="_alm_container_type_one" name="alm_settings[_alm_container_type]" value="1"' . checked( 1, $options['_alm_container_type'], false ) . '/>';
    $html .= '<label for="_alm_container_type_one">&lt;ul&gt; <span>&lt;!-- '.__('Ajax Posts Here', ALM_NAME).' --&gt;</span> &lt;/ul&gt;</label><br/>';
     
    $html .= '<input type="radio" id="_alm_container_type_two" name="alm_settings[_alm_container_type]" value="2"' . checked( 2, $options['_alm_container_type'], false ) . '/>';
    $html .= '<label for="_alm_container_type_two">&lt;div&gt; <span>&lt;!-- '.__('Ajax Posts Here', ALM_NAME).' --&gt;</span> &lt;/div&gt;</label>';
    
    $html .= '<label style="cursor: default !important"><span style="display:block">'.__('You can modify the container type when building a shortcode.', ALM_NAME).'</span></label>';
     
    echo $html;
 
}


/*
*  alm_class_callback
*  Add classes to the Ajax Load More wrapper
*
*  @since 2.0.0
*/

function alm_class_callback(){
	$options = get_option( 'alm_settings' );
		
	$html = '<label for="alm_settings[_alm_classname]">'.__('Add classes to Ajax Load More container - classes are applied globally and will appear with every instance of Ajax Load More. <span style="display:block">You can also add classes when building a shortcode.</span>', ALM_NAME).'</label><br/>';
	$html .= '<input type="text" id="alm_settings[_alm_classname]" name="alm_settings[_alm_classname]" value="'.$options['_alm_classname'].'" placeholder="posts listing etc..." /> ';	
	
	echo $html;
}



/*
*  alm_btn_color_callback
*  Get button color
*
*  @since 2.0.0
*/
	
function alm_btn_color_callback() {
 
    $options = get_option( 'alm_settings' );
    $color = $options['_alm_btn_color'];
    
    if(!isset($color)) 
	   $options['_alm_btn_color'] = '0';
	
	 $selected0 = '';   
	 if($color == 'default') $selected0 = 'selected="selected"';
		
	 $selected1 = '';   
	 if($color == 'blue') $selected1 = 'selected="selected"';
		
	 $selected2 = '';   
	 if($color == 'green') $selected2 = 'selected="selected"';
		
	 $selected3 = '';   
	 if($color == 'red') $selected3 = 'selected="selected"';
		
	 $selected4 = '';   
	 if($color == 'purple') $selected4 = 'selected="selected"';
		
	 $selected5 = '';   
	 if($color == 'grey') $selected5 = 'selected="selected"';
		
	 $selected6 = '';   
	 if($color == 'white') $selected6 = 'selected="selected"';
		
    $html =  '<label for="alm_settings_btn_color">'.__('Choose your <strong>Load More</strong> button color', ALM_NAME).'.</label><br/>';
    $html .= '<select id="alm_settings_btn_color" name="alm_settings[_alm_btn_color]">';
    $html .= '<option value="default" ' . $selected0 .'>Default (Orange)</option>';
    $html .= '<option value="blue" ' . $selected1 .'>Blue</option>';
    $html .= '<option value="green" ' . $selected2 .'>Green</option>';
    $html .= '<option value="red" ' . $selected3 .'>Red</option>';
    $html .= '<option value="purple" ' . $selected4 .'>Purple</option>';
    $html .= '<option value="grey" ' . $selected5 .'>Grey</option>';
    $html .= '<option value="white" ' . $selected6 .'>White</option>';
    $html .= '</select>';
     
    $html .= '<div class="clear"></div><div class="ajax-load-more-wrap core '.$color.'"><span>'.__('Preview', ALM_NAME) .'</span><button class="alm-load-more-btn loading" disabled="disabled">Load More</button></div>';
    echo $html;
}



/*
*  alm_btn_class_callback
*  Add classes to the Ajax Load More button
*
*  @since 2.4.1
*/

function alm_btn_class_callback(){
	$options = get_option( 'alm_settings' );
    
    if(!isset($options['_alm_btn_classname'])) 
	   $options['_alm_btn_classname'] = '';
		
	$html = '<label for="alm_settings[_alm_btn_classname]">'.__('Add classes to your <strong>Load More</strong> button', ALM_NAME).'.</label>';
	$html .= '<input type="text" class="btn-classes" id="alm_settings[_alm_btn_classname]" name="alm_settings[_alm_btn_classname]" value="'.$options['_alm_btn_classname'].'" placeholder="button rounded listing etc..." /> ';	
	
	echo $html;
	?>	
    <script>
    	//Button preview
    	var colorArray = "default grey purple green red blue white";
    	jQuery("select#alm_settings_btn_color").change(function() {
    		var color = jQuery(this).val();
    		// Remove other colors
			jQuery('.ajax-load-more-wrap.core').removeClass('default');
			jQuery('.ajax-load-more-wrap.core').removeClass('grey');
			jQuery('.ajax-load-more-wrap.core').removeClass('purple');
			jQuery('.ajax-load-more-wrap.core').removeClass('green');
			jQuery('.ajax-load-more-wrap.core').removeClass('red');
			jQuery('.ajax-load-more-wrap.core').removeClass('blue');
			jQuery('.ajax-load-more-wrap.core').removeClass('white');
			jQuery('.ajax-load-more-wrap.core').addClass(color);
		});
		jQuery("select#alm_settings_btn_color").click(function(e){
			e.preventDefault();
		});
		
		// Check if Disable CSS  === true
		if(jQuery('input#alm_disable_css_input').is(":checked")){
	      jQuery('select#alm_settings_btn_color').parent().parent().hide(); // Hide button color
         jQuery('input.btn-classes').parent().parent().hide(); // Hide Button Classes
    	}
    	jQuery('input#alm_disable_css_input').change(function() {
    		var el = jQuery(this);
	      if(el.is(":checked")) {
	      	el.parent().parent('tr').next('tr').hide(); // Hide button color
	      	el.parent().parent('tr').next('tr').next('tr').hide(); // Hide Button Classes
	      }else{		      
	      	el.parent().parent('tr').next('tr').show(); // show button color
	      	el.parent().parent('tr').next('tr').next('tr').show(); // show Button Classes
	      }
	   });
	   
    </script>
	<?php
}



/*
*  _alm_scroll_top_callback
*  Move window to top of screen on page load
*
*  @since 2.6.0
*/

function _alm_scroll_top_callback(){
	$options = get_option( 'alm_settings' );		
	if(!isset($options['_alm_scroll_top'])) 
	   $options['_alm_scroll_top'] = '0';
	
	$html =  '<input type="hidden" name="alm_settings[_alm_scroll_top]" value="0" />';
	$html .= '<input type="checkbox" name="alm_settings[_alm_scroll_top]" id="_alm_scroll_top" value="1"'. (($options['_alm_scroll_top']) ? ' checked="checked"' : '') .' />';
	$html .= '<label for="_alm_scroll_top">'.__('On initial page load, move the user\'s browser window to the top of the screen.<span style="display:block">This <u>may</u> help prevent the loading of unnecessary posts.</span>', ALM_NAME).'</label>';	
	
	echo $html;
}



/*
*  _alm_nonce_security_callback
*  Move window to top of screen on page load
*
*  @since 2.6.3
*/

function _alm_nonce_security_callback(){
	$options = get_option( 'alm_settings' );		
	if(!isset($options['_alm_nonce_security'])) 
	   $options['_alm_nonce_security'] = '0';
	
	$html =  '<input type="hidden" name="alm_settings[_alm_nonce_security]" value="0" />';
	$html .= '<input type="checkbox" name="alm_settings[_alm_nonce_security]" id="_alm_nonce_security" value="1"'. (($options['_alm_nonce_security']) ? ' checked="checked"' : '') .' />';
	$html .= '<label for="_alm_nonce_security">'.__('Enable <a href="https://codex.wordpress.org/WordPress_Nonces" target="_blank">WP nonce</a> verification to help protect URLs against certain types of misuse, malicious or otherwise on each Ajax Load More query.', ALM_NAME).'</label>';	
	
	echo $html;
}

