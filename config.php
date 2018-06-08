<?php
require 'environment.php';

global $config;
global $conn;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/Projects/PHPZP/_Projetos/Loja_Virtual/");
	$config['dbname'] = 'lojavirtual';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", '');
	$config['dbname'] = '';
	$config['host'] = '';
	$config['dbuser'] = '';
	$config['dbpass'] = '';
}

$config['default_lang'] = 'pt-br';
$config['cep_origin'] = '20071904';

// Informações do paypal
$config['paypalClientId'] = '';
$config['paypalSecret'] = '';

$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
