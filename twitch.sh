#!/usr/bin/env bash

#curl -H 'Accept: application/vnd.twitchtv.v5+json' \
#-H 'Client-ID: 2f7bx36piv2sps61hnbloh7b0huorb' \
#-X GET 'https://api.twitch.tv/kraken/search/games?query=tibia'

curl -H 'Client-ID: 2f7bx36piv2sps61hnbloh7b0huorb' \
-X GET 'https://api.twitch.tv/helix/streams?game_id=19619'

#Tibia ID: 19619?
