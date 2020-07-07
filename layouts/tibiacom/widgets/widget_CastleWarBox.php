<?php if ($config['site']['widget_CastleWarBox']) { ?>
    <div id="CastleWarBox" class="Themebox"
         style="background-image:url(<?PHP echo "$layout_name"; ?>/images/themeboxes/chaoscastlhenews.png); margin-bottom:20px; height:110px;">
        <div style="padding-top:48px;">
            <div align="center" style="text-align:center;">
                <?php foreach ($SQL->query('SELECT * FROM `global_storage` WHERE `key` = 48503')->fetchAll() as $storage) {
                    if ($storage['value'] != -1) {
                        $guildId = $storage['value'];
                        break;
                    }
                }
                
                $guild = new Guild();
                $guild->loadById($guildId);
                if (!$guild)
                    $name = "";
                else
                    $name = $guild->getName();
                ?>
                <a class="topfont" style="font-size: .8em; position: absolute; top: 86px; left: 76px;">
                    <?php if ($guildId != 0) {
                        echo '<img style="position: absolute; top: -42px; left: -76px; border-radius: 7px;" src="/guild_image.php?id=' . $guildId . '" width="64" height="64" border="0"/>';
                    } else {
                        echo 'Nenhuma guild.';
                    } ?>
                </a>
                <p>
                    <a href="?subtopic=castlewar"
                       style="background: transparent url(layouts/tibiarl/images/menu/fire.gif);font-size:14px;text-shadow: 0.1em 0.1em #333"
                       class="topfont">
                        <font color="white" style="font-size: 0.7em; position: relative; left: 32px; top: 4px;">Guild
                            Dominante<br></font>
                        <span style="font-size:12px;font-weight:bold">
                                                        <font color="#fc3"
                                                              style="position: absolute; top: 80px; left: 85px;"><?php echo $name; ?></font>
                                                        </span>
                    </a>
                </p>
            </div>
        </div>
    </div>
<?php } ?>