# BOOTSTRAP

[[TOC]]

# Bootstrap v5

## Hilfeseiten

| Nr | Bereich  | Link                                                               |
| -- | -------- | ------------------------------------------------------------------ |
| 1  | Homepage | https://v5.getbootstrap.com/                                       |
| 2  | Docs     | https://v5.getbootstrap.com/docs/5.0/getting-started/introduction/ |

## Starter Template

Download
https://v5.getbootstrap.com/docs/5.0/getting-started/download/

```html
<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>

    <!-- Bootstrap Bundle enthält Popper.js -->
    <script src="js/bootstrap.bundle.js"></script>
  </body>
</html>
```

[^Top](#Bootstrapv5)

# Bootstrap v4



## Hilfeseiten

| Nr | Bereich           | Link                                                            |
| -- | ----------------- | --------------------------------------------------------------- |
| 1  | Homepage          | https://getbootstrap.com/                                       |
| 1  | Bootstrap Deutsch | http://holdirbootstrap.de/                                      |
| 2  | Get Started       | https://getbootstrap.com/docs/4.5/getting-started/introduction/ |
| 3  | Navbar            | https://getbootstrap.com/docs/4.5/components/navbar/            |
| 50 | Icons             | https://fontawesome.bootstrapcheatsheets.com/                   |

## Fontawesome include

### Stylesheet

```html
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
```

```html
<i class="fa fa-home"></i>
```

[^Top](#Bootstrap)

## Ausrichtungen

https://getbootstrap.com/docs/4.5/layout/grid/#alignment

### Vertikal

```html
<div class="container">
  <div class="row align-items-start">
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
  </div>
  <div class="row align-items-end">
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
  </div>
</div>
```

### Horizontal

```html
<div class="container">
  <div class="row">
    <div class="col align-self-start">
      One of three columns
    </div>
    <div class="col align-self-center">
      One of three columns
    </div>
    <div class="col align-self-end">
      One of three columns
    </div>
  </div>
</div>
```

[^Top](#Bootstrap)