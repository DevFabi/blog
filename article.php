<?php 
session_start();
?>

	<body>
   <?php
if(!isset($_SESSION['role']) OR $_SESSION['role'] != 1) 
{ include("Vue/menu.php");} else {
   include("Vue/menuadmin.php");}
   ?>
	
	<div class="row">
		<br><br>

	</div>


	
		
		 <div class="row">
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 ">
      <div class="article">
			
				
<?php
$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $get_id = htmlspecialchars($_GET['id']);
   $article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
   $article->execute(array($get_id));
   if($article->rowCount() == 1) {
      $article = $article->fetch();
      $id = $article['id'];
      $titre = $article['titre'];
      $contenu = $article['contenu'];
      $likes = $bdd->prepare('SELECT id FROM likes WHERE id_article = ?');
      $likes->execute(array($id));
      $likes = $likes->rowCount();
      $dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ?');
      $dislikes->execute(array($id));
      $dislikes = $dislikes->rowCount();
   } else {
      die('Cet article n\'existe pas !');
   }
} else {
   die('Erreur');
}
?>

<?php
$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $getid = htmlspecialchars($_GET['id']);
   $article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
   $article->execute(array($getid));
   $article = $article->fetch();
   if(isset($_POST['submit_commentaire'])) {
      if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
         $pseudo = htmlspecialchars($_POST['pseudo']);
         $commentaire = htmlspecialchars($_POST['commentaire']);
         if(strlen($pseudo) < 25) {
            $ins = $bdd->prepare('INSERT INTO commentaires (pseudo, commentaire, id_article) VALUES (?,?,?)');
            $ins->execute(array($pseudo,$commentaire,$getid));
            $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";
         } else {
            $c_msg = "Erreur: Le pseudo doit faire moins de 25 caractères";
         }
      } else {
         $c_msg = "Erreur: Tous les champs doivent être complétés";
      }
   }
   $commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE id_article = ? ORDER BY id DESC');
   $commentaires->execute(array($getid));
?>

   <h1><?= $titre ?></h1><br><br>
   <?= $contenu ?>
   <br>

   <!-- FAIRE UNE SEPARATION ENTRE ARTICLE ET COMMENTAIRES  -->
   
<!--    <a style ="text-decoration: none; color:teal; font-size:20px;" href="action.php?t=1&id=<?= $id ?>">J'aime (<?= $likes ?>)</a> 
   
   <a style ="text-decoration: none; color:teal; font-size:20px;" href="action.php?t=2&id=<?= $id ?>">Je n'aime pas (<?= $dislikes ?>)</a>  -->
   <!-- FAIRE UNE REDIRECTION SUR LE MM ARTICLE ( ACTUELLEMENT : REDIRECTION SUR BLOG.PHP ... ) -->
   
   <br>

<h2>Commentaires:</h2>

<?php while($c = $commentaires->fetch()) {  ?>
   <b><?= $c['pseudo'] ?>:</b> <?= $c['commentaire'] ?><br />
 
<?php } ?>
<?php
}
?>
<br>
<!--  <?php
      $commentaires = $commentaires->rowCount();
      echo ' Il y a '.$commentaires.' commentaires .' ; 
  ?> -->
  <br><br>
<div id="commentaireLien"></div>
<h2>Poster un commentaire:</h2>
<br>
<form class="form" method="POST">
   <input type="text" class="form-control" name="pseudo" placeholder="Votre pseudo" /><br />
   <textarea name="commentaire" class="form-control" placeholder="Votre commentaire..."></textarea><br />
   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" class="btn btn-start-order" />
</form>

<?php if(isset($c_msg)) { echo $c_msg; } ?>
<br /><br />

			</div>
		
		</div>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
		</div>
		<?php include("Vue/footer.php"); ?>
		
	

</body>
	
</html>
















