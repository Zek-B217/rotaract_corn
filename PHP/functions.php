<?php
    function filterPDF($fileArray) {
        $fileArray = array_diff($fileArray, array('.', '..'));

        $newArray = array();
        foreach ($fileArray as $pdf) {
            if (strtolower(pathinfo($pdf, PATHINFO_EXTENSION)) === "pdf"){
                $newArray[] = $pdf;
            }
        }

        return $newArray;
    }

    function loadTexts($filePath){
        return json_decode(file_get_contents("$filePath"),true);
    }

    function setLanguage($lang = null) {
        require "constants.php";

        if (!isset($_COOKIE[$LANGUAGE_COOKIE])){
            $textFileName = $IT_TEXTS_FILE;
        } else if(is_null($lang)){
            $textFileName = $_COOKIE[$LANGUAGE_COOKIE]; //Estendo la durata del cookie
        } else {
            switch ($lang) {
                case $ITALIAN:
                    $textFileName = $IT_TEXTS_FILE;
                    break;
                case $GERMAN:
                    $textFileName = $DE_TEXTS_FILE;
                    break;
                case $ENGLISH:
                    $textFileName = $EN_TEXTS_FILE;
                    break;
                default:
                    $textFileName = $IT_TEXTS_FILE;
                    break;
            }
        }

        setcookie($LANGUAGE_COOKIE, $textFileName, time() + 60*60*24*365, "/","",true, true);

        return $textFileName;
    }

    function getLanguageImage($textName){
        require "constants.php";
        $imageName = "it";
        switch ($textName) {
            case $IT_TEXTS_FILE:
                $imageName = "it";
                break;
            case $DE_TEXTS_FILE:
                $imageName = "de";
                break;
            case $EN_TEXTS_FILE:
                $imageName = "en";
                break;
        }

        return "Media/$imageName.png";
    }