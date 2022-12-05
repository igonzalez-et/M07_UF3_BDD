<html>
 <head>
 	<title>Continents</title>
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
        <?php
			$row = $query->fetch();
            while($row){
                echo "<input type='checkbox' name='nameContinent[]' value='".$row["Continent"]."'>".$row["Continent"]."<br>\n";
				$row = $query->fetch();

            }
        ?>
		<input type="submit">
    </form>
	<ul>
	<?php
    if(isset($_POST['nameContinent'])) {
        $txtContinent = implode("', '",$_POST['nameContinent']);

        $queryCountry = $pdo->prepare("SELECT * FROM country where Continent in ('".$txtContinent."');");
        $queryCountry->execute();
        $rowCountry = $queryCountry->fetch();
        while($rowCountry){
            echo "<li>".$rowCountry["Name"]."</li>";
            $rowCountry = $queryCountry->fetch();
        }
    }

	?>
	</ul>
 </body>
</html>