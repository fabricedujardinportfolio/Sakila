<?php
session_start();
session_destroy();
echo 'Vous avez été déconnecté. <a href="login.php"> Revenir en arrière </a>';