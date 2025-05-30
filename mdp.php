<?php
	#Connexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
	}catch (PDOException $exception) {
		header("Location:404.php");
	}
	#Variable affichant un message d'erreur
	$message = "";
	#Si on reçoit une demande type POST
	if (isset($_POST["changer"])){
		$nouveau_mot_passe = htmlspecialchars($_POST["mdp"]);
		$confirmation = htmlspecialchars($_POST["mdp_1"]);
		#Vérifier si les deux champs ne sont pas vides
		if (!empty($nouveau_mot_passe) and !empty($confirmation)){
			#Vérifier le mot de passe et confirmation sont conformes
			if ($nouveau_mot_passe == $confirmation){
				#Vérifier si la taille de nouveau mot de passe est >= 8
				if (strlen($nouveau_mot_passe) >= 8 or strlen($confirmation) >= 8){
					#Récupération de l'email
					$getting = $_GET["email"];
					#Préparation de la requête de mise à jour
					$update = $pdo->prepare("UPDATE t_utilisateur SET mot_de_passe=$confirmation WHERE email=?");
					#Exécution de la requêtte
					$update->execute(array($getting));
					#Redirection à la page de connexion
					header("Location:login.php");
				}else{
					$message = "<span id='alert'>Le mot de passe doit contenir 8 caractères</span>";
				}
			}else{
				$message = "<span id='alert'>Mot de passe et confirmation non conforme</span>";
			}
		}else{
			$message = "<span id='alert'>Entrez le nouveau mot de passe et puis confirmer</span>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Lien</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
        <form action="#" method="POST">
		   <h1>Nouveaut mot de passe</h1>
		   <?php
		   		if (isset($message))
					echo $message;
		   ?>
	   	  <label>Nouveau mot de passe</label>
            <input type="password" name="mdp" id="">
		  <label>Confirmation</label>
            <input type="password" name="mdp_1" id="">
		  <input type="submit" value="Changer" name="changer">
            <a href="login.php">Retour connexion</a>
        </form>
</body>
</html> 