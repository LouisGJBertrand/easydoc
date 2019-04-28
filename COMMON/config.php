<?php

    // we invite you to insert thoose variable in a protected file named "protected.php"
    // and exclude it from the git via .gitignore if you want to publish it on a git.

    $databaseSoftWare   = DB_DEFAULT;
    $databaseHostserv   = "host";
    $databaseDBName     = "dbname";
    $databasePassword   = "password";
    $databaseUsername   = "username";

    if (file_exists("protected.php")) {

        // this file wont be visible in the git.
        // initialise it with the database variable set upward.

        include "protected.php";

    }