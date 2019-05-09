<?php

    if (!class_exists("db_conn")) {

        /**
         * undocumented class
         */
        class db_conn
        {

            public function __construct($databaseHostserv, $databaseDBName, $databaseUsername, $databasePassword) {

                define("DB_POSTGRES"    , 1);
                define("DB_DEFAULT"     , DB_POSTGRES);

                $conn = $this->access($databaseHostserv, $databaseDBName, $databaseUsername, $databasePassword, $databaseSoftWare = DB_DEFAULT);
                return $conn;

            }

            public function access($databaseHostserv, $databaseDBName, $databaseUsername = "root", $databasePassword = "", $databaseSoftWare = DB_DEFAULT)
            {

                if ($databaseSoftWare === DB_POSTGRES) {

                    $conn = pg_connect("host=$databaseHostserv port=5432 dbname=$databaseDBName user=$databaseUsername password=$databasePassword");

                    $ping = pg_ping($conn);

                    if ($ping) {

                        $this->pg_TablesIntialisation($conn);

                        return $conn;

                    }

                }

            }

            public function pg_TablesIntialisation($conn)
            {

                $q = "SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' AND schemaname != 'information_schema';";

                $values = pg_query($conn, $q);

                while ($row = pg_fetch_row($values)) {

                    $tablesDeclared[$row[0]] = true;

                }

                if (!isset($tablesDeclared)) {

                    $q = "
                        CREATE TABLE public.easydoc_files
                        (
                            fileid integer NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1 ),
                            filename text COLLATE pg_catalog.\"default\",
                            filepath text COLLATE pg_catalog.\"default\",
                            filesharing text COLLATE pg_catalog.\"default\"
                        );

                        INSERT INTO public.easydoc_files(
                            filename, filepath, filesharing)
                            VALUES ('randomimageShapes', 'img/method_random2.jpg', 'public');

                        INSERT INTO public.easydoc_files(
                            filename, filepath, filesharing)
                            VALUES ('defaultStyle', 'css/style.css', 'public');

                        INSERT INTO public.easydoc_files(
                            filename, filepath, filesharing)
                            VALUES ('homejsfile', 'js/home.js', 'public');

                        CREATE TABLE public.easydoc_views
                        (
                            viewid integer NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1 ),
                            viewname text COLLATE pg_catalog.\"default\",
                            viewpath text COLLATE pg_catalog.\"default\",
                            viewsharing text COLLATE pg_catalog.\"default\",
                            password text COLLATE pg_catalog.\"default\"
                        );

                        INSERT INTO public.easydoc_views(
                            viewname, viewpath, viewsharing, password)
                            VALUES ('home', 'views/home.php', 'public', 'none');
                        ";

                    $values[] = pg_query($conn, $q);

                } else {

                    if (!isset($tablesDeclared["easydoc_files"])) {

                        $q = "
                        CREATE TABLE public.easydoc_files
                        (
                            fileid integer NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1 ),
                            filename text COLLATE pg_catalog.\"default\",
                            filepath text COLLATE pg_catalog.\"default\",
                            filesharing text COLLATE pg_catalog.\"default\"
                        );

                        INSERT INTO public.easydoc_files(
                            filename, filepath, filesharing)
                            VALUES ('randomimageShapes', 'img/method_random2.jpg', 'public');

                        INSERT INTO public.easydoc_files(
                            filename, filepath, filesharing)
                            VALUES ('defaultStyle', 'css/style.css', 'public');

                        INSERT INTO public.easydoc_files(
                            filename, filepath, filesharing)
                            VALUES ('homejsfile', 'js/home.js', 'public');";

                        $values[] = pg_query($conn, $q);

                    }

                    if (!isset($tablesDeclared["easydoc_views"])) {

                        $q = "
                        CREATE TABLE public.easydoc_views
                        (
                            viewid integer NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1 ),
                            viewname text COLLATE pg_catalog.\"default\",
                            viewpath text COLLATE pg_catalog.\"default\",
                            viewsharing text COLLATE pg_catalog.\"default\",
                            password text COLLATE pg_catalog.\"default\"
                        );

                        INSERT INTO public.easydoc_views(
                            viewname, viewpath, viewsharing, password)
                            VALUES ('home', 'views/home.php', 'public', 'none');
                        ";
                        $values[] = pg_query($conn, $q);

                    }

                }

                exit;

            }

        }

    }