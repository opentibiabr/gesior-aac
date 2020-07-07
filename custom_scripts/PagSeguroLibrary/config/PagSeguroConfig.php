<?php
require_once 'config/config.php';
/*
 ************************************************************************
 PagSeguro Config File
 ************************************************************************
 */

/**
 * PAGSEGURO WORKING
 * FIXED BY RICARDO SOUZA
 * http://codenome.com
 */
$PagSeguroConfig = array();
if ($config['pagseguro']['testing'] === true) {
	$PagSeguroConfig['environment'] = "sandbox"; // production, sandbox
} else {
	$PagSeguroConfig['environment'] = "production"; // production, sandbox
}


$PagSeguroConfig['credentials'] = array();
$PagSeguroConfig['credentials']['email'] = $config['pagseguro']['email'];
$PagSeguroConfig['credentials']['token']['production'] = $config['pagseguro']['token'];
$PagSeguroConfig['credentials']['token']['sandbox'] = $config['pagseguro']['tokentest'];

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = false;
$PagSeguroConfig['log']['fileLocation'] = "";
