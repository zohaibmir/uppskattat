<?php
/*
Plugin Name: Ajax Load More: Cache
Plugin URI: http://connekthq.com/plugins/ajax-load-more/cache/
Description: Ajax Load More extension that creates static HTML files from ajax requests.
Author: Darren Cooney
Twitter: @KaptonKaos
Author URI: http://connekthq.com
Version: 1.2.1
License: GPL
Copyright: Darren Cooney & Connekt Media
*/


define('ALM_CACHE_PATH', plugin_dir_path(__FILE__));
define('ALM_CACHE_URL', plugins_url('', __FILE__));
define('ALM_CACHE_VERSION', '1.2.1');
define('ALM_CACHE_RELEASE', 'July 5, 2015');




/*
*  alm_cache_install
*  Install the Cache add-on
*
*  @since 1.0
*/

register_activation_hook( __FILE__, 'alm_cache_install' );
function alm_cache_install() {   
   if(!is_plugin_active('ajax-load-more/ajax-load-more.php')){	//if Ajax Load More is activated
   	die('You must install and activate <a href="https://wordpress.org/plugins/ajax-load-more/">Ajax Load More</a> before installing the Ajax Load More Cache add-on.');
	}else{
      $dir = ALM_CACHE_PATH.'_cache';
      
      // create _cache directory if does not exist
      if(!is_dir($dir)) mkdir($dir) or die(__('Error creating cache directory. Please contact your hosting administrator.', ALM_NAME));
      
      // Create file on server to simulate cache creation
      $is_writeable = $dir.'/_is_writeable.php';
      $test_file = fopen($is_writeable, 'w') or die(__('Error creating cache test file. This add-on is required to read/write to your server. Please contact your hosting administrator.', ALM_NAME));
	}	
}



