<?php
if (!defined('INITIALIZED'))
	exit;
$main_content .= '
<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
			<div class="Text">War Anti-Entrosa ' . htmlspecialchars($config['server']['serverName']) . '</div>
			<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
			<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
			<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
		</div>
	</div>
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
														<tr>
															<td>Este sistema foi desenvolvido pela equipe ' . htmlspecialchars($config['server']['serverName']) . ' para que as Guilds travem batalhas sem que outros jogadores atrapalhem a performance. O sistema permite que 2 guilds façam suas guerras em um dos quatro mapas disponíveis, podendo personalizar o tempo limite de duração da guerra, a liberação ou bloqueio de spells, runas, montarias e/ou summons.<br>
															<br>As duas guilds interessadas precisam estar em guerra ativa, lideres de ambas as guilds precisam estar online para criar e aceitar o convite. Após o convite ser criado, junto com as condições da private war, o lider da outra guild precisa aceitar o convite. Quando o convite for aceito, os membros de ambas as guilds já podem utilizar o comando para entrar na private war.
															</td>
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
</div>
<br>
<div class="TableContainer" style="position:relative;">
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text">Commands</div>
					<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				</div>
			</div>

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
														<tr>
															<td width=50% align=center>!privatewar <b>go</b></td>
															<td width=50% align=center>Get inside the arena</td>
														</tr>
														<tr>
															<td width=50% align=center>!privatewar <b>help</b></td>
															<td width=50% align=center>Get more info about the command</td>
														</tr>
														<tr>
															<td width=50% align=center>!privatewar <b>invite, guildname</b></td>
															<td width=50% align=center>Invite a guild for a private war</td>
														</tr>
														<tr>
															<td width=50% align=center>!privatewar <b>reply</b></td>
															<td width=50% align=center>Answer a war invite</td>
														</tr>
														<tr>
															<td width=50% align=center>!privatewar <b>cancel</b></td>
															<td width=50% align=center>Cancel an invite sent by your guild</td>
														</tr>
														<tr>
															<td width=50% align=center>!privatewar <b>cancel war</b></td>
															<td width=50% align=center>Can be used only if your guild has accepted the invite and the private war isn\'t started yet</td>
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
</div>
<br>
<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/global/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<div class="Text">Allowed maps</font></div>
				<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					</div>
						</div>
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
																<tr>
																	<td width=100% align=center>Edron</td>
																</tr>
																<tr>
																	<td width=100% align=center>Yalahar</td>
																</tr>
																<tr>
																	<td width=100% align=center>Liberty Bay</td>
																</tr>
																<tr>
																	<td width=100% align=center>Darashia</td>
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
	</div>
<br>
<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/global/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<div class="Text">Time options (in minutes)</font></div>
				<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					</div>
						</div>
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
																<tr>
																	<td width=100% align=center>30</td>
																</tr>
																<tr>
																	<td width=100% align=center>60</td>
																</tr>
																<tr>
																	<td width=100% align=center>90</td>
																</tr>
																<tr>
																	<td width=100% align=center>120</td>
																</tr>
																<tr>
																	<td width=100% align=center>150</td>
																</tr>
																<tr>
																	<td width=100% align=center>180</td>
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
	</div>
