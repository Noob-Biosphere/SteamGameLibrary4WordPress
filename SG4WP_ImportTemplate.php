<?php

$templates_new = array(
    "page-steamlibrary.php"=>"Steam库"
);

function sg4wp_register_page(){

    add_filter('theme_page_templates', 'sg4wp_add_template');
    add_filter('template_include', 'sg4wp_view_template');

}


function sg4wp_add_template( $posts_templates ) {
    global  $templates_new;
    $posts_templates = array_merge( $posts_templates,$templates_new );
    return $posts_templates;
}


function sg4wp_view_template( $template ) {

    global $post;
    global  $templates_new;
    // If no posts found, return to
    // avoid "Trying to get property of non-object" error
    if ( !isset( $post ) ) return $template;

    $t_template_name = get_post_meta( $post->ID, '_wp_page_template', true );
    if ( ! isset( $templates_new[ $t_template_name ] ) ) {
        return $template;
    } 

    $file = SG4WP_PLUGIN_DIR . 'API/' . $t_template_name;

    if( file_exists( $file ) ) {
        return $file;
    } 

    return $template;

}

?>