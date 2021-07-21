<?php
    echo "SERVER_NAME: ".$_SERVER['SERVER_NAME']."<br>";
    echo "SERVER_ADDR: ".$_SERVER['SERVER_ADDR']."<br>";
    echo "DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."<br>";
    echo "HTTP_HOST: ".$_SERVER['HTTP_HOST']."<br>";
    echo "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']."<br>";
    echo "REQUEST_URI: ".$_SERVER['REQUEST_URI']."<br>";
    echo "dirname: ".dirname(__FILE__)."<br>";
    echo "__DIR__: ".__DIR__."<br>";

    echo "/".trim(str_replace(str_replace("\\", "/", $_SERVER["DOCUMENT_ROOT"]), '', str_replace("\\", "/", dirname(__FILE__))), "/<br>");

    $file_array = explode(".", basename($_SERVER['PHP_SELF']));
    echo "FILENAME OHNE ENDUNG: ".$file_array[0]."<br>";
?>