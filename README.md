# Sakila
ECF CCI



- composer Init = pour utiliser des dépendance 
- phpunit = pour les test unitaire

- Création du dossier public = pour une premier sécurité sur l'index.php 
pour que Si un jour la configuration apache ou ngninx à male faite et que les fichier php ne son correctement pas interpréter quelqu'un pourra avoir accés à l'arhitecture du projet .


<h2>je lance mon serveur avec la commande en spécifiant mon dossié public : </h2>

<code>php -S localhost:8000 -d display_errors -t public/</code>
<h2>Comme j'ai modifier mon autload je doit le recharger avec cette commande</h2>
<p>src/Framework</p>
<code>composer dump-autoload</code>