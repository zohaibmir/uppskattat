<span class="toggle-all"><span class="inner-wrap"><em class="collapse"><?php _e('Collapse All', ALM_NAME); ?></em><em class="expand"><?php _e('Expand All', ALM_NAME); ?></em></span></span>

<?php 
   $alm_options = get_option( 'alm_settings' );         
   if(!isset($alm_options['_alm_disable_dynamic'])) // Check if '_alm_disable_dynamic is set within settings
	   $alm_options['_alm_disable_dynamic'] = '0';		
	   
	$disable_dynamic_content = $alm_options['_alm_disable_dynamic'];   
?>



<?php if(has_action('alm_cache_installed')){ ?>
<!-- CACHE -->
<div class="row input cache add-on" id="alm-cache">
   <h3 class="heading"><?php _e('Cache', ALM_NAME); ?></h3>
   <div class="expand-wrap">
      <div class="section-title">
	      <h4>Enable Caching</h4>
		 	<p><?php _e('Turn on content caching.', ALM_NAME); ?></p>
		 </div>
      <div class="wrap">
         <div class="inner">	               
            <ul>
                <li>
                 <input class="alm_element" type="radio" name="cache" value="true" id="cache-true" >
                 <label for="cache-true"><?php _e('True', ALM_NAME); ?></label>
                </li>
                <li>
                 <input class="alm_element" type="radio" name="cache" value="false" id="cache-false"  checked="checked">
                 <label for="cache-false"><?php _e('False', ALM_NAME); ?></label>
                </li>
            </ul>
         </div>
      </div>
      <div class="clear"></div>
      <div class="cache_id">        
         <div class="clear"></div>
         <hr>
         <div class="section-title">
            <h4>Cache ID</h4>
   		 	<p><?php _e('You <u>must</u> generate a unique ID for this cached query - this unique ID will be used as a content identifier.', ALM_NAME); ?></p>   		 	
   		 </div>
         <div class="wrap">
            <div class="inner">            
               <input type="text" class="alm_element disabled" name="cache-id" id="cache-id" disabled="disabled">
               <div class="clear"></div>
               <p class="generate-cache-id"><a href="javascript:void(0);"><i class="fa fa-random"></i> <?php _e('Generate New ID', ALM_NAME); ?></a></p>  
            </div>
         </div>        
      </div> 
   </div>
</div> 
<?php } ?>

<?php if(has_action('alm_paging_installed')){ ?>
<!-- PAGING -->
<div class="row input paging add-on" id="alm-paging">
   <h3 class="heading"><?php _e('Paging', ALM_NAME); ?></h3>
   <div class="expand-wrap">
      <div class="section-title">
		 	<p><?php _e('Replace infinite scrolling with a paged ajax navigation system.', ALM_NAME); ?></p>
		 </div>
      <div class="wrap">
         <div class="inner">	               
            <ul>
                <li>
                 <input class="alm_element" type="radio" name="paging" value="true" id="paging-true" >
                 <label for="paging-true"><?php _e('True', ALM_NAME); ?></label>
                </li>
                <li>
                 <input class="alm_element" type="radio" name="paging" value="false" id="paging-false" checked="checked">
                 <label for="paging-false"><?php _e('False', ALM_NAME); ?></label>
                </li>
            </ul>
         </div>
      </div>
      
      <div class="clear"></div>
      <div id="nav-controls">
         
         <hr/>
         <div class="section-title">
            <h4><?php _e('Paging Controls', ALM_NAME); ?></h4>
   		 	<p><?php _e('Show (&laquo;)previous and next(&raquo;) buttons.', ALM_NAME); ?></p>
         </div>
         <div class="wrap">
            <div class="inner">	               
               <ul>
                   <li>
                    <input class="alm_element" type="radio" name="paging-controls" value="true" id="paging-controls-true" >
                    <label for="paging-controls-true"><?php _e('True', ALM_NAME); ?></label>
                   </li>
                   <li>
                    <input class="alm_element" type="radio" name="paging-controls" value="false" id="paging-controls-false" checked="checked">
                    <label for="paging-controls-false"><?php _e('False', ALM_NAME); ?></label>
                   </li>
               </ul>
            </div>
         </div>
         
         <div class="clear"></div>
         <hr/>
         <div class="section-title">
            <h4><?php _e('Paging Navigation Classes', ALM_NAME); ?></h4>
   		 	<p><?php _e('Add custom CSS classes to the paging navigation menu.', ALM_NAME); ?></p>
   		 </div>
   		 <div class="wrap">            
            <div class="inner">            
               <input type="text" class="alm_element" name="paging-classes" id="paging-classes" placeholder="portfolio-paging-menu">  
            </div>
         </div>
         
         <div class="clear"></div>
         <hr/>
         <div class="section-title">
            <h4><?php _e('Show at Most', ALM_NAME); ?></h4>
   		 	<p><?php _e('The maximum amount of page menu items to show at a time. <br/.>0 = no maximum', ALM_NAME); ?></p>
   		 </div>
   		 <div class="wrap">            
            <div class="inner">            
               <input type="number" class="alm_element numbers-only" name="show-at-most" id="show-at-most" step="2" min="0" value="7">  
            </div>
         </div>
         
      </div>
      
   </div>
</div> 
<?php } ?>


