<?php

function data_form_ultimate_plugin_css($hook)
{
    global $tiger_form_materials;
    if ('toplevel_page_tiger-forms' == $hook || 'tiger-forms_page_tiger-forms-add-new' == $hook || 'tiger-forms_page_tiger-forms-all-inserted-data' == $hook) {
        wp_enqueue_style(
            'plugin-custom-css',
            $tiger_form_materials->tiger_form_plugin_dir_url('inc/css/style.css'),
            [],
            time()
        );
    }
}

add_action('admin_enqueue_scripts', 'data_form_ultimate_plugin_css');
