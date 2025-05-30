<?php
    #Démarrage de la session
    session_start();
   #Connexion à la base de données
   try{
       $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
   }catch (PDOException $exception) {
       header("Location:404.php");
   }
   $alert = "";
   $message = "";
   #Si on reçoit une requête de type POST
   if (isset($_POST["valider"])){
        $email = htmlspecialchars($_POST["email"]);
        #Vérifier si le champ email est vide
        if (!empty($email)){
            #Préparation de la requête de selection
            $selection = $pdo->prepare("SELECT * FROM t_utilisateur WHERE email=?");
            #Exécution de la requête
            $selection->execute(array($email));
            #Vérifier si la ligne affectée est > 0
            if ($selection->rowCount() > 0 ){
                $_SESSION["adresse_mail"] = $email;
                $_SESSION["id"] = $selection->fetch()["id_utilisateur"];
                #Redirection sur la page new_passeword.php
                header("Location:new_passeword.php");              
            }else{#Sinon on affiche un message d'erreur
                $alert = "<span id='alert'>Cet email n'existe pas dans notre système</span>";
            }
        }else{ #Sinon on affiche un message d'erreur
            $alert = "<span id='alert'>Veuillez saisir votre email</span>";
        }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Mot de passe oublé</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
        <form action="#" method="POST">
            <h1>Mot de passe oublié</h1>
            <?php
                if (isset($alert))
                    echo $alert;
            ?>
            <?php
                if (isset($message))
                    echo $message;
            ?>
            <label>Email</label>
            <input type="email" name="email" id="">
            <input type="submit" value="Valider" name="valider">
            <a href="login.php">Retour connexion</a>
        </form>
</body>
</html>  