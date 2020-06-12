<?php
session_start();
if ( !isset( $_SESSION['username'] ) ) {
    header( 'Location: inc/login.php' );
    exit;
}
?>

<!doctype html>
<html lang = 'de'>

<head>
<!-- Required meta tags -->
<meta charset = 'utf-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1, shrink-to-fit=no'>

<!-- Bootstrap CSS -->
<link rel = 'stylesheet' href = 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css'>
<link href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css' rel = 'stylesheet'>
<link href = '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel = 'stylesheet'>

<script src = 'https://code.jquery.com/jquery-3.5.1.min.js'></script>

<link rel = 'stylesheet' href = 'css/sidebar.css'>

<title>Hello, world!</title>
</head>

<body>
<!-- Includes der Menüs -->
<?php require 'header.php';
?>
<?php require 'sidebar_menu.php';
?>

<!-- Seineninhalte -->



<!-- Sidebar Menü Script -->
<script src = 'js/sidebar_menu.js'></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src = 'https://code.jquery.com/jquery-3.5.1.slim.min.js'
integrity = 'sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj'
crossorigin = 'anonymous'></script>
<script src = 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'
integrity = 'sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo'
crossorigin = 'anonymous'></script>
<script src = 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js'
integrity = 'sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI'
crossorigin = 'anonymous'></script>

</body>

</html>