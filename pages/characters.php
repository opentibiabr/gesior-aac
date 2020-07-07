<?php
if (!defined('INITIALIZED'))
	exit;

$name = '';
if (isset($_REQUEST['name']))
	$name = (string) $_REQUEST['name'];
$name = strip_tags($name);

if (!empty($name)) {
	$player = new Player();
	$player->find($name);
	if ($player->isLoaded()) {
		$rows_number = 0;
		$account = $player->getAccount();

		$main_content .= '<div class="TableContainer" >';
		$fb_link = '<div class="fb-share-button" data-href="' . Website::getWebsiteConfig()->getValue('base_url') . '/?subtopic=characters&name=' . urlencode($name) . '" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' . Website::getWebsiteConfig()->getValue('base_url') . '/?subtopic=characters&name=' . urlencode($name) . '&src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartilhar</a></div>';
		$main_content .= $make_content_header("Character Information", $fb_link);
		$main_content .= $make_table_header('Table3', '', true);
		$inselldb = $SQL->query("SELECT COUNT(*) as 'count' FROM account_character_sale WHERE id_player = " . $player->getID())->fetch();
		$insell = $inselldb["count"];
		$main_content .= '
		<tr>
			<td width=20%>Name:</td>
			<td>' . htmlspecialchars($player->getName()) . (($player->isDeleted()) ? ', will be deleted at ' . date("M j Y, H:i:s", $player->getDeletion()) : '') . '  ' . ($insell > 0 ? "<a href='./?subtopic=accountmanagement&action=buychar&id={$player->getID()}'>[Personagem à venda]</a>" : "") . ' </td>
		</tr>';
		$player_id = $player->getID();
		$former_sql = "SELECT * FROM `player_former_names` WHERE `player_id` = '$player_id' ORDER BY `date` DESC LIMIT " . $config['site']['formerNames_amount'];
		$get_names_count = $SQL->query($former_sql)->fetchAll();
		$get_names_count2 = $SQL->query($former_sql)->fetch();
		if ($SQL->query($former_sql)->fetchColumn() > 0 && $get_names_count2['date'] >= time()) {
			$main_content .= '
				<tr>
					<td width=20%>Former Names:</td>
					<td>';
			$f_names = "";
			foreach ($get_names_count as $fomer_name) {
				$f_names .= $fomer_name['former_name'] . ', ';
			}
			$f_names = substr($f_names, 0, -2);
			$main_content .= $f_names;
			$main_content .= '
					</td>
				<tr>';
		}
		if (in_array($player->getGroup(), $config['site']['groups_support'])) {
			$main_content .= '
				<tr>
					<td>Group:</td>
					<td>' . htmlspecialchars(Website::getGroupName($player->getGroup())) . '</td>
				</tr>';
		}
		$main_content .= '
				<tr>
					<td>Sex:</td>
					<td>' . htmlspecialchars((($player->getSex() == 0) ? 'Female' : 'Male')) . '</td>
				</tr>';

		$main_content .= '
				<tr >
					<td>Vocation:</td>
					<td>' . htmlspecialchars(Website::getVocationName($player->getVocation())) . '</td>
				</tr>';

		$main_content .= '
				<tr >
					<td>Level:</td>
					<td>' . htmlspecialchars($player->getLevel()) . '</td>
				</tr>';

		$main_content .= '
				<tr >
					<td>World:</td>
					<td>' . htmlspecialchars($config['server']['serverName']) . '</td>
				</tr>';

		$main_content .= '
				<tr >
					<td>Residence:</td>
					<td>' . htmlspecialchars($towns_list[$player->getTownID()]) . '</td>
				</tr>';
		if ($player->getMarriageStatus() > 0) {
			$player_married = new Player();
			$player_married->loadById($player->getMarriage());

			$main_content .= '
					<tr >
						<td>Married to:</td>
						<td><a href="?subtopic=characters&name=' . urlencode($player_married->getName()) . '">' . htmlspecialchars($player_married->getName()) . '</a></td>
					</tr>';
		}

		$houseC = $SQL->query("SELECT COUNT(*) as 'c' FROM `houses` WHERE `owner` = '" . $player->getID() . "'")->fetch();
		$houseCo = (int) $houseC["c"];
		if ($houseCo["c"] > 0) {
			$house = $SQL->query("SELECT * FROM `houses` WHERE `owner` = '" . $player->getID() . "'")->fetch();
			$main_content .= '<TR ><TD>House:</TD><TD>';
			$main_content .= $house['name'] . ' (' . $towns_list[$house['town_id']] . ')' . '</TD></TR>';
		}

		$rank_of_player = $player->getRank();
		if (!empty($rank_of_player)) {
			$main_content .= '
					<tr >
						<td>Guild Membership:</td>
						<td>' . htmlspecialchars($rank_of_player->getName()) . ' of the <a href="?subtopic=guilds&action=view&GuildName=' . urlencode($rank_of_player->getGuild()->getName()) . '">' . htmlspecialchars($rank_of_player->getGuild()->getName()) . '</a>
						</td>
					</tr>';
		}

		$main_content .= '
				<tr >
					<td>Last login:</td>
					<td>' . (($player->getLastLogin() > 0) ? date("j F Y, g:i a", $player->getLastLogin()) : 'Never logged in.') . '</td>
				</tr>';

		$comment = $player->getComment();
		$newlines = array("\r\n", "\n", "\r");
		$comment_with_lines = str_replace($newlines, '<br />', $comment, $count);
		if ($count < 50)
			$comment = $comment_with_lines;
		if (!empty($comment)) {
			$main_content .= '
					<tr >
						<td>Comment:</td>
						<td>' . $comment . '</td>
					</tr>';
		}

		if ($account->isVip()) {
			$main_content .= '
					<tr >
						<td>Account Status:</td>
						<td>VIP Account</td>
					</tr>';
			/*        } else if ($config['server']['freePremium'] == "yes") {
			$main_content .= '
					<tr >
						<td>Account Status:</td>
						<td>Free Premium Account</td>
					</tr>'; */
		} else {
			$main_content .= '
					<tr >
						<td>Account Status:</td>
						<td>Free Account</td>
					</tr>';
		}
		$main_content .= '</tr>';
		$main_content .= $make_table_footer();
		$main_content .= '</div></br>';

		if (!$player->isHidden()) {

			//Plus Account Information
			include_once "system/load.newclasses.php";
			$verifica_item_id = function ($pid) use ($player) {
				if ($player->getItems()->getItem($pid)[array_keys($player->getItems()->getItem($pid))[0]]->data['itemtype'] == NULL) {
					return '<td style="background-color: #d4c0a1; text-align: center;"><img src="./layouts/tibiacom/images/shop/items/' . $pid . '.gif" class="CharItems"></td>';
				} else {
					$item_id = $player->getItems()->getItem($pid)[array_keys($player->getItems()->getItem($pid))[0]]->data['itemtype'];
					return '<td align="center" style="background-color: #D4C0A1;"><img src="./layouts/tibiacom/images/shop/items/' . $item_id . '.png" class="CharItems"></td>';
				}
			};
			$player_info = $player->data;
			$cur_outfit .= "<img style='text-decoration:none;margin: 0 0 0 -13px;' class='outfitImgsell2' src='" . $player->makeOutfitUrl() . "' alt='' name=''>";

			$cur_exp = $player->getExperience();
			$cur_lvl_exp = $player->getExpForLevel($player->getLevel());
			$cur_real_exp = $cur_exp - $cur_lvl_exp;
			$next_lvl_exp = $player->getExpForLevel($player->getLevel() + 1);
			$next_lvl_exp_need = $next_lvl_exp - $cur_lvl_exp;

			$next_lvl_percent = (float) round(((($cur_real_exp / $next_lvl_exp_need) * 100)), 2, PHP_ROUND_HALF_DOWN);
			$next_lvl_percent = ($next_lvl_percent == 100 ? 99.99 : $next_lvl_percent);

			$plus_content .= '<div class="account_plus_information">';
			$plus_content .= '
				<div class="TableContentAndRightShadow1" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
					<div class="TableContainer1">
						<table class="Table3" width="100%" style="background-color: rgb(212, 192, 161);">
							<tbody>
								<tr>
									<td>
										<div id="TransferConditionsToggleButton" class="BigToggleButton" onclick="CollapseTable(\'TransferConditionsContainer\'); $(\'#labelshow\').html($(\'#labelshow\').html() == \'show\' ? \'hide\' : \'show\');">
											<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
											<div id="Indicator_TransferConditionsContainer" class="CircleSymbolPlus" style="position: absolute; height: 18px; width: 18px; top: -8px; right: -8px; z-index: 99; cursor: pointer; background-image: url(./layouts/tibiacom/images/global/content/circle-symbol-plus.gif);"></div>
											<i class="fa fa-info-circle" aria-hidden="true"></i> Click here to <span id="labelshow">show</span> <b>additional informations</b>.
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>';
			$plus_content .= '
				<div id="TransferConditionsContainer" style="display: none;">
					<br/>
					<table width="100%" style="padding: 5px 10px;">
						<tbody>
							<tr style="background-image: url(./layouts/tibiacom/images/global/content/scroll.gif)!important;">
								<td style="padding-right: 5px;">
									<table width="100%" class="Table30">
										<tbody>
											<tr bgcolor="#D4C0A1">
												<td align="center" width="100px"><b>Current<br>outfit:</b></td>
												<td>' . $cur_outfit . '</td>
											</tr>
										</tbody>
									</table>
									<table class="Table30" width="100%" style="border-spacing: 2px; padding: 0px;">
										<tbody>
											<tr>
												<td colspan="3" style="background-color: #D4C0A1; text-align: center;">
													<b>Inventory:</b>
												</td>
											</tr>
											<tr>';
			$plus_content .= $verifica_item_id(2);
			$plus_content .= $verifica_item_id(1);
			$plus_content .= $verifica_item_id(3);
			$plus_content .= '</tr><tr>';
			$plus_content .= $verifica_item_id(6);
			$plus_content .= $verifica_item_id(4);
			$plus_content .= $verifica_item_id(5);
			$plus_content .= '</tr><tr>';
			$plus_content .= $verifica_item_id(9);
			$plus_content .= $verifica_item_id(7);
			$plus_content .= $verifica_item_id(10);
			$plus_content .= '</tr><tr>';
			$plus_content .= '               <td style="background-color: #D4C0A1; text-align: center;">
													<b>Soul:</b><br>' . $player->getSoul() . '
												</td>';
			$plus_content .= $verifica_item_id(8);
			$plus_content .= '
												<td style="background-color: #D4C0A1; text-align: center;">
													<b>Cap:</b><br>' . $player->getCapacity() . '
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td>
									<table width="100%" class="Table30">
										<tbody>
											<tr bgcolor="#F1E0C6" style="text-align: center">
												<td width="80px"><b>Health:</b></td>
												<td>
													' . $player->getHealth() . '/' . $player->getHealthMax() . '(' . (round(($player->getHealth() / $player->getHealthMax()), 2, PHP_ROUND_HALF_UP) * 100) . '%)
													<div class="progress">
														<div class="progress-bar bg-danger" role="progressbar" aria-valuenow="' . (round(($player->getHealth() / $player->getHealthMax()), 2, PHP_ROUND_HALF_UP) * 100) . '" aria-valuemin="0" aria-valuemax="100" style=" width:' . (($player->getHealth() / $player->getHealthMax()) * 100) . '%;" ></div>
													</div>
												</td>
											</tr>
											<tr bgcolor="#D4C0A1" style="text-align: center">
												<td><b>Mana:</b></td>
												<td>
													' . $player->getMana() . '/' . $player->getManaMax() . ' (' . (round(($player->getMana() / $player->getManaMax()), 2, PHP_ROUND_HALF_UP) * 100) . '%)
													<div class="progress">
														<div class="progress-bar bg-default" role="progressbar" aria-valuenow="' . (round(($player->getMana() / $player->getManaMax()), 2, PHP_ROUND_HALF_UP) * 100) . '" aria-valuemin="0" aria-valuemax="100" style="width:' . (($player->getMana() / $player->getManaMax()) * 100) . '%"></div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<table width="100%" class="Table30">
										<tbody>
											<tr bgcolor="#F1E0C6">
												<td width="80px"><b>Exp:</b></td>
												<td>Have <b>' . $player->getExperience() . '</b> and need <b>' . ($player->getExpForLevel($player->getLevel() + 1) - $player->getExperience()) . '</b> to Level <b>' . ($player->getLevel() + 1) . '</b>.</td>
											</tr>
											<tr bgcolor="#D4C0A1">
												<td><b>Percent:</b></td>
												<td style="text-align: center">
													' . $next_lvl_percent . '%
													<div class="progress">
														<div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $next_lvl_percent . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $next_lvl_percent . '%"></div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<table width="100%" class="Table30">
										<tbody>
											<tr>
												<td style="text-align: center;"><a href="?subtopic=highscores&list=5"><img class="SkillIcon" src="images/skills/level.gif" alt="" style="border-style: none"></a></td>
												<td style="text-align: center;"><a href="?subtopic=highscores&list=9"><img class="SkillIcon" src="images/skills/ml.gif" alt="" style="border-style: none"></a></td>
												<td style="text-align: center;"><a href="?subtopic=highscores&list=7"><img class="SkillIcon" src="images/skills/fist.gif" alt="" style="border-style: none"></a></td>
												<td style="text-align: center;"><a href="?subtopic=highscores&list=3"><img class="SkillIcon" src="images/skills/club.gif" alt="" style="border-style: none"></a></td>
												<td style="text-align: center;"><a href="?subtopic=highscores&list=11"><img class="SkillIcon" src="images/skills/sword.gif" alt="" style="border-style: none"></a></td>
												<td style="text-align: center;"><a href="?subtopic=highscores&list=2"><img class="SkillIcon" src="images/skills/axe.gif" alt="" style="border-style: none"></a></td>
												<td style="text-align: center;"><a href="?subtopic=highscores&list=4"><img class="SkillIcon" src="images/skills/dist.gif" alt="" style="border-style: none"></a></td>
												<td style="text-align: center;"><a href="?subtopic=highscores&list=10"><img class="SkillIcon" src="images/skills/def.gif" alt="" style="border-style: none"></a></td>
												<td style="text-align: center;"><a href="?subtopic=highscores&list=6"><img class="SkillIcon" src="images/skills/fish.gif" alt="" style="border-style: none"></a></td>
											</tr>
											<tr bgcolor="#D4C0A1">
												<td style="text-align: center;"><strong>Level</strong></td>
												<td style="text-align: center;"><strong>ML</strong></td>
												<td style="text-align: center;"><strong>Fist</strong></td>
												<td style="text-align: center;"><strong>Mace</strong></td>
												<td style="text-align: center;"><strong>Sword</strong></td>
												<td style="text-align: center;"><strong>Axe</strong></td>
												<td style="text-align: center;"><strong>Dist</strong></td>
												<td style="text-align: center;"><strong>Def</strong></td>
												<td style="text-align: center;"><strong>Fish</strong></td>
											</tr>
											<tr bgcolor="#F1E0C6">
												<td style="text-align: center;">' . $player->getLevel() . '</td>
												<td style="text-align: center;">' . $player->getMagLevel() . '</td>
												<td style="text-align: center;">' . $player->getSkill(0) . '</td>
												<td style="text-align: center;">' . $player->getSkill(1) . '</td>
												<td style="text-align: center;">' . $player->getSkill(2) . '</td>
												<td style="text-align: center;">' . $player->getSkill(3) . '</td>
												<td style="text-align: center;">' . $player->getSkill(4) . '</td>
												<td style="text-align: center;">' . $player->getSkill(5) . '</td>
												<td style="text-align: center;">' . $player->getSkill(6) . '</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				';
			$plus_content .= '</div><br/>';
			//            $main_content .="<div class='TableContainer'>";
			//            $main_content .=$make_content_header("Aditional Information");
			//            $main_content .=$make_table_header();
			$main_content .= $plus_content;
			//            $main_content .=$make_table_footer();
			//            $main_content .="</div><br/>";
			//#End Plus Account Information
		}

		//quest list
		if (isset($config['site']['quests']) && is_array($config['site']['quests']) && count($config['site']['quests']) > 0) {

			$main_content .= '<div class="TableContainer" >';
			$main_content .= $make_content_header("Quests");
			$main_content .= $make_table_header('Table3', '', true);
			$number_of_quests = 0;
			foreach ($config['site']['quests'] as $questName => $storageID) {
				$bgcolor = (($number_of_rows++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
				$number_of_quests++;
				$main_content .= '<TR ><TD WIDTH=95%>' . $questName . '</TD>';
				if ($player->getStorage($storageID) === NULL) {
					$main_content .= '<TD><img src="images/false.png"/></TD></TR>';
				} else {
					$main_content .= '<TD><img src="images/true.png"/></TD></TR>';
				}
			}

			$main_content .= $make_table_footer();
			$main_content .= '</div><br>';
		}
		//#endquestlist

		//deaths list
		$player_deaths = new DatabaseList('PlayerDeath');
		$player_deaths->setFilter(new SQL_Filter(new SQL_Filter(new SQL_Field('player_id'), SQL_Filter::EQUAL, $player->getId()), SQL_Filter::CRITERIUM_AND, new SQL_Filter(new SQL_Field('id', 'players'), SQL_Filter::EQUAL, new SQL_Field('player_id', 'player_deaths'))));
		$player_deaths->addOrder(new SQL_Order(new SQL_Field('time'), SQL_Order::DESC));
		$player_deaths->setLimit(5);

		foreach ($player_deaths as $death) {
			$bgcolor = (($number_of_rows++ % 2 != 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
			$deads++;
			$dead_add_content .= '<tr ><td width="20%" align="center">' . date("j/m/Y H:i", $death->getTime()) . '</td><td>Died at level ' . $death->getLevel() . ' by ' . $death->getKillerString() . '.';
			if ($death->getMostDamageString() != '' && $death->getKillerString() != $death->getMostDamageString())
				$dead_add_content .= ' and ' . $death->getMostDamageString();
			$dead_add_content .= "</td></tr>";
		}
		if ($deads > 0) {
			$main_content .= "<div class='TableContainer'>";
			$main_content .= $make_content_header("Character Last Deaths");
			$main_content .= $make_table_header('Table3', '', true);
			$main_content .= $dead_add_content;
			$main_content .= $make_table_footer();
			$main_content .= "</div><br/>";
		}

		if ($insell == 0) {
			if (!$player->isHidden()) {

				$main_content .= "<div class='TableContainer'>";
				$main_content .= $make_content_header("Account Information");
				$main_content .= $make_table_header('Table3', '', true);

				if ($account->getLoyalty() >= 50) {
					$accountTitle = ''; // none
					foreach ($loyalty_title as $loypoints => $loytitle) {
						if ($account->getLoyalty() >= $loypoints) {
							# player rank
							$accountTitle = $loytitle;
						}
					}

					$bgcolor = (($number_of_rows++ % 2 != 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
					$main_content .= '<tr  ><td width="20%">Loyalty Title:</td><td>' . $accountTitle . ' of ' . $config['server']['serverName'] . '</td></tr>';
				}
				$bgcolor = (($number_of_rows++ % 2 != 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
				$main_content .= '<tr  ><td>Created:</td><td>' . date("j F Y, g:i a", $account->getCreateDate()) . '</td></tr>';
				if ($account->isBanned() > 0) {
					$bgcolor = (($number_of_rows++ % 2 != 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
					$main_content .= '<tr  ><td style="color:red;">Banished:</td><td style="color:red;">' . ($account->getBanTime() == 0 ? 'Permanente' : date("j F Y, g:i a", strtotime($account->getBanTime()))) . '</td></tr>';
				}

				$main_content .= $make_table_footer();
				$main_content .= "</div><br/>";
			}
		}
		if ($insell == 0) {
			if (!$player->isHidden()) {

				$main_content .= "<div class='TableContainer'>";
				$main_content .= $make_content_header("Characters");
				$main_content .= $make_table_header('Table3', '', true);

				$main_content .= '<tr><td><strong>Name</strong></td><td><strong>World</strong></td><td><strong>Status</strong></td><td>Action</td></tr>';
				$account_players = $account->getPlayersList();
				$player_number = 0;
				foreach ($account_players as $player_list) {
					if ($name == $player_list->getName() || !$player_list->isHidden()) {
						$player_number++;
						$bgcolor = (($number_of_rows++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
						if (!$player_list->isOnline())
							$player_list_status = '<font class="red"><strong>offline</strong></font>';
						else
							$player_list_status = '<font class="green"><strong>online</strong></font>';

						$main_content .= '
								<tr >
									<td width="35%">' . $player_number . '. ' . htmlspecialchars($player_list->getName()) . '</td>
									<td width="35%">' . htmlspecialchars($config['server']['serverName']) . '
									<span style="width: 18px; height: 18px;"><a href="../common/help.php?subtopic=battleye" target="_blank">
													<span class="HelperDivIndicator" onMouseOver="ActivateHelperDiv($(this), \'Staff present in game world:\', \'On this game world, Staff blocks cheats from the game. The game world has been protected by Staff since its release.\', \'\');" onMouseOut="$(\'#HelperDivContainer\').hide();" >
													<img style="border:0px;" src="' . $layout_name . '/images/global/content/icon_battleyeinitial.gif"></span></a></span>

									</td>
									<td width="70%">' . (($player_list->isDeleted()) ? 'deleted' : $player_list_status) . '</td>
									<td>
										<table border="0" cellspacing="0" cellpadding="0">
											<form action="" method="post">
												<input type="hidden" name="name" value="' . htmlspecialchars($player_list->getName()) . '">
												<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
							<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
								<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);"></div>
								<input class="ButtonText" type="image" name="View ' . htmlspecialchars($player_list->getName()) . '" alt="View ' . htmlspecialchars($player_list->getName()) . '" src="' . $layout_name . '/images/global/buttons/_sbutton_view.gif">
								</div>
							</div>
											</form>
										</table>
									</td>
								</tr>';
					}
				}
				$main_content .= $make_table_footer();
				$main_content .= "</div><br/>";
			}
		}
	} else
		$search_error = 'Character <b>' . htmlspecialchars($name) . '</b> does not exist.';
}
if (!empty($search_error)) {
	$main_content .= "<div class='TableContainer'>";
	$main_content .= $make_content_header("Could not find character");
	$main_content .= $make_table_header('Table3', '', true);
	$main_content .= '
			<TR>
				<TD BGCOLOR="#D4C0A1" style="text-align: center">' . $search_error . '</TD>
			</TR>
		';
	$main_content .= $make_table_footer();
	$main_content .= "</div><br/><br/>";
}

$main_content .= "<div class='TableContainer'>";
$main_content .= $make_content_header("Search Character");
$main_content .= $make_table_header('Table3', '', true);
$main_content .= '<tr>
						<td>Name:</td>
							<form action="" method="post">
						<td><input name="name" value="" size="29" maxlenght="29"></td>
						<td><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
							<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
								<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);"></div>
								<input class="ButtonText" type="image" name="Submit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif">
								</div>
							</div>
						</td>
							</form>
				</tr>';
$main_content .= $make_table_footer();
$main_content .= "</div>";
