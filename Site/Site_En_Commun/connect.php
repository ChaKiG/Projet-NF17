<?php
function fConnect(){
	$vHost = 'localhost';
	$vPort = '5432';
	$vDbName = 'postgres';
	$vUser = 'postgres';
	$vPassword = 'postgres';
	return pg_connect("host=$vHost port=$vPort dbname=$vDbName user=$vUser password=$vPassword");
}
?>
