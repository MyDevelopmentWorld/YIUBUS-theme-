<?php
function ybus_load_style(){
	wp_enqueue_style('style-ybus',get_stylesheet_uri());
}
add_action("wp_enqueue_scripts","ybus_load_style");


require_once 'wpdev_new_post_Widget.php';
function wpdev_register_widgets() {
register_widget('wpdev_new_post_Widget');
}
 
add_action('widgets_init', 'wpdev_register_widgets');

function register_my_sidebar(){
	register_sidebar(array(('name')=>__('Main sidebar')
		)
	);
}
add_action('init','register_my_sidebar');