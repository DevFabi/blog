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
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 ">

				<?php

				$messagesParPage=5; //Nous allons afficher 5 messages par page.
				$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');
				$articles = $bdd->query('SELECT * FROM articles ORDER BY date_time_publication DESC');
				$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM articles'); //Nous récupérons le contenu de la requête dans $retour_total

			while($donnees_total = $retour_total->fetch())  //On range retour sous la forme d'un tableau.
				$total=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
				//Nous allons maintenant compter le nombre de pages.
				$nombreDePages=ceil($total/$messagesParPage);
				if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
				{
				     $pageActuelle=intval($_GET['page']);
				 
				     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
				     {
				          $pageActuelle=$nombreDePages;
				     }
				}
				else // Sinon
				{
				     $pageActuelle=1; // La page actuelle est la n°1    
				}


$premiereEntree=($pageActuelle-1)*$messagesParPage; // On calcul la première entrée à lire


 
// La requête sql pour récupérer les messages de la page actuelle.
$retour_messages=$bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT '.$premiereEntree.', '.$messagesParPage.'');


while($donnees_messages = $retour_messages->fetch())  // On lit les entrées une à une grâce à une boucle
{
			echo'
			<div class="article">
			 <ul>
		      <li>
		      <a href="article.php?id='.$donnees_messages['id'] .'">
		      '.$donnees_messages['titre'] .'</a>  
		      </li>
		      </ul>
		        
		      <br><br><ul>   
		      <li>          
		      '.$donnees_messages['contenu'] .'</li>
		      </ul>
		      </div>
		       <br>
			  <div id="commentaireBordure" >
			  <a href="article.php?id='.$donnees_messages['id'].'/#commentaireLien">Ecrire un commentaire</a>
			  <br>

		      <img src="photos/separation.png"> <br><br><br>
		      </div>
		      ';    
 }

				
						     
echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }	
     else //Sinon...
     {
          echo ' <a href="index.php?page='.$i.'">'.$i.'</a> ';
     }
}    

		      ?>

		      </div>
		      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>

			
	</div>
	<?php include("Vue/footer.php"); ?>
</div>
</body>  
</html>
