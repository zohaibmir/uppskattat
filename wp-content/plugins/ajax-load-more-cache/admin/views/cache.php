<?php 


if(isset($_GET['action'])) {
   if($_GET['action'] === 'delete'){ // Delete cache action
   	$path = ALM_CACHE_PATH .'_cache/';
   	foreach (new DirectoryIterator($path) as $directory) {
         if ($directory->isDot())  continue;
      
         if ($directory->isDir()){        
            $path_to_directory = $path . $directory;
            alm_cache_rrmdir($path_to_directory);
         }	
   	}
   	$cache_msg = __('Cache deleted successfully', ALM_NAME);
   	unset($_GET);
   	
   	// Redirect user to ?action=deleted to prevent double submit
   	echo'<script> window.location="admin.php?page=ajax-load-more-cache&action=deleted"; </script> ';
	}
	if($_GET['action'] === 'deleted'){ // Cache deleted action
   	$cache_msg = __('Cache deleted successfully', ALM_NAME);
   }
}


// Remove directory + files
function alm_cache_rrmdir($path_to_directory) {
   $file = $path_to_directory;
   if (is_dir($file)) {
      foreach (glob($file."/*.*") as $filename) {
          if (is_file($filename)) {
              unlink($filename);
          }
      }
      rmdir($file);
   }   
}
?>
<div class="admin ajax-load-more" id="alm-cache" data-msg="<?php _e('Are you sure you want to delete this cache?', ALM_NAME); ?>">	
	<div class="wrap">
		<div class="header-wrap">
	   		<h2><?php echo ALM_TITLE; ?>: <strong><?php _e('Cache', ALM_NAME); ?></strong></h2>
	   		<p><?php _e('Manage your active Ajax Load More Cache', ALM_NAME); ?></p>  
		</div>
		<div class="cnkt-main">
		   
		   <div class="group">
		      <?php 
			   if(!isset($cache_msg)) { ?>
		      <span class="toggle-all"><span class="inner-wrap"><em class="collapse"><?php _e('Collapse All', ALM_NAME); ?></em><em class="expand"><?php _e('Expand All', ALM_NAME); ?></em></span></span>
		      <?php } ?>
			   <div class="row no-brd">
			      <?php 
			      if(isset($cache_msg)) {
			         echo '<div class="cache-cleared"><i class="fa fa-check-square-o"></i> ';
                  echo __('Cache successfully deleted.', ALM_NAME);	
                  echo '<span class="remove"><a href="admin.php?page=ajax-load-more-cache">' . __('Got it', ALM_NAME) . '</a></span>';
                  echo '</div>';		      
			      }
			      ?>
			      <h3><?php _e('Cache Dashboard', ALM_NAME); ?></h3>
			      <p>Below you will find the listing of your entire Ajax Load More cache. This listing is grouped by the <strong>Cache ID</strong> assigned when your <a href="admin.php?page=ajax-load-more-shortcode-builder">Shortcode</a> was created.</p>
			      <p><a href="admin.php?page=ajax-load-more"><strong>Cache Settings</strong></a> &nbsp;|&nbsp;  <a href="http://connekthq.com/plugins/ajax-load-more/cache/" target="_blank"><strong>Get Help</strong></a></p>
			      
			      <div class="spacer"></div>
			      
			      <div class="alm-cache-search-wrap">
   			      <input type="text" name="alm-cache-search" id="alm-cache-search" value="" placeholder="<?php _e('Search by cache ID or cache URL... ', ALM_NAME); ?>">
   			      <i class="fa fa-search"></i>
			      </div>
			      
		         <?php
			         
		         // Loop thru our cache directories			         
               $path = ALM_CACHE_PATH .'_cache/';
               $directoy_total = 0;
               
               $staticDirectories = array();
               
               // Loop the directories and store values in array for sorting
               foreach (new DirectoryIterator($path) as $file) {
                  if ($file->isDot())  
                  	continue;
                  
                  if ($file->isDir())                            
	               	$staticDirectories[] = $file->getFilename();                
               }               
               
               asort($staticDirectories); // Sort the directory array
               foreach($staticDirectories as $directory){ // Loop thru our sorted directories and store files in array for sorting
	               
                  $directoy_total++;
                  
                  echo '<div class="alm-dir-listing">';
                     echo '<h3 class="heading dir dir-title" title="'. $path . '/' . $directory .'">'. $directory . ' <a href="javascript:void(0);" class="delete" data-id="'. $directory .'" title="'.__('Delete this cache', ALM_NAME).'">'. __('Delete', ALM_NAME) .'</a></h3>';
                     
                     echo '<div class="expand-wrap">';                     
                                        
                     $sub_path = $path . $directory;  
                     
                     // Get value of _info.txt
                     $url = file_get_contents(ALM_CACHE_PATH .'/_cache/'. $directory.'/_info.txt');	                     
                     if($url){
	                     echo '<ul class="cache-details">';
                     	$info = unserialize($url); 
	                     echo '<li title="'.__('Cached URL', ALM_NAME).'"><i class="fa fa-globe"></i> <a href="' . $info['url'] . '" target="_blank">' . $info['url'] . '</a></li>';
	                     echo '<li title="'.__('Date Created', ALM_NAME).'"><i class="fa fa-clock-o"></i> ' . $info['created'] . '</li>';
								echo '</ul>';
                     }                     
                     
                     // Display cached pages
                     echo '<div class="cache-page-wrap">'; 
                     echo '<ul>';    
	                  echo '<div class="cache-page-title">'.__('Cached files in this directory', ALM_NAME).':</div>';
	                  
	                  $staticFiles = array();                 
                     foreach (new DirectoryIterator($sub_path) as $sub_file) { // each file	                     
                        if ($sub_file->isDot() || $sub_file->getFilename() === '_info.txt') 
                        	continue;
                        	
                        if ($sub_file->isFile())                            
                        	$staticFiles[] = $sub_file->getFilename();                                              	                         
                     }
                     
                     asort($staticFiles); // Sort the file array
                     foreach($staticFiles as $static){ // Loop the sorted array to display static html  
                        echo '<li class="file"><i class="fa fa-file-text-o"></i> <a href="'. ALM_CACHE_URL .'/_cache/'. $directory . '/'. $static .'" target="_blank">'. $static . '</a></li>';                             
                     }
                     
                     echo '</div>';
                     echo '</ul>';
                     echo '</div>';
                  echo '</div>';
               }
               
               // Is empty?
               if($directoy_total == 0){
                  echo '<div class="dir-empty">';
                  echo __('Ajax Load More cache is currently empty.', ALM_NAME);
                  echo '<style>.toggle-all, .alm-cache-search-wrap{display:none !important;}</style>';
                  echo '</div>';
               }   
                           
               ?>
			   </div>	   
		   </div>
		   
	   </div>	   
	   
	   <div class="cnkt-sidebar">
	      <div class="cta">
	         <h3>Statistics</h3>
	         <?php 
	            
               $dircount = 0;
               $filecount = 0;
               $directories = glob($path . "*");
               
               foreach($directories as $directory){
                  $dir = glob($directory . "*");
                  $val = count(glob($dir[0] .'/*.html'));
                  if($val > 0){
                     $dircount++;
                     $filecount = $filecount + $val;
                  }
               }
            ?>
	         <p class="cache-stats"><span class="stat"><?php echo $dircount; ?></span><?php _e('Page(s)', ALM_NAME); ?></p>
	         <p class="cache-stats last"><span class="stat"><?php echo $filecount; ?></span><?php _e('Cached File(s)', ALM_NAME); ?></p>
	         <div class="spacer"></div>
	         <form id="delete-all-cache" name="delete-all-cache" action="admin.php" method="GET" data-msg="<?php _e('Are you sure you want to delete the entire Ajax Load More cache?', ALM_NAME); ?>">
		         <input type="hidden" value="ajax-load-more-cache" name="page">
		         <button type="submit" class="button-primary" name="action" value="delete"><?php _e('Delete Cache', ALM_NAME); ?></button>
		      </form>
	         
	      </div>
	   	<?php include_once( ALM_CACHE_PATH . 'admin/includes/cta/writeable.php'); ?>
	   </div>	   
	   	
	</div>
</div>