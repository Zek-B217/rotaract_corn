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
  <link rel="stylesheet" href="../CSS/contattiStyle.css">
</head>
<body>
  <div class="contact-form">
    <h2>Scrivi in questo form per contattarci</h2>

    <!-- Messaggio di conferma -->
    <?php if (isset($inviata)): ?>
      <div class="message-box">
        <?php if ($inviata): ?>
          <p class="success"><strong>✅ Messaggio inviato con successo!</strong><br>Ti risponderemo al più presto.</p>
        <?php else: ?>
          <p class="error"><strong>❌ Errore durante l'invio.</strong><br>Riprova più tardi o scrivi a <a href="mailto:rac.trento@rotaract2060.it">rac.trento@rotaract2060.it</a>.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- Social e Email -->
    <div class="contact-info">
      <a class="contact-item" href="https://www.instagram.com/rotaractclubtrento/" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram logo">
        @rotaractclubtrento
      </a>

      <a class="contact-item" href="https://www.facebook.com/RotaractClubTrento" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook logo">
        Rotaract Club Trento
      </a>

      <a class="contact-item" href="mailto:rac.trento@rotaract2060.it">
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
</body>
</html>
