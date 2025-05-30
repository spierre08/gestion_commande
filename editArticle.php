<?php
     #Connexion à la base de données
     try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }
    #Récupération de l'identifiant de l'élement
    $id = $_GET["id"];
    #Préparation de la requêtte de selection
    $requette = $pdo->prepare("SELECT id_article,libelle,type FROM t_article WHERE id_article=?");
    #Exécution de la requêtte 
    $executionOk = $requette->execute(array($id));

    $valeur = $requette->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Nouvel article</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrap">
        <!-- =======Menu vertical======== -->
        <div class="slide_bar">
            <h1>G<span>commandes</span></h1>
            <hr>
            <div class="slide_list">
                    <a href="admin.php">
                        <img src="icone/dashbord.png" alt="">
                        <span>Dashbord</span>
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
        <div class="main" style="height: 40vh;">
            <div class="main_option">
                <h1>Mise à jour d'un article</h1>
                <div class="main_sub_option">
                    <a href="adminArticle.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <form action="modifierArticle.php" method="POST">
                    <input type="hidden" name="id" id="" value="<?php echo $valeur["id_article"]; ?>">
                    <label>Libellé</label>
                    <input type="text" name="libelle" id="" value="<?php echo $valeur["libelle"]; ?>">
                    <label>Catégorie</label>
                    <select name="categorie" id="">
                    <?php 
                            #Requêtte d'affichage
                            $affiche_cat = $pdo->query("SELECT * FROM t_categorie");
                            #Boucle de parcour d'enrégistrements
                            while($affiche_cats = $affiche_cat->fetch()){

                        ?>
                        <option value="<?php echo $affiche_cats["id_type"]; ?>"><?php echo $affiche_cats["categorie"]; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <input type="submit" value="Modifier" name="modifier" style="background-color: green; color:#fff; font-weight:600;">
                </form>
            </div>
            <div class="footer">
                <span id="footer">© 2023 by Cyborg of Web</span>
            </div>
        </div>
    </div>
     <!-- ========Code source Javascript========= -->
     <script src="script.js"></script>
</body>
</html>