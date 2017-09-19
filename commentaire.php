
<!--_____________________  CONNEXION A MA BDD-->
        <?php
    try
            {
              $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root','22Misterhoo');
            }
            catch (Exception $e)
            {
                    die('Erreur : ' . $e->getMessage());
            } ?>
<!--_____________________  FIN DE LA CONNEXION-->
<?php
$reponse = $bdd->prepare('SELECT * FROM billets WHERE id= ?');
$reponse->execute([$_GET['id']]);
$donnees = $reponse->fetch();
?>
<?php include("header.php"); ?>




<br /><h3> <?php echo $donnees['titre']; ?></h3>
<section class='containers'>
<div id="contenus" class="text-center">
<?php echo $donnees['contenu']; ?> <br />
<em class='float'><strong> posté à : <?php echo $donnees['date_creation']; ?> </strong></em>

</div>

<!-- _________________________FIN DU BILLETS_____________________________-->

<?php

$commentaire = $bdd->prepare('SELECT * FROM commentaires WHERE id_billet= ?');
$commentaire->execute([$_GET['id']]);
$donnees_com = $commentaire->fetchAll();
?>

<div id="commentaires">
<?php
foreach ($donnees_com as $key => $value):?>

<br /><h3 class='nom_com'> <?php echo $value['auteur']; ?></h3>

<?php echo $value['commentaire']; ?> <br />
<em class='commentaires_float'><strong> posté à : <?php echo $value['date_commentaire']; ?> </strong>
</em>
<?php endforeach; ?></div>

<!--  ________________ FIN  DES COMMENTAIRES AFFICHAGES______________ -->



<!--_________________________Mon formulaire__________________________-->
<br />

<div class="Monformulaire">

<form action="commentaire.php?id=<?php echo $donnees['id'];?>" method="post">

  <legend> Votre pseudo </legend>
    <input type="TEXT" name="pseudo" placeholder="Votre Pseudo"/><br />


<legend> votre message </legend>
    <textarea name="message" rows="5" cols="35" placeholder="Votre message"></textarea><br />

    <input type="submit" value="Envoyez"/>
  </form></div></section> <br /><br />

<!--___________________________ FIN DU FORMULAIRE___________________-->
<?php

$req = $bdd->prepare('INSERT INTO commentaires (auteur , commentaire , date_commentaire) VALUES (:auteur , :commentaire , NOW())');
$req->execute(array(


  'auteur' => $_POST['pseudo'],
  'commentaire'=> $_POST['message']
));



$reponse->closeCursor(); // Termine le traitement de la requête


?>
<?php include("footer.php"); ?>
