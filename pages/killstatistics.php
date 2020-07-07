<?php
if (!defined('INITIALIZED'))
	exit;


$players_deaths = new DatabaseList('PlayerDeath');
$players_deaths->setFilter(new SQL_Filter(new SQL_Field('id', 'players'), SQL_Filter::EQUAL, new SQL_Field('player_id', 'player_deaths')));
$players_deaths->addOrder(new SQL_Order(new SQL_Field('time'), SQL_Order::DESC));
$players_deaths->setLimit(50);
//$players_deaths = $SQL->query("SELECT * FROM `PlayerDeath` WHERE `id` = `player_id` and `players` = `player_deaths` ORDER BY `time` DESC LIMIT 7")->fetch();
$players_deaths_count = 0;


foreach ($players_deaths as $death) {
	$bgcolor = (($players_deaths_count++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
	$players_rows .= '<TR BGCOLOR="' . $bgcolor . '">
		<TD WIDTH="30"><center>' . $players_deaths_count . '.</center></TD>
		<TD WIDTH="125"><small>' . date("j.m.Y, G:i:s", $death->getTime()) . '</small></TD>
		<TD>
			<a href="?subtopic=characters&name=' . urlencode($death->data['name']) . '">' . htmlspecialchars($death->data['name']) . '</a> at level ' . $death->getLevel() . ' by ' . $death->getKillerString();
	if ($death->getMostDamageString() != '' && $death->getKillerString() != $death->getMostDamageString())
		$players_rows .= ' and ' . $death->getMostDamageString();
	$players_rows .= '</TD></TR>';
}
if ($players_deaths_count == 0) {
	$main_content .= "<div class='TableContainer'>";
	$main_content .= $make_content_header("Last Deaths");
	$main_content .= $make_table_header();
	$main_content .= '<TR><TD>No one died on ' . htmlspecialchars($config['server']['serverName']) . '.</TD></TR>';
	$main_content .= $make_table_footer();
	$main_content .= "</div>";
} else {
	$main_content .= "<div class='TableContainer'>";
	$main_content .= $make_content_header("Last Deaths");
	$main_content .= $make_table_header();
	$main_content .= "<tr><td>#</td><td>Date</td><td>Kill</td></tr>";
	$main_content .= $players_rows;
	$main_content .= $make_table_footer();
	$main_content .= "</div>";
}
