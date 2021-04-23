<?PHP
if (!function_exists('is_https')) {
	function is_https()
	{
		if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
			return true;
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
			return true;
		} elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
			return true;
		}

		return false;
	}
}

$is_https = is_https();

if ($is_https) {
	$base_url = "https://" . $_SERVER['HTTP_HOST'];
	$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
} else {
	$base_url = "http://" . $_SERVER['HTTP_HOST'];
	$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
}

/** SERVER URLS */
/** @var array $config */
$config['base_url'] = $base_url;
$config['site']['base_url'] = $base_url;
$config['site']['realurl'] = "https:///"; // Put the real url for your website without www DO NOT FORGET FROM / AT THE END
$config['site']['realurlwww'] = "https:///"; // Put the real url for your website with www IF IT IS A SUBDOMINUM PUT THE MSM URL OF THE REAL URL
$config['site']['testurl'] = "http://localhost/"; // Put the url you use to test your site (LOCALHOST)
/** END SERVER URLS */


/** SERVER PATHS */
if ($config['base_url'] == $config['site']['realurl'] || $config['base_url'] == $config['site']['realurlwww']) {
	$config['site']['serverPath'] = "/path/server/"; // SERVER PATH IN PRODUCTION
} else {
	$config['site']['serverPath'] = "/path/server/"; // SERVERPATH LOCALHOST
}
/** END SERVER PATHS */


/** ENABLE SHOP */
$config['site']['shopEnabled'] = false;

$config['site']['start'] = 'Apr 07, 2020 18:00:00';


/** GOOGLE RECAPTCHA VALUES */
$config['site']['gRecaptchaSecret'] = "";
$config['site']['gRecaptchaSiteKey'] = "";

/** WIDGETS CONFIG */
$config['site']['widget_rank'] = true;
$config['site']['widget_supportButton'] = true;
$config['site']['widget_buycharButton'] = false;
$config['site']['widget_PremiumBox'] = true;
$config['site']['widget_Serverinfobox'] = false;
$config['site']['widget_Serverinfoboxfloat'] = true;
$config['site']['widget_NetworksBox'] = false;
$config['site']['widget_CurrentPollBox'] = false;
$config['site']['widget_CastleWarBox'] = false;
$config['site']['twoAuthentication2'] = true;

/** WIDGETS 'widget_rank' TOP LVL CONFIGS */
$config['site']['top_lvl_qtd'] = 5; // 1 -- 5
$config['site']['top_lvl_goku_isActive'] = true; // true - false
$config['site']['top_lvl_out_anim'] = true; // true - false

# Social Networks
$config['social']['status'] = true;
$config['social']['facebook'] = ""; // Link to your facebook page
$config['social']['discord'] = ""; // Link to your discord invite
$config['social']['fbapiversion'] = "";
$config['social']['fbapilink'] = "";
$config['social']['fbpageid'] = "";
$config['social']['accessToken'] = "";
$config['social']['twitter'] = "";
$config['social']['twittercreator'] = "";
$config['social']['fbappid'] = "";

# Using Ajax Field Validation, this is important if you want to use ajax check in your create account.
$config['site']['sqlHost'] = "localhost";
$config['site']['sqlUser'] = "root";
$config['site']['sqlPass'] = "";
$config['site']['sqlBD'] = "";

# Characters animatedOutfits php
$config['site']['animatedOutfits_url'] = 'http://127.0.0.1/AnimatedOutfits/animoutfit.php?';
$config['site']['outfit_images_url'] = 'http://127.0.0.1/AnimatedOutfits/outfit.php?';
$config['site']['icons_images_url'] = '/images/icons_damage/';
$config['site']['item_images_extension'] = '.png';
$config['site']['flag_images_url'] = '/images/flags/';
$config['site']['flag_images_extension'] = '.png';


# Config Shop
$outfits_list = array();
$loyalty_title = array(
	50 => 'Scout',
	100 => 'Sentinel',
	200 => 'Steward',
	400 => 'Warden',
	1000 => 'Squire',
	2000 => 'Warrior',
	3000 => 'Keeper',
	4000 => 'Guardian',
	5000 => 'Sage
'
);
$config['shop']['newitemdays'] = 1;

