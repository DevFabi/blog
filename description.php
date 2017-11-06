<?php 
session_start();
?>
	<body>

<?php 
if(!isset($_SESSION['role']) OR $_SESSION['role'] != 1) 
{ include("Vue/menu.php");} else {
   include("Vue/menuadmin.php");}
   ?>
	<div class="row">
		<br><br>

	</div>


	
			<div class="container">
			<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">                        
			
			</div>
			</div>
		  <div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">    
			<div class="article">
			

				<br>
				
				
				<br><br>
 
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





