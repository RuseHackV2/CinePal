<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-07
 * Time: 11:51 AM
 */

?>

<script>
    $(document).ready(function()
    {
        $('.label').each(function() {
            $(this).qtip({
                content: {
                    text: function(event, api) {
                        $.ajax({
                                url: "<?=site_url()?>/recommendation_popup/"+api.elements.target.attr('data-imdb-id') // Use href attribute as URL
                            })
                            .then(function(content) {
                                // Set the tooltip content upon successful retrieval
                                api.set('content.text', content);
                            }, function(xhr, status, error) {
                                // Upon failure... set the tooltip content to error
                                api.set('content.text', status + ': ' + error);
                            });

                        return 'Loading...'; // Set some initial text
                    }
                },
                position: {
                    viewport: $(window)
                },
                style: {
                    classes: 'qtip-youtube'
                },
                hide: {
                    fixed: true,
                    delay: 300
                }
            });
        });

        $('[data-imdb-id]').each(function () {
            $(this).css('cursor','pointer');

            $(this).click(function () {
                var imdb_id = $(this).attr('data-imdb-id');
                window.location.href='<?=site_url()?>/recommendation/'+imdb_id;
            });
        });
    });
</script>

<?php if(is_array($recommendations) && count($recommendations) > 0){ ?>

<div class="page-header" style="border:0;">
    <h3>Based on this movie, we recommend... <small>Click on a movie to see details and more recommendations</small></h3>
    <div style="font-size:20px;">
        <?php
        foreach ($recommendations as $k=>$v){
            $class = 'primary-alt';
            if(isset($v['info']['imdbRating']) && $v['info']['imdbRating'] > 7){
                $class = 'label-success';
            }
            else if(isset($v['info']['imdbRating']) && $v['info']['imdbRating'] < 5){
                $class = 'label-danger';
            }
            ?>
            <span class="label <?=$class?>" data-imdb-id="<?=isset($v['info']['imdbID'])?$v['info']['imdbID']:''?>" data-id="<?=isset($v['info']['imdbID'])?$v['info']['imdbID']:''?>"><?=$v['name']?>&nbsp;<?=isset($v['info']['imdbRating'])?'<span class="badge">'.$v['info']['imdbRating'].'</span>':''?></span>
        <?php
        }
        ?>


    </div>
</div>
<?php }
else {
?>
    <div class="alert alert-danger" style="margin-top:20px;">We couldn't find any recommendations for you. Please try another movie.</div>
<?php } ?>
