<?php
/* 
Plugin Name: Post Pager
Plugin URI: http://melin.co
Version: 1.0
Author: Daniel Melin
Author URI: http://melin.co
Description: Allows a post to be divided into pages
*/
function postpager_converter($content) {
	$css = stripslashes(get_option('postpager-css'));
	
	$prev = stripslashes(get_option('postpager-prev'));
	$next = stripslashes(get_option('postpager-next'));
	$constant = stripslashes(get_option('postpager-constant'));

	$url = get_permalink();
	if (substr($url, -1) != '/') $url .= '/';
	
	$page = basename($_SERVER["REQUEST_URI"]);
	if ($page == basename(get_permalink())) {
		$page = 1;
	} elseif ($page == NULL) {
		$page = 1;
	}
	$prevPage = $page - 1;
	$nextPage = $page + 1;
	$data = $content;
	$data = explode('[POSTPAGERTOP]', $data);
	if (count($data) > 1) {
		$topofpage = $data[0];
		$data = explode('[POSTPAGER]', $data[1]);
	} else {
		$topofpage = NULL;
		$data = explode('[POSTPAGER]', $data[0]);
	}
	
	$html =	'<style type="text/css">
	' . $css . '
	</style>';

    if (preg_match('/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up.browser|up.link|webos|wos)/i', $_SERVER["HTTP_USER_AGENT"])) {
		?>
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(e) {
				$('img[class*="wp-image"]').removeAttr('width');
				$('img[class*="wp-image"]').removeAttr('height');
				$('img[class*="wp-image"]').css({
					maxHeight: ($(window).height() * 0.6) + 'px',
					width: 'auto',
					display: 'block',
					margin: '0 auto'
				});
			});
		</script>
		<?php
	}
	
	$stuff = $data[$page-1];
	if ($stuff == '') {
		$notfound = 1; $stuff = get_option('postpager-404');
	} else {
		$stuff = $topofpage . $stuff;
	}
	$html .= $stuff;
	$pages = count($data);

	$html = str_replace('##TITLE##', get_the_title(), $html);
	if ($notfound != 1) {
		$html .= '<table id="postpager-table"><tr>';
		$html .= '<td>';
		if ($prevPage >= 1) {
			$html .= '<a href="' . $url . $prevPage . '">' . $prev . '</a>';
		} else {
			$html .= '&nbsp;';
		}
		$html .= '</td>';
		$html .= '<td>';
		if ($nextPage <= $pages) {
			$html .= '<a href="' . $url . $nextPage . '">' . $next . '</a>';
		} else {
			$html .= '&nbsp;';
		}
		$html .= '</td>';
		$html .= '</tr></table>';
	}
	if (is_single() || is_page()) {
		return $html;
	} else {
		return $data[0];
	}
}

add_filter('the_content', 'postpager_converter', 0);
function postpager_pages() {
	add_submenu_page('options-general.php', 'Post Pager', 'Post Pager', 'manage_options', 'postpager-admin-page', 'postpager_admin_page');
}
add_action('admin_menu', 'postpager_pages');

