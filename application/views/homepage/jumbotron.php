<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 9:42 PM
 */

?>

<script type="text/javascript">
   /* $(function () {
        $('#jumbotron').css('background-size',$('#jumbotron').width()*1.2+'px '+$('#jumbotron').height()*3+'px');
        $(window).resize(function (){
            $('#jumbotron').css('background-size',$('#jumbotron').width()*1.2+'px '+$('#jumbotron').height()*3+'px');
        });

    });*/
</script>

<div class="jumbotron" id="jumbotron" style="padding-left:10px;padding-right:10px;margin-top:0;text-align: center; background-image:url(<?=base_url('/static/images/jumbotron_bg91.jpg')?>); background-position:center; text-shadow: 2px 2px #000;">
    <h2 style="text-shadow: 2px 4px #000;">See recommendations based on a movie you've watched.</h2>
    <p>Enter a movie title in the box.</p>
    <form class="form-inline" action="javascript:void(0)" onsubmit="window.location.href='<?=site_url('search')?>/'+encodeURIComponent(document.getElementById('movieSearch').value)">
        <input type="text" required id="movieSearch" placeholder="Search for a movie..." class="form-control input-xxlarge" style="margin-bottom:15px;"/>
        <input type="submit" value="Search" class="btn btn-success" style="margin-bottom: 15px;"/>
    </form>
</div>