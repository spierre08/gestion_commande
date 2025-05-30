<?php
    #Démarrage de la session
    session_start();
    #Connexion à la base de données
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }
		#Préparation de la requêtte
		$requette = $pdo->prepare("SELECT id_client,nom_client,prenom_client,tel_client,email_client,adresse_client FROM t_client WHERE id_client=:num LIMIT 1");
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
    <title>GCommande/Information client</title>
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
        <div class="main" style="height: 80vh;">
            <div class="main_option">
                <h1>Info sur client</h1>
                <div class="main_sub_option">
                    <a href="client.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <form action="#" method="GET">
										<input type="hidden" name="id" id="" value="<?php echo$valeur['id_client']; ?>" disabled>
                    <label>Nom</label>
                    <input type="text" name="nom" id="" disabled value="<?php echo$valeur['nom_client']; ?>">
                    <label>Prénom</label>
                    <input type="text" name="prenom" id="" disabled value="<?php echo$valeur['prenom_client']; ?>">
                    <label>Téléphone</label>
                    <input type="tel" name="tel" id="" disabled value="<?php echo number_format($valeur['tel_client'],0,","," "); ?>">
                    <label>Email</label>
                    <input type="email" name="email" id="" disabled value="<?php echo$valeur['email_client']; ?>">
                    <label>Adresse</label>
                    <input type="text" name="adresse" id="" disabled value="<?php echo$valeur['adresse_client']; ?>">
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