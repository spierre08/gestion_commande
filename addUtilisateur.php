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
    $erreur = "";

    #Si on reçoit une demande de type Post
    if (isset($_POST["ajouter"])){ 
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $email = htmlspecialchars($_POST["email"]);
        $mot_de_passe = htmlspecialchars(($_POST["mot_de_passe"]));
        $role = htmlspecialchars($_POST["role"]);

        $role_get = $role;
        #Vérifier si les champs ne sont pas vides
        if (!empty($pseudo) and !empty($email) and !empty($mot_de_passe)){
            #Vérifier si le mot de passe contient pas 8 caractères
                if (strlen($mot_de_passe) < 8){
                    $erreur = "<span id='alert'>Le mot de passe doit contenir 8 caractères</span>";
                }else{ #Sinon on affiche un passe à l'insertion
                    #Préparation de la requette de selection
                    $selection = $pdo->prepare("SELECT * FROM t_utilisateur WHERE pseudo=? OR email=?");
                    #Exécution de la requêtte de selection
                    $selection->execute(array($pseudo,$email));
                    #compteur de doublon
                    $resultat = $selection->rowCount();
                    if ($resultat == 1){
                        $erreur = "<span id='alert'>Pseudo ou email existant</span>";
                    }else{
                         #Préparation de la requêtte d'insertion
                    $insertion = $pdo->prepare("INSERT INTO t_utilisateur(pseudo,email,mot_de_passe,role_user,token) VALUES(?,?,?,?,?)");
                    #Exécution de la requêtte
                    $insertion->execute(array($pseudo,$email,$mot_de_passe,$role,NULL));
                    $message = "<span id='erreur'>Ajout effectué !</span>";
                    } 
                }
                
        }else{#Sinon on affiche un messagee d'erreur
            $erreur = "<span id='alert'>Veuillez compléter ces informations</span>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Nouvel Utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrap">
        <!-- =======Menu vertical======== -->
        <div class="slide_bar">
            <h1>G<span>commandes</span></h1>
            <?php
                if (!$_SESSION["mot_de_passe"]){
                    header("Location:login.php");
                }
            ?>
            <span id="account"><?php echo $_SESSION["mail"]; ?></span>
            <hr>
            <div class="slide_list">
                    <a href="tableau.php">
                        <img src="icone/dashbord.png" alt="">
                        <span>Administration</span>
                    </a>
                    <a href="adminClient.php">
                        <img src="icone/client.png" alt="">
                        <span>Clients</span>
                    </a>
                    <a href="adminCommande.php">
                        <img src="icone/commande.png" alt="">
                        <span>Commandes</span>
                    </a>
                    <a href="adminDetail.php">
                        <img src="icone/detail.png" alt="">
                        <span>Détails</span>
                    </a>
                    <a href="adminArticle.php">
                        <img src="icone/article.png" alt="">
                        <span>Articles</span>
                    </a>
            </div>
        </div>
        <!-- ===========Menu vertical========== -->
        <div class="header">
            <div class="sub_option">
                <div class="menu_icon_1"></div>
                <div class="menu_icon"></div>
                <span style="font-weight: 600;"><?php echo $_SESSION["mail"]; ?></span>
            </div>
            <div class="subMenu_item">
                <!-- ==============Bouton déconnexion========== -->
                <a href="deconnexion.php" id="disconnect">
                    <img src="icone/deconnexion.png" alt="">
                    <span>Déconnexion</span>
                </a>
            </div>
        </div>
        <!-- =========Main========= -->
        <div class="main"  style="height: 70vh;">
            <div class="main_option">
                <h1>Nouvel utilisateur</h1>
                <div class="main_sub_option">
                    <a href="utilisateur.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <form action="#" method="POST">
                    <?php
                        if (isset($message))
                            echo $message;
                    ?>
                    <?php
                        if (isset($erreur))
                            echo $erreur;
                    ?>
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" id="" placeholder="exemple Simon08">
                    <label>Email</label>
                    <input type="email" name="email" id="" placeholder="example@gmail.com">
                    <label>Mot de passe</label>
                    <input type="password" name="mot_de_passe" id="" placeholder="8 caractères minimum">
                    <label>Rôle</label>
                    <select name="role" id="">
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>
                    <input type="submit" value="Ajouter" name="ajouter">
                </form>
            </div>
            <div class="footer" style="margin-top: 60px;">
                <span id="footer">© 2023 by Cyborg of Web</span>
            </div>
        </div>
    </div>
            <!-- ========Code source Javascript========= -->
 <script src="script.js"></script>
</body>
</html>