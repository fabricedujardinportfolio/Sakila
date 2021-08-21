<?php

require './helpers/Database.php';
require './functions.php';
require './classes/Category.php';
require './classes/Film.php';

echo template_header('Read one film'); ?>

<section>
    <div class="container pt-2 mt-5">
        <div class="p-3 border bg-primary">
                <?php
				$newID = (int)$_GET["id"];
				$film = Film::read($newID);
				?>
            <h3>Films n°:<?php echo $film["film_id"] ?></h3>
            <h3><?php echo $film["title"] ?></h3>
            <div class="container bg-white p-4">
                <p class="text-muted"><?php echo $film["special_features"] ?></p>
                <p><?php echo $film["description"] ?></p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container pt-2 mt-5">
        <h3>Tous les film de sa catégorie:</h3>
        <div class="row">
    <?php
				$newID = (int)$_GET["id"];
				$categorys = Film::readByCatId($newID);
                $new = count($categorys);
                // var_dump($categorys['category_id']);
                
                // $categorys = Film::readByCat($newID);
                
                ?>
                <?php
                foreach ($categorys as $category) {
                    // var_dump($category['category_id']);
                    $category_id = $category['category_id'];
                    $i = $new;
                    while ($i <= $new):                    
                        $films = Film::readByCat($category_id);
                        foreach($films as $film){
                        $film_id = $film['film_id'];
                        $film = Film::read($film_id);
				?>
                        
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $film["title"] ?></h5>
                    <p>Film n° : <?php echo $film['film_id']?></p>
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