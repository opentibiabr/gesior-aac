<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 04/04/2018
 * Time: 00:56
 */

use Thepixeldeveloper\Sitemap\Drivers\XmlWriterDriver;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;


//header("Content-Type: text/xml; encoding=UTF-8");
if ($config['base_url'] != Website::getWebsiteConfig()->getValue('realurl')) {
	$savefile = "C:/xampp/htdocs/global-website/production/ferobra-website/";
} else {
	$savefile = "/var/www/html/premium-gesior/";
}

/** SET SITEMAP URL */
$indexloc = $config['base_url'] . 'sitemaps/sitemap-index.xml';
$playersloc = $config['base_url'] . ('sitemaps/players-sitemap.xml');
//$communityloc = $config['base_url'].('community-sitemap.xml');

/** INSERT SITEMAP URL TO SITEMAP OBJECT */
$indexurl = new  Sitemap($indexloc);
$playersurl = new Sitemap($playersloc);
//$communityurl = new Sitemap($communityloc);

/** CREATE URL AND ADD IT TO GENERATE A XML */
$sitemapurlset = new SitemapIndex();
$sitemapurlset->add($indexurl);
$sitemapurlset->add($playersurl);
//$sitemapurlset->add($communityurl);

/** GENERATING XML */
$driver = new XmlWriterDriver();
$sitemapurlset->accept($driver);

/** SAVE XML TO A FILE */
$fp = fopen($savefile . "sitemaps/sitemap.xml", "wb");
fwrite($fp, $driver->output());
fclose($fp);


$loc = $config['base_url'];
$lastMod = new DateTime('NOW');
$changeFreq = "daily";
$priority = 1;

$url = new Url($loc);
$url->setLastMod($lastMod);
$url->setChangeFreq($changeFreq);
$url->setPriority($priority);

$urlset = new Urlset();
$urlset->add($url);

$xml = new XmlWriterDriver();
$urlset->accept($xml);

$fp = fopen($savefile . "sitemaps/sitemap-index.xml", "wb");
fwrite($fp, $xml->output());
fclose($fp);


$loc = $config['base_url'] . "?subtopic=characters&name=";
$lastMod = new DateTime('NOW');
$changeFreq = 'daily';
$priority = 0.8;
$players = $SQL->query("SELECT * FROM players WHERE account_id != 1")->fetchAll();

$urlset = new Urlset();
foreach ($players as $player) {
	$url = new Url($loc . urlencode($player['name']));
	$url->setLastMod($lastMod);
	$url->setChangeFreq($changeFreq);
	$url->setPriority($priority);
	$urlset->add($url);
}

$xml = new XmlWriterDriver();
$urlset->accept($xml);

$fp = fopen($savefile . "sitemaps/players-sitemap.xml", "wb");
fwrite($fp, $xml->output());
fclose($fp);
$date = new DateTime();
$t = $date->format('[d/m/Y H:i:s]');
echo $t . " - Sitemaps atualizados.\r\n";
die();
