<?PHP
if (!defined('INITIALIZED'))
	exit;
$main_content .= '
												<div class="TableContainer" >
			<table class="Table3" cellpadding="0" cellspacing="0" >
				<div class="CaptionContainer" >
					<div class="CaptionInnerContainer" >
						<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
						<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
						<div class="Text" >Banned Players on ' . $config['server']['serverName'] . '</div>
						<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
						<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
						<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					</div>
				</div>
				<tr>
					<td><div class="InnerTableContainer" >
							<table style="width:100%;" >
								<tr>
									<td><div class="TableShadowContainerRightTop" >
											<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
										</div>
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
											<div class="TableContentContainer" >
												<table class="TableContent" width="100%" >
													<TR BGCOLOR=#D4C0A1>
														<TD WIDTH=5%><B>ID</B></TD>
														<TD WIDTH=20%><B>Name</B></TD>
														<TD WIDTH=55%><B>Description</B></TD>
														<TD WIDTH=10%><B>Banned</B></TD>
														<TD WIDTH=10%><B>Expires</B></TD>
														<TD WIDTH=20%><B>Banned By</B></TD>
													</TR>';
$count = $SQL->query("SELECT COUNT(*) AS 'count' FROM account_bans")->fetch();

if ($count["count"] == 0) {
	$main_content .= "
	<tr>
		<td colspan=5>Não há registro de banimentos</td>
	</tr>";
} else {
	$bans =  $SQL->query("SELECT * FROM account_bans ORDER BY banned_at DESC LIMIT 50")->fetchAll();
	$count = 0;
	$number_of_rows = 0;
	foreach ($bans as $i => $ban) {
		$count++;
		$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
		$account = new Account();
		$account->load($ban["account_id"]);
		$jogador = 'None';
		if ($account->isLoaded()) {
			$players = $account->getPlayers();
			if (!empty($players->data)) {
				$account_players = $account->getPlayersList();
				foreach ($account_players as $account_player) {
					$jogador = $account_player->getName();
					break;
				}
			}
		}
		$main_content .= '
		<tr bgcolor=' . $bgcolor . '>
			<td align="center">' . $count . '</td>
			<td align="center">
					<a HREF="?subtopic=characters&name=' . urlencode($jogador) . '"><font color="red">' . (ucwords($jogador)) . '</font></a>
			</td>
			<td align="center">' . ($ban["reason"] == "" ? "Quebra de regra" : $ban["reason"]) . '</td>
			<td align="center"><font size="1">' . date("d/m/Y, H:i:s", $ban["banned_at"]) . '</font></td>
			<td align="center"><font size="1">' . ($ban["expires_at"] == -1 ? 'Permanente' : date("d/m/Y, H:i:s", $ban["expires_at"])) . '</font></td>
			';
		$ADM = new Player($ban["banned_by"]);
		$main_content .= '
			<td align="center">' . $ADM->getName() . '</td>
		</tr>';
	}
}
#TODO: aqui fica codigo para puxar informações da tabela de bans
$main_content .= '

	';
$main_content .= '
												</table>
											</div>
										</div>
										<div class="TableShadowContainer" >
											<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
												<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" ></div>
												<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
';
