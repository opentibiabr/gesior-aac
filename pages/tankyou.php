<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 27/12/2017
 * Time: 10:17
 */

require './config/config.php';
// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);
// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);
define('INITIALIZED', true);
if (!defined('ONLY_PAGE'))
	define('ONLY_PAGE', true);
// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');
// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');
// DATABASE
include_once('./system/load.database.php');
if (DEBUG_DATABASE)
	Website::getDBHandle()->setPrintQueries(true);
if (DEBUG_DATABASE)
	Website::getDBHandle()->setPrintQueries(true);

if (isset($_REQUEST['tcode'])) {
	$tcode = $_REQUEST['tcode'];
	$code_status = $SQL->query("SELECT * FROM `pagseguro_transactions` WHERE `transaction_code` = '{$tcode}'")->fetchAll();
	$count = count($code_status);
	$code_status = $code_status[0];
	if ($count > 0) {
		$main_content = '
		<div class="TableContainer" >
			<table class="Table1" cellpadding="0" cellspacing="0">
				<div class="CaptionContainer" >
					<div class="CaptionInnerContainer" >
						<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
						<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
						<div class="Text" >Thanks for the donation!</div>
						<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
						<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
						<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					</div>
				</div>
				<tr>
					<td>
						<div class="InnerTableContainer" >
							<table style="width:100%;" >
								<p>You have been donated ' . $code_status["item_count"] . ' ' . $config['pagseguro']['produtoNome'] . ' on ' . date("d/m/Y", time($code_status["data"])) . '.</p>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<br/>
		<div class="TableContainer">
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text">Donation data</div>
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
															<td class="LabelV">Date</td>
															<td class="LabelV">Account Name</td>
															<td class="LabelV">Value</td>
															<td class="LabelV">Status</td>
														</tr>
														<tr bgcolor="#F1E0C6">
															<td>' . date("d/m/Y", time($code_status["data"])) . '</td>
															<td>' . $code_status["name"] . '</td>
															<td>R$ ' . $code_status["payment_amount"] . '.00</td>
															<td>' . $code_status["status"] . '</td>
														</tr>
													</table>
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
		</div>
		';
	} else {
		header("Location: ./");
	}
} else {
	header("Location: ./");
}
