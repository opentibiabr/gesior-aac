<?php if (Website::getWebsiteConfig()->getValue('widget_Serverinfobox')) { ?>
<!-- Server Info theme box -->
<div id="Serverinfobox" class="Themebox"
     style="background-image:url(<?php echo $layout_name; ?>/images/global/themeboxes/serverinfo/serverinfobox.gif);">
    <a href="?subtopic=serverinfo">
        <img id="ScreenshotContent" class="ThemeboxContent" style="padding: 32px 40px 30px 5px;"
             src="<?php echo $layout_name; ?>/images/global/themeboxes/serverinfo/serverinfo.gif" alt="Server Info">
    </a>
    <div class="Bottom"
         style="background-image:url(<?php echo $layout_name; ?>/images/global/general/box-bottom.gif);"></div>
</div>
<!-- END Server Info theme box-->
<?php }?>