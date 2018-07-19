<?PHP header("Content-Type: text/html; charset=UTF-8",true);
if(!defined('INITIALIZED'))
	exit;
$main_content .= '
	<center>
		<table>
			<tbody>
					<tr>
						<td><img src="'.$layout_name.'/images/global/content/headline-bracer-left.gif"></td>
						<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">'.$config['server']['serverName'].' Rules</td>
						<td><img src="'.$layout_name.'/images/global/content/headline-bracer-right.gif"></td>
					</tr>
				</tbody>
			</table>
		</center>
		
<br>
<p>Not following the mentioned rules on this page can get your account banned or even deleted.<br>
As in everything, common sense is required. Please note that these rules may change at any time.<br>
<a href="?subtopic=accountmanagement">If you got any questions, ask them on support ticket.</a> </p>		

<div class="SmallBox">
				<div class="MessageContainer">
					<div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/global/content/box-frame-horizontal.gif);"></div>
					<div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></div>
					<div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></div>
					<div class="Message">
						<div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></div>
						<div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></div>
						<table style="width:100%;">
							<tbody><tr><td style="width:100%;text-align:center;"><nobr>[<a href="#PublicChatChannels">Public Chat Channels</a>]</nobr> <nobr>[<a href="#Gameplay">Gameplay</a>]</nobr>  <nobr>[<a href="#BugAbuse">Bug Abuse</a>]</nobr> <nobr>[<a href="#AccountTrading">Account Trading</a>]</nobr> <nobr>[<a href="#Punishments">Punishments</a>]</nobr></td>
						</tr>
					</tbody></table>
				</div>
				<div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/global/content/box-frame-horizontal.gif);"></div>
				<div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></div>
				<div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></div>
			</div>
		</div>
		<br>
		
