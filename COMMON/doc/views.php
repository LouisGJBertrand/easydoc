<?php

    if (!file_exists("doc".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."views.ini")) {
        file_put_contents("doc".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."views.ini", "[settings]\r\n"."[data]\r\n"."home=home.php");
        echo "generated files.ini file";
    }

    $views = parse_ini_file("doc".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."views.ini", true);