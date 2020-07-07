$(document).ready(function() {

	/*
		@author: github.com/lucaswiix
		@face: fb.com/lucaswiix
	*/

	//console.log('started');

	/* Menu
		GameID:
			Tibia = 19619

	*/
	const GLOBAL_channels = [
		'rodrigobugado',
		'nattank',
		// 'jhvshow',
		// 'rafawarking',
		// 'maykinboo',
		// 'monoillaoi',
		// 'nogu3',
		// 'larmee2k',
		// 'calixto_rp',
		// 'gamefeh',
		// 'andersonk09',
		// 'zobera',
		// 'feratk',
		// 'kradzerah',
		// 'mrijack',
		// 'azrei_',
		// 'nycolllasdias',
		// 'bombersh',
		// 'gustaveiratibiano',
		// 'dii_soul',
		// 'lakizera',
		// 'guharantes',
		// 'skayfoxed',
		// 'juba_fps',
		// 'xadless',
		// 'rubini',
		// 'nattank',
		// 'jardineiroxd',
		// 'chaoszinhow',
		// 'astroboytv',
		// 'geo_mhz',
		// 'mainrivenzrush',
		// 'orocca',
		// 'joaquim10',
		// 'storiouxx',
		// 'lmahalinho',
		// 'etinhow',
		// 'leandrosoul',
		// 'nedrox22',
		// 'horadoruush',
		// 'pdrzerah',
		// 'galhard9',
		// 'caiamniegy',
		// 'antoniohere',
		// 'brenogreghi',
		// 'collykeitelgamer',
		// 'motoboynosgames',
		// 'mrdeds',
		// 'cu7idorush',
		// 'rvolpiani',
		// 'buozzi',
		// 'terykzot',
		// 'valonne1',
		// 'roytts',
		// 'noobiano',
		// 'uide',
	];
	const GLOBAL_title = "www.otserv.com";
	const GLOBAL_title2 = "otserv.com";
	const GLOBAL_title3 = "!otserv";
	const GLOBAL_title4 = "otserv";
	const GLOBAL_title5 = "otservbr-global";
	const GLOBAL_gameID = "19619";

	//  FIM MENU

	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires=" + d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/"
	}

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1)
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length)
			}
		}
		return ""
	}
	var a = [];
	var c = [];
	var l;
	var t = c.length;
	var state = 1;

	function expand() {
		$(".live_popup").animate({
			right: 0
		}, 500);
		$("#live_btn").html('<i class="fa fa-chevron-right" aria-hidden="true"></i>');
		state = 1
	}

	function hide(ct) {
		$(".live_popup").animate({
			right: -(ct * 130 + 60 - 50)
		}, 500);
		$("#live_btn").html('<i class="fa fa-chevron-left" aria-hidden="true"></i>');
		state = 0
	}

	function show() {
		if (a.length == 0) return false;

		var t = a.length;
		var ct = a.length;

		for (let l = 0; l < t; l++) {
			let status = a[l].title.toLowerCase();
			if (a[l].game_id != GLOBAL_gameID || (status.indexOf(GLOBAL_title.toLowerCase()) == -1 && status.indexOf(GLOBAL_title2.toLowerCase()) == -1 && status.indexOf(GLOBAL_title3.toLowerCase()) == -1 && status.indexOf(GLOBAL_title4.toLowerCase()) == -1 && status.indexOf(GLOBAL_title5.toLowerCase()) == -1)) {
				 ct--;
			}
		}
		 if(!ct || ct == 0 ) return false;
		$("body").append('<div class="live_popup"><div id="live_btn"></div><div id="live_popup_ch"></div></div>');
		$(".live_popup").css({
			right: -(ct * 130 + 100),
			width: ct* 130 + 60
		});
		var total = a.length;
		for (let i = 0; i < total; i++) {
			let c = a[i];
			let status = a[i].title.toLowerCase();
			console.log('title: ', status);
			if (c.game_id != GLOBAL_gameID || (status.indexOf(GLOBAL_title.toLowerCase()) == -1 && status.indexOf(GLOBAL_title2.toLowerCase()) == -1 && status.indexOf(GLOBAL_title3.toLowerCase()) == -1 && status.indexOf(GLOBAL_title4.toLowerCase()) == -1 && status.indexOf(GLOBAL_title5.toLowerCase()) == -1)) continue;
			$("#live_popup_ch").append(`<a href="https://twitch.tv/${c.user_name}" target="_blank" title="${c.user_name}"><span class="angled-img"><div class="img"><img src="https://static-cdn.jtvnw.net/previews-ttv/live_user_${c.user_name.toLowerCase()}-124x70.jpg" alt="${c.title}"></div></span></div></a>`);
		}
		setTimeout(function() {
			var c = getCookie("live_btn");
			if (c !== "0") {
				if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
					hide(ct)
				} else {
					expand()
				}
			} else hide(ct)
		}, 3000);
		$("#live_btn").click(function() {
			if (state) hide(ct);
			else expand();
			setCookie("live_btn", state, 7)
		})
	}

	function check() {
		let ch = "";
		GLOBAL_channels.forEach((c, i) => i == 0 ? ch = c : ch+=`&user_login=${c}`);
		$.ajax({
			url: "https://api.twitch.tv/helix/streams?user_login=" + ch,
			dataType: 'json',
			headers: {
				'Authorization': 'Bearer 9azzd4w3gs4v8szi00x8fyxwmll7u8',
				'Client-ID': '9azzd4w3gs4v8szi00x8fyxwmll7u8'
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				 console.log("Status: " + textStatus); console.log("Error: " + errorThrown);
			},
			success: function(channel) {
				console.log('running...');
				if (channel.data.length < 1) return;
				a = channel.data;
			},
			complete: function() {
				show();
			}
		})
	}
	check();
});
