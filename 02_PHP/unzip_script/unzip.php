<?php 
// ////////////////////////////////////////////////////////////////////////// //
//                                                                            //
// Unzip Script                                                               //
// PHP-Script zum komfortablen Entpacken von ZIP-Archiven auf dem Server      //
//                                                                            //
// (c) Gerhard Kerner                                                         //
// technikblog.gerhard-kerner.at                                              //
// Version 1.3, Juni 2018                                                     //
//                                                                            //
// Anwendung: Einfach das Unzip Script nach Bedarf konfigurieren, in dasselbe //
// Verzeichnis wie das zu enpackende ZIP-Archiv laden und im Browser aufrufen //
//                                                                            //
// Das ZIP-Archiv wird automatisch ermittelt und vor dem Entpacken angezeigt. //
// Sind mehrere ZIP-Archive vorhanden, wird das alphabetisch letztgereihte    //
// Archiv ausgewählt. Alternativ dazu kann auch ein ZIP-Archiv manuell        //
// festgelegt werden.                                                         //
//                                                                            //
// Im Konfigurationsbereich können folgende Variablen festgelegt werden:      //
//                                                                            //
//    $zielverzeichnis  = Name des Zielverzeichnisses                         //
//    $quelldatei_manuell = Name des ZIP-Archivs manuell festlegen (Optional) //
//                                                                            //
// ACHTUNG, BITTE BEACHTEN: Eventuell bereits vorhandene Dateien im Ziel-     //
// verzeichnis werden OHNE RÜCKFRAGE überschrieben! Ich kann keine Haftung    //
// für eventuellen Datenverlust durch die Nutzung dieses Scripts übernehmen.  //
//                                                                            //
// GNU General Public License:                                                //
//                                                                            //
// Dieses Script ist Freie Software: Sie können es unter den Bedingungen      //
// der GNU General Public License, wie von der Free Software Foundation,      //
// Version 3 der Lizenz oder (nach Ihrer Option) jeder späteren               //
// veröffentlichten Version, weiterverbreiten und/oder modifizieren.          //
//                                                                            //
// Dieses Script wird in der Hoffnung, dass es nützlich sein wird, aber       //
// OHNE JEDE GEWÄHRLEISTUNG, bereitgestellt; sogar ohne die implizite         //
// Gewährleistung der MARKTFÄHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK. //
// Für weitere Details siehe: http://www.gnu.org/licenses/                    //
//                                                                            //
// ////////////////////////////////////////////////////////////////////////// //

error_reporting(0);

// --- Konfigurationsbereich Beginn ---
$zielverzeichnis = './'; // HIER DEN NAMEN DES ZIELVERZEICHNISSES EINTRAGEN! ('./' = Selbes Verzeichnis wie unzip.php)

$quelldatei_manuell = ''; // Alternativ zur automatischen Ermittlung des ZIP-Archivs kann hier ein Archiv manuell festgelegt werden. Leer lassen, um die automatische Ermittlung beizubehalten (Standard: '')
// --- Konfigurationsbereich Ende ---

// Feste Variablen
$extension = "zip";
$quellverzeichnis = "./";
$quelldatei = '<span style="color:red;">Fehler: Kein ZIP-Archiv gefunden!</span>';
$ausgabe_ok = '<span style="color:green;">Das ZIP-Archiv wurde erfolgreich in das angegebene Verzeichnis entpackt.</span>';
$ausgabe_fehler = '<span style="color:red;">Es ist ein Fehler beim Entpacken des ZIP-Archivs aufgetreten!</span>';
$ergebnis = 'Noch nicht ausgeführt';

// ZIP-Archiv ermitteln
$dateien = scandir($quellverzeichnis, 0);
  foreach ($dateien as $datei)
    {
    $fileinfos = pathinfo($quellverzeichnis."/".$datei);

    if ($datei != "." && $datei != ".." && $fileinfos['basename'])
    {
    $dateitypen= array("$extension");
    if(in_array($fileinfos['extension'],$dateitypen))
    {
  unset($datei);

  $quelldatei_aktuellste = $fileinfos['filename'] . ".zip";

    if(empty($quelldatei_manuell)){$quelldatei = $quelldatei_aktuellste;}
    else{$quelldatei = $quelldatei_manuell;}

    };
  };
};

