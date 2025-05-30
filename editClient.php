<?php
    #Connexion à la base de données
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }
    #Récupération de l'identifiant par la méthode GET
    $id = $_GET["id"];
    #Préparation de la requêtte de selection
    $requette = $pdo->prepare("SELECT id_client, nom_client, prenom_client, tel_client, email_client, adresse_client FROM t_client WHERE id_client=$id LIMIT 1");
    #Exécution de la requêtte
    $requette->execute();

    $valeur = $requette->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Modifier un client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrap">
        <!-- =======Menu vertical======== -->
        <div class="slide_bar">
            <h1>G<span>commandes</span></h1>
            <span id="account">simonpierresagno@gmail.com</span>
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
            </div>
        </div>
        <!-- ===========Menu vertical========== -->
        <div class="header">
            <div class="sub_option">
                <div class="menu_icon_1"></div>
                <div class="menu_icon"></div>
                <span>simonpierresagno@gmail.com</span>
            </div>
            <div class="subMenu_item">
                <!-- ==============Bouton déconnexion========== -->
                <a href="#" id="disconnect">
                    <img src="icone/deconnexion.png" alt="">
                    <span>Déconnexion</span>
                </a>
            </div>
        </div>
        <!-- =========Main========= -->
        <div class="main" style="height: 80vh;">
            <div class="main_option">
                <h1>Mise à jour</h1>
                <div class="main_sub_option">
                    <a href="adminClient.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <form action="modifierClient.php" method="POST">
			 	<input type="hidden" name="id" id="" value="<?php echo $valeur["id_client"]; ?>">
                    <label>Nom</label>
                    <input type="text" name="nom" id="" value="<?php echo $valeur["nom_client"]; ?>">
                    <label>Prénom</label>
                    <input type="text" name="prenom" id="" value="<?php echo $valeur["prenom_client"]; ?>" >
                    <label>Téléphone</label>
                    <input type="tel" name="tel" id="" value="<?php echo $valeur["tel_client"]; ?>"min="0" maxlength="9">
                    <label>Email</label>
                    <input type="email" name="email" id="" value="<?php echo $valeur["email_client"]; ?>" >
                    <label>Adresse</label>
                    <input type="text" name="adresse" id="" value="<?php echo $valeur["adresse_client"]; ?>">
                    <input type="submit" value="Modifier" name="modifier" style="background-color: green; color:#fff; font-weight:600">
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