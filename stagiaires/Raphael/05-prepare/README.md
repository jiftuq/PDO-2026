# 05-prepare

## Structure MVC

```
model/ -> gère des données

view/ ->gère les vues ou templates

controller/ -> fait le lien entre le model et les vues
        routerController -> redirige suivant action
public/ ->seul accès aux utilisateur du site
        index.php -> contrôleur frontal

.gitignore -> pour protéger les fichiers sensibles ou inutiles
config.php -> données sensibles
config-dev.php -> données de dev 
index.php -> redirection vers publib
```