# Character Former name, time in days to show the former names
$config['site']['formerNames'] = 10;
$config['site']['formerNames_amount'] = 10;

# PAGE: characters.php
$config['site']['quests'] = array(
	"Demon Helmet" => 2213,
	"The Dream Courts" => 23000,
	"Pits Of Inferno" => 10544,
	"The Secret Library" => 22399,
	"The Annihilator" => 2215,
	"The First Dragon" => 14018,
	"Wrath Of The Emperor" => 12374
);

# PAGE: whoisonline.php
$config['site']['private-servlist.com_server_id'] = 0;

# Account Maker Config
$config['site']['encryptionType'] = 'sha1';
$config['site']['useServerConfigCache'] = false;
$towns_list = array(
	1 => 'Dawnport Tutorial',
	2 => 'Dawnport',
	3 => 'Rookgaard',
	4 => 'Island of Destiny',
	5 => 'Ab\'Dendriel',
	6 => 'Carlin',
	7 => 'Kazordoon',
	8 => 'Thais',
	9 => 'Venore',
	10 => 'Ankrahmun',
	11 => 'Edron',
	12 => 'Farmine',
	13 => 'Darashia',
	14 => 'Liberty Bay',
	15 => 'Port Hope',
	16 => 'Svargrond',
	17 => 'Yalahar',
	18 => 'Gray Beach',
	19 => 'Krailos',
	20 => 'Rathleton',
	21 => 'Roshamuul',
	22 => 'Issavi',
);
$vocations_list = [
	0 => "No Vocation",
	1 => "Sorcerer",
	2 => "Druid",
	3 => "Paladin",
	4 => "Knight",
	5 => "Master Sorcerer",
	6 => "Elder Druid",
	7 => "Royal Paladin",
	8 => "Elite Knight",
	10 => "ALL"
];
$highscores_list = [
	//		1 => "Achievements",
	2 => "Axe Fighting",
	3 => "Club Fighting",
	4 => "Distance Fighting",
	5 => "Experience Points",
	6 => "Fishing",
	7 => "First Fighting",
	//		8 => "Loyalty Points",
	9 => "Magic Level",
	10 => "Shielding",
	11 => "Sword Fighting"
];
# Create Account Options
$config['site']['one_email'] = true;
$config['site']['create_account_verify_mail'] = false;
$config['site']['verify_code'] = true;
$config['site']['email_days_to_change'] = 3;
$config['site']['newaccount_premdays'] = 10000;
$config['site']['send_register_email'] = true;
$config['site']['flash_client_enabled'] = false;

# Create Character Options
$config['site']['newchar_vocations'] = array(0 => 'Rook Sample');
$config['site']['newchar_towns'] = array(1);
$config['site']['max_players_per_account'] = 7;

# Emails Config
$config['site']['send_emails'] = false;
$config['site']['mail_address'] = "contato@gmail.com";
$config['site']['mail_senderName'] = "";
$config['site']['smtp_enabled'] = true;
$config['site']['smtp_host'] = "smtp.gmail.com";
$config['site']['smtp_port'] = 465;
$config['site']['smtp_auth'] = true;
$config['site']['smtp_user'] = "";
$config['site']['smtp_pass'] = "";
$config['site']['smtp_secure'] = true;

# PAGE: accountmanagement.php
$config['site']['send_mail_when_change_password'] = true;
$config['site']['send_mail_when_generate_reckey'] = true;
$config['site']['email_time_change'] = 7;
$config['site']['daystodelete'] = 7;

# PAGE: guilds.php
$config['site']['guild_need_level'] = 1;
$config['site']['guild_need_pacc'] = false;
$config['site']['guild_image_size_kb'] = 50;
$config['site']['guild_description_chars_limit'] = 2000;
$config['site']['guild_description_lines_limit'] = 6;
$config['site']['guild_motd_chars_limit'] = 250;

# PAGE: adminpanel.php
$config['site']['access_admin_panel'] = 3;
$config['site']['ticket_reply_access'] = 5;

# PAGE: latestnews.php
$config['site']['news_limit'] = 6;

# PAGE: killstatistics.php
$config['site']['last_deaths_limit'] = 40;

