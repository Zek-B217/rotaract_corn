<?php

$exPresidents= ["Alessandro Condini",
    "Alessandro Condini",
    "Annarosa Molinari",
    "Paola Matassoni",
    "Giorgio Bertoldi",
    "Giorgio Bertoldi",
    "Edoardo De Abbondi",
    "Vittorio Dusini",
    "Claudia Eccher",
    "Marco Franzinelli",
    "Claudia Eccher",
    "Giovanna Orlando",
    "Sonia Petteni",
    "Vittorio Cristanelli",
    "Riccardo Sampaolesi",
    "Alessia De Abbondi",
    "Lavinia Sartori",
    "Francesca Jerace",
    "Guglielmo Reina",
    "Maria Emanuela De Abbondi",
    "Sara Filippi",
    "Fabiola Jezza",
    "Alessandro Pallaoro",
    "Claire Albano",
    "Arianna Bertagnolli",
    "Thomas Zobele",
    "Andrea Codroico",
    "Stefano Lorenzini",
    "Biagio Andrea Algieri",
    "Davide H. Ciminelli",
    "Oscar Pallaoro",
    "Costance Giovannini",
    "Annalisa De Pretis",
    "Elisabetta Toller",
    "Federica Berlanda",
    "Jessica De Ponto",
    "Elisabetta Tomasi",
    "Lucia del Torre",
    "Daniele Di Lucrezia"
];

$exPresidentsDates= [
    "(1985-1986)",
    "(1986-1987)",
    "(1987-1988)",
    "(1988-1989)",
    "(1989-1990)",
    "(1990-1991)",
    "(1991-1992)",
    "(1992-1993)",
    "(1993-1994)",
    "(1994-1995)",
    "(1995-1996)",
    "(1996-1997)",
    "(1997-1998)",
    "(1998-1999)",
    "(1999-2000)",
    "(2000-2001)",
    "(2001-2002)",
    "(2002-2003)",
    "(2003-2004)",
    "(2004-2005)",
    "(2005-2006)",
    "(2006-2007)",
    "(2007-2008)",
    "(2008-2009)",
    "(2009-2010)",
    "(2010-2011)",
    "(2011-2012)",
    "(2012-2013)",
    "(2014-2015)",
    "(2015-2016)",
    "(2016-2017)",
    "(2017-2018)",
    "(2018-2019)",
    "(2019-2020)",
    "(2020-2021)",
    "(2021-2022)",
    "(2022-2023)",
    "(2023-2024)",
    "(2024-2025)"
];
$lenght = count($exPresidents);
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
<body>
    <div id="obscurer"></div>
    
    <div id="lateralSelection">
        <button id="exitBtn" onclick="hideLateralSelection()">X</button>

        <div id="lateralBtns">
            <a href="../index.html"><button>Home</button></a>
            <a href="whoWeAre.php"><button data-i18n="whoWeAre">Chi siamo</button></a>
            <a href="service.html"><button>Service</button></a>
            <a href="calendar.html"><button data-i18n="events">Eventi</button></a>
            <a href="collaborations.html"><button data-i18n="collab">Collaborazioni</button></a>
            <a href="contacts.php"><button data-i18n="contacts">Contatti</button></a> 
        </div>
    </div>
    

    <div id="header">
        <a class="logoContainer" href="../index.html"><img class="logo" src="../Media/logo.png"></a>

        <div id="buttons">
            <a href="../index.html"><button>Home</button></a>
            <a href="whoWeAre.php"><button data-i18n="whoWeAre">Chi siamo</button></a>
            <a href="service.html"><button>Service</button></a>
            <a href="calendar.html"><button data-i18n="events">Eventi</button></a>
            <a href="collaborations.html"><button data-i18n="collab">Collaborazioni</button></a>
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
        <h1 class="title" data-i18n="whoWeAre">Chi siamo</h1>
        <div>
            <h2 class="subtitle" data-i18n="actual">Attuale Consiglio Direttivo</h2>
            <div class="container">
                <div class="leftRow">
                    <p><span class="role" data-i18n="pres">Presidente: </span><span>Matteo Bellè</span></p>
                    <p><span class="role" data-i18n="vpres">Vicepresidente: </span><span>Diletta Betti</span></p>
                    <p><span class="role" data-i18n="segr">Segretario:  </span><span>Elisabetta Tomasi</span></p>
                </div>
                    
                <div>
                    <p><span class="role" data-i18n="tes">Tesoriere: </span><span>Matteo Manara</span></p>
                    <p><span class="role" data-i18n="pref">Prefetto: </span><span >Alessandra Cassaro</span></p>
                    <p><span class="role" data-i18n="expres">Ex-presidente: </span><span>Daniele Di Lucrezia</span></p>
                </div>
            </div>
        </div>
        
        <br>

        <div>
            <h2 class="subtitle" data-i18n="express">Ex-presidenti</h2>
            <div>
            <?php
                for($i=0; $i<$lenght;){
                    ?>
                    <div class="container">
                    <?php
                    $j=0;
                    while( $j<4 && $i<$lenght ){
                        ?>
                        <div class="presidentContent">
                            <h3><?php
                            echo $exPresidents[$i];
                            ?></h3><br> <p><?php
                            echo $exPresidentsDates[$i];
                            ?></p> <br>
                        </div>
                        <?php
                        $i++;
                        $j++;
                    };

                    ?>
                </div>
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
            <a class="logoContainer" href="../index.html"><img class="logo" src="../Media/logo.png"></a>
        </div>
    </div>

    <script src="../JS/lateralSelection.js"></script>
</body>
</html>
