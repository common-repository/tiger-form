<?php
/**
 * Plugin Name:       Tiger Forms - Drag and Drop Form Builder
 * Plugin URI:        https://wordpress.org/plugins/tiger-form/
 * Description:       Multi-purpose forms builder, store data in database, and receive notifications via email. Export the submitted data from the admin panel to CSV format.
 * Version:           2.2.1
 * Requires at least: 4.6
 * Requires PHP:      5.6
 * Author:            MD Jakir Hosen
 * Author URI:        https://www.linkedin.com/in/jakir-rony/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path:       /languages/
 */


/*
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details. You should have received a copy of the GNU
 * General Public License along with this program; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA. Online: http://www.gnu.org/licenses/gpl-2.0.html;
 */


if (!defined('WPINC'))
    die;

if (!defined('ABSPATH'))
    exit;


const tiger_form_insert_form_ultimate_plugin = __FILE__;

require_once 'inc/tiger-classes/material.php';

$tiger_form_materials = new tiger_form_ultimate\tiger_form_material();

if (!defined('tiger_form_extended_file_include'))
    define('tiger_form_extended_file_include', $tiger_form_materials->extendedFilePath());

require_once $tiger_form_materials->tiger_form_function();

require_once $tiger_form_materials->tiger_form_plugin_dir_path(tiger_form_extended_file_include);

require_once $tiger_form_materials->tiger_form_plugin_dir_path(tiger_form_data_insert_form_ultimate_css);

require_once $tiger_form_materials->tiger_form_plugin_dir_path(tiger_form_data_insert_form_ultimate_menu);

require_once $tiger_form_materials->tiger_form_plugin_dir_path(tiger_form_data_table_export);

register_activation_hook(tiger_form_insert_form_ultimate_plugin, 'tiger_form_init_parent_table');

register_activation_hook(tiger_form_insert_form_ultimate_plugin, 'tiger_form_insert_first_row' );

require_once $tiger_form_materials->user_end_operation();

require_once $tiger_form_materials->tiger_form_plugin_dir_path(tiger_form_data_insert_form_ultimate_js);
?>
