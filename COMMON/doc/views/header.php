<?php

    function EASYDOC_HEADER()
    {

        $objects[] = [

            "type" => "html",
            "html_tag" => "header",
            "html_class" => "header",
            "content" => [

                [

                    "type" => "text",
                    "content" => "hello"

                ],

                [

                    "type" => "html",
                    "html_tag" => "header",
                    "html_class" => "header",
                    "content" => [

                        [

                            "type" => "text",
                            "content" => "hello"

                        ]

                    ]

                ]

            ]

        ];

        return $objects;

    }