# 05-exercice

### Etapes pour l'exercice(proche du TI)

- creation d'un `gitignore` avec `config.php` sur une ligne dans celui-ci
- creation d'un `README.md` pour la marche a suivre (pour vous, en faire une checklist de l'avancee du projet)


- création de **5 dossiers**
   - `data`( contiendra une base de donne en .sql), et les divers fichiers servant au projet
   - `public` dossier visible pour les utilistaeurs, contient le controleur frontal, les dossiers `img`,`css`,`js`
   - `model` dosier qui s'occuoera de gérer les données (dans notre cas contiendra les function qui manopulent notre DB)
   - ` view` dossier qui contiendra les templates de vue (attention, ca reste du backend ! Meme si ca contient principalement de L'HTML)
   - `controller` dossier qui contient les contrôleurs, ceux-ci font le lien etre les données (`model`) et les vues (`view`), ils gèerent les entrées et sorties vers les utilisateurs
- création de `config-dev.php` et `config.php` à la racine du projet.
- Importation de la base de donnée en `MariaDB`