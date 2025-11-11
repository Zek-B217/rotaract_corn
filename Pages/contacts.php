<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Dati dal form
    $nome = htmlspecialchars(trim($_POST["nome"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $messaggio = htmlspecialchars(trim($_POST["messaggio"]));

    // Configurazione email
    $to = "rac.trento@rotaract2060.it";
    $subject = "Nuovo messaggio dal sito Rotaract Club Trento";
    $body = "Hai ricevuto un nuovo messaggio dal form contatti del sito Rotaract Club Trento.\n\n" .
            "Nome: $nome\n" .
            "Email personale: $email\n\n" .
            "Messaggio:\n$messaggio\n";

    $headers = "From: Rotaract Club Trento <rac.trento@rotaract2060.it>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Invio email
    $inviata = mail($to, $subject, $body, $headers);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contatti - Rotaract Club Trento</title>
  <link rel="stylesheet" href="../CSS/mainStyle.css">
</head>
<body>
    <div id="obscurer"></div>
    
    <div id="lateralSelection">
        <button id="exitBtn" onclick="hideLateralSelection()">X</button>

        <div id="lateralBtns">
            <a href="../index.html"><button>Home</button></a>
            <a href="whoWeAre.html"><button>Chi siamo</button></a>
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
            <a href="whoWeAre.html"><button>Chi siamo</button></a>
            <a href="service.html"><button>Service</button></a>
            <a href="calendar.html"><button>Eventi</button></a>
            <a href="collaborations.html"><button>Collaborazioni</button></a>
            <a href="contacts.php"><button>Contatti</button></a> 
        </div>

        <!--Menù a linee responsive-->
        <div id="hamburgerMenu" onclick="showLateralSelection()">
            <div class="linea"></div>
            <div class="linea"></div>
            <div class="linea"></div>
            <!--Vecchia versione con menù a tendina
            <div class="dropdownMenu">
                <div class="dropdownContent">
                    <a href="index.html"><button>Home</button></a>
                    <a href="Pages/whoWeAre.html"><button>Chi siamo</button></a>
                    <a href="Pages/service.html"><button>Service</button></a>
                    <a href="Pages/calendar.html"><button>Eventi</button></a>
                    <a href="Pages/collaborations.html"><button>Collaborazioni</button></a>
                    <a href="Pages/contacts.php"><button>Contatti</button></a> 
                </div>
            </div>-->
        </div>
    </div>

    <div id="content">
        <div id="contactForm">
          <h2 id="formTitle">Scrivi in questo form per contattarci</h2>

          <!-- Messaggio di conferma -->
          <?php if (isset($inviata)): ?>
            <div class="messageBox">
              <?php if ($inviata): ?>
                <p class="messageSuccess"><strong>✅ Messaggio inviato con successo!</strong><br>Ti risponderemo al più presto.</p>
              <?php else: ?>
                <p class="messageError"><strong>❌ Errore durante l'invio.</strong><br>Riprova più tardi o scrivi a <a href="mailto:rac.trento@rotaract2060.it">rac.trento@rotaract2060.it</a>.</p>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <!-- Social e Email -->
          <div id="contactInfo">
            <a class="contactItem" href="https://www.instagram.com/rotaractclubtrento/" target="_blank">
              <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram logo">
              @rotaractclubtrento
            </a>

            <a class="contactItem" href="https://www.facebook.com/RotaractClubTrento" target="_blank">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook logo">
              Rotaract Club Trento
            </a>

            <a class="contactItem" href="mailto:rac.trento@rotaract2060.it">
              <svg xmlns="http://www.w3.org/2000/svg" fill="#e64b7d" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.89 2 1.99 2H20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
              rac.trento@rotaract2060.it
            </a>
          </div>

          <!-- Form -->
          <form method="POST" action="">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Scrivi il tuo nome" required>

            <label for="email">Email personale</label>
            <input type="email" id="email" name="email" placeholder="Scrivi il tuo indirizzo email" required>

            <label for="messaggio">Messaggio</label>
            <textarea id="messaggio" name="messaggio" placeholder="Scrivi qualcosa su di te in questo spazio. Ti risponderemo al più presto!" required></textarea>

            <button type="submit">INVIA</button>
          </form>
        </div>
    </div>

    <div id="footer">
        <div id="footerContent">
            <div id="registeredOffice">
                <h4>Sede legale:</h4>
                <p>Piazza Dante 20, 38122 Trento (TN)</p>
            </div>

            <div id="externalPages">
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
