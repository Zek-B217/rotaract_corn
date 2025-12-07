<?php
    require "PHP/constants.php";

    session_set_cookie_params(0); //distruggi la sessione all'uscita dal browser
    session_start();
    if (!isset($_SESSION[$IS_LOGGED]) || !$_SESSION[$IS_LOGGED]){
        header("Location: PHP/logout.php"); //Redirigo al logout in maniera da ripulire la sessione
        exit;
    }

    $presidentsJsonContent = json_decode(file_get_contents($PRESIDENTS_FILE), true);
    $presidents = $presidentsJsonContent[$EX_PRESIDENTS];
    $directors = $presidentsJsonContent[$DIRECTORS];
    $numPresidents = sizeof($presidents);
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
                    <p>Attuale Direzione</p><br><br>

                    <div class="role">
                        <p>Presidente:    <?php echo $directors[$ROLE_PRESIDENT]?></p>
                        <div id="presidentBtns">
                            <button>Modifica</button>
                            <button>Cambia presidente</button>
                        </div>
                    </div>

                    <div class="role">
                        <p>Vicepresidente: <?php echo $directors[$ROLE_VICE_PRESIDENT]?></p>
                        <button>Modifica</button>
                    </div>

                    <div class="role">
                        <p>Segretario: <?php echo $directors[$ROLE_SECRETARY]?></p>
                        <button>Modifica</button>
                    </div>

                    <div class="role">
                        <p>Tesoriere: <?php echo $directors[$ROLE_TREASURE]?></p>
                        <button>Modifica</button>
                    </div>

                    <div class="role">
                        <p>Prefetto: <?php echo $directors[$ROLE_PRESIDENT]?></p>
                        <button>Modifica</button>
                    </div>

                    <div class="role">
                        <p>Ex-Presidente: <?php echo $directors[$ROLE_EX_PRESIDENT]?></p>
                        <button>Modifica</button>
                    </div>
                    
                    <br>

                    <p>Ex-Presidenti</p><br><br>
                    <div id="exPresidentsGrid">
                        <?php
                        for ($i = $numPresidents - 1; $i >= 0; $i--){
                            $currentPresident = $presidents[$i];
                            ?>
                        <div>
                            <p><?php echo ($numPresidents - $i) . ". " . $currentPresident[$PRESIDENT_NAME] ?></p>
                            <button>Rimuovi</button>
                        </div>
                            <?php
                        }
                        ?>
                    </div>

                    <button id="addExPresBtn">Aggiungi</button>

                    <br>
                </div>
            </div>
        </div>

        <div class="editableElementContainer">
            <div class="sectionContainer">
                <div class="arrow right"></div>
                <h2>Social</h2>
                <div class="descriptionContainer">
                    <p>Cambia i link alle pagine social e i contatti</p>
                </div>
            </div>

            <div class="modificationContainer">
                <div class="verticalLineContainer">
                    <div class="linePoint"></div>
                    <div class="lineBody"></div>
                </div>
                <div class="editableContent">
                    <p>Ciao</p>
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
                    <p>Ciao</p>
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
                    <p>Ciao</p>
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
                <div class="editableContent">
                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <h2>Home</h2>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <p>Ciao</p>
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <h2>Chi siamo</h2>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <p>Ciao</p>
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <h2>Service</h2>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <p>Ciao</p>
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <h2>Eventi</h2>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <p>Ciao</p>
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <h2>Collaborazioni</h2>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <p>Ciao</p>
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <h2>Contatti</h2>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <p>Ciao</p>
                            </div>
                        </div>
                    </div>

                    <div class="editableElementContainer">
                        <div class="sectionContainer">
                            <div class="arrow right"></div>
                            <h2>Bollettino</h2>
                        </div>

                        <div class="modificationContainer">
                            <div class="verticalLineContainer">
                                <div class="linePoint"></div>
                                <div class="lineBody"></div>
                            </div>
                            <div class="editableContent">
                                <p>Ciao</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <form action="" method="get">
            <button id="passwordBtn" type="submit">Cambia Password</button>
        </form>

        <form action="" method="get">
            <button id="saveBtn" type="submit">Salva</button>
        </form>
    </div>

    <script src="JS/adminSections.js"></script>
</body>
</html>