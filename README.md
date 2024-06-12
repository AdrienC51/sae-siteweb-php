# sae2-01

## Membres du binôme
* Adrien CADALEN (cada0003)
* Toustary SOUF-DAOUD (souf0012)

## Commandes
* Pour utiliser la vérification de PHP CS Fixer : `test:cs`
* Pour utiliser PHP CS Fixer : `fix:cs`

## Mise en place
* Placez vous sur le dossier 
* Lancer le serveur avec la commande
  * sur Windows : `composer start:windows`
  * sur Linux : `composer start`
* Cliquez [ici](http://localhost:8000/) pour vous rendre sur la page d'accueil

## Présentation des pages
### Page d'accueil (index.php)
* Contient la liste complète des séries contenues dans la base de données avec leur poster
  * Vous pouvez cliquer sur la case d'une série pour accéder à la page qui lui est dédiée
  * Vous pouvez utiliser le lien `http://localhost:8000/index.php?genreId={inserez l'id du genre recherché ici}` pour afficher seulement les séries d'un genre précis
* Contient un menu avec un bouton permettant de créer une nouvelle série `Create Show`
  * Ce bouton vous renvoie vers la page `http://localhost:8000/admin/form-show.php`
### Page d'une série (show.php)
* Contient des informations sur la série
* Contient la liste complète des saisons d'une série avec leur poster
  * Vous pouvez cliquer sur la case d'une saison pour accéder à la page qui lui est dédiée
* Contient un menu avec trois boutons
  * Le bouton `Home` qui permet de revenir à la page d'accueil
  * Le bouton `Edit TVShow` qui permet de modifier les informations de la série
    * Ce bouton vous renvoie vers la page `http://localhost:8000/admin/form-show.php?showId={id de la série de la page}`
  * Le bouton `Delete TVShow` qui permet de supprimer la série de la base de données 
    * ce bouton vous renvoie vers la page `http://localhost:8000/admin/delete-show.php?showId={id de la série de la page}`
### Page d'une saison (season.php)
* Contient des informations sur la saison
  * Vous pouvez cliquer sur le titre de la série pour accéder à la page qui lui est dédiée
* Contient une liste complète des épisodes d'une saison
* Contient un menu avec un bouton permettant de revenir à la page d'accueil
### Page du formulaire de création/modification d'une série (form-show.php)
* Contient un formulaire permettant de créer/modifier les informations d'une série
  * Si vous accéder à la page depuis le bouton `Edit TVShow`, les informations de la série que vous voulez modifier seront présentes dans les cases du formulaire et l'id de la série sera retenu
  * Si vous accéder à la page depuis le bouton `Create Show`, les cases seront vides pour taper les informations de la nouvelle série
* Une fois les informations rentrées et le bouton `Enregistrer` pressé, les informations sont envoyées par la méthode `POST` 
### Page de création/modification d'une série (save-show.php)
* La page récupère les informations dans la charge utile
  * Si l'id de la série est présent, le programme modifie la série correspondant à l'id dans la base de données avec les nouvelles informations
  * Sinon, le programme crée une nouvelle série avec ces informations
* La page redirige l'utilisateur vers la page d'accueil
### Page de suppression (delete-show.php)
* La page récupère l'id de la série dans l'url avec la méthode `GET` et supprime la série correspondant à cet id dans la base de données
* Redirige l'utilisateur vers la page d'accueil 