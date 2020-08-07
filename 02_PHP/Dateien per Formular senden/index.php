<?php

// Information zu hochgeladenen Dateien
echo '<pre>$_FILES = ' . print_r($_FILES, 1) . '</pre>';

if (isset($_POST['submit'])) {

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    $uploaddir = "uploads";
    $uploaddatei = $_FILES['datei']['tmp_name'];

    //$dateimime = mime_content_type($uploaddatei);   //Hat bei XAMPP funktioniert
    $finfo = new finfo(FILEINFO_MIME_TYPE); // statt obere Zeile
    $dateimime = $finfo->file($uploaddatei); // statt obere Zeile

    echo $dateimime . "<br>";

    $kst = $_POST['kst'];
    $bvh = $_POST['bvh'];
    $lsnr = $_POST['lsnr'];
    $dateiname = $kst . "_" . $bvh . "_" . $lsnr . ".jpg";

    if ($dateimime == 'image/gif' || $dateimime == 'image/jpeg' || $dateimime == 'image/png' || $dateimime == 'image/bmp') {
        if (is_file($uploaddatei)) { // Datei erstellen und prüfen ob gemacht wurde
            echo 'Temp-File ist erstellt worden<br>';
            if (move_uploaded_file($uploaddatei, $uploaddir . "/" . $dateiname)) { // Datei uploaden und prüfen
                echo 'Upload wurde erfolgreich durchgeführt!<br>';
            } else {
                echo 'Upload <b>NICHT</br> erfolgreich!<br>';
            }
            ;
        } else {
            echo 'Temp-File ist <b>NICHT</b> erstellt worden<br>';
        }
    } else {
        echo "Dateiendung falsch!<br>";
    }

}

//unlink('dateiname.jpg');                              // Datei löschen
//copy('dateiname.jpg');                                // Datei kopieren
//rename('dateiname_alt.jpg','dir/dateiname_neu.jpg');  // Datei umbenennen und verschieben
//echo filemtime('dateiname.jpg');                      // Datei UNIX Timestamp - letzte Änderung
//echo fileatime('dateiname.jpg');                      // Datei UNIX Timestamp - Letztzugriff

// Formular für Dateiupload
echo '<form method="post" action="index.php" enctype="multipart/form-data" ">
    <input type="text" name="kst" placeholder="WW??"><br>
    <input type="text" name="bvh" placeholder="Baustelle"><br>
    <input type="text" name="lsnr" placeholder="LS-2020101"><br><br>
    <input type="file" name="datei"><br><br>
    <input type="submit" name="submit" value="senden">
    </form>';
