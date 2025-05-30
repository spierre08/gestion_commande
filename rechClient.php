<?php
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
    <title>GCommandes/Rechercher un client</title>
    <link rel="stylesheet" href="rech.css">
</head>
<body>
    <header>
        <a href="client.php">Retour</a>
        <form action="#" method="POST">
            <input type="search" name="name" id="" placeholder="Rechercher un client"><button type="submit" name="rechercher">Rechercher</button>
        </form>
    </header>
    <div class="container">
        <table>
        <?php
                #Si un reçoit un demande de type post
                $message = "";
                if (isset($_POST['rechercher'])){
                    $key = htmlspecialchars($_POST['name']);
                    #Préparation de la requêtte
                    $requette = $pdo->prepare("SELECT * from t_client WHERE nom_client=? or adresse_client=?");
                    $requette->setFetchMode(PDO::FETCH_OBJ);
                    #Exécution de la requêtte
                    $requette->execute(array($key,$key));
                    #Vérifier si la requêtte à été exécutée alors on affiche les résultats
                    if ($row = $requette->fetch()) {
            ?>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Tel</th>
                    <th>Eail</th>
                    <th>Adresse</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                        <td><?php echo $row->id_client; ?></td>
                        <td><?php echo $row->nom_client; ?></td>
                        <td><?php echo $row->prenom_client; ?></td>
                        <td><?php echo $row->tel_client; ?></td>
                        <td><?php echo $row->email_client; ?></td>
                        <td><?php echo $row->adresse_client; ?></td>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
                     }else{
                        $message =  "Aucun resultat";
               
                     }
                    }
             ?>
        <br>
        <span style="marging-top:50px; color : red;"><?php echo $message; ?></span>
        
    </div>
</body>
</html>