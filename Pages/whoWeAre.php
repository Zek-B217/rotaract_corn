<?php
    require "../PHP/constants.php";
    require "../PHP/functions.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["lang"])){
            setLanguage($_POST["lang"]);
        }
        header("Refresh:0");
        exit;
    }

    $textsFileName = setLanguage();
    $texts = loadTexts("../$textsFileName");
    $langImg = "../".getLanguageImage($textsFileName);

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
    <title><?php echo $texts[$TXT_WHO_WE_ARE]; ?></title>
    <link rel="stylesheet" href="../CSS/commonStyle.css">
    <link rel="stylesheet" href="../CSS/whoWeAreStyle.css">
</head>
<body>
    <div id="obscurer"></div>
    
    <div id="lateralSelection">
        <button id="exitBtn" onclick="hideLateralSelection()">X</button>

        <div id="lateralBtns">
            <a href="../index.php"><button><?php echo $texts[$TXT_HOME]; ?></button></a>
            <a href="whoWeAre.php"><button><?php echo $texts[$TXT_WHO_WE_ARE]; ?></button></a>
            <a href="service.php"><button><?php echo $texts[$TXT_SERVICE]; ?></button></a>
            <a href="calendar.php"><button><?php echo $texts[$TXT_EVENTS]; ?></button></a>
            <a href="collaborations.php"><button><?php echo $texts[$TXT_COLLAB]; ?></button></a>
            <a href="contacts.php"><button><?php echo $texts[$TXT_CONTACTS]; ?></button></a> 
        </div>
    </div>
    

    <div id="header">
        <a class="logoContainer" href="../index.php"><img class="logo" src="../Media/logo.png"></a>

        <div class="dropdownBox">
            <div class="hoverDropdownBox">
                <img id="langImg" class="dropdownImg" src="<?php echo $langImg;?>">
                <div class="dropdownContent">
                    <form action="" method="POST">
                        <input type="submit" name="lang" value="<?php echo $ITALIAN;?>" class="btn"></input>
                        <input type="submit" name="lang" value="<?php echo $ENGLISH;?>" class="btn"></input>
                        <input type="submit" name="lang" value="<?php echo $GERMAN;?>" class="btn"></input>
                    </form>
                </div>
            </div>
        </div>

        <div id="buttons">
            <a href="../index.php"><button><?php echo $texts[$TXT_HOME]; ?></button></a>
            <a href="whoWeAre.php"><button><?php echo $texts[$TXT_WHO_WE_ARE]; ?></button></a>
            <a href="service.php"><button><?php echo $texts[$TXT_SERVICE]; ?></button></a>
            <a href="calendar.php"><button><?php echo $texts[$TXT_EVENTS]; ?></button></a>
            <a href="collaborations.php"><button><?php echo $texts[$TXT_COLLAB]; ?></button></a>
            <a href="contacts.php"><button><?php echo $texts[$TXT_CONTACTS]; ?></button></a> 
        </div>

        <div id="menuHamburger" onclick="showLateralSelection()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>

    <div id="content">
        <h1 class="mainTitle"><?php echo $texts[$TXT_WHO_WE_ARE]; ?></h1>
        <div class="contDiv">
            <h2 class="subtitle"><?php echo $texts[$TXT_ACTUAL]; ?></h2>
            <div class="container">
                <div class="leftRow">
                    <p><span class="role"><?php echo $texts[$TXT_PRES]; ?></span><span><?php echo $directors["pres"];  ?></span></p>
                    <p><span class="role"><?php echo $texts[$TXT_VPRES]; ?></span><span><?php echo $directors["vpres"];  ?></span></p>
                    <p><span class="role"><?php echo $texts[$TXT_SEGR]; ?></span><span><?php echo $directors["segr"];  ?></span></p>
                </div>
                    
                <div>
                    <p><span class="role"><?php echo $texts[$TXT_TES]; ?></span><span><?php echo $directors["tes"];  ?></span></p>
                    <p><span class="role"><?php echo $texts[$TXT_PREF]; ?></span><span ><?php echo $directors["pref"];  ?></span></p>
                    <p><span class="role"><?php echo $texts[$TXT_EXPRES]; ?></span><span><?php echo $directors["expres"];  ?></span></p>
                </div>
            </div>
        </div>
        
        <br>

        <div class="contDiv">
            <h2 class="subtitle"><?php echo $texts[$TXT_EXPRESS]; ?></h2>
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
                <h4><?php echo $texts[$TXT_LEGAL_RES]; ?></h4>
                <p><?php echo $texts[$TXT_ADDRESS]; ?></p>
            </div>

            <div id="externalWebsites">
                <div>
                    <h4><?php echo $texts[$TXT_DISTRICT]; ?></h4>
                    <p><a href="https://www.rotaract2060.it/">https://www.rotaract2060.it/</a></p>
                </div>

                <div>
                    <h4><?php echo $texts[$TXT_ROTARY_TRENTO]; ?></h4>
                    <p><a href="https://trento.rotary2060.org/">https://trento.rotary2060.org/</a></p>
                </div>
            </div>
            <a class="logoContainer" href="../index.php"><img class="logo" src="../Media/logo.png"></a>
        </div>
    </div>

    <script src="../JS/lateralSelection.js"></script>
</body>
</html>