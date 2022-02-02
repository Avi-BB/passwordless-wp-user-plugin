<?php

/**
 * Plugin Name: Passowrdless Auth
 * Plugin URI: http://passwordless.com.au
 * Description: Provides any user the option to login without a password
 * Author: https://www.passwordless.com.au
 * Author URI: http://passwordless.com.au
 * Version: 1.0.0
 
 */

 //constants
 define ("PLUGIN_DIR_PATH" , plugin_dir_path(__FILE__));
 define ("PLUGIN_URL" , plugins_url());



 
function add_my_custom_menu()
{
  add_menu_page(
    "customplugin",//page title
    "Passwordless Auth",//menu title
    "manage_options",//admin level
    "custom-plugin1",//page slug
    "custom_admin_view",//callback function
    "dashicons-admin-network",//icon url
    "14"//position
  );
  add_submenu_page(
    "custom-plugin1",//parent slug
    "SetUp",//page title
    "SetUp",//menu title
    "manage_options",//capability=user_level access
    "custom-plugin1",//menu-slug
    "custom_admin_view",//callback function
  );
  add_submenu_page(
    "custom-plugin1",//parent slug
    "Pages",//page title
    "Pages",//menu title
    "manage_options",//capability=user_level access
    "pages",//menu-slug
    "add_new_function2",//callback function
   
  );

  
}
add_action("admin_menu", "add_my_custom_menu");




function custom_admin_view()
{
  include_once PLUGIN_DIR_PATH."./view/setup.php";
 
}
function add_new_function2()
{
  include_once PLUGIN_DIR_PATH."./view/pages.php";
}


add_shortcode ("passwordless-login" , "passwordless_login_function");

function passwordless_login_function()
{
  include_once PLUGIN_DIR_PATH.'./shortcode/loginShortcode/loginShortcode.php';
  
}
add_shortcode ("passwordless-register" , "passwordless_register_function");

function passwordless_register_function()
{
  include_once PLUGIN_DIR_PATH. './shortcode/registerShortcode/registerShortcode.php';
  
}

