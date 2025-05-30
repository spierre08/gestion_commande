<?php
    #Démarrage de la session
    session_start();
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
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $tel = htmlspecialchars($_POST["tel"]);
        $email = htmlspecialchars($_POST["email"]);
        $adresse = htmlspecialchars($_POST["adresse"]);
        #Si les champs ne sont pas vides 
        if (!empty($nom) and !empty($prenom) and !empty($tel) and !empty($email) and !empty($adresse)){
                #Vérifier si le numéro de téléphone comporte huit caractères
                if (strlen($tel)==9){
                    #Préparation de la requêtte de selection
                    $selection = $pdo->prepare("SELECT * FROM t_client WHERE tel_client=? OR email_client=?");
                    #Exécution de la requête
                    $selection->execute(array($tel,$email));
                    #Compteur de ligne
                    $resultat = $selection->rowCount();
                    if ($resultat ==1 ){
                        $erreur = "<span id='alert'>Email ou téléphone existe </span>";
                    }else{
                         #Préparation de la requêtte d'insertion
                    $insertion = $pdo->prepare("INSERT INTO t_client(nom_client, prenom_client, tel_client, email_client, adresse_client) values(?,?,?,?,?)");
                    #Exécution de la requêtte
                    $insertion->execute(array($nom, $prenom, $tel, $email, $adresse));
                    #Afficher un message de confirmation
                    $message = "<span id='erreur'>Ajout éffectué !</span>";
                    }

                }else{
                    #Afficher un message d'erreur
                    $erreur = "<span id='alert'>Numéro invalide</span>";
                }

        #Sinon on afficher un message d'erreur
        }else{
            $erreur = "<span id='alert'>Veuillez compléter ces informations</span>";

        }


    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Nouveau client</title>
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
                <h1>Nouveau client</h1>
                <div class="main_sub_option">
                    <a href="client.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <form action="#" method="POST">
                    <?php
                        if(isset($message))
                            echo $message;
                    ?>
                    <?php
                        if(isset($erreur))
                            echo $erreur;
                    ?>
                    <label>Nom</label>
                    <input type="text" name="nom" id="">
                    <label>Prénom</label>
                    <input type="text" name="prenom" id="">
                    <label>Téléphone</label>
                    <input type="tel" name="tel" id="">
                    <label>Email</label>
                    <input type="email" name="email" id="">
                    <label>Adresse</label>
                    <input type="text" name="adresse" id="">
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