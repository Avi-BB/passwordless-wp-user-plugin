<?php
if(isset($_POST['submit']))
{
	global $wpdb;
	$table = $wpdb->prefix . 'passwordlesstable';
	$charset_collate = $wpdb->get_charset_collate();
	$query =  "CREATE TABLE IF NOT EXISTS  ".$table." (
            base_url varchar(255) ,
            client_id VARCHAR(255),
            re VARCHAR(255),
            lo VARCHAR(255),
            path VARCHAR(255)
            );";
	echo $query;
	echo '<script>alert("Created")</script>';
	echo $wpdb->query( $query );
}

?>
<h3>Using the Plugin</h3>
<h4 class="description">There are 2 was to use the plugins: </h4>
<p class="description"><strong>1. Generate Login or Registration pages.</strong></p>
<p>
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
	<?php
	wp_nonce_field("loginid_dw_settings_group-options");
	?>
	<input type="hidden" name="action" value="loginid_dw_generate_page">
	<input type="submit" name="submit" class="button button-secondary" value="Generate Login Page">
	<input type="submit" name="submit" class="button button-secondary" value="Generate Register Page">
</form>
</p>
<p class="description">
	<strong>
		2. If above option not working, Apply shortcodes to your existing Login & Registration pages. Please avoid putting this form in modals.
	</strong>
</p>

 
<p class="description">
	<strong>Login Form Shortcode</strong>
	<code>[passwordless-login]</code>
</p>
<p class="description">
	<strong>Register Form Shortcode</strong>
	<code>[passwordless-register]</code>
</p>

<p class="description">
	<strong style="color: red">Note: If your site is not running on localhost, make sure to have TLS enabled.</strong>
</p>


