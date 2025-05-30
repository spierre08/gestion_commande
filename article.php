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
    <title>GCommande/Article</title>
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
        <div class="main">
            <div class="main_option">
                <h1>Article</h1>
                <div class="main_sub_option">
                    <a href="rechArticle.php">Rechercher</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <table>
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Libellé</th>
                            <th>Catégorie</th>
                        </tr>
                    </thead>
                    <?php
                        #SI on reçoit une requêtte de type gest
                        if (isset($_GET['page'])){
                            $page = $_GET['page'];
                        }else{
                            #Sinon on initialise la page à 1
                            $page = 1;
                        }
                        #Nombre de page
                        $nbr_page = 10;
                        #Début de la page
                        $debut = ($page-1)*10;

                        #Requêtte de selection
                        $affichage = $pdo->query("SELECT id_article, libelle, type, id_type, categorie AS t_categorie FROM t_article INNER JOIN t_categorie ON t_article.type=t_categorie.id_type LIMIT $debut,$nbr_page");
                        #Boucle de parcour d'enrégistrements
                        while($affichages = $affichage->fetch()){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $affichages["id_article"]; ?></td>
                            <td><?php echo $affichages["libelle"]; ?></td>
                            <td><?php echo $affichages["t_categorie"]; ?></td>
                        </tr>
                    </tbody>
                    <?php
                        }
                    ?>
                </table>
                <div class="main_pagination">
                    <?php
                        #Requête permettant de compter le nombre d'enrégistrement
                        $query = $pdo->query("SELECT * FROM t_article");
                        #Compteur d'enrégistrements
                        $compteur = $query->rowCount();
                        #Nombre total
                        $total = ceil($compteur/$nbr_page = 10);
                        #Si la page est supérieur à on retourne à la page
                        if ($page>1){
                        
                    ?>
                    <a href="article.php?page=<?php echo ($page-1); ?>">Précedant</a>
                    <?php
                        }
                    ?>
                    <?php
                        #Boucle de parcours de chiffres
                        for($i=1; $i<=$total; $i++){
                    ?>
                    <a href="article.php?page=<?php echo ($i); ?>"><?php echo $i; ?></a>
                    <?php
                        }
                        if($i>$page){
                    ?>
                    <a href="article.php?page=<?php echo ($page+1); ?>">Suivant</a>
                    <?php
                        }
                    ?>
                </div>
                <hr style="margin-top:10px">
                <?php
                    #Requêtte de compteur d'enrégistrement
                    $enreg = $pdo->query("SELECT count(*) as nb from t_article");
                    while ($enregistrement = $enreg->fetch()){
                ?>
                    <!-- ======Nombre d'enrégistrement======= -->
                    <p style="font-weight: 600;"><?php echo $enregistrement["nb"] . " Enrégistrement(s)"; ?></p>
                <?php
                    }
                ?>
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