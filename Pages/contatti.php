<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contatti - Rotaract Club Trento</title>
</head>
<body>
  <h2>Scrivi in questo form per contattarci</h2>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prendi i dati dal form
      $nome = htmlspecialchars($_POST['nome']);
      $email = htmlspecialchars($_POST['email']);
      $messaggio = htmlspecialchars($_POST['messaggio']);

      // Imposta destinatario e oggetto
      $to = "rac.trento@rotaract2060.it";
      $subject = "Nuovo messaggio dal sito contatti";

      // Corpo del messaggio
      $body = "Nome: $nome\n";
      $body .= "Email: $email\n";
      $body .= "Messaggio:\n$messaggio\n";

      // Header aggiuntivi
      $headers = "From: $email\r\n";
      $headers .= "Reply-To: $email\r\n";

      // Invia email
      if(mail($to, $subject, $body, $headers)) {
          echo "<p>Messaggio inviato correttamente. Ti risponderemo al più presto!</p>";
      } else {
          echo "<p>Si è verificato un errore. Riprova più tardi.</p>";
      }
  }
  ?>

  <form method="POST" action="">
    <label for="nome">Nome</label><br>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="email">Email personale</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="messaggio">Messaggio</label><br>
    <textarea id="messaggio" name="messaggio" required></textarea><br><br>

    <button type="submit">INVIA</button>
  </form>
</body>
</html>
