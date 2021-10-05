<?php
if (isset($_GET['page-rental']) && !empty($_GET['page-rental'])) {
    $currentPage = (int) strip_tags($_GET['page-rental']);
} else {
    $currentPage = 1;
}
require './helpers/Database.php';
require './functions.php';
require './classes/rental.php';
echo template_header('Toutes les réservations', 'rubrique2');
?>
<?php
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false) :
?>
<?php
    header("refresh:0; /login.php");
else :
?>
    <section>
        <div class="container pt-3 mt-5">
            <div class="row">
                <?php
                $server = $_SERVER['HTTP_HOST'];
                $rentals = Rental::all();
                $nbArentals = count($rentals);
                $parPage = 6;
                $pages = ceil($nbArentals / $parPage);
                $firstt = ($currentPage * $parPage) - $parPage;
                $rentals = Rental::allWidthLimit($firstt, $parPage);
                foreach ($rentals as $rental) {  ?>
                    <div class="card m-3" style="width: 21rem;">
                        <div class="card-body">
                            <h5 class="card-title">Réservation Numéro : <?php echo $rental['rental_id'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Date de la résa
                                :<br><strong><?php echo $rental["rental_date"]; ?></strong></h6>
                            <h6 class="card-subtitle mb-2 text-muted">Date du retour de la résa
                                :<br><strong><?php echo $rental["return_date"]; ?></strong></h6>
                            <p class="card-text"></p>
                            <a href="<?php $_SERVER['HTTP_HOST']; ?>/reservation.inventory.php/?id=<?php echo $rental['rental_id']; ?>" class="card-link">Voir</a>
                        </div>
                    </div>
                <?php
                }
                ?>
                <nav class="col-6">
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
                            <a href="/reservation.php/./?page-rental=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="/reservation.php/./?page-rental=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>
                <div class="col-6 text-right">
                    <a href="http://<?php echo $server ?>/reservation.add.php">
                        <button type="button" class="btn btn-primary ">Ajouter une réservation</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php endif;
