<?php
    #Démarrage de la session
    session_start();
    #Connexion à la base de données
	try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }
    $message = "";
    #Si on reçoit une demande de type POST
    if (isset($_POST["connexion"])){
        $email = htmlspecialchars($_POST["email"]);
        $mot_de_passe = htmlspecialchars($_POST["mdp"]);
        $role = htmlspecialchars($_POST["role"]);
        #Vérifier si les champs ne sont pas vides
        if (!empty($email) and !empty($mot_de_passe)){
            #Préparation de la requêtte
            $requette = $pdo->prepare("SELECT id_utilisateur,email,mot_de_passe,role_user FROM t_utilisateur WHERE email=? AND mot_de_passe=? AND role_user=?");
            #Exécution de la requêtte
            $requette->execute(array($email,$mot_de_passe,$role));
            #Vérifier si la ligne affectée est supérieure à 0
            if ($requette->rowCount() > 0){
               #Vérifier si l'utilisateur est un admin
               if ($role == "admin"){
                    $_SESSION["mail"]=$email;
                    $_SESSION["mot_de_passe"]=$mot_de_passe;
                    $_SESSION["id_utilisateur"]=$requette->fetch()["id_utilisateur"];
                    #Redirection sur la page admin.php
                    header("Location:tableau.php");
                }else{#Sinon invité
                    $_SESSION["email"]=$email;
                    $_SESSION["mot_de_passe"]=$mot_de_passe;
                    $_SESSION["id_utilisateur"]=$requette->fetch()["id_utilisateur"];
                    #Redirection sur la page client.php
                    header("Location:client.php");
               }
            }#Sinon on affiche un message d'erreur
            else{
                $message = "<span id='alert'>Email ou mot de passe incorrectes !</span>";
            }
        }#Sinon on affiche un mesage d'erreur
        else{
            $message = "<span id='alert'>Entrez l'email et le mot de passe</span>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Connexion</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
        <form action="#" method="POST">
            <h1>Authentification</h1>
            <?php
                if (isset($message))
                    echo $message;
            ?>
            <label>Email</label>
            <input type="email" name="email" id="">
            <label>Mot de passe</label>
            <input type="password" name="mdp" id="">
            <select name="role" id="">
                <option value="admin">admin</option>
                <option value="user">user</option>
            </select>
            <input type="submit" value="Connexion" name="connexion">
            <a href="forgot_password.php">Mot de passe oublié ?</a>
        </form>
</body>
</html>  