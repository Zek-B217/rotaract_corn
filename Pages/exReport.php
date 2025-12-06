<?php
$folders = '../Media/PDF/';
$elements = scandir($folders);
$elementsPdf = array_diff($elements, array('.', '..'));

$newArray = array();
foreach ($elementsPdf as $pdf) {
    $newArray[] = $pdf;
}
$elementsPdf = $newArray;

$numPdf = count($elementsPdf);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    <link rel="stylesheet" href="../CSS/commonStyle.css">
    <link rel="stylesheet" href="../CSS/whoWeAre&exReportStyle.css">
</head>
<body>
    <div id="obscurer"></div>
    
    <div id="lateralSelection">
        <button id="exitBtn" onclick="hideLateralSelection()">X</button>

        <div id="lateralBtns">
            <a href="../index.html"><button>Home</button></a>
            <a href="whoWeAre.php"><button>Chi siamo</button></a>
            <a href="service.html"><button>Service</button></a>
            <a href="calendar.html"><button>Eventi</button></a>
            <a href="collaborations.html"><button>Collaborazioni</button></a>
            <a href="contacts.php"><button>Contatti</button></a> 
        </div>
    </div>
    

    <div id="header">
        <a class="logoContainer" href="../index.html"><img class="logo" src="../Media/logo.png"></a>

        <div id="buttons">
            <a href="../index.html"><button>Home</button></a>
            <a href="whoWeAre.php"><button>Chi siamo</button></a>
            <a href="service.html"><button>Service</button></a>
            <a href="calendar.html"><button>Eventi</button></a>
            <a href="collaborations.html"><button>Collaborazioni</button></a>
            <a href="contacts.php"><button>Contatti</button></a> 
        </div>

        <!--Menù a linee responsive-->
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
                    <form action="<?php echo "../Media/PDF/" . $elementsPdf[$i-1];?>" method="get">
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
            <a class="logoContainer" href="../index.html"><img class="logo" src="../Media/logo.png"></a>
        </div>
    </div>

    <script src="../JS/lateralSelection.js"></script>
</body>
</html>