# PAGE: team.php
$config['site']['groups_support'] = array(2, 3, 4, 5, 6);

# PAGE: highscores.php INACTIVE
$config['site']['groups_hidden'] = array(3, 4, 5, 6);
$config['site']['accounts_hidden'] = array(1);

# PAGE: lostaccount.php
$config['site']['email_lai_sec_interval'] = 180;

/** LANDPAGE CONFIG */
$config['site']['landpage_isactive'] = true;
$config['site']['landpage_title'] = "";
$config['site']['landpage_timeout'] = 60 * 10080; // Time in seconds 1 * 60 = 1 minute
$config['site']['landpage_description'] = ""; // Type text here to appear on the landpage
$config['site']['landpage_max_notices'] = 3; // Maximum number of news items displayed on the landpage.
$config['site']['landpage_youtube'] = ""; // youtube video id


/** OUIBOUNCE - DISPLAY A MODAL WHEN REMOVING THE MOUSE FROM THE SCREEN */
$config['site']['ouibounce_isActive'] = true;


/** HIGH SCORES CONFIG */
$config['site']['h_limit'] = 25; // Limit players per page
$config['site']['h_limitOffset'] = 200; // Limits the maximum number of players in the rank
$config['site']['h_group_acc_show'] = "1,2,3,6"; // Select the class groups that will appear in the rank

/** INFO_BAR TIBIA NEW LIKE */
$config['site']['info_bar_active'] = true;
$config['site']['info_bar_cast'] = true;
$config['site']['info_bar_twitch'] = true;
$config['site']['info_bar_youtube'] = true;
$config['site']['info_bar_forum'] = true;
$config['site']['info_bar_online'] = true;

/**
	* DONATE CONFIG LIKE PAYABLE OLD_CONFIG
	* (50 * 10) = R $ 5.00 // 50 = TIBIA COINS COUNT 1 to 1 ratio
*/

$config['donate']['offers'] = [
	/** id =>[PRICE=>COINS]*/
	0 => [(5 * 100) => 75],
	1 => [(10 * 100) => 150],
	2 => [(25 * 100) => 375],
	3 => [(50 * 90) => 750], //10% discount
	4 => [(100 * 90) => 1500], //10% discount
	5 => [(200 * 80) => 3000], //20% discount
	6 => [(300 * 80) => 4500], //20% discount
	8 => [(400 * 70) => 6000], //30% discount
	// 9 => [24500 => 5000]
];


$proporcao_preco = (array_keys($config['donate']['offers'][intval(0)])[0] / 100);
$proporcao_qnt = array_values($config['donate']['offers'][intval(0)])[0];

$config['donate']['proporcao'] = $proporcao_preco / $proporcao_qnt;
$config['donate']['show_proporcao'] = false;

/**
 * configure your active payment method with this
 * true = ACTIVE
 * false = INACTIVE
 */
$config['paymentsMethods'] = [
	'pagseguro' => true,
	'paypal' => true,
	'mercadoPago' => false,
	'transfer' => false,
	'picpay' => true
];

/** PICPAY CONFIGS */
$config['picpay']['user'] = ''; //User no having @

/** Bank transfer data */
$config['banktransfer'] = [
	//		EXAMPLE TO ADD MORE
	//		0 => [
	//				'bank' => '',
	//				'agency' => '',
	//				'account' => '',
	//				'name' => '',
	//				'operation' => '',
	//				'email' => '',
	//				'acctype' => ''
	//		],
	//		1 => [
	//				'bank' => '',
	//				'agency' => '',
	//				'account' => '',
	//				'name' => '',
	//				'operation' => '',
	//				'email' => '',
	//				'acctype' => ''
	//		]
];

/** PAGSEGURO FIXED */
$config['pagseguro']['testing'] = false;
$config['pagseguro']['lightbox'] = true;
$config['pagseguro']['tokentest'] = "";

/** PAGSEGURO CONFIGS */
$config['pagseguro']['email'] = "@gmail.com";
$config['pagseguro']['token'] = "";
$config['pagseguro']['produtoNome'] = 'Tibia Coins';
$config['pagseguro']['urlRedirect'] = $config['base_url'];
$config['pagseguro']['urlNotification'] = 'https:///retpagseguro.php';

