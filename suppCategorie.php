<?php
	#Connexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
	}catch (PDOException $exception) {
		header("Location:404.php");
	}
	#Récupération de l'identifiant de la ligne
	$id = $_GET["id"];
	#Préparation de la requêtte de suppression
	$requette = $pdo->prepare("DELETE FROM t_categorie WHERE id_type=$id LIMIT 1");
	#Exécution de la requêtte
	$executionOK = $requette->execute();
	#Variable qui affiche un message d'érreur
	$message = "Suppression impossible";

	#Vérifier si la requêtte a été exécutée
	if ($executionOK)
		header("Location:categorie.php");
		else
			echo $message;
