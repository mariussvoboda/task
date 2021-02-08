<?php
	include ('connection.php');

	$artName=$_POST["artName"];

	$artCatCount = count($_POST["artCat"]);

	$timeCreated = date("Y-m-d H:i:s");

	setlocale(LC_ALL, 'en_US.UTF8');

	$queryAddArticle = "INSERT INTO articles (name, created) VALUES ('$artName', '$timeCreated')";
  $dataAddArticle=mysqli_query($connection,$queryAddArticle);   

	  $queryNewArt = "SELECT * FROM articles WHERE name = '$artName'";
	  $dataNewArt=mysqli_query($connection,$queryNewArt); 

	  while($rowNewArt=mysqli_fetch_array($dataNewArt)){
			$artId = $rowNewArt['id'];
		}

		if ($queryAddArticle) {
		  	print "<h3>Článek&nbsp;úspěšně&nbsp;vytvořen.</h3>";
		 }

if ($artCatCount > 0) {
	for ($i=0; $i < $artCatCount; $i++) { 
		if (trim($_POST['artCat'] != '')) {
			$artCat  = $_POST["artCat"][$i];

		  $queryCat = "SELECT * FROM categories WHERE name = '$artCat'";
		  $dataCat=mysqli_query($connection,$queryCat); 

		  while($rowCat=mysqli_fetch_array($dataCat)){
				$artCatId = $rowCat['id'];
			}  

		  if ($dataCat) {
		  	$rowCatCount=mysqli_num_rows($dataCat);

		  	if ($rowCatCount == '0') {
		  		$queryAddCat = "INSERT INTO categories (name) VALUES ('$artCat')";
		  		$dataAddCat=mysqli_query($connection,$queryAddCat);

		  		$queryNewCat = "SELECT * FROM categories WHERE name = '$artCat'";
		  		$dataNewCat=mysqli_query($connection,$queryNewCat);

		  		while($rowNewCat=mysqli_fetch_array($dataNewCat)){
						$artCatId = $rowNewCat['id'];
					}
		  	}
		  }

		  $queryArticleToCat = "INSERT INTO articleToCategory (idArticle, idCategory) VALUES ('$artId', '$artCatId')";
		 	$dataArticleToCat=mysqli_query($connection,$queryArticleToCat);

		}
	}
}
?>
