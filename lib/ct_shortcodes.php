<?php
function faicon($atts, $content = null) {
    extract(shortcode_atts(array(
        "i" => 'foobar'
    ), $atts));
    return '<i class='.$i.'></i>';
}

add_shortcode('faicon', 'faicon');

/* The whole point of these is to include fontawesome in widget titles, enable that here */
add_filter('widget_title', 'do_shortcode');
