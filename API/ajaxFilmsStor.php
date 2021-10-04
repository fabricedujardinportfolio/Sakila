<?php
require '../helpers/Database.php';
require '../functions.php';
require '../classes/Film.php';
if (!empty($_POST["keyword"])) {
  $key = $_POST["keyword"];
  $querys = Film::readForAjax($key);
  if (!empty($querys)) {
?>
    <ul id="film-list">
      <?php
      foreach ($querys as $film) {
      ?>
        <li onClick="selectFilm('<?php echo $film["title"]; ?>');selectFilmId('<?php echo $film["film_id"]; ?>');"><?php echo $film["title"]; ?></li>
      <?php } ?>
    </ul>
<?php }
} ?>