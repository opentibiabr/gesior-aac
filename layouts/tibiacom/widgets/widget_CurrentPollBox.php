<?php if ($config['site']['widget_CurrentPollBox']) { ?>
    <!-- current poll theme box -->
    <?php
    $date = time();
    $getPolls = $SQL->query("SELECT * FROM `z_polls` LIMIT 1")->fetchAll();
    foreach ($getPolls as $poll) {
        if ($poll['end'] >= time()) {
            ?>
            <div id="CurrentPollBox" class="Themebox"
                 style="background-image:url(<?php echo $layout_name; ?>/images/global/themeboxes/current-poll/currentpollbox.gif);">
                <div id="CurrentPollText"><?php echo $poll['question']; ?></div>
                <div class="ThemeboxButton">
                    <form action="?subtopic=polls&id=<?php echo $poll['id']; ?>" method="post"
                          style="padding:0px;margin:0px;">
                        <div class="BigButton"
                             style="background-image:url(<?php echo $layout_name; ?>/images/global/buttons/sbutton.gif)">
                            <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                <div class="BigButtonOver"
                                     style="background-image:url(<?php echo $layout_name; ?>/images/global/buttons/sbutton_over.gif);"></div>
                                <input class="ButtonText" type="image" name="Vote Now" alt="Vote Now"
                                       src="<?php echo $layout_name; ?>/images/global/buttons/_sbutton_votenow.gif">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="Bottom"
                     style="background-image:url(<?php echo $layout_name; ?>/images/global/general/box-bottom.gif);"></div>
            </div>
            <?php
        }
    }
    ?>
<?php } ?>