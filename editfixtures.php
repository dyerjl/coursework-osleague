<?php
    session_start(); 

    //stops anyone who is not a league manager from opening this page
    if(!isset($_SESSION["role"]) || $_SESSION["role"]!=2){
        echo("you do not have permission to edit fixtures");
        exit();
    }

    include_once("connection.php");

    //works out which fixture is being edited
    $fixtureid=null;
    if(isset($_POST['FixtureID'])){
        $fixtureid=$_POST['FixtureID'];
    }
    elseif(isset($_GET['FixtureID'])){
        $fixtureid=$_GET['FixtureID'];
    }

    //save button was pressed
    $saved=false;
    if(isset($_POST['action']) && $_POST['action']==='update'){

        $team1id=$_POST['Team1ID'];
        $team1goals=$_POST['Team1Goals'];
        $team2id=$_POST['Team2ID'];
        $team2goals=$_POST['Team2Goals'];
        $gameweek=$_POST['Gameweek'];
        $date=str_replace("T", " ", $_POST['Date']).":00";

        $stmt1=$conn->prepare("UPDATE tblfixtures SET Team1ID=:Team1ID, Team1Goals=:Team1Goals, Team2ID=:Team2ID, Team2Goals=:Team2Goals, Gameweek=:Gameweek, Date=:Date WHERE FixtureID=:FixtureID");
        $stmt1->bindParam(":Team1ID", $team1id);
        $stmt1->bindParam(":Team1Goals", $team1goals);
        $stmt1->bindParam(":Team2ID", $team2id);
        $stmt1->bindParam(":Team2Goals", $team2goals);
        $stmt1->bindParam(":Gameweek", $gameweek);
        $stmt1->bindParam(":Date", $date);
        $stmt1->bindParam(":FixtureID", $fixtureid);
        $stmt1->execute();
        $saved=true;
    }

    //gets the fixture that is being edited
    $fixture=null;
    if($fixtureid!==null){
        $stmt1=$conn->prepare("SELECT * FROM tblfixtures WHERE FixtureID=:FixtureID");
        $stmt1->bindParam(":FixtureID", $fixtureid);
        $stmt1->execute();
        $result=$stmt1->fetch(PDO::FETCH_ASSOC);

        if($result !== false){
            $fixture=$result;
        }
    }

    //gets every team so they can be put in the dropdowns
    $stmt1=$conn->prepare("SELECT TeamID,Teamname FROM tblteams");
    $stmt1->execute();
    $teams=$stmt1->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<body>

    <?php if($saved==true){ ?>
        <p>Fixture saved.</p>
    <?php } ?>

    <?php if($fixture===null){ ?>
        <p>No fixture found.</p>

    <?php } else{ ?>
        <h3>Edit fixture <?php echo($fixture['FixtureID']); ?></h3>
        <form method="post">

            <input type="hidden" name="action" value="update">
            <input type="hidden" name="FixtureID" value="<?php echo($fixture['FixtureID']); ?>">
            Home team: <select name="Team1ID">
                <?php foreach($teams as $team){ ?>
                    <option value="<?php echo($team['TeamID']); ?>" <?php if($team['TeamID']==$fixture['Team1ID']){ echo("selected"); } ?>><?php echo($team['Teamname']); ?></option>
                <?php } ?>
                </select><br>
            Home goals: <input type="number" name="Team1Goals" min ="0" max="99" value="<?php echo($fixture['Team1Goals']); ?>"><br>
            Away team: <select name="Team2ID">
                <?php foreach($teams as $team){ ?>
                    <option value="<?php echo($team['TeamID']); ?>" <?php if($team['TeamID']==$fixture['Team2ID']){ echo("selected"); } ?>><?php echo($team['Teamname']); ?></option>
                <?php } ?>
                </select><br>
            Away goals: <input type="number" name="Team2Goals" min ="0" max="99" value="<?php echo($fixture['Team2Goals']); ?>"><br>
            Gameweek: <input type="number" name="Gameweek" min ="1" value="<?php echo($fixture['Gameweek']); ?>"><br>
            Date and time: <input type="datetime-local" name="Date" value="<?php echo((new DateTime($fixture['Date']))->format('Y-m-d\TH:i')); ?>"><br>

            <input type="submit" value="Save">

        </form>

    <?php } ?>

    <br><a href="fixtures.php">Back to fixtures</a>

</body>
</html>