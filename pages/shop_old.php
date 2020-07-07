<?php
$descontinuado = true;
if (!$descontinuado) {


	$main_content .= '
		<script>
			// mouse over effect for payment methods
			function MouseOverPMCID(a_PMCID) {
				$(\'#PMCID_Icon_Over_\' + a_PMCID).css(\'background-image\', \'url(\' + JS_DIR_IMAGES + \'payment/pmcid_icon_over.png)\');
			}
			// mouse out effect for payment methods
			function MouseOutPMCID(a_PMCID) {
				$(\'#PMCID_Icon_Over_\' + a_PMCID).css(\'background-image\', \'\');
			}

			// mouse over effect for products

			function MouseOverServiceID(a_ServiceID, a_ServiceCategoryID) {
				$(\'#ServiceID_Icon_Over_\' + a_ServiceID).css(\'background-image\', \'url(\' + JS_DIR_IMAGES + \'payment/serviceid_icon_over.png)\');
				if (a_ServiceCategoryID == g_QF_Mounts_ServiceCategoryID || a_ServiceCategoryID == g_QF_Outfits_ServiceCategoryID) {
					$(\'#ServiceID_Icon_Animation_1_\' + a_ServiceID).show();
					$(\'#ServiceID_Icon_New_\' + a_ServiceID).hide();
				}
			}
			// mouse out effect for products

			function MouseOutServiceID(a_ServiceID, a_ServiceCategoryID) {
				$(\'#ServiceID_Icon_Over_\' + a_ServiceID).css(\'background-image\', \'\');
				// mounts have an animation
				if ((a_ServiceCategoryID == g_QF_Mounts_ServiceCategoryID || a_ServiceCategoryID == g_QF_Outfits_ServiceCategoryID) && ($(\'#ServiceID_\' + a_ServiceID).attr(\'checked\') != \'checked\')) {
					$(\'#ServiceID_Icon_Animation_1_\' + a_ServiceID).hide();
					$(\'#ServiceID_Icon_New_\' + a_ServiceID).show();
				}
			}
		</script>';
	$main_content .= '
		<center>
			<table>
				<tbody>
					<tr>
						<td><img src="' . $layout_name . '/images/global/content/headline-bracer-left.gif"></td>
						<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Shop Online<br></td>
						<td><img src="' . $layout_name . '/images/global/content/headline-bracer-right.gif"></td>
					</tr>
				</tbody>
			</table>
		</center>
		<p>Below you will see some services that we offer in our online shop, also items, addons and mounts. This shop is simply for you to be inside of new offers that will be shown here, because to make the purchase you must go to the <a href="?subtopic=accountmanagement&action=manage#Products+Available">page of your account</a>.</p>';

	if (!isset($_REQUEST['ServiceCategoryID']) || $_REQUEST['ServiceCategoryID'] == "")
		$serviceCategoryId = 2;
	else $serviceCategoryId = $_REQUEST['ServiceCategoryID'];

	$doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
	$main_content .= '
	<style>
		.ribbonShop-double {
		background:url(' . $layout_name . '/images/shop/ribbon-double.png) no-repeat;
		width: 80px;
		height: 80px;
		position:absolute;
		right: -5px;
		top: -5px;
		z-index:999;
		}
	</style>';

	$main_content .= '
		<div class="TableContainer" style="position:relative;">
		' . (($doubleStatus['value'] == "active") ? '<div class="ribbonShop-double"></div>' : '') . '
			<table class="Table5" cellpadding="0" cellspacing="0">
			<div class="CaptionContainer" >
				<div class="CaptionInnerContainer" >
					<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
					<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
					<div class="Text" >Shop Online</div>
					<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
					<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
				</div>
			</div>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;" >';
	#menu
	$main_content .= '
							<tr>
								<td>';
	$getCat = $SQL->query("SELECT * FROM `z_shop_category` WHERE `hide` = 0 ORDER BY `id` ASC")->fetchAll();

	foreach ($getCat as $category) {
		$main_content .= '
									<span class="HelperDivIndicator" onMouseOver="ActivateHelperDiv($(this), \'' . $category['name'] . '\', \'' . $category['desc'] . '\', \'ProductCategoryHelperDiv_' . $category['id'] . '\');" onMouseOut="$(\'#HelperDivContainer\').hide();" >
										<div class="InnerTableTab ' . (($serviceCategoryId == $category['id']) ? 'ActiveInnerTableTab' : '') . '">
											<div id="ProductCategoryHelperDiv_' . $category['id'] . '" class="ProductCategoryHelperDiv" ></div>
											<a href="?subtopic=shop&ServiceCategoryID=' . $category['id'] . '">
												<img src="' . $layout_name . '/images/payment/products_tab_' . (($serviceCategoryId == $category['id']) ? '' : 'non') . 'active.png" />
												<div class="InnerTableTabLabel" >' . $category['name'] . '</div>';
		$newCategory = $category['id'];
		$getNews = $SQL->query("SELECT `offer_date` FROM `z_shop_offer` WHERE `category` = '$newCategory' ORDER BY `offer_date` DESC LIMIT 1")->fetch();
		if ((time() - ($config['shop']['newitemdays'] * 86400)) < $getNews['offer_date'])
			$main_content .= '<div class="RibbonNewProduct" style="background-image: url(' . $layout_name . '/images/payment/ribbon-tab-new-product' . (($serviceCategoryId == $category['id']) ? '_active' : '') . '.png);" ></div>';

		$main_content .= '
											</a>
										</div>
									</span>';
	}

	$main_content .= '
								</td>
							</tr>';
	#services

	$main_content .= '
							<tr>
								<td>
									<div class="TableShadowContainerRightTop" >
										<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
									</div>
									<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
										<div class="TableContentContainer" >
											<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
												<tr>
													<td style="text-align: center;" align="center" >
														<div style="max-height: 500px; min-height: 100px; overflow-y: auto;">';

	$getProducts = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `category` = '$serviceCategoryId' AND `hide` = 0 ORDER BY `offer_date` DESC")->fetchAll();

	if (count($getProducts) >= 1)
		foreach ($getProducts as $product) {

			$main_content .= '
																<div class="ServiceID_Icon_Container" id="ServiceID_Icon_Container_' . $product['id'] . '">
																	<div class="ServiceID_Icon_Container_Background" id="" style="background-image:url(' . $layout_name . '/images/payment/serviceid_icon_normal.png);" >
																		<div class="ServiceID_Icon" id="ServiceID_Icon_' . $product['id'] . '" ' . (($product['category'] == 2) ? 'style="background-image:url(' . $layout_name . '/images/payment/' . $product['default_image'] . ');"' : '') . ' onclick="ChangeService(' . $product['id'] . ', ' . $product['category'] . ');" onmouseover="MouseOverServiceID(' . $product['id'] . ', ' . $product['category'] . ');" onmouseout="MouseOutServiceID(' . $product['id'] . ', ' . $product['category'] . ');" >
																			<div class="PermanentDeactivated" >';
			if (!empty($product['offer_description']))
				$main_content .= '
																				<span class="HelperDivIndicator" onMouseOver="ActivateHelperDiv($(this), \'' . $product['offer_name'] . '\', \'' . $product['offer_description'] . '\', \'\');" onMouseOut="$(\'#HelperDivContainer\').hide();" >';
			$main_content .= '
																					<div class="ServiceID_HelperDiv" ></div>
																				</span>
																			</div>
																			<div class="PermanentDeactivated ServiceID_Deactivated_ByChoice" id="ServiceID_NotAllowed_' . $product['id'] . '" style="display: none;" >
																				<span class="HelperDivIndicator" onMouseOver="ActivateHelperDiv($(this), \'Service Info:\', \'&lt;p&gt;The product is not available for the selected payment method!&lt;/p&gt;\', \'\');" onMouseOut="$(\'#HelperDivContainer\').hide();" >
																					<div class="ServiceID_Deactivated" style="background-image: url(' . $layout_name . '/images/payment/serviceid_deactivated.png);" ></div>
																				</span>
																			</div>';
			if ((time() - ($config['shop']['newitemdays'] * 86400)) < $product['offer_date'])
				$main_content .= '
																			<div class="RibbonNewProduct" style="background-image: url(' . $layout_name . '/images/payment/ribbon-new-product.png);"></div>
																			<div class="PermanentDeactivated" >
																				<span class="HelperDivIndicator" onMouseOver="ActivateHelperDiv($(this), \'New Product!\', \'We have a new product for you in store - the &lt;b&gt;' . $product['offer_name'] . '&lt;/b&gt;.\', \'\');" onMouseOut="$(\'#HelperDivContainer\').hide();" >
																					<div class="ServiceID_HelperDiv" style="z-index: 999;" ></div>
																				</span>
																			</div>';
			if ($product['category'] == 4) {
				$main_content .= '
																			<div class="ServiceID_Icon_New" id="ServiceID_Icon_New_' . $product['id'] . '" style="background-image:url(' . $layout_name . '/images/shop/outfits/' . strtolower(str_replace(" ", "_", $product['addon_name'])) . '_male.gif); background-repeat:no-repeat; margin:5px 0;" ></div>
																			<div class="ServiceID_Icon_New" id="ServiceID_Icon_New_' . $product['id'] . '" style="background-image:url(' . $layout_name . '/images/shop/outfits/' . strtolower(str_replace(" ", "_", $product['addon_name'])) . '_female.gif); background-repeat:no-repeat; margin:5px 60px;" ></div>';
			}
			if ($product['category'] == 5)
				$main_content .= '
																			<div class="ServiceID_Icon_New" id="ServiceID_Icon_New_' . $product['id'] . '" style="background-image:url(' . $layout_name . '/images/shop/items/' . $product['itemid'] . '.gif); background-repeat:no-repeat; margin:20px 45px;" ></div>';
			if ($product['category'] == 3) {
				$main_content .= '
																			<div class="ServiceID_Icon_New" id="ServiceID_Icon_New_' . $product['id'] . '" style="background-image:url(' . $layout_name . '/images/shop/mounts/' . str_replace(" ", "_", $product['offer_name']) . '.gif); background-repeat:no-repeat; margin:-5px 22px;" ></div>';
			}
			if ($product['category'] == 6) {
				$main_content .= '
																			<div class="ServiceID_Icon_New" id="ServiceID_Icon_New_' . $product['id'] . '" style="background-image:url(' . $layout_name . '/images/shop/points.gif); background-repeat:no-repeat; margin:20px 45px;" ></div>';
			}

			$main_content .= '
																			<div class="ServiceID_Icon_Selected" id="ServiceID_Icon_Selected_' . $product['id'] . '" ></div>
																			<div class="ServiceID_Icon_Over" id="ServiceID_Icon_Over_' . $product['id'] . '" ></div>';
			$main_content .= '
																			<div class="ServiceID_Icon_Animation_1" id="ServiceID_Icon_Animation_1_' . $product['id'] . '" style="background-image: url(' . $layout_name . '/images/shop/items/serviceid_' . $product['id'] . '_animation_1.gif);" ></div>';
			$main_content .= '
																			<label for="ServiceID_' . $product['id'] . '" >
																				<div class="ServiceIDLabelContainer" >
																					<div class="ServiceIDLabel" >
																						<input type="radio" id="ServiceID_' . $product['id'] . '" class="ServiceID" name="ServiceID" value="' . $product['id'] . '" />
																						' . $product['offer_name'] . ' </div>
																				</div>
																				<div class="ServiceIDPriceContainer" ><span class="ServiceIDPrice" id="PD_' . $product['id'] . '" >' . $product['coins'] . ' Coins</span></div>
																			</label>
																		</div>
																	</div>
																</div>';
		} else {
		if ($serviceCategoryId == 2)
			$itemName = "Extra Services";
		if ($serviceCategoryId == 3)
			$itemName = "Mounts";
		if ($serviceCategoryId == 4)
			$itemName = "Outfits";
		if ($serviceCategoryId == 5)
			$itemName = "Items";

		$main_content .= '<p>None <strong>' . $itemName . '</strong> has been added for sale yet .</p>';
	}
	$main_content .= '
														</div>
													</td>
												</tr>
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
	$main_content .= '
						</table>
					</div>
				</td>
			</tr>
		</table>
	</div>';
} else {
	$main_content .= 'SISTEMA TOTALMENTE DESCONTINUADO';
}
