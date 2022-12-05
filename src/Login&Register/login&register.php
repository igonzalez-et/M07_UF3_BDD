<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL_Integration</title>
    <style>
        form{
            border: 1px solid black;
            padding: 2% 2% 2% 1%;
            width: 25%;
        }
        input{
            margin-bottom: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
		try {
		$hostname = "127.0.0.1";
		$dbname = "users";
		$username = "igonzalez";
		$pw = "Superlocal123";
		$pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
		} catch (PDOException $e) {
		echo "Failed to get DB handle: " . $e->getMessage() . "\n";
		exit;
		} 
 	?>
    <h2>Login</h2>
    <form method="post" action="">
        <input type="text" name="loginUsername"  placeholder="username"><br>
        <input type="password" name="loginPassword" placeholder="password"><br>
        <input type="submit" name="loginSubmit" value="Login">
    </form>
    
    <?php
        $pwd = hash("sha256",$_POST["loginPassword"]);
        
        if(isset($_POST["loginSubmit"])){
            $queryUsername = $pdo->prepare("SELECT count(*) as numUsers from users where username='".$_POST["loginUsername"]."' and password='".$pwd."'");
            $queryUsername->execute();
            $rowUsername = $queryUsername->fetch();

            if($rowUsername["numUsers"] > 0){
                echo "<p>Has iniciado sesión correctamente</p>";
            }
            else{
                echo "<p>No existe este usuario</p>";
            }
        }

    ?>

<h2>Register</h2>
    <form method="post" action="">
        <input type="text" name="registerUsername"  placeholder="username"><br>
        <input type="password" name="registerPassword" placeholder="password"><br>
        <input type="password" name="registerPassword2" placeholder="Repeat password"><br>
        <input type="submit" name="submit" value="Register">
    </form>
    <?php
        if(isset($_POST["submit"])){
            if($_POST["registerPassword"]==$_POST["registerPassword2"]){
                $queryUsers = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

                $nombre = $_POST["registerUsername"];
                $contr = hash("sha256",$_POST["registerPassword"]);
                $queryUsers->bindParam(1, $nombre);
                $queryUsers->bindParam(2, $contr);
                
                $queryUsers->execute();
                $rowUsers = $queryUsers->fetch();
            }
            else{
                echo "<p>Las contraseñas no coinciden</p>";
            }
            
        }
        

    ?>
    
    </body>
</html>