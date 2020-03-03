<?php 
	$username = "uxn9325vqgromb0d";
	$password = "acqyS6yNc1q3RpEvFTP8";
	$hostname = "bixjqd5hmlmr4i0fnaft-mysql.services.clever-cloud.com";
	$database = "bixjqd5hmlmr4i0fnaft";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=$database;",$username,$password);
	} catch (PDOException $e) {
		die('Connection Failed:'.$e);
	}
?>

