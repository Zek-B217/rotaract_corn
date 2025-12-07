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