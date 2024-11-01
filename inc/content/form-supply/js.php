<?php
function tiger_form_data_insert_form_ultimate_fontend_js()
{
    global $tiger_form_materials;
    wp_enqueue_script(
        'difu-custom-js',
        $tiger_form_materials->tiger_form_plugin_dir_url('inc/content/form-supply/js/main.js'),
        ['jquery'],
        time()
    );

    wp_localize_script(
        'difu-custom-js',
        'dfuFrontInsert',
        array('admin_ajax' => admin_url('admin-ajax.php'))
    );

    wp_localize_script(
        'difu-custom-js',
        'dfuFrontAlert',
        array('admin_ajax' => admin_url('admin-ajax.php'))
    );

    wp_localize_script(
        'difu-custom-js',
        'dfuFrontAlertEx',
        array('admin_ajax' => admin_url('admin-ajax.php'))
    );

}

add_action('wp_enqueue_scripts', 'tiger_form_data_insert_form_ultimate_fontend_js' );
