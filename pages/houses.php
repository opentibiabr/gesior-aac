<?php
if (!defined('INITIALIZED'))
	exit;
// CONFIG
$auctionDaysDefault = 3;

$badInfoStart = '';
$badInfoEnd = '<br />';
$goodInfoStart = '';
$goodInfoEnd = '';


function timeToEndString($end)
{
	$timeLeft = $end - time();
	if ($timeLeft <= 0)
		return 'auction finished';
	elseif ($timeLeft >= 86400)
		return floor($timeLeft / 86400) . ' days left';
	elseif ($timeLeft >= 3600)
		return floor($timeLeft / 3600) . ' hours left';
	elseif ($timeLeft >= 60)
		return floor($timeLeft / 60) . ' minutes left';
	else
		return $timeLeft . ' seconds left!';
}

if ($action == '') {
	##-- town --##
	$houses_town = (int) $_REQUEST['town'];
	if (count($towns_list) > 0) {
		foreach ($towns_list as $town_ids => $town_names) {
			if ($town_ids == $houses_town) {
				$town_id = $town_ids;
				$town_name = $town_names;
			}
		}
	}
	##-- owner --##
	$houses_owner = (int) $_REQUEST['owner'];
	if ($houses_owner == 0) {
		$owner_sql = '';
	} elseif ($houses_owner == 1) {
		$owner_sql = ' AND owner = 0';
	} elseif ($houses_owner == 2) {
		$owner_sql = ' AND owner > 0';
	}
	##-- order --##
	$houses_order = (int) $_REQUEST['order'];
	if ($houses_order == 0) {
		$order_sql = 'name';
	} elseif ($houses_order == 1) {
		$order_sql = 'size';
	} elseif ($houses_order == 2) {
		$order_sql = 'rent';
	}
	##-- status --##
	$houses_status = (int) $_REQUEST['status'];

	$status_name = 'Houses and Flats';

	##-- List Houses --##
	$id = (int) $_GET['show'];
	if (empty($id)) {
		$main_content .= 'Here you can see the list of all available houses, flats or guildhalls. Please select the game world of your choice. Click on any view button to get more information about a house or adjust the search criteria and start a new search.<br><br>';
		if ($houses_town > 0) {
			$main_content .= '<table border=0 cellspacing=1 cellpadding=4 width=100%>
				<tr bgcolor="' . $config['site']['vdarkborder'] . '" class=white>
					<td colspan=5 style="color:white;"><b>Available ' . $status_name . ' in ' . $town_name . ' on ' . $config['server']['serverName'] . '</b></td>
				</tr>
				<tr bgcolor="' . $config['site']['darkborder'] . '">
					<td width=24%><b>Name</b></td><td width=11%><b>Size</b></td><td width=15%><b>Rent</b></td><td width=30%><b>Status</b></td><td width=20%></td>
				</tr>';
			$houses_sql = $SQL->query('SELECT * FROM houses WHERE town_id = ' . $town_id . '' . $owner_sql . ' ORDER BY ' . $order_sql . ' DESC')->fetchAll();
			$counter = 0;
			foreach ($houses_sql as $house) {
				if (is_int($counter / 2))
					$bgcolor = $config['site']['lightborder'];
				else
					$bgcolor = $config['site']['darkborder'];
				$counter++;
				if ($house['owner'] == 0) {
					if ($house['highest_bidder'] > 0) {
						$owner = 'auctioned (' . $house['last_bid'] . ' gold, ' . timeToEndString($house['bid_end']) . ')';
					} else {
						$owner = 'auctioned (no bid yet)';
					}
				} elseif ($house['owner'] > 0) {
					$player = new Player($house['owner']);
					$owner = 'owned by <a href="?subtopic=characters&name=' . urlencode($player->getName()) . '">' . $player->getName() . '</a>';
				}
				$main_content .= '<tr bgcolor="' . $bgcolor . '">
						<td>' . $house['name'] . '</td>
						<td>' . $house['size'] . ' sqm</td>
						<td>' . $house['rent'] . ' gold</td>
						<td>' . $owner . '</td>
						<td><a href="index.php?subtopic=houses&show=' . $house['id'] . '"><img src="' . $layout_name . '/images/global/buttons/sbutton_view.gif" border="0"></a></td>
					</tr>';
			}
			$main_content .= '</table><br>';
		}
		$main_content .= '
		<form action="?subtopic=houses" method="post">
			<div class="TopButtonContainer">
				<div class="TopButton">
					<a href="#top">
						<img style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif">
					</a>
				</div>
			</div>
		<div class="TableContainer" >

				<div class="CaptionContainer" >
					<div class="CaptionInnerContainer" >
						<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
						<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
						<div class="Text" >Search House</div>
						<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
						<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
						<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					</div>
				</div>
				<tr>
				<table class="Table3" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tbody>
								<tr>
									<td>
									   <div class="TableShadowContainerRightTop">
										<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
									</div>
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
										<div class="TableContentContainer">
											<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
													<tbody>




				<tr bgcolor="#D4C0A1" ><td width=25% style="border:1px solid #faf0d7;"><b>Town</b></td>
					<td width=25% style="border:1px solid #faf0d7;"><b>Status</b>
					</td><td width=25% style="border:1px solid #faf0d7;"><b>Sort</b></td>
				</tr>';
		$main_content .= '<td valign=top rowspan=2>';
		foreach ($towns_list as $id => $town_n) {
			$main_content .= '<input type="radio" name="town" value="' . $id . '" ';
			if ($houses_town == $id)
				$main_content .= 'checked="checked" ';
			$main_content .= '>' . $town_n . '<br>';
		}
		$main_content .= '</td>
					<td valign=top>
						<input type="radio" name="owner" value="0" ';
		if ($houses_owner == 0)
			$main_content .= 'checked="checked" ';
		$main_content .= '>all states<br>
						<input type="radio" name="owner" value="1" ';
		if ($houses_owner == 1)
			$main_content .= 'checked="checked" ';
		$main_content .= '>auctioned<br>
						<input type="radio" name="owner" value="2" ';
		if ($houses_owner == 2)
			$main_content .= 'checked="checked" ';
		$main_content .= '>rented<br>
					</td>
					<td valign=top rowspan=2>
						<input type="radio" name="order" value="0" ';
		if ($houses_order == 0)
			$main_content .= 'checked="checked" ';
		$main_content .= '>by name<br>
						<input type="radio" name="order" value="1" ';
		if ($houses_order == 1)
			$main_content .= 'checked="checked" ';
		$main_content .= '>by size<br>
						<input type="radio" name="order" value="2" ';
		if ($houses_order == 2)
			$main_content .= 'checked="checked" ';
		$main_content .= '>by rent<br>
					</td>
				</tr>
				<tr bgcolor="' . $config['site']['darkborder'] . '">
					<td valign=top>
						<input type="radio" name="status" value="0" ';
		if ($houses_status == 0)
			$main_content .= 'checked="checked" ';
		$main_content .= '>houses and flats<br>';
		if ($config['server']['guildHalls'] == true) {
			$main_content .= '<input type="radio" name="status" value="1" ';
			if ($houses_status == 1)
				$main_content .= 'checked="checked" ';
			$main_content .= '>guildhalls<br>';
		}
		$main_content .= '
 </tr>
													</tbody>
												</table>
											</div>
										</div>
									   <div class="TableShadowContainer">
										<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
										</div>
									</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>

			</table>
		</div>
		<table border=0 cellspacing=1 cellpadding=4 width=100%
		<tr>
		<td colspan=><br><center>
		<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
		<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
		<input class="ButtonText" type="image" name="Submit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" border="0" WIDTH=120 HEIGHT=18>
		</div></center></td>
		</tr>
		</table>
		</form>';
	} ##-- Show House --##
	else {
		$house = $SQL->query('SELECT * FROM houses WHERE id = ' . $id . '')->fetch();
		if ($house['doors'] < 2)
			$door = '1 door';
		else
			$door = $house['doors'] + 1 . ' doors';
		if ($house['beds'] < 2)
			$bed = '1 bed';
		else
			$bed = $house['beds'] . ' beds';
		if ($house['owner'] > 0) {
			$player = new Player($house['owner']);
			if ($house['paid'] > 0)
				$paid = ' and paid until <b>' . date("M j Y, H:i:s", $house['paid']) . ' CET</b>';
			$owner = '<br>The house is currently rented by <a href="?subtopic=characters&name=' . urlencode($player->getName()) . '">' . $player->getName() . '</a>' . $paid . '.';
		} else {
			if ($house['highest_bidder'] > 0) {
				if ($house['bid_end'] > time()) {
					$bidder = new Player($house['highest_bidder']);
					$owner = '<br />The house is currently being auctioned. The highest bid so far is <b>' . $house['last_bid'] . ' gold</b> and has been submitted by <a href="?subtopic=characters&name=' . urlencode($bidder->getName()) . '">' . $bidder->getName() . '</a>. Auction will end at <b>' . date("M j Y, H:i:s", $house['bid_end']) . '</b>.';
				} else {
					$bidder = new Player($house['highest_bidder']);
					$owner = '<br />This house auction is finished. <a href="?subtopic=characters&name=' . urlencode($bidder->getName()) . '">' . $bidder->getName() . '</a> won this auction with bid <b>' . $house['last_bid'] . ' gold</b>. Auction finished on ' . date("M j Y, H:i:s", $house['bid_end']) . '.';
				}
			} else {
				$owner = 'The house is currently being auctioned. No bid has been submitted so far.';
			}
		}
		$main_content .= '

				<table border=0 cellspacing=1 cellpadding=4 >
		<tr>
		<td>
		<div class="SmallBox">
				<div class="MessageContainer">
					<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);"></div>
					<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
					<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
					<div class="Message">
						<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></div>
						<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></div>
						<table style="width:100%;">
							<tbody><tr><td style="width:100%;text-align:center;">
							<img border="3" width=300 height=222 src="images/house/' . $house['name'] . '.jpeg" alt="house image" /></td>
						</tr>
					</tbody></table>
				</div>
				<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);"></div>
				<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
				<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
			</div>
		</div>
		<br>
		</td>
		<td>
		<center>
			<table>
				<tbody>
					<tr>
						<td><img src="' . $layout_name . '/images/global/content/headline-bracer-left.gif"></td>
						<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">' . $house['name'] . '</td>
						<td><img src="' . $layout_name . '/images/global/content/headline-bracer-right.gif"></td>
					</tr>
					</tbody>
			</table>
		</center>
		<br>
		<table class="Table5" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tbody>
								<tr>
									<td>
									<div class="TableShadowContainerRightTop">
										<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
									</div>
									   <div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
										<div class="TableContentContainer">
											<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
													<tbody>
														<tr>



		<table border=0 cellspacing=1 cellpadding=4 width=100%>
			<tr bgcolor="#D4C0A1">
				<td></td>
				<td>
					<b>' . $house['name'] . '</b><br>
					This house has <b>' . $door . '</b> and <b>' . $bed . '</b> and it is placed in <b>' . $towns_list[$house['town_id']] . '</b>.<br><br>
					The house has a size of <b>' . $house['size'] . ' square meters</b>.
					The monthly rent is <b>' . $house['rent'] . ' gold</b> and will be debited to the bank account on <b>' . $config['server']['serverName'] . '</b><br><br>
				   ' . $owner . '
				</td>
			</tr>
			<tr>
				<td colspan=2></td>
			</tr>


		</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="TableShadowContainer">
										<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
										</div>
									</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
		</table>
		';

		if (Visitor::isLogged()) {
			$houseBidded = $SQL->query('SELECT `houses`.`id` house_id, `players`.`id` bidder_id FROM `houses`, `players` WHERE `players`.`id` = `houses`.`highest_bidder` AND `players`.`account_id` = ' . Visitor::getAccount()->getID())->fetch();
		}
		if (Visitor::isLogged() && isset($houseBidded['house_id']) && $houseBidded['house_id'] == $house['id']) {
			$main_content .= '<br /><br /><b>YOUR MAXIMUM OFFER IS NOW HIGHEST ON THAT AUCTION, IT IS <span style="color:red">' . $house['bid'] . '</span> GOLD COINS.';
		}
		$main_content .= '
				</td>
			</tr>
			<tr>
				<td colspan=2></td>
			</tr>
		</table></td></tr></table><br />';

		if ($house['owner'] == 0 && ($house['bid_end'] > time() || $house['bid_end'] == 0)) {
			//Button Back
			$main_content .= '
			<center>
		<form action="?subtopic=houses&town=' . (int) $house['town_id'] . '&owner=' . (($house['owner'] > 0) ? 1 : 0) . '&order=0&status=0" method="post">
					<tr>
						<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
						<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
						<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
					</div>
				</div>
			</form>
		</center>';
		} else {
			$main_content .= '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=100%><TR><TD><center><a href="index.php?subtopic=houses&town=' . (int) $house['town_id'] . '&owner=' . (($house['owner'] > 0) ? 1 : 0) . '&order=0&status=0"><img src="' . $layout_name . '/images/global/buttons/sbutton_back.gif" BORDER=0 /></a></center></TD></TR></TABLE>';
		}
	}
} elseif ($action == 'bid') {
	if (Visitor::isLogged()) {
		$houseOwned = $SQL->query('SELECT `houses`.`id` house_id, `players`.`id` owner_id FROM `houses`, `players` WHERE `players`.`id` = `houses`.`owner` AND `players`.`account_id` = ' . Visitor::getAccount()->getID() . ' LIMIT 1')->fetch();
		if ($houseOwned === false) {
			if (isset($_REQUEST['house'])) {
				$house = new House((int) $_REQUEST['house']);
				if ($house->isLoaded()) {
					if ($house->getOwner() == 0) {
						if ($house->getBidEnd() == 0 || $house->getBidEnd() > time()) {
							$houseBidded = $SQL->query('SELECT `houses`.`id` house_id, `players`.`id` bidder_id FROM `houses`, `players` WHERE `players`.`id` = `houses`.`highest_bidder` AND `players`.`account_id` = ' . Visitor::getAccount()->getID())->fetch();
							if ($houseBidded === false || $houseBidded['house_id'] == $house->getID()) {

								$bidded = false;
								if (isset($_REQUEST['do_bid'])) {
									if (isset($_REQUEST['bid']) && isset($_REQUEST['bidder'])) {
										$bidder = new Player($_REQUEST['bidder']);
										$bid = (int) $_REQUEST['bid'];
										if ($bidder->isLoaded() && $bidder->getAccountID() == Visitor::getAccount()->getID()) {
											if ($bidder->getBalance() >= $bid) {
												// jesli przebija swoja oferte to nie musi dawac wiecej
												// moze tylko zmieniac postac ktora zostanie, a nawet obnizac maksymalna
												if ($bid > 0 && ($bid > $house->getBid() || $houseBidded !== false)) {
													// jesli przebija sam siebie to nie podnosi ceny aktualnej
													if ($houseBidded === false) {
														// ustawia cene na cene przed przebiciem + 1 gold
														// moze to podniesc z 0 do 1 gold przy nowym domku
														// lub ustawic wartosc maksymalna osoby co licytowala wczesniej + 1
														$house->setLastBid($house->getBid() + 1);
													}
													// ustawic najwyzsza oferowana kwote na podana
													// jesli przebija swoja aukcje kwota mniejsza niz aktualna to nie zmieniaj!
													// jak ktos inny przebija to i tak bid bedzie wiekszy-rowny od aktualnego
													// (nawet jak o 1 gp przebija - 6 linijek wyzej ustawia ...
													// na kwote mniejsza niz bid + 1, wiec bedzie rowny)
													if ($bid >= $house->getLastBid()) {
														$house->setBid($bid);
													}
													// ustawic postac ktora zostanie wlascicielem na podana
													$house->setHighestBidder($bidder->getID());
													if ($house->getBidEnd() == 0) {
														$auctionEnd = time() + $auctionDaysDefault * 86400;
														if (isset($config['server']['serverSaveEnabled']) && $config['server']['serverSaveEnabled'] == 'yes') {
															$serverSaveHour = $config['server']['serverSaveHour'];
															if ($serverSaveHour >= 0 && $serverSaveHour <= 24) {
																$timeNow = time();
																$timeInfo = localtime($timeNow, true); // current time, associative = true
																if ($serverSaveHour == 0) {
																	$serverSaveHour = 23;
																} else {
																	$serverSaveHour--;
																}

																$timeInfo['tm_hour'] = $serverSaveHour;
																$timeInfo['tm_min'] = 55;
																$timeInfo['tm_sec'] = 0;
																$difference = mktime($timeInfo['tm_hour'], $timeInfo['tm_min'], $timeInfo['tm_sec'], (int) $timeInfo['tm_mon'] + 1, $timeInfo['tm_mday'], (int) $timeInfo['tm_year'] + 1900) - $timeNow;

																if ($difference < 0) {
																	$difference += 86400;
																}
																$auctionEnd = time() + $difference + ($auctionDaysDefault - 1) * 86400;
															}
														}
														$house->setBidEnd($auctionEnd);
													}
													$house->save();
													$main_content .= $goodInfoStart . 'Your offer is now highest on auction. Current price for house is <b>' . $house->getLastBid() . ' gold</b>, your maximum price is <b>' . $house->getBid() . ' gold</b>. Character <b>' . htmlspecialchars($bidder->getName()) . '</b> from your account will get house, if you win.' . $goodInfoEnd;
													// udalo sie przebic, wiec nie pokazuje formularza
													$bidded = true;
												} else {
													if ($bid >= $house->getLastBid()) {
														$house->setLastBid($bid);
														$house->save();
													}
													$main_content .= $badInfoStart . 'Your offer of ' . $bid . ' gold is too low.' . $badInfoEnd;
												}
											} else
												$main_content .= $badInfoStart . 'Character <b>' . htmlspecialchars($bidder->getName()) . '</b> does not have enough money on bank account.' . $badInfoEnd;
										} else
											$main_content .= 'Selected player is not on your account?! Hax?';
									} else
										$main_content .= 'Missing one of bid parameters?! Hax?';
								}
								if (!$bidded) {
									// show bid form
									$main_content .= '<form action="index.php" method="post">
										<input type="hidden" name="subtopic" value="houses" />
										<input type="hidden" name="action" value="bid" />
										<input type="hidden" name="house" value="' . $house->getID() . '" />
										<input type="hidden" name="do_bid" value="1" />
										<table border=0 cellspacing=1 cellpadding=4 width=100%>
											<tr bgcolor="' . $config['site']['vdarkborder'] . '" class=white>
												<td colspan="2" style="color:white;"><b>Bid at auction of house ' . $house->getName() . ' placed in ' . $towns_list[$house->getTown()] . '</b></td>
											</tr>
											<tr bgcolor="' . $config['site']['darkborder'] . '">
												<td><b>Owner:</b></td>
												<td><select name="bidder">';
									foreach (Visitor::getAccount()->getPlayers() as $accountPlayer) {
										$main_content .= '<option value="' . $accountPlayer->getID() . '"';
										if ($accountPlayer->getID() == $house->getHighestBidder())
											$main_content .= 'selected="selected"';
										$main_content .= '>' . htmlspecialchars($accountPlayer->getName()) . '</option>';
									}
									$main_content .= '</select></td>
											</tr>
											<tr bgcolor="' . $config['site']['lightborder'] . '">
												<td width="200px"><b>Your maximum offer:</b></td>
												<td><input type="text" size="9" name="bid" value="' . (($houseBidded['house_id'] == $house->getID()) ? $house->getBid() : $house->getLastBid() + 1) . '" /> gold coins</td>
											</tr>
											<tr bgcolor="' . $config['site']['darkborder'] . '">
												<td><b>Current bid:</b></td>
												<td>' . $house->getLastBid() . ' gold coins</td>
											</tr>
											<tr bgcolor="' . $config['site']['lightborder'] . '">
												<td><b>Owner</b></td>
											</tr>
										</table>
									</form><br />If your offer is now highest on auction you can bid to make your maximum offer lower (cannot be lower then current "bid") or higher.<br />You can also bid you change character that will own house, if you win auction.';
								}
							} else
								$main_content .= 'You are already bidding on other house auction.';
						} else
							$main_content .= 'This auction is finished.';
					} else
						$main_content .= 'This house is not on auction!';
				} else
					$main_content .= 'This house does not exist!';
			} else
				$main_content .= 'Choose house!';
		} else
			$main_content .= 'You already own one house. You can\'t buy more.';
	} else
		$main_content .= 'You must login to bid on auction!';
	$main_content .= '<br /><br /><TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=100%><TR><TD><center><a href="index.php?subtopic=houses&show=' . (int) $_REQUEST['house'] . '"><img src="' . $layout_name . '/images/global/buttons/sbutton_back.gif" BORDER=0 /></a></center></TD></TR></TABLE>';
}
