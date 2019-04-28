<?php

    if (!file_exists("static".DIRECTORY_SEPARATOR."files.ini")) {
        file_put_contents("static".DIRECTORY_SEPARATOR."files.ini", "[settings]\r\n"."[data]\r\n".md5("img/method_random2.jpg")."=img/method_random2.jpg");
        echo "generated files.ini file";
    }

    $static = parse_ini_file("static".DIRECTORY_SEPARATOR."files.ini", true);