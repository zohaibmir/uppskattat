<div class="admin ajax-load-more" id="alm-add-ons">	
	<div class="wrap">
		<div class="header-wrap">
	   		<h2><?php echo ALM_TITLE; ?>: <strong><?php _e('Add-ons', ALM_NAME); ?></strong></h2>
	   		<p><?php _e('Add-ons are available to extend and enhance the core functionality of Ajax Load More', ALM_NAME); ?></p>  
		</div>
		<div class="cnkt-main full">
		
		   <!-- Cache -->
		   <div class="group">
			   <div class="row no-brd">
   			   <?php 
                  	$cache_url = 'https://connekthq.com/plugins/ajax-load-more/add-ons/cache/?utm_source=WP%20Admin&utm_medium=ALM%20Add-ons&utm_campaign=Cache'; ?>
                  	
               <a href="<?php echo $cache_url; ?>">
   			      <div class="expand-wrap">
                     <img src="<?php echo ALM_ADMIN_URL; ?>img/add-ons/cache-add-on.jpg">                         
                     <h2 class="addon-title"><?php _e('Cache', ALM_NAME); ?></h2>
                     <p class="addon-intro"><?php _e('Improve performance with the Ajax Load More caching engine.', ALM_NAME); ?></p>
                     <p><?php _e('The Cache add-on creates static HTML files of Ajax Load More requests then delivers those static files to your visitors.', ALM_NAME); ?></p>    
                     <?php
                        if (has_action('alm_cache_installed')){
                           echo '<span class="cnkt-button installed"><i class="fa fa-check-square"></i> Installed</span> ';
                        }else{
                           echo '<span class="cnkt-button"><i class="fa fa-download"></i> Purchase &amp; Install</span>';
                        }
                     ?>               
                  </div>
               </a>
			   </div>		   
             		   
		   </div>
		   <!-- End Cache -->
		   
		   
		   <!-- Custom Repeaters -->
		   <div class="group">
			   <div class="row no-brd">
   			   <?php $cr_url = 'https://connekthq.com/plugins/ajax-load-more/add-ons/custom-repeaters/?utm_source=WP%20Admin&utm_medium=ALM%20Add-ons&utm_campaign=Custom%20Repeaters'; ?>
   			   <a href="<?php echo $cr_url; ?>">
   			      <div class="expand-wrap">
                     <img src="<?php echo ALM_ADMIN_URL; ?>img/add-ons/unlimited-add-ons.jpg">      
                     <h2 class="addon-title"><?php _e('Custom Repeaters', ALM_NAME); ?></h2>
                     <p class="addon-intro"><?php _e('Extend Ajax Load More with unlimited repeater templates.', ALM_NAME); ?></p>
                     <p><?php _e('Create, delete and modify repeater templates as you need them with absolutely zero restrictions.', ALM_NAME); ?></p>
                     <?php
                     	
                        if (has_action('alm_unlimited_installed')){
                           echo '<span class="cnkt-button installed"><i class="fa fa-check-square"></i> Installed</span> ';
                        }else{
                           echo '<span class="cnkt-button"><i class="fa fa-download"></i> Purchase &amp; Install</span>';
                        }
                     ?> 
   			      </div>	
   			   </a>
			   </div>		   
            		   
		   </div>
		   <!-- End Custom Repeaters -->		   
		   
		   
		   <!-- Paging -->
		   <div class="group">
			   <div class="row no-brd">
   			   <?php
                  	$paging_url = 'https://connekthq.com/plugins/ajax-load-more/add-ons/paging/?utm_source=WP%20Admin&utm_medium=ALM%20Add-ons&utm_campaign=Paging';
      			   ?>
   			   <a href="<?php echo $paging_url; ?>">
			      <div class="expand-wrap">
                  <img src="<?php echo ALM_ADMIN_URL; ?>img/add-ons/paging-add-ons.jpg">          
                  <h2 class="addon-title"><?php _e('Paging', ALM_NAME); ?></h2>
                  <p class="addon-intro"><?php _e('Extend Ajax Load More with a numbered navigation.', ALM_NAME); ?></p>
                  <p><?php _e('The Paging add-on will transform the default infinite scroll functionality into a robust ajax powered navigation system.', ALM_NAME); ?></p>   
                  <?php
                     if (has_action('alm_paging_installed')){
                        echo '<span class="cnkt-button installed"><i class="fa fa-check-square"></i> Installed</span> ';
                     }else{
                        echo '<span class="cnkt-button"><i class="fa fa-download"></i> Purchase &amp; Install</span>';
                     }
                  ?>             
               </div>
   			   </a>
			   </div>			   
            		   
		   </div>
		   <!-- End Paging --> 
		   
		   
		   <!-- Preloaded -->
		   <div class="group">
			   <div class="row no-brd">   			   
   			   <?php
      			   $preload_url = 'https://connekthq.com/plugins/ajax-load-more/add-ons/preloaded/?utm_source=WP%20Admin&utm_medium=ALM%20Add-ons&utm_campaign=Preloaded';
      			   ?>
   			   <a href="<?php echo $preload_url; ?>">
   			      <div class="expand-wrap">
                     <img src="<?php echo ALM_ADMIN_URL; ?>img/add-ons/preloaded-add-ons.jpg">  
                     <h2 class="addon-title"><?php _e('Preloaded', ALM_NAME); ?></h2>
                     <p class="addon-intro"><?php _e('Load an initial set of posts before making Ajax requests to the server.', ALM_NAME); ?></p>
                     <p><?php _e('The Preloaded add-on will display content quicker and allow caching of the initial query which can reduce stress on your server.', ALM_NAME); ?></p>        	   
                     <?php
                        if (has_action('alm_preload_installed')){
                           echo '<span class="cnkt-button installed"><i class="fa fa-check-square"></i> Installed</span> ';
                        }else{
                           echo '<span class="cnkt-button"><i class="fa fa-download"></i> Purchase &amp; Install</span>';
                        }
                     ?>            
                  </div>
   			   </a>
			   </div>				   
		   </div>
		   <!-- End Preloaded --> 
		   
		   
		   <!-- Previous Post -->
		   <div class="group">
			   <div class="row no-brd">   			   
   			   <?php
      			   $prev_url = 'https://connekthq.com/plugins/ajax-load-more/add-ons/previous-post/?utm_source=WP%20Admin&utm_medium=ALM%20Add-ons&utm_campaign=Previous Post';
      			?>
   			   <a href="<?php echo $prev_url; ?>">
   			      <div class="expand-wrap">
                     <img src="<?php echo ALM_ADMIN_URL; ?>img/add-ons/prev-post-add-on.jpg">  
                     <h2 class="addon-title"><?php _e('Previous Post', ALM_NAME); ?></h2>
                     <p class="addon-intro"><?php _e('An extension to enable infinite scrolling of single posts.', ALM_NAME); ?></p>
                     <p><?php _e('The Previous Post add-on will load single posts as you scroll and update the browser URL to the current post.', ALM_NAME); ?></p>        	   
                     <?php
                        if (has_action('alm_prev_post_installed')){
                           echo '<span class="cnkt-button installed"><i class="fa fa-check-square"></i> Installed</span> ';
                        }else{
                           echo '<span class="cnkt-button"><i class="fa fa-download"></i> Purchase &amp; Install</span>';
                        }
                     ?>            
                  </div>
   			   </a>
			   </div>				   
		   </div>
		   <!-- End Previous Post --> 
		   
		   
		   <!-- SEO -->
		   <div class="group">
			   <div class="row no-brd">
   			   <?php
      			   $seo_url = 'https://connekthq.com/plugins/ajax-load-more/add-ons/search-engine-optimization/?utm_source=WP%20Admin&utm_medium=ALM%20Add-ons&utm_campaign=SEO';
      			   ?>
   			   <a href="<?php echo $seo_url; ?>">
   			      <div class="expand-wrap">
                     <img src="<?php echo ALM_ADMIN_URL; ?>img/add-ons/seo-add-ons.jpg"> 
                     <h2 class="addon-title"><?php _e('Search Engine Optimization', ALM_NAME); ?></h2>
                     <p class="addon-intro"><?php _e('Generate unique paging URLs with every Ajax Load More query.', ALM_NAME); ?></p>
                     <p><?php _e('The SEO add-on will optimize your ajax loaded content for search engines by generating unique URLs with every query.</p>', ALM_NAME); ?></p>    
                     <?php
                     	
                        if (has_action('alm_seo_installed')){
                           echo '<span class="cnkt-button installed"><i class="fa fa-check-square"></i> Installed</span> ';
                        }else{
                           echo '<span class="cnkt-button"><i class="fa fa-download"></i> Purchase &amp; Install</span>';
                        }
                     ?>                  
                  </div>
   			   </a>
			   </div>			   
            		   
		   </div>
		   <!-- End SEO -->
		   
		   
		   <!-- Theme Repeaters -->
		   <div class="group">
			   <div class="row no-brd">
			      <?php $themer_url = 'https://connekthq.com/plugins/ajax-load-more/add-ons/theme-repeaters/?utm_source=WP%20Admin&utm_medium=ALM%20Add-ons&utm_campaign=Theme Repeaters'; ?>
			      <a href="<?php echo $themer_url; ?>">
			         <div class="expand-wrap">
                     <img src="<?php echo ALM_ADMIN_URL; ?>img/add-ons/theme-repeater-add-on.jpg"> 
                     <h2 class="addon-title"><?php _e('Theme Repeaters', ALM_NAME); ?></h2>
                     <p class="addon-intro"><?php _e('Manage repeater templates within your current theme directory.', ALM_NAME); ?></p>
                     <p><?php _e('The Theme Repeater add-on will allow you load, edit and maintain templates from your current theme directory.</p>', ALM_NAME); ?></p>    
                     <?php
                     	
                        if (has_action('alm_theme_repeaters_installed')){
                           echo '<span class="cnkt-button installed"><i class="fa fa-check-square"></i> Installed</span> ';
                        }else{
                           echo '<span class="cnkt-button"><i class="fa fa-download"></i> Purchase &amp; Install</span>';
                        }
                     ?>                
                  </div>
   			   </a>  
			   </div>			   
            		   
		   </div>
		   <!-- End Theme Repeaters -->
		   
	   </div>	   
	   
		<div class="call-out light">
		   <p><?php _e('All add-ons are installed as stand alone plugins and with a valid license key will receive plugin update notifications directly within the <a href="plugins.php">WordPress plugin dashboard</a>.', ALM_NAME); ?></p>
   	</div>   
	   	
	</div>
</div>