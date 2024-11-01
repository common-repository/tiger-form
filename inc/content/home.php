<?php
function tiger_form_data_insert_form_ultimate_plugin_page_content() {
    global $tiger_form_materials;
    if( !current_user_can('administrator') ) {
        echo '<h1>You have no permission to access this page.</h1>';
        return;
    } else {
        if(isset($_GET['actions']) && isset($_GET['post'])) {
            require_once $tiger_form_materials->tiger_form_plugin_dir_path('inc/content/edit-form.php');
        } else {
        ?>
            <div class="wrap">
                <h1 class="wp-heading-inline"><?php esc_html_e(get_admin_page_title()); ?></h1> <a href="admin.php?page=tiger-forms-add-new" class=" page-title-action">Add New</a>
                <div class="dfu-custom-notice">
                    <div class="dfu-table-notice-portion">
                        <p>Copy below shortcode and paste it on your post, page or text widget content. For PHP code snippet, copy below shortcode then put it inside <span style="font-family: monospace; font-style: italic; font-weight: bold;">do_shortcode(); Ex. echo do_shortcode(&#39;[tiger-form id="1" title="Tiger Form"]&#39;);</span> and place it into your themes.</p>
                    </div>
                    <div class="dfu-notice-quit">
                        <span style="text-align: right;" class="dashicons dashicons-dismiss"></span>
                    </div>
                </div>
                <hr class="wp-header-end">
                <?php
                if( get_transient( 'dfu-form-delete-success' ) ) {
                ?>
                    <div class="notice notice-success is-dismissible">
                        <p>Form deleted successfully.</p>
                    </div>
                    <?php
                    delete_transient( 'dfu-form-delete-success' );
                }

                $myListTable = new tiger_form_data_table();
                if(isset($_GET['page']) && isset($_GET['s'])) {
                    $myListTable->prepare_items(sanitize_text_field( $_GET['s'] ));
                    if(!empty(sanitize_text_field($_GET['s']))) {
                    ?>
                        <div class="notice notice-info is-dismissible">
                            <p><?php _e( 'Serach result for "' ); ?><strong><?php echo esc_html( $_GET['s'] ).'"'; ?></strong></p>
                        </div>
                    <?php
                    }
                } else {
                    $myListTable->prepare_items();
                }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?page=tiger-forms'; ?>" method="GET">
                    <input type="hidden" name="page" value="<?php echo esc_html($_REQUEST['page']); ?>" />
                    <?php $myListTable->search_box('Search Form', 'search_post_id'); ?>
                </form>
                <form action="" method="GET">
                    <input type="hidden" name="page" value="<?php echo esc_html( $_REQUEST['page'] ); ?>" />
                    <?php
                    $myListTable->display();
                    ?>
                </form>
            </div>
        <?php
        }
    }
}