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
    $staffId = (int)$_SESSION["staff_id"];
    $categorys = Category::all();
?>
    <section>
        <div class="container pt-3 mt-5">
                    <?php                       
                        $stores = Store::read($staffId);
                        $staff = Staff::read($staffId);
                        $addressId = (int)$stores['address_id'];
                        $adressNames = Address::read($addressId);
                        $adressName = $adressNames['address']; 
                        echo "<option value='$addressId'></option>";
                    ?>
            <form action="" method="post">
                <h2>Formulaire pour un nouvel enregistrement</h2>
                <label for="magasin">Address du magasin de la location <strong><?php echo $adressName?></strong></label><br>
                <label for="staff">Manager qui effectue la location <strong><?php echo $staff['username'] ;?></strong></label><br>
                <label for="category">Catégory du film</label>
                <select name="" id="">
                    <?php 
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
