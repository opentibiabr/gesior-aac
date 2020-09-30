<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:06
 */

$main_content .= '
				<script type="text/javascript">
							var nameHttp;
							function checkName()
							{
									if(document.getElementById("newcharname").value=="")
									{
										document.getElementById("name_check").innerHTML = \'<b><font color="red">Please enter new character name.</font></b>\';
										return;
									}
									nameHttp=GetXmlHttpObject();
									if (nameHttp==null)
									{
										return;
									}
									var newcharname = document.getElementById("newcharname").value;
									var url="?subtopic=ajax_check_name&name=" + newcharname + "&uid="+Math.random();
									nameHttp.onreadystatechange=NameStateChanged;
									nameHttp.open("GET",url,true);
									nameHttp.send(null);
							}
				
							function NameStateChanged()
							{
									if (nameHttp.readyState==4)
									{
										document.getElementById("name_check").innerHTML=nameHttp.responseText;
									}
							}
				</script>
				';
$newchar_name = ucwords(strtolower(trim($_POST['newcharname'])));
$newchar_sex = $_POST['newcharsex'];
$newchar_vocation = $_POST['newcharvocation'];
$newchar_town = $_POST['newchartown'];
if ($_POST['savecharacter'] != 1) {
	$main_content .= 'Please choose a name';
	if (count($config['site']['newchar_vocations']) > 1)
		$main_content .= ', vocation';
	$main_content .= ' and sex for your character. <br/>In any case the name must not violate the naming conventions stated in the <a href="?subtopic=tibiarules" target="_blank" >' . htmlspecialchars($config['server']['serverName']) . ' Rules</a>, or your character might get deleted or name locked.';
	if ($account_logged->getPlayersList()->count() >= $config['site']['max_players_per_account'])
		$main_content .= '<b><font color="red"> You have maximum number of characters per account on your account. Delete one before you make new.</font></b>';
	$main_content .= '<br/><br/>
<form action="?subtopic=accountmanagement&action=createcharacter" method="post" >
<input type="hidden" name=savecharacter value="1" >
<div class="TableContainer" >
<table class="Table3" cellpadding="0" cellspacing="0" >
	<div class="CaptionContainer" >
		  <div class="CaptionInnerContainer" >
		  <span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" />
		  </span>
		  <span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" />
		  </span>
		  <span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" >
		  
</span><span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" />
</span><div class="Text" >Create Character</div>
		<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" />
		</span>
		<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" >
</span>
<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" />
</span>
<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" />
</span>
</div>
</div>
<tr>
<td>
<div class="InnerTableContainer" >
<table style="width:100%;" >
<tr>
<td>
<div class="TableShadowContainerRightTop" >
<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" >
</div>
</div>
<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
 <div class="TableContentContainer" >
 <table class="TableContent" width="100%" >
 <tr class="LabelH" >
 <td style="width:50%;" >
 <span id="charactername_label"' . (isset($e['acc']) ? ' class="red"' : '') . '>Name</td>
 <td><span >Sex</td>
 </tr><tr class="Odd" >
 <td>
 <!--
 <input id="newcharname" name="newcharname" onkeyup="checkName();" value="' . htmlspecialchars($newchar_name) . '" size="30" maxlength="29" >
 <tr>
	<td class="LabelV150" >
		<span id="accountname_label"' . (isset($e['acc']) ? ' class="red"' : '') . ' >Account Name:</span>
	</td>
	<td>
		<div id="accountname_indicator" class="InputIndicator" style="background-image:url(' . $layout_name . '/images/global/general/' . ($_POST['step'] != 'docreate' || isset($e['acc']) ? 'n' : '') . 'ok.gif);" ></div>
	</td>
</tr>
<tr>
	<td></td>
	<td><span id="accountname_errormessage" class="FormFieldError">' . (isset($e['acc']) ? $e['acc'] : '') . '</span></td>
</tr>
-->
 <input id="newcharname" name="newcharname" class="CipAjaxInput" style="width:206px;float:left;" value="' . (isset($_POST['newcharname']) ? htmlspecialchars(substr($_POST['newcharname'], 0, 50)) : '') . '" size="30" maxlength="50" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_character.php\',PostData: \'a_CharacterName=\'+encodeURIComponent(getElementById(\'newcharname\').value),Method: \'POST\'});" />
 <div id="charactername_indicator" class="InputIndicator" style="background-image:url(' . $layout_name . '/images/global/general/' . ($_POST['step'] != 'docreate' || isset($e['acc']) ? 'n' : '') . 'ok.gif);" ></div>
 <br>
 <span id="charactername_errormessage" class="FormFieldError">' . (isset($e['acc']) ? $e['acc'] : '') . '</span>
 <BR>
 <font size="1" face="verdana,arial,helvetica">
<!--<div id="name_check">Please enter your character name.</div>-->
 </font>
 </td>
 <td>';
	$main_content .= '<input type="radio" name="newcharsex" value="1" ';
	if ($newchar_sex == 1)
		$main_content .= 'checked="checked" ';
	$main_content .= '>male<br/>';
	$main_content .= '<input type="radio" name="newcharsex" value="0" ';
	if ($newchar_sex == "0")
		$main_content .= 'checked="checked" ';
	$main_content .= '>female<br/></td></tr></table></div></div></table></div>';
	if (count($config['site']['newchar_towns']) > 1 || count($config['site']['newchar_vocations']) > 1)
		$main_content .= '<div class="InnerTableContainer" >          <table style="width:100%;" ><tr>';
	if (count($config['site']['newchar_vocations']) > 1) {
		$main_content .= '<td><table class="TableContent" width="100%" ><tr class="Odd" valign="top"><td width="160"><br /><b>Select your vocation:</b></td><td><table class="TableContent" width="100%" >';
		foreach ($config['site']['newchar_vocations'] as $char_vocation_key => $sample_char) {
			$main_content .= '<tr><td><input type="radio" name="newcharvocation" value="' . $char_vocation_key . '" ';
			if ($newchar_vocation == $char_vocation_key)
				$main_content .= 'checked="checked" ';
			$main_content .= '>' . htmlspecialchars($vocation_name[$char_vocation_key]) . '</td></tr>';
		}
		$main_content .= '</table></table></td>';
	}
	if (count($config['site']['newchar_towns']) > 1) {
		$main_content .= '<td><table class="TableContent" width="100%" ><tr class="Odd" valign="top"><td width="160"><br /><b>Select your city:</b></td><td><table class="TableContent" width="100%" >';
		foreach ($config['site']['newchar_towns'] as $town_id) {
			$main_content .= '<tr><td><input type="radio" name="newchartown" value="' . $town_id . '" ';
			if ($newchar_town == $town_id)
				$main_content .= 'checked="checked" ';
			$main_content .= '>' . htmlspecialchars($towns_list[$town_id]) . '</td></tr>';
		}
		$main_content .= '</table></table></td>';
	}
	if (count($config['site']['newchar_towns']) > 1 || count($config['site']['newchar_vocations']) > 1)
		$main_content .= '</tr></table></div>';
	$main_content .= '</table></div></td></tr><br/><table style="width:100%;" ><tr align="center" ><td><table border="0" cellspacing="0" cellpadding="0" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" ></div></div></td><tr></form></table></td><td><table border="0" cellspacing="0" cellpadding="0" ><form action="?subtopic=accountmanagement" method="post" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" ></div></div></td></tr></form></table></td></tr></table>';
} else {
	if (empty(strlen($newchar_name) >= 5))
		$newchar_errors[] = 'Please enter a name for your character with 5 letters or more.';
	if (empty($newchar_sex) && $newchar_sex != "0")
		$newchar_errors[] = 'Please select the sex for your character!';
	if (count($config['site']['newchar_vocations']) > 1) {
		if (empty($newchar_vocation))
			$newchar_errors[] = 'Please select a vocation for your character.';
	} else
		$newchar_vocation = $config['site']['newchar_vocations'][0];
	if (count($config['site']['newchar_towns']) > 1) {
		if (empty($newchar_town))
			$newchar_errors[] = 'Please select a town for your character.';
	} else
		$newchar_town = $config['site']['newchar_towns'][0];
	if (empty($newchar_errors)) {
		if (!check_name_new_char($newchar_name))
			$newchar_errors[] = 'This name contains invalid letters, words or format. Please use only a-Z, - , \' and space.<br> Remember not to use more than 3 letters repeated together.';
		if (preg_match('/[^a-zA-Z ]/', $newchar_name))
			$newchar_errors[] = 'This name contains invalid letters, words or format. Please use only a-Z, - , \' and space.<br> Remember not to use more than 3 letters repeated together.';
		if ($newchar_sex != 1 && $newchar_sex != "0")
			$newchar_errors[] = 'Sex must be equal <b>0 (female)</b> or <b>1 (male)</b>.';
		if (count($config['site']['newchar_vocations']) > 1) {
			$newchar_vocation_check = FALSE;
			foreach ($config['site']['newchar_vocations'] as $char_vocation_key => $sample_char)
				if ($newchar_vocation == $char_vocation_key)
					$newchar_vocation_check = TRUE;
			if (!$newchar_vocation_check)
				$newchar_errors[] = 'Unknown vocation. Please fill in form again.';
		} else
			$newchar_vocation = 0;
	}
	if (empty($newchar_errors)) {
		$check_name_in_database = new Player();
		$check_name_in_database->find($newchar_name);
		if ($check_name_in_database->isLoaded())
			$newchar_errors[] .= 'This name is already used. Please choose another name!';
		$number_of_players_on_account = $account_logged->getPlayersList()->count();
		if ($number_of_players_on_account >= $config['site']['max_players_per_account'])
			$newchar_errors[] .= 'You have too many characters on your account <b>(' . $number_of_players_on_account . '/' . $config['site']['max_players_per_account'] . ')</b>!';
	}
	if (empty($newchar_errors)) {
		$char_to_copy_name = $config['site']['newchar_vocations'][$newchar_vocation];
		$char_to_copy = new Player();
		$char_to_copy->find($char_to_copy_name);
		if (!$char_to_copy->isLoaded())
			$newchar_errors[] .= 'Wrong characters configuration. Try again or contact with admin. ADMIN: Edit file config/config.php and set valid characters to copy names. Character to copy <b>' . htmlspecialchars($char_to_copy_name) . '</b> doesn\'t exist.';
	}
	if (empty($newchar_errors)) {
		// load items and skills of player before we change ID
		$char_to_copy->getItems()->load();
		$char_to_copy->loadStorages();
		$char_to_copy->setID(NULL); // save as new character
		$char_to_copy->setLastIP(0);
		$char_to_copy->setLastLogin(0);
		$char_to_copy->setLastLogout(0);
		$char_to_copy->setName($newchar_name);
		$char_to_copy->setAccount($account_logged);
		$char_to_copy->setSex($newchar_sex);
		if ($char_to_copy->getSex() == 1) {
			$char_to_copy->setLookType(128);
		} else {
			$char_to_copy->setLookType(136);
		}
		$char_to_copy->setPosX(0);
		$char_to_copy->setPosY(0);
		$char_to_copy->setPosZ(0);
		$char_to_copy->setTown($newchar_town);
		$char_to_copy->setBalance(0);
		$char_to_copy->setCreateIP(Visitor::getIP());
		$char_to_copy->setCreateDate(time());
		$char_to_copy->setSave(); // make character saveable
		$char_to_copy->save(); // now it will load 'id' of new player
		if ($char_to_copy->isLoaded()) {
			$char_to_copy->saveItems();
			foreach ($char_to_copy->storages as $key => $value) {
				$SQL->query("INSERT INTO `player_storage` (`player_id`, `key`, `value`) VALUES (" . $char_to_copy->data['id'] . ", " . $key . ", " . $value . ")");
			}
			$main_content .= '<div class="TableContainer" >  <table class="Table1" cellpadding="0" cellspacing="0" >    <div class="CaptionContainer" >      <div class="CaptionInnerContainer" >        <span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>        <span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>        <span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>        <span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>        <div class="Text" >Character Created</div>        <span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>        <span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>        <span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>        <span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>      </div>    </div>    <tr>      <td>        <div class="InnerTableContainer" >          <table style="width:100%;" ><tr><td>The character <b>' . htmlspecialchars($newchar_name) . '</b> has been created.<br/>Please select the outfit when you log in for the first time.<br/><br/><b>See you on ' . $config['server']['serverName'] . '!</b></td></tr>          </table>        </div>  </table></div></td></tr><br/><center><table border="0" cellspacing="0" cellpadding="0" ><form action="?subtopic=accountmanagement" method="post" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" ></div></div></td></tr></form></table></center>';
		} else {
			echo "Error. Can\'t create character. Probably problem with database. Try again or contact with admin.";
			exit;
		}
	} else {
		$main_content .= '
						<script>
						window.onload = function() {
						  SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_character.php\',PostData: \'a_CharacterName=\'+encodeURIComponent(document.getElementById(\'newcharname\').value),Method: \'POST\'});
						}
						</script>
<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url(' . $layout_name . '/images/global/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach ($newchar_errors as $newchar_error)
			$main_content .= '<li>' . $newchar_error;
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
		$main_content .= 'Please choose a name';
		if (count($config['site']['newchar_vocations']) > 1)
			$main_content .= ', vocation';
		$main_content .= ' and sex for your character.
									<br/>In any case the name must not violate the naming conventions stated in the
									<a href="?subtopic=tibiarules" target="_blank" >' . $config['server']['serverName'] . ' Rules</a>
									, or your character might get deleted or name locked.<br/>
									<br/>
									<form action="?subtopic=accountmanagement&action=createcharacter" method="post" >
									<input type="hidden" name=savecharacter value="1" >
									<div class="TableContainer" >
									  <table class="Table3" cellpadding="0" cellspacing="0" >
										  <div class="CaptionContainer" >
												<div class="CaptionInnerContainer" >
												<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
												<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
												<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
												<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
												<div class="Text" >Create Character</div>
														<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
														<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
														<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
														<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
												</div>
										  </div>
										  <tr><td><div class="InnerTableContainer" >
										  <table style="width:100%;" >
											<tr>
											<td>
											<div class="TableShadowContainerRightTop" >
											  <div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
											 </div>
											  <div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
												<table class="TableContent" width="100%" >
												<tr class="LabelH" >
												<td style="width:50%;" ><span >Name</td>
												<td><span >Sex</td>
												</tr>
												<tr class="Odd" ><td>
												<!--<input id="newcharname" name="newcharname" onkeyup="checkName();" size="30" maxlength="29" >-->
												<input id="newcharname" name="newcharname" class="CipAjaxInput" style="width:206px;float:left;" value="' . $newchar_name . '" size="30" maxlength="50" onblur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_character.php\',PostData: \'a_CharacterName=\'+encodeURIComponent(getElementById(\'newcharname\').value),Method: \'POST\'});">
												<div id="charactername_indicator" class="InputIndicator" style="background-image:url(account/nok.gif)"></div>
												<BR>
												<font size="1" face="verdana,arial,helvetica">
												<span id="charactername_errormessage" class="FormFieldError">Please enter your character name.</span>
												</font>
												</td>
												<td>';
		$main_content .= '<input type="radio" name="newcharsex" value="1" ';
		if ($newchar_sex == 1)
			$main_content .= 'checked="checked" ';
		$main_content .= '>male<br/>';
		$main_content .= '<input type="radio" name="newcharsex" value="0" ';
		if ($newchar_sex == "0")
			$main_content .= 'checked="checked" ';
		$main_content .= '>female<br/></td></tr></table></div></div></table></div>';
		if (count($config['site']['newchar_towns']) > 1 || count($config['site']['newchar_vocations']) > 1)
			$main_content .= '<div class="InnerTableContainer" >          <table style="width:100%;" ><tr>';
		if (count($config['site']['newchar_vocations']) > 1) {
			$main_content .= '<td><table class="TableContent" width="100%" ><tr class="Odd" valign="top"><td width="160"><br /><b>Select your vocation:</b></td><td><table class="TableContent" width="100%" >';
			foreach ($config['site']['newchar_vocations'] as $char_vocation_key => $sample_char) {
				$main_content .= '<tr><td><input type="radio" name="newcharvocation" value="' . htmlspecialchars($char_vocation_key) . '" ';
				if ($newchar_vocation == $char_vocation_key)
					$main_content .= 'checked="checked" ';
				$main_content .= '>' . htmlspecialchars($vocation_name[0][$char_vocation_key]) . '</td></tr>';
			}
			$main_content .= '</table></table></td>';
		}
		if (count($config['site']['newchar_towns']) > 1) {
			$main_content .= '<td><table class="TableContent" width="100%" ><tr class="Odd" valign="top"><td width="160"><br /><b>Select your city:</b></td><td><table class="TableContent" width="100%" >';
			foreach ($config['site']['newchar_towns'] as $town_id) {
				$main_content .= '<tr><td><input type="radio" name="newchartown" value="' . htmlspecialchars($town_id) . '" ';
				if ($newchar_town == $town_id)
					$main_content .= 'checked="checked" ';
				$main_content .= '>' . htmlspecialchars($towns_list[$town_id]) . '</td></tr>';
			}
			$main_content .= '</table></table></td>';
		}
		if (count($config['site']['newchar_towns']) > 1 || count($config['site']['newchar_vocations']) > 1)
			$main_content .= '</tr></table></div>';
		$main_content .= '</table></div></td></tr><br/><table style="width:100%;" ><tr align="center" ><td><table border="0" cellspacing="0" cellpadding="0" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" ></div></div></td><tr></form></table></td><td><table border="0" cellspacing="0" cellpadding="0" ><form action="?subtopic=accountmanagement" method="post" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" ></div></div></td></tr></form></table></td></tr></table>';
	}
}
