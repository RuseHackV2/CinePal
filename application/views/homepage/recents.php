<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 10:02 PM
 */

?>

<div class="row" style="width:100%;margin:0;">
    <div class="col-md-6">
        <h1>Recent searches</h1>
        <?php

            if($recent != false){
                ?>
                <div style="font-size:20px">
                <?php
                foreach($recent as $r){
                    ?>
                    <a href="<?=site_url('/search').'/'.$r->query_string?>"><span class="label label-primary" style="font-size:16px;"><?=$r->query_string?></span></a>
                    <?php
                }
                ?>
                </div>
                <?php
            } else{
                ?>
                There are no recent searches.
                <?php
            }
        ?>
    </div>
    <div class="col-md-6">
        <h1>Trending</h1>
        <?php
        if($popular != false){
            ?>
            <div style="font-size:20px">
                <?php
                foreach($popular as $r){
                    ?>
                    <a href="<?=site_url('/search').'/'.$r->query_string?>"><span class="label label-primary" style="font-size:16px;"><?=$r->query_string?></span></a>
                    <?php
                }
                ?>
            </div>
            <?php
        } else{
            ?>
            Not enough searches.
            <?php
        }
        ?>
    </div>
</div>
