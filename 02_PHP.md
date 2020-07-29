# PHP

[[TOC]]

## Prüfen ob URL erreichbar ist

!!! info
    ```php
    // Prüft ob bestimmte URL existiert und erreichbar ist

    // URL oder Ressource definieren
    $seturl = 'http://fotos.strabag-sport.at/lieferschein_pdf/';

    //Funktion URL Check
    function url_check($url) {
        $urlheaders = @get_headers($url);
        return is_array($urlheaders) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$urlheaders[0]) : false;
    };

    //URL prüfen
    if(url_check($seturl)){
        //URL existiert, Hinweis ausgeben
        echo 'Die URL '.$seturl.' ist erreichbar!';
    } else {
        //URL existiert NICHT, Hinweis ausgeben und E-Mail senden
        //echo 'Die URL '.$seturl.' ist NICHT erreichbar! Eine E-Mail wurde an die angegebene Adresse gesendet.';
        $logdatei=fopen($logfile,"r+");
        $logtext = file_get_contents($logfile);
        $loginhalt = "<font color='green'>" . $jetzt . " - Datei: " . $dateiname1 . " - erfolgreich upgeloadet!</font>\n" . $logtext;
        fwrite ($logdatei, $loginhalt);
        fclose ($logdatei);
    }
    ```

## Gesendete Daten überprüfen

!!! info
    ```php
    // Information zu hochgeladenen Dateien
    echo '<pre>$_FILES = '.print_r($_FILES,1).'</pre>';
    ```

!!! info
    ```php
    echo '<pre>';
    print_r( $_GET );
    echo '</pre>';
    ```

## In Logfile schreiben

### Logfile Datei

```php
<?php
$logdatei=fopen("logs/logfile.txt","a");
fputs($logdatei,
    date("d.m.Y, H:i:s",time()) .
    ", " . $_SERVER['REMOTE_ADDR'] .
    ", " . $_SERVER['REQUEST_METHOD'] .
    ", " . $_SERVER['PHP_SELF'] .
    ", " . $_SERVER['HTTP_USER_AGENT'] .
    ", " . $_SERVER['HTTP_REFERER'] ."\n"
    );
fclose($logdatei);
?>
```

Script direkt in Seite einbauen oder per include einbinden mit

```php
<?php
include("logfile.php");
?>
```
[^Top](#PHP)

### An den Anfang einer Datei schreiben

1.  Datei angeben<br>
    ```$logdatei = "datei_log.txt";```
2.  Datei zum schreiben öffnen<br>
    ```$loghandle=fopen($logdatei,"r+");```
3.  bestehendes Logfile einlesen<br>
    ```$logtext = file_get_contents($logdatei);```
4.  Loginhalt in Variable schreiben<br>
    ```$loginhalt = $jetzt . " - Datei erfolgreich upgeloadet!\n" . $logtext;```
5.  in Logdatei schreiben<br>
    ```fwrite ($loghandle, $loginhalt);```
6.  Logdatei schließen<br>
    ```fclose ($loghandle);```

[^Top](#PHP)

## LOG auslesen und/oder Zeilen löschen

```php
<?php
$lines = file("upload.log");            # Datei Zeilenweise einlesen

$array_length = count($lines);          # Zeilen 1-20 anzeigen
for ($i = 0; $i < 20; ++$i) {
    echo $lines[$i];
    echo '<br>';
}

for ($j = 50; $j < 100; ++$j) {
unset( $lines[$j] );                      # Zeilen 11-50 löschen
}

//$lines = implode("\n", $lines);         # Text wieder zusammenfügen wahlweise mit Umbruch
file_put_contents("upload.log", $lines);  # Text wieder in die Datei schreiben

?>
```

[^Top](#PHP)

## Zeit und Datum

### Zeitzone überprüfen

```php
<?php
date_default_timezone_set('America/Los_Angeles');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Die Script-Zeitzone unterscheidet sich von der ini-set Zeitzone.';
} else {
    echo 'Die Script-Zeitzone und die ini-set Zeitzone stimmen überein.';
}
?>
```

## #div mit submit Button einblenden

In den einzublenden #DIV Container folgendes eintragen:

```html
<div class="container" id="divnotification" style="display: none">
    <div class="notification is-success">
        <button class="delete"></button>
        Datei(en) werden hochgeladen...
    </div>
</div>
```
danach in den input Button ein onclick Event einbauen mit der ID

```html
<form action="index.html" method="post">
<input type="submit" value="Reset" name="reset"
    onclick="document.getElementById('divnotification').style.display = '';">
```

# PHP und MYSQL
## Verbindung mit MYSQL

```php
<?php
// die Konstanten auslagern in eigene Datei
// die dann per require_once ('config.php'); 
// geladen wird.

// Damit alle Fehler angezeigt werden
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank
// die Daten erhalten Sie von Ihrem Provider
define ( 'MYSQL_HOST',         'localhost'    );
define ( 'MYSQL_BENUTZER',     'root'         );
define ( 'MYSQL_KENNWORT',     ''             );
define ( 'MYSQL_DATENBANK',    'kassabuch'   );

// AB HIER NICHTS MEHR ÄNDERN
$dbconn = mysqli_connect (MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);
mysqli_set_charset($dbconn, 'utf8');

if (mysqli_connect_errno($dbconn)) {
  echo ("Probleme mit der Verbindung: " . mysqli_connect_error());
}
// Arbeiten auf der Datenbank

// Ende der Arbeiten auf der Datenbank und Schließen der Connection
mysqli_close($dbconn);
```
