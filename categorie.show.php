<?php
require './helpers/Database.php';
require './functions.php';
require './classes/Category.php';
require './classes/Film.php';
require './classes/Language.php';
require './classes/Actor.php';
echo template_header('Les films de cet catégorie', 'active'); ?>
<?php
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false) :
?>
<?php
  header("refresh:0; login.php");
else :
?>
  <section>
    <div class="container pt-5">
      <div class="p-3 border  border-3 border-dark  bg-primary">
        <?php
        $newID = (int)$_GET["id"];
        $categorysNames = Category::readByFilm($newID);
        $categorysNameId = $categorysNames['category_id'];
        $categorysNameInt = (int)$categorysNameId;
        $catName = Category::read($categorysNameInt);
        ?>
        <div class="container d-flex">
          <div class="col-4"></div>
          <div class="col-4">
            <?php
            if ($categorysNameInt == "1") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/action.jpg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "2") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Animation.jpg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "3") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Children.jpeg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "4") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Classics.jpg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "5") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Comedy.jpg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "6") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Documentary.jpg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "7") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Drama.webp" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "8") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Family.jpg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "9") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Foreign.jpg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "10") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Games.jfif" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "11") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Horror.jfif" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "12") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Music.jfif" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "13") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/New.jpg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "14") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Sci-Fi.jpg" data-holder-rendered="true">';
            } elseif ($categorysNameInt == "15") {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Sports.jfif" data-holder-rendered="true">';
            } else {
              echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Travel.jpg" data-holder-rendered="true">';
            }

            ?></div>
          <div class="col-4"></div>
        </div>
        <h3>Les films de la catégorie <?php echo $catName['name'] ?></h3>
        <div class="row " style="justify-content: space-around;">
          <?php
          $categorys = Category::read($newID);
          $new = count($categorys);
          $newID = (int)$_GET["id"];
          $categorys = Film::readByCat($newID);
          $new = count($categorys);
          ?>
          <?php
          foreach ($categorys as $category) {
            $film_id = $category['film_id'];
            $i = $new;
            while ($i <= $new) :
              $film = Film::read($film_id);
              $actorByFilm = Actor::readByFilm($film_id);
              $nbActor = count($actorByFilm);
              $i++;
          ?>
              <div class="card mb-3" style="width: 20rem;">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $film["title"] ?></h5>
                  <p>language :<?php echo $film["name"] ?></p>
                  <p>Nombre d'acteur dans se film :<strong> <?php echo $nbActor ?></strong></p>
                  <h6 class="card-subtitle mb-2 text-muted"><?php echo $film["special_features"] ?></h6>
                  <p class="card-text"><?php echo $film["description"] ?></p>
                  <a href="film.show.php?id=<?= (int)$film["film_id"] ?>" class="card-link">Voir</a>
                </div>
              </div>
          <?php
            endwhile;
          }
          ?>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
<?php endif;