<br>
<div class="TableContainer">
	<div class="CaptionContainer">
	<div class="CaptionInnerContainer">
		<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/global/images/content/box-frame-edge.gif);"></span>
		<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
		<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
		<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
		<div class="Text">Frag options</font></div>
		<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
		<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
		<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
		<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			</div>
				</div>
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
													<tr>
														<td width=100% align=center>0 (no limit)</td>
													</tr>
													<tr>
														<td width=100% align=center>10</td>
													</tr>
													<tr>
														<td width=100% align=center>20</td>
													</tr>
													<tr>
														<td width=100% align=center>30</td>
													</tr>
													<tr>
														<td width=100% align=center>50</td>
													</tr>
													<tr>
														<td width=100% align=center>100</td>
													</tr>
													<tr>
														<td width=100% align=center>150</td>
													</tr>
													<tr>
														<td width=100% align=center>200</td>
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
</div>
<br>
<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<div class="Text"><center>Block damage in area runes</center> </div>
					<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				</div>
					</div>
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
																	<table class="TableContent" width="30px" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center><img src="images/events/privatewar/runa.gif" /></center>
																		</td>
																		</tr>
																	</tbody></table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
																</div>
															</div>
														</td>
														<td>
															<div class="TableShadowContainerRightTop">
																<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
															</div>
															<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
																<div class="TableContentContainer">
																	<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center>
																			✔ Yes<br>
																			<small><font color="#FF0000">(Only sudden death rune will work)</font></small>
																			</center>
																		</td></tr>
																	</tbody></table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
																</div>
															</div>
														</td>
														<td>
															<div class="TableShadowContainerRightTop">
																<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
															</div>
															<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
																<div class="TableContentContainer">
																	<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center>
																			✘ No<br>
																			<small><font color="#FF0000">(Any rune will be allowed)</font></small>
																			</center>
																		</td></tr>
																	</tbody></table>
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
					</div>
<br>
<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<div class="Text"><center>Block ultimate spells</center> </div>
					<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				</div>
					</div>
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
																	<table class="TableContent" width="30px" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center><img src="images/events/privatewar/ue.png" /></center>
																		</td>
																		</tr>
																	</tbody></table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
																</div>
															</div>
														</td>
														<td>
															<div class="TableShadowContainerRightTop">
																<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
															</div>
															<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
																<div class="TableContentContainer">
																	<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center>
																			✔ Yes<br>
																			<small><font color="#FF0000">(Every ultimate spell will be blocked)</font></small>
																			</center>
																		</td></tr>
																	</tbody></table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
																</div>
															</div>
														</td>
														<td>
															<div class="TableShadowContainerRightTop">
																<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
															</div>
															<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
																<div class="TableContentContainer">
																	<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center>
																			✘ No<br>
																			<small><font color="#FF0000">(Any ultimate spell will be allowed)</font></small>
																			</center>
																		</td></tr>
																	</tbody></table>
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
					</div>
<br>
<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<div class="Text"><center>Block new ultimate potions</center> </div>
					<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				</div>
					</div>
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
																	<table class="TableContent" width="30px" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center><img src="images/events/privatewar/potion.gif" /></center>
																		</td>
																		</tr>
																	</tbody></table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
																</div>
															</div>
														</td>
															<td>
															<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
															<div class="TableContentContainer">
																<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																	<tbody><tr>
																		<td>
																		<center>
																		✔ Yes<br>
																		<small><font color="#FF0000">(Every ultimate potion will be blocked)</font></small>
																		</center>
																	</td></tr>
																</tbody></table>
															</div>
														</div>
														<div class="TableShadowContainer">
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
																<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
																<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
															</div>
														</div>
													</td>
													<td>
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
															<div class="TableContentContainer">
																<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																	<tbody><tr>
																		<td>
																		<center>
																		✘ No<br>
																		<small><font color="#FF0000">(Any ultimate potion will be allowed)</font></small>
																		</center>
																	</td></tr>
																</tbody></table>
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
					</div>
<br>
<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<div class="Text"><center>Block new summons</font></div>
					<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				</div>
					</div>
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
																	<table class="TableContent" width="30px" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center><img src="images/events/privatewar/summons.gif" /></center>
																		</td>
																		</tr>
																	</tbody></table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
																</div>
															</div>
														</td>
														<td>
															<div class="TableShadowContainerRightTop">
																<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
															</div>
															<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
																<div class="TableContentContainer">
																	<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center>
																			✔ Yes<br>
																			<small><font color="#FF0000">(Every summon spells will be blocked)</font></small>
																			</center>
																		</td></tr>
																	</tbody></table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
																</div>
															</div>
														</td>
														<td>
															<div class="TableShadowContainerRightTop">
																<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
															</div>
															<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
																<div class="TableContentContainer">
																	<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																		<tbody><tr>
																			<td>
																			<center>
																			✘ No<br>
																			<small><font color="#FF0000">(Any summon will be allowed)</font></small>
																			</center>
																		</td></tr>
																	</tbody></table>
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
					</div>
<br>
';
