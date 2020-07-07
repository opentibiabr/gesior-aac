<?php if (!isset($_REQUEST['subtopic']) || $_REQUEST['subtopic'] == 'latestnews') { ?>
    
    <?php if (Website::getWebsiteConfig()->getValue('promo_isactive')) { ?>
        <div id="promo-overlay" style="display: none"></div>
        <div id="promoloader" style="z-index: 5000; display: none; margin-top: 150px;">
            <a href="./?subtopic=accountmanagement&action=donate">
                <img class="promo-image" src="./layouts/tibiacom/images/promocoes/<?=Website::getWebsiteConfig()->getValue('promo_imagename')?>"/>
            </a>
        </div>
        <script src="./layouts/tibiacom/promo/promo.js<?php echo $css_version;?>"></script>
        <script>
            $(document).ready(function () {
                showPromo();
            });
            $('#promoloader').on('click', function () {
                closePromo();
            });
            $(document).keyup(function(e) {
                if (e.key === "Escape") {
                    closePromo();
                }
            });
        </script>
    <?php }
} ?>