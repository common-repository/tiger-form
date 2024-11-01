<?php
function data_form_ultimate_plugin_js($hook)
{
    global $tiger_form_materials;
    if ('tiger-forms_page_tiger-forms-add-new' == $hook || isset($_GET['actions'])):

        wp_enqueue_script(
            'custom-js',
            $tiger_form_materials->tiger_form_plugin_dir_url('inc/js/admin-main-add-new.js'),
            ['jquery'],
            time()
        );
        wp_enqueue_script(
            'jquery-ui',
            $tiger_form_materials->tiger_form_plugin_dir_url('inc/js/jquery-ui.js'),
            ['jquery'],
            time()
        );
        wp_enqueue_script(
            'jquery-ui-touch',
            $tiger_form_materials->tiger_form_plugin_dir_url('inc/js/jquery-ui-touch.js'),
            ['jquery'],
            time()
        );
        wp_enqueue_script(
            'ajax-data',
            $tiger_form_materials->tiger_form_plugin_dir_url('inc/js/ajax-data.js'),
            array('jquery')
        );

        wp_localize_script(
            'ajax-data',
            'dfuInsert',
            array('admin_ajax' => admin_url('admin-ajax.php'))
        );
        wp_localize_script(
            'ajax-data',
            'dfuDeleteUpdate',
            array('admin_ajax' => admin_url('admin-ajax.php'))
        );

        wp_localize_script(
            'ajax-data',
            'dfuUpdateDelete',
            array('admin_ajax' => admin_url('admin-ajax.php'))
        );

        wp_localize_script(
            'ajax-data',
            'dfuUpdate',
            array('admin_ajax' => admin_url('admin-ajax.php'))
        );
    endif;

    if ('toplevel_page_tiger-forms' == $hook):

        wp_enqueue_script(
            'custom-js',
            $tiger_form_materials->tiger_form_plugin_dir_url('inc/js/admin-list-table.js'),
            ['jquery'],
            time()
        );
    endif;

    if ('tiger-forms_page_tiger-forms-all-inserted-data' == $hook):
        wp_enqueue_script(
            'custom-table-js',
            $tiger_form_materials->tiger_form_plugin_dir_url('inc/js/main.js'),
            ['jquery'],
            time()
        );
        wp_localize_script(
            'custom-table-js',
            'deletetable',
            array('admin_ajax' => admin_url('admin-ajax.php'))
        );
        wp_localize_script(
            'custom-table-js',
            'deletecolumn',
            array('admin_ajax' => admin_url('admin-ajax.php'))
        );
        wp_localize_script(
            'custom-table-js',
            'updatecolumn',
            array('admin_ajax' => admin_url('admin-ajax.php'))
        );

        wp_localize_script(
            'custom-table-js',
            'tablereset',
            array('admin_ajax' => admin_url('admin-ajax.php'))
        );

    endif;

}

add_action('admin_enqueue_scripts', 'data_form_ultimate_plugin_js', 100);
