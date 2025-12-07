<?php
require "../PHP/constants.php";
require "../PHP/fileFunctions.php";

$folders = '../Media/PDF/';
$elements = scandir($folders);

$elementsPdf = filterPdf($elements);

$numPdf = count($elementsPdf);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex bollettini</title>
    <link rel="stylesheet" href="../CSS/commonStyle.css">
    <link rel="stylesheet" href="../CSS/whoWeAre&exReportStyle.css">
</head>
<body>
    <div id="obscurer"></div>
    
    <div id="lateralSelection">
        <button id="exitBtn" onclick="hideLateralSelection()">X</button>

        <div id="lateralBtns">
            <a href="../index.php"><button>Home</button></a>
            <a href="whoWeAre.php"><button>Chi siamo</button></a>
            <a href="service.php"><button>Service</button></a>
            <a href="calendar.php"><button>Eventi</button></a>
            <a href="collaborations.php"><button>Collaborazioni</button></a>
            <a href="contacts.php"><button>Contatti</button></a> 
        </div>
    </div>
    

    <div id="header">
        <a class="logoContainer" href="../index.php">
            <img class="logo" src="../Media/logo.png">
        </a>

        <div class="dropdownBox">
            <div class="hoverDropdownBox">
                <img id="langImg" class="dropdownImg" src="../Media/it.png">
                <div class="dropdownContent">
                    <button class="btn" onclick="setLang('it', true)">Italiano</button>
                    <button class="btn" onclick="setLang('en', true)">English</button>
                    <button class="btn" onclick="setLang('de', true)">Deutsch</button>
                </div>
            </div>
        </div>

        <div id="buttons">
            <a href="../index.php"><button>Home</button></a>
            <a href="whoWeAre.php"><button data-i18n="whoWeAre">Chi siamo</button></a>
            <a href="service.php"><button>Service</button></a>
            <a href="calendar.php"><button data-i18n="events">Eventi</button></a>
            <a href="collaborations.php"><button data-i18n="collab">Collaborazioni</button></a>
            <a href="contacts.php"><button data-i18n="contacts">Contatti</button></a>
        </div>

        <!-- MENÙ HAMBURGER -->
        <div id="menuHamburger" onclick="showLateralSelection()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>

    <div id="content">
        <br>
        <h1 class="mainTitle">Vecchi bollettini</h1>
        <?php
        if ($numPdf > 0) {
            for($i=0; $i<$numPdf; $i++)
            {
                ?>
                <div class="container2">
                <?php
                for($j=0; $j<4; $j++){
                    $i++;

                    ?>
                    <form action="<?php echo "../$PDF_BULLETIN_FOLDER/" . $elementsPdf[$i-1];?>" method="get">
                        <button class="reportButtons"><?php echo $elementsPdf[$i-1]?></button>
                    </form>
                    
                    <?php
                    if($numPdf==$i){
                        $j=4;
                    }

                }
                ?>
                </div>
                <?php
            }
            
        } else {
            echo '<p>Nessun bollettino disponibile.</p>';
        }?>
    </div>

    <div id="footer">
        <div id="footerContent">
            <div id="registeredOffice">
                <h4>Sede legale:</h4>
                <p>Piazza Dante 20, 38122 Trento (TN)</p>
            </div>

            <div id="externalWebsites">
                <div>
                    <h4>Distretto 2060</h4>
                    <p><a href="https://www.rotaract2060.it/">https://www.rotaract2060.it/</a></p>
                </div>

                <div>
                    <h4>Rotary Trento</h4>
                    <p><a href="https://trento.rotary2060.org/">https://trento.rotary2060.org/</a></p>
                </div>
            </div>
            <a class="logoContainer" href="../index.php"><img class="logo" src="../Media/logo.png"></a>
        </div>
    </div>

    <script src="../JS/lateralSelection.js"></script>
</body>
</html>