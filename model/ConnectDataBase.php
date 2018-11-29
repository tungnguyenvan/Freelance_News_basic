<?php 
	// define("DBSERVER", "localhost"); // trong php define là hằng số;
	// define("DBUSERNAME", "root");
	// define("DBPASSWORD", "");
	// define("DBNAME", "news");

	/**
	* các hàm kế nối đến database
	*/
	$connect = mysqli_connect("localhost", "root", "", "news");
	$connect->set_charset("UTF8");
	if (!$connect) {
	    die('Connect Error: ' . $connect->connect_errno);
	}

 ?>