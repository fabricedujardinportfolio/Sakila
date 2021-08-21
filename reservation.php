<?php
if(isset($_GET['page-rental']) && !empty($_GET['page-rental'])){
    $currentPage = (int) strip_tags($_GET['page-rental']);
}else{
    $currentPage = 1;
}
require './helpers/Database.php';
require './functions.php';
require './classes/rental.php';
echo template_header('Read all rental','rubrique2');
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

 <?php 
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false):
    ?>
<?php
        header("refresh:0; /login.php");
    else: 
?>
<section>
    <div class="container pt-3 mt-5">
        <div class="row">
                    <?php
						$rentals = Rental::all();
                        $nbArentals = count($rentals);
                        // var_dump($rentals);
                        // On détermine le nombre de rental par page
                        $parPage = 6;
                        $pages = ceil($nbArentals / $parPage);
                        $firstt = ($currentPage * $parPage) - $parPage;
                        $sql = 'SELECT * FROM `rental`  LIMIT :firstt, :parpage;';
                        // On prépare la requête
                        // connect($sql);connect
                        $query = $conn->prepare($sql);
                        $query->bindValue(':firstt', $firstt, PDO::PARAM_INT);
                        $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
                        // On exécute
                        $query->execute();
                        // On récupère les valeurs dans un tableau associatif
                        $rentals = $query->fetchAll(PDO::FETCH_ASSOC);
						foreach ($rentals as $rental) {  ?>
                        <div class="card m-3" style="width: 21rem;">
                            <div class="card-body">
                                <h5 class="card-title">Numéro du client : <?php echo $rental['rental_id']?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Date de la résa :<br><strong><?php echo $rental["rental_date"]; ?></strong></h6>
                                <h6 class="card-subtitle mb-2 text-muted">Date du retour de la résa :<br><strong><?php echo $rental["return_date"]; ?></strong></h6>
                                <p class="card-text"></p>
                                <a href="rental.show.php?id=<?php echo $rental['rental_id']?>" class="card-link">Voir</a>
                            </div>
                        </div>
                        <?php
						}
					?>
                        <nav class="col-6">
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
                            <a href="/reservation.php/./?page-rental=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="/reservation.php/./?page-rental=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>                        
                    </ul>
                </nav>
                <div class="col-6 text-right">
                    <button type="button" class="btn btn-primary ">Ajouter une réservation</button>
                </div>
        </div>
    </div>
</section>
<?php endif;