<?php if(has_action('alm_preload_installed')){ ?>
<!-- PRELOAD -->
<div class="row input preload add-on" id="alm-preload">
   <h3 class="heading"><?php _e('Preloaded', ALM_NAME); ?></h3>
   <div class="expand-wrap">
      <div class="section-title">
		 	<p><?php _e('Preload posts prior to making Ajax requests.', ALM_NAME); ?></p>
		 </div>
      <div class="wrap">
         <div class="inner">	               
            <ul>
                <li>
                 <input class="alm_element" type="radio" name="preload" value="true" id="preload-true" >
                 <label for="preload-true"><?php _e('True', ALM_NAME); ?></label>
                </li>
                <li>
                 <input class="alm_element" type="radio" name="preload" value="false" id="preload-false" checked="checked">
                 <label for="preload-false"><?php _e('False', ALM_NAME); ?></label>
                </li>
            </ul>
         </div>
      </div>
      <div class="clear"></div>
      <div class="preload_amount">        
         <div class="clear"></div>
         <hr>
         <div class="section-title">
            <h4><?php _e('Preload Amount', ALM_NAME); ?></h4>
   		 	<p><?php _e('Enter the number of posts to preload.', ALM_NAME); ?></p>   		 	
   		 </div>
         <div class="wrap">
            <div class="inner">            
               <input type="number" class="alm_element numbers-only" name="preload-amount" id="preload-amount" step="1" min="1" value="5">  
            </div>
         </div>        
      </div> 
   </div>
</div> 
<?php } ?>


