<?php

/**
 *
 * @package        uam.skeleton
 * @subpackage     controllers
 * @author         Codenome Developpers - Main Developer: Ricardo <http://codenome.com>
 * @copyright      Copyright (c) 2018, Codenome. (http://myara.net/)
 * @license        GPL v3
 * @link           http://uam.codenome.com
 * @since          Version 0.0.1
 * @filesource
 */

$main_content .= '
				<table class="Table5" cellpadding="0" cellspacing="0" width="100%">
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
																		<td><img class="AccountStatusImage" src="' . $layout_name . '/images/account/account-status_green.gif" alt="free account"></td>
																		<td width="100%" valign="middle">';
function porcentagem_xn($porcentagem, $total)
{
	return ($porcentagem / 100) * $total;
}

$getBalance = $SQL->query("SELECT COALESCE(sum(abs(price)),0)+(select COALESCE(sum(abs(payment_amount)),0) q from pagseguro_transactions b where b.status = 'delivered' and YEAR(b.data) = YEAR(CURDATE()) and MONTH(b.data) = MONTH(CURDATE())) as price FROM `z_shop_donates` a WHERE YEAR(FROM_UNIXTIME(a.date)) = YEAR(CURDATE()) AND MONTH(FROM_UNIXTIME(a.date)) = MONTH(CURDATE()) AND a.status = 'received'")->fetchAll();

foreach ($getBalance as $balance) {
	$somaBalance += $balance['price'];
}

