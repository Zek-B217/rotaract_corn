<?php
    require "../PHP/constants.php";

    $jsonContent = json_decode(file_get_contents("../$PRESIDENTS_FILE"),true);
    $exPresidents = $jsonContent[$EX_PRESIDENTS];
    $lenght = count($exPresidents);

    $directors = $jsonContent[$DIRECTORS];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="whoWeAre">Chi siamo</title>
    <link rel="stylesheet" href="../CSS/commonStyle.css">
    <link rel="stylesheet" href="../CSS/whoWeAreStyle.css">
</head>
<body onload="setLang('', true)">
    <div id="obscurer"></div>
    
    <div id="lateralSelection">
        <button id="exitBtn" onclick="hideLateralSelection()">X</button>

        <div id="lateralBtns">
            <a href="../index.php"><button>Home</button></a>
            <a href="whoWeAre.php"><button data-i18n="whoWeAre">Chi siamo</button></a>
            <a href="service.php"><button>Service</button></a>
            <a href="calendar.php"><button data-i18n="events">Eventi</button></a>
            <a href="collaborations.php"><button data-i18n="collab">Collaborazioni</button></a>
            <a href="contacts.php"><button data-i18n="contacts">Contatti</button></a> 
        </div>
    </div>
    

    <div id="header">
        <a class="logoContainer" href="../index.php"><img class="logo" src="../Media/logo.png"></a>

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

        <!--Menù a linee responsive-->
        <div id="menuHamburger" onclick="showLateralSelection()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>

    <div id="content">
        <h1 class="mainTitle" data-i18n="whoWeAre">Chi siamo</h1>
        <div class="contDiv">
            <h2 class="subtitle" data-i18n="actual">Attuale Consiglio Direttivo</h2>
            <div class="container">
                <div class="leftRow">
                    <p><span class="role" data-i18n="pres">Presidente: </span><span><?php echo $directors["pres"];  ?></span></p>
                    <p><span class="role" data-i18n="vpres">Vicepresidente: </span><span><?php echo $directors["vpres"];  ?></span></p>
                    <p><span class="role" data-i18n="segr">Segretario:  </span><span><?php echo $directors["segr"];  ?></span></p>
                </div>
                    
                <div>
                    <p><span class="role" data-i18n="tes">Tesoriere: </span><span><?php echo $directors["tes"];  ?></span></p>
                    <p><span class="role" data-i18n="pref">Prefetto: </span><span ><?php echo $directors["pref"];  ?></span></p>
                    <p><span class="role" data-i18n="expres">Ex-presidente: </span><span><?php echo $directors["expres"];  ?></span></p>
                </div>
            </div>
        </div>
        
        <br>

        <div class="contDiv">
            <h2 class="subtitle" data-i18n="express">Ex-presidenti</h2>
            <div>
            <?php
                for($i=$lenght-1; $i>=0;){
                    ?>
                    <div class="container2">
                    <?php
                    $j=0;
                    while( $j<4 && $i>=0 ){
                        ?>
                        <div class="presidentContent">
                                <h3><?php
                                echo $exPresidents[$i][$PRESIDENT_NAME];
                            
                                ?></h3>
                                <p class="date"><?php
                                echo $exPresidents[$i][$PRESIDENT_DATE];
                                ?></p>
                            
                        </div>
                        <?php
                        $i--;
                        $j++;
                    };

                    ?>
                </div>
                <br>
                <?php

                
            }



            ?>

            </div>
            
            
            
        </div>   
    </div>

    <div id="footer">
        <div id="footerContent">
            <div id="registeredOffice">
                <h4 data-i18n="legalRes">Sede legale:</h4>
                <p>Piazza Dante 20, 38122 Trento (TN)</p>
            </div>

            <div id="externalWebsites">
                <div>
                    <h4 data-i18n="district">Distretto 2060</h4>
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

    <script src="../JS/translate.js"></script>
    <script src="../JS/lateralSelection.js"></script>
</body>
</html>
