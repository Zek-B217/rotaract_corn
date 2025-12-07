<?php
    $collaborationNames = [
        "Rotary Club Trento",
        "Rotary Club Trentino-Nord",
        "Rotary Club Valsugana",
        "Innerwheel Trento",
        "Innerwheel Trento-Castello"
    ];

    $collaborationLinks = [
        "https://trento.rotary2060.org/",
        "https://trentinonord.rotary2060.org/",
        "https://valsugana.rotary2060.org/index.php",
        "https://www.innerwheel.it/club/iwc0063",
        "https://www.in	nerwheel.it/club/iwc185"
    ];

    $collaborations = array();
    for ($i=0; $i < sizeof($collaborationNames); $i++) { 
        $collaborations[] = ["name" => $collaborationNames[$i], "link" => $collaborationLinks[$i]];
    }

    $json = json_encode(["collaborations" => $collaborations], JSON_PRETTY_PRINT);

    $file = fopen("JSON/collaborations.json", "w");

    fwrite($file,$json);

    fclose($file);

    echo "Fatto";