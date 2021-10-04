<?php
if (isset($_GET['page-rental']) && !empty($_GET['page-rental'])) {
    $currentPage = (int) strip_tags($_GET['page-rental']);
} else {
    $currentPage = 1;
}
require './helpers/Database.php';
require './functions.php';
require './classes/Category.php';
require './classes/Film.php';
require './classes/Actor.php';
require './classes/Rental.php';
require './classes/Staff.php';
require './classes/Store.php';
require './classes/Customer.php';
require './classes/Inventory.php';
require './classes/Address.php';
echo template_header('Read all rental', 'rubrique3');
?>
<?php
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false) :
?>
<?php
    header("refresh:0; /login.php");
else :
?>
    <main class="form-signin text-center container mt-4">
        <form action="reservationResult.php" method="post" name="fo">
            <p><strong>LOCALOCA-NC <?php echo $_SESSION["staff_id"] ?></strong></p>
            <h1 class="h3 mb-3 fw-normal">Nouvel réservation</h1>
            <?php

            var_dump($_POST);
            ?>
        <?php endif;
