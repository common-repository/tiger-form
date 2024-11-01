<?php
function tiger_form_data_insert_form_ultimate_all_data_menu() {
    $hook = add_menu_page(
        'Tiger Forms',
        'Tiger Forms',
        'administrator',
        'tiger-forms',
        'tiger_form_data_insert_form_ultimate_plugin_page_content',
        'dashicons-id-alt',
        40
    );
    add_submenu_page(
        'tiger-forms',
        'Tiger Forms',
        'All Forms',
        'administrator',
        'tiger-forms'
    );
    add_submenu_page(
        'tiger-forms',
        'Add New Form',
        'Add New Form',
        'administrator',
        'tiger-forms-add-new',
        'difu_data_insert_form_ultimate_add_new_form'
    );
   $hooksub = add_submenu_page(
        'tiger-forms',
        'All Inserted Data',
        'All Inserted Data',
        'administrator',
        'tiger-forms-all-inserted-data',
        'difu_data_insert_form_ultimate_all_data_table'
   );
   add_submenu_page(
        null,
        'Export Data Table',
        'Export Data Table',
        'administrator',
        'tiger-forms-export-table',
        'difu_data_insert_form_ultimate_export_data_table'
   );
     
   if('toplevel_page_tiger-forms' == $hook && !isset($_GET['actions'])) {
       add_action("load-$hook", 'tiger_form_add_options');
       function tiger_form_add_options() {
           $option = 'per_page';
           $args = array(
               'label' => 'Number of items per page',
               'default' => 20,
               'option' => 'form_per_page'
           );
           add_screen_option($option, $args);
       }

       function tiger_form_list_help_tab() {
           $screen = get_current_screen();
           $screen->add_help_tab(array(
               'id' => 'dfu_overview',
               'title' => 'Overview',
               'content' => '<p>' . __('On this screen, you can manage unlimited number of Form. Each Form has a unique ID and Form shortcode. To insert a Form into a post, page or a text widget, insert the shortcode into the target.') . '</p><strong>' . __('Here you can perform the following actions:') . '</strong><p>' . __('Edit - Navigates to the editing screen for that Form. You can also reach that screen by clicking on the Data Form title.') . '</p><p>' . __('Delete - If you want to delete your Form, click on the check box on the left and select Delete option from the Bulk Actions dropdown menu then click on the Apply button. Remember, any data inserted through this form will remain.') . '</p>',));
       }
       add_action("load-$hook", 'tiger_form_list_help_tab');
   }

   if('tiger-forms_page_tiger-forms-all-inserted-data' == $hooksub) {
       add_action("load-$hooksub", 'tiger_form_all_inserted_data_add_options');
       function tiger_form_all_inserted_data_add_options() {
           $option = 'per_page';
           $args = array(
               'label' => 'Number of items per page',
               'default' => 20,
               'option' => 'form_per_page'
           );
           add_screen_option($option, $args);
       }
   }
}

add_action('admin_menu', 'tiger_form_data_insert_form_ultimate_all_data_menu');

add_filter('set-screen-option', 'tiger_form_set_screen_option', 10, 3);

function tiger_form_set_screen_option($status, $option, $value) {
    if ( 'form_per_page' == $option ) return $value;
    return $status;
}

function tiger_form_setting_link($link) {
    $settings_link = '<a href="admin.php?page=tiger-forms">'.__('Plugin Page'). '</a>';
    array_push($link, $settings_link);
    return $link;
}

$filter_name = "plugin_action_links_" . tiger_form_data_insert_form_ultimate_baselink;
add_filter($filter_name, 'tiger_form_setting_link');
