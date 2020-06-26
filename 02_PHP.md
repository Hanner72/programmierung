# PHP

[[TOC]]



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