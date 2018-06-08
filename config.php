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
$config['paypalClientId']='Afvqygw2zwGB-dDqldh7TpVHZtZEotNL1Lyu_EgHjJRb-DJpcYzprkCAUS5ogwp2rPUNI-UEbLTec5aH';
$config['paypalSecret']='EPTjyY0JwUcNyJxsNuEuDnzg9cDjZS4DwB_gtjs4OIXhrlFdadw8YOk-fT5IcYk562PwJ2SxsIqUR7wQ';

$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>