<?php

    // EASY DOC CONFIGURATION
    define("SYSTEMFOLDER", "sys.fd");
    define("STATICFOLDER", "static");
    define("DOCFOLDER", "doc");
    define("CLASSFOLER", SYSTEMFOLDER.DIRECTORY_SEPARATOR."class");

    require_once SYSTEMFOLDER.DIRECTORY_SEPARATOR."kernel.php";
    require_once "config.php";


    // DATABASE CONNECTION
    require_once  CLASSFOLER.DIRECTORY_SEPARATOR."db_conn.php";
    $db_conn = new db_conn($databaseHostserv, $databaseDBName, $databaseUsername, $databasePassword);


    // FILES AND VIEWS REGISTRATION
    require_once DOCFOLDER.DIRECTORY_SEPARATOR."views.php";
    require_once STATICFOLDER.DIRECTORY_SEPARATOR."files.php";


    // HTTP QUERY TREATMENT
    $uri = parse_url("root".$_SERVER["REQUEST_URI"]);

    $requestedUri = explode("/", $uri["path"]);

    if ($requestedUri[1] == "doc") {

        echo "welcome on the doc";

    } elseif ($requestedUri[1] == "static") {

        if (isset($static["data"][$requestedUri[2]])) {
            $file = "static/".$static["data"][$requestedUri[2]];
            if (file_exists($file)) {
                header('Content-Type: '.$ctype);

                readfile($file);

                exit;
            }

        }
        if (isset($_GET["img"])) {

            header("Content-type: image/png");
            $stringa = "image error 404";
            $im     = imagecreatetruecolor(150, 30);
            $orange = imagecolorallocate($im, 220, 0, 0);
            $px     = (imagesx($im) - 7.5 * strlen($stringa)) / 2;
            imagestring($im, 3, $px, 3, $stringa, $orange);

            $stringb = "image not found";
            $orange = imagecolorallocate($im, 220, 0, 0);
            $px     = (imagesx($im) - 7.5 * strlen($stringb)) / 2;
            imagestring($im, 3, $px, 15, $stringb, $orange);
            imagepng($im);
            imagedestroy($im);

        } else {

            header("HTTP/1.0 404 Not Found");
            header("Content-Type: text/html");
            echo "Error 404 - The file you try to access is not available<br>\n";
            echo "<a href=\"/\">click here to get back at the root folder.</a>\n";

        }

    } else {

        header("Location: ".DEFAULT_URI);

        phpinfo();

    }