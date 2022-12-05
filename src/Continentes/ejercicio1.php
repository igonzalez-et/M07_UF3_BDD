<html>
 <head>
 	<title>Continents</title>
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
 	<h1>Filtre de paisos per Continents</h1>
 
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
		
		$query = $pdo->prepare("SELECT distinct Continent FROM country;");
		$query->execute();
 	?>
    <form method="post" action="">
        <select name='nameContinent'>
        <?php
			$row = $query->fetch();

            while($row){
                echo "<option value='".$row["Continent"]."'>".$row["Continent"]."</option>";
				$row = $query->fetch();

            }
        ?>
        </select>
		<input type="submit">
    </form>
	<ul>
	<?php

		$queryCountry = $pdo->prepare("SELECT * FROM country where Continent='".$_POST["nameContinent"]."';");
		$queryCountry->execute();
		$rowCountry = $queryCountry->fetch();
		while($rowCountry){
			echo "<li>".$rowCountry["Name"]."</li>";
			$rowCountry = $queryCountry->fetch();
		}

	?>
	</ul>
 </body>
</html>