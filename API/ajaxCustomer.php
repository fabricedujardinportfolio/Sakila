<?php
require '../helpers/Database.php';
require '../functions.php';
require '../classes/Customer.php';
if (!empty($_POST["keyword"])) {
    $key = $_POST["keyword"];
    $querys = Customer::readByLike($key);
    if (!empty($querys)) {
?>
        <ul id="country-list">
            <?php
            foreach ($querys as $customer) {
            ?>
                <li onClick="selectCustomer('<?php echo $customer["last_name"]; ?>');selectCustomerid('<?php echo $customer["customer_id"]; ?>');"><?php echo $customer["last_name"]; ?></li>
            <?php } ?>
        </ul>
<?php }
} ?>