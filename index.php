<?php
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}
require_once './helpers/Database.php';
require './functions.php';
require './classes/Category.php';
require './classes/Film.php';


echo template_header('Read','rubrique1');
 ?>
 <?php 
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false):
    ?>
<?php
        header("refresh:0; login.php");
    else: 
?>
<?php
$db_host = "localhost";
$db_username = "fabrice";
$db_password = "secret";
$db_name="sakila";	//database name

try {
    $conn = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_username, $db_password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<!--ok-->";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>
<section class="pt-3 mt-3">
    <div class="container">
        <h1>LOCATION DE DVD</h1>
    </div>
</section>

<section>
    <div class="container px-4">
        <div class="row gx-5">
            <div class="col-4">
                <div class="p-3 border  bg-primary">
                    <h3>Categories</h3>
                    <ol>
                        <?php
						$categories = Category::all();
						foreach ($categories as $category) {  ?>
                        <li>
                            <a href="categorie.show.php?id=<?php echo $category['category_id']?>" class="text-light"><?php echo $category["name"]; ?></a>
                        </li>
                        <?php
						}
						?>
                    </ol>
                </div>
            </div>
            <div class="col-8">
                <div class="p-3 border  bg-primary">
                    <h3>Films</h3>
                    <div class="row">
                        <?php
						$films = Film::all();
                        // On récupère le nombre d'articles
                        $nbArticles = count($films);
                        // On détermine le nombre d'articles par page
                        $parPage = 6;
                        // On calcule le nombre de pages total
                        $pages = ceil($nbArticles / $parPage);
                        // echo $pages;
                        // Calcul du 1er article de la page
                        $firstt = ($currentPage * $parPage) - $parPage;
                        $sql = 'SELECT * FROM `film`  LIMIT :firstt, :parpage;';
                        // On prépare la requête
                        // connect($sql);connect
                        $query = $conn->prepare($sql);
                        $query->bindValue(':firstt', $firstt, PDO::PARAM_INT);
                      
                        $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
                        // On exécute
                        $query->execute();
                        // On récupère les valeurs dans un tableau associatif
                        $films = $query->fetchAll(PDO::FETCH_ASSOC);
                        // var_dump($films);

						foreach ($films as $film) {  ?>
                        <div class="card" style="width: 19.8rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $film["title"] ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $film["special_features"] ?></h6>
                                <p class="card-text"><?php echo $film["description"] ?></p>
                                <a href="film.show.php?id=<?= (int)$film["film_id"] ?>" class="card-link">Voir plus</a>
                            </div>
                        </div>
                        <?php
						}
						?>
                        <nav>
                            <span>Page : <?php 
                            if ($currentPage==1) {
                                echo " ";                                
                            }else {
                                echo'... ';  
                                echo $currentPage-1;
                                echo ' /';
                            }?>
                            <strong>
                                <?= $currentPage?>
                            </strong>
                            
                            <?php
                            if ($currentPage==$pages) {
                               echo"";
                            }else{
                                echo ' /';
                                echo $currentPage+1;
                                echo'... ';  
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