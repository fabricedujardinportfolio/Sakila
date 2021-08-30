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
echo template_header('Read all rental', 'rubrique2');
?>
<?php
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false) :
?>
<?php
    header("refresh:0; /login.php");
else :

    
    // // // // Shamps in Store 
    // store_id
    // manager_staff_id
    // address_id
?>
    <section>
        <div class="container pt-3 mt-5">
            <form action="" method="post">
                <h2>Formulaire pour un nouvel enregistrement</h2>
                <label for="magasin">Address du magasin de la location</label>
                <select name="stor" id="stor_id">
                    <?php   
                        $stores = Store::all();
                        foreach ($stores as $store) {
                            $StoreId = (int)$store['store_id'];  
                            $adressNames = Address::read($StoreId);
                            $adressName = $adressNames['address']; 
                            echo "<option value='$StoreId'>$adressName</option>";
                        }
                    ?>
                </select>
                <label for="staff">Manager qui effectue la location</label>
                <select>
                    <?php
                        foreach ($stores as $store) {
                            $StoreManager_staff_id = (int)$store['manager_staff_id'];
                            $staffId = Staff::read($StoreManager_staff_id);
                            $staffName = $staffId['first_name'];
                            echo "<option value='$StoreManager_staff_id'>$staffName</option>";
                        }
                    ?>
                </select>
                <label for="category">Catégory du film</label>
                <select name="" id="">
                    <?php 
                        $categorys = Category::all();
                        foreach ($categorys as $category) {
                            $categoryId = (int)$category['category_id'];
                            $categoryName = $category['name'];
                            echo "<option value='$categoryId'>$categoryName</option>";
                        }
                    ?>
                </select>
            </form>
        </div>
    </section>
<?php endif;
