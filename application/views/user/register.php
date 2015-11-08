<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-08
 * Time: 5:17 PM
 */
?>

<?=loadView('navbar')?>

<form class="form-horizontal" style="padding:10px;" action="<?=site_url('/user/register')?>" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend>Create an account</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="username">User name</label>
            <div class="col-md-4">
                <input id="username" name="username" type="text" placeholder="Enter an username..." class="form-control input-md" required="">

            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Password</label>
            <div class="col-md-4">
                <input id="password" name="password" type="password" placeholder="**********" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name" type="text" placeholder="Enter your name" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>
            <div class="col-md-4">
                <input id="email" name="email" type="text" placeholder="you@example.com" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Register</button>
            </div>
        </div>

    </fieldset>
</form>

