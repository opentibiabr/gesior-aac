<?php
	if(!defined('INITIALIZED'))
		exit;
	if($group_id_of_acc_logged < $config['site']['access_admin_panel']) {
		header("location:index.php?subtopic=latestnews");
		return false;
	}
	if($group_id_of_acc_logged >= $config['site']['access_admin_panel']) {		
		$main_content .= '
				<div class="TableContainer">
					<div class="CaptionContainer">
							<div class="CaptionInnerContainer">
								<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>								
								<div class="Text"> Open Tickets </div>
								<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
								<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
							</div>
						</div><table class="Table3" cellpadding="0" cellspacing="0">
						
						<tbody><tr>
							<td>
								<div class="InnerTableContainer">
									<table style="width:100%;">
										<tbody><tr>
											<td><div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);"></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="TableContent" width="100%">
															<tbody><tr style="background-color:#D4C0A1;">
																	<td class="LabelV">Ticket</td>
																	<td class="LabelV">Player</td>
																	<td class="LabelV">Subject</td>
																	<td class="LabelV">Status</td>
																	<td class="LabelV">Last answer</td>
																	<td class="LabelV">Category</td>
															</tr>';
															$accId = $account_logged->getID();
															$ticketsOpen = $SQL->query("SELECT * FROM tickets WHERE ticket_status = 'Waiting' AND ticket_admin_reply = 0");
															foreach($ticketsOpen as $resultadoOpen){
															$main_content .= '<tr bgcolor="">
																		<td width="75%">
																			<a href="?subtopic=ticket&amp;action=showticket&amp;do=number&amp;id='.$resultadoOpen['ticket_id'].'">#'.$resultadoOpen['ticket_id'].'</a>
																		</td>
																		<td>
																			<nobr>
																				<small>
																					<a href="?subtopic=characters&amp;name='.$resultadoOpen['ticket_author'].'">'.$resultadoOpen['ticket_author'].'</a>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoOpen['ticket_subject'].'</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small><font color="gray"><b>'.$resultadoOpen['ticket_status'].'</font>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoOpen['ticket_last_reply'].'</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoOpen['ticket_category'].'</small>
																			</nobr>
																		</td>
																	</tr>';
																}
																
															$main_content .= '</tbody>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);">
														<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
														<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>
													</div>
												</div>
											</td>
										</tr>
									</tbody></table>
								</div>
							</td>
						</tr>
					</tbody></table>
				</div>
				<br>
				
				<div class="TableContainer">
					<div class="CaptionContainer">
							<div class="CaptionInnerContainer">
								<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>								
								<div class="Text"> Tickets aguardando resposta do player</div>
								<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
								<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
							</div>
						</div><table class="Table3" cellpadding="0" cellspacing="0">
						
						<tbody><tr>
							<td>
								<div class="InnerTableContainer">
									<table style="width:100%;">
										<tbody><tr>
											<td><div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);"></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="TableContent" width="100%">
															<tbody><tr style="background-color:#D4C0A1;">
																	<td class="LabelV">Ticket</td>
																	<td class="LabelV">Player</td>
																	<td class="LabelV">Subject</td>
																	<td class="LabelV">Status</td>
																	<td class="LabelV">Last answer</td>
																	<td class="LabelV">Category</td>
															</tr>';
															$accId = $account_logged->getID();
															$ticketsOpen = $SQL->query("SELECT * FROM tickets WHERE ticket_status = 'Waiting' AND ticket_admin_reply = 1");
															foreach($ticketsOpen as $resultadoOpen){
															$main_content .= '<tr bgcolor="">
																		<td width="75%">
																			<a href="?subtopic=ticket&amp;action=showticket&amp;do=number&amp;id='.$resultadoOpen['ticket_id'].'">#'.$resultadoOpen['ticket_id'].'</a>
																		</td>
																		<td>
																			<nobr>
																				<small>
																					<a href="?subtopic=characters&amp;name='.$resultadoOpen['ticket_author'].'">'.$resultadoOpen['ticket_author'].'</a>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoOpen['ticket_subject'].'</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small><font color="gray"><b>'.$resultadoOpen['ticket_status'].'</font>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoOpen['ticket_last_reply'].'</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoOpen['ticket_category'].'</small>
																			</nobr>
																		</td>
																	</tr>';
																}
																
															$main_content .= '</tbody>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);">
														<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
														<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>
													</div>
												</div>
											</td>
										</tr>
									</tbody></table>
								</div>
							</td>
						</tr>
					</tbody></table>
				</div>
				<br>
				
				<div class="TableContainer">
					<div class="CaptionContainer">
							<div class="CaptionInnerContainer">
								<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>								
								<div class="Text"> Closed Tickets </div>
								<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
								<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
							</div>
						</div><table class="Table3" cellpadding="0" cellspacing="0">
						
						<tbody><tr>
							<td><div class="InnerTableContainer">
									<table style="width:100%;">
										<tbody><tr>
											<td><div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);"></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="TableContent" width="100%">
															<tbody><tr style="background-color:#D4C0A1;">
																	<td class="LabelV">Ticket</td>
																	<td class="LabelV">Player</td>
																	<td class="LabelV">Subject</td>
																	<td class="LabelV">Status</td>
																	<td class="LabelV">Last answer</td>
																	<td class="LabelV">Category</td>
															</tr>';
															$accId = $account_logged->getID();
															$ticketsClosed = $SQL->query("SELECT * FROM tickets WHERE ticket_status = 'Closed'");
															foreach($ticketsClosed as $resultadoClosed){
															$main_content .= '<tr bgcolor="">
																		<td width="75%">
																			<a href="?subtopic=ticket&amp;action=showticket&amp;do=number&amp;id='.$resultadoClosed['ticket_id'].'">#'.$resultadoClosed['ticket_id'].'</a>
																		</td>
																		<td>
																			<nobr>
																				<small>
																					<a href="?subtopic=characters&amp;name='.$resultadoClosed['ticket_author'].'">'.$resultadoClosed['ticket_author'].'</a>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoClosed['ticket_subject'].'</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small><font color="red"><b>'.$resultadoClosed['ticket_status'].'</font>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoClosed['ticket_last_reply'].'</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoClosed['ticket_category'].'</small>
																			</nobr>
																		</td>
																	</tr>';
																}
															$main_content .= '</tbody>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);">
														<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
														<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>
													</div>
												</div>
											</td>
										</tr>
									</tbody></table>
								</div>
							</td>
						</tr>
					</tbody>
					</table>
			</div>';	
	}		
?>