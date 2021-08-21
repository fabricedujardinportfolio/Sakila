<?php
require './helpers/Database.php';
require './functions.php';
require './classes/Category.php';
require './classes/Film.php';
echo template_header('Show all film by catégorys','active'); ?>
<section>
    <div class="container-fluid pt-5">
        <div class="p-3 border  bg-primary">
            <?php
                $newID = (int)$_GET["id"];
                $categorysNames = Category::readByFilm($newID); 
                $categorysNameId = $categorysNames['category_id'];
                $categorysNameInt = (int)$categorysNameId;
                $catName = Category::read($categorysNameInt); 
            ?>
            <h3>Les films de la catégorie <?php echo $catName['name'] ?></h3>
            <div class="row">
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
                    while ($i <= $new):                    
                        $film = Film::read($film_id);
                        $i++;
                    ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $film["title"] ?></h5>
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