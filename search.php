<?php

require './helpers/Database.php';
require './functions.php';
require './classes/rental.php';
require './classes/Category.php';
require './classes/Film.php';
echo template_header('Faire une recherche', 'rubrique6');
?>
<?php
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == false) :
?>
<?php
  header("refresh:0; /login.php");
else :
?>
  <div class="container mt-5 pt-5">
    <div class="row mt-4">
      <div class="col-md-8 mx-auto bg-light rounded p-4">
        <h5 class="text-center font-weight-bold">Recherche en saisie semi-automatique par titre</h5>
        <hr class="my-1">
        <h5 class="text-center text-secondary">Écrivez n'importe quel film connue de votre BDD dans la zone de recherche</h5>
        <form action="details.php" method="post" class="p-3">
          <div class="input-group">
            <input type="text" name="search" id="search" class="form-control form-control-lg rounded-0 border-info" placeholder="Rechercher..." autocomplete="off" required>
          </div>
        </form>
      </div>
      <div class="col-md-5" style="position: relative;margin-top: -38px;margin-left: 215px;max-height: 300px; overflow: auto;">
        <div class="list-group" id="show-list" style="overflow: auto;">
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      // Send Search Text to the server
      $("#search").keyup(function() {
        let searchText = $(this).val();
        if (searchText != "") {
          $.ajax({
            url: "API/action.php",
            method: "post",
            data: {
              query: searchText,
            },
            success: function(response) {
              $("#show-list").html(response);
            },
          });
        } else {
          $("#show-list").html("");
        }
      });
      // Set searched text in input field on click of search button
      $(document).on("click", "a", function() {
        $("#search").val($(this).text());
        $("#show-list").html("");
      });
    });
  </script>
<?php endif;
