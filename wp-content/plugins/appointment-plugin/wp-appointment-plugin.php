<?php
/*
	Plugin Name: Appointment Calender
	Plugin URI: https://google.co.in/
	Description: 201906100110032 and 201906100110018
	Author: Abhishek Choksi & Monis Pathan
	Author URI:  https://github.com/032AbhishekChoksi
    Text Domain: appointment-plugin
	Version: 1.0
*/
require_once 'helper_function.php';
require_once 'smtp/PHPMailerAutoload.php';
define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define("PLUGIN_URL", plugins_url());
define("PLUGIN_VERSION", "1.0");

function add_my_custom_menu()
{
    add_menu_page(
        "Appointment Calender", // page title
        "Appointment Calender", // menu title
        "manage_options", // admin level
        "appointment-view", // page slug
        "custom_admin_view", // call back function
        "dashicons-calendar-alt", // icon url
        11 // position
    );

    add_submenu_page(
        "appointment-view", // parent slug
        "All Appointment", // page title
        "All Appointment", // menu title
        "manage_options", // capability
        "appointment-view", // menu slug
        "custom_admin_view", //call back function
    );

    add_submenu_page(
        "appointment-view", // parent slug
        "Add New", // page title
        "Add New", // menu title
        "manage_options", // capability
        "add-new", // menu slug
        "add_new_function" //call back function
    );
}

add_action("admin_menu", "add_my_custom_menu");

function add_new_function()
{
    include_once PLUGIN_DIR_PATH . 'html/manage_appointment.php';
}

function custom_admin_view()
{
    include_once PLUGIN_DIR_PATH . 'html/view_appointment.php';
}

function custom_plugin_assets()
{
    wp_enqueue_style(
        'my_custom_style', // Unique name for css file
        PLUGIN_URL . '/appointment-plugin/assets/css/style.css', // css file location
        '', // dependency on other files
        PLUGIN_VERSION, //plugin version number
        'all'
    );
    wp_enqueue_script(
        'my_custom_script', // Unique name for js file
        PLUGIN_URL . '/appointment-plugin/assets/js/script.js', // js file location
        '', // dependency on other files
        PLUGIN_VERSION, //plugin version number
        false
    );
}

add_action("init", "custom_plugin_assets");

function custom_plugin_activate()
{
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix . 'appointment';
    $sql = "
	CREATE TABLE `$table` (
        `Event_ID` INT NOT NULL AUTO_INCREMENT,
        `Event_Name` VARCHAR(255) NOT NULL,
        `Event_Description` TEXT NOT NULL,
        `Event_Date` DATE NOT NULL,
        `Event_Time` TIME NOT NULL,
        `Event_Location` VARCHAR(255) NOT NULL,
        `Event_Organizer_Name` VARCHAR(255) NOT NULL,
        `Event_Organizer_Email` VARCHAR(255) NOT NULL,
        `Event_AddeOn` DATETIME NOT NULL,
        PRIMARY KEY (`Event_ID`)
      );
      
	";
    $wpdb->query($sql);
}
register_activation_hook(__FILE__, 'custom_plugin_activate');

function custom_plugin_deactivate()
{
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix . 'appointment';
    $sql = "drop table $table;";
    $wpdb->query($sql);
}
register_deactivation_hook(__FILE__, 'custom_plugin_deactivate');


// add_shortcode( string $tag, callable $callback )
add_shortcode('appointment_list_shortcode', 'custom_admin_view');
