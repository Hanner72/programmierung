<?php
    $str = file_get_contents('http://207.180.205.39/api/nowplaying/blechradio1/');
    $json = json_decode($str, true);
    //echo '<pre>' . print_r($json, true) . '</pre>';
    //echo $json['now_playing']['song']['text'];
    //echo $json['now_playing']['song']['art'];
?>

<h1>1.</h1><img src="<?php echo $json['now_playing']['song']['art']; ?>" width="345" height="345" style=""><br><br>
<h1>2.</h1><img src="<?php echo $json['song_history']['0']['song']['art']; ?>" width="345" height="345" style=""><br><br>
<h1>3.</h1><img src="<?php echo $json['song_history']['1']['song']['art']; ?>" width="345" height="345" style=""><br><br>
<h1>4.</h1><img src="<?php echo $json['song_history']['2']['song']['art']; ?>" width="345" height="345" style="">