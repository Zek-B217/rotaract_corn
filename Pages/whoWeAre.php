<?php

$exPresidenti= ["Alessandro Condini (1985-1986)",
    "Alessandro Condini (1986-1987)",
    "Annarosa Molinari (1987-1988)",
    "Paola Matassoni (1988-1989)",
    "Giorgio Bertoldi (1989-1990)",
    "Giorgio Bertoldi (1990-1991)",
    "Edoardo De Abbondi (1991 - 1992)",
    "Vittorio Dusini (1992-1993)",
    "Claudia Eccher (1993-1994)",
    "Marco Franzinelli (1994-1995)",
    "Claudia Eccher (1995-1996)",
    "Giovanna Orlando (1996-1997)",
    "Sonia Petteni (1997-1998)",
    "Vittorio Cristanelli (1998-1999)",
    "Riccardo Sampaolesi (1999-2000)",
    "Alessia De Abbondi (2000-2001)",
    "Lavinia Sartori (2001-2002)",
    "Francesca Jerace (2002-2003)",
    "Guglielmo Reina (2003-2004)",
    "Maria Emanuela De Abbondi (2004-2005)",
    "Sara Filippi (2005-2006)",
    "Fabiola Jezza (2006-2007)",
    "Alessandro Pallaoro (2007-2008)",
    "Claire Albano (2008-2009)",
    "Arianna Bertagnolli (2009-2010)",
    "Thomas Zobele (2010-2011)",
    "Andrea Codroico (2011-2012)",
    "Stefano Lorenzini (2012-2013)",
    "Biagio Andrea Algieri (2014-2015)",
    "Davide H. Ciminelli (2015-2016)",
    "Oscar Pallaoro (2016-2017)",
    "Costance Giovannini (2017-2018)",
    "Annalisa De Pretis (2018-2019)",
    "Elisabetta Toller (2019-2020)",
    "Federica Berlanda (2020-2021)",
    "Jessica De Ponto (2021-2022)",
    "Elisabetta Tomasi (2022-2023)",
    "Lucia del Torre (2023-2024)",
    "Daniele Di Lucrezia (2024-2025)",
    "Matteo Bellè (2025-2026)"
];
$lunghezza = count($exPresidenti);
$lengAsse = $lunghezza/2;
$extra = false;
if($lunghezza % 1 != 0){
    $lengAsse=$lengAsse-0.5;
    $extra= true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
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
            <div class="container">
                <div class="leftRow">
                    <?php
                        for ($i=0; $i < $lengAsse; $i++) { 
                            
                            echo $exPresidenti[$i];
                            ?><br><?php
                        };
                        if($extra){
                            echo $exPresidenti[$lengAsse+1];
                            ?><br><?php
                        };
                    ?>

                </div>
                <div>
                    <?php
                        for ($i=0; $i < $lengAsse; $i++) { 
                            echo $exPresidenti[$i+$lunghezza-$lengAsse];
                            ?><br><?php
                        }
                    ?>
                </div>
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
