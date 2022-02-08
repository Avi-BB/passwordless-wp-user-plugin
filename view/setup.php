<!-- stylesheet file -->
<link rel="stylesheet" href="../css/style.css">
<!-- javascript file -->
<style>
	.wrap {
		background-color: white;
		width: fit-content;
		padding: 2rem;
		box-shadow: 0 0 5px #ccc;
		border-radius: 0.2rem;

	}

	.wrap-cnd {
		background-color: white;
		width: fit-content;
		padding: 0.3rem 1rem;
		box-shadow: 0 0 5px #ccc;
		border-radius: 0.2rem;
		margin-top: 1rem;
	}

	.form-container {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: flex-end;
	}

	.text-field-container {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: flex-start;
		margin: 0.3rem 0.5rem;
	}

	label {
		color: black;
		font-weight: bold;
		font-size: 0.9rem;
	}

	.input {
		text-overflow: ellipsis;
		width: 20rem;
		height: 2rem;
		
	}

	#submit-btn {
		background-color: #00a0d2;
		color: white;
		border: none;
		border-radius: 0.2rem;
		padding: 0.4rem 0.9rem;
		font-size: 1rem;
		cursor: pointer;
		margin-top: 1rem;
	}
</style>
<?php

global $wpdb, $old;
$sql = "SELECT * FROM wp_passwordlesstable";
$results = $wpdb->get_results($sql);
$base;
foreach ($results as $result) {

	$base = $result->base_url;
	$client = $result->client_id;
	$re = $result->re;
	$lo = $result->lo;
	
	$old = $result->client_id;
}
?>
<?php
// require_once('../../../../wp-config.php');
if (isset($_POST['submit'])) {
	$table_name = $wpdb->prefix . 'passwordlesstable';
	$data_update = array('base_url' => $_POST['baseUrl'], 'client_id' => $_POST['clientId'], 'lo' => $_POST['lo'], 're' => $_POST['re']);
	$data_where = array('client_id' => $old);
	$format = array( '%s',  '%s', '%s', '%s');

	// echo $wpdb->insert($table_name, $data_update, $data_where);
	$success=$wpdb->insert( $table_name, $data_update, $format);
	if($success){
		echo '<script>window.location.reload();</script>';
	
	} else {
		echo '<script>alert("Data not saved")</script>';
	}
}

if (isset($_POST['submit2'])) {
	global $wpdb;
	$table = $wpdb->prefix . 'passwordlesstable';
	$charset_collate = $wpdb->get_charset_collate();
	$query =  "CREATE TABLE IF NOT EXISTS  " . $table . " (
            base_url varchar(255) ,
            client_id VARCHAR(255),
            re VARCHAR(255),
            lo VARCHAR(255),
        
            );";
	echo $query;
	echo '<script>alert("Created")</script>';
	echo $wpdb->query($query);
	$data = array('base_url' => 'No Data', 'client_id' => 'no data', 're' => 'no data', 'lo' => 'no data');
	$format = array('%s', '%d');
	$wpdb->insert($table, $data, $format);
	$my_id = $wpdb->insert_id;
	echo $my_id;
}

?>

<div class="wrap-cnd">
	<h3>Get your passwordless credentials: <a href="https://www.passwordless.com.au" alt="passwordless" target="_blank" noreffer>passwordless.com.au</a></h3>
</div>
<div class="wrap">
	<h1 style="text-align: center; color:#00a0d2;">Passwordless Configuration</h1>
	<form method="POST">
		<div class="form-container">
			<div class="text-field-container">
				<label>Enter Base URL </label>
				<input class="input" type="url" id="baseUrl" name="baseUrl" placeholder="Enter Base Url" value="<?php echo $base ?>" />
			</div>

			<div class="text-field-container">
				<label>Enter Client Id </label>
				<input class="input" type="text" id="clientId" name="clientId" placeholder="Enter Client Id" value="<?php echo $client ?>" />
			</div>
		</div>

		<div class="form-container">
			<div class="text-field-container">
				<label>Enter Redirect URL after Login </label>
				<input class="input" type="url" id="lo" name="lo" placeholder="Enter Redirect Url after Login" value="<?php echo $lo ?>" />
			</div>

			<div class="text-field-container">

				<label>Enter Redirect URL after Registration </label>
				<input class="input" type="url" id="re" name="re" placeholder="Enter Redirect Url after Registration" value="<?php echo $re ?>" />
			</div>
		</div>
		<div style="text-align:center">
		<input id="submit-btn" type="submit" value="submit" name="submit">
		</div>
	</form>




	<script>


	</script>

</div>