<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-08
 * Time: 12:11 PM
 */
?>

<?=loadView('navbar')?>

<script type="text/javascript">
    $(document).ready(function() {
        var max = 0;
        $('.search-box').each(function (){
            if($(this).height() > max) max = $(this).height();
        });
        $('.search-box').each(function () {
            $(this).css('height',(max+10)+'px');
        });
    });
</script>

<div >
    <div class="page-header" style="border:0;">
        <h1>My Watched/Disliked list</h1>
    </div>
    <?php
    if(!is_array($movies) || count($movies) < 1){
        {
            ?>
            <div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> No results were found for your query. Please try again.</div>
            <?php
        }
    } else
        foreach($movies as $m){
            if($m["Type"]=="movie")
                ?>
                <div class="col-md-2 search-box"> <a href="<?=site_url('recommendation/'.$m['imdbID'])?>">
            <img src="<?=$m['Poster']?>" style="width:200px;"/></a><br/>
            <div><a href="javascript:void(0)" class="btn btn-danger btn-xs">Remove</a>&nbsp;&nbsp;<a href="<?=site_url('recommendation/'.$m['imdbID'])?>" class="movie-title"><?=$m["Title"]?></a></div>
            </div>
            <?php
        }
    ?>
</div>
