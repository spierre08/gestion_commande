<?php
	#Connexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
	}catch (PDOException $exception) {
		header("Location:404.php");
	}
	#Récupération de l'identifiant par la méthode get
	$id = $_GET["id"];
	#Préparation de la requêtte de suppression
	$requette = $pdo->prepare("DELETE FROM t_article WHERE id_article=$id LIMIT 1");
	#Exécution de la requêtte
	$executionOk = $requette->execute();
	#Variable qui permet d'afficher un messsage d'erreur
	$message = "Suppression impossible";
	#Vérifier si la requêtte a été exécutée
	if ($executionOk)
	   header("Location:adminArticle.php");
	   #Sinon on affiche un message d'erreur
	   else
	   	echo $message;   