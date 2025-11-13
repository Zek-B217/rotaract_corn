<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = htmlspecialchars(trim($_POST["nome"]));
    $email_utente = htmlspecialchars(trim($_POST["email"]));
    $messaggio = htmlspecialchars(trim($_POST["messaggio"]));

    if (!filter_var($email_utente, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errore'] = "L'indirizzo email non è valido.";
    } elseif (empty($nome) || empty($messaggio)) {
        $_SESSION['errore'] = "Tutti i campi sono obbligatori.";
    } else {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'davide.nicolodi@buonarroti.tn.it';
            $mail->Password = 'njzijqhetydtrdfv';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('davide.nicolodi@buonarroti.tn.it', 'Rotaract Club Trento');
            $mail->addAddress('davide.nicolodi@buonarroti.tn.it');
            $mail->addReplyTo($email_utente, $nome);

            $mail->isHTML(false);
            $mail->Subject = "Messaggio dal sito Rotaract Club Trento";
            $mail->Body = "Nome: $nome\nEmail: $email_utente\n\nMessaggio:\n$messaggio";

            $mail->send();
            $_SESSION['successo'] = "Messaggio inviato con successo!";
        } catch (Exception $e) {
            $_SESSION['errore'] = "Errore invio mail: {$mail->ErrorInfo}";
        }
    }

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contatti - Rotaract Club Trento</title>
  <link rel="stylesheet" href="../CSS/contattiStyle.css">
  <link rel="stylesheet" href="../CSS/commonStyle.css">
</head>
<body>

<div id="header">
        <a class="logoContainer" href="../index.html"><img class="logo" src="../Media/logo.png"></a>

        <div id="buttons">
            <a href="../index.html"><button>Home</button></a>
            <a href="chiSiamo.html"><button>Chi siamo</button></a>
            <a href="service.html"><button>Service</button></a>
            <a href="calendario.html"><button>Eventi</button></a>
            <a href="collaborazioni.html"><button>Collaborazioni</button></a>
            <a href="contatti.php"><button>Contatti</button></a> 
        </div>

        <!--Menù a linee responsive-->
        <div id="menuHamburger">
            <div class="linea"></div>
            <div class="linea"></div>
            <div class="linea"></div>

            <div class="dropdownMenu">
                <div class="dropdownContent">
                    <a href="../index.html"><button>Home</button></a>
                    <a href="chiSiamo.html"><button>Chi siamo</button></a>
                    <a href="service.html"><button>Service</button></a>
                    <a href="calendario.html"><button>Eventi</button></a>
                    <a href="collaborazioni.html"><button>Collaborazioni</button></a>
                    <a href="contatti.php"><button>Contatti</button></a> 
                </div>
            </div>
        </div>
    </div>

    <div id="content">
      <main class="container">

      <!-- 🔹 SEZIONE CONTATTI CLUB -->
      <div class="contact-info">
        <h3>Contatti del Rotaract Club Trento</h3>

        <div class="info-center">
        <div class="info-item">
          <svg class="icon" viewBox="0 0 24 24"><path d="M12 2C8.1 2 5 5.1 5 9c0 5.3 7 13 7 13s7-7.7 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z"/></svg>
          <p>Piazza Dante 20, 38122 Trento (TN)</p>
        </div>

        <div class="social-links">
          <a href="https://www.facebook.com/RotaractClubTrento" target="_blank" class="social-btn facebook">
            <svg viewBox="0 0 24 24"><path d="M22 12a10 10 0 1 0-11.5 9.9v-7H8v-3h2.5V9.5a3.5 3.5 0 0 1 3.8-3.8h2.7v3h-2c-.8 0-1.2.4-1.2 1.2V12H17l-.5 3h-2.2v7A10 10 0 0 0 22 12z"/></svg>
            Facebook
          </a>

          <a href="https://www.instagram.com/rotaractclubtrento" target="_blank" class="social-btn instagram">
            <svg viewBox="0 0 24 24"><path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2c1.6 0 3 1.4 3 3v10c0 1.6-1.4 3-3 3H7c-1.6 0-3-1.4-3-3V7c0-1.6 1.4-3 3-3h10zm-5 3.5A5.5 5.5 0 1 0 17.5 13 5.5 5.5 0 0 0 12 7.5zm0 9A3.5 3.5 0 1 1 15.5 13 3.5 3.5 0 0 1 12 16.5zm5.8-10.8a1.1 1.1 0 1 0 1.1 1.1 1.1 1.1 0 0 0-1.1-1.1z"/></svg>
            Instagram
          </a>
        </div>
    
        </div>

        <div class="map-container">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2768.0005054992876!2d11.119404976728042!3d46.07103109274534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478271359a342359%3A0x9ecd447b4e46808!2sRotary%20Club%20Trento!5e0!3m2!1sit!2sit!4v1762416004887!5m2!1sit!2sit"
          width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>

      <!-- 🔹 FORM CONTATTI -->
      <div class="contact-form">
        <h2>Scrivi in questo form per contattarci</h2>

        <?php if (isset($_SESSION['errore'])): ?>
          <div class="message-box error">
            <p><strong>❌ Errore:</strong> <?= $_SESSION['errore'] ?></p>
          </div>
          <?php unset($_SESSION['errore']); ?>
        <?php elseif (isset($_SESSION['successo'])): ?>
          <div class="message-box success">
            <p><strong>✅ <?= $_SESSION['successo'] ?></strong></p>
          </div>
          <?php unset($_SESSION['successo']); ?>
        <?php endif; ?>

        <form method="POST" action="">
          <label for="nome">Nome</label>
          <input type="text" id="nome" name="nome" required>

          <label for="email">Email personale</label>
          <input type="email" id="email" name="email" required>

          <label for="messaggio">Messaggio</label>
          <textarea id="messaggio" name="messaggio" required></textarea>

          <button type="submit" id=invia>INVIA</button>
        </form>
      </div>

      </main>
          </div>

          <div id="footer">
              <div id="footerContent">
                  <div id="sede">
                      <h4>Sede legale:</h4>
                      <p>Piazza Dante 20, 38122 Trento (TN)</p>
                  </div>

                  <div id="sitiEsterni">
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

  
</body>
</html>
