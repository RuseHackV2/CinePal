<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-07
 * Time: 9:46 PM
 */
?>

            <h4 style="margin-top:0;"><?=$movie["Title"]?> (<?=$movie['Year']?>)</h4>

            <p><?=$movie["Plot"]?></p>
<div class="movie-facts">
    <p><span class="bold">Genre:</span> <?=$movie["Genre"]?></p>
    <p><span class="bold">Year:</span> <?=$movie["Year"]?></p>
    <p><span class="bold">Starring:</span> <?=$movie["Actors"]?></p>
    <p><span class="bold">Directed by:</span> <?=$movie['Director']?></p>
    <p><span class="bold">Awards:</span> <?=$movie['Awards']?></p>
    <p><span class="bold">IMDB Rating:</span> <?=$movie['imdbRating']?>/10</p>
    <p><span class="bold">Metascore:</span> <?=$movie['Metascore']?>/100</p>
    <div>
        <?php if(isset($_SESSION['userid'])){
            if(isset($user) && !$user->disliked($movie['imdbID'])){
                ?>

                <a href="javascript:void(0)" class="btn btn-success btn-xs bookmark" data-id="<?=$movie['imdbID']?>"><?=$user->bookmarked($movie['imdbID'])?'Remove bookmark':'Bookmark'?></a>
                <a href="javascript:void(0)" class="btn primary-alt btn-xs dislike" data-id="<?=$movie['imdbID']?>">I've watched this</a>
                <a href="javascript:void(0)" data-id="<?=$movie['imdbID']?>" class="btn btn-danger btn-xs dislike">I don't like this</a>

            <?php } else if(isset($user)){
                ?>
                <a href="javascript:void(0)" data-id="<?=$movie['imdbID']?>" class="btn btn-primary btn-xs dislike btn-primary like">Remove from watched/disliked</a>
                <?php
            }

        }?>

    </div>
</div>
