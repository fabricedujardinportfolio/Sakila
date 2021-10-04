<?php
require '../helpers/Database.php';
require '../classes/Film.php';
  if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $request = '%' . $inpText . '%';
    $results = Film::readForAjax($inpText);
    if ($results) {
      foreach ($results as $row) {
        echo '<a href="film.show.php?id='.$row['film_id'].'" class="list-group-item list-group-item-action border-1">'. $row['title'] .' </a>';
      }
    } else {
      echo '<p class="list-group-item border-1">Aucun titre</p>';
    }
  }
