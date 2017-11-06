<?php 
session_start();
?>

<body>

<?php 
if(!isset($_SESSION['role']) OR $_SESSION['role'] != 1) 
{ include("Vue/menu.php");} else {
  include("Vue/menuadmin.php");}
?>

	<div class="row"><br><br> 
	</div>
			<div class="row">
		<div class="col-xs-2 col-md-2 col-lg-2"></div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 ">

<?php
				$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');
				$articles = $bdd->query('SELECT titre,contenu FROM articles ORDER BY id DESC');
				 {
					$q = 'york';
					$articles = $bdd->query('SELECT id, titre, contenu FROM articles WHERE titre LIKE "%'.$q.'%" ORDER BY id DESC');				}
?>


<?php 
	if($articles->rowCount() > 0) { 
		
			while ($a = $articles->fetch()) { 
				echo'
			<div class="article">
			 <ul>
		      <li>
		      <a href="article.php?id='.$a['id'] .'">
		      '.$a['titre'] .'</a>
		      </li>
		      </ul>
		      
		      <br><br><ul>
		      <li>
		      '.$a['contenu'] .'</li></ul></div>
		      '; 
			 } 
		
	} else { 
		
		}
		      ?>
		      <div class="col-xs-2 col-md-2 col-lg-2"></div>

			</div>
		</div>
	<?php include("Vue/footer.php"); ?>
</div>
</body>  
</html>
