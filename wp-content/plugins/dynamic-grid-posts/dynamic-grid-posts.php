<?php

/*
Plugin Name: Dynamic Grid: Posts Feed
Plugin URI: http://www.nikolaydyankovdesign.com/
Version: 1.1.1
Author: Nikolay Dyankov
Description: Posts feed in a grid!
*/

if (!class_exists('GridPosts')) {
	class GridPosts {
		function __construct() {
			$this->admin_options_name = 'grid-admin-options';
			$this->default_settings = array(
				'width' => '',
				'auto_width' => true,
				'height' => 400,
				'min_rows' => 2,
				'max_rows' => 3,
				'random_heights' => true,
				'padding' => 1,
				'featured_image' => 1,
				'interval' => 2000,
				'speed' => 800,
				'easing' => 'easeOutQuart',
				'cols' => '3',
				'show_overlay' => false
			);
			$this->pagename = 'grid_posts';
			$this->newpagename = 'new_grid_posts';
		}
		function get_admin_options() {
			// delete_option($this->admin_options_name);
			
			// TESTING
			// $admin_options = array(
			// 	"general" => array(),
			// 	"multis" => array(
			// 		"124324" => array(
			//			"new" => true,
			// 			"id" => '124324',
			// 			"title" => 'Multi 1',
			// 			"shortcode" => 'multi-1',
			// 			"content" => 'Multi 1 Content',
			// 			"settings" => array(
			// 				"setting" => true
			// 				)
			// 			),
			// 		"6546234" => array(
			// 			"id" => '6546234',
			// 			"title" => 'Multi 2',
			// 			"shortcode" => 'multi-2',
			// 			"content" => 'Multi 2 Content',
			// 			"settings" => array(
			// 				"setting" => false
			// 				)
			// 			)
			// 		)						
			// 	);
			
			$admin_options = array(
				"general" => array(),
				"grids" => array()
			);
			
			$loaded_options = get_option($this->admin_options_name);

			if (!empty($loaded_options)) {
				foreach ($loaded_options as $key => $option) {
					$admin_options[$key] = $option;
				}
			}
			update_option($this->admin_options_name, $admin_options);
			return $admin_options;
		}
		function init_pages() {
			add_menu_page(
				"Dynamic Grid: Posts Feed",
				"Dynamic Grid: Posts Feed",
				"manage_options",
				$this->pagename,
				array($this, 'print_options_page')
			);
			
			add_submenu_page(
				$this->pagename,
				"Add New Feed",
				"Add New",
				"manage_options",
				$this->newpagename,
				array($this, 'print_instance_options')
			);
		}
		
		function admin_includes() {
			wp_register_script('grid-js', plugins_url('/js/dynamic.grid.posts.js', __FILE__), false, '1.0', true);
			wp_enqueue_script('grid-js');
			wp_register_style('grid-css', plugins_url('/css/dynamic.grid.css', __FILE__), false, '1.0', false);
			wp_enqueue_style('grid-css');
			
			wp_enqueue_script('grid-admin-js', plugins_url('/js/admin.js', __FILE__), false, '1.0', false);
			wp_enqueue_style('grid-admin-css', plugins_url('/css/admin.css', __FILE__), false, '1.0', false);
		}
		function user_includes() {
			wp_enqueue_script('jquery');
			wp_register_script('grid-posts-js', plugins_url('/js/dynamic.grid.posts.js', __FILE__), false, '1.0', true);
			wp_enqueue_script('grid-posts-js');
			wp_register_style('grid-posts-css', plugins_url('/css/dynamic.grid.css', __FILE__), false, '1.0', false);
			wp_enqueue_style('grid-posts-css');
		}
		function call_plugins() {
			$options = $this->get_admin_options();

			?>
			<script>
				(function($, undefined) {
					$(document).ready(function() {
						
						<?php foreach ($options['grids'] as $grid) {
							$height = $grid['settings']['height'];
							$cols = $grid['settings']['cols'];
							$min_rows = $grid['settings']['min_rows'];
							$max_rows = $grid['settings']['max_rows'];
							$padding = $grid['settings']['padding'];
							$interval = $grid['settings']['interval'];
							$speed = $grid['settings']['speed'];
							$easing = "'" . $grid['settings']['easing'] . "'";
							
							if ($grid['settings']['auto_width'] == 1) {
								$width = 'undefined';
							} else {
								$width = $grid['settings']['width'];
							}
							
							if ($grid['settings']['random_heights'] == 1) {
								$random_heights = 'true';
							} else {
								$random_heights = 'false';
							}
							
							if ($grid['settings']['show_overlay'] == 1) {
								$show_overlay = 'true';
							} else {
								$show_overlay = 'false';
							}

							?>
						
						
							$('#dynamic-grid-posts-feed-<?php echo $grid['id']; ?>').dynamicGrid({
								width : <?php echo $width; ?>,
								height : <?php echo $height; ?>,
								cols : <?php echo $cols; ?>,
								min_rows : <?php echo $min_rows; ?>,
								max_rows : <?php echo $max_rows; ?>,
								random_heights : <?php echo $random_heights; ?>,
								padding: <?php echo $padding; ?>,
								interval : <?php echo $interval; ?>,
								speed : <?php echo $speed; ?>,
								easing : <?php echo $easing; ?>,
								show_overlay : <?php echo $show_overlay; ?>
							});
						
						<?php } ?>
					});
				})(jQuery);
			</script>
			
			<?php
		}
		
		function print_options_page() {
			$options = $this->get_admin_options();
			
			if (isset($_GET['action'])) {
				if ($_GET['action'] == 'edit') {
					$this->print_instance_options();
				}
				if ($_GET['action'] == 'delete') {
					$this->delete_instance();
					$this->print_main_options();
				}
			} else {
				$this->print_main_options();
			}
		}
		function print_main_options() {
			$options = $this->get_admin_options();
			
			?>
			
			<div class="as">
				<header>
					<img src="<?php echo plugins_url('images/admin/thumb.png', __FILE__); ?>">
					<h2>Dynamic Grid:</h2>
					<h1>Posts Feed</h1>
				</header>
				
				<div class="as-c">
					
					<?php if (count($options['grids']) == 0) { ?>
						<div class="greetings">Hey! Seems like you haven't created any grids yet. Start by clicking the big green button below!</div>
					<?php } else { ?>
					<table class="ndd-clean-table ndd-yellow-rows">
						<thead>
							<tr>
								<th class="ndd-column-name">Grid Name</th>
								<th class="ndd-column-shortcode">Shortcode</th>
								<th class="ndd-column-delete">Delete</th>
							</tr>
						</thead>
						<tbody>
							
							<?php 
								foreach ($options['grids'] as $grid) {
									$yellow_class = '';
									if ($grid['new']) {
										$yellow_class = 'ndd-new-row';
									}
									$options['grids'][$grid['id']]['new'] = false;
									update_option($this->admin_options_name, $options);
							?>
							
							<tr class="<?php echo $yellow_class; ?>">
								<td class="ndd-column-name"><a href="?page=<?php echo $this->pagename; ?>&id=<?php echo $grid['id']; ?>&action=edit"><?php echo $grid['title']; ?>&nbsp;</a></td>
								<td class="ndd-column-shortcode"><a href="?page=<?php echo $this->pagename; ?>&id=<?php echo $grid['id']; ?>&action=edit">[grid name="<?php echo $grid['shortcode']; ?>"]</a></td>
								<td class="ndd-column-delete"><div class="ndd-delete-cell-wrap"><a href="?page=<?php echo $this->pagename; ?>&id=<?php echo $grid['id']; ?>&action=delete" class="ndd-delete-row"></a></div></td>
							</tr>
							
							<!-- END FOREACH -->
							<?php } ?>
					
							
						</tbody>
					</table>
					
					<!-- END ELSE -->
					<?php } ?>
					
					<a href="?page=<?php echo $this->newpagename; ?>" class="ndd-button-green-regular"><span class="icon-plus"></span> New Grid</a>
				</div>
				
				<footer>
					<p class="footer-copy">Thank you for purchasing my product. If you like what I do and you'd like to support my work, the best way to do it is by rating my items on CodeCanyon. You can do that by going at <a href="http://codecanyon.net/">CodeCanyon</a> and clicking on the Downloads tab. Find my product there and click on the stars to give it a rating. Thank you!</p>
					<ul>
						<li><span>Designed and developed by</span><a href="http://www.nikolaydyankovdesign.com"><img src="<?php echo plugins_url('images/admin/my-logo.png', __FILE__); ?>"></a></li>
						<li><span>Available exclusively at</span><a href="http://www.codecanyon.com/?ref=nickys"><img src="<?php echo plugins_url('images/admin/codecanyon-logo.png', __FILE__); ?>"></a></li>
						<li><span>Customer Support</span><a href="http://support.nikolaydyankovdesign.com"><img src="<?php echo plugins_url('images/admin/support.png', __FILE__); ?>"></a></li>
					</ul>
				</footer>
			</div>
			
			<?php
			
			
			$this->admin_includes();
		}
		function print_instance_options() {
			if (isset($_POST['save_options'])) {
				$this->save_options();
			}

			$options = $this->get_admin_options();
			
			// Change the title of the page if action is "New" or "Edit"
			
			if ($_GET['page'] == $this->newpagename) {
				$pagetitle = 'New Grid';
				$submit_name = 'Create Grid';
				$title = '';
				$shortcode = '';
				$id = rand(0, 10000);
				
				$settings = $this->default_settings;
			} else {
				$submit_name = 'Save Changes';
				$id = $_GET['id'];
				$grid = $options['grids'][$id];
				$pagetitle = 'Edit Grid';
				$title = $grid['title'];
				$shortcode = $grid['shortcode'];
				
				$settings = $grid['settings'];
			}
			
			$uri = $_SERVER["REQUEST_URI"];
			$uri_ar = explode('?', $uri);

			$uri = $uri_ar[0] . '?page=' . $this->pagename . '&id=' . $id . '&action=edit';
						
			?>
			<form action="<?php echo $uri; ?>" method="post">
			<div class="as">
				
				<header class="ndd-subpage-header">
					<a href="?page=<?php echo $this->pagename; ?>" class="ndd-back-link">Back</a>
					<h1><?php echo $pagetitle; ?></h1>
					<div class="ndd-button-submit-wrap">
						
						<!-- OUTPUT FIELDS -->
						
						<input type="text" class="ndd-invisible" id="query-mode" name="query-mode">
						<input type="text" class="ndd-invisible" id="query-post-ids" name="query-post-ids">
						
						<input type="text" class="ndd-invisible" id="query-tax-name" name="query-tax-name">
						<input type="text" class="ndd-invisible" id="query-tax-terms" name="query-tax-terms">
						
						<input type="text" class="ndd-invisible" id="query-number-posts" name="query-number-posts">
						
						<!--  -->
						
						<input class="ndd-button-submit" name="save_options" type="submit" class="button-primary" id="save_options" value="<?php echo $submit_name; ?>">
					</div>
					<?php if (isset($_POST['save_options'])) { ?>
						<div class="updated"><p><strong> <?php echo _e("Settings Updated!", "CommentWordFilter"); ?> </strong></p></div>
					<?php } ?>
				</header>
				
				
				
				<div class="as-c">
					
					<div class="ndd-tab-group">
						<ul>
							<li class="active">General</li>
							<li>Content</li>
							<li>Settings</li>
							<li class="preview-tab">Preview</li>
						</ul>
						
						
						<div class="ndd-tab active">
							<?php 
								if ($pagetitle == 'New Grid') {
									echo '<div class="greetings">Start by filling in the title and shortcode, then head over to the Content and Settings tabs above to further setup your grid.</div>';
								}
							?>
							<table class="form-table ndd-yellow-rows">
								<tr>
									<td>
									<h2><label for="title">Title</label></h2>
									<input type="text" name="title" id="title" value="<?php echo $title; ?>" class="ndd-large-input">
									<div class="ndd-form-help">The title is used only for convenience in the admin panel. It will not be visible for the page visitor.</div>
									</td>
								</tr>
								<tr>
									<td>
									<h2><label for="shortcode">Shortcode</label></h2>
									<input type="text" name="shortcode" id="shortcode" value="<?php echo $shortcode; ?>" class="ndd-large-input">
									<div class="ndd-form-help">This is the shortcode that you will use to include this grid in a page or a template.</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="ndd-tab">
							<div id="select-feed-type" class="ndd-content-step ndd-content-step-1 active">
								<h2>1. Which posts to show?</h2>
								<div class="ndd-radio-group-2-cols ndd-radio-group">
									<ul>
										<li id="most-recent-posts" <?php if ($settings['query-mode'] == 'tax') echo 'class="active"'; ?>><span>Most Recent Posts</span></li>
										<li id="selected-posts" <?php if ($settings['query-mode'] == 'posts') echo 'class="active"'; ?>><span>Selected Posts</span></li>
									</ul>
								</div>
								<div class="ndd-form-help">"Most Recent Posts" will automatically pull posts from the database based on a specific criteria -
								category, tag, or other.</div>
							</div>
							
							<!-- Select each post individually -->
							<div id="select-posts" class="ndd-content-step ndd-content-step-2  <?php if ($settings['query-mode'] == 'posts') echo 'active'; ?>">
								<h2>2. Which Posts?</h2>
								<div class="ndd-radio-group-cloud ndd-radio-group ndd-select-multiple">
									<ul>
										<?php
											query_posts(array(
												"posts_per_page" => -1
											));
											if (have_posts()) {
												while (have_posts()) {
													the_post();
													
													if ($settings['query-mode'] == 'posts') {
														$class = '';

														if (array_search(get_the_id(), $grid['settings']['query']['post__in']) !== false) {
															$class = ' class="active"';
															$post_is_selected = true;
														}
													}
									
													
													echo '<li data-id="' . get_the_id() . '"' . $class . '>' . get_the_title() . '</li>';
												}
											}
										?>
									</ul>
									<div class="clear"></div>
								</div>
								<div class="ndd-form-help">Hold SHIFT to select multiple posts.</div>
							</div>
							
							<div id="select-posts-number-posts" class="ndd-content-step ndd-content-step-3 <?php  if ($settings['query-mode'] == 'posts' && $post_is_selected) echo 'active'; ?>">
								<h2>3. How many posts?</h2>
								<div class="ndd-radio-group-4-cols ndd-radio-group">
									<ul>
										<li <?php if ($settings['query']['posts_per_page'] == 5) echo 'class="active"'; ?>>5</li>
										<li <?php if ($settings['query']['posts_per_page'] == 10) echo 'class="active"'; ?>>10</li>
										<li <?php if ($settings['query']['posts_per_page'] == 20) echo 'class="active"'; ?>>20</li>
										<li <?php if ($settings['query']['posts_per_page'] == 50) echo 'class="active"'; ?>>50</li>
									</ul>
								</div>
								<div class="ndd-form-help">This is the total number of posts that will be in the grid.</div>
							</div>
							
							<!-- Select posts by category, tag or custom taxonomy -->
							<div id="select-feed-source" class="ndd-content-step ndd-content-step-2 		<?php if ($settings['query-mode'] == 'tax') echo 'active'; ?>">
								<h2>2. Select by Category, tag, or custom taxonomy?</h2>
								<div class="ndd-radio-group-3-cols ndd-radio-group">
									<ul>
										<li id="select-category-button" <?php if ($settings['query-mode'] == 'tax' && $settings['query']['tax_name'] == 'category') echo 'class="active"'; ?>>Category</li>
										<li id="select-tag-button" <?php if ($settings['query-mode'] == 'tax' && $settings['query']['tax_name'] == 'post_tag') echo 'class="active"'; ?>>Tag</li>
										<li id="select-custom-tax-button" <?php if ($settings['query-mode'] == 'tax' && $settings['query']['tax_name'] != 'post_tag' && $settings['query']['tax_name'] != 'category') echo 'class="active"'; ?>>Custom Taxonomy</li>
									</ul>
								</div>
								<div class="ndd-form-help">Select "Other" if you want to get posts by a custom taxonomy.</div>
							</div>
							
							<div id="select-category" class="ndd-content-step ndd-content-step-3  			<?php if ($settings['query-mode'] == 'tax' && $settings['query']['tax_name'] == 'category'	) echo 'active'; ?>">
								<h2>3. Which Categories?</h2>
								<div class="ndd-radio-group-cloud ndd-radio-group ndd-select-multiple">
									<ul>
										<?php
											$cats = get_categories();

											foreach ($cats as $cat) {
												
												if ($settings['query-mode'] == 'tax') {
													$class = '';

													if (array_search($cat->cat_ID, $grid['settings']['query']['tax_terms']) !== false) {
														$class = ' class="active"';
														$cat_is_selected = true;
													}
												}
												
												echo '<li'. $class .' data-id="' . $cat->cat_ID . '">' . $cat->name . '</li>';
											}
										?>
									</ul>
									<div class="clear"></div>
								</div>
								<div class="ndd-form-help">Hold SHIFT to select multiple categories.</div>
							</div>
							
							<div id="select-tag" class="ndd-content-step ndd-content-step-3  				<?php if ($settings['query-mode'] == 'tax' && $settings['query']['tax_name'] == 'post_tag'	) echo 'active'; ?>">
								<h2>3. Which Tags?</h2>
								<div class="ndd-radio-group-cloud ndd-radio-group ndd-select-multiple">
									<ul>
										<?php
											$tags = get_tags();

											foreach ($tags as $tag) {
												
												if ($settings['query-mode'] == 'tax') {
													$class = '';
													if (array_search($tag->name, $grid['settings']['query']['tax_terms']) !== false) {
														$class = ' class="active"';
														$tag_is_selected = true;
													}
												}
												
												echo '<li'. $class .' data-name="' . $tag->name . '">' . $tag->name . '</li>';
											}
										?>
										
										<?php
											// $tags = get_tags();
											// foreach ($tags as $tag) {
											// 	echo '<li>' . $tag->name . '</li>';
											// }
										?>
									</ul>
									<div class="clear"></div>
								</div>
								<div class="ndd-form-help">Hold SHIFT to select multiple tags.</div>
							</div>
							
							<div id="select-custom-tax" class="ndd-content-step ndd-content-step-3  		<?php if ($settings['query-mode'] == 'tax' && $settings['query']['tax_name'] != 'post_tag' 	&& $settings['query']['tax_name'] != 'category') echo 'active'; ?>">
								<h2>3. Select Custom Taxonomy</h2>
								<div class="ndd-radio-group-cloud ndd-radio-group">
									<ul>
										<?php 
											$taxonomies = get_taxonomies('', 'names'); 
											foreach ($taxonomies as $taxonomy) {
												if ($taxonomy == 'category') continue;
												if ($taxonomy == 'post_tag') continue;
												if ($settings['query-mode'] == 'tax') {
													$class = '';
													if ($taxonomy == $grid['settings']['query']['tax_name']) {
														$class = ' class="active"';
														$tax_is_selected = true;
													}
												}
												
												echo '<li id="taxonomy-button-' . $taxonomy . '"' . $class . '>'. $taxonomy. '</li>';
											}
										?>
									</ul>
									<div class="clear"></div>
								</div>
								<div class="ndd-form-help">In this step you select custom taxonomies. <br />What is a taxonomy? A taxonomy is a way to group posts together. You can group them by category or tags for example. So "category" and "tag" are taxonomies. And "custom" taxonomies means that they have been added by the theme developer.</div>
							</div>
							
							<div id="select-custom-terms" class="ndd-content-step ndd-content-step-4 		<?php if ($settings['query-mode'] == 'tax' && $tax_is_selected 							&& $settings['query']['tax_name'] != 'category' 												&& $settings['query']['tax_name'] != 'post_tag') echo 'active'; ?>">
								<h2>4. Select Taxonomy Term</h2>
								<div class="ndd-radio-group-cloud ndd-radio-group ndd-select-multiple">
									
									<?php 
										$taxonomies = get_taxonomies('', 'names');
																				
										foreach ($taxonomies as $taxonomy) {
											$active = '';
											
											if ($taxonomy == $settings['query']['tax_name']) {
												$active = ' active';
											}
											
											echo '<ul class="taxonomy-terms-list' . $active . '" id="taxonomy-terms-list-' . $taxonomy . '">';
											$terms = get_terms($taxonomy);
											
											foreach ($terms as $term) {
												if ($settings['query-mode'] == 'tax') {
													$class = '';
													if (array_search($term->slug, $grid['settings']['query']['tax_terms']) !== false) {
														$class = ' class="active"';
														$term_is_selected = true;
													}
												}
											
												echo '<li data-id="' . $term->slug . '"' . $class . '>'. $term->name. '</li>';
											}
											
											echo '</ul>';
										}
									?>
									
									<div class="clear"></div>
								</div>
								<div class="ndd-form-help">Hold SHIFT to select multiple terms.</div>
							</div>

							<div id="select-custom-number-posts" class="ndd-content-step ndd-content-step-5 <?php if ($settings['query-mode'] == 'tax' && $term_is_selected 						&& $settings['query']['tax_name'] != 'category' 												&& $settings['query']['tax_name'] != 'post_tag') echo 'active'; ?>">
								<h2>5. How many posts?</h2>
								<div class="ndd-radio-group-4-cols ndd-radio-group">
									<ul>
										<li <?php if ($settings['query']['posts_per_page'] == 5) echo 'class="active"'; ?>>5</li>
										<li <?php if ($settings['query']['posts_per_page'] == 10) echo 'class="active"'; ?>>10</li>
										<li <?php if ($settings['query']['posts_per_page'] == 20) echo 'class="active"'; ?>>20</li>
										<li <?php if ($settings['query']['posts_per_page'] == 50) echo 'class="active"'; ?>>50</li>
									</ul>
								</div>
								<div class="ndd-form-help">This is the total number of posts that will be in the grid.</div>
							</div>
							
							<div id="select-number-posts" class="ndd-content-step ndd-content-step-4 		<?php if ($settings['query-mode'] == 'tax' && ($tag_is_selected || $cat_is_selected) 	&& ($settings['query']['tax_name'] == 'category' || $settings['query']['tax_name'] == 'post_tag')	) echo 'active'; ?>">
								<h2>4. How many posts?</h2>
								<div class="ndd-radio-group-4-cols ndd-radio-group">
									<ul>
										<li <?php if ($settings['query']['posts_per_page'] == 5) echo 'class="active"'; ?>>5</li>
										<li <?php if ($settings['query']['posts_per_page'] == 10) echo 'class="active"'; ?>>10</li>
										<li <?php if ($settings['query']['posts_per_page'] == 20) echo 'class="active"'; ?>>20</li>
										<li <?php if ($settings['query']['posts_per_page'] == 50) echo 'class="active"'; ?>>50</li>
									</ul>
								</div>
								<div class="ndd-form-help">This is the total number of posts that will be in the grid.</div>
							</div>
						</div>
						<div class="ndd-tab">
							<table class="form-table ndd-yellow-rows">
								<tr class="header-row">
									<td><h2>Dimentions</h2></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="width">Width</label></th>
									<td>
										<input type="text" class="regular-text" name="width" id="width" value="<?php echo $settings['width']; ?>" <?php if ($settings['auto_width'] == true) echo 'disabled'; ?>>
										<input type="checkbox" class="regular-text" name="auto_width" id="auto_width" <?php if ($settings['auto_width'] == true) echo 'checked'; ?> style="display: inline-block; width: auto;">
										<label for="auto_width">Fluid</label>
										<div class="ndd-form-help">The total width of the grid in pixels. Check "Fluid" for fluid width.</div>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="height">Height</label></th>
									<td><input type="text" class="regular-text" name="height" id="height" value="<?php echo $settings['height']; ?>"><div class="ndd-form-help">The total height of the grid in pixels. This value cannot be fluid.</div></td>
								</tr>
								<tr class="header-row">
									<td><h2>Layout</h2></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="cols">Columns</label></th>
									<td><input type="text" class="regular-text" name="cols" id="cols" value="<?php echo $settings['cols']; ?>"><div class="ndd-form-help">The total number of columns that the grid will have.</div></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="min_rows">Minumum # of Rows</label></th>
									<td><input type="text" class="regular-text" name="min_rows" id="min_rows" value="<?php echo $settings['min_rows']; ?>"><div class="ndd-form-help">The minimum number of visible cells for each column. If you need to have a fixed number of rows, match this value with the "Maximum # of Rows" value.</div></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="max_rows">Maximum # of Rows</label></th>
									<td><input type="text" class="regular-text" name="max_rows" id="max_rows" value="<?php echo $settings['max_rows']; ?>"><div class="ndd-form-help">The maximum number of visible cells for each column.</div></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="random_heights">Random Heights</label></th>
									<td><input type="checkbox" class="regular-text" name="random_heights" id="random_heights" <?php if ($settings['random_heights']) echo 'checked'; ?>><div class="ndd-form-help">If checked, the cells in the grid will have random heights, but the cell count per column will be preserved.<br />Important: Turning it off may cause clipping of the text in the cells! I highly recommend that you leave this setting on, unless you absolutely need to have fixed heights.</div></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="padding">Padding</label></th>
									<td><input type="text" class="regular-text" name="padding" id="padding" value="<?php echo $settings['padding']; ?>"><div class="ndd-form-help">The distance in pixels (padding) between the cells.</div></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="featured_image">Featured Image</label></th>
									<td>
										<select name="featured_image" id="featured_image">
											<option value="true" <?php if ($settings['featured_image'] === 1) echo 'selected'; ?>>Use</option>
											<option value="false" <?php if ($settings['featured_image'] === 0) echo 'selected'; ?>>Don't use</option>
											<option value="random" <?php if ($settings['featured_image'] === 'random') echo 'selected'; ?>>Random</option>
										</select>
										<div class="ndd-form-help">If set to "Use" or "Random", it will get the first image from the post and display it in the cell along with the title. No excerpt from the post content will be shown, unless the user hovers the mouse over the cell.<br />If set to "Don't Use", only the title and content excerpt will be shown in the cell.</div>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="show_overlay">Show Text Overlay</label></th>
									<td><input type="checkbox" class="regular-text" name="show_overlay" id="show_overlay" <?php if ($settings['show_overlay']) echo 'checked'; ?>><div class="ndd-form-help">"Text overlay" is the white gradient that appears on the bottom side of the element, holding the post excerpt (text). The algorithm that sets the heights of the cells is pretty well tweaked, but unfortunately it's not perfect and some text clipping might occur. Enable this feature to disguise the clipping, or leave it off if you don't need it.</div></td>
								</tr>
								<tr class="header-row">
									<td><h2>Animation</h2></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="interval">Interval</label></th>
									<td><input type="text" class="regular-text" name="interval" id="interval" value="<?php echo $settings['interval']; ?>"><div class="ndd-form-help">The delay between each sliding of a column (in milliseconds).</div></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="speed">Speed</label></th>
									<td><input type="text" class="regular-text" name="speed" id="speed" value="<?php echo $settings['speed']; ?>"><div class="ndd-form-help">The time it takes a column to slide up or down (in milliseconds).</div></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="easing">Easing Effect</label></th>
									<td>
										<select name="easing" id="easing">
											<option <?php if ($settings['easing'] == 'jswing') echo 'selected'; ?> value="jswing">jswing</option>
											<option <?php if ($settings['easing'] == 'def') echo 'selected'; ?> value="def">def</option>
											<option <?php if ($settings['easing'] == 'easeInQuad') echo 'selected'; ?> value="easeInQuad">easeInQuad</option>
											<option <?php if ($settings['easing'] == 'easeOutQuad') echo 'selected'; ?> value="easeOutQuad">easeOutQuad</option>
											<option <?php if ($settings['easing'] == 'easeInOutQuad') echo 'selected'; ?> value="easeInOutQuad">easeInOutQuad</option>
											<option <?php if ($settings['easing'] == 'easeInCubic') echo 'selected'; ?> value="easeInCubic">easeInCubic</option>
											<option <?php if ($settings['easing'] == 'easeOutCubic') echo 'selected'; ?> value="easeOutCubic">easeOutCubic</option>
											<option <?php if ($settings['easing'] == 'easeInOutCubic') echo 'selected'; ?> value="easeInOutCubic">easeInOutCubic</option>
											<option <?php if ($settings['easing'] == 'easeInQuart') echo 'selected'; ?> value="easeInQuart">easeInQuart</option>
											<option <?php if ($settings['easing'] == 'easeOutQuart') echo 'selected'; ?> value="easeOutQuart">easeOutQuart</option>
											<option <?php if ($settings['easing'] == 'easeInOutQuart') echo 'selected'; ?> value="easeInOutQuart">easeInOutQuart</option>
											<option <?php if ($settings['easing'] == 'easeInQuint') echo 'selected'; ?> value="easeInQuint">easeInQuint</option>
											<option <?php if ($settings['easing'] == 'easeOutQuint') echo 'selected'; ?> value="easeOutQuint">easeOutQuint</option>
											<option <?php if ($settings['easing'] == 'easeInOutQuint') echo 'selected'; ?> value="easeInOutQuint">easeInOutQuint</option>
											<option <?php if ($settings['easing'] == 'easeInSine') echo 'selected'; ?> value="easeInSine">easeInSine</option>
											<option <?php if ($settings['easing'] == 'easeOutSine') echo 'selected'; ?> value="easeOutSine">easeOutSine</option>
											<option <?php if ($settings['easing'] == 'easeInOutSine') echo 'selected'; ?> value="easeInOutSine">easeInOutSine</option>
											<option <?php if ($settings['easing'] == 'easeInExpo') echo 'selected'; ?> value="easeInExpo">easeInExpo</option>
											<option <?php if ($settings['easing'] == 'easeOutExpo') echo 'selected'; ?> value="easeOutExpo">easeOutExpo</option>
											<option <?php if ($settings['easing'] == 'easeInOutExpo') echo 'selected'; ?> value="easeInOutExpo">easeInOutExpo</option>
											<option <?php if ($settings['easing'] == 'easeInCirc') echo 'selected'; ?> value="easeInCirc">easeInCirc</option>
											<option <?php if ($settings['easing'] == 'easeOutCirc') echo 'selected'; ?> value="easeOutCirc">easeOutCirc</option>
											<option <?php if ($settings['easing'] == 'easeInOutCirc') echo 'selected'; ?> value="easeInOutCirc">easeInOutCirc</option>
											<option <?php if ($settings['easing'] == 'easeInElastic') echo 'selected'; ?> value="easeInElastic">easeInElastic</option>
											<option <?php if ($settings['easing'] == 'easeOutElastic') echo 'selected'; ?> value="easeOutElastic">easeOutElastic</option>
											<option <?php if ($settings['easing'] == 'easeInOutElastic') echo 'selected'; ?> value="easeInOutElastic">easeInOutElastic</option>
											<option <?php if ($settings['easing'] == 'easeInBack') echo 'selected'; ?> value="easeInBack">easeInBack</option>
											<option <?php if ($settings['easing'] == 'easeOutBack') echo 'selected'; ?> value="easeOutBack">easeOutBack</option>
											<option <?php if ($settings['easing'] == 'easeInOutBack') echo 'selected'; ?> value="easeInOutBack">easeInOutBack</option>
											<option <?php if ($settings['easing'] == 'easeInBounce') echo 'selected'; ?> value="easeInBounce">easeInBounce</option>
											<option <?php if ($settings['easing'] == 'easeOutBounce') echo 'selected'; ?> value="easeOutBounce">easeOutBounce</option>
											<option <?php if ($settings['easing'] == 'easeInOutBounce') echo 'selected'; ?> value="easeInOutBounce">easeInOutBounce</option>
										</select>
										<div class="ndd-form-help">This is sort of the "behavior" of the animation. Different effects produce very different results, the best way to find what you're looking for is to experiment!</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="ndd-tab preload-active preview-tab-c">
							
							<?php do_shortcode('[grid name=' . $grid['shortcode'] . ']'); ?>
							
						</div>
					</div>
					
				</div>
				
				<footer>
					<p class="footer-copy">Hey! Thank you for purchasing my product. If you like what I do and you'd like to support my work, the best way to do it is by rating my items on CodeCanyon. You can do that by going at <a href="http://codecanyon.net/">CodeCanyon</a> and clicking on the Downloads tab. Find my product there and click on the stars to give it a rating. Thank you!</p>
					<ul>
						<li><span>Designed and developed by</span><a href="http://www.nikolaydyankovdesign.com"><img src="<?php echo plugins_url('images/admin/my-logo.png', __FILE__); ?>"></a></li>
						<li><span>Available exclusively at</span><a href="http://www.codecanyon.com/?ref=nickys"><img src="<?php echo plugins_url('images/admin/codecanyon-logo.png', __FILE__); ?>"></a></li>
						<li><span>Customer Support</span><a href="http://support.nikolaydyankovdesign.com"><img src="<?php echo plugins_url('images/admin/support.png', __FILE__); ?>"></a></li>
					</ul>
				</footer>
				
				</form>
			</div>
			
			<?php
			$this->admin_includes();
			$this->call_plugins();
		}

		function save_options() {
			$options = $this->get_admin_options();
			$id = $_GET['id'];

			if (!isset($_GET['id'])) {
				$id = str_replace(' ', '-', strtolower($_POST['title']));
				$grid = array();
			} else {
				$grid = $options['grids'][$id];
			}
			
			if (!isset($grid['id'])) {
				$grid['new'] = true;
			}
			
			// General			
			$grid['id'] = $id;
			$grid['title'] = $_POST['title'];
			$grid['shortcode'] = $_POST['shortcode'];
			
			// =========== Options
			if (isset($_POST['width'])) {
				$grid['settings']['width'] = $_POST['width'];
			}
			if (isset($_POST['height'])) {
				$grid['settings']['height'] = $_POST['height'];
			}
			if (isset($_POST['cols'])) {
				$grid['settings']['cols'] = $_POST['cols'];
			}
			if (isset($_POST['min_rows'])) {
				$grid['settings']['min_rows'] = $_POST['min_rows'];
			}
			if (isset($_POST['max_rows'])) {
				$grid['settings']['max_rows'] = $_POST['max_rows'];
			}
			if (isset($_POST['padding'])) {
				$grid['settings']['padding'] = $_POST['padding'];
			}
			if (isset($_POST['interval'])) {
				$grid['settings']['interval'] = $_POST['interval'];
			}
			if (isset($_POST['speed'])) {
				$grid['settings']['speed'] = $_POST['speed'];
			}
			if (isset($_POST['easing'])) {
				$grid['settings']['easing'] = $_POST['easing'];
			}
			if (isset($_POST['featured_image'])) {
				if ($_POST['featured_image'] == 'true') {
					$grid['settings']['featured_image'] = 1;
				}
				if ($_POST['featured_image'] == 'false') {
					$grid['settings']['featured_image'] = 0;
				}
				if ($_POST['featured_image'] == 'random') {
					$grid['settings']['featured_image'] = 'random';
				}
			}
			if (isset($_POST['auto_width'])) {
				$grid['settings']['auto_width'] = 1;
			} else {
				$grid['settings']['auto_width'] = 0;
			}
			if (isset($_POST['random_heights'])) {
				$grid['settings']['random_heights'] = 1;
			} else {
				$grid['settings']['random_heights'] = 0;
			}
			if (isset($_POST['show_overlay'])) {
				$grid['settings']['show_overlay'] = 1;
			} else {
				$grid['settings']['show_overlay'] = 0;
			}
			
			
			//  =========== Query Options
			
			if (isset($_POST['query-mode'])) {
				$grid['settings']['query-mode'] = $_POST['query-mode'];
			}
			$grid['settings']['query'] = array();
			
			// Number of posts
			if (isset($_POST['query-number-posts'])) {
				$grid['settings']['query']['posts_per_page'] = $_POST['query-number-posts'];
			}
		
			// Posts mode
			if ($grid['settings']['query-mode'] == 'posts') {
				$grid['settings']['query']['post__in'] = explode(' ', $_POST['query-post-ids']);
			
				// trim the last element
				if ($grid['settings']['query']['post__in'][count($grid['settings']['query']['post__in']) - 1] == '') {
					unset($grid['settings']['query']['post__in'][count($grid['settings']['query']['post__in']) - 1]);
				}
			}
			
			// Taxonomy mode
			
			if ($grid['settings']['query-mode'] == 'tax') {
				$grid['settings']['query']['tax_name'] = $_POST['query-tax-name'];
				
				$grid['settings']['query']['tax_terms'] = explode('%', $_POST['query-tax-terms']);
			
				// trim the last element
				if (end($grid['settings']['query']['tax_terms']) == NULL) {
					unset($grid['settings']['query']['tax_terms'][count($grid['settings']['query']['tax_terms']) - 1]);
				}
			}
			
			$this->do_query($grid['settings']['query'], $grid['settings']['query-mode']);
			$grid['content'] = $this->get_html_content($grid['id'], $grid['settings']);
			
			$options['grids'][$id] = $grid;
			update_option($this->admin_options_name, $options);
		}
		function delete_instance() {
			$options = $this->get_admin_options();
			unset($options['grids'][$_GET['id']]);
			update_option($this->admin_options_name, $options);
		}
	
		function shortcodes() {
			$options = $this->get_admin_options();
			add_shortcode('grid', array($this, 'print_shortcode'));
		}
		function print_shortcode($atts) {
			$options = $this->get_admin_options();
			$shortcode = $atts['name'];
			
			foreach($options['grids'] as $grid) {
				if ($grid['shortcode'] == $shortcode) {
					$result = $grid;
				}
			}
			
			if ($_GET['page'] == 'grid_posts') {			
				echo $result['content'];
			} else {
				return $result['content'];
			}
		}
		function do_query($args, $mode) {
			// Do query
			if ($mode == 'posts') {
				// Posts mode
				query_posts(array(
					'posts_per_page' => $args['posts_per_page'],
					'post__in' => $args['post__in']
				));
			} else {
				if ($args['tax_name'] == 'category') {
					
					// Category mode
					$cats = '';
					
					for ($i=0; $i<count($args['tax_terms']); $i++) {
						$cats .= $args['tax_terms'][$i] . ',';
					}
					
					$cats = substr($cats, 0, strlen($cats) - 1);
					query_posts('posts_per_page=' . $args['posts_per_page'] . '&cat=' . $cats);
				
				} else if ($args['tax_name'] == 'post_tag') {
				
					// Tag mode
					$tags = '';
					
					for ($i=0; $i<count($args['tax_terms']); $i++) {
						$tags .= $args['tax_terms'][$i] . ',';
					}
					
					$tags = substr($tags, 0, strlen($tags) - 1);
					query_posts('posts_per_page=' . $args['posts_per_page'] . '&tag=' . $tags);
				} else {
					// Custom taxonomy mode
					$terms = '';
					
					for ($i=0; $i<count($args['tax_terms']); $i++) {
						$terms .= $args['tax_terms'][$i] . ',';
					}
					
					$terms = substr($terms, 0, strlen($terms) - 1);

					query_posts(array(
						'tax_query' => array(
							array(
								'taxonomy' => $args['tax_name'],
								'field'    => 'slug',
								'terms'    => $args['tax_terms']
							)
						),
						'posts_per_page' => $args['posts_per_page']
					));
				}
			}
		}
		function get_html_content($id, $settings) {
			$content = '';
			
			$content .= '<div class="dynamic-grid dg-loading" id="dynamic-grid-posts-feed-' . $id . '">';

			while(have_posts()) {
				the_post();
				$this->had_posts = true;
				$content .= '<div class="dg-cell">';
				$content .= $this->get_featured_image($id, $settings);
				$content .= '	<div class="dg-cell-title">' . get_the_title() . '</div>';
				$content .= '	<div class="dg-cell-excerpt">' . get_the_excerpt() . '</div>';
				$content .= '	<div class="dg-cell-link">' . get_permalink() . '</div>';
				$content .= '</div>';
			}
				
			$content .= '</div>';
			return $content;
		}
		function get_featured_image($id, $settings) {
			$options = $this->get_admin_options();

			if ($settings['featured_image'] === 0) {
				return;
			}
			
			if ($settings['featured_image'] === 'random') {
				if (!rand(0, 1)) {
					return;
				}
			}
			
			global $post, $posts;
			
			if (function_exists('has_post_thumbnail')) {
				if (has_post_thumbnail()) {
					return '	<div class="dg-cell-image">' . wp_get_attachment_url(get_post_thumbnail_id($post->ID)) . '</div>';
				}
			}
			
			$first_img = '';
			ob_start();
			ob_end_clean();
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
			$first_img = $matches [1] [0];

			if (empty($first_img)) { //Defines a default image
				$first_img = '';
			}

			return '	<div class="dg-cell-image">' . $first_img . '</div>';
		}
		function update_data() {
			$options = $this->get_admin_options();
			
			foreach ($options['grids'] as $grid) {
				$id = $grid['id'];
				
				$this->do_query($grid['settings']['query'], $grid['settings']['query-mode']);
				$newcontent = $this->get_html_content($grid['id'],$grid['settings']);
				
				if ($this->had_posts) {
					$grid['content'] = $newcontent;
				}
				
				$options['grids'][$id] = $grid;
			}
			
			update_option($this->admin_options_name, $options);
		}
	}
}

if (class_exists('GridPosts')) {
	$grid = new GridPosts();
}

add_action('init', array($grid, 'shortcodes'));
add_action('wp_footer', array($grid, 'call_plugins'));
add_action('wp_enqueue_scripts', array($grid, 'user_includes'));
add_action('admin_menu', array($grid, 'init_pages'));

add_filter('publish_post', array($grid, 'update_data'));
add_filter('trash_post', array($grid, 'update_data'));
add_filter('edit_post', array($grid, 'update_data'));
add_filter('edit_category', array($grid, 'update_data'));
add_filter('publish_post', array($grid, 'update_data'));
add_filter('private_to_publish', array($grid, 'update_data'));
add_filter('save_post', array($grid, 'update_data'));
?>