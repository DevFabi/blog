


<?php


$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!'); 


if(isset($_POST['forminscription']))
{
	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND!empty($_POST['mdp2']))
	{
		
	}
	else
	{
		$erreur= "Tous les champs doivent être complétés !";
	}
}


if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM espace_membre WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO espace_membre(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp));
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
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
					<h2>Ajouter un utilisateur</h2> <br> <br>
					
					<form class="form" method="POST" action="">
						<table>
							<tr>
								<td align="right">
									<label class="form-label" for ="pseudo"> Pseudo :</label>
								</td>
								<td>
									<input class="form-control" type="text" placeholder="Pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;}?>"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label class="form-label" for ="mail"> E-mail :</label>
								</td>
								<td>
									<input class="form-control" type="text" placeholder="E-mail" id="mail" name="mail" value="<?php if(isset($mail)) {echo $mail;}?>"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label class="form-label" for ="mail2"> Confirmation du mail:</label>
								</td>
								<td>
									<input class="form-control" type="text" placeholder="Confirmez l'email" id="mail2" name="mail2"value="<?php if(isset($mail2)) {echo $mail2;}?>"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label class="form-label" for ="mdp"> Mot de passe :</label>
								</td>
								<td>
									<input class="form-control" type="password" placeholder="Mot de passe" id="mdp" name="mdp"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label class="form-label" for ="mdp2"> Confirmez le mot de passe :</label>
								</td>
								<td>
									<input class="form-control" type="password" placeholder="Confirmez le mot de passe" id="mdp2" name="mdp2"/>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
								<input class="btn btn-start-order" type="submit" name="forminscription" value="Ajouter"/>
								</td>
							</tr>
							
						</table>
						
					</form>
					<?php
					
					if(isset($erreur))
					{
						echo $erreur;
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



