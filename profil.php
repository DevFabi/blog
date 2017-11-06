 <?php

$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM espace_membre WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>

<body>

<?php include("Vue/menu.php"); ?>
	
	<div class="row">
		<br><br>
	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">    
		
			<div class="article">
			
				<br>
				<br>
				<div align="center">

				

      <div align="center">
         <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
         <br /><br />
         Pseudo = <?php echo $userinfo['pseudo']; ?>
         <br />
         Mail = <?php echo $userinfo['mail']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="editionprofil.php">Editer mon profil</a>
         <a href="deconnexion.php">Se déconnecter</a>
         <?php
         }
         ?>
      </div>

<?php   
}
?>
				
				
				
				</div>
				

			</div>
		
		</div>
	</div>
	
</div>	
</body>
	
	<?php include("Vue/footer.php"); ?>
  </div>
  
	
	

	
	
	


</html>


