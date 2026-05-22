<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Livre d'or</h1>
            <p>Laissez-nous un message !</p>
        </header>

        <main>
            <?php  
            // on a tenté d'énvoyer le formulaire et
            // il a passé les protection frontend
            if (isset($insertMessage)):
                //
                if ($insertMessage === false):
            ?>
                    <div class="non-insert-message">
                        <p>Echec <a href="javascript:history.go(-1);"> Verifie votre formulaire</a></p>

                    </div>

                <?php
                else:
                ?>
                    <div class="insert-message">
                        <p>Merci pour votre votre message, vous allez etre rederigé</p>
                        <script>
                            setTimeout(function() {
                                window.location.href = './';
                            }, 2000);
                        </script>
                    </div>
            <?php
                endif;
            endif; ?>




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
            <?php
            $nbMessage = count($messages);
            if (empty($nbMessage)):
            ?>
                <h2>Il n'y a pas encore de messages</h2>
            <?php
            // il y a au mois un message
            else:
                // preparation du pluriel si on a plus d'un message
                $pluriel = $nbMessage > 1 ? "s" : "";
            ?>
                <section class="messages-section">
                    <h2>Message<?= $pluriel ?> récent<?= $pluriel ?> (<?= $nbMessage ?>)</h2>
                    <?php
                    foreach ($messages as $message):
                    ?>
                        <div class="message-card">
                            <h3>Ecrit par <?= htmlspecialchars($message['email_message']) ?> le <?= $message['date_message'] ?></h3>
                            <p><?=nl2br($message['texte_message']) ?></p>
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