// ZIP-Archiv entpacken
if(isset($_POST["entpacken"])) {
  $zip = new ZipArchive;
  $res = $zip->open($quelldatei);
    if ($res === TRUE) {
      $zip->extractTo($zielverzeichnis);
      $zip->close();
        $ergebnis = $ausgabe_ok;
    } else {
        $ergebnis = $ausgabe_fehler;
    }
}
?>

<!-- Nachsehen ob Dateien im Ordner -->
<?php
$path = "Testordner/";
$filesFound = 0;
if (is_dir($path) && $pp = opendir($path)) { 
  while (($file = readdir($pp)) !== false) {
    if ($file != "." && $file != "..") {
      $filesFound++;
    }
  }
  closedir($pp);
}
print "$filesFound Dateien in Ordner $path";
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8" />
  <meta name="MobileOptimized" content="width" />
  <meta name="HandheldFriendly" content="true" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Unzip Script</title>

  <style type="text/css">
  body {
    color: #333;
    background: #fff;
    font-size: 13px;
    font-family: "Lucida Grande", "Lucida Sans Unicode", "DejaVu Sans", "Lucida Sans", sans-serif;
    margin: 0;
    width: 100%;
    height: 100%;
    padding: 3em 0;
    vertical-align: middle;
    background-color: #e0e0d8;
    background-image: radial-gradient(hsl(203, 2%, 90%), hsl(203, 2%, 95%));
    background-repeat: repeat;
    background-position: left top, 50% 50%;
  }

  #layout-container {
    background: #fff;
    margin: 0 auto;
    width: 75%;
    border-radius: 5px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    padding: 20px 0 40px 0;
  }

  #page-title {
    margin: 0.75em 1.9em;
    font-size: 26px;
    font-weight: bold;
    line-height: 1.2em;
    color: #0074bd;
    display: inline-block;
  }

  p {
    margin: 1em 4em;
    color: #333;
    font-size: 13px;
    line-height: 1.2em;
  }

  #button {
    text-align: center;
    margin: 40px 0 10px 0;
  }

  #footer {
    text-align: center;
    font-size: 11px;
    color: #8e8e8e;
  }
  </style>

</head>

<body>

  <div id="layout-container">

    <h1 id="page-title">Unzip Script - ZIP-Archive am Server entpacken</h1>

    <p>Das folgende ZIP-Archiv wird in das angegebene Verzeichnis entpackt. Die Ermittlung des ZIP-Archivs erfolgt
      automatisch. Sind mehrere ZIP-Archive vorhanden, wird das alphabetisch letztgereihte Archiv ausgewählt. Alternativ
      dazu lässt sich ein bestimmtes ZIP-Archiv auch fix im Konfigurationsbereich eintragen. Das
      <em>Zielverzeichnis</em> kann im Script festgelegt werden. Standardmäßig wird das Archiv direkt in das
      Installationsverzeichnis des Scripts entpackt.<br><br>ACHTUNG: Eventuell bereits vorhandene Dateien im
      Zielverzeichnis werden OHNE RÜCKFRAGE überschrieben! Für weitere Informationen zur Anwendung siehe die beiliegende
      info.txt<br><br>Abhängig von der Größe des ZIP-Archivs kann der Entpackvorgang einige Sekunden dauern.</p>
    <p>&nbsp;</p>
    <p>Ausgewähltes ZIP-Archiv: <strong><span style="color:green;"><?php echo $quelldatei ?></span></strong></p>
    <p>Zielverzeichnis: <strong><?php echo $zielverzeichnis ?></strong></p>
    <p>&nbsp;</p>
    <p>Ergebnis: <strong><?php echo $ergebnis ?></strong></p>

    <div id="button">
      <form method="post">
        <input type="submit" name="entpacken" value="ZIP-Archiv in das Zielverzeichnis entpacken" />
      </form>
    </div>

  </div>

  <p id="footer">technikblog.gerhard-kerner.at</p>

</body>

</html>