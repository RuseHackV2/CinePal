<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 11:57 PM
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

<div id="content">

<div class="page-header" style="border:0;">
    <h1>Search results <small>for '<?=$criteria?>'</small></h1>
    </div>

    <div >
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
                <div onclick="window.location.href='<?=site_url('recommendation/'.$m['imdbID'])?>'" class="col-md-2 search-box">
                    <img src="<?=$m['Poster']?>" style="width:200px;"/><br/>
                    <?=$m["Title"]?>
                </div>
                <?php
            }
        ?>
    </div>
</div>