<div class="TableContainer" style="position:relative;">
		<div class="ribbonShop-double"></div>
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer"> 
					<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
					<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
					<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span> 
					<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text">Rules on '.$config['server']['serverName'].'</div>
					<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span> 
					<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span> 
					<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
					<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
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
										<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);"></div>
									</div>
                                       <div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
										<div class="TableContentContainer">
											<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
                                                    <tbody style="border:1px solid #faf0d7;">
                                                    <tr style="border:1px solid #faf0d7;">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 >Category</td>
														<td style="text-align: rigth; font-weight: bold;" colspan=1>Rule</td>
													</tr>
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ><br><img src="'.$layout_name.'/images/global/content/bullet.gif" width="17" height="17"><a name="PublicChatChannels"></a>&nbsp;Public Chat Channels</td>
														<td style="text-align: rigth;" colspan=1 ><br>All rules are being applied to the following channels in-game:<br> Advertising, Help Channel (English, Portuguese and Polish),<br> English, Portuguese and Polish Chat and World Chat. <br></td>
													</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Advertising</b><br>
														<ul><li>Advertise your in-game trade items</li>
														<li>Advertise if you are selling/buying a house for in-game gold/items.</li>
														<li>Advertise your quest services </ul></li>
														<br>
														You may not use for any other objectives</td>
													</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Selling not in-game related</b><br>
														Selling anything not in-game related is considered as spamming <br>and will result to a punishment. 
														The following rules here, are all<br> applied in the forums aswell. <span style="color: #ff0000;"><strong>Example: Selling gold for RL money</strong></spam></red>
													</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Help Channel</b><br>
														You have to keep in mind that this channel is not for chit-chatting. <br>Should be only used to ask about Taleon and game related questions.<br>
														A tutor may mute you from the channel for an hour for any reason,<br> mostly if you are not using the Help Channel for what it should be used for.
													</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Language Chat and World Channel</b>
														In this channel you re allowed to <br>talk about almost anything,  but as always, there are some limits.<br> 
														The rules below applies to both channels, but one especially only for 
														<br>English and other language channel:  Its channel language should be always
														<br> respected. You should better know the following things wont be tolerated <br>in this and almost all channel:
													</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Insulting statements:</b>
														Keep in mind that all intentions <br>counts, doesnt matter in which language it is being insulted, if you <br>
														hide words like "a**h***" or expressing yourself in a non-verbal way.<br>
														 If someone is tring to provoke you, the only and best thing you can do<br> is ignore
														 that personal instead of responding to him or her angrily.<br> You mustnt take
														 everything too seriously. Low statements such as "Noob!" <br>might offend you, but these 
														 are not meant to be serious insult. Well now, <br>sternly insulting statements may lead to a punishment. 
													</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Racist statements: </b>
														In this game there are players internationally where <br>they communicate
														and meet each other. Certainly, statements made to<br> insult or mock a certain country or its inhabitants are not
														tolerated in<br> '.$config['server']['serverName'].'. The same goes of course for a certain nation or ethnic group. 
													</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Harassing statements: </b>
														It is prohibited all intentions to harass <br>other players. 
														Above all, statements which are players threatened in <br>
														real life are highly illegal and will lead to staid punishments. 
													</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Sexually related statements: </b>
														 You should keep this in mind<br>
														 better than anyone that there are children that play 
														 '.$config['server']['serverName'].' too,<br> sexually related statements is not suitable for them and will
														 <br>accordingly not be tolerated in game channels.  
													</tr>
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Spamming:  </b>
														 Spamming is repeating identical or similar statements<br> one after
														 another. Example (advertising channel): Spamming in any <br>game channel without a proper reason, will result to mute. If the <br>behaviour continues, youll be jailed.<br><br>
													</tr> 
													<tr>
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ><br><img src="'.$layout_name.'/images/global/content/bullet.gif" width="17" height="17"><a name="Gameplay"></a>&nbsp;Gameplay</td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Blocking Areas:  </b><br><br>
														<span style="color: #ff0000;">It is also strictly prohibited blocking off an area for over 15 minutes.
														<br> Abusing this may lead you instant punishment. </span><br>
														</td>
													</tr> 
													<tr>
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Note!&nbsp;</b>
														 There is an exception for this rule during guild wars.
														 <br> If any team decides to block an area, they are allowed to do so. 
														 <br>If its being reported, a gamemaster will judge if its rule violating <br>or battle defense.<br>
													</tr> 
													<tr>
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Botting</b><br><br>
														 <span style="color: #ff0000;">Using any kind of bot and macro is illegal.</span><br>
													</tr> 
													<tr>
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Gambling</b><br><br>
														 You are not allowed to run casino in depot, or any kind of games.<br>
														 This rule enforced to prevent depots becoming full. Violating this<br>
														 rule may lead you a banishment of all your accounts.
														 <br><br>NOTE: You are allowed to host casino in houses and other places. 
														 <br>However, you should always avoid the "trust" games. They tend to<br>
														 see between friends to look real, but once you trust the player with a <br>
														 value item, they will be stolen from you.<br>
													</tr>
													<tr>
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Reporting Botters</b><br><br>
														 The best way to report a botter is to use the in-game "report bot/macro" <br>tool in-game.<br>
														 <br>
														 <img src="'.$layout_name.'/images/tibiarules/reportingbotters.png"><br><br>
														This is the most efficent and best way to report a user using </br>
														third-party program in an illegal way.<br>
														</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ><br><img src="'.$layout_name.'/images/global/content/bullet.gif" width="17" height="17"><a name="BugAbuse"></a>&nbsp;Bug Abuse</td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Finding A bug:  </b><br><br>
														If you happen to encounter a bug, you should let us know about it.<br>
														</td>
													</tr> 
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>How to report do I report bugs?</b><br><br>
														 Simply, right click and choose "report coordinate"<br>
														<img src="'.$layout_name.'/images/tibiarules/reportbugs.png"><br><br>
														Or, by presssing ctrl+z and describe the bug the best you can.<br>
														For reporting major game-breaking bugs, you will be rewarded.<br>
													</tr>
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ></td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Abusing Bug</b><br><br>
														 Abusing bugs to gain an advantage is not tolerated and <br>may lead you even deletion of your entire account. <br>
														 Reporting is strongly recommended, you can also be rewarded for <br>reporting bugs, mostly for major ones.<br>
													</tr>
													<tr>
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ><br><img src="'.$layout_name.'/images/global/content/bullet.gif" width="17" height="17"><a name="AccountTrading"></a>&nbsp;Account Trading</td>
														<td style="text-align: rigth;" colspan=1 ><br>You are not allowed to sell your own account.<br>
														It belongs to the person who created it, and that person will <br>
														always be able to recover the account. Intentionally trying<br>
														to sell your account may be permanently locked out from the account<br> and you will never have access on it.<br>
														</td>
													</tr>
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 ><br><img src="'.$layout_name.'/images/global/content/bullet.gif" width="17" height="17"><a name="Punishments"></a>&nbsp;Punishments</td>
														<td style="text-align: rigth;" colspan=1 ><br>For violating any rules defined here, youll be punished.<br>
														Instead of giving a direct ban when breaking our rules, we have<br>
														a prison system. If the violation is not serve, the rule breaker<br>
														will be jailed, if the violation is serve, further actions will be taken.<br>
														</td>
													</tr>
													<tr bgcolor="#F1E0C6">
														<td style="text-align: rigth; font-weight: bold;" colspan=1 </td>
														<td style="text-align: rigth;" colspan=1 ><br><b>Prison System</b><br>
														If your chateracter is jailed, it will be sent to a prison for 7 days.<br>
														You will be automatically teleported out from the prison 4 hours<br>
														after your punishment. You dont have to be online during that time.<br>
														If you visit the prison often enough for breaking rules, your character<br> will be instantly banned for least 24 hours<br><br>
													</tr>
													</tbody>
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
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br>


<p>If your account or one of your characters got punished, you will find an entry in your criminal record on your <a href="?subtopic=accountmanagement">account page</a>. There you can read the reason and the duration of the punishment.
<br><br>
Have fun in '.$config['server']['serverName'].'!<br>
Your '.$config['server']['serverName'].' Team
';
?>