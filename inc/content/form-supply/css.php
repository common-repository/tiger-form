<?php
function tiger_form_data_insert_form_ultimate_fontend_css()
{
    global $tiger_form_materials;
    wp_enqueue_style(
        'tiger-form-style',
        $tiger_form_materials->tiger_form_plugin_dir_url('inc/content/form-supply/css/tiger-form-style.css'),
        [],
        time()
    );

}

add_action('wp_enqueue_scripts', 'tiger_form_data_insert_form_ultimate_fontend_css' );
