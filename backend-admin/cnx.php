<?php
$dsn = 'mysql:host=localhost;dbname=keviqffq_realisations;charset=utf8';
$user = 'keviqffq_kevin';
$pass = 'kevinportfolio';
try {
	$cnx = new PDO($dsn,$user,$pass);
} catch(PDOException $e) {
	echo 'erreur de connexion à la base de données.';
}