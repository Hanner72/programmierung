# PHP

[[TOC]]

# URL UND PFADE
 
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

[^Top](#PHP)

## Pfade und Dateien auslesen

```php
<?php
    echo "SERVER_NAME: ".$_SERVER['SERVER_NAME']."<br>";
    echo "SERVER_ADDR: ".$_SERVER['SERVER_ADDR']."<br>";
    echo "DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."<br>";
    echo "HTTP_HOST: ".$_SERVER['HTTP_HOST']."<br>";
    echo "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']."<br>";
    echo "REQUEST_URI: ".$_SERVER['REQUEST_URI']."<br>";
    
    echo "/".trim(str_replace(str_replace("\\", "/", $_SERVER["DOCUMENT_ROOT"]), '', str_replace("\\", "/", dirname(__FILE__))), "/<br>");

    $file_array = explode(".", basename($_SERVER['PHP_SELF']));
    echo "FILENAME OHNE ENDUNG: ".$file_array[0]."<br>";
?>
```
[^Top](#PHP)

## HOST auslesen für jedes System in PHP

```php
<?php
    $conflen=strlen('SCRIPT');
    $B=substr(__FILE__,0,strrpos(__FILE__,'/'));
    $A=substr($_SERVER['DOCUMENT_ROOT'], strrpos($_SERVER['DOCUMENT_ROOT'], $_SERVER['PHP_SELF']));
    $C=substr($B,strlen($A));
    $posconf=strlen($C)-$conflen-1;
    $D=substr($C,1,$posconf);
    $host='http://'.$_SERVER['SERVER_NAME'].'/'.$D;
    echo $host; // Hier wird der HOST ausgegeben
?>
```

## Absolute Pfade für includete Include Dateien setzen

Wenn man z.B. einen Header oder Footer benutzt und in diese eine Config-Datei includet, dann braucht man diese nicht mehr in die eigentliche Hauptdatei includen. Es genügt also in der Header Datei.

!!!Info
    Kann unter 
    http://127.0.0.1/programmierung/02_PHP/include_in_include_Pfad
    getestet werden.

!!!Warning outdated
    ```php
    $verzeichnisInclude = dirname(__FILE__) . "/"; // in der config.php festlegen
    // Hier wird der Pfad zur config.php gesetzt

    //die weiteren Dateien können nun in jeder Datei eingebunden werden und die Variable verlinkt immer auf den richtigen Pfad
    include_once($verzeichnisInclude . "lang_main.php");
    include_once($verzeichnisInclude . "bl_config.php");
    ```

!!!success aktuell
    ```php
    include __DIR__."/pfad/zur/datei.php";
    ```

!!!Warning
    Die config.php muss bei include-Dateien (z.B. Header, Footer, etc.) immer mit relativen Pfaden eingebunden werden.

[^Top](#PHP)

## header setzen

```php
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php#admins';
header("Location: http://$host$uri/$extra");
```

# AUTOMATION

## Daten in Seiten OHNE reload nachladen (PHP, jquery)

HTML Datei mit jquery CDN und JavaScript:
```html
    <html>
        <head>
            <script src="http://code.jquery.com/jquery-2.1.3.js" type="text/javascript"></script>
            <script>
                $(document).ready(function() {
                    $("#refresh").load("db_laden.php"); // ID refresh
                    var refreshId = setInterval(function() {
                        $("#refresh").load("db_laden.php"); // ID refresh
                    }, 7000); // Zeit in Millisekunden
                    });
            </script>
        </head>
        <body>
            <div id="refresh"></div> <!-- ID refresh -->
        </body>
    </html>
```

PHP Datei die in das Script geladen wird und mit der die Daten z.B. aus einer Datenbank geholt werden:
```php
<?php
echo "Inhalt";
?>
```


# DATEN ÜBERTRAGEN

## Prüfen ob $_GET oder $_POST gesetzt wurde

!!!Info
    **$_GET**

    wird per Link gesetzt, z.B:
    
    dannerbam.eu/link?gr=test

    **$_POST** 

    wird per Formular gesendet!


  ```php
  if(!isset($_GET['gr']) || ($_GET['gr']==="")){
      $gruppe = "";	
  }else{
      $gruppe = $_GET['gr'];
  }

  if ($gruppe != ""){
      echo "Gruppe ist gesetzt";
  }else{
      echo "Gruppe nicht gesetzt";
  }
  ```
[^Top](#PHP)

## Gesendete Daten überprüfen

!!! info
    ```php
    // Information zu hochgeladenen Dateien
    echo '<pre>$_FILES = '.print_r($_FILES,1).'</pre>';
    ```

!!! info
    ```php
    //Informationen zu $_GET oder $_POST Variablen
    echo '<pre>';
    print_r( $_GET );
    echo '</pre>';
    ```

!!!Info
    ```php
    //Informationen zu $_SESSION
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    ```

[^Top](#PHP)

## Dateien in Ordner zählen

```php
$path = "files" . "/"  . $kapitel . "/"  . $file . "/files";
$files = scandir($path);
$files_count = count($files)-2; // Minus zwei wegen "." und ".."
echo "$files_count Dateien in Ordner $path";
```

[^Top](#PHP)

## Formulardaten mit Daten aus MySQL füllen

```php
// Per GET übergebene Daten prüfen
if (isset($_GET['get_variable'])) {
    // wenn gesetzt dann in Parameter schreiben
    $get_variable = $_GET['get_variable'];
}else{
    // wenn nicht dann Weiterleitung
    echo '<META HTTP-EQUIV="Refresh" Content="3; URL=user.php">';
}
```

```php
// Datenbank mit Daten für Formular auslesen
$sql = "SELECT * FROM tabelle WHERE zeile_id=$get_variable";
      $result = $DB->query($sql);
      $e = function ($value) {
        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
      };
      $row = $result->fetch();

      $sql_daten = $row['name'];
?>
```

```html
<label class="control-label">Rolle</label> 
<select class="form-control" name="inputname">
    <option value="">-</option>
    <?php
        $sql = "SELECT * FROM role"; // Daten von Tabelle role holen
        foreach ($DB->query($sql) as $row) {
            $option_ausgabe .= '<option value="' . $row1['role_rolecode'] .'" 
            '. ($row['role_rolecode'] == $get_variable ? "selected=\"selected\"" : "") . ' 
            >'.$row['role_rolename'] .'</option>'; // Inline if else innerhalb der klammern ()
            }
        echo $option_ausgabe;
    ?>
</select>
```

[^Top](#PHP)

# ABFRAGEN

## if/else innerhalb Echo benutzen

if/else kann auch innerhalb von echo benutzt werden:

Die if/else Abfrage steht in den Klammern!

!!!Info
    z.B: wenn User eingeloggt ( $user['is_logged_in'] ) dann ( ? ) sonst ( : )

```php
echo 'Welcome '.($user['is_logged_in'] ? $user['first_name'] : 'Guest').'!';
```

!!!help
    // Beispiele

    https://davidwalsh.name/php-ternary-examples

[^Top](#PHP)

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

## Daten ver- und entschlüsseln

http://www.rither.de/a/informatik/php-beispiele/strings/strings-verschluesseln-und-entschluesseln/

```php
<?php
    function encodeRand($str, $seed=1234567) {
        mt_srand($seed);
        $out = array();
        for ($x=0, $l=strlen($str); $x<$l; $x++) {
            $out[$x] = (ord($str[$x]) * 3) + mt_rand(350, 16000);
        }
         
        mt_srand();
        return implode('-', $out);
    }
     
    function decodeRand($str, $seed=1234567) {
        mt_srand($seed);
        $blocks = explode('-', $str);
        $out = array();
        foreach ($blocks as $block) {
            $ord = (intval($block) - mt_rand(350, 16000)) / 3;
            $out[] = chr($ord);
        }
         
        mt_srand();
        return implode('', $out);
    }
     
    $seed = 1249135;
     
    echo "aaabbb:\n";
    var_dump(encodeRand('aaabbb', $seed));
    var_dump(decodeRand(encodeRand('aaabbb', $seed), $seed));
     
    echo "\n\n";
    echo "Katze:\n";
    var_dump(encodeRand('Katze', $seed));
    var_dump(decodeRand(encodeRand('Katze', $seed), $seed));
     
    echo "\n\n";
    echo "äöü:\n";
    var_dump(encodeRand('äöü', $seed));
    var_dump(decodeRand(encodeRand('äöü', $seed), $seed));
     
    echo "\n\n";
    echo "αЊᴁ₳:\n";
    var_dump(encodeRand('αЊᴁ₳', $seed));
    var_dump(decodeRand(encodeRand('αЊᴁ₳', $seed), $seed));
?>
```

Ausgabe:

```html
aaabbb:
string(31) "16257-6533-8419-14647-6719-9202"
string(6) "aaabbb"
 
 
Katze:
string(26) "16191-6533-8476-14719-6728"
string(5) "Katze"
 
 
äöü:
string(31) "16551-6734-8713-14899-7010-9472"
string(6) "äöü"
 
 
αЊᴁ₳:
string(51) "16584-6773-8752-14767-7100-9448-8752-1357-8724-7471"
string(10) "αЊᴁ₳"
```

[^Top](#PHP)

# ZEIT und DATUM

## Zeitzone überprüfen

```php
<?php
date_default_timezone_set('Europe/Vienna');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Die Script-Zeitzone unterscheidet sich von der ini-set Zeitzone.';
} else {
    echo 'Die Script-Zeitzone und die ini-set Zeitzone stimmen überein.';
}
?>
```
[^Top](#PHP)

# FORMATIERUNG

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

[^Top](#PHP)

# BILDER

## Georeferenzierte Bilder in Openstreetmap anzeigen

!!!warning die Links dazu
    https://hapede.de/sites/homepage/html/karte.html - Tut mit Demo

    https://gitlab.com/snippets/1661335 - csv.php Datei

    https://github.com/dmpop/mejiro - Script

[^Top](#PHP)

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
[^Top](#PHP)

# PHP Libraries

## Daten per Library ver- und entschlüsseln

!!!warning Link zur PHP Library phpAES
    http://www.phpaes.com/index.php#encrypt

!!!Info Beispielcode
    Beispiel auf der Library Seite

[^Top](#PHP)

## Bilder verändern, Wasserzeichen, Thumb

!!!warning Link zur PHP Library ImageWorkshop
    https://phpimageworkshop.com/tutorials.html

!!!Info Beispielcode
    Beispiel und Beschreibung auf der Library Seite

[^Top](#PHP)

## Bilder verändern, Wasserzeichen, Thumb

!!!warning Link zur PHP Library phpThumb()
    http://phpthumb.sourceforge.net/

!!!Info Beispielcode
    Beispiel und Beschreibung auf der Library Seite

[^Top](#PHP)

## Fake Daten erzeugen

!!!warning Link zur PHP Library FAKER
    https://github.com/fzaninotto/Faker

!!!Info Beispielcode
    Beispiel und Beschreibung auf der Library Seite

[^Top](#PHP)

## einfache Datenbank Anbindung

Bei Dieser Library ist es einfach in Datenbanken zu schreiben oder von denen zu lesen.

!!!warning Link zur PHP Library "PHP Advanced Database Class"
    http://slaout.linux62.org/php/index.html

!!!Info Beispielcode
    Beispiel und Beschreibung auf der Library Seite

[^Top](#PHP)