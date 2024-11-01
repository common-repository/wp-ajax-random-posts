<?php
function WARP__showErr($ErrMsg) {
    header('HTTP/1.0 500 Internal Server Error');
	header('Content-Type: text/plain;charset=UTF-8');
    echo $ErrMsg;
    exit;
}
function WARP__init(){
	if($_GET['action'] == 'wpAjaxRandomPosts'){
		$jsonArr=array();
		$_num=$_GET['number'];
		$_cmtcount=$_GET['cmtcount'];
		$_excerpt=$_GET['excerpt'];
		$_length=$_GET['length'];
		$_auto=$_GET['auto'];
		$_time=$_GET['time'];
		echo WARP_Random_posts("number=$_num&cmtcount=$_cmtcount&excerpt=$_excerpt&length=$_length&auto=$_auto&time=$_time");
		die();
	}
}
add_action('init', 'WARP__init');

function WARP_Random_posts($args=''){
	$defargs=array('number' => 8, 'cmtcount' => 0, 'excerpt' => 0, 'length' => 100, 'auto' => 0, 'time' => 60);
	$args = wp_parse_args($args, $defargs);$output='';$number=$args['number'];
	query_posts("showposts=$number&orderby=rand");
	if(have_posts()){
		while (have_posts()) :the_post();
			$output.='<li id="random-post-'.get_the_ID().'" class="random-post"><div class="random-post-title"><a title="'.get_the_title().'" class="random-post-link" href="'.get_permalink().'">'.get_the_title().'</a>';
			if($args['cmtcount']!=0)$output.='('.get_comments_number().')';
			$output.='</div>';
			if($args['excerpt']!=0)$output.='<div class="random-post-excerpt">'.WARP_Random_posts_substr(strip_tags(get_the_content()),(int)$args['length']).'</div>';;
			$output.='</li>';
		endwhile;
		$output.='<li id="random-post-more" class="random-post" style="text-align:center"><div><a style="width:100%;height:100%" href="javascript:;" onclick="WARP_.get_random_posts(\'number='.$args['number'].'&cmtcount='.$args['cmtcount'].'&excerpt='.$args['excerpt'].'&length='.$args['length'].'&auto='.$args['auto'].'&time='.$args['time'].'\')">'.__('Refresh', 'WP-Ajax-Random-Posts').'</a>'.($args['auto']?': <span id="refreshTime">'.$args['time'].'</span>':'').'</div></li>';
		return $output;
	}else{
		WARP__showErr(__('There is no post.','WP-Ajax-Random-Posts'));
	}
}
function WP_Ajax_Random_Posts($args=''){
	echo '<ul id="wp-random-posts">'.WARP_Random_posts($args).'</ul>';
}
function WARP_Random_posts_substr($str,$length){
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
		preg_match_all($pa, $str, $t_str);
		if(count($t_str[0]) > $length) {
			$ellipsis = '...';
			$str = join('', array_slice($t_str[0], 0, $length)) . $ellipsis;
		}
		return $str;
}
add_action('admin_menu', 'WARP__add_options');

function WARP__add_options() {
	add_options_page('Ajax Random Posts', __("Ajax Random Posts","WP-Ajax-Random-Posts"), 8, __FILE__, 'WARP__the_options');
}
function WARP__addScript(){
	$script = '<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wp-ajax-random-posts/js/wp-ajax-random-posts.js"></script>';
	echo $script;
}
if(get_option("WP-Ajax-Random-files")!='1')add_action ('wp_head', 'WARP__addScript');
else add_action ('wp_footer', 'WARP__addScript');
class WARP__widget extends WP_Widget{
	function WARP__widget(){
		$widget_des = array('classname'=>'WARP_Recent_posts','description'=>__('Show your random posts on sidebar and provide ajax pagenav function.', 'WP-Ajax-Random-Posts'));
		$this->WP_Widget(false,__('Ajax Random Posts', 'WP-Ajax-Random-Posts'),$widget_des);
	}
	function form($instance){
		$instance = wp_parse_args((array)$instance,array(
		'title'=>__('Random Posts', 'WP-Ajax-Random-Posts'),
		'number'=>8,
		'cmtcount'=>false,
		'excerpt'=>false,
		'length'=>100,
		'auto'=>false,
		'time'=>60));
		echo '<p><label for="'.$this->get_field_name('title').'">'.__('widget title: ', 'WP-Ajax-Random-Posts').'<input style="width:200px;" name="'.$this->get_field_name('title').'" type="text" value="'.htmlspecialchars($instance['title']).'" /></label></p>';
		echo '<p><label for="'.$this->get_field_name('number').'">'.__('The number of random posts', 'WP-Ajax-Random-Posts').'<input style="width:200px;" name="'.$this->get_field_name('number').'" type="text" value="'.htmlspecialchars($instance['number']).'" /></label></p>';
		echo '<p><input style="" name="'.$this->get_field_name('cmtcount').'" type="checkbox" value="checkbox" ';if($instance['cmtcount'])echo 'checked="checked"';echo '/><label for="'.$this->get_field_name('cmtcount').'">'.__('show post comments count?', 'WP-Ajax-Random-Posts').'</label></p>';
		echo '<p><input style="" name="'.$this->get_field_name('excerpt').'" type="checkbox" value="checkbox" ';if($instance['excerpt'])echo 'checked="checked"';echo '/><label for="'.$this->get_field_name('excerpt').'">'.__('show post excerpt?', 'WP-Ajax-Random-Posts').'</label></p>';
		echo '<p><label for="'.$this->get_field_name('length').'">'.__('The length of excerpt', 'WP-Ajax-Random-Posts').'<input style="width:200px;" name="'.$this->get_field_name('length').'" type="text" value="'.htmlspecialchars($instance['length']).'" /></label></p>';
		echo '<p><input style="" name="'.$this->get_field_name('auto').'" type="checkbox" value="checkbox" ';if($instance['auto'])echo 'checked="checked"';echo '/><label for="'.$this->get_field_name('auto').'">'.__('auto refresh?', 'WP-Ajax-Random-Posts').'</label></p>';
		echo '<p><label for="'.$this->get_field_name('time').'">'.__('The auto refresh interval', 'WP-Ajax-Random-Posts').'<input style="width:200px;" name="'.$this->get_field_name('time').'" type="text" value="'.htmlspecialchars($instance['time']).'" /></label></p>';
	}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['number'] = (int)$new_instance['number'];
		$instance['cmtcount'] = (bool)$new_instance['cmtcount'];
		$instance['excerpt'] = (bool)$new_instance['excerpt'];
		$instance['length'] = (int)$new_instance['length'];
		$instance['auto'] = (bool)$new_instance['auto'];
		$instance['time'] = (int)$new_instance['time'];
		return $instance;
	}
	function widget($args,$instance){
		extract($args);
		$myargs='number='.$instance['number'].'&cmtcount='.((int)$instance['cmtcount']).'&excerpt='.((int)$instance['excerpt']).'&length='.(int)$instance['length'].'&auto='.((int)$instance['auto']).'&time='.(int)$instance['time'];
		$title = apply_filters('widget_title',empty($instance['title']) ? __('Random Posts', 'WP-Ajax-Random-Posts') : $instance['title']);
		echo '<li id="random-post-widget" class="widget"><h3>'.$title.'</h3>';
		WP_Ajax_Random_Posts($myargs);
		echo '</li>';
	}
}
function WARP__widget_init(){
	register_widget('WARP__widget');
}
add_action('widgets_init','WARP__widget_init');
?>