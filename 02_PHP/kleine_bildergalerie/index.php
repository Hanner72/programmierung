<?php

$bilder = array();
$dir = "./bilder/";
$handle = opendir($dir);

while(false !== ($file = readdir($handle))) {
    if($file != "." && $file != "..") {
        array_push($bilder,$dir.$file);
    }
}

$anzahl = count($bilder);

$img = $_GET['img'];
if(empty($img)) $img = 0;

if($img > ($anzahl-1)) {
	echo "Bild nicht vorhanden!";
}

else {
	echo '<img src="'.$bilder[$img].'" alt="Bild '.($img+1).'" width="500px"><br><br>';
	if($img != 0) echo '<a href="index.php?img='.($img-1).'">Zurück</a>';
	echo " | ";
	if($img < ($anzahl-1)) echo '<a href="index.php?img='.($img+1).'">Vorwärts</a>';
}

echo "<br /><br />";
echo "Bild ".($img+1)." von ".$anzahl;


?>