<?php
if(!defined('INITIALIZED')) exit;
if($logged){
    $main_content = "
    
    <div class=\"TableContainer\">
					<div class=\"CaptionContainer\">
							<div class=\"CaptionInnerContainer\">
								<span class=\"CaptionEdgeLeftTop\" style=\"background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);\"></span>
								<span class=\"CaptionEdgeRightTop\" style=\"background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);\"></span>
								<span class=\"CaptionBorderTop\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);\"></span>
								<span class=\"CaptionVerticalLeft\" style=\"background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);\"></span>								
								<div class=\"Text\">Tickets</div>
								<span class=\"CaptionVerticalRight\" style=\"background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);\"></span>
								<span class=\"CaptionBorderBottom\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);\"></span>
								<span class=\"CaptionEdgeLeftBottom\" style=\"background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);\"></span>
								<span class=\"CaptionEdgeRightBottom\" style=\"background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);\"></span>
							</div>
						</div><table class=\"Table3\" cellpadding=\"0\" cellspacing=\"0\">				
						<tbody><tr>
							<td>
								<div class=\"InnerTableContainer\">
										<table style=\"width:100%;\">
											<tbody><tr>
												<td>
													<div class=\"TableShadowContainerRightTop\">
														<div class=\"TableShadowRightTop\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);\"></div>
													</div>
													<div class=\"TableContentAndRightShadow\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);\">
														<div class=\"TableContentContainer\">
															<table class=\"TableContent\" width=\"100%\" style=\"border:1px solid #faf0d7;\">
																<tbody><tr>
																	<td>
																		<div style=\"float: right; margin-top: 7px;\">
																			<form action=\"?subtopic=ticket\" method=\"post\" style=\"padding:0px;margin:0px;\">
																				<div class=\"MediumButtonBackground\" style=\"background-image:url(./layouts/tibiacom/images/global/buttons/mediumbutton.gif)\" onmouseover=\"MouseOverMediumButton(this);\" onmouseout=\"MouseOutMediumButton(this);\"><div class=\"MediumButtonOver\" style=\"background-image: url(&quot;./layouts/tibiacom/images/global/buttons/mediumbutton-over.gif&quot;); visibility: hidden;\" onmouseover=\"MouseOverMediumButton(this);\" onmouseout=\"MouseOutMediumButton(this);\"></div><input class=\"MediumButtonText\" type=\"image\" name=\"Open Ticket\" alt=\"Open Ticket\" src=\"./layouts/tibiacom/images/global/buttons/open_ticket.png\"></div>
																			</form>
																		</div>
																		<b>Open a support ticket</b>
																		<span class=\"HelperDivIndicator\" onmouseover=\"ActivateHelperDiv($(this), 'Ticket System:', '<p><b>Recommended:</b><ul><li>Fill in all required fields.</li><li>Lack of respect for inappropriate use will have consequences.</li><li>If necessary post screenshots to facilitate our understanding of the problem.</li></ul>', '');\" onmouseout=\"$('#HelperDivContainer').hide();\">
																		<img style=\"border:0px;\" src=\"./layouts/tibiacom/images/global/content/info.gif\"></span>
																		<br>
																		<small>Support for the various questions you have.</small><br>
																		<p>Use this tool with caution because only then can we work for the server progress, help us know what problems you have faced along his journey through in OTXServer-Global.</p>
																	</td>
																</tr>	
															</tbody></table>
														</div>
													</div>
													<div class=\"TableShadowContainer\">
														<div class=\"TableBottomShadow\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);\">
															<div class=\"TableBottomLeftShadow\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);\"></div>
															<div class=\"TableBottomRightShadow\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);\"></div>
														</div>
													</div>
												<p>	
												</p><div class=\"TableContentAndRightShadow\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);\">
													<div class=\"TableContentContainer\">
														<table class=\"TableContent\" width=\"100%\">
															<tbody>
															<tr style=\"background-color:#D4C0A1;\">
																	<td class=\"LabelV\">Ticket</td>
																	<td class=\"LabelV\">Player</td>
																	<td class=\"LabelV\">Subject</td>
																	<td class=\"LabelV\">Status</td>
																	<td class=\"LabelV\">Last answer</td>
																	<td class=\"LabelV\">Category</td>
															</tr>
															";
                                                        $account_id = $account_logged->getID();
                                                        $tickets = $SQL->query("SELECT * FROM `tickets` WHERE `ticket_author_acc_id` = ".$account_id." ORDER BY `ticket_date` DESC");
                                                        if($tickets){
                                                            foreach ($tickets as $tickets_content){
                                                                $main_content .= "
                                                                <tr>
                                                                    <td><a href='?subtopic=ticket&amp;action=showticket&amp;do=number&amp;id={$tickets_content['ticket_id']}'>#{$tickets_content['ticket_id']}</a></td>
                                                                    <td><a href='?subtopic=characters&amp;name={$tickets_content['ticket_author']}'>{$tickets_content['ticket_author']}</td>
                                                                    <td>{$tickets_content['ticket_subject']}</td>";
                                                        if($tickets_content['ticket_status'] == "Waiting"){
                                                            $main_content .= "
                                                                    <td style='color: gray !important;'>{$tickets_content['ticket_status']}</td>";
                                                        }elseif ($tickets_content['ticket_status'] == "Closed"){
                                                            $main_content .= "
                                                                    <td style='color: red !important;'>{$tickets_content['ticket_status']}</td>";
                                                        }else{
                                                            $main_content .= "
                                                                    <td>{$tickets_content['ticket_status']}</td>";
                                                        }
                                                        $main_content .= "
                                                                    <td>{$tickets_content['ticket_last_reply']}</td>
                                                                    <td>{$tickets_content['ticket_category']}</td>
                                                                </tr>
                                                                ";
                                                            }
                                                        }
    $main_content .= "
															</tbody>
														</table>
													</div>
												</div>
												<div class=\"TableShadowContainer\">
													<div class=\"TableBottomShadow\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);\">
														<div class=\"TableBottomLeftShadow\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);\"></div>
														<div class=\"TableBottomRightShadow\" style=\"background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);\"></div>
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
    
    ";
}