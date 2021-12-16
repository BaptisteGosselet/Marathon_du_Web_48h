# Marathon21

Après avoir récupéré le projet, ne pas oublier de :

- Télécharger les dépendances
  ```shell
  composer install
  ```
  
- De copier le fichier `.env.example` dans le fichier `.env`

  Adapter le contenu du fichier à votre contexte de développement (connexion à une base de données, ...)

- De générer une clè aléatoire
  ```shell
  php artisan key:generate
  ```

## La base de données 


**Ne pas oublier de configurer votre base de données dans le fichier `.env`**

La base de données peut être créée à partir des commandes suivantes (sur votre machine locale) :

```shell
 php artisan migrate:fresh
 php artisan db:seed 
```

Des commentaires aléatoires ont été ajoutés. Des épisodes ont été vus en liaison avec les commentaires (voir le fichier `database/seeders/DatabaseSeeder.php`).

Ou, utiliser la base de données qui vous est proposée sur le serveur marathon.

## Le serveur

Dès que la base de données est opérationnelle, vous pouvez vous connecter en utilisant l'un des 3 utilisateurs créés :

Robert Duchmol robert.duchmol@domain.fr (administrateur, password: password)
Gérard Martin gerard.martin@domain.fr (password: password)
Julia Rodrigez julia.rodrigez@domain.fr (password: password)
