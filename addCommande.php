<?php
    #Connexion à la base de données
	  try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }

    #Variable d'erreur et d'alert
    $erreur = "";
    $message = "";

    #Si on reçoit une requêtte de type post
    if (isset($_POST["ajouter"])){
        $client = htmlspecialchars($_POST["client"]);
        $date_commande = htmlspecialchars($_POST["date_commande"]);
        $etat_commande = htmlspecialchars($_POST["etat"]);
        #Vérifier si le champ date n'est pas vide
        if (!empty($date_commande)){
            #Préparation de la requêtte d'insertion
            $insertion = $pdo->prepare("INSERT INTO t_commande(id_client,date_cmd,etat) values(?,?,?)");
            #Exécution de la requêtte
            $insertion->execute(array($client,$date_commande,$etat_commande));
            #Confirmation du message d'ajout
            $message = "<span id='erreur'>Ajout éffectué !</span>";
        }#Sinon on affiche un message d'érreur
        else{
            $erreur = "<span id='alert'>Veuillez saisir la date</span>";
        }
    }
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
            <span id="account">simonpierresagno@gmail.com</span>
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
        <div class="main" style="height: 58vh;">
            <div class="main_option">
                <h1>Nouvelle commande</h1>
                <div class="main_sub_option">
                    <a href="commande.php">Retour</a>
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
                    <label>Client</label>
                    <select name="client" id="">
                        <?php
                            #Requêtte d'affichage
                            $affichage = $pdo->query("SELECT * FROM t_client");
                            #Boucle de parcourir d'enrégistrement
                            while($affichages = $affichage->fetch()){
                        ?>
                        <option value="<?php echo $affichages["id_client"]; ?>"><?php echo $affichages["prenom_client"]; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <label>Date de commande</label>
                    <input type="date" name="date_commande">
                    <label>Etat commande</label>
                    <select name="etat" id="">
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
                    <input type="submit" value="Ajouter" name="ajouter">
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