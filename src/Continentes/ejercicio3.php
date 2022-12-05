<html>
 <head>
 	<title>Continents</title>
 </head>
 <style>
    body{
        text-align: center;
    }
    table{
        margin: auto;
    }
    table,td {
        border: 1px solid black;
        border-spacing: 0px;
        text-align: center;
 	}
    thead{
        background-color: cyan;
        font-weight: bold;
    }
    td{
        width: 250px;
    }
</style>
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
 	?>
    <form method="post" action="">
        <input type='text' name='inputCountry'> <br><br>
		<input type="submit">
    </form>
    
    <?php
        if(isset($_POST["inputCountry"])){
            $queryLanguage = $pdo->prepare("select c.Name as Name, l.language as language, l.IsOfficial as oficial, l.Percentage as percentatge from countrylanguage l inner join country c on l.CountryCode = c.Code where Name like '%".$_POST["inputCountry"]."%';");
		    $queryLanguage->execute();
            $rowLanguage = $queryLanguage->fetch();
        
        
    ?>
    <table>
        <thead>
            <td>Name</td>
            <td>Language</td>
            <td>Official</td>
            <td>Percentage</td>
        </thead>
    <?php

        while($rowLanguage){
            echo "<tr>";
            echo "<td>".$rowLanguage["Name"]."</td>";
            echo "<td>".$rowLanguage["language"]."</td>";
            echo "<td>".$rowLanguage["oficial"]."</td>";
            echo "<td>".$rowLanguage["percentatge"]."</td>";
            echo "</tr>";
            $rowLanguage = $queryLanguage->fetch();
        }
        }
    ?>
    </table>
    <ul>
    <?php
        if(isset($_POST["inputCountry"])){
            $queryLanguage2 = $pdo->prepare("select c.Name as Name, l.language as language, l.IsOfficial as oficial, l.Percentage as percentatge from countrylanguage l inner join country c on l.CountryCode = c.Code where Name like '%".$_POST["inputCountry"]."%';");
            $queryLanguage2->execute();
            $rowLanguage2 = $queryLanguage2->fetch();
        while($rowLanguage2){
            echo "<li>".$rowLanguage2["language"]."</li>";
            $rowLanguage2 = $queryLanguage2->fetch();
        }
    }
    ?>
    </ul>
 </body>
</html>