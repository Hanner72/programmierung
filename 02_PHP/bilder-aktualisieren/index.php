<!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Bild aktualisieren</title>

    <!-- must have -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.1/jquery.min.js" type="text/javascript"></script>


	<style>
		body {
			margin: 0;
			padding: 0;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#refresh").load("bildurl_einlesen.php");
			var refreshId = setInterval(function() {
				$("#refresh").load('bildurl_einlesen.php?' + 1 * new Date());
			}, 10000);
		});
	</script>

</head>

<body bgcolor="#fff">

<div id="refresh" style="text-align:center;"></div>

<div style="text-align:center;"><br>Bild wird aktualisiert ohne die Seite neu laden zu müssen.<br>Refresh Zeit kann eingestellt werden. Hier 10000 ms = 10 sec.</div>

</body>

</html>