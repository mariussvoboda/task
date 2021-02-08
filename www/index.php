<?php
	include ('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Marius Svoboda</title>
	<meta name="description" content="Úkol dle zaslaného zadání">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="css/screen.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
	<script>
		$(document).ready(function(){
		    $("form").on("submit", function(event){
		        event.preventDefault();
		 
		        var formValues= $(this).serialize();
		 
		        $.post("create.php", formValues, function(data){
		            // Display the returned data in browser
		            $("#result").html(data);
		        });
		    });
		});
	</script>

	<nav>
		<h1>Marius Svoboda</h1>
		<ul>
			<a href="#">
				<li>Stránka 1</li>
			</a>
			<a href="#">
				<li>Stránka 2</li>
			</a>			
		</ul>
	</nav>

	<article>
		<section class="left">
			<div class="formContainer">
				<form>
					<label for="">Titulek článku</label>
    			<input type="text" id="artName" name="artName" value="<?php echo "$articleName";?>" placeholder="Přidat nový článek" class="leftFloat">
    			
    			<div id="dynamic_field">
	    			<label for="">Kategorie článku</label>
	    			<input list="artCats" type="text" id="artCat" name="artCat[]" value="<?php echo "$articleName";?>" placeholder="Začněte psát název kategorie" class="leftFloat">
	    			<datalist id="artCats">
					    <?php
					    	$queryCat = "SELECT * FROM categories ORDER BY name ASC";
	              $dataCat=mysqli_query($connection,$queryCat);   

	              while($rowCat=mysqli_fetch_array($dataCat)){
	                $catName=$rowCat['name'];

	                print"<option value=\"".$catName."\">";
	              }
	            ?>
					  </datalist>
				  </div>

				  <button type="button" name="add" id="add" class="addBtn">Další kategorie</button>
    			<button type="submit" name="submit">Vytvořit</button>

    			<div id="result" class="result"></div>
				</form>
			</div>
		</section>
		<section class="right">
			
		</section>
	</article>

	<footer>
		<div><p>Správné</p></div>
		<div><p>pořadí</p></div>
		<div><p>pouze na</p></div>
		<div><p>telefonu</p></div>
	</footer>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){

    var i = 1;

    $("#add").click(function(){
      i++;
      $('#dynamic_field').append('<input list="artCats" type="text" id="artCat" name="artCat[]" value="<?php echo "$articleName";?>" placeholder="Začněte psát název kategorie" class="leftFloat"><datalist id="artCats"><?php $queryCat = "SELECT * FROM categories ORDER BY name ASC"; $dataCat=mysqli_query($connection,$queryCat); while($rowCat=mysqli_fetch_array($dataCat)){ $catName=$rowCat['name']; print"<option value=\"".$catName."\">";}?></datalist>');
    });
  });
</script>
