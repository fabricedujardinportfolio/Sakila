<?php
require '../helpers/Database.php';
require '../functions.php';
require '../classes/Inventory.php';
if (!empty($_POST["radio"])) {
    $state = (int)$_POST["radio"];
    // var_dump($state);
    $querys = Inventory::readByStore($state);
    // var_dump($querys);
    if (!empty($querys)) {
?>
        <ul id="inventory-list">
            <?php
            // var_dump($querys);
            foreach ($querys as $customer) {
                $i =0;
                $film_ids = (int)$customer['film_id'];
                $exclude = array($film_ids);
            //    var_dump($film_ids);
                for ($i = 1; $i >= 1; $i++) {
                    if (in_array($i, $exclude)) continue;
                    var_dump($customer['film_id']);
                }
            //    if ($film_ids == $customer['film_id']) {
            //         $i--;
            //         var_dump($i);
            //    } else {
            //        echo("stop");
            //    }
            ?>

                <li onClick="selectInventoryByStore('<?php echo $customer["film_id"]; ?>');"><?php echo $customer["film_id"]; ?></li>
            <?php } ?>
        </ul>
<?php }
} ?>