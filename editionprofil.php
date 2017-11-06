<?php 
session_start();

if(!isset($_SESSION['role']) OR $_SESSION['role'] != 1) 
{
   $_SESSION['accessdenied'] = "Vous n'avez pas l'autorisation d'accéder à cette page";

   header('Location: connexion.php '); // La page où tu veux rediriger le membre
   exit(); // Afin que la suite du code ne s'exécute pas
} 

$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');

if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM espace_membre WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE espace_membre SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE espace_membre SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE espace_membre SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
	<body>
  <?php include("Vue/menuadmin.php"); ?>
	
	<div class="row">
		<br><br>
	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">    
		
			<div class="article">
			
				<br>
				<br>
				<div align="center">
				

            <form method="POST" action="" enctype="multipart/form-data">
               <label>Pseudo :</label>
               <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
               <label>Mail :</label>
               <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
               <label>Mot de passe :</label>
               <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label>
               <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         
      </div>

				</div>
				

			</div>
		
		</div>
	</div>
	
</div>	
</body>
		<?php include("Vue/footer.php"); ?>
  </div>
  
<?php   
}
else {
   header("Location: connexion.php");
}
?>