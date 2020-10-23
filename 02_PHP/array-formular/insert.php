<?php
echo '<pre>';
print_r( $_POST );
echo '</pre>';
foreach ($_POST['text'] as $key => $value) echo $key. '</br>';