$config['pagseguro']['offers'] = [
	500 => 75,
	800 => 125,
	1500 => 250,
	2800 => 500,
	4900 => 1000
];

// /** PayPal configs */
$config['paypal']['email'] = "@gmail.com";
$config['paypal']['sandboxemail'] = "sb-lmf4f1383105@business.example.com";
$config['paypal']['itemName'] = "Tibia Coins";
$config['paypal']['notify_url'] = $config['base_url'] . "paypal_ipn.php";
$config['paypal']['currency'] = "BRL";
// /** SETUP LIVE OR TESTING YOUR IMPLEMENT */
$config['paypal']['env'] = "production"; // sandbox | production
// /** PRODUCTION IDS */
$config['paypal']['clientID'] = "";
$config['paypal']['clientSecretID'] = "";
// /** SANDBOX IDS */
$config['paypal']['sandboxClientID'] = "";
$config['paypal']['sandboxClientSecretID'] = "";
// /** ##PayPal configs */
/** PayPal configs *
$config['paypal']['email'] = "@gmail.com";
$config['paypal']['sandboxemail'] = "sb-vuwmo1072234@business.example.com";
$config['paypal']['itemName'] = "Tibia Coins";
$config['paypal']['notify_url'] = $config['base_url'] . "paypal_ipn.php";
$config['paypal']['currency'] = "BRL";
/** SETUP LIVE OR TESTING YOUR IMPLEMENT */
$config['paypal']['env'] = "production"; // sandbox | production
/** PRODUCTION IDS *
$config['paypal']['clientID'] = "";
$config['paypal']['clientSecretID'] = "";
/** SANDBOX IDS *
$config['paypal']['sandboxClientID'] = "";
$config['paypal']['sandboxClientSecretID'] = "";
/** ##PayPal configs*/

/** MERCADO PAGO CONFIGS */
$config['mp']['CLIENT_ID'] = "";
$config['mp']['CLIENT_SECRET'] = "";
$config['mp']['SANDBOX_CLIENT_ID'] = "";
$config['mp']['SANDBOX_CLIENT_SECRET'] = "";
$config['mp']['sandboxMode'] = false; // true | false
$config['sale']['productName'] = "Tibia Coins";
$config['sale']['subProductName'] = "Coins";
/** ##MERCADO PAGO CONFIGS */

/** LAYOUT CONFIGS */
//$config['site']['layout'] = 'med'; //Layout Name
$config['site']['layout'] = 'tibiacom'; //Layout Name
//$config['site']['layout'] = 'materialize_template'; //Layout Name
$config['site']['vdarkborder'] = '#505050';
$config['site']['darkborder'] = '#D4C0A1';
$config['site']['lightborder'] = '#F1E0C6';
$config['site']['download_page'] = false;
$config['site']['serverinfo_page'] = true;
$config['site']['cssVersion'] = "?vs=3.0.6";

/** MULTIPLE REQ CONFIGS */
$config['site']['max_req_tries'] = 3;
$config['site']['timeout_time'] = 1; //TIME IN MINUTES

/** SELL CHARACTERS ACCOUNT CONFIGURE */
$config['sell']['account_seller_id'] = 2;
$config['site']['max_price_coin'] = 10000;
$config['site']['max_price_gold'] = 100000000;
$config['site']['sell_by_gold'] = false;
$config['site']['min_lvl_to_sell'] = 1;
/** SALE TAXES PERCENT 0-100 */
$config['site']['percent_sellchar_sale'] = 5;

/** Promoção configuration */
$config['site']['promo_isactive'] = false;
$config['site']['promo_imagename'] = 'promo.png';

/** SELL CHARACTERS VARIABLES LOAD */
$config['site']['Outfits_path'] = $config['site']['serverPath'] . "data/XML/outfits.xml";
$config['site']['Mounts_path'] = $config['site']['serverPath'] . "data/XML/mounts.xml";
$config['site']['Itens_path'] = $config['site']['serverPath'] . "data/items/items.xml";

$config['site']['enablelogs'] = false;
$config['site']['logsdir'] = '/home/logs/';
