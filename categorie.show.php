<?php

require './helpers/Database.php';
require './functions.php';
require './classes/Category.php';
require './classes/Film.php';

echo template_header('Read'); ?>

<section>
    <div class="col-8">
        <div class="p-3 border bg-info">
            <h3>Films</h3>
            <div class="row">
                <?php
				// var_dump($_GET);
				$newID = (int)$_GET["id"];
				// var_dump($newID);
				$categorys = Film::readByCat($newID);
				// var_dump($categorys);
				?>
                <?php 
                foreach ($categorys as $category) {
                    # code...
				var_dump($category);
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>