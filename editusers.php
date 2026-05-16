<!DOCTYPE html>
<html>

<body>
    <form method="post">
        <input type="text" name="search_email" placeholder="Enter player email">
        <input type="hidden" name="action" value="search">
        <button type="submit">Search</button>
    </form>

    <?php
    include_once("connection.php");

    $player=null;
    $searched=false;

    if(isset($_POST['action'])){
        $searched=true;
        $search_email=$_POST['search_email'];

        $stmt1=$conn->prepare("SELECT * FROM tblplayers WHERE Email=:Email");
        $stmt1->bindParam(":Email", $search_email);
        $stmt1->execute();
        $result=$stmt1->fetch(PDO::FETCH_ASSOC);
        
        
        if($result !== false){
            $player=$result;
        }
        
    }
?>

<?php if($searched && $player===null){ ?>
        <p>No player found with that email.</p>

    <?php } elseif($player!==null){ ?>
        <h3><?php echo($player['Firstname'].' '.$player['Lastname']); ?></h3>
        <form method="post">

            <input type="hidden" name="action" value="update">
            <input type="hidden" name="PlayerID" value="<?php echo($player['PlayerID']); ?>">
            Firstname: <input type="text" name="Firstname" value="<?php echo($player['Firstname']); ?>"><br>
            Lastname: <input type="text" name="Lastname" value="<?php echo($player['Lastname']); ?>"><br>
            Email: <input type="text" name="Email" value="<?php echo($player['Email']); ?>"><br>
            Position: <input type="text" name="PositionID" value="<?php echo($player['PositionID']); ?>"><br>
            Role: <input type="number" name="Role" value="<?php echo($player['Role']); ?>"><br>
            New Password (leave blank to keep current): <input type="password" name="password" placeholder="Enter new password"><br>

            <input type="submit" value="Save">

        </form>

    <?php } ?> 

<?php // Save button was pressed
    if(isset($_POST['action']) && $_POST['action']==='update'){

        $id=$_POST['PlayerID'];
        $firstname=$_POST['Firstname'];
        $lastname=$_POST['Lastname'];
        $email=$_POST['Email'];
        $positionid=$_POST['PositionID'];
        $role=$_POST['Role'];


        // Update password
        if($_POST['password']!==''){
            $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt1=$conn->prepare("UPDATE tblplayers SET Firstname=:Firstname, Lastname=:Lastname, Email=:Email, PositionID=:PositionID, Role=:Role, Password=:Password WHERE PlayerID=:id");
            $stmt1->bindParam(":Password", $password);
        }
        else{
            $stmt1=$conn->prepare("UPDATE tblplayers SET Firstname=:Firstname, Lastname=:Lastname, Email=:Email, PositionID=:PositionID, Role=:Role WHERE PlayerID=:id");
        }


        $stmt1->bindParam(":Firstname", $firstname);
        $stmt1->bindParam(":Lastname", $lastname);
        $stmt1->bindParam(":Email", $email);
        $stmt1->bindParam(":PositionID", $positionid);
        $stmt1->bindParam(":Role", $role);
        $stmt1->bindParam(":id", $id);
        $stmt1->execute();
        header("Location: editusers.php");
    }
?>

</body>
</html>