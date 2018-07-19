<?php
if(!defined('INITIALIZED'))
	exit;

$name = '';
if(isset($_REQUEST['name']))
	$name = (string) $_REQUEST['name'];

if(!empty($name))
{
	$player = new Player();
	$player->find($name);
	if($player->isLoaded())
	{
		$rows_number = 0;
		$account = $player->getAccount();
		
		$main_content .= '
			<div class="TableContainer" >
			<table class="Table3" cellpadding="0" cellspacing="0" >
				<div class="CaptionContainer" >
					<div class="CaptionInnerContainer" > 
						<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
						<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>						
						<div class="Text" >Character Information</div>
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
									<td><div class="TableShadowContainerRightTop" >
											<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
										</div>
										<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
											<div class="TableContentContainer" >
												<table class="TableContent" width="100%" >
												<tr>';
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
				<tr bgcolor="' . $bgcolor . '">
					<td width=20%>Name:</td>
					<td>' . htmlspecialchars($player->getName()) . (($player->isDeleted()) ? ', will be deleted at ' . date("M j Y, H:i:s", $player->getDeletion()) : '') . '</td>
				<tr>';
		$player_id = $player->getID();
		$former_sql = "SELECT * FROM `player_former_names` WHERE `player_id` = '$player_id' ORDER BY `date` DESC LIMIT ".$config['site']['formerNames_amount']."";
		$get_names_count = $SQL->query($former_sql)->fetchAll();
		$get_names_count2 = $SQL->query($former_sql)->fetch();
		if($SQL->query($former_sql)->fetchColumn() > 0 && $get_names_count2['date'] >= time()) {
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
				<tr bgcolor="' . $bgcolor . '">
					<td width=20%>Former Names:</td>
					<td>';
				$f_names = "";
				foreach($get_names_count as $fomer_name)
					$f_names .= $fomer_name['former_name'].', ';
				$f_names = substr($f_names,0,-2);
				$main_content .= $f_names;
				$main_content .= '
					</td>
				<tr>';
		}
		if(in_array($player->getGroup(), $config['site']['groups_support']))
		{
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
				<tr bgcolor="' . $bgcolor . '">
					<td>Group:</td>
					<td>' . htmlspecialchars(Website::getGroupName($player->getGroup())) . '</td>
				</tr>';
		}
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
				<tr bgcolor="' . $bgcolor . '">
					<td>Sex:</td>
					<td>' . htmlspecialchars((($player->getSex() == 0) ? 'Female' : 'Male')) . '</td>
				</tr>';
				
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
				<tr bgcolor="' . $bgcolor . '">
					<td>Vocation:</td>
					<td>' . htmlspecialchars(Website::getVocationName($player->getVocation())) . '</td>
				</tr>';
			
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
				<tr bgcolor="' . $bgcolor . '">
					<td>Level:</td>
					<td>' . htmlspecialchars($player->getLevel()) . '</td>
				</tr>';
			
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
				<tr bgcolor="' . $bgcolor . '">
					<td>World:</td>
					<td>' . htmlspecialchars($config['server']['serverName']) . '</td>
				</tr>';
			
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
				<tr bgcolor="' . $bgcolor . '">
					<td>Residence:</td>
					<td>' . htmlspecialchars($towns_list[$player->getTownID()]) . '</td>
				</tr>';

			if ($player->getMarriageStatus() > 0) {
				$player_married = new Player();
				$player_married->loadById($player->getMarriage());
				$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
				$main_content .= '
					<tr bgcolor="' . $bgcolor . '">
						<td>Married to:</td>
						<td><a href="?subtopic=characters&name='.urlencode($player_married->getName()).'">' . htmlspecialchars($player_married->getName()) . '</a></td>
					</tr>';
			}
				
			$house = $SQL->query("SELECT * FROM `houses` WHERE `owner` = '".$player->getID()."'")->fetch();
			if ( count( $house[0] ) > 0 )
			{
				$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>House:</TD><TD>';
					$main_content .= $house['name'].' ('.$towns_list[$house['town_id']].')'.'</TD></TR>';
			}
				
			$rank_of_player = $player->getRank();
			if(!empty($rank_of_player))
			{
				$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
				$main_content .= '
					<tr bgcolor="' . $bgcolor . '">
						<td>Guild Membership:</td>
						<td>' . htmlspecialchars($rank_of_player->getName()) . ' of the <a href="?subtopic=guilds&action=view&GuildName='. urlencode($rank_of_player->getGuild()->getName()) .'">' . htmlspecialchars($rank_of_player->getGuild()->getName()) . '</a>
						</td>
						</tr>';
			}
			
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
				<tr bgcolor="' . $bgcolor . '">
					<td>Last login:</td>
					<td>' . (($player->getLastLogin() > 0) ? date("j F Y, g:i a", $player->getLastLogin()) : 'Never logged in.') . '</td>
				</tr>';
			
			$comment = $player->getComment();
			$newlines = array("\r\n", "\n", "\r");
			$comment_with_lines = str_replace($newlines, '<br />', $comment, $count);
			if($count < 50)
				$comment = $comment_with_lines;
			if(!empty($comment))
			{
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
				$main_content .= '
					<tr bgcolor="' . $bgcolor . '">
						<td>Comment:</td>
						<td>' . $comment . '</td>
					</tr>';
			}
			
			$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
			if ($account->getPremDays() > 0){
                $main_content .= '
					<tr bgcolor="' . $bgcolor . '">
						<td>Account Status:</td>
						<td>Premium Account</td>
					</tr>';
            }
			else if($config['server']['freePremium'] == "yes"){
                $main_content .= '
					<tr bgcolor="' . $bgcolor . '">
						<td>Account Status:</td>
						<td>Premium Account</td>
					</tr>';
            }else{
                $main_content .= '
					<tr bgcolor="' . $bgcolor . '">
						<td>Account Status:</td>
						<td>Free Account</td>
					</tr>';
            }

			
			$main_content .= '	</tr>
												<tr>
													
												</tr>
												</table>
											</div>
										</div>
										<div class="TableShadowContainer" >
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
												<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
												<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div></br>';
		
	//quest list
	if(isset($config['site']['quests']) && is_array($config['site']['quests']) && count($config['site']['quests']) > 0)
		{
			$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD align="left" COLSPAN=2 CLASS=white><B>Quests</B></TD></TD align="right"></TD></TR>';		
			$number_of_quests = 0;
			foreach($config['site']['quests'] as $questName => $storageID)
			{
				$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
				$number_of_quests++;
				$main_content .= '<TR BGCOLOR="' . $bgcolor . '"><TD WIDTH=95%>' . $questName . '</TD>';
				if($player->getStorage($storageID) === null)
				{
					$main_content .= '<TD><img src="images/false.png"/></TD></TR>';
				}
				else
				{
					$main_content .= '<TD><img src="images/true.png"/></TD></TR>';
				}
			}
			$main_content .= '</TABLE></td></tr></table><br />';
		}
		
			//deaths list
			$player_deaths = new DatabaseList('PlayerDeath');
			$player_deaths->setFilter(new SQL_Filter(new SQL_Filter(new SQL_Field('player_id'), SQL_Filter::EQUAL, $player->getId()), SQL_Filter::CRITERIUM_AND,new SQL_Filter(new SQL_Field('id', 'players'), SQL_Filter::EQUAL, new SQL_Field('player_id', 'player_deaths'))));
			$player_deaths->addOrder(new SQL_Order(new SQL_Field('time'), SQL_Order::DESC));
			$player_deaths->setLimit(5);
	
			foreach($player_deaths as $death)
			{
				$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
				$deads++;
				$dead_add_content .= '<tr bgcolor="'.$bgcolor.'"><td width="20%" align="center">'.date("j M Y, H:i", $death->getTime()).'</td><td>Died at level ' . $death->getLevel() . ' by ' . $death->getKillerString();
				if($death->getMostDamageString() != '' && $death->getKillerString() != $death->getMostDamageString())
					$dead_add_content .= ' and ' . $death->getMostDamageString();
				$dead_add_content .= "</td></tr>";
			}
	
			if($deads > 0)
				$main_content .= '<table border="0" cellspacing="1" cellpadding="4" width="100%"><tr bgcolor="'.$config['site']['vdarkborder'].'"><td colspan="2" class="white" ><b>Character Deaths</b></td></tr>' . $dead_add_content . '</table><br />';
				
			if(!$player->isHidden()) {
				$main_content .= '
					<table border="0" cellspacing="1" cellpadding="4" width="100%" >
						<tr bgcolor="#505050">
							<td colspan="2" class="white" ><b>Account Information</b></td>
						</tr>';
				if ($account->getLoyalty() >= 50) {
					$accountTitle = ''; // none
					foreach($loyalty_title as $loypoints => $loytitle) {														
						if($account->getLoyalty() >= $loypoints) {
							# player rank
							$accountTitle = $loytitle;
						} 
					}
					
					$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
					$main_content .= '
						<tr bgcolor="'.$bgcolor.'" >
							<td width="20%">Loyalty Title:</td>
							<td>'.$accountTitle.' of '.$config['server']['serverName'].'</td>
						</tr>';
				}
					$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
					$main_content .= '
						<tr bgcolor="'.$bgcolor.'" >
							<td>Created:</td>
							<td>'.date("j F Y, g:i a", $account->getCreateDate()).'</td>
						</tr>';
				if($account->isBanned() > 0) {
					$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
					$main_content .= '
						<tr bgcolor="'.$bgcolor.'" >
							<td style="color:red;">Banished:</td>
							<td style="color:red;">'.date("j F Y, g:i a", strtotime($account->getBanTime())).'</td>
						</tr>';
				}
				$main_content .= '
					</table>
					<br />';
			}
			if(!$player->isHidden()) {
				$main_content .= '
					<table border="0" cellspacing="1" cellpadding="4" width="100%" >
						<tr bgcolor="#505050">
							<td colspan="5" class="white" ><b>Characters</b></td>
						</tr>';
					$main_content .= '
						<tr bgcolor="' . $bgcolor . '">
							<td><strong>Name</strong></td>
							<td><strong>World</strong></td>
							<td><strong>Status</strong></td>
							<td>&nbsp;</td>
						<tr>';
					$account_players = $account->getPlayersList();
					$player_number = 0;
					foreach($account_players as $player_list)
					{
						if($name == $player_list->getName() || !$player_list->isHidden())
						{
							$player_number++;
							$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
							if(!$player_list->isOnline())
								$player_list_status = '';
							else
								$player_list_status = '<font class="green"><strong>online</strong></font>';
							
							$main_content .= '
								<tr bgcolor="' . $bgcolor . '">
									<td width="35%">'.$player_number.'. '.htmlspecialchars($player_list->getName()).'</td>
									<td width="35%">'.htmlspecialchars($config['server']['serverName']).'</td>	
									<td width="70%">'.(($player_list->isDeleted()) ? 'deleted' : $player_list_status).'</td>
									<td>
										<table border="0" cellspacing="0" cellpadding="0">
											<form action="" method="post">
												<tr>
													<td>
														<input type="hidden" name="name" value="'.htmlspecialchars($player_list->getName()).'">
														<input type="image" name="View '.htmlspecialchars($player_list->getName()).'" alt="View '.htmlspecialchars($player_list->getName()).'" src="' .$layout_name. '/images/global/buttons/sbutton_view.gif" border="0" width="120" height="18">
													</td>
												</tr>
											</form>
										</table>
									</td>
								</tr>';
						}
					}
					
					$main_content .= '</table><br />';
			}
	}
	else
		$search_error = 'Character <b>'.htmlspecialchars($name).'</b> does not exist.';
}
if(!empty($search_error))
{
	$main_content .= '
		<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4>
			<TR>
				<TD BGCOLOR="#505050" CLASS=white><B>Could not find character</B></TD>
			</TR>
			<TR>
				<TD BGCOLOR="#D4C0A1"><TABLE BORDER=0 CELLPADDING=1>
						<TR>
							<TD>'.$search_error.'</TD>
						</TR>
					</TABLE>
				</TD>
			</TR>
		</TABLE>
		<br />
		<br />';
}
$main_content .= '
	<form action="" method="post">
		<table width="100%" border="0" cellspacing="1" cellpadding="4">
			<tr>
				<td bgcolor="#505050" class="white"><b>Search Character</b></td>
			</tr>
			<tr>
				<td bgcolor="#D4C0A1">
					<table border="0" cellpading="1">
						<TR>
							<td>Name:</td>
							<td><input name="name" value="" size="29" maxlenght="29"></td>
							<td><input type="image" name="Submit" src="'.$layout_name.'/images/global/buttons/sbutton_submit.gif" border="0" width="120" height="18"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>';