<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_POST["submit"])) {
        require("config.inc.php");
        $stmt = $mysql->prepare("SELECT * FROM user WHERE Mail = :email"); //Username überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count != 0){
            $token = generateRandomString(25);
            $stmt = $mysql->prepare("UPDATE user SET Token = :token WHERE Mail = :email");
            $stmt->bindParam(":token", $token);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            mail($_POST["email"], "Passwort zurücksetzen", "http://localhost/inc/setpassword.php?token=".$token);
            echo "Die Email wurde versendet";
        } else {
            echo "Diese Email ist nicht angemeldet";
        }
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    ?>
    <h1>Passwort vergessen?</h1>
    <form action="passwordreset.php" method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit" name="submit">Zurücksetzen</button>
    </form>
</body>

</html>