<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-07
 * Time: 10:43 AM
 */

?>

<?=loadView('navbar')?>

<script type="text/javascript">
    $(function () {
        $('body').on('click','.dislike',function () {
            var $btn = $(this);
            var id = $(this).attr('data-id');
            var req = $.ajax({
                url: '<?=site_url('user/dislike')?>/'+id+'/',
                type: 'POST',
                dataType: 'json'
            });

            req.done(function (json) {
                if(json.error){
                    iosOverlay({
                        text: "Error",
                        duration: 2e3,
                        icon: "<?=base_url('static/lib/ios-overlay/img/check.png')?>"
                    });
                } else if(json.result && json.result == 'OK'){
                    iosOverlay({
                        text: "Done",
                        duration: 2e3,
                        icon: "<?=base_url('static/lib/ios-overlay/img/check.png')?>"
                    });
                    $btn.parent().find('.dislike').hide();
                    $btn.parent().find('.bookmark').hide();
                    if($btn.parent().find('.like').length > 0){


                        $btn.parent().append('<a href="javascript:void(0)" class="btn primary-alt btn-xs dislike" data-id="'+id+'">I\'ve watched this</a> ');
                        $btn.parent().append('<a href="javascript:void(0)" data-id="'+id+'" class="btn btn-danger btn-xs dislike">I don\'t like this</a>');
                    } else{
                        $btn.parent().append('<a href="javascript:void(0)" data-id="'+id+'" class="btn btn-primary btn-xs dislike btn-primary like">Remove from watched/disliked</a>');
                    }

                }
            });
            req.fail(function () {
                iosOverlay({
                    text: "Error",
                    duration: 2e3,
                    icon: "<?=base_url('static/lib/ios-overlay/img/check.png')?>"
                });
            });
        });
    } );


    function dislike(id){
        var req = $.ajax({
            url: '<?=site_url('user/dislike')?>/'+id+'/',
            type: 'POST',
            dataType: 'json'
        });

        req.done(function (json) {
            if(json.error){
                iosOverlay({
                    text: "Error",
                    duration: 2e3,
                    icon: "<?=base_url('static/lib/ios-overlay/img/check.png')?>"
                });
            } else if(json.result && json.result == 'OK'){
                iosOverlay({
                    text: "Done",
                    duration: 2e3,
                    icon: "<?=base_url('static/lib/ios-overlay/img/check.png')?>"
                });
            }
        });
        req.fail(function () {
            iosOverlay({
                text: "Error",
                duration: 2e3,
                icon: "<?=base_url('static/lib/ios-overlay/img/check.png')?>"
            });
        });
    }
</script>

<div id="content">
    <?php
        if(isset($error)){
            echo '<div class="alert alert-danger" style="margin-top:20px;">'.$error.'</div>';
        }else{
            echo loadView('recommendation/movie_details');
            echo loadView('recommendation/movie_recommendations');
        }
    ?>
</div>
