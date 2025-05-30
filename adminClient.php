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
    <title>GCommande/Client Admin</title>
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
        <div class="main">
            <div class="main_option">
                <h1>Client</h1>
                <div class="main_sub_option">
                <a href="rechercherClient.php">Rechercher</a>
                </div>
            </div>
            <hr>
            <div class="main_table" >
                <table>
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Téléphone</th>
                            <th>Action</th>
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
                        #Preparation de la requêtte de selection
                        $affichage = $pdo->query("SELECT * FROM t_client ORDER BY id_client ASC LIMIT $debut,$nbr_page");
                        #Parcourir les enrégistrements
                        while($affichages = $affichage->fetch()){
                    ?>
                    <tbody>
                        <tr>
                        <td><?php echo $affichages["id_client"]; ?></td>
                            <td><?php echo $affichages["nom_client"]; ?></td>
                            <td><?php echo $affichages["prenom_client"]; ?></td>
                            <td><?php echo number_format($affichages["tel_client"],0,","," "); ?></td>
                            <td>
                                <a href="voirClient_2.php?id=<?php echo $affichages["id_client"]; ?>"><img src="icone/viewAdmin.png" alt="" width="30px"></a>
                                <a href="editClient.php?id=<?php echo $affichages["id_client"]; ?>"><img src="icone/edit.png" alt="" width="30px"></a>
                                <a href="supClient.php?id=<?php echo $affichages["id_client"]; ?>"><img src="icone/delete.png" alt="" width="30px"></a>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                        }
                    ?>
                </table>
                <div class="main_pagination">
                <div class="main_pagination">
                    <?php
                        #Requêtte permettant de compter le nombre d'enrégistrement
                        $query = $pdo->query("SELECT * FROM t_client");
                        #Compteur d'enrégistrement
                        $compteur = $query->rowCount();
                        #Nombre total
                        $total = ceil($compteur/$nbr_page = 10);
                        #Si la page est supérieur à on retourne à la page
                    ?>
                     <?php
                        if ($page>1){
                    ?>
                    <a href="adminClient.php?page=<?php echo ($page-1); ?>">Précedant</a>
                    <?php
                        }
                        #Boucle de parcours de chiffres
                        for($i=1; $i<=$total; $i++){
                    ?>
                   
                    <a href="adminClient.php?page=<?php echo ($i); ?>"><?php echo $i; ?></a>
                    <?php
                        }
                        #Si le compteur est supérieur à la page on passe à 
                        #la page suivante
                        if($i>$page){
                    ?>
                    <a href="adminClient.php?page=<?php echo ($page+1); ?>">Suivant</a>
                    <?php
                        }
                    ?>
                </div>
                <hr style="margin-top:10px">
                <?php
                    #Requêtte de compteur d'enrégistrement
                    $enreg = $pdo->query("SELECT count(*) as nb from t_client");
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