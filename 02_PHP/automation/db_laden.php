<?php
    $str = file_get_contents('https://streamt.at/api/nowplaying/blechradio1/');
    $json = json_decode($str, true);
?>

<img src="<?php echo $json['now_playing']['song']['art']; ?>" width="345" height="345" style=""><br>

<p class="big text-white"><a class="link-color-inherit" href="#"><?php echo $json['now_playing']['song']['artist']; ?> - <?php echo $json['now_playing']['song']['title']; ?></a></p>