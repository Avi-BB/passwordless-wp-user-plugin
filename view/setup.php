<!-- stylesheet file -->
<link rel="stylesheet" href="../css/style.css">
<!-- javascript file -->
<script src="../js/script.js"></script>

<?php

 global $wpdb;
$sql = "SELECT * FROM wp_passwordlesstable";
$results = $wpdb->get_results($sql);
$base ;
    foreach( $results as $result ) {

         $base = $result->base_url;
		 $client = $result->client_id;
		 $re = $result->re;
		 $lo = $result->lo;
		 $path = $result->path;
		 $old = $result->client_id;

    }
?>
<?php
// require_once('../../../../wp-config.php');
if(isset($_POST['submit'])){	
	$table_name = $wpdb->prefix.'passwordlesstable';
	$data_update = array('base_url' => $_POST['baseUrl'] ,'client_id' => $_POST['clientId'] ,'lo' => $_POST['lo'] ,'re' => $_POST['re'] ,'path' => $_POST['pa']);
	$data_where = array('client_id' => $old);
	echo $wpdb->update($table_name , $data_update, $data_where);	
}

if(isset($_POST['submit2'])){
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
	$data = array('base_url' => 'No Data', 'client_id' => 'no data', 're' => 'no data', 'lo' => 'no data', 'path' => '/wp-content/plugin');
	$format = array('%s','%d');
	$wpdb->insert($table,$data,$format);
	$my_id = $wpdb->insert_id;
	echo $my_id;
}

?>

<p>Click the following button to create required tables in database</p> 
<strong>Note:- Need To create table for first time only....</strong> 
<form method="POST">
<input type = "submit" name="submit2" value = "Create"> 
</form>

<div class="wrap">
		<h1>Passwordless Plugin</h1>
		<form method="POST">
			<label>Enter Base Url :- </label> <br>
            <input type="url" id="baseUrl" name="baseUrl" placeholder="Enter Base Url" value="<?php echo $base?>"/>
			<br>
	<br>
			<label>Enter Client Id :- </label> <br>
            <input type="text"  id="clientId" name="clientId" placeholder="Enter Client Id" value="<?php echo $client?>"/>
			<br>
	<br>
			<label>Enter Redirect Url after Login :- </label> <br>
            <input type="url"  id="lo" name="lo" placeholder="Enter Redirect Url after Login" value="<?php echo $lo?>" /> 
			<br>
	<br>
			<label>Enter Redirect Url after Registration :- </label> <br>
            <input type="url"  id="re" name="re" placeholder="Enter Redirect Url after Registration" value="<?php echo $re?>" />
			<br>
	<br>
			<label>Enter plugin Path :- </label> <br>
            <input type="text"  id="pa" name="pa" placeholder="Enter plugin Path" value="<?php echo $path?>" />
			<br><br>
           <input type="submit" value="submit" name="submit">
        </form>




		<script>


</script>

	</div>
