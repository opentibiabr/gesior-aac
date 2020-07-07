<?php
/**
* Created by PhpStorm.
* User: Ricardo
* Date: 17/03/2018
* Time: 22:33
*/

include_once "system/load.newclasses.php";

$player_id = (int) $_REQUEST['id'];
if (isset($_REQUEST['id'])) {
	$player_information = new Player($player_id);
	if ($player_information->isLoaded()) {
		$query = $SQL->prepare("SELECT * FROM account_character_sale WHERE id_player = :id");
		$query->execute(['id' => $player_id]);
		$sell_information = $query->fetch();
		$valida_id = $query->rowCount();

		if ($valida_id > 0) {
			$main_content .= '<div class="TableContainer">';
			$main_content .= $make_content_header("Character Information");
			$main_content .= $make_table_header();
			$main_content .= '<tr bgcolor="#D4C0A1">
			<td><strong>Character Value:</strong></td>';
			$main_content .= "<td>" . ($sell_information['price_type'] == 0 ? $sell_information['price_coins'] . " Coins" : $sell_information['price_gold'] . " Gold") . " <br/>";

			if ($sell_information['price_type'] == 0) {
				if ($sell_information['price_coins'] < $account_logged->getPremiumPoints()) {
				$main_content .= "<p style='margin: 0; color: #1c6a12 !important; font-size: .8em'>Current Balance: ". $account_logged->getPremiumPoints() . " Tibia Coins</p>";
				} else {
				$main_content .= "<p style='margin: 0; color: #5b0600 !important; font-size: .8em'>Current Balance: ". $account_logged->getPremiumPoints() . " Tibia Coins</p>";
				}
			} else { // else price type
				if ($account_logged->getPlayersList()->data != null) {
					foreach ($account_logged->getPlayersList()->data as $balance) {
						if ($sell_information['price_gold'] < $balance['balance']) {
							$main_content .= "<p style='margin: 0; color: #1c6a12 !important; font-size: .8em'>Current Balance: " . $balance['balance'] . " - on player (" . $balance['name'] . ")</p>";
						} else {
							$main_content .= "<p style='margin: 0; color: #5b0600 !important; font-size: .8em'>Current Balance: ". $balance['balance'] . " - on player (". $balance['name'] .")</p>";
						}
					}
				}
			}
			$main_content .= '</td></tr></tbody></table></div></div><div class="TableShadowContainer"><div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);"><div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);"></div><div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div></div></div></td></tr><tr><td><div class="TableShadowContainerRightTop"><div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div></div><div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);"><div class="TableContentContainer"><table class="TableContent" width="100%"><tbody><tr bgcolor="#D4C0A1"><td><strong>Character</strong></td><td><strong>Inventário</strong></td><td><strong>Addons</strong></td></tr>';

			$player_info = $player_information->data;
			$mount_id = $player_information->getStorage('10002011');
			$main_content .= '<tr bgcolor="#F1E0C6"><td width="33%" rowspan="3"><center>';
			$main_content .= "<img style='text-decoration:none;margin: 0 0 0 -13px;' class='outfitImgsell2' src='https://outfits.ferobraglobal.com/animoutfit.php?id={$player_info['looktype']}&addons={$player_info['lookaddons']}&head={$player_info['lookhead']}&body={$player_info['lookbody']}&legs={$player_info['looklegs']}&feet={$player_info['lookfeet']}&mount=" . ($mount_id == null ? 0 : $mount_id) . "' alt='' name=''>";
			$main_content .= '<br>
				<a href="?subtopic=characters&amp;name=' . urlencode(strtolower($player_information->getName())) . '">' . $player_information->getName() . '</a><br>
				<font size="1">(' . $player_information->getVocationName() . ')<br>';
			$main_content .= '<table width="100%" border="0" cellspacing="0" cellpadding="1"><tbody><tr bgcolor="#505050"></tr><tr bgcolor="#D4C0A1">
							<td><font size="1"><b>Level:</b></font></td><td width="70%"><font size="1">' . $player_information->getLevel() . '</font></td>
							</tr>
							<tr bgcolor="#F1E0C6">
							<td><font size="1"><b>Magic:</b></font></td><td width="70%"><font size="1">' . $player_information->getMagLevel() . '</font></td>
							</tr>
							<tr bgcolor="#D4C0A1">
							<td><font size="1"><b>Fist:</b></font></td><td width="70%"><font size="1">' . $player_information->getSkill(0) . '</font></td>
							</tr>
							<tr bgcolor="#F1E0C6">
							<td><font size="1"><b>Club:</b></font></td><td width="70%"><font size="1">' . $player_information->getSkill(1) . '</font></td>
							</tr>
							<tr bgcolor="#D4C0A1">
							<td><font size="1"><b>Sword:</b></font></td><td width="70%"><font size="1">' . $player_information->getSkill(2) . '</font></td>
							</tr>
							<tr bgcolor="#F1E0C6">
							<td><font size="1"><b>Axe:</b></font></td><td width="70%"><font size="1">' . $player_information->getSkill(3) . '</font></td>
							</tr>
							<tr bgcolor="#D4C0A1">
							<td><font size="1"><b>Distance:</b></font></td><td width="70%"><font size="1">' . $player_information->getSkill(4) . '</font></td>
							</tr>
							<tr bgcolor="#F1E0C6">
							<td><font size="1"><b>Shielding:</b></font></td><td width="70%"><font size="1">' . $player_information->getSkill(5) . '</font></td>
							</tr>
							<tr bgcolor="#D4C0A1">
							<td><font size="1"><b>Fishing:</b></font></td><td width="70%"><font size="1">' . $player_information->getSkill(6) . '</font></td>
							</tr>
							<tr bgcolor="#F1E0C6">
							<td><font size="1"><b>Balance:</b></font></td>
							<td width="70%"><font size="1"><font color="#00CD00"><b>$</b></font> ' . $player_information->getBalance() . '</font></td>
							</tr></tbody></table></font></center><font size="1"></font></td>';
			$main_content .= '<td align="center" rowspan="3"><table with="100%" style="border: solid 1px #888888;" cellspacing="1"><tbody><tr>';
			
			$verifica_item_id = function ($pid) use ($player_information) {
				if ($player_information->getItems()->getItem($pid)[array_keys($player_information->getItems()->getItem($pid))[0]]->data['itemtype'] == null) {
					return '<td style="background-color: #d4c0a1; text-align: center;"><img src="./layouts/tibiacom/images/shop/items/' . $pid . '.gif" width="44" higth="44"></td>';
				} else {
					$item_id = $player_information->getItems()->getItem($pid)[array_keys($player_information->getItems()->getItem($pid))[0]]->data['itemtype'];
					return '<td style="background-color: #d4c0a1; text-align: center;"><img src="./layouts/tibiacom/images/shop/items/' . $item_id . '.png" width="44" higth="44"></td>';
				}
			};
			$main_content .= $verifica_item_id(2);
			$main_content .= $verifica_item_id(1);
			$main_content .= $verifica_item_id(3);
			$main_content .= '
			</tr>
			<tr>';
			$main_content .= $verifica_item_id(6);
			$main_content .= $verifica_item_id(4);
			$main_content .= $verifica_item_id(5);
			$main_content .= '
			</tr>
			<tr>';
			$main_content .= $verifica_item_id(9);
			$main_content .= $verifica_item_id(7);
			$main_content .= $verifica_item_id(10);
			$main_content .= '
			</tr>
			<tr>
			<td style="background-color: #D4C0A1; text-align: center;">Soul:<br>' . $player_information->getSoul() . '</td>';
			$main_content .= $verifica_item_id(8);
			$main_content .= '
			<td style="background-color: #D4C0A1; text-align: center;">Cap:<br>' . $player_information->getCapacity() . '</td>
			</tr></tbody></table></td>';
			$main_content .= '<td width="30%" valign="top"><font size="1">';
			$main_content .= "<div>";

			$outfits = $outfits->getPlayerOutfitsByPlayerId($player_id);
			if ($outfits != false) {
				foreach ($outfits as $value) {
				$main_content .= "<img src='https://outfits.ferobraglobal.com/animoutfit.php?id={$value['looktype']}&addons={$value['addon']}&head={$player_information->getLookHead()}&body={$player_information->getLookBody()}&legs={$player_information->getLookLegs()}&feet={$player_information->getLookFeet()}&mount=0'>";
				}
			} else {
				$main_content .= "<p>Este player não possui outfits.</p>";
			}

			$main_content .= "</div>";
			$main_content .= '</font></td></tr><tr bgcolor="#D4C0A1" style="height: 8%"><td><strong>Mounts</strong></td></tr><tr bgcolor="#F1E0C6"><td width="30%" valign="top">';

			$main_content .= "<div><font size='1'>";

			$mounts = $mounts->getAllMountsByPlayerId($player_id);
			if ($mounts != false) {
				foreach ($mounts as $value) {
					$main_content .= "<img src='https://outfits.ferobraglobal.com/animoutfit.php?id={$value['clientid']}'>";
				}
			} else {
				$main_content .= "<p>Este player não possui Montarias.</p>";
			}
			$main_content .= "</font></div>";

			$main_content .= '</td></tr></tbody></table></div></div><div class="TableShadowContainer"><div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);"><div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);"></div><div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div></div></div></td></tr><tr><td><div class="TableShadowContainerRightTop"><div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div></div><div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);"><div class="TableContentContainer"><table class="TableContent" width="100%"><tbody><tr bgcolor=""><td style="border:1px solid #faf0d7;width:95px;">Items DEPOT:</td><td style="border:1px solid #faf0d7;"><img id="Buttondepot" onmousedown="ToggleMaskedText(\'depot\');" style="cursor:pointer;" src="./layouts/tibiacom/images/global/general/show.gif"><span id="Displaydepot"></span><span id="Maskeddepot" style="visibility:hidden;display:none"></span><span id="Readabledepot" style="visibility:hidden;display:none"><br><br><table border="1" style="width:100%"><tbody><tr><td>';

			if ($player_information->getDepotItems() != null) {
				$depotitems = $player_information->getDepotItems();
				$main_content .= "<div class='depot'>";
				foreach ($depotitems as $dep) {
					$itemm = $getItemByItemId((int)$dep['itemtype']);
					$main_content .= "<div class='depot-item'><img src='./layouts/tibiacom/images/shop/items/{$dep["itemtype"]}.png'><br/>Name:" . (isset($itemm['article']) ? $itemm['article'] : '') . " " . $itemm['name'] . "<br/>Qnt:{$dep["real_count"]}</div>";
				}
				$main_content .= "</div>";
			} else {
				$main_content .= "<p>Este player n�o possui nenhum item armazenado no depot.</p>";
			}

			$main_content .= '</td></tr></tbody></table></span></td></tr></tbody></table></div></div><div class="TableShadowContainer"><div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);"><div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);"></div><div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div></div></div></td></tr><tr><td><div class="TableShadowContainerRightTop"><div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div></div><div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);"><div class="TableContentContainer"><table class="TableContent" width="100%"><tbody><tr bgcolor=""><td style="border:1px solid #faf0d7;width:95px;">Player ITEMS:</td><td style="border:1px solid #faf0d7;"><img id="Buttonitem" onmousedown="ToggleMaskedText(\'item\');" style="cursor:pointer;" src="./layouts/tibiacom/images/global/general/show.gif"><span id="Displayitem"></span><span id="Maskeditem" style="visibility:hidden;display:none"></span><span id="Readableitem" style="visibility:hidden;display:none"><br><br><table border="1" style="width:100%"><tbody><tr>';
			$main_content .= "<td>";

			$query = $SQL->prepare("SELECT *, sum(count) as real_count FROM player_items a where a.player_id = $player_id AND a.itemtype != 26052 group by a.itemtype order by player_id ASC");
			$query->execute(['id' => $player_id]);
			$items = $query->fetchAll();
			if ($items != null) {
				$main_content .= "<div class='depot'>";
				foreach ($items as $item) {
					$itemm = $getItemByItemId((int)$item['itemtype']);
					$main_content .= "<div class='depot-item'><img src='./layouts/tibiacom/images/shop/items/{$item["itemtype"]}.png'><br/>Name:" . (isset($itemm['article']) ? $itemm['article'] : '') . " " . $itemm['name'] . "<br/>Qnt:{$item["real_count"]}</div>";
				}
				$main_content .= "</div>";
			} else {
				$main_content .= "<p>Este Player nao esta carregando nenhum item.</p>";
			}

			$main_content .= "</td></tr>";
			$main_content .= "</tbody></table></span></td></tr>";
			$main_content .= $make_table_footer();
			$main_content .= "</div>";
			$typeQuery = $SQL->query("SELECT price_type FROM account_character_sale WHERE id_player = " . $player_information->getID())->fetch();
			$type = $typeQuery['price_type'];
			if ($type == 0) {
				$main_content .= "<div align='center' style='margin-top: 20px;'><form id='buy_this_char' method='post' action='./?subtopic=accountmanagement&action=sellchar'><input name='id' value='{$player_information->getID()}' type='hidden'><input type='hidden' name='type' value='3'><div class='BigButton' style='background-image:url(./layouts/tibiacom/images/global/buttons/sbutton_green.gif)'><div onmouseover='MouseOverBigButton(this);' onmouseout='MouseOutBigButton(this);'><div class='BigButtonOver' style='background-image: url(./layouts/tibiacom/images/global/buttons/sbutton_green_over.gif&quot;); visibility: visible;'></div><input class='ButtonText' name='Create Character' alt='Create Character' src='./layouts/tibiacom/images/global/buttons/buy_character.gif' type='image'></div></div></form></div>";
				$main_content .= '
				<script>
					$("#buy_this_char").submit(function() {
						var form = $(this);
						var data = form.serialize();
						var url = form.attr("action");
						var type = form.attr("method");
						iziToast.question({
						timeout: 20000,
						close: false,
						overlay: true,
						displayMode: \'once\',
						id: \'question\',
						zindex: 999,
						title: \'Hey\',
						message: \'Are you sure about that?\',
						position: \'center\',
						buttons: [
							[\'<button><b>YES</b></button>\', function (instance, toast) {
							instance.hide({ transitionOut: \'fadeOut\' }, toast, \'button\');
							$.ajax({
								url: url,
								data: data,
								type: type,
								dataType: "json",
								beforeSend: function(){
									iziToast.info({
									title:"Loading",
									message: "...",
									position: "topRight"
								});
							},
							success: function(response) {
								//console.log(response.error);
								if(response.error === true){
									iziToast.destroy();
									iziToast.error({
										title: "ERROR:",
										message: response.msg,
										position: "topRight", // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
										timeout: 2500
									});
								}else{
									$(".se-pre-con").fadeOut("slow");
									iziToast.success({
										title:"Success:",
										message:response.msg,
										position:"center",
										timeout: 2500,
										overlay:true,
										overlayClose:true,
										onClosing: function (instance, toast, closedBy) {
											// console.info(\'closedBy: \' + closedBy);
											window.location.replace("./?subtopic=accountmanagement");
										}
									});
								}
							},
						error: function() {
								$(".se-pre-con").fadeOut("slow");
							}
						});
					}, true],
				[\'<button>NO</button>\', function (instance, toast) {
				instance.hide({ transitionOut: \'fadeOut\' }, toast, \'button\');
				iziToast.error({
				title:"Compra",
				message: "Cancelada..."
				});
				}],
				],
				onClosing: function(instance, toast, closedBy){
				console.info(\'Closing | closedBy: \' + closedBy);
				},
				onClosed: function(instance, toast, closedBy){
				console.info(\'Closed | closedBy: \' + closedBy);
				}
				});

				return false;
				});
				</script>';
			} else { // type == 1
				$main_content .= "<div align='center' style='margin-top: 20px;'>
				<p style='font-size: 2em'><b>Selecione um personagem para utilizar o saldo no balance para efetuar a compra.</b></p>
				<form id='buy_this_char' method='post' action='./?subtopic=accountmanagement&action=sellchar'>
				<input name='id' value='{$player_information->getID()}' type='hidden'>
				<input name='type' value='3' type='hidden'>";
				$p = $SQL->query("SELECT * from players WHERE account_id = {$account_logged->getID()}")->fetchAll();
				$main_content .= "<select name='char_id' style='margin-bottom: 20px'>";
				foreach ($p as $pp) {
					$main_content .= "<option name='char_id_" . $pp['id'] . "' value='" . $pp['id'] . "'>" . $pp['name'] . "</option>";
				}
				$main_content .= "</select>";
				$main_content .= "
				<div class='BigButton' style='background-image:url(./layouts/tibiacom/images/global/buttons/sbutton_green.gif)'>
				<div onmouseover='MouseOverBigButton(this);' onmouseout='MouseOutBigButton(this);'>";
				$main_content .= "
				<div class='BigButtonOver' style='background-image: url(./layouts/tibiacom/images/global/buttons/sbutton_green_over.gif&quot;); visibility: visible;'></div>
				<input class='ButtonText' name='Create Character' alt='Create Character' src='./layouts/tibiacom/images/global/buttons/buy_character.gif' type='image'>
				</div>
				</div>
				</form>
				</div>";
				$main_content .= '
							<script>
							$("#buy_this_char").submit(function() {
							var form = $(this);
							var data = form.serialize();
							var url = form.attr("action");
							var type = form.attr("method");
							iziToast.question({
							timeout: 20000,
							close: false,
							overlay: true,
							displayMode: \'once\',
							id: \'question\',
							zindex: 999,
							title: \'Hey\',
							message: \'Are you sure about that?\',
							position: \'center\',
							buttons: [
							[\'<button><b>YES</b></button>\', function (instance, toast) {
							instance.hide({ transitionOut: \'fadeOut\' }, toast, \'button\');
							$.ajax({
							url: url,
							data: data,
							type: type,
							dataType: "json",
							beforeSend: function(){
							iziToast.info({
							title:"Loading",
							message: "...",
							position: "topRight"
							});
							},
							success: function(response) {
							//console.log(response.error);
							if(response.error === true){
							iziToast.destroy();
							iziToast.error({
							title: "ERROR:",
							message: response.msg,
							position: "topRight", // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
							timeout: 2500
							});
							}else{
							$(".se-pre-con").fadeOut("slow");
							iziToast.success({
							title:"Success:",
							message:response.msg,
							position:"center",
							timeout: 2500,
							overlay:true,
							overlayClose:true,
							onClosing: function (instance, toast, closedBy) {
							// console.info(\'closedBy: \' + closedBy);
							window.location.replace("./?subtopic=accountmanagement");
							}
							});
							}
							},
							error: function() {
							$(".se-pre-con").fadeOut("slow");
							}
							});
							}, true],
							[\'<button>NO</button>\', function (instance, toast) {
							instance.hide({ transitionOut: \'fadeOut\' }, toast, \'button\');
							iziToast.error({
							title:"Compra",
							message: "Cancelada..."
							});
							}],
							],
							onClosing: function(instance, toast, closedBy){
							console.info(\'Closing | closedBy: \' + closedBy);
							},
							onClosed: function(instance, toast, closedBy){
							console.info(\'Closed | closedBy: \' + closedBy);
							}
							});

							return false;
							});
							</script>';
			} // end else type
			
			$main_content .= '<div align="center" style="margin-top: 15px"><a href="./?subtopic=accountmanagement&action=buychar"><div class="BigButton" style="background-image:url(./layouts/tibiacom/images/global/buttons/sbutton_red.gif)"><div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(&quot;./layouts/tibiacom/images/global/buttons/sbutton_red_over.gif&quot;); visibility: hidden;"></div><input class="ButtonText" type="image" name="Overview" alt="Overview" src="./layouts/tibiacom/images/global/buttons/_sbutton_overview.gif"></div></div></a></div>';
		} else {
			header("Location: ./?subtopic=accountmanagement&action=buychar");
		}
	} else {
		header("Location: ./?subtopic=accountmanagement&action=buychar");
	}
} else {
$main_content .= "
<p>Welcome to the character purchase system, here you can buy the character you want using your tibia coins or your balance as payment method.</p>
<p>Below is the list of characters available for sale on the server, click Buy Character.</p>
";
$main_content .= '
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);"></span>
<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);"></span> 
<span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);"></span>   
<div class="Text">Characters for Sale</div>
<span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif)"></span>
<span class="CaptionEdgeLeftBottom"></span>
<span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
</div>
</div>
<table class="Table3" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td>
<div class="InnerTableContainer">
<table style="width: 100%">
<tbody>
<tr>';
$main_content .= '
<!--
<td>
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div>
</div>
<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" width="100%">
<tbody>
<tr style="background-color:#D4C0A1;">
<td><strong>Filters:</strong></td>
<td>
<center><strong><a href="?subtopic=buycharacters">Normal</a></strong></center>
</td>
<td>
<center><strong><a href="?subtopic=buycharacters&amp;filter=price">Price</a></strong></center>
</td>
<td>
<center><strong><a href="?subtopic=buycharacters&amp;filter=level">Level</a></strong></center>
</td>
<td>
<center><strong><a href="?subtopic=buycharacters&amp;filter=sorc">Sorcerers</a></strong></center>
</td>
<td>
<center><strong><a href="?subtopic=buycharacters&amp;filter=druid">Druids</a></strong></center>
</td>
<td>
<center><strong><a href="?subtopic=buycharacters&amp;filter=pala">Paladins</a></strong></center>
</td>
<td>
<center><strong><a href="?subtopic=buycharacters&amp;filter=knight">Knights</a></strong></center>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div>
</div>
</div>
</td>
-->
';
$main_content .= '
</tr>
<tr>
<td>
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div>
</div>
<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" width="100%">
<tbody>
<tr style="background-color:#D4C0A1;">
<td><strong>*</strong></td>
<td><strong>Character</strong></td>
<td width="25%" align="center"><strong>Buy</strong></td>
<td><strong>Value</strong></td>
</tr>';
$query = $SQL->prepare("SELECT * FROM account_character_sale WHERE status = 0 AND dta_valid != NOW()");
$query->execute();
$playersinsale = $query->fetchAll();
if ($query->rowCount() > 0) {
foreach ($playersinsale as $player) {
$player_sale_info = new Player();
$player_sale_info->loadById($player['id_player']);
$mount_id = $player_sale_info->getStorage('10002011');
$player_info = $player_sale_info->data;
$main_content .= "
<tr>
";
$main_content .= "
<td><img class='Outfit' src='https://outfits.ferobraglobal.com/animoutfit.php?id={$player_info['looktype']}&addons={$player_info['lookaddons']}&head={$player_info['lookhead']}&body={$player_info['lookbody']}&legs={$player_info['looklegs']}&feet={$player_info['lookfeet']}&mount=" . ($mount_id == null ? 0 : $mount_id) . "' alt='' name=''></td>
";
$main_content .= "<td><a href='./?subtopic=characters&name=" . urlencode($player_info['name']) . "'>{$player_info['name']}</a><br/> {$player_sale_info->getVocationName()} - Level {$player_sale_info->getLevel()}</td>
<td>
<center><a href='?subtopic=accountmanagement&action=buychar&id=" . $player['id_player'] . "' style='padding:0px;margin:0px;'><input name='selectedcharacter' value='' type='hidden'><div class='BigButton' style='background-image:url(./layouts/tibiacom/images/global/buttons/sbutton_green.gif)'><div onmouseover='MouseOverBigButton(this);' onmouseout='MouseOutBigButton(this);'><div class='BigButtonOver' style='background-image: url(./layouts/tibiacom/images/global/buttons/sbutton_green_over.gif&quot;); visibility: visible;'></div><input class='ButtonText' name='Create Character' alt='Create Character' src='./layouts/tibiacom/images/global/buttons/buy_character.gif' type='image'></div></div></a></center>    
</td>
<td>" . ($player['price_type'] == 0 ? number_format($player['price_coins'], 0, ',', '.') . " Coins" : number_format($player['price_gold'], 0, ',', '.') . " Gold Balance") . "</td>
</tr>";
}


} else {
$main_content .= '
<tr><td colspan="4" style="text-align: center">Não encontramos nenhum player à venda.</td></tr>
';
}

$main_content .= '
</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div>
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
';

$main_content .= '
<p>To put a character of yours on sale just access the menu next to the tab on the option <a href="./?subtopic=accountmanagement&action=sellchar">Sell Characters</a>, remembering that you need to be logged in to your account for this option to appear.</p>
';
}
