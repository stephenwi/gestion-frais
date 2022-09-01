# gestion-frais

Pour la mise en place de cet Api, j'ai opté pour le framework symfony 6.0 et PHP >= 8

1) iCréation du project composer create-project symfony/skeleton gention-frais
2) J'ai opté pour une base de donnée PostgreSql avec pour nom gestion frais

  Entité
  
3 Pour cet Api nous avons crée quantre entités qui sont:
4 User: pour l'utilisateur
5)company: pour identifier les sociétés
7) TypeNote: Pour le type de note
8) NoteFrais: Pour les notes de frais


Relation entre entité:

- nyToOne entre NoteFrais et TypeNote
- ManyToOne entre NoteFrais et Compagny


Système d'authentification et registration

Pour l'authentification de l'utilisateur, j'ai utilisé le système proposé par symfony qui sont:

php bin/console make:auth
php bin/console make:registration-form

Installation du project

a) clone le project
b) Executé la commande npm install
c) run php bin/console make:migration
d) run php bin/console make:migration:migrate
e) Lancer le serveur local avec la commande symfony serve