if( !class_exists('ALMCache') ):
   class ALMCache{	   
   	function __construct(){		
   		 
   		add_action( 'alm_cache_installed', array(&$this, 'alm_cache_installed') );
   	   add_filter( 'alm_cache_inc', array(&$this, 'alm_cache_inc' ), 10, 5 );	
   	   add_filter( 'alm_cache_file', array(&$this, 'alm_cache_file' ), 10, 3 );
   	   add_filter( 'alm_cache_create_dir', array(&$this, 'alm_cache_create_dir' ), 10, 3 );   	   
   	   add_action( 'admin_init', array(&$this, 'alm_cache_create_publish_actions') );
   	   add_action( 'admin_bar_menu', array(&$this, 'alm_add_toolbar_items'), 100 );   
   		add_action( 'alm_cache_settings', array(&$this, 'alm_cache_settings') );	
   		add_filter( 'alm_cache_shortcode', array(&$this, 'alm_cache_shortcode'), 10, 3 );	     
   	   
   	}  
   	
   	
   	
   	/*
   	*  alm_cache_shortcode
   	*  Build Cache shortcode params and send back to core ALM
   	*
   	*  @since 1.2
   	*/
   	
   	function alm_cache_shortcode($cache, $cache_id, $options){
   		$return = ' data-cache="'.$cache.'"';
		   $return .= ' data-cache-id="'.$cache_id.'"';
         $return .= ' data-cache-path="'.ALM_CACHE_URL.'/_cache/'.$cache_id.'"';
         
         // Check for known users
         if(isset($options['_alm_cache_known_users']) && $options['_alm_cache_known_users'] === '1' && is_user_logged_in()){ 
		   	$return .= ' data-cache-logged-in="true"'; 
		   }
		   
		   return $return;
   	}
   	
   	
   	
   	/*
   	*  alm_cache_settings
   	*  Create the Cache settings panel.
   	*
   	*  @since 1.2
   	*/
   	
   	function alm_cache_settings(){
      	register_setting(
      		'alm_cache_license', 
      		'alm_cache_license_key', 
      		'alm_cache_sanitize_license'
      	);
	   	add_settings_section( 
	   		'alm_cache_settings',  
	   		'Cache Settings', 
	   		'alm_cache_settings_callback', 
	   		'ajax-load-more' 
	   	);
	   	add_settings_field( 
	   		'_alm_cache_publish', 
	   		__('Published Posts', ALM_NAME ), 
	   		'_alm_cache_publish_callback', 
	   		'ajax-load-more', 
	   		'alm_cache_settings' 
	   	);	
	   	add_settings_field( 
	   		'_alm_cache_known_users', 
	   		__('Known Users', ALM_NAME ), 
	   		'_alm_cache_known_users_callback', 
	   		'ajax-load-more', 
	   		'alm_cache_settings' 
	   	);		   	
	   }
   	
   	
   	/*
   	*  alm_cache_create_dir
   	*  Create the cache directory by id and store data about cache in .txt file
   	*
   	*  @since 1.0
   	*/
   	
   	function alm_cache_create_publish_actions(){	   	
         $pt_args = array('public'   => true);
         $types = get_post_types($pt_args);
         if($types){
      	   foreach( $types as $type ){
      	      $typeobj = get_post_type_object( $type );
               $name = $typeobj->name;
               if( $name != 'revision' && $name != 'attachment' && $name != 'nav_menu_item' && $name != 'acf'){
                  //echo $name;
                  add_action( 'publish_'.$name.'', array(&$this, 'alm_cache_post_published') );
               }            
            }
         }
         
	   }	 
   	
   	
   	
   	/*
   	*  alm_cache_create_dir
   	*  Create the cache directory by id and store data about cache in .txt file
   	*
   	*  @since 1.0
   	*/
   	
   	function alm_cache_create_dir($cache_id, $url){	   	         
         $cdir = ALM_CACHE_PATH.'_cache/'.$cache_id;
         if(!is_dir($cdir)){ // make the directory and text file to store data
            mkdir($cdir) or die(__('Error creating cache directory. Please contact your hosting administrator.', ALM_NAME));
            
            // create text file
            $txtfile = fopen($cdir . '/_info.txt', 'w') or die(__('Unable to create text file!', ALM_NAME));
            
            // set and write data for example
            $data = array(
               'url' => $url,
               'created' => date('Y-m-d H:i:s')
            ); 
            
            fwrite($txtfile, serialize($data)) or die(__('Unable to write to text file. Please contact your hosting administrator.', ALM_NAME));
            fclose($txtfile);
         }
         
	   }	
	   
   	
   	
   	/*
   	*  alm_cache_inc
   	*  Get repeater file and store it for caching
   	*
   	*  @since 1.0
   	*/
   	
   	function alm_cache_inc($repeater, $preload_type, $alm_page, $alm_found_posts, $alm_item){
	   	ob_start(); // As seen here - http://stackoverflow.com/a/1288634/921927
			$file = alm_get_current_repeater($repeater, $preload_type);
			include($file);
			$return = ob_get_contents();
			ob_end_clean();
			return $return;
	   }	 
   	
   	
   	
   	/*
   	*  alm_cache_file
   	*  Create the cached file and write it to ajax-load-more-cache/_cache/
   	*
   	*  @since 1.0
   	*/
   	
   	function alm_cache_file($cache_id, $page, $page_cache){   	   	         
         $cdir = ALM_CACHE_PATH.'_cache/'.$cache_id;   	
         $cached_file = fopen($cdir . '/page-' . $page .'.html', 'w') or die(__('Error creating cache file. Please contact your hosting administrator.', ALM_NAME));
         fwrite($cached_file, $page_cache) or die(__('Error writing to cache file. Please contact your hosting administrator.', ALM_NAME));
	   }	
	    	
   	
   	
   	/*
   	*  alm_cache_post_published
   	*  Call this function when posts are published to determine if we should flush the cache
   	*
   	*  @since 1.0
   	*/
   	
   	
   	function alm_cache_post_published(){
   	   $options = get_option( 'alm_settings' ); //Get plugin options
   	   
         if($options['_alm_cache_publish'] === '1'){
            $path = ALM_CACHE_PATH .'_cache/';
         	foreach (new DirectoryIterator($path) as $directory) {
               if ($directory->isDot())  continue;
            
               if ($directory->isDir()){        
                  $file = $path . $directory;
                  if (is_dir($file)) {
                     foreach (glob($file."/*.*") as $filename) {
                         if (is_file($filename)) {
                             unlink($filename);
                         }
                     }
                     rmdir($file);
                  }
               }	
         	}
         }         
   	}	
	    	
   	
   	
   	/*
   	*  alm_cache_installed
   	*  an empty function to determine if cache is activated.
   	*
   	*  @since 1.0
   	*/
   	
   	function alm_cache_installed(){
   	   //Empty return
   	}	 
   	
   	
   	
   	/*
   	*  alm_add_toolbar_items
   	*  Create admin bar menu
   	*
   	*  @since 1.0
   	*/
   	function alm_add_toolbar_items($admin_bar){
   		if ( !is_super_admin() || !is_admin_bar_showing() )
   			return;
   			
         $admin_bar->add_menu( array(
           'id'    => 'alm-cache',
           'title' => 'ALM - Cache',
           'href'  => admin_url('admin.php?page=ajax-load-more-cache'),
           'meta'  => array(
               'title' => __('Ajax Load More Cache'),            
           ),
         ));
         $admin_bar->add_menu( array(
           'id'    => 'alm-cache-delete',
           'parent' => 'alm-cache',
           'title' => 'Delete Cache',
           'href'  => admin_url('admin.php?page=ajax-load-more-cache&action=delete'),
           'meta'  => array(
               'title' => __('Delete Cache'),
               'target' => '_self',
           ),
         ));
      }
   }  
   
   
   /*
	*  alm_cache_settings_callback
	*  Cache Setting Heading
	*
	*  @since 2.6.0
	*/
	
	function alm_cache_settings_callback() {
	   $html = '<p>' . __('Customize your installation of the <a href="http://connekthq.com/plugins/ajax-load-more/cache/">Cache</a> add-on.', ALM_NAME) . '</p>';
	   
	   echo $html;
	}
	
	
	
	/*
	*  _alm_cache_publish_callback
	*  Clear cache when a new post is published
	*
	*  @since 2.6.0
	*/
		
	function _alm_cache_publish_callback() {
	 
	   $options = get_option( 'alm_settings' );
		   
		if(!isset($options['_alm_cache_publish'])) 
		   $options['_alm_cache_publish'] = '0';
		
		$html = '<input type="hidden" name="alm_settings[_alm_cache_publish]" value="0" /><input type="checkbox" id="alm_cache_publish" name="alm_settings[_alm_cache_publish]" value="1"'. (($options['_alm_cache_publish']) ? ' checked="checked"' : '') .' />';
		$html .= '<label for="alm_cache_publish">'.__('Delete cache when new posts are published.', ALM_NAME);
		$html .= '<span style="display:block">'.__('Cache will be fully cleared whenever a post, page or Custom Post Type is published or updated.', ALM_NAME).'</span>';
		$html .=' </label>';	
		
		
		echo $html;
	 
	}
	
	
	
	/*
	*  _alm_cache_known_users_callback
	*  Don't cache files for known users
	*
	*  @since 2.6.0
	*/
		
	function _alm_cache_known_users_callback() {
	 
	   $options = get_option( 'alm_settings' );
		   
		if(!isset($options['_alm_cache_known_users'])) 
		   $options['_alm_cache_known_users'] = '0';
		
		$html = '<input type="hidden" name="alm_settings[_alm_cache_known_users]" value="0" /><input type="checkbox" id="alm_cache_known_users" name="alm_settings[_alm_cache_known_users]" value="1"'. (($options['_alm_cache_known_users']) ? ' checked="checked"' : '') .' />';
		$html .= '<label for="alm_cache_known_users">'.__('Don\'t cache files for logged in users.', ALM_NAME);
		$html .= '<span style="display:block">'.__('Logged in users will retrieve content directly from the database and will not view any cached content.', ALM_NAME).'</span>';
		$html .=' </label>';		
		
		echo $html;
	 
	}

    	
   /*
   *  alm_cache_sanitize_license
   *  Sanitize our license activation
   *
   *  @since 1.3.0
   */
   
   function alm_cache_sanitize_license( $new ) {
   	$old = get_option( 'alm_cache_license_key' );
   	if( $old && $old != $new ) {
   		delete_option( 'alm_cache_license_status' ); // new license has been entered, so must reactivate
   	}
   	return $new;
   }
   
   
   /*
   *  alm_cache_activate_license
   *  Activate the license
   *
   *  @since 1.3.0
   */
   
   function alm_cache_activate_license() {
   
   	// listen for our activate button to be clicked
   	if( isset( $_POST['alm_cache_license_activate'] ) ) {
   
   		// run a quick security check 
   	 	if( ! check_admin_referer( 'alm_cache_license_nonce', 'alm_cache_license_nonce' ) ) 	
   			return; // get out if we didn't click the Activate button
   
   		// retrieve the license from the database
   		$license = trim( get_option( 'alm_cache_license_key' ) );
   
   		// data to send in our API request
   		$api_params = array( 
   			'edd_action'=> 'activate_license', 
   			'license' 	=> $license, 
   			'item_id'   => ALM_CACHE_ITEM_NAME, // the ID of our product in EDD
   			'url'       => home_url()
   		);
   		
   		// Call the custom API.
   		$response = wp_remote_get( add_query_arg( $api_params, ALM_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
   
   		// make sure the response came back okay
   		if ( is_wp_error( $response ) )
   			return false;
   
   		// decode the license data
   		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
   		
   		// $license_data->license will be either "valid" or "invalid"
   
   		update_option( 'alm_cache_license_status', $license_data->license );
   
   	}
   }
   add_action('admin_init', 'alm_cache_activate_license');
   
   
   
   /*
   *  alm_cache_deactivate_license
   *  Deactivate license
   *
   *  @since 1.3.0
   */
   
   function alm_cache_deactivate_license() {
   
   	// listen for our activate button to be clicked
   	if( isset( $_POST['alm_cache_license_deactivate'] ) ) {
   
   		// run a quick security check 
   	 	if( ! check_admin_referer( 'alm_cache_license_nonce', 'alm_cache_license_nonce' ) ) 	
   			return; // get out if we didn't click the Activate button
   
   		// retrieve the license from the database
   		$license = trim( get_option( 'alm_cache_license_key' ) );
   			
   
   		// data to send in our API request
   		$api_params = array( 
   			'edd_action'=> 'deactivate_license', 
   			'license' 	=> $license, 
   			'item_id'   => ALM_CACHE_ITEM_NAME, // the ID of our product in EDD
   			'url'       => home_url()
   		);
   		
   		// Call the custom API.
   		$response = wp_remote_get( add_query_arg( $api_params, ALM_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
   
   		// make sure the response came back okay
   		if ( is_wp_error( $response ) )
   			return false;
   
   		// decode the license data
   		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
   		
   		// $license_data->license will be either "deactivated" or "failed"
   		if( $license_data->license == 'deactivated' )
   			delete_option( 'alm_cache_license_status' );
   
   	}
   }
   add_action('admin_init', 'alm_cache_deactivate_license');
   	
   	
   /*
   *  ALMCache
   *  The main function responsible for returning Ajax Load More CACHE.
   *
   *  @since 1.0
   */	
   
   function ALMCache(){
   	global $alm_cache;
   
   	if( !isset($alm_cache) ){
   		$alm_cache = new ALMCache();
   	}
   
   	return $alm_cache;
   }
   
   // initialize
   ALMCache();

endif; // class_exists check


/* Software Licensing */

define('ALM_CACHE_ITEM_NAME', '4878' ); // EDD CONSTANT - Item ID
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include( dirname( __FILE__ ) . '/vendor/EDD_SL_Plugin_Updater.php' );
}

function alm_cache_plugin_updater() {	
	$license_key = trim( get_option( 'alm_cache_license_key' ) ); // retrieve our license key from the DB
	$edd_updater = new EDD_SL_Plugin_Updater( ALM_STORE_URL, __FILE__, array( 
			'version' 	=> ALM_CACHE_VERSION,
			'license' 	=> $license_key,
			'item_id'   => ALM_CACHE_ITEM_NAME,
			'author' 	=> 'Darren Cooney'
		)
	);
}
add_action( 'admin_init', 'alm_cache_plugin_updater', 0 );	

/* End Software Licensing */