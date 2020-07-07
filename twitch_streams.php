<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 01/05/2018
 * Time: 15:26
 */

if (Website::getWebsiteConfig()->getValue('info_bar_twitch')) {

	$url = "https://api.twitch.tv/helix/streams?first=100&game_id=19619";

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Client-ID: 2f7bx36piv2sps61hnbloh7b0huorb'));
	curl_setopt($curl, CURLOPT_POST, false);
	//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

	$json = curl_exec($curl);
	curl_close($curl);

	$t = json_decode($json);

	$twitch_c = 0;
	$twitch_a = 0;
	if ($t->data) {
		foreach ($t->data as $twitch) {
			$twitch_a++;
			$twitch_c = $twitch_c + $twitch->viewer_count;
			if ($twitch_a == 100) {
				$twitch_b = "";
				$url = "https://api.twitch.tv/helix/streams?first=100&game_id=19619&after={$t->pagination->cursor}";
				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Client-ID: 2f7bx36piv2sps61hnbloh7b0huorb'));
				curl_setopt($curl, CURLOPT_POST, false);
				$json = curl_exec($curl);
				curl_close($curl);
				$t = json_decode($json);
				foreach ($t->data as $tw) {
					$twitch_a++;
					$twitch_c = $twitch_c + $tw->viewer_count;
				}
			}
		}
	}
}
