<?php
/* 
Plugin Name: Awesome Content handler
Plugin URI: http://melin.co
Version: 1.0
Author: Daniel Melin
Author URI: http://melin.co
Description: Handles your contant, perfectly.
*/
function awcon_converter($content) {
	if (is_single() || is_page()) {
		if (awcon_isMobile()) {
			$device = 'mobile_' . awcon_checkDevice();
		} else {
			$device = 'desktop';
		}
		$reg_exUrl = '/\[awcon-youtube:([^\]]+?)\]/U';
		preg_match_all($reg_exUrl, $content, $out, PREG_SET_ORDER);
		foreach ($out as $video) {
			$content = str_replace($video[0], awcon_youtube($video[1]), $content);
		}
		$html .= stripslashes(get_option('awcon_before_' . $device));
		$html .= $content;
		$html .= stripslashes(get_option('awcon_after_' . $device));
		$html = str_replace('##URLF##', urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"), $html);
		$html = str_replace('##URL##', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", $html);
		$html = str_replace('##TITLE##', get_the_title(), $html);
		return $html;
	} else {
		return $content;
	}
}
function awcon_youtube($youtube) {
	if (awcon_isMobile()) {
		$html = stripslashes(get_option('awcon_youtube_mobile'));
	} else {
		$html = stripslashes(get_option('awcon_youtube'));
	}
	$html = str_replace('##YOUTUBELINK##', $youtube, $html);
	return $html;
}
function awcon_checkDevice() {
	$android = stripslashes(get_option('awcon_mobile_android'));
	$apple = stripslashes(get_option('awcon_mobile_apple'));
    if (preg_match($android, $_SERVER["HTTP_USER_AGENT"])) {
		return 'android';
	} elseif (preg_match($apple, $_SERVER["HTTP_USER_AGENT"])) {
		return 'apple';
	} else {
		return 'other';
	}
}

function awcon_isMobile() {
	$devices = stripslashes(get_option('awcon_mobile_devices'));
    return preg_match($devices, $_SERVER["HTTP_USER_AGENT"]);
}
	
add_filter('the_content', 'awcon_converter');
function awcon_pages() {
	add_submenu_page('options-general.php', 'Awesome Content', 'Awesome Content', 'manage_options', 'awcon-admin-page', 'awcon_admin_page');
}
add_action('admin_menu', 'awcon_pages');

function awcon_admin_page() {
	if ($_POST['awcon_saved']) {
		update_option('awcon_before_desktop', $_POST['awcon_before_desktop']);
		update_option('awcon_before_mobile_android', $_POST['awcon_before_mobile_android']);
		update_option('awcon_before_mobile_apple', $_POST['awcon_before_mobile_apple']);
		update_option('awcon_before_mobile_other', $_POST['awcon_before_mobile_other']);
		update_option('awcon_after_desktop', $_POST['awcon_after_desktop']);
		update_option('awcon_after_mobile_android', $_POST['awcon_after_mobile_android']);
		update_option('awcon_after_mobile_apple', $_POST['awcon_after_mobile_apple']);
		update_option('awcon_after_mobile_other', $_POST['awcon_after_mobile_other']);
		update_option('awcon_mobile_devices', $_POST['awcon_mobile_devices']);
		update_option('awcon_mobile_android', $_POST['awcon_mobile_android']);
		update_option('awcon_mobile_apple', $_POST['awcon_mobile_apple']);
		update_option('awcon_youtube', $_POST['awcon_youtube']);
		update_option('awcon_youtube_mobile', $_POST['awcon_youtube_mobile']);
		update_option('awcon_popup_desktop', $_POST['awcon_popup_desktop']);
		update_option('awcon_popup_mobile', $_POST['awcon_popup_mobile']);
		?>
		<script type="text/javascript"> location.href = location.href; </script>
		<?php
	}
	if (get_option('awcon_mobile_devices') == '') {
		update_option('awcon_mobile_devices', "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up.browser|up.link|webos|wos)/i");
	}
	if (get_option('awcon_mobile_android') == '') {
		update_option('awcon_mobile_android', "/(android)/i");
	}
	if (get_option('awcon_mobile_apple') == '') {
		update_option('awcon_mobile_apple', "/(webos|wos)/i");
	}
	?>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<style type="text/css">
		textarea {
			border: 1px solid #999;
			border-radius: 4px;
			font: 12px "Courier New", Courier, monospace;
			resize: none;
			display: block;
			width: 100%;
			height: 100px;
			transition: height 0.2s ease-out;
		}
		textarea:focus {
			height: 300px;
			transition: height 0.2s ease-out;
		}
		table {
			width: 100%;
		}
		table td {
			width: 50%;
			padding: 10px;
			vertical-align: top;
		}
		fieldset {
			border: 1px solid rgba(0, 0, 0, 0.3);
			border-radius: 4px;
			padding: 8px;
			margin: 10px 0;
		}
		fieldset legend {
			font-size: 17px;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(e) {
			function setTextareaWidth() {
				w = $('td#template-td').width() - 14;
				$('textarea').css({
					width: w + 'px'
				});
			}
			setTextareaWidth();
			$(window).resize(function() {
				setTextareaWidth();
			});
		});
	</script>
	<div class="wrap">
		<h1>Awesome Content</h1>
		<hr />
		<p><small>Awesome Content is written by Daniel Melin</small></p>
		<form action="" method="post">
		<input type="hidden" name="awcon_saved" value="1" />
		<table>
			<tr>
				<td id="template-td">
					<h2>Before content</h2>
					<h3><i class="fa fa-desktop fa-fw"></i> Desktop</h3>
					<textarea class="form-control" id="awcon_before_desktop" name="awcon_before_desktop" placeholder="This will be added before the post/page content" rows="12"><?=  stripslashes(get_option('awcon_before_desktop')) ?></textarea>
					<h3><i class="fa fa-android fa-fw"></i> Mobile Android</h3>
					<textarea class="form-control" id="awcon_before_mobile_android" name="awcon_before_mobile_android" placeholder="This will be added after the post/page content" rows="12"><?=  stripslashes(get_option('awcon_before_mobile_android')) ?></textarea>
					<h3><i class="fa fa-apple fa-fw"></i> Mobile Apple</h3>
					<textarea class="form-control" id="awcon_before_mobile_apple" name="awcon_before_mobile_apple" placeholder="This will be added after the post/page content" rows="12"><?=  stripslashes(get_option('awcon_before_mobile_apple')) ?></textarea>
					<h3><i class="fa fa-mobile fa-fw"></i> Mobile Other</h3>
					<textarea class="form-control" id="awcon_before_mobile_other" name="awcon_before_mobile_other" placeholder="This will be added after the post/page content" rows="12"><?=  stripslashes(get_option('awcon_before_mobile_other')) ?></textarea>
					<small>"Other" will be used if the device was not detected as android or apple</small>
				</td>
				<td>
					<h2>After content</h2>
					<h3><i class="fa fa-desktop fa-fw"></i> Desktop</h3>
					<textarea class="form-control" id="awcon_after_desktop" name="awcon_after_desktop" placeholder="This will be added after the post/page content" rows="12"><?=  stripslashes(get_option('awcon_after_desktop')) ?></textarea>
					<h3><i class="fa fa-android fa-fw"></i> Mobile Android</h3>
					<textarea class="form-control" id="awcon_after_mobile_android" name="awcon_after_mobile_android" placeholder="This will be added after the post/page content" rows="12"><?=  stripslashes(get_option('awcon_after_mobile_android')) ?></textarea>
					<h3><i class="fa fa-apple fa-fw"></i> Mobile Apple</h3>
					<textarea class="form-control" id="awcon_after_mobile_apple" name="awcon_after_mobile_apple" placeholder="This will be added after the post/page content" rows="12"><?=  stripslashes(get_option('awcon_after_mobile_apple')) ?></textarea>
					<h3><i class="fa fa-mobile fa-fw"></i> Mobile Other</h3>
					<textarea class="form-control" id="awcon_after_mobile_other" name="awcon_after_mobile_other" placeholder="This will be added after the post/page content" rows="12"><?=  stripslashes(get_option('awcon_after_mobile_other')) ?></textarea>
					<small>"Other" will be used if the device was not detected as android or apple</small>
				</td>
			</tr>
			<tr>
				<td>
					<h2><i class="fa fa-mobile fa-fw"></i> Mobile devices</h2>
					<textarea class="form-control" id="awcon_mobile_devices" name="awcon_mobile_devices" placeholder="Regexp for detecting mobile devices" rows="3"><?=  stripslashes(get_option('awcon_mobile_devices')) ?></textarea>
					<h2><i class="fa fa-android fa-fw"></i> Android devices</h2>
					<textarea class="form-control" id="awcon_mobile_android" name="awcon_mobile_android" placeholder="Regexp for android devices" rows="3"><?=  stripslashes(get_option('awcon_mobile_android')) ?></textarea>
					<h2><i class="fa fa-apple fa-fw"></i> Apple devices</h2>
					<textarea class="form-control" id="awcon_mobile_apple" name="awcon_mobile_apple" placeholder="Regexp for apple devices" rows="3"><?=  stripslashes(get_option('awcon_mobile_apple')) ?></textarea>
					<small>This helps detect if the user is on a mobile device, and if so - display different content before and/or after the actual post/page content</small>
				</td>
				<td>
					<h2><i class="fa fa-youtube-square fa-fw"></i> Code for Youtube links</h2>
					<textarea class="form-control" id="awcon_youtube" name="awcon_youtube" placeholder="HTML and other code for Youtube links" rows="12"><?=  stripslashes(get_option('awcon_youtube')) ?></textarea>

					<h2><i class="fa fa-youtube-square fa-fw"></i> Code for Youtube links (mobile)</h2>
					<textarea class="form-control" id="awcon_youtube_mobile" name="awcon_youtube_mobile" placeholder="HTML and other code for Youtube links" rows="12"><?=  stripslashes(get_option('awcon_youtube_mobile')) ?></textarea>

					<h2><i class="fa fa-desktop fa-fw"></i> Youtube popup code - desktop</h2>
					<textarea class="form-control" id="awcon_popup_desktop" name="awcon_popup_desktop" placeholder="HTML, CSS and JS for the popup" rows="12"><?=  stripslashes(get_option('awcon_popup_desktop')) ?></textarea>
					<h2><i class="fa fa-mobile fa-fw"></i> Youtube popup code - mobile</h2>
					<textarea class="form-control" id="awcon_popup_mobile" name="awcon_popup_mobile" placeholder="HTML, CSS and JS for the popup" rows="12"><?=  stripslashes(get_option('awcon_popup_mobile')) ?></textarea>
				</td>
			</tr>
		</table>
		<hr />
		<input name="save" type="submit" class="button button-primary button-large" id="awcon-save" value="Save settings">
		</form>
		<hr />
		<h3>Instructions</h3>
		<p><small>These "codes" can be inserted in any of the fields</small></p>
		<ul>
			<li><code>##YOUTUBELINK##</code> where you want the Youtube link in the code (the link is the ID for the video, not the entire URL: https://www.youtube.com/watch?v=<strong>BYTnD1pbnkM</strong> - the last part is what we need). The video ID is inserted into the content with <code>[awcon-youtube:BYTnD1pbnkM]</code></li>
			<li><code>##URL##</code> will insert the current post URL</li>
		</ul>
	</div>
	<?php
}
?>