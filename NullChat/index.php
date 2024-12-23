<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie Anonyme</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Envoyer un Message Anonyme</h1>
    <form action="process.php" method="POST">
        <label for="message">Votre message :</label><br>
        <textarea name="message" id="message" rows="5" cols="50"></textarea><br><br>
        <button type="submit">Envoyer</button>
    </form>
    <hr>
    <h2>Historique des messages</h2>
    <div id="message-history">
        <?php
        $conn = new mysqli('localhost', 'root', '', 'messagerie_anonyme');
        if ($conn->connect_error) {
            die('Erreur de connexion : ' . $conn->connect_error);
        }
        $sql = "SELECT * FROM messages ORDER BY date DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p><strong>" . htmlspecialchars($row['date']) . ":</strong> " . htmlspecialchars($row['message']) . "</p>";
            }
        } else {
            echo "<p>Aucun message pour le moment.</p>";
        }
        $conn->close();
        ?>
    </div>
    <script>
      if ('serviceWorker' in navigator) {
          navigator.serviceWorker.register('/js/service-worker.js').then(() => {
              console.log('Service Worker enregistré avec succès !');
          }).catch(error => {
              console.error('Erreur d’enregistrement du Service Worker :', error);
          });
      }
    </script>
</body>
</html>
