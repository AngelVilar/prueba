<?php

/*Plugin name: Mirai
Plugin URI: http://pruebamirai.com.mialias.net
Description:Plugin que muestra La url del site, el nombre del site, la dirección e-mail
del administrador del site, la id del post o página en que nos encontremos, El
título del post o página en que nos encontremos.
Author: Ángel Vilar Hernández
Version: 1.0
*/   

/* Fución para la escritura en el footer */
add_action('wp_footer', 'mirai_footer');
function mirai_footer(){
   
// campos solicitados    
    $fields = array('name', 'url', 'admin_email');
    $data = array();
    foreach($fields as $field) {
        $data[$field] = get_bloginfo($field);
        echo "".$data[$field]."";
        echo "</br>";  
    }
    // datos del post
    $post = get_post( $post );
    $title = isset( $post->post_title ) ? $post->post_title : '';
    $id    = isset( $post->ID ) ? $post->ID : 0;
    echo "".$title."";
    echo "</br>";
    echo "".$id."";   
    
  ?>
<?php
};