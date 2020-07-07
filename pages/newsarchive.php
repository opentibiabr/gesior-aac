<?php
if (!defined('INITIALIZED'))
	exit;
if ($action == "") {
	$main_content .= '
		<div class="TableContainer">
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text">News Archive Search</div>
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
														<tr style="background-color:#D4C0A1;" valign="middle" align="center">
															<td width="25%" class="LabelV">Time Period</td>
															<td width="30%" class="LabelV">Type</td>
															<td width="30%" class="LabelV">Category</td>
														</tr>
														<tr valign="middle" align="center">
				<td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Day:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year:&nbsp;<br>

				From:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>When</b>&nbsp;&nbsp;&nbsp;<b>Server</b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Started</b><br><br>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Day:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year:&nbsp;<br>

				&nbsp;&nbsp;&nbsp;&nbsp;To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="filter_end_day" disabled=""><option value="01">01</option></select>
						&nbsp;&nbsp;&nbsp;<select name="filter_end_month" disabled=""><option value="09">09</option></select>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="filter_end_year" disabled=""><option value="2019">2019</option></select><br><br>

										</td>


<td nowrap="nowrap">
			<div align="left">
			  <input type="checkbox" name="filter_ticker" value="ticker" checked="" disabled="">News Ticker<br>
			  <input type="checkbox" name="filter_article" value="article" checked="" disabled="">Featured Article<br>
			  <input type="checkbox" name="filter_news" value="news" checked="" disabled="">News<br>
			</div>
</td>

<td nowrap="nowrap">
<div align="left">
			<input style="position: relative; top: -1px;" type="checkbox" name="filter_community" value="community" checked="" disabled=""><img style="position: relative; top: 1px;" src="./' . $layout_name . '/images/global/content/newsicon_community_small.gif">&nbsp;Community<br>
			<input style="position: relative; top: -1px;" type="checkbox" name="filter_development" value="development" checked="" disabled=""><img style="position: relative; top: 1px;" src="./' . $layout_name . '/images/global/content/newsicon_development_small.gif">&nbsp;Development<br>
			<input style="position: relative; top: -1px;" type="checkbox" name="filter_support" value="support" checked="" disabled=""><img style="position: relative; top: 1px;" src="./' . $layout_name . '/images/global/content/newsicon_support_small.gif">&nbsp;Support<br>
			<input style="position: relative; top: -1px;" type="checkbox" name="filter_technical" value="technical" checked="" disabled=""><img style="position: relative; top: 1px;" src="./' . $layout_name . '/images/global/content/newsicon_technical_small.gif">&nbsp;Technical Issues
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
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div><br>
		<table border="0" width="100%">
				<tbody><tr>
					<td align="center">
						<table border="0" cellspacing="0" cellpadding="0">

								<tbody><tr>
									<td style="border:0px;">
										<input type="hidden" name="name" value="">
										<input type="hidden" name="leader" value="">
										<div class="BigButton" style="background-image:url(.' . $layout_name . '/images/global/buttons/sbutton.gif)">
											<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(&quot;.' . $layout_name . '/images/global/buttons/sbutton_over.gif&quot;); visibility: hidden;"></div>
											<a href="?subtopic=newsarchive&action=filtrated">
												<input class="ButtonText" type="image" name="Submit" alt="Submit" src=".' . $layout_name . '/images/global/buttons/_sbutton_submit.gif">
												</a>
											</div>
										</div>
									</td>
								</tr>

						</tbody></table>
					</td>
				</tr>
			</tbody></table><br>';
}
if ($action == "filtrated") {
	$news_DB = $SQL->query("SELECT * FROM `z_forum` WHERE `section` = '1' AND `z_forum`.`id` = `first_post` ORDER BY `post_date` DESC LIMIT 25");
	if (empty($_REQUEST['view'])) {






		$main_content .= '
	<div class="TableContainer" style="position:relative;">
		<div class="ribbonShop-double"></div>
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url(.' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url(.' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionBorderTop" style="background-image:url(.' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionVerticalLeft" style="background-image:url(.' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text">News Archive</div>
					<span class="CaptionVerticalRight" style="background-image:url(.' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url(.' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(.' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(.' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
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
										<div class="TableShadowRightTop" style="background-image:url(.' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
									</div>
										<div class="TableContentAndRightShadow" style="background-image:url(.' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
										<div class="TableContentContainer">
											<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
													<tbody>

		<tr bgcolor="' . $config['site']['darkborder'] . '">
			<td class="white"><center>&#160;</center></td>
			<td width="70%" style="border:1px solid #faf0d7;"><b>Title</b></td>
			<td style="border:1px solid #faf0d7;"><b>Date</b></td>
		</tr>';
		foreach ($news_DB as $news) {
			if (is_int($number_of_rows / 2)) {
				$bgcolor = $config['site']['lightborder'];
			} else {
				$bgcolor = $config['site']['darkborder'];
			}
			$number_of_rows++;
			$main_content .= '<tr BGCOLOR=' . $bgcolor . '><td width="4%" style="border:1px solid #faf0d7;"><center><img src="' . $layout_name . '/images/global/content/' . $news['news_icon'] . '.gif"></center></td>
			<td><b>&#160;<a href="?subtopic=forum&action=show_thread&id=' . $news['id'] . '">' . stripslashes($news['post_topic']) . '</a></b></td>
			<td style="border:1px solid #faf0d7;">' . date("d/m/Y, H:m:s", $news['post_date']);
			if ($group_id_of_acc_logged >= $config['site']['access_admin_panel']) {
				$main_content .= '<br />[<a href="index.php?subtopic=forum&action=remove_post&id=' . $news['id'] . '"><font color="red">Delete</font></a>]';
			}
		}
		$main_content .= '</small></td></tr>
	 </tbody>
												</table>
											</div>
										</div>
									   <div class="TableShadowContainer">
										<div class="TableBottomShadow" style="background-image:url(.' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url(.' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url(.' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
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
</div>';
		$showed = true;
	}
	foreach ($news_DB as $news)
		if ($_REQUEST['view'] == $news['id']) {
			$BB = array(
				'/\[youtube\](.*?)\[\/youtube\]/is' => '<center><object width="500" height="405"><param name="movie" value="http://www.youtube.com/v/$1&hl=pt-br&fs=1&rel=0&color1=0x3a3a3a&color2=0x999999&border=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/$1&hl=pt-br&fs=1&rel=0&color1=0x3a3a3a&color2=0x999999&border=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="500" height="405"></embed></object></center>',
				'/\[b\](.*?)\[\/b\]/is' => '<strong>$1</strong>',
				'/\[center\](.*?)\[\/center\]/is' => '<center>$1</center>',
				'/\[quote\](.*?)\[\/quote\]/is' => '<table cellpadding="0" style="background-color: #c4c4c4; width: 480px; border-style: dotted; border-color: #007900; border-width: 2px"><tr><td>$1</td></tr></table>',
				'/\[u\](.*?)\[\/u\]/is' => '<u>$1</u>',
				'/\[i\](.*?)\[\/i\]/is' => '<i>$1</i>',
				'/\[letter\](.*?)\[\/letter\]/is' => '<img src=images/letters/$1.gif alt=$1 />',
				'/\[url](.*?)\[\/url\]/is' => '<a href=$1>$1</a>',
				'/\[color\=(.*?)\](.*?)\[\/color\]/is' => '<span style="color: $1;">$2</span>',
				'/\[img\](.*?)\[\/img\]/is' => '<img src=$1 alt=$1 />',
				'/\[player\](.*?)\[\/player\]/is' => '<a href=' . $server['ip'] . 'index.php?subtopic=characters&amp;name=$1>$1</a>',
				'/\[code\](.*?)\[\/code\]/is' => '<div dir="ltr" style="margin: 0px;padding: 2px;border: 1px inset;width: 500px;height: 290px;text-align: left;overflow: auto"><code style="white-space:nowrap">$1</code></div>'
			);
			//Functions
			function replaceSmile($text, $smile)
			{
				$smileys = array(
					':p' => 1,
					':eek:' => 2,
					':rolleyes:' => 3,
					';)' => 4,
					':o' => 5,
					':D' => 6,
					':(' => 7,
					':mad:' => 8,
					':)' => 9,
					':cool:' => 10
				);
				if ($smile == 1)
					return $text;
				else {
					foreach ($smileys as $search => $replace)
						$text = str_replace($search, '<img src="./images/forum/smile/' . $replace . '.gif" />', $text);
					return $text;
				}
			}

			function replaceAll($text, $smile)
			{
				$rows = 0;

				while (stripos($text, '[code]') !== false && stripos($text, '[/code]') !== false) {
					$code = substr($text, stripos($text, '[code]') + 6, stripos($text, '[/code]') - stripos($text, '[code]') - 6);
					if (!is_int($rows / 2)) {
						$bgcolor = 'ABED25';
					} else {
						$bgcolor = '23ED25';
					}
					$rows++;
					$text = str_ireplace('[code]' . $code . '[/code]', '<i>Code:</i><br /><table cellpadding="0" style="background-color: #' . $bgcolor . '; width: 480px; border-style: dotted; border-color: #CCCCCC; border-width: 2px"><tr><td>' . $code . '</td></tr></table>', $text);
				}
				$rows = 0;
				while (stripos($text, '[quote]') !== false && stripos($text, '[/quote]') !== false) {
					$quote = substr($text, stripos($text, '[quote]') + 7, stripos($text, '[/quote]') - stripos($text, '[quote]') - 7);
					if (!is_int($rows / 2)) {
						$bgcolor = 'AAAAAA';
					} else {
						$bgcolor = 'CCCCCC';
					}
					$rows++;
					$text = str_ireplace('[quote]' . $quote . '[/quote]', '<table cellpadding="0" style="background-color: #' . $bgcolor . '; width: 480px; border-style: dotted; border-color: #007900; border-width: 2px"><tr><td>' . $quote . '</td></tr></table>', $text);
				}
				$rows = 0;
				while (stripos($text, '[url]') !== false && stripos($text, '[/url]') !== false) {
					$url = substr($text, stripos($text, '[url]') + 5, stripos($text, '[/url]') - stripos($text, '[url]') - 5);
					$text = str_ireplace('[url]' . $url . '[/url]', '<a href="' . $url . '" target="_blank">' . $url . '</a>', $text);
				}
				while (stripos($text, '[player]') !== false && stripos($text, '[/player]') !== false) {
					$player = substr($text, stripos($text, '[player]') + 8, stripos($text, '[/player]') - stripos($text, '[player]') - 8);
					$text = str_ireplace('[player]' . $player . '[/player]', '<a href="?subtopic=characters&name=' . urlencode($player) . '">' . $player . '</a>', $text);
				}
				while (stripos($text, '[img]') !== false && stripos($text, '[/img]') !== false) {
					$img = substr($text, stripos($text, '[img]') + 5, stripos($text, '[/img]') - stripos($text, '[img]') - 5);
					$text = str_ireplace('[img]' . $img . '[/img]', '<img src="' . $img . '">', $text);
				}
				while (stripos($text, '[letter]') !== false && stripos($text, '[/letter]') !== false) {
					$letter = substr($text, stripos($text, '[letter]') + 8, stripos($text, '[/letter]') - stripos($text, '[letter]') - 8);
					$text = str_ireplace('[letter]' . $letter . '[/letter]', '<img src="./images/forum/letters/letter_martel_' . $letter . '.gif">', $text);
				}
				while (stripos($text, '[b]') !== false && stripos($text, '[/b]') !== false) {
					$b = substr($text, stripos($text, '[b]') + 3, stripos($text, '[/b]') - stripos($text, '[b]') - 3);
					$text = str_ireplace('[b]' . $b . '[/b]', '<b>' . $b . '</b>', $text);
				}
				while (stripos($text, '[i]') !== false && stripos($text, '[/i]') !== false) {
					$i = substr($text, stripos($text, '[i]') + 3, stripos($text, '[/i]') - stripos($text, '[i]') - 3);
					$text = str_ireplace('[i]' . $i . '[/i]', '<i>' . $i . '</i>', $text);
				}
				while (stripos($text, '[u]') !== false && stripos($text, '[/u]') !== false) {
					$u = substr($text, stripos($text, '[u]') + 3, stripos($text, '[/u]') - stripos($text, '[u]') - 3);
					$text = str_ireplace('[u]' . $u . '[/u]', '<u>' . $u . '</u>', $text);
				}
				return replaceSmile($text, $smile);
			}

			function showPost($topic, $text, $smile)
			{
				$post = '';
				if (!empty($topic))

					$post .= '<b>' . replaceSmile($topic, $smile) . '</b>';
				$post .= replaceAll($text, $smile);
				return $post;
			}
			//End Functions
			$main_content .= '
<div class="NewsHeadline">
<div class="NewsHeadlineBackground" style="background-image:url(' . $layout_name . '/images/global/content/newsheadline_background.gif)">
<img src="' . $layout_name . '/images/global/content/' . $news['news_icon'] . '.gif" class="NewsHeadlineIcon" alt=\'\' />
<div class="NewsHeadlineDate">' . date("d/m/Y", $news['post_date']) . ' - </div>
<div class="NewsHeadlineText">' . stripslashes($news['post_topic']) . '</div>
</div>
</div>
<table style="clear:both" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><img src="' . $layout_name . '/images/global/general/blank.gif" width="10" height="1" border="0" alt="" /></td>
<td width="100%"><font size="2">' . showPost('', $news['post_text'], $news['post_smile']) . '<br /></font><br></td>
<td><img src="' . $layout_name . '/images/global/general/blank.gif" width="10" height="1" border="0" alt="" /></td>
</tr>
</table>';
			$main_content .= '<br /><form action="index.php?subtopic=newsarchive" method="post">
<input type="image" src="' . $layout_name . '/images/global/buttons/sbutton_back.gif"name="Back" id="Back">
</form>';
			$showed = true;
		}
	if (!$showed) {
		$main_content .= '<div class="notice"><b>T</b>his news doeasn\'t exist.</div><br />';
		$main_content .= '<form action="index.php?subtopic=newsarchive" method="post">
<input type="image" src="' . $layout_name . '/images/global/buttons/sbutton_back.gif"name="Back" id="Back">
</form>';
	}
	if (empty($news))
		$main_content .= '
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="7" WIDTH="100%">
<TR BGCOLOR=' . $config['site']['darkborder'] . '><TD align="center">No news.</TD></TR>
</TABLE>';
}
if ($action == "tickets") {
	$main_content .= '
<form action="index.php?subtopic=newsarchive&action=filtrated&action=tickett" method="post">
	<table border=0 cellspacing=1 cellpadding=4 width="100%">
		<tr bgcolor=#505050>
			<td colspan=4 class=white><b>News Archive Search</b></td>
		</tr>
		<tr bgcolor=#D4C0A1 valign=middle align=center>
			<td width=10%><b>Type</b></td>
			<td width=30%><b>Category</b></td>
		</tr>
		<tr bgcolor=#D4C0A1 valign=middle align=center >
			<td nowrap=nowrap><div align=left>
					<input type="checkbox" name="ticker" value="ticker" checked/>
					News Ticker<br />
					<input type="checkbox" name="article" value="article" checked/>
					Featured Article<br />
					<input type="checkbox" name="news" value="news" checked/>
					News<br />
				</div></td>
			<td nowrap=nowrap valign=middle ><div align=left >
					<table cellspacing=1 cellpadding=0 border=0 align=left>
						<tr>
							<td nowrap=nowrap valign=middle>
								<input style="position: relative; top: -1px;" type="checkbox" name="2" value="2" checked/>
								<img style="position: relative; top: 1px;" src="' . $layout_name . '/images/global/news/icon_2.gif" />
							</td>
							<td nowrap=nowrap valign=middle>CipSoft</td>
						</tr>
						<tr>
							<td nowrap=nowrap valign=middle>
								<input style="position: relative; top: -1px;" type="checkbox" name="4" value="4" checked/>
								<img style="position: relative; top: 1px;" src="' . $layout_name . '/images/global/news/icon_4.gif" />
							</td>
							<td nowrap=nowrap valign=middle>Community</td>
						</tr>
						<tr>
							<td nowrap=nowrap valign=middle>
								<input style="position: relative; top: -1px;" type="checkbox" name="3" value="3" checked/>
								<img style="position: relative; top: 1px;" src="' . $layout_name . '/images/global/news/icon_3.gif" />
							</td>
							<td nowrap=nowrap valign=middle>Development</td>
						</tr>
						<tr>
							<td nowrap=nowrap valign=middle>
								<input style="position: relative; top: -1px;" type="checkbox" name="0" value="0" checked/>
								<img style="position: relative; top: 1px;" src="' . $layout_name . '/images/global/news/icon_0.gif" />
							</td>
							<td nowrap=nowrap valign=middle>Support</td>
						</tr>
						<tr>
							<td nowrap=nowrap valign=middle>
								<input style="position: relative; top: -1px;" type="checkbox" name="1" value="1" checked/>
								<img style="position: relative; top: 1px;" src="' . $layout_name . '/images/global/news/icon_1.gif" />
							</td>
							<td nowrap=nowrap valign=middle>Technical Issues</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<br />
	<center>
		<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0>
		<TR>
			<TD><INPUT TYPE=image NAME="Submit" ALT="Submit" SRC="' . $layout_name . '/images/global/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD>
		</TR>
	</FORM>
</TABLE>
</center>
';
}
if ($action == "tickett") {
	$qry_tickets = $SQL->query("SELECT * FROM newstickers ORDER BY `date` DESC LIMIT 25");
	foreach ($qry_tickets as $row) {
		if (is_int($number_of_rows / 2)) {
			$bgcolor = $config['site']['darkborder'];
		} else {
			$bgcolor = $config['site']['lightborder'];
		}
		$number_of_rows++;
		$main_content .= '<tr BGCOLOR=' . $bgcolor . '><td width="4%"><center><img src="' . $layout_name . '/images/news/icon_' . $row['image_id'] . '_big.gif"></center></td>
			<td>' . stripslashes($row['text']) . '<br /><br /><small><b>Post Date:&nbsp;' . date("d/m/Y, H:m:s", $row['date']) . '</b></small></td>';
	}
	$main_content .= '</tr>
</table>';
}
