<?php 

$messagesParPage=5; //Nous allons afficher 5 messages par page.

$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');

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
     //Je vais afficher les messages dans des petits tableaux. C'est à vous d'adapter pour votre design...
     //De plus j'ajoute aussi un nl2br pour prendre en compte les sauts à la ligne dans le message.
     echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                     <td> '.$donnees_messages['titre'].'</td>
                </tr>
                <tr>
                     <td>'.nl2br($donnees_messages['contenu']).'</td>
                </tr>
            </table><br /><br />';
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
          echo ' <a href="pagination.php?page='.$i.'">'.$i.'</a> ';
     }
}
echo '</p>';
