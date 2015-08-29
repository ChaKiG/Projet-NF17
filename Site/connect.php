<?php
function dbConnect(){
	$vHost = 'localhost';
	$vDbName = 'nf17';
    $vCharset = 'utf8';
	$vUser = 'root';
	$vPassword = '';
	return new PDO("mysql:host=$vHost;dbname=$vDbName;charset=$vCharset", $vUser, $vPassword);
}
?>
