<?php
require './helpers/Database.php';
require './functions.php';
require './classes/Category.php';
require './classes/Film.php';
require './classes/Actor.php';
echo template_header('Le film', 'active'); ?>
<?php
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false) :
?>
<?php
  header("refresh:0; login.php");
else :
?>
  <section>
    <div class="container pt-2 mt-5">
      <div class="p-3 border border-3 border-dark bg-primary d-flex mt-2">
        <div class="col-6 m-auto" style="align-items: center !important;">
          <?php
          $newID = (int)$_GET["id"];
          $film = Film::read($newID);
          $filmNewId = (int)$film['film_id'];
          $filmActors = Actor::readByFilm($filmNewId);
          ?>
          <div class="col">
            <h3>Films n°:<?php echo $film["film_id"] ?></h3>
            <h3><?php echo $film["title"] ?></h3>
            <p><strong>Langue : <?php echo $film["name"] ?></strong></p>
          </div>
        </div>
        <div class="col-6 bg-white p-4">
          <h4>Caractéristiques</h4>
          <p class="text-muted"><?php echo $film["special_features"] ?></p>
          <h4>Description</h4>
          <p><?php echo $film["description"] ?></p>
          <h4>Acteur :</h4>
          <div class="row">
            <?php
            foreach ($filmActors as $filmActor) {
              echo "<div class='col-6'>" . $filmActor["first_name"] . " " . $filmActor["last_name"] . "</div>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container border border-3 border-dark pt-2 mt-5">
      <h3 style="text-decoration: underline;">Tous les film de sa catégorie:</h3>
      <div class="row">
        <?php
        $newID = (int)$_GET["id"];
        $categorys = Film::readByCatId($newID);
        $new = count($categorys);
        foreach ($categorys as $category) {
          $category_id = $category['category_id'];
          $i = $new;
          while ($i <= $new) :
            $films = Film::readByCat($category_id);
            foreach ($films as $film) {
              $film_id = $film['film_id'];
              $actorByFilm = Actor::readByFilm($film_id);
              $nbActor = count($actorByFilm);
              $film = Film::read($film_id);
        ?>
              <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                  <?php
                  if ($category_id == "1") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/action.jpg" data-holder-rendered="true">';
                  } elseif ($category_id == "2") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Animation.jpg" data-holder-rendered="true">';
                  } elseif ($category_id == "3") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Children.jpeg" data-holder-rendered="true">';
                  } elseif ($category_id == "4") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Classics.jpg" data-holder-rendered="true">';
                  } elseif ($category_id == "5") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Comedy.jpg" data-holder-rendered="true">';
                  } elseif ($category_id == "6") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Documentary.jpg" data-holder-rendered="true">';
                  } elseif ($category_id == "7") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Drama.webp" data-holder-rendered="true">';
                  } elseif ($category_id == "8") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Family.jpg" data-holder-rendered="true">';
                  } elseif ($category_id == "9") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Foreign.jpg" data-holder-rendered="true">';
                  } elseif ($category_id == "10") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Games.jfif" data-holder-rendered="true">';
                  } elseif ($category_id == "11") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Horror.jfif" data-holder-rendered="true">';
                  } elseif ($category_id == "12") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Music.jfif" data-holder-rendered="true">';
                  } elseif ($category_id == "13") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/New.jpg" data-holder-rendered="true">';
                  } elseif ($category_id == "14") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Sci-Fi.jpg" data-holder-rendered="true">';
                  } elseif ($category_id == "15") {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Sports.jfif" data-holder-rendered="true">';
                  } else {
                    echo '<img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="/public/img/Travel.jpg" data-holder-rendered="true">';
                  }


                  ?>
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $film["title"] ?></h5>
                    <p>Film n° : <?php echo $film['film_id'] ?></p>
                    <p>Nombre d'acteur dans se film :<strong> <?php echo $nbActor ?></strong></p>
                    <p class="card-text"><?php echo $film["description"] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="film.show.php?id=<?= (int)$film["film_id"] ?>">Voir</a>
                      </div>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>
                </div>
              </div>
        <?php
            }
            $i++;
          endwhile;
        }
        ?>
      </div>
    </div>
  </section>
<?php endif;
