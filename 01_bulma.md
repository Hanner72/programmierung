# Bulma

[[TOC]]

## Hilfeseiten

| Nr | Bereich          | Link                                                            |
| -- | ---------------- | --------------------------------------------------------------- |
| 1  | Sart             | https://bulma.io/documentation/overview/start/#starter-template |
| 2  | hero:            | https://bulma.io/documentation/layout/hero/                     |
| 3  | section:         | https://bulma.io/documentation/layout/section/                  |
| 4  | columns:         | https://bulma.io/documentation/columns/basics/                  |
| 5  | level:           | https://bulma.io/documentation/layout/level/                    |
| 6  | Tiles            | https://bulma.io/documentation/layout/tiles/                    |
| 7  | image:           | https://bulma.io/documentation/elements/image/                  |
| 8  | media:           | https://bulma.io/documentation/layout/media-object/             |
| 9  | icon:            | https://bulma.io/documentation/elements/icon/                   |
| 10 | Form:            | https://bulma.io/documentation/form/general/                    |
| 11 | breadcrumb:      | https://bulma.io/documentation/components/breadcrumb/           |
| 12 | Footer:          | https://bulma.io/documentation/layout/footer/                   |
|    |                  |                                                                 |
| 40 | Bulma Extensions | https://wikiki.github.io/                                       |
| 50 | Formbuilder:     | https://jesobreira.github.io/Bulma-Form-Builder/                |

[^Top](#Bulma)

## 01 - Startcode incl. fontawesome

```html
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
    Hier kommt der Seiteninhalt rein
  </body>
</html>
```

[^Top](#Bulma)

## 02 - Beginn mit Framework -> HERO

### CONTAINER innerhalb HERO = Farbe bis Seitenende

```html
<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Primary title
      </h1>
      <h2 class="subtitle">
        Primary subtitle
      </h2>
    </div>
  </div>
</section>
```

### CONTAINER ausserhalb HERO = Farbe bis Container

```html
<div class="container">
  <section class="hero is-primary">
    <div class="hero-body">
      <h1 class="title">
        Primary title
      </h1>
      <h2 class="subtitle">
        Primary subtitle
      </h2>
    </div>
  </section>
</div>
```

### Hero **OHNE** Container formatiert den Text ganz Links.

```html
<section class="hero is-primary">
  <div class="hero-body">
    <h1 class="title">
      Primary title
    </h1>
    <h2 class="subtitle">
      Primary subtitle
    </h2>
  </div>
</section>
```

[^Top](#Bulma)

## 03 - SECTIONS - sind Reihen

```html
<section class="section">
  <div class="container">
    <h1 class="title">Section</h1>
    <h2 class="subtitle">
      A simple container to divide your page into <strong>sections</strong>, like the one you're currently reading
    </h2>
  </div>
</section>
```

[^Top](#Bulma)

## 04 - COLUMNS - sind Spalten

!!! warning Achtung
    Framework hat ist ein **12 Spalten** System !

!!! info 
    Bei gap Angaben muss `is-variable is-4` angegeben werden !!! `is-3` ist Standard und muss nicht angegeben werden.

```html
<div class="columns is-variable is-3">
  <div class="column">
    <p class="notification is-danger">
      Column One
    </p>
  </div>
  <div class="column">
    <p class="notification is-primary">
      Column Two
    </p>
  </div>
  <div class="column">
    <p class="notification is-primary">
      Column Two
    </p>
  </div>
  <div class="column">
    <p class="notification is-info">
      Column Four
    </p>
  </div>
</div>
```

[^Top](#Bulma)

## 05 - LEVELS - Ausrichtung innerhalb Sections

!!! danger ""
    Wenn die Ausrichtung bei Mobiltelefonen auch bleiben soll, dann die `is-mobile` Class zu `level` hinzufügen!

### Aufteilung links und rechts

```html
<nav class="level">
  <!-- Left side -->
  <div class="level-left">
    <div class="level-item">
      <p class="subtitle is-5">
        <strong>123</strong> posts
      </p>
    </div>
    <div class="level-item">
      <div class="field has-addons">
        <p class="control">
          <input class="input" type="text" placeholder="Find a post">
        </p>
        <p class="control">
          <button class="button">
            Search
          </button>
        </p>
      </div>
    </div>
  </div>

  <!-- Right side -->
  <div class="level-right">
    <p class="level-item"><strong>All</strong></p>
    <p class="level-item"><a>Published</a></p>
    <p class="level-item"><a>Drafts</a></p>
    <p class="level-item"><a>Deleted</a></p>
    <p class="level-item"><a class="button is-success">New</a></p>
  </div>
</nav>
```

### Aufteilung auf Containerbreite

```html
<nav class="level">
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Tweets</p>
      <p class="title">3,456</p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Following</p>
      <p class="title">123</p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Followers</p>
      <p class="title">456K</p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Likes</p>
      <p class="title">789</p>
    </div>
  </div>
</nav>
```

[^Top](#Bulma)

## 06 - TILES - der Metro Style

!!! danger ""
    Startet immer von der Linken Seite und dann von oben nach unten

!!! warning ""
    Is tricky !!!

[^Top](#Bulma)

## 10 - Form

!!! warning ""
    Bei Datei Upload muss ein Script zur Dateiüberprüfung und zum eintragen des Dateinamens in das Formular eingefügt werden

!!! info ""
    `this.files[0].name` kann auch durch einen statischen Text ausgetauscht werden. z.B. `'1 Datei ausgewählt!'`. <br>
    ACHTUNG! Einfache Anführungszeichen nicht vergessen!

```html
<label class="label" for="datei1">Datei 1</label>
<div class="file">
  <label class="file-label">
    <input class="file-input" type="file" name="datei1"
      onchange="if (this.files.length > 0) document.getElementById('filename-filebutton-1').innerHTML = this.files[0].name;">
    <span class="file-cta">
      <span class="file-icon">
        <i class="fa fa-upload"></i>
      </span>
      <span class="file-label" id="filename-filebutton-1">
        Choose a file…
      </span>
    </span>
  </label>
</div>
```

[^Top](#Bulma)

## 12 - Ende der Seite mit -> FOOTER

```html
<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
      <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
      is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
    </p>
  </div>
</footer>
```

[^Top](#Bulma)

## Überschrift

[^Top](#Bulma)