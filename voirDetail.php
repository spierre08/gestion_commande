<?php
    #Démarrage de la session
    session_start();
    #Connexion à la base de données
	try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }

    #Préparation de la reuêtte de selection
    $requette = $pdo->prepare("SELECT id_ligne,id_commande,id_article,prix_unittaire,qte FROM t_ligne WHERE id_ligne=:id LIMIT 1");
    #Liaison avec le paramètre nommé avec la méthode get
    $requette->bindValue(':id',$_GET['id'],PDO::PARAM_INT);
    #Exécution de la requêtte
    $execution = $requette->execute();

    $valeur = $requette->fetch();
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Info détail commande</title>
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
            <span id="account"><?php echo $_SESSION["email"]; ?></span>
            <hr>
            <div class="slide_list">
                    <a href="client.php">
                        <img src="icone/client.png" alt="">
                        <span>Clients</span>
                    </a>
                    <a href="commande.php">
                        <img src="icone/commande.png" alt="">
                        <span>Commandes</span>
                    </a>
                    <a href="detail.php">
                        <img src="icone/detail.png" alt="">
                        <span>Détails</span>
                    </a>
                    <a href="article.php">
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
                <span style="font-weight: 600;"><?php echo $_SESSION["email"]; ?></span>
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
        <div class="main" style="height: 49vh;">
            <div class="main_option">
                <h1>Information</h1>
                <div class="main_sub_option">
                    <a href="detail.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <form action="#" method="POST">
                    <input type="hidden" disabled value="<?php echo $valeur["id_ligne"]; ?>">
                    <label>Id commande</label>
                    <input type="text" disabled value="<?php echo $valeur["id_commande"]; ?>">
                    <label>Id Produit</label>
                    <input type="text" disabled value="<?php echo $valeur["id_article"]; ?>">
                    <label>Prix Unitaire</label>
                    <input type="number" disabled value="<?php echo $valeur["prix_unittaire"]; ?>">
                    <label>Quantité</label>
                    <input type="number" disabled value="<?php echo $valeur["qte"]; ?>">
                </form>
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