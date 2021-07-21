# PDO

[[TOC]]

# LINKS

[PDO Tutorial - hier verwendet](https://www.php-einfach.de/mysql-tutorial/php-prepared-statements/)

[Komplexe Select Abfragen](https://www.php-einfach.de/mysql-tutorial/komplexere-datenabfrage/)

[Datenbank Backup per PHPq](https://www.php-einfach.de/experte/php-sicherheit/daten-sicher-speichern/datenbankbackup-per-php/)

# Verbindung aufbauen

```php
$pdo = new PDO('mysql:host=localhost;dbname=databasename', 'username', 'password');
```

[^Top](#PDO)

# Abfragen
## einfache Abfrage

```php
$sql = "SELECT * FROM users";
foreach ($pdo->query($sql) as $row) {
   echo $row['email']."<br />";
   echo $row['vorname']."<br />";
   echo $row['nachname']."<br /><br />";
}
```

[^Top](#PDO)

## Abfrage mit anonymen Parametern

```php
$statement = $pdo->prepare("SELECT * FROM users WHERE vorname = ? AND nachname = ?");
$statement->execute(array('Max', 'Mustermann'));   
while($row = $statement->fetch()) {
   echo $row['vorname']." ".$row['nachname']."<br />";
   echo "E-Mail: ".$row['email']."<br /><br />";
}
```

[^Top](#PDO)

## Abfrage mit benannten Parametern

```php
$statement = $pdo->prepare("SELECT * FROM users WHERE vorname = :vorname AND nachname = :nachname");
$statement->execute(array(':vorname' => 'Max', ':nachname' => 'Mustermann'));   
while($row = $statement->fetch()) {
   echo $row['vorname']." ".$row['nachname']."<br />";
   echo "E-Mail: ".$row['email']."<br /><br />";
}
```

# Daten einfügen

Für prepared Statements haben wir die Möglichkeit die Platzhalter entweder anonym per ? zu definieren, oder diese zu benennen.

## einfügen mit anonymen Parametern

```php
$statement = $pdo->prepare("INSERT INTO tabelle (spalte1, spalte2, splate3) VALUES (?, ?, ?)");
$statement->execute(array('wert1', 'wert2', 'wert3'));
```

## einfügen mit benannten Parametern

```php
$statement = $pdo->prepare("INSERT INTO users (email, vorname, nachname) VALUES (:email, :vorname, :nachname)");
$statement->execute(array('email' => 'info@php-einfach.de', 'vorname' => 'Klaus', 'nachname' => 'Neumann'));
```

oder

```php
$neuer_user = array();
$neuer_user['email'] = 'info@php-einfach.de';
$neuer_user['vorname'] = 'Klaus';
$neuer_user['nachname'] = 'Neumann';
$neuer_user['weiteres_feld'] = 'Dieses wird beim Eintragen ignoriert';
 
$statement = $pdo->prepare("INSERT INTO users (email, vorname, nachname) VALUES (:email, :vorname, :nachname)");
$statement->execute($neuer_user); 
```

## mehrere Zeilen einfügen

Mit prepared Statements ist es einfach mehrere neue Zeilen einzutragen. Dazu müsst ihr einfach immer nur erneut $statement->execute($data) aufrufen. Im folgenden Beispiel legen wir die Nutzer Vorname0 bis Vorname9 an:

```php
$statement = $pdo->prepare("INSERT INTO users (email, vorname, nachname) VALUES (:email, :vorname, :nachname)");
 
for($i=0;$i<10; $i++) {
   $neuer_user = array('email' => 'email'.$i, 'vorname' => 'Vorname'.$i, 'nachname' => 'Nachname'.$i)
   $statement->execute($neuer_user);   
}
```

# Daten aktualisieren

## Update einer einzelnen Zeile

```php
$statement = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
$statement->execute(array('neu@php-einfach.de', 1));
```

## Update mit benannten Parametern

```php
$statement = $pdo->prepare("UPDATE users SET email = :email_neu WHERE id = :id");
$statement->execute(array('id' => 1, 'email_neu' => 'neu@php-einfach.de'));
```

## Mehrere Felder aktualisieren

Bisher wurde immer nur ein Feld aktualisiert. Um mehrere Felder zu aktualisieren, könnt ihr entweder mehrere SQL-Anweisungen schreiben, oder alles in eine. Dazu führt ihr im SET-Teil alle Spalten und Werte ein (per Komma getrennt), die ihr aktualisieren wollt.

```php
$statement = $pdo->prepare("UPDATE users SET vorname = :vorname_neu, email = :email_neu, nachname = :nachname_neu WHERE id = :id");
$statement->execute(array('id' => 1, 'email_neu' => 'neu@php-einfach.de', 'vorname_neu' => 'Neuer Vorname', 'nachname_neu' => 'Neuer Nachname'));
```

## Werte erhöhen

Es lassen sich in MySQL auch sehr einfach die Werte von Feldern erhöhen oder verkleinern. Möchtet ihr z.B. die Anzahl der Logins protokollieren, so müsst ihr einfach folgenden Befehl bei jedem Login ausführen:

```php
$statement = $pdo->prepare("UPDATE users SET anzahl_logins = anzahl_logins+1 WHERE id = :id");
$statement->execute(array('id' => 1));
```

## Sortieren und begrenzen

Identisch zu SELECT-Anweisungen können wir bei UPDATE ebenfalls ORDER BY und LIMIT verwenden. Möchten wir beispielsweise die Benutzer mit den 10 kleinsten IDs aktualisieren, geht dies wie folgt:

```php
$statement = $pdo->prepare("UPDATE users SET vorname = :vorname_neu ORDER BY id LIMIT 10");
$statement->execute(array('vorname_neu' => 'Neuer Vorname'));
```

[^Top](#PDO)

# Daten löschen

## einzelne Zeile löschen

```php
$statement = $pdo->prepare("DELETE FROM tabelle WHERE spalte = ?");
$statement->execute(array('Wert für Spalte'));
```

## bestimmten Datensatz löschen

```php
$statement = $pdo->prepare("DELETE FROM users WHERE vorname = :vorname AND nachname = :nachname");
$statement->execute(array('vorname' => 'Max', 'nachname' => 'Mustermann')); //Löscht Benutzer mit Namen Max Mustermann
```

[^Top](#PDO)

# Anzahl der Zeilen

Die Anzahl der betroffenen Zeilen können mittels der Methode rowCount() ermittelt werden:

```php
$pdo = new PDO('mysql:host=localhost;dbname=databasename', 'username', 'password');
$statement = $pdo->prepare("SELECT * FROM users WHERE vorname = ?");
$statement->execute(array('Max')); 
$anzahl_user = $statement->rowCount();
echo "Es wurden $anzahl_user gefunden";
```

[^Top](#PDO)

# Eingefügte ID

Die vergebene ID einer Auto Increment-Spalte kann mittels der Methode lastInsertId() abgerufen werden.

```php
$statement = $pdo->prepare("INSERT INTO users (email, vorname, nachname) VALUES (?, ?, ?)");
$statement->execute(array('info@php-einfach.de', 'Klaus', 'Neumann'));   
 
$neue_id = $pdo->lastInsertId();
echo "Neuer Nutzer mit id $neue_id angelegt";
?>
```

[^Top](#PDO)

# MySQL Fehlermeldung

Zum Abrufen der MySQL Fehlermeldung existiert die Methode errorInfo().

```php
$statement = $pdo->prepare("SELECT email, password FROM users");
 
if($statement->execute()) {
    while($row = $statement->fetch()) {
        echo $row['email']."<br />";
    }    
} else {
    echo "SQL Error <br />";
    echo $statement->queryString."<br />";
    echo $statement->errorInfo()[2];
}
```

[^Top](#PDO)