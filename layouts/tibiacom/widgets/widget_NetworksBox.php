<?php if ($config['site']['widget_NetworksBox']) { ?>
<!-- Facebook theme box -->
<div id="NetworksBox" class="Themebox"
     style="background-image:url(<?php echo $layout_name; ?>/images/global/themeboxes/networks/networksbox.png);">
    <div id="FacebookBlock">
        <a id="FacebookPageLink" target="_blank" href="<?php echo $config['social']['facebook']; ?>">
            <!--                                                <img src="-->
            <?php //echo $layout_name; ?><!--\images\global\themeboxes\networks\tibia-facebook-page-logo.png" /></a>-->
            <img style="width: 50px; height: 50px;"
                 src="<?= $config['social']['fbapilink'] ?><?= $config['social']['fbapiversion'] ?>/<?= $config['social']['fbpageid'] ?>/picture?access_token=<?= $config['social']['accessToken'] ?>"/></a>
        <div id="FacebookLikeButton">
            <div class="fb-like" data-href="<?php echo $config['social']['facebook']; ?>" data-layout="button"
                 data-action="like" data-show-faces="false" data-share="false"></div>
        </div>
        <div id="FacebookShareButton">
            <div class="fb-share-button" data-href="<?php echo $config['social']['facebook']; ?>"
                 data-layout="button"></div>
        </div>
        <div id="FacebookLikes">
            <div class="fb-like" data-href="<?php echo $config['social']['facebook']; ?>" data-width="250"
                 data-layout="standard" data-action="recommend" data-show-faces="false"></div>
        </div>
    </div>
    <div class="Bottom"
         style="background-image:url(<?php echo $layout_name; ?>/images/global/general/box-bottom.gif);"></div>
</div>
<!-- END Facebook theme box -->
<?php }?>