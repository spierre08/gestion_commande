<?php
	#Démarrage de la session
	session_start();
	#Initialsiation de la session à 0
	session_unset();
	#Destruction de la session
	session_destroy();
	#Redirection sur la page de connexion
	header("Location:login.php");
?>