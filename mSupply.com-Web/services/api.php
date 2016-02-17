<?php
	set_time_limit(0);
	if (file_exists('../app/etc/local.xml')) {
		$xml = simplexml_load_file('../app/etc/local.xml');
		$host = $xml->global->resources->default_setup->connection->host;
		$username = $xml->global->resources->default_setup->connection->username;
		$password = $xml->global->resources->default_setup->connection->password;
		$dbname = $xml->global->resources->default_setup->connection->dbname;
		$msqlConnect = mysql_connect($host,$username,$password);
		mysql_select_db($dbname,$msqlConnect);
    } else {
		exit('Failed to open local.xml.');
	}
	include('vendorskus.php');
	include('images.php');
	include('customerMail.php');
	include('orderEmail.php');
	$data = $_REQUEST;
	$method = $data['method'];
	unset($data['method']);
	echo json_encode($method($data),true);
?>
