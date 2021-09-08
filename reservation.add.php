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
    $server = $_SERVER['HTTP_HOST'];
    $stores = Store::all();
    $staff_id = (int)$_SESSION["staff_id"];
?>
    <main class="form-signin text-center container mt-4">
        <form>
            <p><strong>LOCALOCA-NC <?php echo $_SESSION["staff_id"] ?></strong></p>
            <h1 class="h3 mb-3 fw-normal">Nouvel réservation</h1>
            <div class="d-flex">
                <div class="col-3"></div>
                <div class="m-auto col-6">
                    <!-- haut -->
                    <div class="col-md-12">
                        <div class="my-3 row">
                            <div class="col-3"></div>
                            <div class="col-6">

                                <label for="film" class="form-label">Client du magasin</label>
                                <div class="frmSearch">
                                    <input type="text" id="search-box" class="form-control" placeholder="Chercher un client" required />
                                    <div id="suggesstion-box"></div>
                                </div>
                                <div id="hide1" class="container">
                                    <span>Ou</span><br><button type="button" class="btn btn-primary">Ajouter un client</button>
                                </div>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-3"></div>
                        </div>
                        <div id="container-2" class="container d-none">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-6">
                                    <label for="store_id" class="form-label">Store</label>
                                    <select class="form-select" id="store_id" required="">
                                        <?php
                                        foreach ($stores as $store) {
                                            $StoreId = (int)$store['store_id'];
                                            $adressNames = Address::read($StoreId);
                                            $adressName = $adressNames['address'];
                                            echo "<option value='$StoreId'>$adressName</option>";
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid store.
                                    </div>
                                </div>
                                <div class="col-3"></div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <?php
                                $Staff = Staff::read($staff_id);
                                // 
                                ?>
                                <input type="text" class="d-none" name="staff_id" value="<?php echo $Staff['staff_id'] ?>" disabled>
                                <label for="manager" class="form-label">Manager</label>
                                <input type="text" value="<?php echo $Staff['last_name'] ?> <?php echo $Staff['first_name'] ?>" disabled>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                            <!-- Droite -->
                            <div class="col-md-12">
                                <div id="hide2" class="my-3 d-none">
                                    <div class="form-check">
                                        <input id="credit" name="inventory" type="radio" value="1" class="form-check-input" checked="" required>
                                        <label class="form-check-label" for="credit">Inventaire 1</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="debit" name="inventory" type="radio" class="form-check-input" value="2" required>
                                        <label class="form-check-label" for="debit">Inventaire 2</label>
                                    </div>
                                </div>
                                <label for="film" class="form-label">Client du magasin</label>
                                <div class="frmSearch-2">
                                    <input type="text" id="search-box-2" class="form-control" placeholder="Chercher un client" required />
                                    <div id="suggesstion-box-2"></div>
                                </div>
                                <div id="hide3" class="row d-none">
                                    <div class="col-3"></div>
                                    <div class="col-6">
                                        <label for="film" class="form-label">Film de l'inventaire</label>
                                        <input type="text" class="form-control" id="film" placeholder="Chercher un film " value="" required>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            </div>
        </form>
    </main>
    <script>
        // AJAX call for autocomplete 
        $(document).ready(function() {
            $("#search-box").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8000/API/ajaxCustomer.php",
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function() {
                        $("#search-box").css("background", "#FFF no-repeat 165px");
                    },
                    success: function(data) {
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        $("#search-box").css("background", "#FFF");
                    }
                });
            });
        });
        //To select customer name
        function selectCustomer(val) {
            $("#search-box").val(val);
            $("#suggesstion-box").hide();
            $('#hide1').addClass("d-none");
            $('#container-2').removeClass("d-none");
        }
        $('#store_id').change(function() {
            // Correct data           
            $("#store_id").prop("disabled", true);
            $('#container-2').removeClass("d-none");
            $('#hide2').removeClass("d-none");
        });

        $('input[type="radio"]').click(function() {
            // Select all film by inventory value   
            console.log($(this).val());            
           var radio = $(this).val();   
            $.ajax({
                type: "POST",
                url: "http://localhost:8000/API/ajaxInventory.php",
                data:{radio:radio},
                success: function(data) {
                    console.log(data);
                    $("#suggesstion-box-2").show();
                    $("#suggesstion-box-2").html(data);
                    $("#search-box-2").css("background", "#FFF");
                }
            });
        });
        function selectInventory(value) {
            $("#suggesstion-box-2").val(value);
            // $('#hide3').removeClass("d-none");
        }
    </script>
<?php endif;
