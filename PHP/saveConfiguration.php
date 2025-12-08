<?php
    require "constants.php";
    require "functions.php";

    session_start();
    $saveParameters = [
        [
            "json" => $_SESSION[$CONFIG_JSON],
            "file" => $CONFIG_FILE
        ],
        [
            "json" => $_SESSION[$COLLAB_JSON],
            "file" => $COLLABORATIONS_FILE
        ],
        [
            "json" => $_SESSION[$PRESIDENTS_JSON],
            "file" => $PRESIDENTS_FILE
        ]
    ];

    foreach ($_SESSION[$TXT_JSON] as $langFile => $content) {
        $saveParameters[] = [
            "json" => $content,
            "file" => $langFile
        ];
    }

    foreach ($saveParameters as $parameters) {
        saveJsonInFile($parameters["json"], "../" . $parameters["file"]);
    }
    header("Location: ../index.php");    
    
    
    
    