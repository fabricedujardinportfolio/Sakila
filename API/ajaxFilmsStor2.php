<?php
require '../helpers/Database.php';
require '../functions.php';
require '../classes/Film.php';
if (!empty($_POST["keyword"])) {
  $key = $_POST["keyword"];
  $querys = Film::readForAjax($key);
  // var_dump($querys);
  if (!empty($querys)) {
?>
    <ul id="film-list">
      <?php
      foreach ($querys as $film) {
      ?>
        <li onClick="selectFilm2('<?php echo $film["title"]; ?>');selectFilmId2('<?php echo $film["film_id"]; ?>');"><?php echo $film["title"]; ?></li>
      <?php } ?>
    </ul>
<?php }
} ?>