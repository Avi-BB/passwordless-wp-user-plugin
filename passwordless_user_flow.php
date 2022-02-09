<?php

function pl_user_enqueue_css_js()
{
    wp_enqueue_script('pwl-sdk', plugin_dir_url(__FILE__) . 'Scripts/passwordless-bb.js', null, null, false);
    wp_enqueue_script('detect', plugin_dir_url(__FILE__) . 'Scripts/detect.js', null, null, false);
    wp_enqueue_script('mainjs', plugin_dir_url(__FILE__) . 'Scripts/main.js', null, null, true);
}

add_action('wp_enqueue_scripts', 'pl_user_enqueue_css_js');

function pl_user_custom_permalinks()
{
    global $wp_rewrite;
    $wp_rewrite->page_structure = $wp_rewrite->root . '%pagename%'; // custom page permalinks
    $wp_rewrite->set_permalink_structure($wp_rewrite->root . '%postname%'); // custom post permalinks
}


function pl_user_login_function()
{
    include_once PLUGIN_DIR_PATH . './template/pl_login_user.php';
}

function pl_user_register_function()
{
    include_once PLUGIN_DIR_PATH . './template/pl_register_user.php';
}
function pl_user_remote_auth()
{
    include_once PLUGIN_DIR_PATH . './template/pl_remote_auth_user.php';
}



function index_test_001()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'passwordlesstable';
    $wpdb_collate = $wpdb->collate;
    $sql =
        "CREATE TABLE {$table_name} (
        base_url varchar(255) NULL,
        client_id varchar(255) NULL,
        re varchar(255) NULL,
        lo varchar(255) NULL,
        KEY base_url (base_url),
        KEY client_id (client_id),
        KEY re (re),
        KEY lo (lo)
        )
        COLLATE {$wpdb_collate}";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    
}
function add_base_data(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'passwordlesstable';
	$data = array('base_url' => 'No Data', 'client_id' => 'no data', 're' => 'no data', 'lo' => 'no data');
	$format = array( '%s',  '%s', '%s', '%s');
    $wpdb->insert($table_name, $data, $format);
}
function plugin_activated()
{
    add_action('init', 'pl_user_custom_permalinks');
    add_action('init', 'index_test_001');
    add_shortcode("user-register", "pl_user_register_function");
    add_shortcode("user-login", "pl_user_login_function");
    add_shortcode('user-remote-auth', 'pl_user_remote_auth');
    add_shortcode('init', 'add_base_data');
    add_action('init', 'generate_pages');
    // add_action('init', 'scratchcode_create_payment_table');
}

function generate_pages()
{
    // Information needed for creating the plugin's pages
    $page_definitions = array(
        'user-login' => array(
            'title' => __('User login', 'personalize-login'),
            'content' => '[user-login]'
        ),
        'user-remote-authenticate' => array(
            'title' => __('User Remote Authentication', 'personalize-login'),
            'content' => '[user-remote-auth]'
        ),
        'user-register' => array(
            'title' => __('User Register', 'personalize-register'),
            'content' => '[user-register]'
        ),

    );

    foreach ($page_definitions as $slug => $page) {
        // Check that the page doesn't exist already
        $query = new WP_Query('pagename=' . $slug);
        if (!$query->have_posts()) {
            // Add the page using the data from the array above
            wp_insert_post(
                array(
                    'post_content'   => $page['content'],
                    'post_name'      => $slug,
                    'post_title'     => $page['title'],
                    'post_status'    => 'publish',
                    'post_type'      => 'page',
                    'ping_status'    => 'closed',
                    'comment_status' => 'closed',
                )
            );
        }
    }
}

plugin_activated();
