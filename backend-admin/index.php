<?php
session_start();
$message = '';
require_once('cnx.php');
if(isset($_POST['login'])) {
// Si PSEUDO ou PASSWORD est vide	
	if(empty($_POST['pseudo']) || empty($_POST['password'])) {
		$message = 'Merci de remplir les champs du formulaire';
	} else { // Si PSEUDO et PASSWORD sont remplis
		$sql = "SELECT * FROM admin
		WHERE pseudo = :pseudo AND password = :password";
		$req = $cnx->prepare($sql);
		$req->execute(
			array('pseudo'   => $_POST['pseudo'],
				'password' => $_POST['password'])
		);
        $count = $req->rowcount();
        
// Si le couple Pseudo/Password est trouvé		
		if($count > 0) {
			$_SESSION['pseudo'] = $_POST['pseudo']; 
			
			$donnee = $req->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $donnee['id'];
			header('location:dashboard/realisations');
		} else {
// Si le couple Pseudo/Password N'est PAS trouvé
			$message = 'Accès refusé !';
		}
    }
    
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administration</title>
<meta name="viewport" content="width=device-width, intial-scale=1.0" />
<link rel="stylesheet" href="style.css" />
</head>

<body>
<div id="container">
    <div class="login">
        <form method="post" action="">
        <h1>Espace Administration</h1>
        <p class="acces">Veuillez rentrer vos identifiants.</p>
            <p>
            <input class="champ" type="text" name="pseudo" placeholder="Pseudo" />
            </p>
            <p>
            <input class="champ" type="password" name="password" placeholder="Password" />
            </p>
            <div class="loginbottom">
            <input class="bt" type="submit" name="login" value="Login" />
            
        <?php
        if(isset($message)) {
            echo '<p class="msg">'.$message.'</p>';
        }
        ?>  
        </div> 
        </form>
    </div>
</div>
</body>
</html>