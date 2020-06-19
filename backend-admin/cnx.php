<?php
$dsn = 'mysql:host=localhost;dbname=mydb;charset=utf8';
$user = 'login';
$pass = 'password';
try {
	$cnx = new PDO($dsn,$user,$pass);
} catch(PDOException $e) {
	echo 'erreur de connexion à la base de données.';
}