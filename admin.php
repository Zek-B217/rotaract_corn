<?php
    require "PHP/constants.php";
    require "PHP/functions.php";

    session_set_cookie_params(0); //distruggi la sessione all'uscita dal browser
    session_start();
    if (!isset($_SESSION[$IS_LOGGED]) || !$_SESSION[$IS_LOGGED]){
        header("Location: PHP/logout.php"); //Redirigo al logout in maniera da ripulire la sessione
        exit;
    }

    //Presidents
    $presidentsJsonContent = json_decode(file_get_contents($PRESIDENTS_FILE), true);
    $presidents = $presidentsJsonContent[$EX_PRESIDENTS];
    $directors = $presidentsJsonContent[$DIRECTORS];
    $numPresidents = sizeof($presidents);

    //PDF
    $bulletinPdfs = filterPdf(scandir($PDF_BULLETIN_FOLDER));
    $selectedBulletin = json_decode(file_get_contents("$CONFIG_FILE"), true)[$CURRENT_BULLETIN];
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
                <button id="logoutBtn" type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div id="mainContent">
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
                <div class="editableContent">
                    <br>
                    <p><span>Attuale Direzione</span></p>
                    <br>
                    <br>

                    <div class="role">
                        <p><span>Presidente: </span><?php echo $directors[$ROLE_PRESIDENT]?></p>
                        <div id="presidentBtns">
                            <button>Modifica</button>
                            <button>Cambia presidente</button>
                        </div>
                    </div>

                    <div class="role">
                        <p><span>Vicepresidente: </span><?php echo $directors[$ROLE_VICE_PRESIDENT]?></p>
                        <button>Modifica</button>
                    </div>

                    <div class="role">
                        <p><span>Segretario: </span><?php echo $directors[$ROLE_SECRETARY]?></p>
                        <button>Modifica</button>
                    </div>

                    <div class="role">
                        <p><span>Tesoriere: </span><?php echo $directors[$ROLE_TREASURE]?></p>
                        <button>Modifica</button>
                    </div>

                    <div class="role">
                        <p><span>Prefetto: </span><?php echo $directors[$ROLE_PRESIDENT]?></p>
                        <button>Modifica</button>
                    </div>

                    <div class="role">
                        <p><span>Ex-Presidente: </span><?php echo $directors[$ROLE_EX_PRESIDENT]?></p>
                        <button>Modifica</button>
                    </div>
                    
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
                            <button>Rimuovi</button>
                        </div>
                            <?php
                        }
                        ?>
                    </div>

                    <button class="addBtn">Aggiungi</button>

                    <br>
                </div>
            </div>
        </div>

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

                    <div id="currentBulletinContainer">
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
                        <button>Cambia</button>
                    </div>

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
                                <div>
                                    <button>Rinomina</button>
                                    <button>Rimuovi</button>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <button class="addBtn">Aggiungi</button>
                    <br>
                </div>
            </div>
        </div>

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

                <div class="editableContent">
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
                                    <button>Modifica Nome</button>
                                    <button>Modifica Link</button>
                                    <button>Rimuovi</button>
                                </div>
                            </div>
                            <?php
                            }
                        ?>
                    </div>

                    <button class="addBtn">Aggiungi</button>
                    <br>
                </div>
            </div>
        </div>

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
                    <p><span>Pagine</span></p>
                    <br>
                    <br>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <p>In comune (Header e Footer)</p>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <?php 
                                    $textKeys = $commonKeys;

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
                                                <div class="editableContent">
                                                    <?php foreach ($texts as $language => $languageTexts) {
                                                        ?>
                                                        <div>
                                                            <p><span><?php echo "$language: ";?></span><?php echo $languageTexts[$key];?></p>
                                                            <button>Modifica</button>
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
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <p><?php echo $italianTexts[$TXT_HOME];?></p>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <?php 
                                    $textKeys = getTextKeysFromPage("index.php", $commonKeys);

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
                                                <div class="editableContent">
                                                    <?php foreach ($texts as $language => $languageTexts) {
                                                        ?>
                                                        <div>
                                                            <p><span><?php echo "$language: ";?></span><?php echo $languageTexts[$key];?></p>
                                                            <button>Modifica</button>
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
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <p><?php echo $italianTexts[$TXT_WHO_WE_ARE];?></p>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <?php 
                                    $textKeys = getTextKeysFromPage("Pages/whoWeAre.php", $commonKeys);

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
                                                <div class="editableContent">
                                                    <?php foreach ($texts as $language => $languageTexts) {
                                                        ?>
                                                        <div>
                                                            <p><span><?php echo "$language: ";?></span><?php echo $languageTexts[$key];?></p>
                                                            <button>Modifica</button>
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
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <p><?php echo $italianTexts[$TXT_SERVICE];?></p>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <?php 
                                    $textKeys = getTextKeysFromPage("Pages/service.php", $commonKeys);

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
                                                <div class="editableContent">
                                                    <?php foreach ($texts as $language => $languageTexts) {
                                                        ?>
                                                        <div>
                                                            <p><span><?php echo "$language: ";?></span><?php echo $languageTexts[$key];?></p>
                                                            <button>Modifica</button>
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
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <p><?php echo $italianTexts[$TXT_COLLAB];?></p>
                        </div>

                       <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <?php 
                                    $textKeys = getTextKeysFromPage("Pages/collaborations.php", $commonKeys);

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
                                                <div class="editableContent">
                                                    <?php foreach ($texts as $language => $languageTexts) {
                                                        ?>
                                                        <div>
                                                            <p><span><?php echo "$language: ";?></span><?php echo $languageTexts[$key];?></p>
                                                            <button>Modifica</button>
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
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <p><?php echo $italianTexts[$TXT_CONTACTS];?></p>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <?php 
                                    $textKeys = getTextKeysFromPage("Pages/contacts.php", $commonKeys);

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
                                                <div class="editableContent">
                                                    <?php foreach ($texts as $language => $languageTexts) {
                                                        ?>
                                                        <div>
                                                            <p><span><?php echo "$language: ";?></span><?php echo $languageTexts[$key];?></p>
                                                            <button>Modifica</button>
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
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <p><?php echo $italianTexts[$TXT_EX_TITLE];?></p>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <?php 
                                    $textKeys = getTextKeysFromPage("Pages/exReport.php", $commonKeys);

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
                                                <div class="editableContent">
                                                    <?php foreach ($texts as $language => $languageTexts) {
                                                        ?>
                                                        <div>
                                                            <p><span><?php echo "$language: ";?></span><?php echo $languageTexts[$key];?></p>
                                                            <button>Modifica</button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <form action="Pages/changePassword.php" method="get">
            <button id="passwordBtn" type="submit">Cambia Password</button>
        </form>

        <form action="" method="get">
            <button id="saveBtn" type="submit">Salva</button>
        </form>
    </div>

    <script src="JS/adminScript.js"></script>
</body>
</html>