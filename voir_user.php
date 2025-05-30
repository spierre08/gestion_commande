<?php
     #Démarrage de la session
     session_start();
    #Connexion à la base de données
	try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }
    #Préparation de la requêtte de selection
    $requette = $pdo->prepare("SELECT id_utilisateur,pseudo,email,mot_de_passe,role_user,token FROM t_utilisateur WHERE id_utilisateur=:num LIMIT 1");
    #Liaison du paramètre nommé par méthode get
    $requette->bindValue(':num',$_GET['id'],PDO::PARAM_INT);
    #Exécution de la requêtte
    $execution = $requette->execute();

    $valeur = $requette->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Information Utilisateur</title>
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
                <h1>Info sur l'utilisateur</h1>
                <div class="main_sub_option">
                    <a href="utilisateur.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <form action="#" method="POST">
				<input type="hidden" value="<?= $valeur['id_utilisateur'] ?>" >
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" id="" disabled value="<?= $valeur['pseudo'] ?>">
                    <label>Email</label>
                    <input type="email" name="email" id="" disabled value="<?= $valeur['email'] ?>">
                    <label>Mot de passe</label>
                    <input type="password" name="mot_de_passe" id="" disabled value="<?= $valeur['mot_de_passe'] ?>">
                    <label>Rôle</label>
                    <input type="text" name="role" id="" disabled value="<?= $valeur['role_user'] ?>">
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