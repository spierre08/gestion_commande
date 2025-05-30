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
    <title>GCommandes/Rechercher une commande</title>
    <link rel="stylesheet" href="rech.css">
</head>
<body>
    <header>
        <a href="adminCommande.php">Retour</a>
        <form action="#" method="POST">
            <input type="text" name="name" id="" placeholder="Rechercher une commande"><button type="submit" name="rechercher">Rechercher</button>
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
                    $requette = $pdo->prepare("SELECT id_commande,client, date_cmd, etat, id_client, nom_client AS t_client,id_etat, nom_etat AS t_etat FROM t_commande INNER JOIN t_client ON t_commande.client=t_client.id_client INNER JOIN t_etat ON t_commande.etat=t_etat.id_etat WHERE date_cmd=? OR nom_etat=? OR nom_client=? OR id_commande=?");
                    $requette->setFetchMode(PDO::FETCH_OBJ);
                    #Exécution de la requêtte
                    $requette->execute(array($key,$key,$key,$key));
                    #Vérifier si la requêtte à été exécutée alors on affiche les résultats
                    if ($row = $requette->fetch()) {
            ?>
            <thead>
                <tr>
                    <th>Idendifiant</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Etat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                        <td><?php echo $row->id_commande; ?></td>
                        <td><?php echo $row->t_client; ?></td>
                        <td><?php echo $row->date_cmd; ?></td>
                        <td><?php echo $row->t_etat; ?></td>
				    <td>
                                <a href="supCommande.php?id=<?php echo $row->id_commande; ?>"><img src="icone/delete.png" alt="" width="30px"></a>
                            </td>
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