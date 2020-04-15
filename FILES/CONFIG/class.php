<?php
	/* Declare Class Object */
	$loader = new Core();
	$connection = new Connection();
	$connection->connectDB();
	$handler = new handler();
	$dbcon->status = $connection->MySQL->Connection;
	$dbcon->error = $connection->MySQL->Error;
?>