# Sakila
ECF CCI
<h2>Procédure</h2>
<p>J'initialise mon composer sur le projet </p>
<p>Je lance mon server</p>
<p>Je modifie mon autoload avec le nouveaux dossier créer</p>
<p>Je crée mon app.php dans mon src/framework</p>
<p>Je le rend accésible pour mon vendor</p>
<p>Je l'appel depuit l'index</p>
<code>require '../vendor/autoload.php';</code>
<h2>je lance mon serveur avec la commande en spécifiant mon dossié public : </h2>

<code>php -S localhost:8000 -d display_errors -t public/</code>
<h2>Comme j'ai modifier mon autload je doit le recharger avec cette commande</h2>
<p>src/Framework</p>
<code>composer dump-autoload</code>

<h4>Mémo Perso</h4>

- composer Init = pour utiliser des dépendance 
- phpunit = pour les test unitaire

- Création du dossier public = pour une premier sécurité sur l'index.php 
pour que Si un jour la configuration apache ou ngninx est male faite et que les fichier php ne son pas correctement  interpréter cela enpéchera d'avoir accés à l'arhitecture du projet.