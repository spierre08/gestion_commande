<?php
    #Démarrage de la session
    session_start();
    #Connexion à la base de données
	try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Administration</title>
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
                    <a href="utilisateur.php">
                        <img src="icone/user.png" alt="">
                        <span>Utilisateurs</span>
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
        <div class="main" style="height: 76vh;">
            <div class="main_option">
                <h1>Administration</h1>
                <div class="main_sub_option">
                    <a href="categorie.php">Catégorie</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <div class="main_statistif">
                    <div class="main_card">
                        <img src="icone/somme.png" alt="" srcset="" >
                        <?php
                            #Préparation de la requêtte de la somme des prix
                            $req_somme = $pdo->query("SELECT SUM(prix_unittaire) AS somme FROM t_ligne");
                            #Boucle de parcour de la sommation
                            while($req_sommes = $req_somme->fetch()):
                        ?>
                        <span style="font-weight: 600;"><?php echo number_format($req_sommes["somme"],0,","," "); ?></span>
                        <?php
                            endwhile;
                        ?>
                    </div>
                    <div class="main_card">
                        <?php
                            #Preparation de la requêtte du nombre de client
                            $req_client = $pdo->query("SELECT COUNT(*) AS total FROM t_client");
                            #Boucle de parcour
                            while($req_clients = $req_client->fetch()):
                        ?>
                        <img src="icone/client.png" alt="" srcset="" >
                        <span style="font-weight: 600;"><?php echo $req_clients["total"]; ?></span>
                        <?php 
                            endwhile;
                        ?>
                    </div>
                    <div class="main_card">
                        <?php
                            #Préparation de la requêtte du nombre de commande 
                            #Livrée
                            $req_commande = $pdo->query("SELECT COUNT(*) AS livraison FROM t_commande WHERE etat=2");
                            #Boucle de parcour 
                            while($req_commandes = $req_commande->fetch()):
                        ?>
                        <img src="icone/commande.png" alt="" srcset="" >
                        <span><?php echo $req_commandes["livraison"]; ?></span>
                        <?php
                            endwhile;
                        ?>
                    </div>
                </div>
            </div>
            <div class="footer">
                    <span id="footer">© 2023 | Simon Pierre SAGNO</span>
            </div>
        </div>
    </div>
    <!-- ========Code source Javascript========= -->
    <script src="script.js"></script>
</body>
</html>