<?php 
session_start();
?>
<?php
if(isset($_POST['mailform'])) {
   if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message'])) {
      $header="MIME-Version: 1.0\r\n";
      $header.='From:"fabi"<fabibelet@gmail.com>'."\n";
      $header.='Content-Type:text/html; charset="uft-8"'."\n";
      $header.='Content-Transfer-Encoding: 8bit';
      $message='
      <html>
         <body>
            <div align="center">

               <br />
               <u>Nom de l\'expéditeur :</u>'.$_POST['nom'].'<br />
               <u>Mail de l\'expéditeur :</u>'.$_POST['mail'].'<br />
               <br />
               '.nl2br($_POST['message']).'
               <br />

            </div>
         </body>
      </html>
      ';
      mail("fabibelet@gmail.com", "Contact BLOG", $message, $header);
      $msg="Votre message a bien été envoyé !";
   } else {
      $msg="Tous les champs doivent être complétés !";
   }
}
?>

	<body>
<?php 
if(!isset($_SESSION['role']) OR $_SESSION['role'] != 1) 
{ include("Vue/menu.php");} else {
   include("Vue/menuadmin.php");}
   ?>
	
	
	<div class="row">
	
		<div class="col-xs-12 col-md-12 col-lg-12">
		
			<div class="article">
			
				
			<div class="container">
			<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">                        
				<img src="photos/contact.png">
			</div>
			</div>
			
			<!--  FORMULAIRE DE CONTACT !-->
			
  <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
      <form class="form" method="POST" action="">
		 <label class="form-label" for="name">Votre nom</label>
         <input type="text" name="nom" class="form-control" placeholder="Votre nom" value="<?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" /><br /><br />
		 <label class="form-label" for="email">Votre e-mail</label>
         <input type="email" name="mail"class="form-control"  placeholder="Votre email" value="<?php if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" /><br /><br />
		 <label class="form-label" for="message">Message</label>
         <textarea name="message" class="form-control" placeholder="Votre message"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />
         <input type="submit" value="Envoyer" class="btn btn-start-order"  name="mailform"/>
      </form>
		  
		        <?php if(isset($msg)) {
				echo $msg;
				}
				?>
		  <br>
      </div>
  </div>
</div>
				
				

	  

				
				
			</div>
		
		</div>
	
</div>	
</body>
	
<?php include("Vue/footer.php"); ?>
  </div>
  
	
	

	
	
	


</html>



