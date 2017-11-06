<?php
session_start();

$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');

if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = ($_POST['mdpconnect']);
   $code = ($_POST['code']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM espace_membre WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
      	if(isset($_POST['rememberme'])){
                        setcookie('email',$mailconnect,time()+365*24*3600,null,null,false,true);
                        setcookie('password',$mdpconnect,time()+365*24*3600,null,null,false,true);
                    }
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         $_SESSION['role'] = $userinfo['role'];
         header("Location: admin.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>

	<body>
  <?php include("Vue/menu.php"); ?>
	
	<div class="row">
		<br><br>
	<div class="col-md-4"></div>
		<div class="col-md-4 text-center">    
		
			<div class="article">
			
				<br>
				<br>
				<div align="center">
					<h2>Connexion</h2> <br> <br>
					
			<form class="form" method="POST" action="">
            <input class="form-control" type="email" name="mailconnect" placeholder="Mail" />
            <input class="form-control" type="password" name="mdpconnect" placeholder="Mot de passe" />
            <br /><br />
            <input type="checkbox"  name="rememberme" id="remembercheckbox" /><label for="remembercheckbox">Se souvenir de moi</label>
            <input type="submit" name="formconnexion" value="Se connecter !" />
			</form>
			
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
				</div>
			</div>
		</div>
      <div class="col-md-4"></div>
	</div>
</div>	

</body>
		
		<?php include("Vue/footer.php"); ?>
  </div>
  
</html>