$profitTotal = $SQL->query("SELECT COALESCE(sum(abs(price)),0)+(select COALESCE(sum(abs(payment_amount)),0) q from pagseguro_transactions b where b.status = 'delivered') as price FROM `z_shop_donates` a WHERE a.status = 'received'")->fetchAll();
$main_content .= '
																			<span class="red">
																				<span class="BigBoldText">R$ ' . number_format($somaBalance, 2, ',', '.') . '</span>
																			</span>
																			<small>
																				<br>Saldo total de todas as doações realizadas no mês de ' . date('F') . '.<br>
																				<!--(' . $config['server']['ownerName'] . ' possui 50% dos lucros, um total de <span class="red">R$ ' . number_format(porcentagem_xn(50, $somaBalance), 2, ',', '.') . '--></span>
																			</small><br/>
																			<small>O total geral em vendas em todos os meses foi de <span style="color: #1c6a12">R$ ' . number_format($profitTotal[0]['price'], 2, ',', '.') . '</span></small>
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
			<br>';
$main_content .= '
			<div class="SmallBox" >
				<div class="MessageContainer" >
					<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
					<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
					<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
					<div class="Message">
						<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
						<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
						<table style="width:100%;" >
							<td style="width:100%;text-align:center;" ><nobr>[<a href="#Ultimos+Servicos" >Últimos serviços comprados</a>]</nobr> <nobr>[<a href="#Confirmed" >Daoações confirmadas</a>]</nobr> <nobr>[<a href="#Pagseguro" >Pagseguro</a>]</nobr> <nobr>[<a href="#Bank+Transfer" >Transferência bancárias</a>]</nobr> <nobr>[<a href="#Paypal" >Paypal</a>]</nobr> <nobr>[<a href="#PicPay" >PicPay</a>]</nobr> <nobr>[<a href="#MercadoPago" >Mercado Pago</a>]</nobr></td>
						</tr>
					</table>
				</div>
				<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
				<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
				<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
			</div>
		</div>
		<br/>';
$main_content .= '
				<a name="Ultimos+Servicos" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">5 últimos serviços comprados no site</div>
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
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">';
$get_Services = $SQL->query("SELECT * FROM `z_shop_payment` ORDER BY `date` DESC LIMIT 5")->fetchAll();
$getCountServices = $SQL->query("SELECT COUNT(*) FROM `z_shop_payment` WHERE `status` = 'received'")->fetchColumn();
if ($getCountServices > 0) {
	$main_content .= '
																	<tr>';
	foreach ($get_Services as $service) {
		$get_historyService = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `id` = '" . $service['service_id'] . "'")->fetch();
		$pathToService = "";
		if ($get_historyService['category'] == 2)
			$pathToService = "images/payment/" . $get_historyService['default_image'];
		elseif ($get_historyService['category'] == 4)
			$pathToService = "images/shop/outfits/" . strtolower(str_replace(" ", "_", $get_historyService['addon_name'])) . "_male.gif";
		elseif ($get_historyService['category'] == 3)
			$pathToService = "images/shop/mounts/" . str_replace(" ", "_", $get_historyService['offer_name']) . ".gif";
		elseif ($get_historyService['category'] == 5)
			$pathToService = "images/shop/items/" . $get_historyService['itemid'] . ".gif";

		$main_content .= '
																		<td>
																			<center>
																				<img src="' . $layout_name . '/' . $pathToService . '" alt="Tibiamax"/><br>
																				<small><strong>' . $get_historyService['offer_name'] . '</strong></small><br>
																				<small>(Comprado com a conta: <strong>' . $service['account_name'] . '</strong>)</small>
																			</center>
																		</td>';
	}
	$main_content .= '
																	</tr>';
} else
	$main_content .= '
																<tr bgcolor="' . $config['site']['lightborder'] . '">
																	<td colspan="5">Nenhum serviço comprado ainda.</td>
																</tr>';
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
											</tr>';
if ($getCountServices > 5)
	$main_content .= '
											<tr>
												<td align="center">
													<form method="post" action="?subtopic=adminpanel&action=historymore">
														<input type="hidden" name="service" value="items">
														<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_vermais.gif" >
															</div>
														</div>
													</form>

												</td>
											</tr>';
$main_content .= '
										</table>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div><br>';
$main_content .= '
				<a name="Confirmed" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">Últimas 10 doações confirmadas</div>
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
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">
																<tr bgcolor="#D4C0A1">';
$get_OrdersConfirmed = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `status` = 'confirmed' ORDER BY `date` DESC LIMIT 10")->fetchAll();
$getCountOrders = $SQL->query("SELECT COUNT(*) FROM `z_shop_donates` WHERE `status` = 'confirmed'")->fetchColumn();
$main_content .= '
																	<td class="LabelV">Date</td>
																	<td class="LabelV">Service</td>
																	<td class="LabelV">Price</td>																	
																	<td class="LabelV">Method</td>
																	<td class="LabelV">Bank Name</td>
																	<td class="LabelV">Status</td>
																	<td class="LabelV"></td>
																</tr>';

$n = 0;
if ($getCountOrders > 0)
	foreach ($get_OrdersConfirmed as $order) {
		$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																	<tr bgcolor="' . $bgcolor . '">
																		<td>' . date("M d Y, G:i:s", $order['date']) . '</td>
																		<td>' . $order['coins'] . ' Tibia Coins</td>
																		<td>' . $order['price'] . ' BRL</td>
																		<td>' . $order['method'] . '</td>';
		$bankref = explode("-", $order['reference']);
		$bankName = $bankref[1];
		$main_content .= '<td>' . $bankName . '</td>';
		$main_content .= '
																		<td>' . $order['status'] . '</td>
																		<td>' . (($order['status'] == "confirmed") ? '[<a href="?subtopic=adminpanel&action=sendPoints&orderID=' . $order['id'] . '">view</a>]' : '') . '</td>
																	</tr>';
	} else
	$main_content .= '
																<tr bgcolor="' . $config['site']['lightborder'] . '">
																	<td colspan="7">Nenhuma doação confirmada ainda.</td>
																</tr>';
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
						</tbody>
					</table>
				</div><br>';
$main_content .= '
				<a name="Pagseguro" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">10 últimas doações realizadas por PagSeguro</div>
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
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">
																<tr bgcolor="#D4C0A1">
																	<td class="LabelV">Data</td>
																	<td class="LabelV">Código da Transação</td>
																	<td class="LabelV">Nome da conta</td>
																	<td class="LabelV">Valor</td>
																	<td class="LabelV">Status</td>
																	
																</tr>';
$status_pagamento = array(
	1 => "Aguardando pagamento",
	2 => "Em análise",
	3 => "Paga",
	4 => "Disponivel",
	5 => "Em disputa",
	6 => "Devolvida",
	7 => "Cancelada",
	8 => "Chargeback debitado",
	9 => "Em contestação"
);
$get_Pagseguro = $SQL->query("SELECT * FROM `pagseguro_transactions` where `status` = 'DELIVERED' ORDER BY `data` DESC LIMIT 10")->fetchAll();
$getCountPagseguro = $SQL->query("SELECT COUNT(*) FROM `pagseguro_transactions`")->fetchColumn();
$n = 0;
if ($getCountPagseguro > 0)
	foreach ($get_Pagseguro as $pagseguro) {
		$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		//        $refPagseguro = explode("-",$pagseguro['reference']);
		//        $refPag = $refPagseguro[0];
		//        $getPriceService = $SQL->query("SELECT `price` FROM ``");
		$main_content .= '
																	<tr bgcolor="' . $bgcolor . '">
																		<td>' . $pagseguro['data'] . '</td>';
		$main_content .= '
																		<td>' . $pagseguro['transaction_code'] . '</td>
																		<td>' . $pagseguro['name'] . '</td>
																		<td>R$' . number_format($pagseguro['payment_amount'], 2, ',', '.') . '</td>
																		<td>' . $pagseguro['status'] . '</td>';
		//        $getReference = explode("-",$pagseguro['reference']);
		//        $pagseguroReference = $getReference[0];
		//        $getValor = $SQL->query("SELECT `price` FROM `z_shop_donates` WHERE `reference` = '$pagseguroReference'")->fetch();
		//        $main_content .= '
		//																		<td>'.number_format($getValor['price'], 2, ',', '.').'</td>
		//																		<td>'.$status_pagamento[$pagseguro['status']].'</td>';
		$main_content .= '
																	</tr>';
	} else
	$main_content .= '
																<tr bgcolor="' . $config['site']['lightborder'] . '">
																	<td colspan="5">Nenhuma doação realizada ainda.</td>
																</tr>';
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
											</tr>';
if ($getCountPagseguro > 10)
	$main_content .= '
											<tr>
												<td align="center">
													<form method="post" action="?subtopic=adminpanel&action=historymore">
														<input type="hidden" name="service" value="pagseguro">
														<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_vermais.gif" >
															</div>
														</div>
													</form>

												</td>
											</tr>';
$main_content .= '
										</table>
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div><br>';
$main_content .= '
				<a name="Bank+Transfer" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">10 últimas doações realizadas por transferência bancária</div>
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
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">
																<tr bgcolor="#D4C0A1">
																	<td class="LabelV">Data</td>
																	<td class="LabelV">Referência</td>
																	<td class="LabelV">Nome da conta</td>
																	<td class="LabelV">Valor</td>
																	<td class="LabelV">Status</td>
																</tr>';
$get_Transfers = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `method` = 'transfer' ORDER BY `date` DESC LIMIT 10")->fetchAll();
$getCountTransfers = $SQL->query("SELECT COUNT(*) FROM `z_shop_donates` WHERE `method` = 'transfer'")->fetchColumn();
$n = 0;
if ($getCountTransfers > 0)
	foreach ($get_Transfers as $transfer) {
		$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																	<tr bgcolor="' . $bgcolor . '">
																		<td>' . date("M d Y, G:i:s", $transfer['date']) . '</td>';
		$main_content .= '
																		<td>' . $transfer['reference'] . '</td>
																		<td>' . $transfer['account_name'] . '</td>
																		<td>' . number_format($transfer['price'], 2, ',', '.') . '</td>
																		<td>' . $transfer['status'] . '</td>';
		$main_content .= '
																	</tr>';
	} else
	$main_content .= '
																<tr bgcolor="' . $config['site']['lightborder'] . '">
																	<td colspan="5">Nenhuma doação realizada ainda.</td>
																</tr>';
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
											</tr>';
if ($getCountTransfers > 10)
	$main_content .= '
											<tr>
												<td align="center">
													<form method="post" action="?subtopic=adminpanel&action=historymore">
														<input type="hidden" name="service" value="transfer">
														<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_vermais.gif" >
															</div>
														</div>
													</form>

												</td>
											</tr>';
$main_content .= '
										</table>
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div><br>';
$main_content .= '
				<a name="Paypal" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">10 últimas doações realizadas por PayPal</div>
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
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">
																<tr bgcolor="#D4C0A1">
																	<td class="LabelV">Data</td>
																	<td class="LabelV">Referência</td>
																	<td class="LabelV">Nome da conta</td>
																	<td class="LabelV">Valor</td>
																	<td class="LabelV">Status</td>
																</tr>';
$get_Paypal = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `method` = 'paypal' ORDER BY `date` DESC LIMIT 10")->fetchAll();
$getCountPaypal = $SQL->query("SELECT COUNT(*) FROM `z_shop_donates` WHERE `method` = 'paypal'")->fetchColumn();
$n = 0;
if ($getCountPaypal > 0)
	foreach ($get_Paypal as $paypal) {
		$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																	<tr bgcolor="' . $bgcolor . '">
																		<td>' . date("M d Y, G:i:s", $paypal['date']) . '</td>';
		$main_content .= '
																		<td>' . $paypal['reference'] . '</td>
																		<td>' . $paypal['account_name'] . '</td>
																		<td>' . number_format($paypal['price'], 2, ',', '.') . '</td>
																		<td>' . $paypal['status'] . '</td>';
		$main_content .= '
																	</tr>';
	} else
	$main_content .= '
																<tr bgcolor="' . $config['site']['lightborder'] . '">
																	<td colspan="5">Nenhuma doação realizada ainda.</td>
																</tr>';
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
											</tr>';
if ($getCountPaypal > 10)
	$main_content .= '
											<tr>
												<td align="center">
													<form method="post" action="?subtopic=adminpanel&action=historymore">
														<input type="hidden" name="service" value="paypal">
														<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_vermais.gif" >
															</div>
														</div>
													</form>

												</td>
											</tr>';
$main_content .= '
										</table>
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div><br>';

$main_content .= '
				<a name="PicPay" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">10 últimas doações realizadas por PicPay</div>
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
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">
																<tr bgcolor="#D4C0A1">
																	<td class="LabelV">Data</td>
																	<td class="LabelV">Referência</td>
																	<td class="LabelV">Nome da conta</td>
																	<td class="LabelV">Valor</td>
																	<td class="LabelV">Status</td>
																</tr>';
$get_PicPay = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `method` = 'picpay' ORDER BY `date` DESC LIMIT 10")->fetchAll();
$getCountPicpay = $SQL->query("SELECT COUNT(*) FROM `z_shop_donates` WHERE `method` = 'picpay'")->fetchColumn();
$n = 0;
if ($getCountPicpay > 0)
	foreach ($get_PicPay as $picpay) {
		$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																	<tr bgcolor="' . $bgcolor . '">
																		<td>' . date("M d Y, G:i:s", $picpay['date']) . '</td>';
		$main_content .= '
																		<td>' . $picpay['reference'] . '</td>
																		<td>' . $picpay['account_name'] . '</td>
																		<td>' . number_format($picpay['price'], 2, ',', '.') . '</td>
																		<td>' . $picpay['status'] . '</td>';
		$main_content .= '
																	</tr>';
	} else
	$main_content .= '
																<tr bgcolor="' . $config['site']['lightborder'] . '">
																	<td colspan="5">Nenhuma doação realizada ainda.</td>
																</tr>';
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
											</tr>';
if ($getCountPicpay > 10)
	$main_content .= '
											<tr>
												<td align="center">
													<form method="post" action="?subtopic=adminpanel&action=historymore">
														<input type="hidden" name="service" value="picpay">
														<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_vermais.gif" >
															</div>
														</div>
													</form>

												</td>
											</tr>';
$main_content .= '
										</table>
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div><br>';



$main_content .= '
				<a name="MercadoPago" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">10 últimas doações realizadas por Mercado Pago</div>
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
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">
																<tr bgcolor="#D4C0A1">
																	<td class="LabelV">Data</td>
																	<td class="LabelV">Referência</td>
																	<td class="LabelV">Nome da conta</td>
																	<td class="LabelV">Valor</td>
																	<td class="LabelV">Status</td>
																</tr>';
$get_mercadoPago = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `method` = 'mercadoPago' ORDER BY `date` DESC LIMIT 10")->fetchAll();
$getCountmercadoPago = $SQL->query("SELECT COUNT(*) FROM `z_shop_donates` WHERE `method` = 'mercadoPago'")->fetchColumn();
$n = 0;
if ($getCountmercadoPago > 0)
	foreach ($get_mercadoPago as $mercadoPago) {
		$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																	<tr bgcolor="' . $bgcolor . '">
																		<td>' . date("M d Y, G:i:s", $mercadoPago['date']) . '</td>';
		$main_content .= '
																		<td>' . $mercadoPago['reference'] . '</td>
																		<td>' . $mercadoPago['account_name'] . '</td>
																		<td>' . number_format($mercadoPago['price'], 2, ',', '.') . '</td>
																		<td>' . $mercadoPago['status'] . '</td>';
		$main_content .= '
																	</tr>';
	} else
	$main_content .= '
																<tr bgcolor="' . $config['site']['lightborder'] . '">
																	<td colspan="5">Nenhuma doação realizada ainda.</td>
																</tr>';
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
											</tr>';
if ($getCountPicpay > 10)
	$main_content .= '
											<tr>
												<td align="center">
													<form method="post" action="?subtopic=adminpanel&action=historymore">
														<input type="hidden" name="service" value="mercadoPago">
														<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_vermais.gif" >
															</div>
														</div>
													</form>

												</td>
											</tr>';
$main_content .= '
										</table>
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div><br>';


$main_content .= '
				<center>
					<form method="post" action="?subtopic=adminpanel">
						<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
							<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
								<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
							</div>
						</div>
					</form>
				</center>';
