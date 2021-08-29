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
echo template_header('Read all rental', 'rubrique2');
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
            <form action="" method="post">
                <h2>Formulaire pour un nouvel enregistrement</h2>
                <label for="magasin"></label>
                <select name="stor" id="stor_id">
                    <?php   
                        $stores = Store::all();
                        var_dump($stores);
                        foreach ($stores as $store) {
                            var_dump($store);
                            echo'<option value=""></option>';
                        }
                    ?>
                    <option value=""></option>
                </select>
                <label for="staff"></label>
            </form>
        </div>
    </section>
<?php endif;
