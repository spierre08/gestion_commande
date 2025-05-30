<?php
	#Connexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
	}catch (PDOException $exception) {
		header("Location:404.php");
	}
	#Récupération de l'identifiant par la méthode GET
	$id = $_GET["id"];
	#Préparation de la requêtte de suppression
	$requette = $pdo->prepare("DELETE FROM t_utilisateur WHERE id_utilisateur=$id");
	#Exécution de la requêtte
	$executionOk = $requette->execute();
	#Variable qui affiche un message d'erreur
	$message = "Suppression impossible";
	#Vérifier si la requêtte a été exécutée
	if ($executionOk)
		#Redirection à la page utilisateur.php
		header("Location:utilisateur.php");
		#Sinon on affiche un message d'erreur
		else
			echo $message;