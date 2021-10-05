<?php
require './helpers/Database.php';
require './functions.php';
require './classes/Category.php';
require './classes/Film.php';
require './classes/Actor.php';
require './classes/Rental.php';
require './classes/Staff.php';
require './classes/Customer.php';
require './classes/Inventory.php';
echo template_header('Récapitulatif d\'une réservation', 'active'); ?>
<?php
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false) :
?>
<?php
  header("refresh:0; login.php");
else :
?>
  <section>
    <div class="container pt-2 mt-5">
      <div class="p-3 border border-3 border-dark bg-primary  mt-2">
        <div class="col-12 m-auto" style="align-items: center !important;">
          <?php
          // Dans l'inventaire j'ai de dispot le store et e film par le id 
          // Dans customer j'ai de disponible le client par son id 
          // Dans le staff j'ai de disponible les vendeurs par leur id 
          $rentalId = (int)$_GET["id"];
          $rental = Rental::read($rentalId);
          $inventory_idInt = (int)$rental['inventory_id'];
          $inventory_id = Inventory::read($inventory_idInt);
          // Film de L'inventaire de la réservation 
          $filmId = (int)$inventory_id['film_id'];
          $films = Film::readByCatId($filmId);
          foreach ($films as $film) {
            $film['category_id'];
          }
          //Catégorie du film
          $category_idInt = $film['category_id'];
          $category_id = (int)$category_idInt;
          $category = Category::read($category_id);
          // Store de L'inventaire de la réservation 
          $storeId = (int)$inventory_id['store_id'];
          // Customer de la réservation 
          $customerIdInt = (int)$rental["customer_id"];
          $customerId = Customer::read($customerIdInt);
          // Staff de la réservation 
          $staff_id = (int)$rental['staff_id'];
          $Staff = Staff::read($staff_id);
          ?>
          <div class="col">
            <div class="row">
              <div class="col-6">
                <h3 class="text-white ">Client : <?php echo $customerId["last_name"] ?>
                  <?php echo  $customerId["first_name"] ?> </h3>
              </div>
              <div class="col-6">
                <p> <strong class="text-dark ">Date de la location :</strong> <strong class="text-white "><?php echo $rental["rental_date"] ?></strong></p>
              </div>
              <div class="col-6">
                <p><strong class="text-dark ">Enregistré par : </strong><strong class="text-white "><?php echo $Staff['first_name'] ?></strong></p>
              </div>
              <div class="col-6">
                <p><strong class="text-dark ">Date retour de la location :</strong> <strong class="text-white "><?php echo $rental["return_date"] ?></strong></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 bg-white p-4">
          <div class="row">
            <div class="container">
              <div class="row">
                <div class="col-6 m-auto bg-light border border-primary">
                  <h4>Récapitulatif du film</h4>
                  <p>Catégorie : <?php echo $category['name']; ?></p>
                  <?php
                  $film = Film::read($filmId);
                  ?>
                  <p class="text-muted"><strong>Titre : <?php echo $film["title"] ?></strong></p>
                  <h4>Description</h4>
                  <p><?php echo $film["description"] ?></p>
                  <p>Réaliser en <?php echo $film['release_year'] ?></p>
                  <p></p>
                  <p>Durée de la location : <?php echo $film['rental_duration'] ?>/Jour </p>
                </div>
                <div class="col-6">
                  <h4>Acteur :</h4>
                  <?php
                  $film_id = $film['film_id'];
                  $actorByFilms = Actor::readByFilm($film_id);
                  $nbActor = count($actorByFilms);
                  $film = Film::read($film_id);
                  foreach ($actorByFilms as $actorByFilm) {
                    echo "<div class='col-6'>" . $actorByFilm["first_name"] . " " . $actorByFilm["last_name"] . "</div>";
                  }


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

                </div>
              </div>
            </div>
            <div class="container bg-primary mt-2">
              <p class="text-uppercase"><strong><u>Info staff:</u> </strong></p>
              <ul class='text-white '>
                <li>Tarif de location : <?php echo $film['rental_rate'] ?></li>
                <li>Coût de remplacement du film : <?php echo $film['replacement_cost'] ?></li>
                <li>Evalution <?php echo $film['rating'] ?></li>
                <li>Caractéristiques spéciales : <?php echo $film['special_features'] ?></li>
                <li>Dernier modification : <?php echo $film['last_update'] ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container border border-3 border-dark pt-2 mt-5">
      <h3 style="text-decoration: underline;">Tous les réservations de ce client:</h3>
      <div class="row">
        <?php
        //selectionner tous les rental de ce client 
        $customerIds =  $customerId['customer_id'];
        $customerIdInt = (int)$customerIds;
        $rentalByCustomers = Rental::readByCustomer($customerIdInt);
        $new = count($rentalByCustomers);
        foreach ($rentalByCustomers as $rentalByCustomer) {
          $i = $new;
          $inventoryId = $rentalByCustomer['inventory_id'];
          $inventoryIdInt = (int)$inventoryId;
          while ($i <= $new) :
            $rental_inventoryByCustomer = Inventory::read($inventoryIdInt);
            $allRentalFilmByClientID = $rental_inventoryByCustomer['film_id'];
            $allRentalFilmByClientIDInts = (int)$allRentalFilmByClientID;
            $films = Film::readId($allRentalFilmByClientIDInts);
            $filmsId = (int)$films['film_id'];
            $categorys = Film::readByCatId($filmsId);
            $readByInventoryAndCustomers = Rental::readByInventoryAndCustomer($customerIdInt, $inventoryIdInt);
            foreach ($readByInventoryAndCustomers as $readByInventoryAndCustomer) {
              $rentalByFilmCustomer = $readByInventoryAndCustomer['rental_id'];
            }
            foreach ($categorys as $category) {
              $category_id = $category['category_id'];
            }
            echo '<br>';
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
                  <h5 class="card-title"><?php echo $films["title"] ?></h5>
                  <p>Film n° : <?php echo $films['film_id'] ?></p>
                  <p>Nombre d'acteur dans se film :<strong> <?php echo $nbActor ?></strong></p>
                  <p class="card-text"><?php echo $films["description"] ?></p>
                  <div class="d-flex justify-content-between align-items-center">

                    <div class="btn-group">
                      <a href="<?php $_SERVER['HTTP_HOST']; ?>/reservation.inventory.php/?id=<?php echo $rentalByFilmCustomer; ?>">Voir</a>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
        <?php
            $i++;
          endwhile;
        }
        ?>
      </div>
    </div>
  </section>
<?php endif;
