<?php

$url = "http://dir-ah.at/test/geo-fotos";
//Hier muss der Link angegeben werden, der zu den Bildern führt
$photos = "photos";
//Wenn sich der Verzeichnisname nicht ändert, kann das so bleiben
$thumbnails = "tims";
//Wenn sich der Verzeichnisname nicht ändert, kann das so bleiben. 
//Im Verzeichnis "tims" werden die Thumbnails automatisch erzeugt, wenn das Skript index.php aufgerufen wird.

function gps($coordinate, $hemisphere)
{
    for ($i = 0; $i < 3; $i++) {
        $part = explode('/', $coordinate[$i]);
        if (count($part) == 1) {
            $coordinate[$i] = $part[0];
        } else if (count($part) == 2) {
            $coordinate[$i] = floatval($part[0]) / floatval($part[1]);
        } else {
            $coordinate[$i] = 0;
        }
    }
    list($degrees, $minutes, $seconds) = $coordinate;
    $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
    return $sign * ($degrees + $minutes / 60 + $seconds / 3600);
}

$files = glob($photos . DIRECTORY_SEPARATOR . '*.{jpg,jpeg,JPG,JPEG}', GLOB_BRACE);
$fileCount = count($files);     
//Anzahl Bilder im Verzeichnis

echo "lat,lon,thumbnail,photo,name,"; 
//Aufbau der Daten für die CSV Datei. Der Titel des Bildes wurde ergänzt (name).
for ($i = ($fileCount - 1); $i >= 0; $i--) {
    $file = $files[$i];
    $photo_url = $url . DIRECTORY_SEPARATOR . $photos . DIRECTORY_SEPARATOR . basename($file);
    $photo_url = preg_replace('/\s+/', '%20', $photo_url);
    //Von Dirk Ziegler ergänzt: Wenn ein Dateiname ein Leerzeichen enthält, wird dieses durch %20 ersetzt, sodass der Link zu dem Foto funktioniert!
    //Achtung: im Dateinamen der Bilder darf kein Komma vorkommen.
    $thumbnail_url = $url . DIRECTORY_SEPARATOR . $photos . DIRECTORY_SEPARATOR . $thumbnails . DIRECTORY_SEPARATOR . basename($file);
    $filepath = pathinfo($file);
    $exif = exif_read_data($file);
    $lat = gps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
    $lon = gps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
    $exif = exif_read_data($file, 0, true);
    $titel = $exif["IFD0"]["ImageDescription"];
    echo $lat . "," . $lon . "," . $thumbnail_url . "," . $photo_url . "," . $titel . ",\n";
    //Hier wurde das ursprüngliche Skript um das EXIF Tag ImageDescription des Bildes erweitert.
    //ImageDescription entspricht in vielen Programmen (z.B.: Lightroom) der Bildunterschrift.
}
?>