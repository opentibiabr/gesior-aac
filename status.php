<?PHP

header ("Content-Type:text/xml");
require 'config/config.php';

// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);
define('INITIALIZED', true);

if (!defined('ONLY_PAGE'))
	define('ONLY_PAGE', true);

// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');

// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');

// DATABASE
include_once('./system/load.database.php');
if (DEBUG_DATABASE)
	Website::getDBHandle()->setPrintQueries(true);

// DATABASE END

$playersonline = $SQL->query("SELECT COUNT(*) AS 'count' FROM `players_online`")->fetch();
$players = (int) $playersonline["count"];

$xml = '<?xml version="1.0"?>
<status>
	<info type="servername" value="'. str_replace(" - Global", "", $config['server']['serverName']) .'" />
	<info type="pvptype" value="'. $config['server']['worldType'] .'" />
	<info type="players" value="'. $players .'" />
	<info type="shopping" value="?subtopic=accountmanagement&amp;action=donate" />
</status>
';


$xml_result = new SimpleXMLElement($xml);

echo $xml_result->asXML();
