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
echo template_header('Ajouter une réservation', 'rubrique3');
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
    $dateEnglish = date('d-m-Y');
    $unixTime = time();
    $timeZone = new \DateTimeZone('Pacific/Noumea');
    $dateNow = date('Y-m-d H:i:s');
    $time = new \DateTime();
    $time->setTimestamp($unixTime)->setTimezone($timeZone);
    $formattedTime = $time->format('d/m/YTH:i:s');
?>
    <main class="form-signin text-center container mt-4">
        <form action="" method="post" name="fo" class="mt-5 pt-5">
            <p class="mt-5 pt-5"><strong>LOCALOCA-NC Staff numéro :<?php echo $_SESSION["staff_id"] ?></strong></p>
            <h1 class="h3 mb-3 fw-normal mt-4 pt-4">Nouvel réservation</h1>
            <div class="d-flex">
                <div class="col-3"></div>
                <div class="m-auto col-6">
                    <!-- haut -->
                    <div class="col-md-12">
                        <div class="my-3 row">
                            <div class="col-3"></div>
                            <div class="col-6">

                                <label for="search-box" class="form-label">Client du magasin</label>
                                <div class="frmSearch">
                                    <input type="text" class="d-none" id="customerId" name="customerId">
                                    <input type="text" id="search-box" class="form-control" placeholder="Chercher un client" required autocomplete="off" />
                                    <div id="suggesstion-box"></div>
                                </div>
                                <div id="hide1" class="container">
                                    <span>Ou</span><br>
                                    <a href="addCustomer.php">
                                        <button type="button" class="btn btn-primary">Ajouter un client</button>
                                    </a>
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
                                </div>
                                <div class="col-3"></div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <?php
                                $Staff = Staff::read($staff_id);
                                // 
                                ?>
                                <input type="text" class="d-none" name="staff_id" value="<?php echo $Staff['staff_id'] ?>" readonly="readonly">
                                <label for="manager" class="form-label">Manager</label>
                                <input type="text" value="<?php echo $Staff['last_name'] ?> <?php echo $Staff['first_name'] ?>" disabled>
                                <div class="invalid-feedback">
                                    Please select a valid Manager.
                                </div>
                            </div>
                            <!-- Droite -->
                            <div class="col-md-12">
                                <div id="hide2" class="my-3 ">
                                    <div class="form-check">
                                        <input id="stor1" name="inventory" type="radio" value="1" class="form-check-input radio">
                                        <label class="form-check-label" for="credit">Magasin 1</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="stor2" name="inventory" type="radio" class="form-check-input radio" value="2">
                                        <label class="form-check-label" for="debit">Magasin 2</label>
                                    </div>
                                </div>
                                <label for="film" class="form-label">Film de l'inventaire du magasin</label>
                                <div class="frmSearch-2">
                                    <div class="container " id="containerFilm">
                                        <input type="text" value="" class="d-none" id="search-box-1-id" name="filmId" required readonly="readonly" />
                                    </div>
                                    <input type="text" id="search-box-1" class="form-control d-none" placeholder="Chercher un Film" autocomplete="off" />
                                    <input type="text" id="search-box-2" class="form-control d-none" placeholder="Chercher un Film" autocomplete="off" />
                                    <div id="suggesstion-box-2"></div>
                                    <input type="text" class="d-none" readonly="readonly" id="inventoryId" name="inventoryId">
                                    <div class="container">
                                        <div class="col-12">
                                            <input type="text" required value="<?php echo $dateNow ?>" name="rentalDate" id="rentalDate" class="d-none">
                                        </div>
                                        <div class="col-12 d-none" id="dateReturn">
                                            <label for="returnDate">Date de retour prévue dans les tranche de dates</label>
                                            <input type="date" class="form-control" required name="returnDate" id="returnDate" step="1" min="2021-09-23" max="2022-09-23">
                                            <input type="time" id="appt" name="heure" min="05:00" max="18:00" required step='1'>

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" id="envoyer" name="envoyer" class="btn btn-primary d-none">Envoyer</button>
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
        <?php
        //Rajout d'une réservation
        if ($_POST) {
            if ($_POST == true) {
                $staffId = (int)$_POST['staff_id'];
                $inventoryId = (int)$_POST['inventoryId'];
                $customerId = (int)$_POST['customerId'];
                $returnDate = $_POST['returnDate'];
                $returnDatePlusHeure = $returnDate . ' ' . $_POST['heure'];
                $rentalDate = $_POST['rentalDate'];
                $oldDate = strtotime($rentalDate);
                $newDaterental = date('Y-m-d H:i:s', $oldDate);
                $oldDateRetuneDate = strtotime($returnDatePlusHeure);
                $newDaterentalreturnDate = date('Y-m-d H:i:s', $oldDateRetuneDate);
                $date = new DateTime();
                $date->setTimestamp($oldDateRetuneDate);
                $oldDateReturneUpdate = $date->format('Y-m-d H:i:s');
                // rajouter une résa.
                $rental = Rental::add($newDaterental, $inventoryId, $customerId, $oldDateReturneUpdate, $staffId);
                echo "<div class='alert alert-success'>
                    <strong>Réservation réussit</strong>
                </div>";
            } else {
                echo "<div class='alert alert-danger'>
                    <strong>Erreur sur la Réservation</strong>
                </div>";
            }
        }
        ?>
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
            $('#hide2').removeClass("d-none");
        };
        //return de id du client de la réservation
        function selectCustomerid(val) {
            $("#customerId").val(val);
        };

        //film de l'inventaire 1
        function selectFilm(val) {
            $("#search-box-1").val(val);
            $("#suggesstion-box-2").hide();
            $('#containerFilm').removeClass("d-none");
            $('#envoyer').removeClass("d-none");
            $("#stor1").prop("readonly", true);
            $("#stor2").prop("readonly", true);

        }
        //film de l'inventaire 2
        function selectFilm2(val) {
            $("#search-box-2").val(val);
            $("#suggesstion-box-2").hide();
            $('#containerFilm').removeClass("d-none");
            $('#envoyer').removeClass("d-none");
            $("#stor1").prop("readonly", true);
            $("#stor2").prop("readonly", true);

        }
        //film id de l'inventaire 1
        function selectFilmId(val) {
            $("#search-box-1-id").val(val);
            $("#suggesstion-box-2").hide();
            $('#envoyer').removeClass("d-none");
            $("#stor1").prop("readonly", true);
            $("#stor2").prop("readonly", true);
        }
        //Affichage par étape pour validation des data de l'utilisateur
        function setInventaireId(val) {
            $("#inventoryId").val(val);
            $('#dateReturn').removeClass("d-none");
        }
        //methode ajax pour rendre un résulta dynamique en selectionnant l'inventaire 
        $('input[type="radio"]').click(function() {
            console.log($(this).val());
            var radio = $(this).val();
            if (radio == 1) {
                $('#search-box-1').removeClass("d-none");
                $('#search-box-2').addClass("d-none");
                $("#search-box-1").keyup(function() {
                    console.log($(this).val());
                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8000/API/ajaxInventory.php",
                        data: 'keyword=' + $(this).val(),
                        beforeSend: function() {
                            $("#search-box-1").css("background", "#FFF no-repeat 165px");
                        },
                        success: function(data) {
                            $("#suggesstion-box-2").show();
                            $("#suggesstion-box-2").html(data);
                            $("#search-box-1").css("background", "#FFF");
                        }
                    });
                });
            } else if (radio == 2) {
                $('#search-box-1').addClass("d-none");
                $('#search-box-2').removeClass("d-none");
                $("#search-box-2").keyup(function() {
                    console.log($(this).val());
                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8000/API/ajaxInventory2.php",
                        data: 'keyword=' + $(this).val(),
                        beforeSend: function() {
                            $("#search-box-2").css("background", "#FFF no-repeat 165px");
                        },
                        success: function(data) {
                            $("#suggesstion-box-2").show();
                            $("#suggesstion-box-2").html(data);
                            $("#search-box-2").css("background", "#FFF");
                        }
                    });
                });
            }
        });
    </script>
<?php endif;
