<?php if ($config['site']['widget_PremiumBox']) { ?>
<!-- Premium theme box -->
<style>
    .ribbon-double {
        background: url(<?php echo $layout_name; ?>/images/shop/ribbon-double.png) no-repeat;
        width: 80px;
        height: 80px;
        position: absolute;
        right: 0;
        top: -1px;
    }
</style>
<div id="PremiumBox" class="Themebox"
     style="background-image:url(<?php echo $layout_name; ?>/images/global/themeboxes/premium/premiumbox.gif);">
    <div id="doublePointsSelector">
        <?php
        $doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
        if ($doubleStatus['value'] == "active")
            echo '<div class="ribbon-double"></div>';
        ?>
    </div>

    <div class="ThemeboxButton">
        <form action="?subtopic=accountmanagement&action=donate" method="post" style="padding:0px;margin:0px;">
            <div class="BigButton"
                 style="background-image:url(<?php echo $layout_name; ?>/images/global/buttons/sbutton_green.gif)">
                <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                    <div class="BigButtonOver"
                         style="background-image:url(<?php echo $layout_name; ?>/images/global/buttons/sbutton_green_over.gif);">
                    </div>
                    <input class="ButtonText" type="image" name="Get Premium" alt="Get Premium"
                           src="<?php echo $layout_name; ?>/images/global/buttons/_sbutton_gettibiacoins.gif">
                </div>
            </div>
        </form>
    </div>
    <div class="Bottom" style="background-image:url(<?php echo $layout_name; ?>/images/global/general/box-bottom.gif);">
    </div>
</div>
<!-- END Premium theme box -->
<?php }?>