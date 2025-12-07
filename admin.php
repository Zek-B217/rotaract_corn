<?php
    require "PHP/constants.php";
    require "PHP/functions.php";

    /*INPUT KEYS*/
    $IN_HOME_IMG = "homeImg";
    $IN_CAROUSEL_IMG = "carouselImg";
    $IN_SELECTED_PDF = "selectedPdf"; 
    $IN_RENAME_PDF = "renamePdf";
    $IN_DELETE_PDF = "deletePdf";
    $IN_PDF_INDEX = "pdfIndex";
    $IN_ADD_PDF = "newPdf";

    $INPUT_TYPE = "action";
    /*=====*/

    session_set_cookie_params(0); //distruggi la sessione all'uscita dal browser
    session_start();
    if (!isset($_SESSION[$IS_LOGGED]) || !$_SESSION[$IS_LOGGED]){
        header("Location: PHP/logout.php"); //Redirigo al logout in maniera da ripulire la sessione
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        var_dump($_POST);
        echo "<br><br>";
        var_dump($_FILES);
        echo "<br><br>";

        if (isset($_POST[$INPUT_TYPE])){
            switch ($_POST[$INPUT_TYPE]) {
                case $IN_HOME_IMG:
                    echo "HOME IMAGE";
                    break;
                case $IN_CAROUSEL_IMG:
                    echo "CAROSELLO";
                    break;
                case $IN_RENAME_PDF:
                    echo "RENAME " . $_POST[$IN_PDF_INDEX];
                    break;
                case $IN_DELETE_PDF:
                    echo "REMOVE " . $_POST[$IN_PDF_INDEX];
                    break;
                case $IN_ADD_PDF:
                    echo "ADD PDF";
                    break;
                case $IN_SELECTED_PDF:
                    echo "SELEZIONATO PDF " . (int)$_POST[$IN_PDF_INDEX] - 1;
                    break;
            }
        }
        /*header("Refresh:0");
        exit;*/
    }


    $configJson = json_decode(file_get_contents("$CONFIG_FILE"), true);

    //Img
    $homeImg = $configJson[$HOME_IMAGE];

    $carouselImages = $configJson[$CAROUSEL_IMAGES];
    $carouselLength = sizeof($carouselImages);

    //Presidents
    $presidentsJsonContent = json_decode(file_get_contents($PRESIDENTS_FILE), true);
    $presidents = $presidentsJsonContent[$EX_PRESIDENTS];
    $directorNames = $presidentsJsonContent[$DIRECTORS];
    $numPresidents = sizeof($presidents);

    $DIR_ROLE = "role";
    $DIR_NAME = "name";
    $directors = [
        [
            $DIR_ROLE => "Vicepresidente",
            $DIR_NAME => $directorNames[$ROLE_VICE_PRESIDENT]
        ],
        [
            $DIR_ROLE => "Segretario",
            $DIR_NAME => $directorNames[$ROLE_SECRETARY]
        ],
        [
            $DIR_ROLE => "Tesoriere",
            $DIR_NAME => $directorNames[$ROLE_SECRETARY]
        ],
        [
            $DIR_ROLE => "Prefetto",
            $DIR_NAME => $directorNames[$ROLE_PREFECT]
        ],
        [
            $DIR_ROLE => "Ex-Presidente",
            $DIR_NAME => $directorNames[$ROLE_EX_PRESIDENT]
        ],
    ];

    //PDF
    $bulletinPdfs = filterPdf(scandir($PDF_BULLETIN_FOLDER));
    $selectedBulletin = $configJson[$CURRENT_BULLETIN];
    $validBulletin = true;
    if (!is_file("$PDF_BULLETIN_FOLDER/" . $selectedBulletin)){
        $selectedBulletin = "Nessun bollettino selezionato";
        $validBulletin = false;
    }

    //Collaborations
    $collaborations = json_decode(file_get_contents($COLLABORATIONS_FILE), true)[$COLLABORATIONS];

    //Texts
    $texts = [
        "it" => loadTexts($IT_TEXTS_FILE),
        "en" => loadTexts($EN_TEXTS_FILE),
        "de" => loadTexts($DE_TEXTS_FILE)
    ];
    $italianTexts = $texts["it"];
    $commonKeys = [
        $TXT_HOME,
        $TXT_WHO_WE_ARE,
        $TXT_SERVICE,
        $TXT_EVENTS,
        $TXT_COLLAB,
        $TXT_CONTACTS,
        $TXT_LEGAL_RES,
        $TXT_ADDRESS,
        $TXT_DISTRICT,
        $TXT_ROTARY_TRENTO
    ];

    $PAGE_KEYS = "keys";
    $PAGE_NAME = "name";
    $pages = [
        [
            $PAGE_NAME => "In comune (Header e Footer)",
            $PAGE_KEYS => $commonKeys
        ],
        [
            $PAGE_NAME => $italianTexts[$TXT_HOME],
            $PAGE_KEYS => getTextKeysFromPage("index.php", $commonKeys)
        ],
        [
            $PAGE_NAME => $italianTexts[$TXT_WHO_WE_ARE],
            $PAGE_KEYS => getTextKeysFromPage("Pages/whoWeAre.php", $commonKeys)
        ],
        [
            $PAGE_NAME => $italianTexts[$TXT_SERVICE],
            $PAGE_KEYS => getTextKeysFromPage("Pages/service.php", $commonKeys)
        ],
        [
            $PAGE_NAME => $italianTexts[$TXT_COLLAB],
            $PAGE_KEYS => getTextKeysFromPage("Pages/collaborations.php", $commonKeys)
        ],
        [
            $PAGE_NAME => $italianTexts[$TXT_CONTACTS],
            $PAGE_KEYS => getTextKeysFromPage("Pages/contacts.php", $commonKeys)
        ],
        [
            $PAGE_NAME => $italianTexts[$TXT_EX_TITLE],
            $PAGE_KEYS => getTextKeysFromPage("Pages/exreport.php", $commonKeys)
        ]
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <link rel="stylesheet" href="CSS/adminStyle.css">
    <link rel="stylesheet" href="CSS/commonStyle.css">
</head>
<body>
    <div id="header">
        <a class="logoContainer" href="index.html"><img class="logo" src="Media/logo.png"></a>

        <h1 id="title">GESTIONE PAGINE</h1>

        <div id="buttons">
            <form action="PHP/logout.php" method="get">
                <button type="button" id="logoutBtn" type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div id="mainContent">
        <!--DIREZIONE-->
        <div class="editableElementContainer">
            <div class="sectionContainer">
                <div class="arrow right"></div>
                <h2>Consiglio Direttivo</h2>
                <div class="descriptionContainer">
                    <p>Modifica il consigio direttivo o lo storico dei presidenti</p>
                </div>
            </div>

            <div class="modificationContainer">
                <div class="verticalLineContainer">
                    <div class="linePoint"></div>
                    <div class="lineBody"></div>
                </div>
                <form action="" method="post" class="editableContent">
                    <br>
                    <p><span>Attuale Direzione</span></p>
                    <br>
                    <br>

                    <div class="role">
                        <p><span>Presidente: </span><?php echo $directorNames[$ROLE_PRESIDENT]?></p>
                        <div id="presidentBtns">
                            <button type="button">Modifica</button>
                            <button type="button">Cambia presidente</button>
                        </div>
                    </div>

                    <?php foreach ($directors as $director) {
                        ?>
                            <div class="role">
                                <p><span><?php echo $director[$DIR_ROLE].": "; ?></span><?php echo $director[$DIR_NAME]?></p>
                                <button type="button">Modifica</button>
                            </div>
                        <?php
                        }
                    ?>
                    
                    <br>
                    <p><span>Ex-Presidenti</span></p>
                    <br>
                    <br>

                    <div class="grid">
                        <?php
                        for ($i = $numPresidents - 1; $i >= 0; $i--){
                            $currentPresident = $presidents[$i];
                            ?>
                        <div>
                            <p><?php echo "<span>".($numPresidents - $i) . ".</span> " . $currentPresident[$PRESIDENT_NAME] ?></p>
                            <button type="button">Rimuovi</button>
                        </div>
                            <?php
                        }
                        ?>
                    </div>

                    <button type="button" class="addBtn">Aggiungi</button>

                    <br>
                </form>
            </div>
        </div>

        <!--BOLLETTINI-->
        <div class="editableElementContainer">
            <div class="sectionContainer">
                <div class="arrow right"></div>
                <h2>Bollettino</h2>
                <div class="descriptionContainer">
                    <p>Aggiungi/rimuovi il PDF di un bollettino</p>
                </div>
            </div>

            <div class="modificationContainer">
                <div class="verticalLineContainer">
                    <div class="linePoint"></div>
                    <div class="lineBody"></div>
                </div>
                <div class="editableContent">
                    <br>
                    <p><span>Lista bollettini pubblicati</span></p>
                    <br>
                    <br>

                    <form action="" method="post" enctype="multipart/form-data" id="currentBulletinContainer">
                        <p><span>Bollettino attualmente selezionato: </span>
                            <?php if ($validBulletin){
                                ?>
                                <a href="<?php echo "$PDF_BULLETIN_FOLDER/" . $selectedBulletin;?>" target="_blank">
                                <?php
                                }  
                            ?>
                                <?php echo $selectedBulletin;?>
                            <?php if ($validBulletin){
                                ?>
                                </a>
                                <?php
                                }  
                            ?>
                        </p>

                        <div>
                            <label for="pdfNumberSelection">N. Bollettino</label>
                            <input type="number" name="<?php echo $IN_PDF_INDEX;?>" id="pdfNumberSelection" required>
                            <button type="submin" name="<?php echo $INPUT_TYPE;?>" value="<?php echo $IN_SELECTED_PDF;?>" >Cambia</button>
                        </div>
                    </form>

                    <br>

                    <div id="pdfGrid" class="grid">
                        <?php
                        for ($i=0; $i < sizeof($bulletinPdfs); $i++) { 
                            ?>
                            <div>
                                <p><span><?php echo $i + 1 . ". ";?></span>
                                    <a href="<?php echo "$PDF_BULLETIN_FOLDER/" . $bulletinPdfs[$i];?>" target="_blank">
                                        <?php echo $bulletinPdfs[$i];?>
                                    </a>
                                </p>
                                <form action="" method="post">
                                    <input type="hidden" name="<?php echo $IN_PDF_INDEX;?>" value="<?php echo $i;?>">
                                    <button type="submit" name="<?php echo $INPUT_TYPE;?>" value="<?php echo $IN_RENAME_PDF;?>">Rinomina</button>
                                    <button type="submit" name="<?php echo $INPUT_TYPE;?>" value="<?php echo $IN_DELETE_PDF;?>">Rimuovi</button>
                                </form>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <form class="centerForm" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $INPUT_TYPE;?>" value="<?php echo $IN_ADD_PDF;?>">
                        <button type="button" onclick="<?php echo "document.getElementById('inputAddPdf').click()"; ?>" class="addBtn">Aggiungi </button>
                        <input onchange="this.form.submit()" type="file" name="<?php echo $IN_ADD_PDF;?>" id="<?php echo "inputAddPdf";?>">
                    </form>
                    <br>
                </div>
            </div>
        </div>

        <!--COLLABORAZIONI-->
        <div class="editableElementContainer">
            <div class="sectionContainer">
                <div class="arrow right"></div>
                <h2>Collaborazioni</h2>
                <div class="descriptionContainer">
                    <p>Modifica le collaborazioni nella pagina "collaborazioni"</p>
                </div>
            </div>

            <div class="modificationContainer">
                <div class="verticalLineContainer">
                    <div class="linePoint"></div>
                    <div class="lineBody"></div>
                </div>

                <form action="" method="post" class="editableContent">
                    <br>
                    <p><span>Collaborazioni attuali</span></p>
                    <br>
                    <br>

                    <div id="collaborationsContainer">
                        <?php for ($i=0; $i < sizeof($collaborations); $i++) { 
                            ?>
                            <div>
                                <p><span><?php echo $i + 1 . ". ";?></span>
                                    <a href="<?php echo $collaborations[$i][$COLLABORATION_LINK];?>" target="_blank">
                                        <?php echo $collaborations[$i][$COLLABORATION_NAME];?>
                                    </a>
                                </p>
                                <div>
                                    <button type="button">Modifica Nome</button>
                                    <button type="button">Modifica Link</button>
                                    <button type="button">Rimuovi</button>
                                </div>
                            </div>
                            <?php
                            }
                        ?>
                    </div>

                    <button type="button" class="addBtn">Aggiungi</button>
                    <br>
                </form>
            </div>
        </div>

        <!--TESTI E IMMAGINI-->
        <div class="editableElementContainer">
            <div class="sectionContainer">
                <div class="arrow right"></div>
                <h2>Testi e Immagini</h2>
                <div class="descriptionContainer">
                    <p>Modifica i testi o cambia le immagini di tutte le pagine</p>
                </div>
            </div>

            <div class="modificationContainer">
                <div class="verticalLineContainer">
                    <div class="linePoint"></div>
                    <div class="lineBody"></div>
                </div>
                <div id="editablePages" class="editableContent">
                    <br>
                    <p><span>Testi</span></p>
                    <br>
                    <br>

                    <?php foreach ($pages as $page) {
                        ?>
                            <div class="editableElementContainer">
                                <div class="sectionContainer">
                                    <div class="arrow right"></div>
                                    <p><?php echo $page[$PAGE_NAME];?></p>
                                </div>

                                <div class="modificationContainer">
                                    <div class="verticalLineContainer">
                                        <div class="linePoint"></div>
                                        <div class="lineBody"></div>
                                    </div>
                                    <div class="editableContent">
                                        <?php 
                                            $textKeys = $page[$PAGE_KEYS];

                                            foreach ($textKeys as $key) {
                                            ?>
                                                <div class="editableElementContainer ">
                                                    <div class="sectionContainer">
                                                        <div class="arrow right"></div>
                                                        <p><?php echo $italianTexts[$key];?></p>
                                                    </div>

                                                    <div class="modificationContainer">
                                                        <div class="verticalLineContainer">
                                                            <div class="linePoint"></div>
                                                            <div class="lineBody"></div>
                                                        </div>
                                                        <form action="" method="post" class="editableContent">
                                                            <?php foreach ($texts as $language => $languageTexts) {
                                                                ?>
                                                                <div>
                                                                    <p><span><?php echo "$language: ";?></span><?php echo $languageTexts[$key];?></p>
                                                                    <button type="button">Modifica</button>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    ?>

                    <br>
                    <p><span>Immagini Carosello/Home</span></p>
                    <br>
                    <br>

                    <div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $INPUT_TYPE;?>" value="<?php echo $IN_HOME_IMG;?>">
                            <div id="editableHomeImg">
                                <a href="<?php echo "Media/$homeImg";?>" target="_blank"><p>Immagine Home</p></a>
                                <button type="button" onclick="document.getElementById('inputHomeImg').click()">Cambia</button>
                                <input onchange="this.form.submit()" type="file" name="<?php echo $IN_HOME_IMG;?>" id="inputHomeImg">
                            </div><br><br>
                        </form>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $INPUT_TYPE;?>" value="<?php echo $IN_CAROUSEL_IMG;?>">
                            <div id="imgGrid" class="grid">
                                <?php for ($i = 0; $i < $carouselLength; $i++) {
                                    ?>
                                    <div>
                                        <a href="<?php echo "$CAROUSEL_IMAGES_FOLDER/".$carouselImages[$i];?>" target="_blank"><p><?php echo "Carosello " . $i + 1;?></p></a>
                                        <button type="button" onclick="<?php echo "document.getElementById('inputCarouselImg" . $i + 1 . "').click()"; ?>">Cambia</button>
                                        <input onchange="this.form.submit()" type="file" name="<?php echo $IN_CAROUSEL_IMG . $i + 1;?>" id="<?php echo "inputCarouselImg" . $i + 1;?>">
                                    </div>
                                    <?php
                                    }
                                ?>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <form action="Pages/changePassword.php" method="get">
            <button type="button" id="passwordBtn" type="submit">Cambia Password</button>
        </form>

        <form action="" method="get">
            <button type="button" id="saveBtn" type="submit">Salva</button>
        </form>
    </div>

    <script src="JS/adminScript.js"></script>
</body>
</html>