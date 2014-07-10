<?php

function vs_animation_type ()
{
    register_post_type('vs_animation', array(
        'labels' => array(
            'name' => __('Virtual Sensitive Animation'),
            'singular_name' => __('Virtual Sensitive Animation')
        ),
        'public' => true,
        'has_archive' => false
    ));
}
