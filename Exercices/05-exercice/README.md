# 05-exercice

### Etapes pour l'exercice (proche du TI)

- création d'un `.gitignore` avec `config.php` sur une ligne dans celui-ci
- création d'un `README.md` pour la marche à suivre (pour vous, en faire une checklist de l'avancée du projet)

- création de **5 dossiers**
    - `data` (contiendra un base de donnée en fichier `.sql`), et les divers fichiers servant au projet
    - `public` dossier visible pour les utilisateurs, contient le contrôleur frontal, les dossiers `img`, `css`, `js`
    - `model` dossier qui s'occupera de gérer les données (dans notre cas contiendra les fonctions qui manipulent notre DB)
    - `view` dossier qui contiendra les templates de vue (attention, ça reste du backend ! Même si ça contient principalement de l'HTML)
    - `controller` dossier qui contient les contrôleurs, ceux-ci font le lien entre les données (`model`) et les vues (`view`), ils gèrent les entrées et sorties vers les utilisateurs
- création de `config-dev.php` et `config.php` à la racine du projet
- importez de la base de donnée en `MariaDB` depuis `05-exercice/data/exe_05.sql`
- Mettez `config-dev.php` à jour avec les paramètres pour vous connecter.
- Suivez la liste des fichiers à utiliser pour créer votre site. Le point de départ est le contrôleur frontal `public/index.php`
- Créez un hôte virtuel vers votre `stagiaires/`VotrePrénom`/05-exercice/public` et nommez le **exercice-5**

### Création du site

#### Accueil

La page d'accueil est affichée si il n'existe pas de variable `$_GET['page']`.

Sur cette page d'accueil, qui doit être responsive, affichez un menu sticky en haut avec 3 liens : Accueil | Commentaires | Ajouter un commentaire

Sur la page Accueil, écrivez un petit texte vous concernant (ou une passion) avec 3 photos.

En dessous du texte, il y a un lien vers la page des **Commentaires** et un autre vers **Ajouter un commentaire**

#### Commentaires

On peut y accéder par le menu ou en bas de page de votre accueil

Affichez le nombre de commentaire suivant le nombre :

        <h2>Pas encore de commentaire</h2>
           // ou
        <h2>Il y a 1 commentaire</h2>
           // ou
        <h2>Il y a <?= $nb ?> commentaires</h2>


affichez les commentaires par ordre décroissant si il y en a. ajoutez en bas de page un retour en haut et un lien vers **Ajouter un commentaire** 

#### Ajouter un commentaire

Ajoutez un formulaire permettant de poster un commentaire.

Conseil, protégez le formulaire côté backend avant de le protéger côté frontend.

Suivez les règles suivant les champs en PHP (! XSS) :

email -> valide, ne dépasse pas 120 caractères
full_name -> 5 caractères minimum, 120 maximum
title -> 5 carctères minimum, 180 maximum
text_comment -> 5 cractères minimum, 1000 maximum