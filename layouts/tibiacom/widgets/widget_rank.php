<?php if (Website::getWebsiteConfig()->getValue('widget_rank')) { ?>
    <!-- TOP LEVEL -->
    <div id="TopLvl">
        <h3 class="TopLvl_title">Top <?php $qtd = Website::getWebsiteConfig()->getValue('top_lvl_qtd');
            $qtd = (($qtd < 1) ? 1 : ($qtd > 5 ? 5 : $qtd));
            echo $qtd; ?> Experience</h3>
        <?php
        $a = 1;
        $queryOnline = $SQL->query('SELECT * from players p where p.group_id not in (5,6,7) and p.account_id != 1 order by p.level DESC, p.experience DESC LIMIT ' . $qtd);
        foreach ($queryOnline as $results) {
            $player = new Player();
            $player->loadById($results['id']);
            if (TRUE) {
                $currentMount = $player->getStorage(10002001 + 10);
                ?>
                <div class="tplevellayout">
                <?php $out_anim = (Website::getWebsiteConfig()->getValue('top_lvl_out_anim') ? 'animoutfit' : 'outfit'); ?>
                <style>
                    <?php echo'
                    .outfitImgtoplevel'.$player->getID().' {
                        z-index: 1;
                        width: 64px;
                        height: 64px;
                        position: absolute;
                        left: -36px;
                        margin-top: -15px;
                        background: url('.$player->makeOutfitUrl(). ') no-repeat 0 0;
                    }

                    .topleveltext:hover > .outfitImgtoplevel'.$player->getID().' {
                        background: url('.$player->makeOutfitUrl().') no-repeat 0 0;
                    }';?>

                </style>
                
                <?php
                if (!$player->isOnline()) {
                    echo '<a class="topleveltext top_offline" style="text-decoration:none" href="?subtopic=characters&name=' . urlencode($player->getName()) . '">';
                } else {
                    echo '<a class="topleveltext top_online" style="text-decoration:none" href="?subtopic=characters&name=' . urlencode($player->getName()) . '">';
                }
                ?>
                <?php echo '<div class="outfitImgtoplevel'.$player->getID().'"></div>'; ?>
                <span><?= $a ?></span> - <?= $player->getName() ?>
                <br>
                <small>&nbsp;&nbsp;&nbsp;Level: (<?php echo $player->getLevel() ?>)
                    <br/>
                    &nbsp;&nbsp;&nbsp;<?= $player->getVocationName(); ?>
                </small>
                </a>
                <?php if ($a == 1) { ?>
                    <div><span class="firstlevel"><span id="firstlevel"></span></span></div>
                    <div class="rankinglevel">
                        <span class="firstlevel">
                            <?php if (Website::getWebsiteConfig()->getValue('top_lvl_goku_isActive')) { ?>
                            <span id="<?php $m = ($player->getLookMount() == 0 ? "firstlevel_nomount" : "firstlevel_mount");
                            echo $m; ?>"></span><?php } ?>
                        </span>
                    </div>
                <?php } elseif ($a == 2) { ?>
                    <div><span class="secondlevel"><span id="seccondlevel"></span></span></div>
                    <div class="rankinglevel">
                        <span class="secondlevel">
                            <?php if (Website::getWebsiteConfig()->getValue('top_lvl_goku_isActive')) { ?>
                            <span id="<?php $m = ($player->getLookMount() == 0 ? "seccondlevel_nomount" : "seccondlevel_mount");
                            echo $m; ?>"></span><?php } ?>
                        </span>
                    </div>
                <?php } elseif ($a == 3) { ?>
                    <div><span class="thirdlevel"><span id="thirdlevel"></span></span></div>
                    <div class="rankinglevel">
                        <span class="thirdlevel">
                            <?php if (Website::getWebsiteConfig()->getValue('top_lvl_goku_isActive')) { ?>
                            <span id="<?php $m = ($player->getLookMount() == 0 ? "thirdlevel_nomount" : "thirdlevel_mount");
                            echo $m; ?>"></span><?php } ?>
                        </span>
                    </div>
                    <!-- <hr style="margin: 5px 0px 0 -29px;"/>-->
                <?php }
                $a++;
            }
            ?>
            </div>
            <?php
        } ?>
    </div>
    <!-- #END# TOP LEVEL -->
<?php } ?>
