<?php
    #Démarrage de la session
    session_start();
    #Connexion à la base de données
	  try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }

    $id = $_GET["id"];
    #Préparation de la requêtte de selection
    $requette = $pdo->prepare("SELECT id_commande FROM t_commande WHERE id_commande=$id LIMIT 1");
    #Exécution de la requêtte
    $requette->execute();

    $valeur = $requette->fetch();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Nouvelle  commande</title>
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
        <div class="main" style="height: 58vh;">
            <div class="main_option">
                <h1>Info commande</h1>
                <div class="main_sub_option">
                    <a href="commande.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <?php
                    #Si on reçoit une requête de type POST
                    if (isset($_POST["modifier"])){
                        $etat = htmlspecialchars($_POST["etat_c"]);
                        #Variable affichant un message d'erreur
                        $succes = "<script>alert('Modifier avec succès !')</script>";
                        #Préparation de la requête de mise à jour
                        $update = $pdo->prepare("UPDATE t_commande SET etat=$etat WHERE id_commande=?");
                        $execution = $update->execute(array($id));
                        if ($execution){
                            $_SESSION["message"] = $succes;
                            header("Location:commande.php");
                        }else{   
                                echo "<script>alert('Impossible de modifier')</script>";
                        }
                    }
                ?>
                <form action="#" method="POST">
					<input type="hidden" value="<?php echo $valeur["id_commande"]; ?>" disabled>				
                    <label>Modifier l'état commande</label>	
                    <select name="etat_c" id="" style="border: 1px solid #000;" >
                        <?php 
                            #Requêtte d'affichage
                            $affiche_etat = $pdo->query("SELECT * FROM t_etat");
                            #Boucle de parcour d'enrégistrements
                            while($affiche_etats = $affiche_etat->fetch()){

                        ?>
                        <option value="<?php echo $affiche_etats["id_etat"]; ?>"><?php echo $affiche_etats["nom_etat"]; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <input type="submit" style="background-color: green; color : #fff; font-weight:600;" value="Modifier" name="modifier">
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