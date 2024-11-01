<?php

namespace tiger_form_ultimate;
class plugin_operate
{
    public function uninstall()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'posts';
        $table_name_dfu = $wpdb->prefix . 'tiger_forms_main';
        $checked = $wpdb->get_var("SELECT COUNT(ID) FROM $table_name WHERE post_type = 'tiger_form'");
        if ($checked > 0) {
            $wpdb->delete($table_name, array('post_type' => 'tiger_form'));
        }
        $getAllTable = $wpdb->get_results("SELECT form_name FROM $table_name_dfu");
        foreach ($getAllTable as $value) {
            $wpdb->query(sprintf("DROP TABLE IF EXISTS %s",
                $wpdb->prefix . $value->form_name));
        }
        $wpdb->query(sprintf("DROP TABLE IF EXISTS %s",
            $table_name_dfu));
    }
}