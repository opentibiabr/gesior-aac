<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 07/05/2018
 * Time: 01:37
*/

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 5, 'usec' => 0));
socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 5, 'usec' => 0));
$buf = chr(6) . chr(0) . chr(255) . chr(255) . 'info';
socket_connect($socket, 'ferobraglobal.com', 7171);
$w = socket_write($socket, chr(6) . chr(0) . chr(255) . chr(255) . 'info');
//$r = socket_recv($socket, $buf, 1024, MSG_WAITALL);
$r = socket_read($socket, 1024);

socket_close($socket);
//socket_bind($socket, '138.197.145.28');
//socket_listen($socket);
$xml = simplexml_load_string($r);
// converting to JSON
$json = json_encode($xml);
$array = json_decode($json, true);
var_dump($json);
var_dump($w, $r);
