<?php
if (!defined('INITIALIZED'))
	exit;

$time_start = microtime(TRUE);
session_start();

function autoLoadClass($className)
{
	if (!class_exists($className))
		if (file_exists('./classes/' . strtolower($className) . '.php'))
			include_once('./classes/' . strtolower($className) . '.php');
		else
			throw new RuntimeException('#E-7 -Cannot load class <b>' . $className . '</b>, file <b>./classes/class.' . strtolower($className) . '.php</b> doesn\'t exist');
}

spl_autoload_register('autoLoadClass');

//load acc. maker config to $config['site']
/** @var array $config */
$config = [];
$config_dist = './config/config.php';
if (!Website::fileExists($config_dist)) {
	$config_dist = './config/config.dist.php';
}

include($config_dist);
//load server config $config['server']
$tmp_lua_config = new ConfigLUA(Website::getWebsiteConfig()->getValue('serverPath') . 'config.lua');
$config['server'] = $tmp_lua_config->getConfig();

/**
 * @param string $name
 * @param string $sm_text
 * @var          $make_content_header
 * @return string
 */
$make_content_header = function ($name, $sm_text = '') {
	if ($sm_text && $sm_text != '') {
		$sm_text = '<div style="float: right"><small><span>' . $sm_text . '</small></span></div>';
	}
	$q = '
<div class="CaptionContainer">
	<div class="CaptionInnerContainer">
		<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
		<span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
		<span class="CaptionBorderTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);"></span>
		<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);"></span>
		<span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
		<span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
		<div class="Text" style="min-height: 17px"><div style="float: left">' . $name . '</div> ' . $sm_text . '</div>
		<span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
		<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);"></span>
		<span class="CaptionEdgeLeftBottom"></span>
		<span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
	</div>
</div>
  ';
	return $q;
};

/**
 * @param string  $class Table3
 * @param string  $align ''
 * @param boolean $stripped
 * @var           $make_table_footer
 * @return string
 */
$make_table_header = function ($class = 'Table3', $align = '', $stripped = false) {
	$q = '
<table class="' . $class . '" cellpadding="0" cellspacing="0" align="' . $align . '">
	<tbody>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table style="width:100%;">
						<tbody>
							<tr>
								<td>
									<div class="TableShadowContainerRightTop">
										<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div>
									</div>
									<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
										<div class="TableContentContainer">
											<table class="TableContent' . ($stripped ? ' TableStripped ' : ' ') . '" width="100%">
												<tbody>';
	return $q;
};

/**
 * @var $make_table_footer
 * @return string
 */
$make_table_footer = function () {
	$q = '
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
</table>';
	return $q;
};

/**
 * @var string $make_double_archs
 * @return string
 */
$make_double_archs = function ($title) {
	$html = '
<div style="text-align: -webkit-center !important;">
	<table>
		<tbody>
			<tr>
				<td><img src="./layouts/tibiacom/images/global/content/headline-bracer-left.gif"></td>
				<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">' . $title . '</td>
				<td><img src="./layouts/tibiacom/images/global/content/headline-bracer-right.gif"></td>
			</tr>
		</tbody>
	</table>
</div>
  ';
	return $html;
};
