<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
$getPath = rtrim(plugin_dir_path(__FILE__), '\inc/') . '/';
$operate_path = path_join($getPath,'inc/tiger-classes/plugin-operate.php');

require_once $operate_path;

$tiger_form_operation = new tiger_form_ultimate\plugin_operate();

$tiger_form_operation->uninstall();

?>