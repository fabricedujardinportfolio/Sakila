<?php
require '../helpers/Database.php';
require '../functions.php';
require '../classes/Inventory.php';
require '../classes/Film.php';
if (!empty($_POST["keyword"])) {
    $state = 1;
    $key = $_POST["keyword"];
    $querys = Inventory::readByStore($state);
    if (!empty($querys)) {
        $i = 1;
        $queryCount = count($querys);
        while ($i <= $queryCount) {
            foreach ($querys as $films) { ?>
                <ul id="film-list">
                    <?php
                    $invetoryId = $films['inventory_id'];
                    $film_ids = (int)$films['film_id'];
                    $filmss = Film::readForAjaxAndId($film_ids, $key);
                    foreach ($filmss as $film) {
                    ?>
                        <li onClick="selectFilm('<?php echo $film['title']; ?>');selectFilmId('<?php echo (int)$film["film_id"]; ?>');setInventaireId('<?php echo (int)$invetoryId; ?>');"><?php echo $film['title']; ?></li>
                    <?php
                    } ?>
                </ul>
<?php
                $i++;
            }
        }
    }
}
?>