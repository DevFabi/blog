<?php 
session_start();

if(!isset($_SESSION['role']) OR $_SESSION['role'] != 1) 
{
   $_SESSION['accessdenied'] = "Vous n'avez pas l'autorisation d'accéder à cette page";

   header('Location: connexion.php '); // La page où tu veux rediriger le membre
   exit(); // Afin que la suite du code ne s'exécute pas
} 

?>


	<?php include("Vue/menuadmin.php"); ?>

<body>
	


	<?php include("Vue/footer.php"); ?>
</body>

</html>