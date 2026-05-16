<?php
    include_once("connection.php");
    print_r($_POST);
    
    $role=0;
    
    $hashedpassword=password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt1 = $conn->prepare("INSERT INTO tblplayers
    (PlayerID, Firstname, Lastname, Email, Password, PositionID, Role)
    VALUES
    (NULL, :Firstname, :Lastname, :Email, :Password, :PositionID, :Role)
    "); 
    $stmt1->bindParam(":Firstname", $_POST["firstname"]);
    $stmt1->bindParam(":Lastname", $_POST["lastname"]);
    $stmt1->bindParam(":Email", $_POST["email"]);
    $stmt1->bindParam(":Password", $hashedpassword);
    $stmt1->bindParam(":PositionID", $_POST["positionid"]);
    $stmt1->bindParam(":Role", $role);
    
    $stmt1->execute();


?>

