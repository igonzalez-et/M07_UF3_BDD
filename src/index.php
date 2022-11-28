<html>
 <head>
 	<title>Exemple de lectura de dades a MySQL</title>
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
 	<h1>Filtre de ciutats per país</h1>
 
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
    <form method="post" action="results.php">
        <select name='codi_pais'>
        <?php
			$row = $query->fetch();

            while($row){
                echo "<option value='".$row["Code"]."'>".$row["Name"]."</option>";
				$row = $query->fetch();

            }
        ?>
        </select>
		<input type="submit">
    </form>
 </body>
</html>