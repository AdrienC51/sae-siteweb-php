# SAÉ 2.01 - Développement d’une application

## Membres du binôme
* Adrien CADALEN (cada0003)
* Toustary SOUF-DAOUD (souf0012)

## Commandes
* Pour utiliser la vérification de PHP CS Fixer : `test:cs`
* Pour utiliser PHP CS Fixer : `fix:cs`

## Composants nécessaires
* PHP (de préférence 8.1)
* Git
* Composer
* Un navigateur Internet (ex: Google Chrome ou Mozilla Firefox)

## Mise en place
* Clonez notre git avec la commande `git clone https://github.com/AdrienC51/sae-siteweb-php`
* Placez-vous dans le dossier/répertoire
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
  * Si vous accédez à la page depuis le bouton `Edit TVShow`, les informations de la série que vous voulez modifier seront présentes dans les cases du formulaire et l'id de la série sera retenu
  * Si vous accédez à la page depuis le bouton `Create Show`, les cases seront vides pour taper les informations de la nouvelle série
* Une fois les informations rentrées et le bouton `Enregistrer` pressé, les informations sont envoyées par la méthode `POST` 
### Page de création/modification d'une série (save-show.php)
* La page récupère les informations dans la charge utile
  * Si l'id de la série est présent, le programme modifie la série correspondant à l'id dans la base de données avec les nouvelles informations
  * Sinon, le programme crée une nouvelle série avec ces informations
* La page redirige l'utilisateur vers la page d'accueil
### Page de suppression (delete-show.php)
* La page récupère l'id de la série dans l'url avec la méthode `GET` et supprime la série correspondant à cet id dans la base de données
* Redirige l'utilisateur vers la page d'accueil 

## Présentation classes principales
### Classes d'entités
#### La classe `Show` 
* A pour attributs les informations d'une série
* Méthodes ajoutées :
  * une méthode `findById()` qui prend en paramètre l'id d'une série
    * recherche dans la base de données la ligne de la table `tvshow` correspondant à l'id fourni
  * une méthode `getSeasons()` qui ne prend pas de paramètre
    * créer une instance de la classe `SeasonCollection` 
    * lance sa méthode `findByTvShowId` avec en paramètre son attribut `id`
  * une méthode `create()` qui prend en paramètres les informations d'une série
    * crée une nouvelle instance de la classe Show
    * donne à ses attributs la valeur de ses paramètres
    * renvoie l'instance de la classe Show
  * une méthode `delete()` qui ne prend pas de paramètre
    * prépare la commande SQL permettant la suppression dans la table `tvshow` de la ligne correspond à l'attribut `id` de l'instance
    * execute la commande
    * donne une valeur `null` à l'attribut `id` de l'instance 
    * renvoie l'instance de `Show`
  * une méthode `update()` qui ne prend pas de paramètre
    * prépare la commande SQL permettant la modification dans la table `tvshow` de la ligne correspond à l'attribut `id` de l'instance avec les informations des attributs de l'instance
    * execute la commande
    * renvoie l'instance de `Show`
  * une méthode `insert()` qui ne prend pas de paramètre
    * prépare la commande SQL permettant l'insertion dans la table `tvshow` d'une nouvelle ligne avec les informations des attributs de l'instance
    * execute la commande
    * donne à l'attribut `id` de l'instance la valeur du dernier id inséré dans la base de données
    * renvoie l'instance de `Show`
  * une méthode `save()` qui ne prend pas de paramètre
    * cherche si l'instance a une valeur autre que `null` pour l'attribut `id`
      * si oui, lance la méthode `update()`
      * sinon, lance la méthode `insert()`
      * renvoie l'instance de `Show`
#### La classe `Season` 
* A pour attributs les informations d'une saison
* Méthodes ajoutées :
  * une méthode `findById()` qui prend en paramètre l'id d'une saison
    * recherche dans la base de données la ligne de la table `season` correspondant à l'id fourni
  * une méthode `getEpisodes()` qui fait 
    * créer une instance de la classe `EpisodeCollection` 
    * lance sa méthode `findBySeasonId` avec en paramètre son attribut `id`
#### La classe `Episode` 
* A pour attributs les informations d'un épisode
* Méthode ajoutée :
  * une méthode `findById()` qui prend en paramètre l'id d'un épisode
    * recherche dans la base de données la ligne de la table `episode` correspondant à l'id fourni
#### La classe `Poster` 
* A pour attributs les informations d'un poster
* Méthode ajoutée :
  * une méthode `findById()` qui prend en paramètre l'id d'un poster
    * recherche dans la base de données la ligne de la table `poster` correspondant à l'id fourni
### Classes de collections
#### La classe `EpisodeCollection`
* A pour unique méthode `findBySeasonId()`, qui prend en paramètre l'id d'une saison
  * prépare une requête qui sélectionne toutes les lignes de la table `episode` ayant un seasonId correspondant à celui fourni en paramètres
  * execute cette requête
  * renvoie les résultats récupérés dans un tableau 1D d'instances de la classe `Episode`
#### La classe `SeasonCollection`
* A pour unique méthode `findByShowId()`, qui prend en paramètre l'id d'une série
  * prépare une requête qui sélectionne toutes les lignes de la table `season` ayant un showId correspondant à celui fourni en paramètres
  * execute cette requête
  * renvoie les résultats récupérés dans un tableau 1D d'instances de la classe `Season`
#### La classe `ShowCollection`
* A pour unique méthode `findAll()`, qui peut prendre en paramètre l'id d'un genre, par défaut `null`
  * Si l'id est fourni
    * prépare une requête qui sélectionne toutes les lignes de la table `season` ayant un genreId correspondant à celui fourni en paramètres, grâce à une jointure avec la table `tvshow_genre`
    * execute cette requête
    * renvoie les résultats récupérés dans un tableau 1D d'instances de la classe `Show`
  * Sinon
    * prépare une requête qui sélectionne toutes les lignes de la table `tvshow`
    * execute cette requête
    * renvoie les résultats récupérés dans un tableau 1D d'instances de la classe `Show`

### Classes de formulaires
#### La classe `ShowForm`
*  A pour attribut une instance de la classe Show qui peut être null
* Permet l'utilisation d'un formulaire pour créer/modifier une série
  * La méthode `getHtmlForm` crée le code HTML de la page form-show.php
  * La méthode `setEntityFromQuery` récupère les informations contenues dans la charge utile (via la méthode `POST`)
    * si une des informations n'est pas présente (sauf id), la méthode renvoie un `ParameterException`
    * si l'id de la série n'est pas présente, la méthode demande la création une série sans id
    * sinon la méthode demande la création une série avec toutes les informations
