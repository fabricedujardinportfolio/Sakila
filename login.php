<?php
require './helpers/Database.php';
require './functions.php';
require './classes/rental.php';
$db_host = "localhost";
$db_username = "fabrice";
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

// if(!isset($_SESSION["user_login"]))	//check condition user login not direct back to index.php page
// {
// 	header("location: ../index.php");
// }

echo template_header('Read','login');
if(isset($_REQUEST['valider']))	//button name is "btn_login"
{
    // var_dump($_POST);  
	$email		= strip_tags($_REQUEST["email"]);	//textbox name "txt_username_email"
	$password	= strip_tags($_REQUEST["password"]);		//textbox name "txt_password"
	if(empty($email)){
		$errorMsg[]="Merci de saisir votre adresse email";	//check "email" textbox not empty
	}
	else if(empty($password)){
		$errorMsg[]="Veuillez entrer un mot de passe";	//check "passowrd" textbox not empty
	}
	else
	{
		try
		{
			$select_stmt=$conn->prepare("SELECT * FROM `staff` WHERE staff.email=:uemail"); //sql select query
			$select_stmt->execute(array(':uemail'=>$email));	//execute query with bind parameter
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);	            
            var_dump($select_stmt);   		
			if($select_stmt->rowCount() > 0)	//check condition database record greater zero after continue
			{
				if($email==$row["email"]) //check condition user taypable "email" is match from database "email" after continue
				{            
					$_SESSION["active"] = $row["active"];
                    $active = $_SESSION["active"];
                    // var_dump($droit);
                    if ( $active=="1") {
                        if($password==$row["password"]) //check condition user taypable "password" is match from database "password" using password_verify() after continue
                        {
                            $_SESSION["last_name"] = $row["last_name"];
							$last_name = $_SESSION["last_name"];
							$_SESSION["first_name"] = $row["first_name"];
							$first_name = $_SESSION["first_name"]; 
							$_SESSION["email"] = $row["email"];
							$email = $_SESSION["email"];             
							$_SESSION["username"] = $row["username"];
							$username = $_SESSION["username"];
							// var_dump($agents_app_id); 
							// var_dump($applications_id);        
                            //session name is "user_login"
                            $_SESSION["loggedIn"] = true;
                            $loginMsg = "Connexion réussie...";		//user login success message
                            header("refresh:2; ../index.php");			//refresh 2 second after redirect to "welcome.php" page
                        }
                        else{                            
						$errorMsg[]="Le mot de passe n'existe pas";
                        }
                    }
					
					else
					{
						$errorMsg[]="Vous n'avez pas les droits";
					}
				}
				else
				{
					$errorMsg[]="Adresse email invalide";
				}
			}
			else
			{
				$errorMsg[]="Veuillez entrer une adresse email valide ";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}		
	}
}
?>
<!-- SCRIPT ICI -->
</head>
<body>
<div class="container">
    <div class="container d-flex mt-4 h-mini-90">
        <div class="col-lg-6 m-auto">
            <?php
            if(isset($errorMsg))
            {
                foreach($errorMsg as $error)
                {
                ?>
                    <div class="alert alert-danger">
                        <strong><?php echo $error; ?></strong>
                    </div>
                <?php
                }
            }
            if(isset($loginMsg))
            {
            ?>
                <div class="alert alert-success">
                    <strong><?php echo $loginMsg; ?></strong>
                </div>
            <?php
            }
            ?>
            <form action="" method="post" name="fo">
                <!-- <div class="erreur"><?php echo $erreur ?></div> -->  
                <div class="text-center">
                <h1><strong class="text-uppercase">Gestion des locations</strong></a></h1>
                </div>
                <h2 class="h3 mb-3 font-weight-normal text-center">Veuillez vous connecter<hr></h2>
                <div class="form-group">
                    <label for="loginEmail" class="pb-1"><strong>Email :</strong></label>
                    <input type="email" class="form-control" id="loginEmail"  placeholder="Entrer votre email" name="email">
                </div>
                <div class="form-group pt-2">
                    <label for="Passwordid" class="pb-1"><strong>Mot de passe :</strong></label>
                    <input type="password" class="form-control" id="Passwordid" placeholder="Entrer votre mot de passe" name="password">
                </div>
                <div class="text-center  mb-3">
                <button class="btn btn-lg btn btn-primary btn-block mt-4 text-center" type="submit" name="valider" value="S'authentifier" style="background-color:#2e4f9b;color:white;">S'identifier</button>
                </div> 
            </form>