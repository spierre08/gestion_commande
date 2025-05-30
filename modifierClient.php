<?php
	#Connexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
	}catch (PDOException $exception) {
		header("Location:404.php");
	}
	#Préparation de la requêtte de mise à jour
	$mod = $pdo->prepare("UPDATE t_client SET nom_client=:nom,prenom_client=:prenom,tel_client=:tel,email_client=:email,adresse_client=:adresse WHERE id_client=:id");
	#Liaison avec les paramètres nommés par la méthode 
	$mod->bindParam(':id',$_POST["id"],PDO::PARAM_INT);
	$mod->bindParam(':nom',$_POST["nom"],PDO::PARAM_STR);
	$mod->bindParam(':prenom',$_POST["prenom"],PDO::PARAM_STR);
	$mod->bindParam(':tel',$_POST["tel"],PDO::PARAM_INT);
	$mod->bindParam(':email',$_POST["email"],PDO::PARAM_STR);
	$mod->bindParam(':adresse',$_POST["adresse"],PDO::PARAM_STR);
	#Exécution de la requêtte
	$executionOk = $mod->execute();
	#Variable affichant un message d'erreur
	$message = "Modification échouée";
	#Vérifier si la requêtte a été modifiée
	if ($executionOk)
		#Redirection sur la page adminClient.php
		header("Location:adminClient.php");
		#Sinon on affiche un message d'erreur
		else
			echo $message;