<div class="cta">
	<h3><?php _e('Status', ALM_NAME); ?></h3>
	<div class="item">
	<?php
   //Test server for write capabilities	
	$alm_cache_file =  ALM_CACHE_PATH .'_cache/_is_writeable.php'; // Test config file  	
	if(file_exists($alm_cache_file)){
   	if (is_writable($alm_cache_file))
   	    echo __('<p class="writeable-title"><i class="fa fa-check"></i><strong>ALM - Cache</strong></p><p class="desc">Excellent! Read/Write access is enabled within the /ajax-load-more-cache/_cache/ directory.', ALM_NAME);
   	else
   	    echo __('<p class="writeable-title"><i class="fa fa-exclamation"></i><strong>ALM - Cache</strong></p>Access Denied! You must enable read and write access for Ajax Load More Cache directory (/ajax-load-more-cache/_cache/) in order to save cache data.<br/><br/>Please contact your hosting provider or site administrator for more information.', ALM_NAME);
   }else{
      echo __('<p class="writeable-title"><i class="fa fa-exclamation"></i><strong>ALM - Cache</strong></p><p class="desc">Unable to locate configuration file. Directory access may not be granted.', ALM_NAME);
   }   
   ?>
</div>