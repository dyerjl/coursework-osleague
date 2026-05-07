<?php
    session_start(); //start session if you want to use session variables
    print_r($_POST);
    array_map ("htmlspecialchars",$_POST); // sanitises inputs so no HTML injection
        include_once("connection.php");
        $stmt1= $conn->prepare("SELECT * FROM tblplayers WHERE Email=:Email");
        $stmt1->bindParam(":Email", $_POST["email"]);
        $stmt1->execute();
        while($row = $stmt1->fetch(PDO::FETCH_ASSOC))
        {
            $hashed=$row["Password"];
            $attempt=$_POST["password"];
            //echo($hashed.$attempt);
            
            if (password_verify($attempt,$hashed)){
                echo("valid password");
                $_SESSION["firstname"]=$row["Firstname"];
                $_SESSION["loggedinuser"]=$row["PlayerID"];
                $_SESSION["role"]=$row["Role"];
            }
            else{
                echo("invalid password");
            }
        }
        
?>