<?php if(has_action('alm_prev_post_installed')){ ?>
<!-- PREV POST -->
<div class="row input previous-post add-on" id="alm-previous-post">
   <h3 class="heading"><?php _e('Previous Post', ALM_NAME); ?></h3>
   <div class="expand-wrap">
      <div class="section-title">
		 	<p><?php _e('Enable the infinite scrolling of single posts.', ALM_NAME); ?></p>
		 </div>
      <div class="wrap">
         <div class="inner">	               
            <ul>
                <li>
                 <input class="alm_element" type="radio" name="prev-post" value="true" id="prev-post-true" >
                 <label for="prev-post-true"><?php _e('True', ALM_NAME); ?></label>
                </li>
                <li>
                 <input class="alm_element" type="radio" name="prev-post" value="false" id="prev-post-false"  checked="checked">
                 <label for="prev-post-false"><?php _e('False', ALM_NAME); ?></label>
                </li>
            </ul>
         </div>
      </div>
      <div class="clear"></div>
      <div class="prev_post_id" style="display: none;">        
         <div class="clear"></div>
         <hr>
         <div class="section-title">
            <h4><?php _e('Post ID', ALM_NAME); ?></h4>
   		 	<p><?php _e('The current post ID to pass to Ajax Load More.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">            
               <input type="text" value="get_the_ID()" id="prev_post_id"  class="alm_element disabled-input" disabled="disabled">  
            </div>
         </div> 
         <p class="warning-callout">
            <?php _e('You must add the Previous Post shortcode directly to your single template file using the <a href="https://developer.wordpress.org/reference/functions/do_shortcode/" target="_blank">do_shortcode</a> method. &raquo; <a href="https://connekthq.com/plugins/ajax-load-more/add-ons/previous-post/" target="_blank">View documentation</a>', ALM_NAME); ?>
         </p>
      </div>
   </div>
</div> 
<?php } ?>   


<?php if(has_action('alm_seo_installed')){ ?>
<!-- SEO -->
<div class="row input seo add-on" id="alm-seo">
   <h3 class="heading"><?php _e('SEO (Search Engine Optimization)', ALM_NAME); ?></h3>
   <div class="expand-wrap">
      <div class="section-title">
		 	<p><?php _e('Enable address bar URL rewrites as users page through ajax loaded content.', ALM_NAME); ?></p>
		 </div>
      <div class="wrap">
         <div class="inner">	               
            <ul>
                <li>
                 <input class="alm_element" type="radio" name="seo" value="true" id="seo-true" >
                 <label for="seo-true"><?php _e('True', ALM_NAME); ?></label>
                </li>
                <li>
                 <input class="alm_element" type="radio" name="seo" value="false" id="seo-false"  checked="checked">
                 <label for="seo-false"><?php _e('False', ALM_NAME); ?></label>
                </li>
            </ul>
         </div>
      </div>
   </div>
</div> 
<?php } ?>   

<?php

 	// List available repeaters
	echo '<div class="row repeater" id="alm-repeaters">';   		
	echo '<h3 class="heading">'.__('Template', ALM_NAME). '</h3>';
	echo '<div class="expand-wrap">';
	echo '<div class="section-title">';
	if (has_action('alm_theme_repeaters_selection')){
		echo '<h4>'.__('Repeater Template', ALM_NAME).'</h4>';
	}
	echo '<p>'.__('Select which <a href="admin.php?page=ajax-load-more-repeaters" target="_parent">repeater template</a> you would like to use.', ALM_NAME). '</p>';
	echo '</div>';
	echo '<div class="wrap"><div class="inner">';
	echo '<select name="repeater-select" id="repeater-select" class="alm_element">';
	echo '<option name="default" id="chk-default" value="default" selected="selected">Default</option>';		
	if (has_action('alm_get_custom_repeaters')) {
	  do_action('alm_get_custom_repeaters');
	}
	if (has_action('alm_get_unlimited_repeaters')) {
	  do_action('alm_get_unlimited_repeaters');
	}
	echo '</select>';
	
	echo '</div></div>';
	
	
   if (has_action('alm_theme_repeaters_selection')){
      do_action('alm_theme_repeaters_selection');  
   }    		               
                     
	
	// Custom Repeaters v2 - /cta/extend.php
	if (!has_action('alm_get_unlimited_repeaters') && !has_action('alm_get_custom_repeaters')) {
      include( ALM_PATH . 'admin/includes/cta/extend.php');
	}
	
	echo '</div>';
	echo '</div>';
 	
 
   // List registered post_types
   $pt_args = array(
      'public'   => true
   );
	$types = get_post_types($pt_args);
	if($types){
		echo '<div class="row checkboxes post_types" id="alm-post-types">';   		
		echo '<h3 class="heading">'.__('Post Types', ALM_NAME). '</h3>';
		echo '<div class="expand-wrap">';
		echo '<div class="section-title">';
		echo '<p>'.__('Select Post Types to query.', ALM_NAME). '</p>';
		echo '</div>';
		echo '<div class="wrap"><div class="inner"><ul>';
	   foreach( $types as $type ){
	     $typeobj = get_post_type_object( $type );
	     $name = $typeobj->name;
	     if( $name != 'revision' && $name != 'attachment' && $name != 'nav_menu_item' && $name != 'acf'){
            echo '<li><input class="alm_element" type="checkbox" name="chk-'.$typeobj->name.'" id="chk-'.$typeobj->name.'" data-type="'.$typeobj->name.'"><label for="chk-'.$typeobj->name.'">'.$typeobj->labels->singular_name.'</label></li>';
			}
	    }
	    echo '</ul></div></div>';
	    echo '</div>';
	    echo '</div>';
   }
   
   
   // List Post Formats
   if ( current_theme_supports( 'post-formats' ) ) {
       $post_formats = get_theme_support( 'post-formats' );
       if($post_formats){
   		echo '<div class="row checkboxes post_format" id="alm-post-format">';   		
   		echo '<h3 class="heading">'.__('Post Format', ALM_NAME). '</h3>';
   		echo '<div class="expand-wrap">';
   		echo '<div class="section-title">';
   		echo '<p>'.__('Select a <a href="http://codex.wordpress.org/Post_Formats" target="_blank">Post Format</a> to query.', ALM_NAME). '</p>';
   		echo '</div>';
   		echo '<div class="wrap"><div class="inner"><select class="alm_element" name="post-format-select" id="post-format-select">';
   		echo '<option value="" selected="selected">-- ' . __('Select Post Format', ALM_NAME) . ' --</option>';
   		echo '<option name="chk-standard" id="chk-standard" value="standard">' . __('Standard', ALM_NAME) . '</option>';		
   	   foreach( $post_formats[0] as $post_format ){
            echo '<option name="chk-'.$post_format.'" id="chk-'.$post_format.'" value="'.$post_format.'">'.ucwords($post_format).'</option>';
   	   }	   
   		echo '</select></div></div>';
   		echo '</div>';
   		echo '</div>';
      }
       
   }
   
   // List Categories
   
   if($disable_dynamic_content){
	   $cats = 'null';
   }else{
	   $cats = get_categories();
   }
	if($cats){ ?>		
	<div class="row checkboxes categories" id="alm-categories">
      <h3 class="heading"><?php _e('Category', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
            <h4>Include</h4>
            <p><?php _e('A comma separated list of categories to include by slug. (design, research etc...)', ALM_NAME); ?><br/>
            &raquo; <a href="admin.php?page=ajax-load-more-examples#example-category">
            <?php _e('view example', ALM_NAME); ?></a></p>
         </div>
         <div class="wrap">
            <div class="inner">            
               <?php
               if(!$disable_dynamic_content){
                  echo '<select class="alm_element multiple" name="category-select" id="category-select" multiple="multiple">';
                  foreach( $cats as $cat ){
                     echo '<option name="chk-'.$cat->slug.'" id="chk-'.$cat->slug.'" value="'.$cat->slug.'">'.$cat->name.'</option>';
                  }
                  echo '</select>';
               }else{
                  echo '<input type="text" class="alm_element" name="category-select" id="category-select" placeholder="design, development, science etc...">';
               }
               ?>
            </div>
         </div>
         
         <div class="clear"></div>
         <hr/>
      
         <div class="section-title">         
            <h4><?php _e('Exclude', ALM_NAME); ?></h4>
            <p><?php _e('A comma separated list of categories to exclude by ID. (3, 12, 35 etc..)', ALM_NAME); ?></p>
         </div>
         <div class="wrap">
            <div class="inner">           
               <?php
               if(!$disable_dynamic_content){
                  echo '<select class="alm_element multiple" name="category-exclude-select" id="category-exclude-select" multiple="multiple">';
                  foreach( $cats as $cat ){
                     echo '<option name="chk-'.$cat->term_id.'" id="chk-'.$cat->term_id.'" value="'.$cat->term_id.'">'.$cat->name.'</option>';
                  }
                  echo '</select>';
               }else{
                  echo '<input type="text" class="alm_element numbers-only" name="category-exclude-select" id="category-exclude-select" placeholder="10, 12, 19 etc...">';
               }
               ?>
            </div>
            <div class="clear"></div>
         </div>     
      </div>
   </div>
    
    <?php }
    
    // Tags	    
	if($disable_dynamic_content){
	   $tags = 'null';
   }else{
	   $tags = get_tags();
   }
	if($tags){ ?>
	<div class="row checkboxes tags" id="alm-tags">
		<h3 class="heading"><?php _e('Tag', ALM_NAME); ?></h3>
		<div class="expand-wrap">
   		<div class="section-title">
   		<h4><?php _e('Include', ALM_NAME); ?></h4>
   		<p><?php _e('A comma separated list of tags to include by slug. (toronto, canada etc...)', ALM_NAME); ?><br/>&raquo; <a href="admin.php?page=ajax-load-more-examples#example-tag">view example</a></p>
   		</div>
   		<div class="wrap">
   		   <div class="inner">
              <?php
         	  if(!$disable_dynamic_content){
         	     echo '<select class="alm_element multiple" name="tag-select" id="tag-select" multiple="multiple">';
             	  foreach( $tags as $tag ){
                     echo '<option name="chk-'.$tag->slug.'" id="chk-'.$tag->slug.'" value="'.$tag->slug.'">'.$tag->name.'</option>';
            	  }
            	  echo '</select>';
         	  }else{
            	  echo '<input type="text" class="alm_element" name="tag-select" id="tag-select" placeholder="hockey, puck, crosby etc...">';
         	  }
         	   ?>
            </div>
   	  </div>
   	  <div class="clear"></div>
         <hr/>
      
         <div class="section-title">         
            <h4><?php _e('Exclude', ALM_NAME); ?></h4>
            <p><?php _e('A comma separated list of tags to exclude by ID. (30, 12, 99 etc..)', ALM_NAME); ?></p>
         </div>
         <div class="wrap">
            <div class="inner">           
               <?php
               if(!$disable_dynamic_content){
                  echo '<select class="alm_element multiple" name="tag-exclude-select" id="tag-exclude-select" multiple="multiple">';
                  foreach( $tags as $tag ){
                     echo '<option name="chk-'.$tag->term_id.'" id="chk-'.$tag->term_id.'" value="'.$tag->term_id.'">'.$tag->name.'</option>';
                  }
                  echo '</select>';
               }else{
                  echo '<input type="text" class="alm_element numbers-only" name="tag-exclude-select" id="tag-exclude-select" placeholder="10, 12, 19 etc...">';
               }
               ?>
            </div>
            <div class="clear"></div>
         </div>
	  </div>
   </div>
   <?php } ?>
    
   <?php
	// Taxonomies
	$tax_args = array(
		'public'   => true,
		'_builtin' => false	
	); 
	$tax_output = 'objects'; // or objects
	$taxonomies = get_taxonomies( $tax_args, $tax_output ); 
	if ( $taxonomies ) {
		echo '<div class="row taxonomy" id="alm-taxonomy">';   		
		echo '<h3 class="heading">'.__('Taxonomy', ALM_NAME). '</h3>';
		echo '<div class="expand-wrap">';
		echo '<div class="section-title">';
		echo '<p>'.__('Select your custom taxonomy then select the terms and operator.', ALM_NAME). '</p>';
		echo '</div>';
		
		echo '<div class="wrap">';
		
		echo '<div class="inner">';
		echo '<select class="alm_element" name="taxonomy-select" id="taxonomy-select">';
		echo '<option value="" selected="selected">-- ' . __('Select Taxonomy', ALM_NAME) . ' --</option>';
	    foreach( $taxonomies as $taxonomy ){
         echo '<option name="chk-'.$taxonomy->query_var.'" id="chk-'.$taxonomy->query_var.'" value="'.$taxonomy->query_var.'">'.$taxonomy->label.'</option>';
	    }
	    echo '</select>';
	    echo '</div>';
	    
	    echo '<div id="taxonomy-extended">';
	    echo '<div class="inner border-top" id="tax-terms">';
	    echo '<label class="full">'. __('Taxonomy Terms:', ALM_NAME) .'</label>';
	    echo '<div id="tax-terms-container" class="checkboxes"></div>';
	    echo '</div>';
	    
	    echo '<div class="inner border-top" id="tax-operator-select">';
	    echo '<label class="full">'. __('Taxonomy Operator:', ALM_NAME) .'</label>';
	    echo '<ul class="radio">';
	    echo '<li><input class="alm_element" name="tax-operator" id="tax-in-radio" value="IN" type="radio" checked="checked"><label for="tax-in-radio">IN (default)</li>';
	    echo '<li><input class="alm_element" name="tax-operator" id="tax-not-in-radio" value="NOT IN" type="radio"><label for="tax-not-in-radio">NOT IN</li>';
	    echo '</ul>';
	    echo '</div>';	    
	    echo '</div>';
	    
	    echo '</div>';
	    echo '</div>';
	    echo '</div>';
	}?>
	
	
   <!-- Date -->
   <div class="row input date" id="alm-date">
      <h3 class="heading"><?php _e('Date', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Enter a year, month(number) and day to query by date archive.<br/>&raquo; <a href="admin.php?page=ajax-load-more-examples#example-date">view example</a>', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">
               <div class="wrap-30">
                  <?php $today = getdate(); ?>
                  <label for="input-year" class="full"><?php _e('Year:', ALM_NAME); ?></label>
                  <input name="input-year" class="alm_element sm numbers-only" type="text" id="input-year" maxlength="4" placeholder="<?php echo $today['year']; ?>">
               </div>
               <div class="wrap-30">
                  <label for="input-month" class="full"><?php _e('Month:', ALM_NAME); ?></label>
                  <input name="input-month" class="alm_element sm numbers-only" type="text" id="input-month" maxlength="2" placeholder="<?php echo $today['mon']; ?>">
               </div>
               <div class="wrap-30">
                  <label for="input-day" class="full"><?php _e('Day:', ALM_NAME); ?></label>
                  <input name="input-day" class="alm_element sm numbers-only" type="text" id="input-day" maxlength="2" placeholder="<?php echo $today['mday']; ?>">
               </div>
            </div>
         </div>
      </div>
   </div>
        
   
   <?php // Meta_Query / Custom Fields ?>
   <div class="row input meta-key" id="alm-meta-key">
      <h3 class="heading"><?php _e('Custom Fields (Meta_Query)', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title full">
            <p><?php _e('Query for <a href="http://codex.wordpress.org/Class_Reference/WP_Meta_Query" target="_blank">custom field</a> by entering a custom field key, value and operator.', ALM_NAME); ?></p>
         </div>
         <div class="wrap full">
            
            <div class="meta-query-wrap">
               <?php include( ALM_PATH . 'admin/shortcode-builder/includes/meta-query-options.php'); ?>
            </div>
            <div id="meta-query-relation">
               <div class="inner border-top highlighted">
                  <div class="wrap-30">
                     <label for="meta-relation" class="full"><?php _e('Relation:', ALM_NAME); ?></label>
                     <select class="alm_element meta-relation" name="meta-relation">
                        <option value="AND" selected="selected">AND</option>
                        <option value="OR">OR</option>
                     </select>
                  </div>
               </div>
            </div>
            <div id="meta-query-extended">
               
            </div>             
            
            <div class="inner border-top controls">
               <button class="button button-primary" id="add-meta-query"><?php _e('Add Another', ALM_NAME); ?></button>  
            </div> 
                   
         </div>      
      </div>
   </div>
   
   
   <?php // List Authors
	if($disable_dynamic_content){
	   $authors = 'null';
   }else{
	   $authors = get_users();
   }	   	
	if($authors){
		echo '<div class="row checkboxes authors" id="alm-authors">';
		echo '<h3 class="heading">' . __('Author', ALM_NAME) . '</h3>';
		echo '<div class="expand-wrap">';
		echo '<div class="section-title">';
		echo '<p>' . __('Select an Author to query(by ID).', ALM_NAME) . '<br/>&raquo; <a href="admin.php?page=ajax-load-more-examples#example-author">view example</a></p>';
		echo '</div>';
		echo '<div class="wrap"><div class="inner">';
		if(!$disable_dynamic_content){
		   echo '<select class="alm_element" name="author-select" id="author-select">';
   		echo '<option value="" selected="selected">-- ' . __('Select Author', ALM_NAME) . ' --</option>';
   	   foreach( $authors as $author ){
            echo '<option name="chk-'.$author->user_login.'" id="chk-'.$author->user_login.'" value="'.$author->ID.'">'.$author->display_name.'</option>';
   	    }
   	   echo '</select>';
	   }else{
   	  echo '<input type="text" class="alm_element numbers-only" name="author-select" id="author-select" placeholder="1">';
	   }	   
	   echo '</div></div>';
	   echo '</div>';
	   echo '</div>';
    }
   ?>    
    
   <!-- Search term -->
   <div class="row input search-term" id="alm-search">
      <h3 class="heading"><?php _e('Search Term', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Enter a search term to query.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">
               <input name="search-term" class="alm_element" type="text" id="search-term" value="" placeholder="<?php _e('Enter search term', ALM_NAME); ?>">
            </div>
         </div>
      </div>
   </div> 
    
   <!-- Custom Arguments -->
   <div class="row input custom-arguments" id="alm-custom-args">
      <h3 class="heading"><?php _e('Custom Arguments', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('A semicolon separated list of custom value:pair arguments.<br/><br/>e.g. tag_slug__and:design,development; event_display:upcoming. Default', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">
               <input name="custom-args" class="alm_element" type="text" id="custom-args" value="" placeholder="<?php _e('event_display:upcoming', ALM_NAME); ?>">
            </div>
         </div>
      </div>
   </div>   
    
   <!-- Post Parameters -->
   <div class="row input post-in" id="alm-post-in">
      <h3 class="heading"><?php _e('Post Parameters', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
            <h4><?php _e('Include', ALM_NAME); ?></h4>
   		 	<p><?php _e('A comma separated list of post ID\'s to query.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">
               <input name="post__in" class="alm_element numbers-only" type="text" id="post__in" value="" placeholder="<?php _e('225, 340, 818, etc...', ALM_NAME); ?>">
            </div>
         </div>
         <div class="clear"></div>
         <hr/>
         <div class="section-title">
            <h4><?php _e('Exclude', ALM_NAME); ?></h4>
   		 	<p><?php _e('A comma separated list of post ID\'s to exclude from query.', ALM_NAME); ?><br/>&raquo; <a href="admin.php?page=ajax-load-more-examples#example-exclude">view example</a></p>
   		 </div>
         <div class="wrap">
            <div class="inner">
               <input class="alm_element numbers-only" name="exclude-posts" type="text" id="exclude-posts" value="" placeholder="199, 216, 345, etc...">
            </div>
         </div>
      </div>
   </div>   
   
   <!-- Post Status -->
   <div class="row input post-status" id="alm-post-status">
      <h3 class="heading"><?php _e('Post Status', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Select status of the post.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">               
               <select class="alm_element" name="post-status" id="post-status">
                   <option value="publish" selected="selected"><?php _e('Published', ALM_NAME); ?></option>
                   <option value="future">Future</option>
                   <option value="draft">Draft</option>
                   <option value="pending">Pending</option>
                   <option value="private">Private</option>
                   <option value="trash">Trash</option>
               </select>
            </div>
         </div>
      </div>
   </div>
    
   <!-- Ordering -->
   <div class="row ordering" id="alm-order">
      <h3 class="heading"><?php _e('Ordering', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Sort posts by Order and Orderby parameters.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner half">
               <label class="full"><?php _e('Order', ALM_NAME); ?>:</label>
               <select class="alm_element" name="post-order" id="post-order">
                   <option value="DESC" selected="selected">DESC (default)</option>
                   <option value="ASC">ASC</option>
               </select>
            </div>
            <div class="inner half">
               <label class="full"><?php _e('Order By', ALM_NAME); ?>:</label>
               <select class="alm_element" name="post-orderby" id="post-orderby">
                   <option value="date" selected="selected">Date (default)</option>
                   <option value="title">Title</option>
                   <option value="name">Name (slug)</option>
                   <option value="menu_order">Menu Order</option>
                   <option value="author">Author</option>
                   <option value="ID">ID</option>
                   <option value="comment_count">Comment Count</option>
                   <option value="meta_value_num">meta_value_num</option>                   
               </select>
            </div>
         </div>
      </div>
   </div>   
   
   <!-- Offset -->
   <div class="row input offset" id="alm-offset">
      <h3 class="heading"><?php _e('Offset', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Offset the initial WordPress query by <em>\'n\'</em> number of posts', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner"> 
               <input type="number" class="alm_element numbers-only" name="offset-select" id="offset-select" value="0" step="1" min="0">
            </div>
         </div>
      </div>
   </div>
      
   <!-- Posts Per Page -->
   <div class="row input posts_per_page" id="alm-post-page">
      <h3 class="heading"><?php _e('Posts Per Page', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Select the number of posts to load with each request.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">
               <input type="number" class="alm_element numbers-only" name="display_posts-select" id="display_posts-select" step="1" min="1" value="5">               
            </div>
         </div>
      </div>
   </div>   
         
   <!-- Pause -->
   <div class="row checkbox pause_load" id="alm-pause">
      <h3 class="heading"><?php _e('Pause', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Do <u>NOT</u> load any posts until user the clicks <em>Load More</em> button.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">	               
               <ul>
                   <li>
                    <input class="alm_element" type="radio" name="pause" value="t" id="pause_t">
                    <label for="pause_t"><?php _e('True', ALM_NAME); ?></label>
                   </li>
                   <li>
                    <input class="alm_element" type="radio" name="pause" value="f" id="pause_f" checked>
                    <label for="pause_f"><?php _e('False', ALM_NAME); ?></label>
                   </li>
               </ul>
            </div>
         </div>
      </div>
   </div>    
      
   <!-- Allow Scrolling Load -->
   <div class="row checkbox scroll_load" id="alm-scroll">
      <h3 class="heading"><?php _e('Scrolling', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
            <h4><?php _e('Enable Scrolling', ALM_NAME); ?></h4>
   		 	<p><?php _e('Load more posts as the user scrolls the page.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">	               
               <ul>
                  <li>
                     <input class="alm_element" type="radio" name="scroll" value="t" id="scroll_t" checked>
                     <label for="scroll_t"><?php _e('True', ALM_NAME); ?></label>
                  </li>
                  <li>
                     <input class="alm_element" type="radio" name="scroll" value="f" id="scroll_f">
                     <label for="scroll_f"><?php _e('False', ALM_NAME); ?></label>
                  </li>
               </ul>
            </div>
         </div> 
         <div class="clear"></div>
         <div class="scroll_distance">        
            <div class="clear"></div>
            <hr>
            <div class="section-title">
               <h4><?php _e('Scroll Distance', ALM_NAME); ?></h4>
      		 	<p><?php _e('The distance from the bottom of the screen to trigger the loading of posts while scrolling. (Default = 150)', ALM_NAME); ?></p>
      		 </div>
            <div class="wrap">
               <div class="inner">            
                  <input type="number" class="alm_element numbers-only" name="scroll-distance" id="scroll-distance" step="10" min="0" value="150">  
               </div>
            </div> 
         </div>
         <div class="max_pages">        
            <div class="clear"></div>
            <hr>
            <div class="section-title">
               <h4><?php _e('Maximum Pages', ALM_NAME); ?></h4>
      		 	<p><?php _e('Maximum number of pages to load while scrolling. (0 = unlimited)', ALM_NAME); ?></p>
      		 </div>
            <div class="wrap">
               <div class="inner">            
                  <input type="number" class="alm_element numbers-only" name="max-select" id="max-select" step="1" min="0" value="5">  
               </div>
            </div> 
         </div>
         <div class="pause_override">        
            <div class="clear"></div>
            <hr>
            <div class="section-title">
               <h4><?php _e('Pause Override', ALM_NAME); ?></h4>
      		 	<p><?php _e('Allow scrolling to override the Pause parameter and trigger the loading of posts on scroll.', ALM_NAME); ?></p>
      		 </div>
            <div class="wrap">
               <ul>
                  <li>
                     <input class="alm_element" type="radio" name="pause_override" value="t" id="pause_override_t">
                     <label for="pause_override_t"><?php _e('True', ALM_NAME); ?></label>
                  </li>
                  <li>
                     <input class="alm_element" type="radio" name="pause_override" value="f" id="pause_override_f" checked="checked">
                     <label for="pause_override_f"><?php _e('False', ALM_NAME); ?></label>
                  </li>
               </ul>
            </div> 
         </div>         
      </div>
   </div>    
   
   <!-- Transition -->
   <div class="row input transition" id="alm-transition">
      <h3 class="heading"><?php _e('Transition', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Select a loading transition.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">	               
               <ul>
                   <li>
                    <input class="alm_element" type="radio" name="transition" value="slide" id="transition-slide" checked="checked">
                    <label for="transition-slide"><?php _e('Slide', ALM_NAME); ?></label>
                   </li>
                   <li>
                    <input class="alm_element" type="radio" name="transition" value="fade" id="transition-fade">
                    <label for="transition-fade"><?php _e('Fade', ALM_NAME); ?></label>
                   </li>
                   <li>
                    <input class="alm_element" type="radio" name="transition" value="none" id="transition-none">
                    <label for="transition-none"><?php _e('None', ALM_NAME); ?></label>
                   </li>
               </ul>
            </div>
         </div>
      </div>
   </div>  
         
   <!-- Images Loaded -->
   <div class="row checkbox images_loaded" id="alm-images-loaded">
      <h3 class="heading"><?php _e('Images Loaded', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Wait for all images to load before displaying ajax loaded content.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">	               
               <ul>
                   <li>
                    <input class="alm_element" type="radio" name="images_loaded" value="t" id="images_loaded_t">
                    <label for="images_loaded_t"><?php _e('True', ALM_NAME); ?></label>
                   </li>
                   <li>
                    <input class="alm_element" type="radio" name="images_loaded" value="f" id="images_loaded_f" checked="checked">
                    <label for="images_loaded_f"><?php _e('False', ALM_NAME); ?></label>
                   </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   
   <!-- Destroy After -->
   <div class="row input destroy-after" id="alm-destroy-after">
      <h3 class="heading"><?php _e('Destroy After', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Remove ajax load more functionality after \'<em>n</em>\' number of pages have been loaded.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">            
               <input type="number" class="alm_element numbers-only" name="destroy-after" id="disable-after" step="1" min="0" value="">  
            </div>
         </div>
      </div>
   </div>  
      
   <!-- Button Text -->
   <div class="row input btn-label" id="alm-btn-label">
      <h3 class="heading"><?php _e('Button Label', ALM_NAME); ?></h3>
      <div class="expand-wrap">
         <div class="section-title">
   		 	<p><?php _e('Customize the <em>Load More</em> button label.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">
               <input class="alm_element" name="button-label" type="text" id="button-label" value="<?php _e('Older Posts', ALM_NAME); ?>">
            </div>
         </div>
      </div>
   </div>
   
   <!-- Container Classes -->
   <div class="row input alm-classes" id="alm-classes">
      <h3 class="heading"><?php _e('Container Options', ALM_NAME); ?></h3>
      <div class="expand-wrap">
	      
         <div class="section-title">
	         <h4><?php _e('Container Type', ALM_NAME); ?></h4>
   		 	<p><?php _e('Override the global Container Type that was set on <a href="admin.php?page=ajax-load-more">ALM Settings page</a>.', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">
	            <ul class="container_type">		             
                   <li>
                    <input type="radio" id="type-ul" value="ul" name="alm_container_type" class="alm_element">
                    <label for="type-ul">&lt;ul&gt; &lt;/ul&gt;</label>
                   </li>
                   <li>
                    <input type="radio" id="type-div" value="div" name="alm_container_type" class="alm_element">
                    <label for="type-div">&lt;div&gt; &lt;/div&gt;</label>
                   </li>
               </ul>
            </div>
         </div>
         <div class="clear"></div>
         <hr/>
         <div class="section-title">
	         <h4><?php _e('Container Classes', ALM_NAME); ?></h4>
   		 	<p><?php _e('Add custom CSS classes to the Ajax Load More container. <br/><br/> e.g. portfolio-listing large-12 etc', ALM_NAME); ?></p>
   		 </div>
         <div class="wrap">
            <div class="inner">
               <input class="alm_element" name="container-classes" type="text" id="container-classes" placeholder="portfolio-listing large-12">
            </div>
         </div>
         
      </div>
   </div>
   
   <div class="clear"></div>  
   