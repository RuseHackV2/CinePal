<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 8:20 PM
 */

?>

<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=site_url()?>"><img src="<?=base_url('static/images/icon.png')?>" style="height:30px;float:left;margin-right:8px;margin-top:-5px;"/> CinePal</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

            </ul>
            <?php if(!isset($disable_nav_search) || !$disable_nav_search) { ?>
            <form class="navbar-form navbar-left" role="search" action="javascript:void(0)" onsubmit="window.location.href='<?=site_url('/search/')?>/'+encodeURIComponent(document.getElementById('nav_search').value)">
                <div class="form-group">
                    <input type="text" required class="form-control" placeholder="Search" id="nav_search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <?php } ?>
            <ul class="nav navbar-nav navbar-right">
                <?php if(!isset($userid)){ ?>
                    <form class="navbar-form navbar-right" action="<?=site_url('/home/login')?>" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                        </div>
                        <input type="submit" value="Sign in" class="btn btn-success" name="submit"/>
                    </form>
                <?php } else { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?=$user->getName()?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=site_url('user/preferences')?>">Preferences</a></li>
                        <li><a href="#">My account</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?=site_url('/home/logout')?>">Log out</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
