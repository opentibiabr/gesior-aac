<?php

if($action == "guildwars") {
	$guild_name = (string) $_REQUEST['GuildName'];
	$guild = new Guild();
	$guild->loadByName($guild_name);
	if(!$guild->isLoaded())
		$guild_errors[] = 'Guild with name <b>'.$guild_name.'</b> doesn\'t exist.';
	
	$guild_id = $guild->getID();
	if(empty($guild_errors)) {
		//check is it vice or/and leader account (leader has vice + leader rights)
		$guild_leader_char = $guild->getOwner();
		$rank_list = $guild->getGuildRanksList();
		$guild_leader = FALSE;
		$guild_vice = FALSE;
		if($logged)
		{
			$account_players = $account_logged->getPlayers();
			foreach($account_players as $player)
			{
				$players_from_account_ids[] = $player->getId();
				$player_rank = $player->getRank();
				if(!empty($player_rank))
					foreach($rank_list as $rank_in_guild)
						if($rank_in_guild->getId() == $player_rank->getId())
						{
							$players_from_account_in_guild[] = $player->getName();
							if($player_rank->getLevel() > 1)
							{
								$guild_vice = TRUE;
								$level_in_guild = $player_rank->getLevel();
							}
							if($guild->getOwner()->getId() == $player->getId())
							{
								$guild_vice = TRUE;
								$guild_leader = TRUE;
							}
						}
			}
		}
	}
	if($guild_leader)
		$main_content .= '
			<center>
				<table border="0" cellspacing="0" cellpadding="0" >
					<form action="?subtopic=guilds" method="post" >
						<tr>
							<td style="border:0px;" >
								<input type="hidden" name=action value=declarewar >
								<input type="hidden" name=GuildName value="'.$_REQUEST['GuildName'].'" >
								<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Declare War" alt="Declare War" src="'.$layout_name.'/images/global/buttons/_sbutton_declarewar.gif" >
									</div>
								</div>
							</td>
						</tr>
					</form>
				</table>
			</center>
			<br/>';
			/*
		$main_content .= '
			<div class="TableContainer" >
				<table class="Table5" cellpadding="0" cellspacing="0" >
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" > 
							<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
							<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>						
							<div class="Text" >Declarations of War</div>
							<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
							<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
							<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
						</div>
					</div>
					<tr>
						<td><div class="InnerTableContainer" >
								<table style="width:100%;" >
									<tr>
										<td>The guild Lino Lucky has currently no open war declarations.</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<br/>';
			*/
			$main_content .= "<script type=\"text/javascript\"><!--
		function show_hide(flip)
		{
				var tmp = document.getElementById(flip);
				if(tmp)
						tmp.style.display = tmp.style.display == 'none' ? '' : 'none';
		}
		--></script>";
	$main_content .= '
		<div class="TableContainer" >
			<table class="Table5" cellpadding="0" cellspacing="0" >
				<div class="CaptionContainer" >
					<div class="CaptionInnerContainer" > 
						<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
						<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>						
						<div class="Text" >Guild Wars</div>
						<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
						<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
						<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
					</div>
				</div>
				<tr>
					<td>
						<div class="InnerTableContainer" >
							<table style="width:100%;" >';
							$main_content .= '
								<tr>
									<td>
										<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%" >
														<tr class="LabelV">
															<td>Aggressor</td>
															<td>Information</td>
															<td>Enemy</td>
														</tr>';
														$warFrags = array();
														foreach($SQL->query('SELECT * FROM `guildwar_kills` WHERE `killerguild` = ' . $guild_id . ' OR `targetguild` = ' . $guild_id . ' ORDER BY `time` DESC')->fetchAll() as $frag)
														{
															$warFrags[$frag['warid']][] = $frag;
														}
												
														$count = 0;
														foreach($SQL->query('SELECT `guild_wars`.`id`, `guild_wars`.`guild1`, `guild_wars`.`guild2`, `guild_wars`.`name1`, `guild_wars`.`name2`, `guild_wars`.`status`, `guild_wars`.`started`, `guild_wars`.`ended`, (SELECT COUNT(1) FROM `guildwar_kills` WHERE `guildwar_kills`.`warid` = `guild_wars`.`id` AND `guildwar_kills`.`killerguild` = `guild_wars`.`guild1`) guild1_kills, (SELECT COUNT(1) FROM `guildwar_kills` WHERE `guildwar_kills`.`warid` = `guild_wars`.`id` AND `guildwar_kills`.`killerguild` = `guild_wars`.`guild2`) guild2_kills FROM `guild_wars` WHERE `guild1` = ' . $guild_id . ' OR `guild2` = ' . $guild_id . ' ORDER BY CASE `status` WHEN 0 THEN 2 WHEN 1 THEN 1 WHEN 4 THEN 3 WHEN 3 THEN 4 WHEN 2 THEN 5 END, `started` DESC') as $war)
														{
															$count++;
															$main_content .= "<tr style=\"background: " . (is_int($count / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']) . ";\">
														<td align=\"center\"><a href=\"?subtopic=guilds&action=view&GuildName=".$war['name1']."\"><img src=\"guild_image.php?id=" . $war['guild1'] . "\" width=\"64\" height=\"64\" border=\"0\"/><br />".htmlspecialchars($war['name1'])."</a></td>
														<td align=\"center\">";
															switch($war['status'])
															{
																case 0:
																{
																	$main_content .= "<b>Pending acceptation</b><br />Invited on " . date("M d Y, H:i:s", $war['started']) . " for " . (($war['ended'] - $war['started']) / 3600) . " hours war.<br />";
																	if($guild_leader && $war['guild2'] == $guild->getID())
																	{
																		$main_content .= '<br /><a href="?subtopic=guilds&action=guildwar_accept&GuildName=' . $guild_name . '&war=' . $war['id'] . '" onclick="return confirm(\'Are you sure that you want ACCEPT that invitation for 2 hours war?\');" style="cursor: pointer;">accept invitation to war</a>';
																		$main_content .= '<br /><br /><a href="?subtopic=guilds&action=guildwar_reject&GuildName=' . $guild_name . '&war=' . $war['id'] . '" onclick="return confirm(\'Are you sure that you want REJECT that invitation for 2 hours war?\');" style="cursor: pointer;">reject invitation to war</a>';
																	}
																	if($guild_leader && $war['guild1'] == $guild->getID())
																	{
																		$main_content .= '<br /><br /><a href="?subtopic=guilds&action=guildwar_cancel&GuildName=' . $guild_name . '&war=' . $war['id'] . '" onclick="return confirm(\'Are you sure that you want CANCEL that invitation for 2 hours war?\');" style="cursor: pointer;">cancel invitation to war</a>';
																	}
																	$main_content .= '</font>';
																	break;
																}
																case 1:
																{
																	$main_content .= "<font size=\"12\"><span style=\"color: red;\">" . $war['guild1_kills'] . "</span><font color=black> : </font><span style=\"color: lime;\">" . $war['guild2_kills'] . "</span></font><br /><br /><span style=\"color: darkred; font-weight: bold;\">On a brutal war</span><br /><font color=black>Began on " . date("M d Y, H:i:s", $war['started']) . ", will end up after server restart after " . date("M d Y, H:i:s", $war['started'] + (2*3600)) . ".<br /></font>";
																	$main_content .= "<br /><br />";
																	if(in_array($war['status'], array(1,4)))
																	{
																		$main_content .= "<a onclick=\"show_hide('war-details:" . $war['id'] . "'); return false;\" style=\"cursor: pointer;\">War Details</a>";
																	}
																	break;
																}
																case 2:
																{
																	$main_content .= "<b>Rejected invitation</b><br />Invited on " . date("M d Y, H:i:s", $war['started']) . ", rejected on " . date("M d Y, H:i:s", $war['ended']) . ".</font>";
																	break;
																}
																case 3:
																{
																	$main_content .= "<b>Canceled invitation</b><br />Sent invite on " . date("M d Y, H:i:s", $war['started']) . ", canceled on " . date("M d Y, H:i:s", $war['ended']) . ".</font>";
																	break;
																}
																case 4:
																{
																	$main_content .= "<b><i>Ended</i></b><br />Began on " . date("M d Y, H:i:s", $war['started']) . ", ended on " . date("M d Y, H:i:s", $war['ended']) . ". Frag statistics: <span style=\"color: red;\">" . $war['guild1_kills'] . "</span> to <span style=\"color: lime;\">" . $war['guild2_kills'] . "</span>.";
																	$main_content .= "<br /><br />";
																	if(in_array($war['status'], array(1,4)))
																	{
																		$main_content .= "<a onclick=\"show_hide('war-details:" . $war['id'] . "'); return false;\" style=\"cursor: pointer;\">&raquo; Details &laquo;</a>";
																	}
																	$main_content .= "</font>";
																	break;
																}
																default:
																{
																	$main_content .= "Unknown, please contact with gamemaster.";
																	break;
																}
															}
															$main_content .= "</td>
														<td align=\"center\"><a href=\"?subtopic=guilds&action=view&GuildName=".$war['name2']."\"><img src=\"guild_image.php?id=" . $war['guild2'] . "\" width=\"64\" height=\"64\" border=\"0\"/><br />".htmlspecialchars($war['name2'])."</a></td>
														</tr>
														<tr id=\"war-details:" . $war['id'] . "\" style=\"display: none; background: " . (is_int($count / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']) . ";\">
														<td colspan=\"3\">";
															if(in_array($war['status'], array(1,4)))
															{
																if(isset($warFrags[$war['id']]))
																{
																	foreach($warFrags[$war['id']] as $frag)
																	{
																		$main_content .= date("j M Y, H:i", $frag['time']) . " <span style=\"font-weight: bold; color: " . ($frag['killerguild'] == $war['guild1'] ? "red" :"lime") . ";\">+</span><a href=\"?subtopic=characters&name=" . urlencode($frag['killer']) . "\"><b>".htmlspecialchars($frag['killer'])."</b></a> killed <a href=\"?subtopic=characters&name=".urlencode($frag['target'])."\"> " . htmlspecialchars($frag['target']) . "</a>";
																	}
																}
																else
																	$main_content .= "<center>There were no frags on this war so far.</center>";
															}
															else
																$main_content .= "</td></tr>";
														}
												$main_content .= '
													</table>
												</div>
											</div>
										</div>
									</td>
								</tr>';
						if($count == 0)
							$main_content .= "
								<tr>
									<td>The guild Lino Lucky is currently not involved in a guild war.</td>
								</tr>";
						$main_content .= '
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<br/>';
		/*
	$main_content .= '
		<div class="TableContainer" >
			<table class="Table5" cellpadding="0" cellspacing="0" >
				<div class="CaptionContainer" >
					<div class="CaptionInnerContainer" > 
						<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
						<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>						
						<div class="Text" >Guild War History</div>
						<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
						<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
						<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
					</div>
				</div>
				<tr>
					<td>
						<div class="InnerTableContainer">
							<table style="width:100%;">
								<tr>
									<td>The guild Lino Lucky has never participated in a guild war.</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<br/>';
		*/
	$main_content .= '
		<center>
			<table border="0" cellspacing="0" cellpadding="0" >
				<form action="?subtopic=guilds&action=view" method="post" >
					<tr>
						<td style="border:0px;" >
							<input type="hidden" name=GuildName value="'.$_REQUEST['GuildName'].'" >
							<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/global/buttons/_sbutton_back.gif" >
								</div>
							</div>
						</td>
					</tr>
				</form>
			</table>
		</center>
		';
}
if($action == 'declarewar')
{
	$guild_name = (string) $_REQUEST['GuildName'];
	if(!$logged)
		$guild_errors[] = 'You are not logged.';
	if(empty($guild_errors))
	{
		$guild = new Guild();
		$guild->loadByName($guild_name);
		if(!$guild->isLoaded())
			$guild_errors[] = 'Guild <b>'.$guild_name.'</b> doesn\'t exist.';
		if(empty($guild_errors))
		{
			$guild_leader_char = $guild->getOwner();
			$guild_leader = FALSE;
			$account_players = $account_logged->getPlayers();
			foreach($account_players as $player)
			{
				if($guild_leader_char->getId() == $player->getId())
				{
					$guild_leader = TRUE;
				}
			}
			if($guild_leader)
			{
				$currentWars = array();
				$wars = new DatabaseList('GuildWar');
				foreach($wars as $war)
				{
					if($war->getStatus() == GuildWar::STATE_INVITED || $war->getStatus() == GuildWar::STATE_ON_WAR)
					{
						if($war->getGuild1ID() == $guild->getID())
							$currentWars[$war->getGuild2ID()] = $war->getStatus();
						elseif($war->getGuild2ID() == $guild->getID())
							$currentWars[$war->getGuild1ID()] = $war->getStatus();
					}
				}

				$main_content .= '<center><h1>' . htmlspecialchars($guild->getName()) . ' vs. ???</h2></center><br /><h3>Choose your enemy!</h3><br /><table width="100%" border="0" cellspacing="1" cellpadding="4">';

				$guildsList = new DatabaseList('Guild');
				$guildsList->addOrder(new SQL_Order(new SQL_Field('name'), SQL_Order::ASC));
				$shown_guilds = 0;
				foreach($guildsList as $enemyGuild)
				{
					if(is_int($shown_guilds / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $shown_guilds++;
					$main_content .= '<tr BGCOLOR="'.$bgcolor.'"><td width="70px"><IMG SRC="guild_image.php?id='. $enemyGuild->getID() .'" WIDTH="64" HEIGHT="64"></td><td valign="top"><B>'.htmlspecialchars($enemyGuild->getName()).'</B></td><td>';
					if($enemyGuild->getID() != $guild->getID())
					{
						if(isset($currentWars[$enemyGuild->getID()]))
						{
							// in war or invited
							if($currentWars[$enemyGuild->getID()] == GuildWar::STATE_INVITED)
							{
								// guild already invited you or you invited that guild
								$main_content .= 'There is already invitation between your and this guild.';
							}
							else
							{
								// you are on war with this guild
								$main_content .= 'There is already war between your and this guild.';
							}
						}
						else
						{
							// can invite
							$main_content .= '<a href="?subtopic=guilds&action=guildwar_invite&GuildName=' . urlencode($guild->getName()) . '&enemy=' . $enemyGuild->getID() . '" onclick="return confirm(\'Are you sure that you want invite that guild?\')">INVITE FOR WAR</a>';
						}
					}
					else
					{
						// your own guild
						$main_content .= 'YOUR GUILD';
					}
					$main_content .= '</td></tr>';
				}
				$main_content .= '</table>';
			}
			else
				$guild_errors[] = 'You are not a leader of guild!';
		}
	}
	if(!empty($guild_errors))
	{
		$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/global/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/global/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($guild_errors as $guild_error)
			$main_content .= '<li>'.$guild_error.'</li>';
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/global/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></div>  </div></div><br>';
		$main_content .= '<br/><center><form action="?subtopic=guilds" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/global/buttons/_sbutton_back.gif" ></div></div></form></center>';
	}
}
if($action == 'guildwar_invite')
{
	$guild_name = (string) $_REQUEST['GuildName'];
	$enemy_id = (int) $_REQUEST['enemy'];
	if(!$logged)
		$guild_errors[] = 'You are not logged.';
	if(empty($guild_errors))
	{
		$guild = new Guild();
		$guild->loadByName($guild_name);
		$enemyGuild = new Guild($enemy_id);
		if(!$guild->isLoaded() || !$enemyGuild->isLoaded())
			$guild_errors[] = 'Guild <b>'.$guild_id.'</b> or <b>'.$enemy_id.'</b> doesn\'t exist.';
		if(empty($guild_errors))
		{
			$guild_leader_char = $guild->getOwner();
			$guild_leader = FALSE;
			$account_players = $account_logged->getPlayers();
			foreach($account_players as $player)
			{
				if($guild_leader_char->getId() == $player->getId())
				{
					$guild_leader = TRUE;
				}
			}
			if($guild_leader)
			{
				if($enemyGuild->getID() != $guild->getID())
				{
					$currentWars = array();
					$wars = new DatabaseList('GuildWar');
					foreach($wars as $war)
					{
						if($war->getStatus() == GuildWar::STATE_INVITED || $war->getStatus() == GuildWar::STATE_ON_WAR)
						{
							if($war->getGuild1ID() == $guild->getID())
								$currentWars[$war->getGuild2ID()] = $war->getStatus();
							elseif($war->getGuild2ID() == $guild->getID())
								$currentWars[$war->getGuild1ID()] = $war->getStatus();
						}
					}
					if(isset($currentWars[$enemyGuild->getID()]))
					{
						// in war or invited
						if($currentWars[$enemyGuild->getID()] == GuildWar::STATE_INVITED)
						{
							// guild already invited you or you invited that guild
							$guild_errors[] = 'There is already invitation between your and this guild.';
						}
						else
						{
							// you are on war with this guild
							$guild_errors[] = 'There is already war between your and this guild.';
						}
					}
					else
					{
						// can invite
						$war = new GuildWar();
						$war->setGuild1ID($guild->getID());
						$war->setGuild2ID($enemyGuild->getID());
						$war->setGuild1Name($guild->getName());
						$war->setGuild2Name($enemyGuild->getName());
						$war->setStatus(GuildWar::STATE_INVITED);
						$war->setStarted(time());
						$war->setEnded(0);
						$war->save();
						header("Location: ?subtopic=guilds&action=view&GuildName=".urlencode($guild_name)."");
						$main_content .= 'War invitation sent. Redirecting...';
					}
				}
				else
				{
					$guild_errors[] = 'You cannot invite same guild!';
				}
			}
			else
				$guild_errors[] = 'You are not a leader of guild!';
		}
	}
	if(!empty($guild_errors))
	{
		$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($guild_errors as $guild_error)
			$main_content .= '<li>'.$guild_error.'</li>';
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br>';
		$main_content .= '<br/><center><form action="?subtopic=guilds" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
	}
}
if($action == 'guildwar_cancel')
{
	$guild_name = (string) $_REQUEST['GuildName'];
	$war_id = (int) $_REQUEST['war'];
	if(!$logged)
		$guild_errors[] = 'You are not logged.';
	if(empty($guild_errors))
	{
		$guild = new Guild();
		$guild->loadByName($guild_name);
		if(!$guild->isLoaded())
			$guild_errors[] = 'Guild <b>'.$guild_name.'</b> doesn\'t exist.';
		if(empty($guild_errors))
		{
			$guild_leader_char = $guild->getOwner();
			$guild_leader = FALSE;
			$account_players = $account_logged->getPlayers();
			foreach($account_players as $player)
			{
				if($guild_leader_char->getId() == $player->getId())
				{
					$guild_leader = TRUE;
				}
			}
			if($guild_leader)
			{
				$war = new GuildWar($war_id);
				if(!$war->isLoaded())
					$guild_errors[] = 'War with ID <b>'.$war_id.'</b> doesn\'t exist.';

				if(empty($guild_errors))
				{
					if($war->getGuild1ID() != $guild->getID() || $war->getStatus() != GuildWar::STATE_INVITED)
					{
						$guild_errors[] = 'Your guild did not invite to that war.';
					}

					if(empty($guild_errors))
					{
						$war->setStatus(GuildWar::STATE_CANCELED);
						$war->setEnded(time());
						$war->save();
						header("Location: ?subtopic=guilds&action=view&GuildName=".$guild_name."");
						$main_content .= 'War invitation rejected. Redirecting...';
					}
				}
			}
			else
				$guild_errors[] = 'You are not a leader of guild!';
		}
	}
	if(!empty($guild_errors))
	{
		$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($guild_errors as $guild_error)
			$main_content .= '<li>'.$guild_error.'</li>';
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br>';
		$main_content .= '<br/><center><form action="?subtopic=guilds" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
	}
}
if($action == 'guildwar_reject')
{
	$guild_name = (string) $_REQUEST['GuildName'];
	$war_id = (int) $_REQUEST['war'];
	if(!$logged)
		$guild_errors[] = 'You are not logged.';
	if(empty($guild_errors))
	{
		$guild = new Guild();
		$guild->loadByName($guild_name);
		if(!$guild->isLoaded())
			$guild_errors[] = 'Guild <b>'.$guild_name.'</b> doesn\'t exist.';
		if(empty($guild_errors))
		{
			$guild_leader_char = $guild->getOwner();
			$guild_leader = FALSE;
			$account_players = $account_logged->getPlayers();
			foreach($account_players as $player)
			{
				if($guild_leader_char->getId() == $player->getId())
				{
					$guild_leader = TRUE;
				}
			}
			if($guild_leader)
			{
				$war = new GuildWar($war_id);
				if(!$war->isLoaded())
					$guild_errors[] = 'War with ID <b>'.$war_id.'</b> doesn\'t exist.';

				if(empty($guild_errors))
				{
					if($war->getGuild2ID() != $guild->getID() || $war->getStatus() != GuildWar::STATE_INVITED)
					{
						$guild_errors[] = 'Your guild is not invited to that war.';
					}

					if(empty($guild_errors))
					{
						$war->setStatus(GuildWar::STATE_REJECTED);
						$war->setEnded(time());
						$war->save();
						header("Location: ?subtopic=guilds&action=view&GuildName=".urlencode($guild_name)."");
						$main_content .= 'War invitation rejected. Redirecting...';
					}
				}
			}
			else
				$guild_errors[] = 'You are not a leader of guild!';
		}
	}
	if(!empty($guild_errors))
	{
		$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($guild_errors as $guild_error)
			$main_content .= '<li>'.$guild_error.'</li>';
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br>';
		$main_content .= '<br/><center><form action="?subtopic=guilds" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
	}
}
if($action == 'guildwar_accept')
{
	$guild_name = (string) $_REQUEST['GuildName'];
	$war_id = (int) $_REQUEST['war'];
	if(!$logged)
		$guild_errors[] = 'You are not logged.';
	if(empty($guild_errors))
	{
		$guild = new Guild();
		$guild->loadByName($guild_name);
		if(!$guild->isLoaded())
			$guild_errors[] = 'Guild <b>'.$guild_name.'</b> doesn\'t exist.';
		if(empty($guild_errors))
		{
			$guild_leader_char = $guild->getOwner();
			$guild_leader = FALSE;
			$account_players = $account_logged->getPlayers();
			foreach($account_players as $player)
			{
				if($guild_leader_char->getId() == $player->getId())
				{
					$guild_leader = TRUE;
				}
			}
			if($guild_leader)
			{
				$war = new GuildWar($war_id);
				if(!$war->isLoaded())
					$guild_errors[] = 'War with ID <b>'.$war_id.'</b> doesn\'t exist.';

				if(empty($guild_errors))
				{
					if($war->getGuild2ID() != $guild->getID() || $war->getStatus() != GuildWar::STATE_INVITED)
					{
						$guild_errors[] = 'Your guild is not invited to that war.';
					}

					if(empty($guild_errors))
					{
						$war->setStatus(GuildWar::STATE_ON_WAR);
						$war->setStarted(time());
						$war->setEnded(0);
						$war->save();
						header("Location: ?subtopic=guilds&action=view&GuildName=".urlencode($guild_name)."");
						$main_content .= 'War invitation accepted. Redirecting...';
					}
				}
			}
			else
				$guild_errors[] = 'You are not a leader of guild!';
		}
	}
	if(!empty($guild_errors))
	{
		$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($guild_errors as $guild_error)
			$main_content .= '<li>'.$guild_error.'</li>';
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br>';
		$main_content .= '<br/><center><form action="?subtopic=guilds" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
	}
}