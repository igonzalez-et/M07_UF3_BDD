<html>
 <head>
 	<title>Afegir Ciutat</title>
 	<style>
 		body{
 		}
 		table,td {
 			border: 1px solid black;
 			border-spacing: 0px;
 		}
 	</style>
 </head>
 
 <body>
 	<h1>Afegir Ciutat</h1>
 
 	<?php
 		try {
			$hostname = "127.0.0.1";
			$dbname = "world";
			$username = "igonzalez";
			$pw = "Superlocal123";
			$pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
			} catch (PDOException $e) {
			echo "Failed to get DB handle: " . $e->getMessage() . "\n";
			exit;
			} 
			
			$query = $pdo->prepare("SELECT * FROM country;");
			$query->execute();
 	?>
 
    <form action="" method="POST">
 	<label for="codi_pais">Escull un país:</label>
 	<select name="codi_pais" id="codi_pais">

 	<?php
 		$row = $query->fetch();
 		while( $row )
 		{
            echo "<option value=".$row["Code"].">".$row["Name"]."</option>";
			$row = $query->fetch();
 		}
 	?>

    </select><br><br>
    <label for="nom_ciutat">Ciutat:</label><br>
    <input id="nom_ciutat" type="text" name="nom_ciutat"><br><br>
    <label for="poblacio">Població:</label><br>
    <input type="number" name="poblacio" id="poblacio"><br><br>
    <input type="submit" name="submit" id="submit">
    </form>

    <?php
        if(isset($_POST["submit"])){
			$query = $pdo->prepare("SELECT * from city where name= '".$_POST["nom_ciutat"]."' and CountryCode= '".$_POST["codi_pais"]."';");
			$query->execute();
            $resQuery = $query->fetch();
            $filesQuery = $pdo->query("SELECT count(*) from city where name= '".$_POST["nom_ciutat"]."' and CountryCode= '".$_POST["codi_pais"]."';")->fetchColumn();
        if($filesQuery > 0){
            echo "<div class='missatge'>Aquesta ciutat ja existeix en aquest país</div>";
        }
        else{
			$queryInsert = $pdo->prepare("INSERT INTO city (Name,CountryCode,Population) values('".$_POST["nom_ciutat"]."','".$_POST["codi_pais"]."',".$_POST["poblacio"].");");
			$queryInsert->execute();
			echo "<div class='missatge'>Ciutat afegida correctament</div>";
        }
        }
    ?>

    <a href="index.php">Tornar a l'inici</a>

 </body>
</html>