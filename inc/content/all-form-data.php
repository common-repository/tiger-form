<?php
function difu_data_insert_form_ultimate_all_data_table()
{
    if (!current_user_can('administrator')) {
        echo '<h1>You have no permission to access this page.</h1>';
        return;
    } else {
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php esc_html_e(get_admin_page_title()); ?></h1>
            <hr class="wp-header-end">
            <?php
            if (get_transient('dfu-table-delete-success')) { ?>
                <div class="notice notice-success is-dismissible">
                    <p>Table deleted successfully.</p>
                </div>
                <?php
                delete_transient('dfu-table-delete-success');
            }
            if (get_transient('dfu-column-delete-success')) { ?>
                <div class="notice notice-success is-dismissible">
                    <p>Column deleted successfully.</p>
                </div>
                <?php
                delete_transient('dfu-column-delete-success');
            }

            if (get_transient('dfu-column-change-success')) { ?>
                <div class="notice notice-success is-dismissible">
                    <p>Columns name changed successfully.</p>
                </div>
                <?php
                delete_transient('dfu-column-change-success');
            }

            if (get_transient('dfu-table-change-success')) {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p>Table name changed successfully.</p>
                </div>
                <?php
                delete_transient('dfu-table-change-success');
            }
            if (get_transient('dfu-columntable-change-success')) { ?>
                <div class="notice notice-success is-dismissible">
                    <p>Table and Columns name changed successfully.</p>
                </div>
                <?php
                delete_transient('dfu-columntable-change-success');
            }
            ?>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2 difu-data-table">
                    <div id="post-body-content" class="dfu-all-table-content" style="position: relative;">
                        <?php
                        global $wpdb;
                        $table_name = $wpdb->prefix . 'tiger_forms_main';
                        $dfuAllTable = new tiger_form_all_table_list;
                        if (isset($_GET['datatable'])) {
                            $dataTableFound = intval($_GET['datatable']);
                            $checkedId = $wpdb->get_var("SELECT COUNT(id) FROM $table_name  WHERE table_columns_name != '' AND form_post_id = '$dataTableFound'");
                            if ($checkedId == 0) { ?>
                                <div class="dfu-custom-notice">
                                    <div class="dfu-table-notice-portion">
                                        <p>Data table is invalid!</p></div>
                                    <div class="dfu-notice-quit"><span style="text-align: right;"
                                                                       class="dashicons dashicons-dismiss"></span></div>
                                </div>
                                <?php
                                $dfuAllTable->prepare_items();
                                $dfuAllTable->display();
                            } else {
                                $dfuTableData = $wpdb->get_row("SELECT form_name, table_columns_name, form_post_id, status, form_display_name FROM $table_name WHERE form_post_id = '$dataTableFound' AND table_columns_name != ''");
                                if ($dfuTableData->status == 'Active') { ?>
                                    <div class="dfu-custom-notice">
                                        <div class="dfu-table-notice-portion">
                                            <p>You can rename table, table columns and download table data in CSV format
                                                by clicking on the "<strong>Table Option </strong><span
                                                        class="dashicons dashicons-admin-tools"></span>" menu </p>
                                        </div>
                                        <div class="dfu-notice-quit"><span style="text-align: right;"
                                                                           class="dashicons dashicons-dismiss"></span>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="dfu-custom-notice">
                                        <div class="dfu-table-notice-portion">
                                            <p>You can rename table and download table data in CSV format by clicking on
                                                the "<strong>Table Option </strong><span
                                                        class="dashicons dashicons-admin-tools"></span>" menu </p>
                                        </div>
                                        <div class="dfu-notice-quit"><span style="text-align: right;"
                                                                           class="dashicons dashicons-dismiss"></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="dfu-table-header">
                                    <div class="dfu-table-name">
                                        <h3><?php esc_html_e($dfuTableData->form_display_name); ?></h3>
                                    </div>
                                    <div class="dfu-setting-icon">
                                        <a href="javascript:void(0)" class="expand-data-table">Expand Full <span
                                                    class="dashicons dashicons-editor-expand"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                href="javascript:void(0)" class="dfu-table-option">Table Option <span
                                                    class="dashicons dashicons-admin-tools"></span></a>
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET['page']) && isset($_GET['datatable']) && isset($_GET['s'])) {
                                    $dfuAllTable->prepare_items($dfuTableData->form_name, sanitize_text_field($_GET['s']));
                                    if (!empty(sanitize_text_field($_GET['s']))) {
                                        ?>
                                        <div class="notice notice-info is-dismissible">
                                            <p><?php _e('Serach result for "'); ?>
                                                <strong><?php echo esc_html($_GET['s']) . '"'; ?></strong></p>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    $dfuAllTable->prepare_items($dfuTableData->form_name, '');
                                }
                                ?>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page=tiger-forms-all-inserted-data&datatable=' . $dataTableFound; ?>"
                                      method="GET">
                                    <input type="hidden" name="page"
                                           value="<?php echo esc_html($_REQUEST['page']); ?>"/>
                                    <input type="hidden" name="datatable" value="<?php echo $dataTableFound; ?>"/>
                                    <?php $dfuAllTable->search_box('Search Data', 'search_data_id'); ?>
                                </form>
                                <form action="" method="GET">
                                    <input type="hidden" name="page"
                                           value="<?php echo esc_html($_REQUEST['page']); ?>"/>
                                    <input type="hidden" name="datatable" value="<?php echo $dataTableFound; ?>"/>
                                    <?php
                                    $dfuAllTable->display();
                                    ?>
                                </form>
                                <div class="dfu-table-hidden-content" style="display: none;">
                                    <div class="dfu-table-hidden-content-inner">
                                        <div class="dfu-content-heading">
                                            <p class="dfu-hidden-content-title">
                                                "<?php esc_html_e($dfuTableData->form_display_name); ?>" Options </p>
                                            <span class="dashicons dashicons-no-alt dfu-table-hidden-content-close"></span>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="dfu-content-inner">
                                                <table style="width: 100%; background: #0073aa;">
                                                    <tr style=" color: #fff;">
                                                        <td class="cell-1"><label class="table-label">Table Name
                                                                : </label></td>
                                                        <td class="cell-2"><?php esc_html_e($dfuTableData->form_display_name); ?></td>
                                                        <td class="cell-3 dfu-cell-append">
                                                            <button type="button" class="change-table-info"><span
                                                                        class="dashicons dashicons-edit"></span> Edit
                                                            </button>
                                                            <button type="button" class="delete-table-info"
                                                                    data-table="<?php esc_html_e($dfuTableData->form_post_id); ?>"
                                                                    data-wpnonce="<?php echo wp_create_nonce('dfu-validate-table-delete'); ?>">
                                                                <span class="dashicons dashicons-trash"></span> Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table style="width: 100%;">
                                                    <?php
                                                    if ($dfuTableData->status == 'Active') {
                                                        $fieldNameArr = explode(',', rtrim($dfuTableData->table_columns_name, ','));
                                                        $count = 0;
                                                        $countIndex = -1;
                                                        foreach ($fieldNameArr as $value) {
                                                            $count++;
                                                            $countIndex++;
                                                            ?>
                                                            <tr>
                                                                <td class="cell-1"><label
                                                                            class="column-label">Column <?php echo $count; ?>
                                                                        : </label></td>
                                                                <td class="cell-2 column-cell"><?php esc_html_e($value); ?></td>
                                                                <td class="cell-3 dfu-cell-append">
                                                                    <button type="button" class="change-column-info">
                                                                        <span class="dashicons dashicons-edit"></span>
                                                                        Edit
                                                                    </button>
                                                                    <?php
                                                                    if (count($fieldNameArr) > 1) { ?>
                                                                        <button type="button" class="delete-column-info"
                                                                                data-columnindex="<?php echo $countIndex; ?>"
                                                                                data-table="<?php esc_html_e($dfuTableData->form_post_id); ?>"
                                                                                data-wpnonce="<?php echo wp_create_nonce('dfu-validate-column-delete'); ?>">
                                                                            <span class="dashicons dashicons-trash"></span>
                                                                            Delete
                                                                        </button>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<center><p style="color:red;">The form in this data table has been deleted!</p></center>';
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                            <div class="dfu-column-save-button">
                                                <button type="button" class="export-xls button-secondary"
                                                        data-table="<?php esc_html_e($dfuTableData->form_post_id); ?>"
                                                        data-wpnonce="<?php echo wp_create_nonce('dfu-validate-xls-download'); ?>">
                                                    <span class="dashicons dashicons-download"></span> Export CSV
                                                </button>
                                                <button type="button"
                                                        data-table="<?php esc_html_e($dfuTableData->form_post_id); ?>"
                                                        data-wpnonce="<?php echo wp_create_nonce('dfu-validate-column-update'); ?>"
                                                        class="save-column-name button-primary"><span
                                                            class="dashicons dashicons-yes-alt"></span> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            $checkedData = $wpdb->get_var("SELECT COUNT(id) FROM $table_name  WHERE table_columns_name != ''");
                            if ($checkedData > 0) {
                                $dfuTableData = $wpdb->get_row("SELECT form_name, table_columns_name, form_post_id, status, form_display_name FROM $table_name WHERE table_columns_name != '' ");
                                if ($dfuTableData->status == 'Active') { ?>
                                    <div class="dfu-custom-notice">
                                        <div class="dfu-table-notice-portion">
                                            <p>You can rename table, table columns and download table data in CSV format
                                                by clicking on the "<strong>Table Option </strong><span
                                                        class="dashicons dashicons-admin-tools"></span>" menu </p>
                                        </div>
                                        <div class="dfu-notice-quit"><span style="text-align: right;"
                                                                           class="dashicons dashicons-dismiss"></span>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="dfu-custom-notice">
                                        <div class="dfu-table-notice-portion">
                                            <p>You can rename table and download table data in CSV format by clicking on
                                                the "<strong>Table Option </strong><span
                                                        class="dashicons dashicons-admin-tools"></span>" menu </p>
                                        </div>
                                        <div class="dfu-notice-quit"><span style="text-align: right;"
                                                                           class="dashicons dashicons-dismiss"></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="dfu-table-header">
                                    <div class="dfu-table-name">
                                        <h3><?php esc_html_e($dfuTableData->form_display_name); ?></h3>
                                    </div>
                                    <div class="dfu-setting-icon">
                                        <a href="javascript:void(0)" class="expand-data-table">Expand Full <span
                                                    class="dashicons dashicons-editor-expand"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                href="javascript:void(0)" class="dfu-table-option">Table Option <span
                                                    class="dashicons dashicons-admin-tools"></span></a>
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET['page']) && isset($_GET['s'])) {
                                    $dfuAllTable->prepare_items($dfuTableData->form_name, sanitize_text_field($_GET['s']));
                                    if (!empty(sanitize_text_field($_GET['s']))) {
                                        ?>
                                        <div class="notice notice-info is-dismissible">
                                            <p><?php _e('Serach result for "'); ?>
                                                <strong><?php echo esc_html($_GET['s']) . '"'; ?></strong></p>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    $dfuAllTable->prepare_items($dfuTableData->form_name, '');
                                }
                                ?>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?page=tiger-forms-all-inserted-data'; ?>"
                                      method="GET">
                                    <input type="hidden" name="page"
                                           value="<?php echo esc_html($_REQUEST['page']); ?>"/>
                                    <?php $dfuAllTable->search_box('Search Data', 'search_data_id'); ?>
                                </form>
                                <form action="" method="GET">
                                    <input type="hidden" name="page"
                                           value="<?php echo esc_html($_REQUEST['page']); ?>"/>
                                    <?php
                                    $dfuAllTable->display();
                                    ?>
                                </form>
                                <div class="dfu-table-hidden-content" style="display: none;">
                                    <div class="dfu-table-hidden-content-inner">
                                        <div class="dfu-content-heading">
                                            <p class="dfu-hidden-content-title">
                                                "<?php esc_html_e($dfuTableData->form_display_name); ?>" Options </p>
                                            <span class="dashicons dashicons-no-alt dfu-table-hidden-content-close"></span>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="dfu-content-inner">
                                                <table style="width: 100%; background: #0073aa;">
                                                    <tr style=" color: #fff;">
                                                        <td class="cell-1"><label class="table-label">Table Name
                                                                : </label></td>
                                                        <td class="cell-2"><?php esc_html_e($dfuTableData->form_display_name); ?></td>
                                                        <td class="cell-3 dfu-cell-append">
                                                            <button type="button" class="change-table-info"><span
                                                                        class="dashicons dashicons-edit"></span> Edit
                                                            </button>
                                                            <button type="button" class="delete-table-info"
                                                                    data-table="<?php esc_html_e($dfuTableData->form_post_id); ?>"
                                                                    data-wpnonce="<?php echo wp_create_nonce('dfu-validate-table-delete'); ?>">
                                                                <span class="dashicons dashicons-trash"></span> Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table style="width: 100%;">
                                                    <?php
                                                    if ($dfuTableData->status == 'Active') {
                                                        $fieldNameArr = explode(',', rtrim($dfuTableData->table_columns_name, ','));
                                                        $count = 0;
                                                        $countIndex = -1;
                                                        foreach ($fieldNameArr as $value) {
                                                            $count++;
                                                            $countIndex++;
                                                            ?>
                                                            <tr>
                                                                <td class="cell-1"><label
                                                                            class="column-label">Column <?php echo $count; ?>
                                                                        : </label></td>
                                                                <td class="cell-2 column-cell"><?php esc_html_e($value); ?></td>
                                                                <td class="cell-3 dfu-cell-append">
                                                                    <button type="button" class="change-column-info">
                                                                        <span class="dashicons dashicons-edit"></span>
                                                                        Edit
                                                                    </button>
                                                                    <?php
                                                                    if (count($fieldNameArr) > 1) { ?>
                                                                        <button type="button" class="delete-column-info"
                                                                                data-columnindex="<?php echo $countIndex; ?>"
                                                                                data-table="<?php esc_html_e($dfuTableData->form_post_id); ?>"
                                                                                data-wpnonce="<?php echo wp_create_nonce('dfu-validate-column-delete'); ?>">
                                                                            <span class="dashicons dashicons-trash"></span>
                                                                            Delete
                                                                        </button>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<center><p style="color:red;">The form in this data table has been deleted!</p></center>';
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                            <div class="dfu-column-save-button">
                                                <button type="button" class="export-xls button-secondary"
                                                        data-table="<?php esc_html_e($dfuTableData->form_post_id); ?>"
                                                        data-wpnonce="<?php echo wp_create_nonce('dfu-validate-xls-download'); ?>">
                                                    <span class="dashicons dashicons-download"></span> Export CSV
                                                </button>
                                                <button type="button"
                                                        data-table="<?php esc_html_e($dfuTableData->form_post_id); ?>"
                                                        data-wpnonce="<?php echo wp_create_nonce('dfu-validate-column-update'); ?>"
                                                        class="save-column-name button-primary"><span
                                                            class="dashicons dashicons-yes-alt"></span> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            } else {
                                $dfuAllTable->prepare_items();
                                $dfuAllTable->display();
                            }
                        }
                        ?>
                    </div>

                    <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
                            <?php
                            $checkedData = $wpdb->get_var("SELECT COUNT(id) FROM $table_name  WHERE table_columns_name != ''");
                            if ($checkedData > 0) { ?>
                                <div id="informationdiv" class="postbox dfu-form-list-heading">
                                    <h3>All Form Table(s)</h3>
                                    <div class="inside">
                                        <div class="dfu-all-form-list">
                                            <?php
                                            $dfugetCurrentrow = $wpdb->get_row("SELECT form_post_id FROM $table_name WHERE table_columns_name != ''");
                                            if (!isset($_GET['datatable'])) {
                                                $dataTableFound = intval($dfugetCurrentrow->form_post_id);
                                            } else {
                                                $dataTableFound = intval($_GET['datatable']);
                                            }
                                            $dfuTable = $wpdb->get_results("SELECT form_post_id, form_display_name FROM $table_name WHERE table_columns_name != ''");
                                            ?>
                                            <ul>
                                                <?php
                                                $count = 0;
                                                foreach ($dfuTable as $value) {
                                                    $count++;
                                                    if ($dataTableFound == $value->form_post_id) {
                                                        echo '<li><a class="active" href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?page=tiger-forms-all-inserted-data&datatable=' . $value->form_post_id . '">' . $value->form_display_name . '</a></li>';
                                                    } else {
                                                        echo '<li><a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?page=tiger-forms-all-inserted-data&datatable=' . $value->form_post_id . '">' . $value->form_display_name . '</a></li>';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div id="informationdiv" class="postbox">
                                <h3>Do you need help?</h3>
                                <div class="inside">
                                    <p>Here are some available options to help solve your problems.</p>
                                    <ol>
                                        <li><a href="https://wordpress.org/plugins/tiger-form/" target="_blank">FAQ</a>
                                            and <a href="https://wordpress.org/plugins/tiger-form/"
                                                   target="_blank">docs</a></li>
                                        <li>Developer Support: <a href="mailto:jakirhosen@yahoo.com">jakirhosen@yahoo.com</a>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div id="informationdiv" class="postbox">
                                <h3>Developer Info</h3>
                                <div class="inside">
                                    <center>
                                        <h2>MD. Jakir Hosen</h2>
                                        <span>Dhaka, Bangladesh.
                                        <center>
                                            <a href="https://www.linkedin.com/in/jakir-rony/"
                                               target="_blank">More info</a>
                                        </center>
                                        </span>
                                        <p><a href="mailto:jakirhosen@yahoo.com">Donate</a> to more better update.</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dfu-hidden-export-operation">
            <div class="export-loader">
                <img src="<?php echo plugin_dir_url(tiger_form_insert_form_ultimate_plugin) . 'inc/image/dfu-spinner.gif'; ?>"
                     class="dfu-export-loader">
            </div>
            <div class="dfu-export-table-append" style="display: none;">

            </div>
        </div>
        <?php
    }
}