# 05-exercice

### Etapes pour l'exercice (proche du TI)

- création d'un `.gitignore` avec `config.php` sur une ligne dans celui-ci
- création d'un `README.md` pour la marche à suivre (pour vous, en faire une checkliste de l'avancée du projet)
- création de 5 dossiers
    - `data` (contiendra un base de donnée en fichier `.sql`), et les divers fichiers servant au projet
    - `public` dossier visible pour les utilisateurs, contient le contrôleur frontal, les dossiers `img`, `css`, `js`
    - `model` dossier qui s'occupera de gérer les données (dans notre cas contiendra les fonctions qui manipulent notre DB)
    - `view` dossier qui contiendra les templates de vue (attention, ça reste du backend ! Même si ça contient principalement de l'HTML)
    - `controller` dossier qui contient les contrôleurs, ceux-ci font le lien entre les données (`model`) et les vues (`view`), ils gèrent les entrées et sorties vers les utilisateurs