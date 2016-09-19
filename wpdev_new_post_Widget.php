<?php
class wpdev_new_post_Widget extends WP_Widget {
 
 public function __construct() {
 // 생성자, 위젯이 실행되면 가장 먼저 처리.
 $widget_ops = array(' ' => 'wpdev_new_post_Widget',
                         'description'=> '사이트 최근 글 - 출력 라인수 및 제목길이 조정');
     $this->WP_Widget('wpdev_new_post','최근 글 (wpdev)',$widget_ops);
 }
 
 public function form( $instance ) {
 // 관리자 페이지에 셋팅하는 위젯 폼.
 $defaults = array('title'=> '최근 글', 'dp_line'=> '', 'tit_length' => '');
$instance = wp_parse_args((array)$instance, $defaults);
$title = strip_tags($instance['title']);
$dp_line = strip_tags($instance['dp_line']);
$tit_length = strip_tags($instance['tit_length']);
?>
<p><label for="wpdev_new_post_Widget_title"><?php _e('Title')?>:</label>
<input class="widefat" id=wpdev_new_post_Widget_title" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo esc_attr($title)?>" /></p>
<p><label for="wpdev_new_post_Widget_dpline"><?php _e('출력라인')?>:</label>
<input class="widefat" id=wpdev_new_post_Widget_dpline" name="<?php echo $this->get_field_name('dp_line');?>" type="text" value="<?php echo esc_attr($dp_line)?>" /></p>
<p><label for="wpdev_new_post_Widget_titlength"><?php _e('제목길이')?>:</label>
<input class="widefat" id=wpdev_new_post_Widget_titlength" name="<?php echo $this->get_field_name('tit_length');?>" type="text" value="<?php echo esc_attr($tit_length)?>" /></p>
<?php
 }
 
 public function update( $new_instance, $old_instance ) {
 // 위젯 옵션을 저장.
 $instance = $old_instance;
$instance['title'] = strip_tags($new_instance['title']);
$instance['dp_line'] = strip_tags($new_instance['dp_line']);
$instance['tit_length'] = strip_tags($new_instance['tit_length']);
return $instance;
 }
 
 public function widget( $args, $instance ) {
 // 위젯의 출력.
 extract($args);
echo $before_widget;
echo $before_title . $instance['title'] .$after_title;
 
echo "<ul>";
$args = array( 'numberposts' => $instance['dp_line'] , 'post_status' => 'publish');
$recent_posts = wp_get_recent_posts($args);
foreach( $recent_posts as $recent ){
$post_title = wp_html_excerpt($recent["post_title"], $instance['tit_length'],'...');
echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' . $post_title .'</a> </li> ';
}
echo "</ul>";
echo $after_widget;
 }
 
}