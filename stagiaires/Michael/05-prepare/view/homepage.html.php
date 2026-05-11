<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Livre d'or</h1>
            <p>Laissez-nous un message !</p>
        </header>

        <main>
            <?php
            // on a tenté d'envoyé le formulaire et
            // il a passé les protections frontend
            if(isset($insert)):
                // échec de l'insertion
                if($insert===false):
                ?>
                <div class="not-insert-message">
                    échec lors d'un l'insertion <a href="javascript:history.go(-1);">Vérifiez votre formulaire</a>
                </div>
                <?php
                // réussite de l'insertion
                else:
                ?>
                <div class="insert-message">
                    Merci pour votre message, vous allez être redirigé
                    <script> setTimeout(
                        function() {
                            window.location.href ="./";
                        }, 2000
                    );
                    </script>
                </div>
                <?php
                endif;
            endif;
            ?>
            <!-- Formulaire d'ajout -->
            <section class="form-section">
                <form id="guestbook-form" method="POST">
                    <div class="form-group">
                        <label for="email_message">Votre email</label>
                        <input type="text" id="email_message" name="email_message" placeholder="Ex: JeanneLiHassan@cf2m.be">
                    </div>
                    
                    <div class="form-group">
                        <label for="texte_message">Votre message</label>
                        <textarea id="texte_message" name="texte_message" rows="4" placeholder="Ce que vous avez pensé de votre visite..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Publier le message</button>
                </form>
            </section>

            <!-- Liste des messages -->
            <section class="messages-section">
                <?php
                // on compte le nombre de message
                $nbMessage = count($messages);

                // pas de message
                if(empty($nbMessage)):
                ?>
               <h2>Il n'y a pas encore de message</h2>
                <?php
                // il y a au moins un message
                else:
                    // préparation du pluriel si on a plus d'un message
                    $pluriel = $nbMessage>1 ? "s" :"";
                ?>
            
                <h2>Message<?= $pluriel ?> récent<?= $pluriel ?> (<?= $nbMessage ?>)</h2>
                <?php
                    foreach($messages as $message):
                ?>
                <div class="message-card">
                    <h3>Ecrit par <?= htmlspecialchars($message['email_message']) ?> le <?= htmlspecialchars($message['date_message']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($message['texte_message'])) ?></p>

                </div>
                <?php
                    endforeach;
                endif;
                ?>
            </section>
        </main>
    </div>

</body>
</html>