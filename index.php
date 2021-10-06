<?php
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}
include './helpers/Database.php';
require './functions.php';
require './classes/Category.php';
require './classes/Film.php';
require './classes/Language.php';
require './classes/Actor.php';
echo template_header('accueil', 'rubrique1');
?>
<?php
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false) :
?>
<?php
    header("refresh:0; login.php");
else :
?>
    <section class="pt-5 mt-3">
        <div class="container">
            <h1>LOCATION DE DVD</h1>
        </div>
    </section>
    <section>
        <div class="container px-4">
            <div class="row gx-5">
                <div class="col-sm-4 col-12">
                    <div class="p-3 border  border-3 border-dark bg-primary">
                        <h3>Categories</h3>
                        <ol>
                            <?php
                            $categories = Category::all();
                            foreach ($categories as $category) {  ?>
                                <li>
                                    <a href="categorie.show.php?id=<?php echo $category['category_id'] ?>" class="text-light"><?php echo $category["name"]; ?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ol>
                    </div>
                </div>
                <div class="col-sm-8 col-12">
                    <div class="p-3 border border-3 border-dark  bg-primary">
                        <h3>Films</h3>
                        <div class="row " style="justify-content: space-around;">
                            <?php
                            $films = Film::all();
                            // On récupère le nombre d'articles
                            $nbArticles = count($films);
                            // On détermine le nombre d'articles par page
                            $parPage = 6;
                            // On calcule le nombre de pages total
                            $pages = ceil($nbArticles / $parPage);
                            // Calcul du 1er article de la page
                            $firstt = ($currentPage * $parPage) - $parPage;
                            $films = Film::allWidthLimit($firstt, $parPage);
                            foreach ($films as $film) {
                                $newLanguageId = (int)$film['language_id'];
                                $Language = Language::read($newLanguageId);
                                $filmId = (int)$film['film_id'];
                                $catsByFilms = Category::readByFilmId($filmId);
                                $actorByFilm = Actor::readByFilm($filmId);
                                $nbActor = count($actorByFilm);
                                foreach ($catsByFilms as $catsByFilm) {
                                    $catId = (int)$catsByFilm['category_id'];
                                    $category_ids = Category::read($catId);
                                    $category_id = $category_ids['category_id'];

                            ?>
                                    <div class="card mb-3" style="width: 19.8rem; padding:5px;">
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
                                        } ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $film["title"] ?></h5>
                                            <p>language :<?php echo $Language["name"] ?></p>
                                            <p>Nombre d'acteur dans se film :<strong> <?php echo $nbActor ?></strong></p>
                                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $film["special_features"] ?></h6>
                                            <p class="card-text"><?php echo $film["description"] ?></p>
                                            <a href="film.show.php?id=<?= (int)$film["film_id"] ?>" class="card-link">Voir plus</a>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <nav>
                                <span>Page : <?php
                                                if ($currentPage == 1) {
                                                    echo " ";
                                                } else {
                                                    echo '... ';
                                                    echo $currentPage - 1;
                                                    echo ' /';
                                                } ?>
                                    <strong>
                                        <?= $currentPage ?>
                                    </strong>

                                    <?php
                                    if ($currentPage == $pages) {
                                        echo "";
                                    } else {
                                        echo ' /';
                                        echo $currentPage + 1;
                                        echo '... ';
                                    }
                                    ?></span>
                                <ul class="pagination">
                                    <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                                        <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                                    </li>
                                    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                                        <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif;
