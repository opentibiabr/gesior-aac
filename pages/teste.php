<?php

if (!extension_loaded('sockets')) {
    die('The sockets extension is not loaded.');
}
/** agora eu reaprendo branch */

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 5, 'usec' => 0));
socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 5, 'usec' => 0));
$buf = chr(6) . chr(0) . chr(255) . chr(255) . 'info';
socket_connect($socket, 'on.aurera-global.com', 7171);
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
// function createEvent($event, $time)
// {
// 	$ev = array(
// 		'startdate' => $event->getBeginTime($time),
// 		'enddate' => $event->getEndTime($time),
// 		'colorlight' => $event->getColorLight(),
// 		'colordark' => $event->getColorDark(),
// 		'name' => $event->getName(),
// 		'description' => $event->getDescription(),
// 		'isseasonal' => $event->isSeasonal()
// 	);

// 	return $ev;
// }
// 	$campaign = array();
// 	$time = time();
// 	$increment = 24*60*60;
// 	$max = 30;

//     $path = Website::getWebsiteConfig()->getValue('serverPath');
//     $events = new Events($path . 'data/XML/events.xml');

// 		for ($z = 1; $z <= $events->count(); $z++) {
// 			$event = $events->getEvent($z);
// 			$time = time();
// 			if ($event->getDay() !== 8) {
// 				for ($i = 1; $i <= $max; $i++) {
// 					$diasemana_numero = date('w', $time);
// 					if ($event->getDay() !== 8 && $event->getDay() == $diasemana_numero) {
// 						$campaign[] = createEvent($event, $time);
// 					}
// 					$time += $increment;
// 				}
// 			} else {
// 				$campaign[] = createEvent($event, $time);
// 			}
// 		}

// var_dump($campaign);