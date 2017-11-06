<?php 
session_start();
?>
  <body>
  <?php include("Vue/menuadmin.php"); ?>
	<div class="row">
		<br><br>

	</div>


	
		<div class="col-xs-12 col-md-12 col-lg-12">
		 <div class="row">
		
      <h1> Liste des articles </h1><br><br>
      <div class="col-xs-12 col-md-12 col-lg-12">
		
<?php
   $bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');
   $articles = $bdd->query('SELECT * FROM articles ORDER BY date_time_publication DESC');

   while($a = $articles->fetch())  // On lit les entrées une à une grâce à une boucle
      {
            echo '
            <div class="editionListeArticle"><ul><li>
            <a href="article.php?id='.$a['id'] .'">
            '.$a['titre'] .'</a>  <button type="button" class="btn btn-default"> <a href="redaction.php?edit='.$a['id'].'"> Modifier</a> </button>
            <button type="button" class="btn btn-default"><a href="supprimer.php?id='.$a['id'].'"> Supprimer</a></button>
            </li></ul></div>';
      }
 ?>
		
		
		</div>
				<?php include("Vue/footer.php"); ?>
		</div>
	
	
</body>
</html>






