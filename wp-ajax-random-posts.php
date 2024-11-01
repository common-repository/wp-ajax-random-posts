<?php
/*
Plugin Name: WP-Ajax-Random-Posts
Plugin URI: http://www.qiqiboy.com/plugins/wp-ajax-random-posts
Tags: wordpress, ajax, random, rand, posts
Description: Show your Random posts on sidebar and provide ajax auto refresh function.
Version: 1.0.0
Author: QiQiBoY
Author URI: http://www.qiqiboy.com
*/
load_plugin_textdomain('WP-Ajax-Random-Posts', false, basename(dirname(__FILE__)) . '/lang');
require_once(dirname(__FILE__).'/func/function.php');
function WARP__the_options() {
?>
<div class="wrap">

	<h2><?php _e('WP-Ajax-Random-Posts Help and Options','WP-Ajax-Random-Posts');?></h2>
	<b><?php _e('How to use this plug-in?','WP-Ajax-Random-Posts');?></b><br><br>
	<ol>
		<li><del style="color:#888;"><?php _e('Download the plugin archive and expand it','WP-Ajax-Random-Posts');?></del> <?php _e('(you\'ve likely already done this).','WP-Ajax-Random-Posts');?></li>
		<li><del style="color:#888;"><?php _e('Put the \'WP-Ajax-Random-Posts\' directory into your wp-content/plugins/ directory','WP-Ajax-Random-Posts');?></del> <?php _e('(you\'ve likely already done this).','WP-Ajax-Random-Posts');?></li>
		<li><del style="color:#888;"><?php _e('Go to the Plugins page in your WordPress Administration area and click \'Activate\' for WP-Ajax-Random-Posts','WP-Ajax-Random-Posts');?></del> <?php _e('(you\'ve likely already done this).','WP-Ajax-Random-Posts');?></li>
		<li><del style="color:#888;"><?php _e('Go to the WP-Ajax-Random-Posts Options page (Settings > WP-Ajax-Random-Posts Option)','WP-Ajax-Random-Posts');?></del> <?php _e('(you\'ve likely already done this).','WP-Ajax-Random-Posts');?></li>
		<li><?php _e('1.Go to widgets page to add the widget to your sidebar.','WP-Ajax-Random-Posts');?><br>
			<?php _e('2.use the function ','WP-Ajax-Random-Posts');?><code>&lt;?php WP_Ajax_Random_Posts('number=8&cmtcount=1&excerpt=1&length=100&auto=0&time=60'); ?></code><?php _e(' to custom the posts display position.','WP-Ajax-Random-Posts');?><br>
			<?php _e('This function accepts six parameters:','WP-Ajax-Random-Posts');?><br>
			<code>number</code>: <?php _e('how many posts display. Type: Integer, default 8','WP-Ajax-Random-Posts');?><br>
			<code>cmtcount</code>: <?php _e('display comments count of the post. Type: Boolean, default 0. 1: yes, 0: no','WP-Ajax-Random-Posts');?><br>
			<code>excerpt</code>: <?php _e('display excerpt of no. Type: Boolean, default 0. 1: yes, 0: no','WP-Ajax-Random-Posts');?><br>
			<code>length</code>: <?php _e('the length of the excerpt. Type: Integer, default 100','WP-Ajax-Random-Posts');?><br>
			<code>auto</code>: <?php _e('auto refresh random psots list or not. Type: Boolean, default 0. 1: yes, 0: no','WP-Ajax-Random-Posts');?><br>
			<code>time</code>: <?php _e('the auto refresh interval(seconds). Type: Integer, default 60','WP-Ajax-Random-Posts');?><br>
		</li>
	</ol>
	<br>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		
		<h3><?php _e('Some configuration:','WP-Ajax-Random-Posts');?></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('javascript and css files add to', 'WP-Ajax-Random-Posts'); ?></th>
				<td>
				<select style="width:120px;text-align:center" name="WP-Ajax-Random-files">
					<option value="0" <?php if(get_option("WP-Ajax-Random-files")=="0") echo "selected='selected'"; ?>><?php _e('header', 'WP-Ajax-Random-Posts'); ?></option>
					<option value="1" <?php if(get_option("WP-Ajax-Random-files")=="1") echo "selected='selected'"; ?>><?php _e('footer', 'WP-Ajax-Random-Posts'); ?></option>
				</select>
				</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="WP-Ajax-Random-files" />

		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Save Changes','WP-Ajax-Random-Posts') ?>" />
		</p>

	</form>
</div>
<?php
}
?>