function postpager_admin_page() {
	if (isset($_POST['postpager-previous'])) {
		update_option('postpager-prev', $_POST['postpager-previous']);
		update_option('postpager-next', $_POST['postpager-next']);
		update_option('postpager-css', $_POST['postpager-button-css']);
		update_option('postpager-constant', $_POST['postpager-constant']);
		update_option('postpager-404', $_POST['postpager-404']);
		?>
		<script type="text/javascript"> location.href = location.href; </script>
		<?php
	}
	$constant = stripslashes(get_option('postpager-constant'));
	$css = stripslashes(get_option('postpager-css'));
	$prev = stripslashes(get_option('postpager-prev'));
	$next = stripslashes(get_option('postpager-next'));
	$nocontent = stripslashes(get_option('postpager-404'));
	if ($prev == '') $prev = 'Previous page';
	if ($next == '') $next = 'Next page';
	if ($nocontent == '') $nocontent = 'Sorry, seems you tried to access a page of <em>##TITLE##</em> that does not exist.<br><br><a href="##URL##">Click here to get back to the first page</a><br>';
	if ($css == '') {
		$css = '
table#postpager-table {
	border: none;
	margin: 0;
	padding: 0;
	width: 100%;
}
table#postpager-table tr {
	border: none;
	margin: 0;
	padding: 0;
}
table#postpager-table tr td {
	border: none;
	margin: 0;
	padding: 10px;
}
table#postpager-table tr td a {
	border: 1px solid #333;
	border-radius: 3px;
	display: block;
	background: #069;
	color: #fff;
	font: 14px "Trebuchet MS", sans-serif;
	padding: 8px 12px;
	text-align: center;
	transition: background 1s;
	text-decoration: none;
}
table#postpager-table tr td a:hover {
	background: #036;
	transition: background 1s;
}';
	}
	?>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<style type="text/css">
		table#postpager-css {
			width: 100%;
		}
		table#postpager-css td {
			width: 50%;
		}
		table#postpager-css td textarea {
			width: 100%;
		}
		table#postpager-css td input[type=text] {
			width: 100%;
		}
	</style>
	<script type="text/javascript">
		buttons = '<table id="postpager-table"><tr><td><a href=""><?= $prev ?></a></td><td><a href=""><?= $next ?></a></td></tr></table>';
		$(document).ready(function(e) {
			$('td#postpager-buttons').html('<style type="text/css"> ' + $('textarea#postpager-button-css').val() + '</style>' + buttons);
			$('textarea#postpager-button-css').keyup(function() {
				$('td#postpager-buttons').html('<style type="text/css"> ' + $('textarea#postpager-button-css').val() + '</style>' + buttons);
				ppEnableButtonText();
			});
			function ppEnableButtonText() {
				$('input#postpager-next, input#postpager-previous').unbind('keyup');
				$('input#postpager-next, input#postpager-previous').keyup(function() {
					if ($(this).attr('id') == 'postpager-next') {
						$('table#postpager-table > tbody > tr > td:last > a').html($(this).val());
					} else {
						$('table#postpager-table > tbody > tr > td:first > a').html($(this).val());
					}
				});
			}
			ppEnableButtonText();
		});
	</script>
	<div class="wrap">
		<h1>Post Pager</h1>
		<p><em>Allows a post to be split into several pages</em></p>
		<form action="" method="post">
			<table id="postpager-css">
				<tr>
					<td>
						<strong>Previous page</strong><br />
						<input type="text" name="postpager-previous" id="postpager-previous" value="<?= $prev ?>" />
					</td>
					<td>
						<strong>Next page</strong><br />
						<input type="text" name="postpager-next" id="postpager-next" value="<?= $next ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<strong>Button style</strong>
						<textarea rows="15" id="postpager-button-css" name="postpager-button-css"><?= $css ?></textarea>
					</td>
					<td id="postpager-buttons">
						
					</td>
				</tr>
				<tr>
					<td>
						<strong>Fillout for non existing pages</strong>
						<textarea rows="10" id="postpager-404" name="postpager-404"><?= $nocontent ?></textarea>
					</td>
					<td>
						<strong>Instructions</strong>
						<p>Split the post into a new page by adding <code>[POSTPAGER]</code> where you want the page to divide.</p>
						<p>Anything above [POSTPAGERTOP] will be included on EVERY page of that post.</p>
						<p>Fillout accepts these variables:</p>
						<ul>
							<li><code>##TITLE##</code> the current page/post title</li>
							<li><code>##URL##</code> the URL to the page/posts first page</li>
						</ul>
					</td>
				</tr>
			</table>
			<input name="save" type="submit" class="button button-primary button-large" id="postpager-save" value="Save settings">
		</form>
	<?php
}
?>