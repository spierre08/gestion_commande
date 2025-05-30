<?php
	#Connexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
	}catch (PDOException $exception) {
		header("Location:404.php");
	}
	#Préparation de la requêtte de mise à jour
	$mod = $pdo->prepare("UPDATE t_article SET libelle=:libelle,type=:categorie WHERE id_article=:id");
	#Liaison avec les paramètres nommés par la méthode 
	$mod->bindParam(':id',$_POST["id"],PDO::PARAM_INT);
	$mod->bindParam(':libelle',$_POST["libelle"],PDO::PARAM_STR);
	$mod->bindParam(':categorie',$_POST["categorie"],PDO::PARAM_STR);
	#Exécution de la requêtte
	$executionOK = $mod->execute();
	#Varible affichant un message d'erreur
	$message = "Modification échouée";
	#Vérifier si la requêtte a été exécutée
	if ($executionOK)
		header("Location:adminArticle.php");
		#Sinon on affiche un messsage d'erreur
		else
			echo $message;
