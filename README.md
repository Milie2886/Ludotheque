<Bienvenue sur l'application Ludotheque.
Développée en symfony 6
Etapes d'installation : 
Cloner le repo,
Se placer sur le dossier et l'ouvrir dans votre éditeur.
Faire composer install à partir du terminal pour installer toutes les dépendances dans le dossier
Ouvrir et paramétrer le .env
  DATABASE_URL="mysql://user:motdepasse@localhost:port/ludotheque
  Remplacer par vos credentials
Dans le terminal, entrer la commande : symfony console doctrine:database:create
Importer le fichier ludotheque.sql dans votre gestionnaire de base de données.
Dezipper le dossier imagejeux.zip à l'exterieur du dossier Ludotheque
  Ces images serviront à créer les jeux sans avoir a aller chercher des images...

Lancer le serveur : symfony serve -d (pour que le code s'exécute en arrière plan)

Sur le site, dès l'arrivé, il faut se connecter ou créer un compte pour pouvoir ajouter un jeu
Créer son compte
(le système est sensé envoyé un mail (via mailtrap) mais ça ne fonctionne pas...)
Une fois le compte créé, on peut ajouter son premier jeu
Ajouter un jeu (image, titre et description)
Une fois ajouté, on peut le modifier, le supprimer
On peut également modifier son profil, et réinitialiser son mot de passe.
Ce \textbf{Mot} en gras.
