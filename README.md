<h2>Bienvenue sur l'application Ludotheque!</h2>
<p>Développée en symfony 6</p>
<strong>Etapes d'installation :</strong> 
<li>Cloner le repo,</li>
<li>Se placer sur le dossier et l'ouvrir dans votre éditeur,</li>
<li>Faire composer install à partir du terminal pour installer toutes les dépendances dans le dossier,</li>
<li>Ouvrir et paramétrer le .env : </li>
  <ul>
  <li>DATABASE_URL="mysql://user:motdepasse@localhost:port/ludotheque</li>
  <li>Remplacer par vos credentials</li>
  </ul>
<li>Dans le terminal, entrer la commande : symfony console doctrine:database:create</li>
<li>Importer le fichier ludotheque.sql dans votre gestionnaire de base de données.</li>
<li>Dezipper le dossier imagejeux.zip à l'exterieur du dossier Ludotheque</li>
  Ces images serviront à créer les jeux sans avoir a aller chercher des images...

<li>Lancer le serveur : symfony serve -d (pour que le code s'exécute en arrière plan)</li>

<h2>Sur le site,</h2> 
<li>Dès l'arrivé, il faut se connecter ou créer un compte pour pouvoir ajouter un jeu</li>
<li>Créer son compte</li>
(le système est sensé envoyé un mail (via mailtrap) mais ça ne fonctionne pas...)</li>
<li>Une fois le compte créé, on peut ajouter son premier jeu</li>
<li>Ajouter un jeu (image, titre et description)</li>
<li>Une fois ajouté, on peut le modifier, le supprimer</li>
<li>On peut également modifier son profil, et réinitialiser son mot de passe.</li>
