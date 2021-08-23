<?php
require './helpers/Database.php';
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "secret";
    $db_name="sakila";	//database name

try {
    $conn = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_username, $db_password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<!--ok-->";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }


  if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql = 'SELECT title FROM film WHERE title LIKE :film';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['film' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();
    if ($result) {
      foreach ($result as $row) {
        echo '<a href="#" class="list-group-item list-group-item-action border-1">'. $row['title'] .' </a>';
      }
    } else {
      echo '<p class="list-group-item border-1">Aucun titre</p>';
    }
  }
?>