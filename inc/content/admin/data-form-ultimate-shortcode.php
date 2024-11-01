<?php
function tiger_form_frontend_form_shortcode_generate($option)
{
    global $tiger_form_materials, $tiger_form_text_columns, $tiger_form_text_columns_req, $tiger_form_email_columns, $tiger_form_email_columns_req, $tiger_form_checkbox_columns, $tiger_form_date_columns, $tiger_form_date_columns_req, $tiger_form_number_columns, $tiger_form_number_columns_req, $tiger_form_radio_columns, $tiger_form_select_columns, $tiger_form_select_columns_req, $tiger_form_textarea_columns, $tiger_form_textarea_columns_req, $tiger_form_url_columns, $tiger_form_url_columns_req;
    extract(shortcode_atts(array(
        'id' => '',
        'title' => '',
    ), $option));

    $args = array(
        'id' => $id,
        'title' => $title,
    );


    if (empty($id) || empty($title)) {
        $output = '<div class="dfu-missing-error">Tiger Form id or title is missing!</div>';
    } else {
        global $wpdb;
        $table_name_common = $wpdb->prefix . 'posts';

        $checkId = $wpdb->get_var("SELECT COUNT(ID) FROM $table_name_common  WHERE post_type = 'tiger_form' AND ID = '$id' AND post_title = '$title'");
        if ($checkId == 1) {

            $getform = $wpdb->get_row("SELECT * FROM $table_name_common WHERE post_type = 'tiger_form' AND ID = '$id' AND post_title = '$title'");
            $output = '';
            $output .= '<div class="dfu-alert-msg-' . intval($id) . '" data-title="' . $title . '"></div>';
            $output .= '<!-- This form was created using the "Tiger Forms - Drag and Drop Form Builder" plugin --> ';
            $output .= '<!-- Tiger Forms, your ultimate form solutions. --> ';
            $output .= '<form action="" data-formname="tiger-form-' . intval($id) . '" method="POST" class="dfu-form" id="tiger-form-' . intval($id) . '">';
            $output .= '<input type="hidden" class="postid" name="getcurrentpost" value="' . get_the_ID() . '"/>';
            $output .= '<input type="hidden" class="wp_nonce" name="wp_nonce" value="' . wp_create_nonce("dfu-form-submit-" . intval($id)) . '"/>';
            $output .= '<input type="hidden" class="form-id" name="form-id" value="' . intval($id) . '"/>';
            $getArr = explode("[", $getform->post_content);
            $count = 0;
            foreach ($getArr as $value) {
                $count++;
                if ($count > 1) {
                    $output .= do_shortcode('[' . $tiger_form_materials->tiger_form_shortcode_validate_error($value));
                }
            }
            $output .= "</form>";
            $difu_column_concate = $tiger_form_text_columns . ' ' . $tiger_form_text_columns_req . ' ' . $tiger_form_email_columns . ' ' . $tiger_form_email_columns_req . ' ' . $tiger_form_number_columns . ' ' . $tiger_form_number_columns_req . ' ' . $tiger_form_date_columns . ' ' . $tiger_form_date_columns_req . ' ' . $tiger_form_select_columns . ' ' . $tiger_form_select_columns_req . ' ' . $tiger_form_radio_columns . ' ' . $tiger_form_textarea_columns . ' ' . $tiger_form_textarea_columns_req . ' ' . $tiger_form_url_columns . ' ' . $tiger_form_url_columns_req . ' ' . implode(" ", $tiger_form_checkbox_columns);
            $difu_column_concate = preg_replace('/\s+/', ' ', trim($difu_column_concate));
            $difu_columns = explode(" ", $difu_column_concate);
            $searchTable = $wpdb->prefix . 'tiger_form_' . intval($id);
            $table = $wpdb->prefix . 'tiger_forms_main';
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            $getColumn = array_values($difu_columns);
            if ($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $searchTable)) === $searchTable) {
                $newColumnFound = '';
                array_unshift($getColumn, 'id');
                $formationColumn = implode(",", $getColumn);
                $formationColumn = str_replace("-", "_", $formationColumn);
                $getNewFormationC = explode(',', $formationColumn);
                $results = $wpdb->get_results("SHOW COLUMNS FROM $searchTable");
                $insertedColumn = array();
                foreach ($results as $field) {
                    if ($field->Field != 'time_and_date') {
                        array_push($insertedColumn, $field->Field);
                    }
                }
                if (count($getNewFormationC) > count($insertedColumn)) {
                    $findNewColumn = array_diff($getNewFormationC, $insertedColumn);
                    $columnIncrease = array();
                    foreach ($findNewColumn as $valueC) {
                        array_push($columnIncrease, '`' . $valueC . '` text NOT NULL');
                    }
                    $tiger_form_materials->tiger_form_columns_alter($columnIncrease, $searchTable);
                    $newColumnFound = $tiger_form_materials->tiger_form_userend_columns_operation($findNewColumn);
                } elseif (count($getNewFormationC) < count($insertedColumn)) {
                    $findNewColumn = array_diff($getNewFormationC, $insertedColumn);
                    if (count($findNewColumn) > 0) {
                        $newColumnFound = $tiger_form_materials->tiger_form_userend_columns_operation($findNewColumn);
                        $columnDecrease = array();
                        foreach ($findNewColumn as $valueC) {
                            array_push($columnDecrease, '`' . $valueC . '` text NOT NULL');
                        }
                        $tiger_form_materials->tiger_form_columns_alter($columnDecrease, $searchTable);
                    }
                } else {
                    $columnEq = array_intersect($getNewFormationC, $insertedColumn);
                    if (count($columnEq) != count($getNewFormationC)) {
                        $columnEqual = array_diff($getNewFormationC, $insertedColumn);
                        $newColumnFound = $tiger_form_materials->tiger_form_userend_columns_operation($columnEqual);
                        $columnSame = array();
                        foreach ($columnEqual as $valueC) {
                            array_push($columnSame, '`' . $valueC . '` text NOT NULL');
                        }
                        $tiger_form_materials->tiger_form_columns_alter($columnSame, $searchTable);
                    }
                }
                $getAlertResults = $wpdb->get_row("SELECT table_columns_name FROM $table WHERE form_post_id = '$id' AND status = 'Active'");
                $mergerAllField = rtrim($getAlertResults->table_columns_name, ',') . ',' . $newColumnFound;
                $wpdb->update($table, array('table_columns_name' => $mergerAllField), array('form_post_id' => $id));
            } else {
                $formationColumn = implode(",", $getColumn);
                $formationColumn = str_replace("-", "_", $formationColumn);
                $getNewFormationC = explode(',', $formationColumn);
                $formationColumnnbsp = $tiger_form_materials->tiger_form_userend_columns_operation($getNewFormationC);
                $finalizeColumn = array();
                $charset_collate = $wpdb->get_charset_collate();
                foreach ($getNewFormationC as $value) {
                    array_push($finalizeColumn, ['name' => $value, 'type' => 'text NOT NULL']);
                }
                $sql = '';
                $sql .= 'CREATE TABLE ' . $searchTable . ' (
               `id` int(11) NOT NULL AUTO_INCREMENT,';
                foreach ($finalizeColumn as $row):
                    $sql .= '`' . $row['name'] . '` ' . $row['type'] . ',';
                endforeach;
                $sql .= '`time_and_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`)
               )' . $charset_collate;

                dbDelta($sql);
                $wpdb->update($table, array('table_columns_name' => $formationColumnnbsp), array('form_post_id' => $id));
            }
        } else {
            $output = '<div class="dfu-missing-error">Tiger Form id and title is invalid !</div>';
        }
    }
    $tiger_form_text_columns = '';
    $tiger_form_text_columns_req = '';
    $tiger_form_email_columns = '';
    $tiger_form_email_columns_req = '';
    $tiger_form_checkbox_columns = array();
    $tiger_form_date_columns = '';
    $tiger_form_date_columns_req = '';
    $tiger_form_number_columns = '';
    $tiger_form_number_columns_req = '';
    $tiger_form_radio_columns = '';
    $tiger_form_select_columns = '';
    $tiger_form_select_columns_req = '';
    $tiger_form_textarea_columns = '';
    $tiger_form_textarea_columns_req = '';
    $tiger_form_url_columns = '';
    $tiger_form_url_columns_req = '';
    return $output;

}

add_shortcode('tiger-form', 'tiger_form_frontend_form_shortcode_generate');