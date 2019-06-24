<?php

function secondary_script_enqueue() {
	
	wp_enqueue_style("customstyle", get_template_directory_uri() . "/css/scaling.css",  array(), "1.0.0", "all");
	wp_enqueue_script("customjs", get_template_directory_uri() . "/js/script.js", array('jquery'), "", true);
}

add_action( "wp_enqueue_scripts",  "secondary_script_enqueue" );

/* register custom post works for the REST API */

/**
 * Add REST API support to an already registered post type.
 */
add_filter( 'register_post_type_args', 'my_post_type_args', 10, 2 );
 
function my_post_type_args( $args, $post_type ) {
 
    if ( 'work' === $post_type ) {
        $args['show_in_rest'] = true;
 
        // Optionally customize the rest_base or rest_controller_class
        $args['rest_base']             = 'works';
        $args['rest_controller_class'] = 'WP_REST_Posts_Controller';
    }
 
    return $args;
}

?>

