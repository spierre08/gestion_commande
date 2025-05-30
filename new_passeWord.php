<?php
	session_start();
	if (!$_SESSION['adresse_mail'] ){
		header("Location:login.php");
	 }
	 $mail = $_SESSION['adresse_mail'];
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
        <form action="#" method="POST" style="height:300px;">
            <label>Cliquez sur ce lien pour changer de mot de passe</label>
            <a href="mdp.php?email=<?= $mail; ?>">Cliquez moi</a>
        </form>
</body>
</html>  