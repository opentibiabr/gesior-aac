#!/usr/bin/env bash
while [ true ]; do
	php -f sitemap.php >> sitemap.log;
	sleep 30;
done
