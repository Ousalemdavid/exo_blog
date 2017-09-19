<?php include("header.php"); ?>
        <?php
    try
            {
              $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '22Misterhoo');
            }
            catch (Exception $e)
            {
                    die('Erreur : ' . $e->getMessage());
            }


$reponse = $bdd->query('SELECT * FROM billets');



while ($donnees = $reponse->fetch())

{

?>

 <p>
      <section class="ordre_millieux">
     <br /><h3> <?php echo $donnees['titre']; ?></h3>
     <div id="contenus">
     <?php echo $donnees ['contenu']; ?> <br />
     <em class='float'><strong> posté à : <?php echo $donnees['date_creation']; ?> </strong>
     <a href="commentaire.php?id=<?php echo $donnees['id']?>" class="float-right pr-2">Commentaires</a></em><br />
</div>
<br />
   </p>
</section>
<?php

}


$reponse->closeCursor(); // Termine le traitement de la requête


?>



<?php include("footer.php"); ?>
