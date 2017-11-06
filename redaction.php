 <?php 
session_start();

if(!isset($_SESSION['role']) OR $_SESSION['role'] != 1) 
{
   $_SESSION['accessdenied'] = "Vous n'avez pas l'autorisation d'accéder à cette page";

   header('Location: connexion.php '); // La page où tu veux rediriger le membre
   exit(); // Afin que la suite du code ne s'exécute pas
} ?>


    <?php
$bdd = new PDO('mysql:host=db692730741.db.1and1.com;dbname=db692730741;charset=utf8', 'dbo692730741','Bdd_blog11@!');
$mode_edition = 0;
if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
   $mode_edition = 1;
   $edit_id = htmlspecialchars($_GET['edit']);
   $edit_article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
   $edit_article->execute(array($edit_id));
   if($edit_article->rowCount() == 1) {
      $edit_article = $edit_article->fetch();


   } else {
      die('Erreur : l\'article n\'existe pas...');
   }
}
if(isset($_POST['article_titre'], $_POST['article_contenu'])) {
   if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])) {
      
      $article_titre = htmlspecialchars($_POST['article_titre']);
      $article_contenu = ($_POST['article_contenu']);
      if($mode_edition == 0) {
         $ins = $bdd->prepare('INSERT INTO articles (titre, contenu, date_time_publication) VALUES (?, ?, NOW())');
         $ins->execute(array($article_titre, $article_contenu));
         $message = 'Votre article a bien été posté';
      } else {
         $update = $bdd->prepare('UPDATE articles SET titre = ?, contenu = ?, date_time_publication = NOW() WHERE id = ?');
         $update->execute(array($article_titre, $article_contenu, $edit_id));
         $message = 'Votre article a bien été mis à jour !';
      }
   } else {
      $message = 'Veuillez remplir tous les champs';
   }
}
?>

	<body>
  <?php include("Vue/menuadmin.php"); ?>

	<div class="row">
		<br><br>

	</div>


	
		<div class="col-xs-12 col-md-12 col-lg-12">
		 <div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
		
			<div class="article">
			
				
   <h2>Nouvel article</h2> 
   
   <form method="POST">
      <input type="text" name="article_titre" class="form-control" placeholder="Titre" value="<?= $edit_article['titre'] ?>"/><br />
      <textarea id="editor1" name="article_contenu" class="form-control" placeholder="Contenu de l'article"><?=$edit_article['contenu'] ?></textarea>
      			<script>
            CKEDITOR.replace('editor1', {
  "filebrowserImageUploadUrl": "/blogfb/ckeditor/plugins/imgupload/iaupload.php"
});
  CKEDITOR.on('instanceReady', function(ev) {

        //resp. images for bootstrap 3
       ev.editor.dataProcessor.htmlFilter.addRules(
                {
                    elements:
                            {
                                $: function(element) {
                                    // Output dimensions of images as width and height
                                    if (element.name == 'img') {
                                        var style = element.attributes.style;
                                        //responzive images

                                        //declare vars
                                        var tclass = "";
                                        var add_class = false;

                                        tclass = element.attributes.class;

                                        //console.log(tclass);
                                        //console.log(typeof (tclass));

                                        if (tclass === "undefined" || typeof (tclass) === "undefined") {
                                            add_class = true;
                                        } else {
                                            //console.log("I am not undefined");
                                            if (tclass.indexOf("img-responsive") == -1) {
                                                add_class = true;
                                            }
                                        }

                                        if (add_class) {
                                            var rclass = (tclass === undefined || typeof (tclass) === "undefined" ? "img-responsive" : tclass + " " + "img-responsive");
                                            element.attributes.class = rclass;
                                        }

                                        if (style) {
                                            // Get the width from the style.
                                            var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                                                    width = match && match[1];

                                            // Get the height from the style.
                                            match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                                            var height = match && match[1];

                                            if (width) {
                                                element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                                                element.attributes.width = width;
                                            }

                                            if (height) {
                                                element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                                                element.attributes.height = height;
                                            }
                                        }
                                    }



                                    if (!element.attributes.style)
                                        delete element.attributes.style;

                                    return element;
                                }
                            }
                });
    });
         </script><br />
      <input type="submit" class="btn btn-start-order" value="Envoyer l'article" />
   </form>

   <br />
   
   <?php if(isset($message)) { echo $message; } ?>

   <br /> 
		<a href="blog.php" >VISITEZ LE BLOG</a> 
		<br><br><br><br>

			</div>
		
		</div>
		</div>
				<?php include("Vue/footer.php"); ?>
		</div>
	
	
</body>
</html>






