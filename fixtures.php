<?php
    session_start(); 
    include_once("connection.php");

    //checks if the logged in user is a league manager
    $leaguemanager=false;
    if(isset($_SESSION["role"]) && $_SESSION["role"]==2){
        $leaguemanager=true;
    }

    //works out which gameweek has been chosen in the dropdown
    $chosengameweek="";
    if(isset($_GET["Gameweek"])){
        $chosengameweek=$_GET["Gameweek"];
    }

    //gets every gameweek that has fixtures so they can be listed in the dropdown
    $stmt2=$conn->prepare("SELECT DISTINCT Gameweek FROM tblfixtures ORDER BY Gameweek");
    $stmt2->execute();
    $gameweeks=$stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE HTML>
<html>
<body>

<!-- Gameweek dropdown -->
<form action="fixtures.php" method="get">
    Gameweek: <select name="Gameweek">
        <?php foreach($gameweeks as $gameweek){ ?>
            <option value="<?php echo($gameweek['Gameweek']); ?>" <?php if($gameweek['Gameweek']==$chosengameweek){ echo("selected"); } ?>>Gameweek <?php echo($gameweek['Gameweek']); ?></option>
        <?php } ?>
        </select>
    <input type="submit" value="Show">
</form>

    <table>

    
<?php
            include_once("connection.php");
            $stmt1= $conn->prepare("SELECT FixtureID,Date,Team1Goals,Team2Goals, home.Teamname as HTN,away.Teamname as ATN FROM tblfixtures 
            INNER JOIN tblteams as home
            on (tblfixtures.Team1ID = home.TeamID)
            INNER JOIN tblteams as away
            on (tblfixtures.Team2ID = away.TeamID)
            WHERE Gameweek=:Gameweek");
            $stmt1->bindParam(":Gameweek", $chosengameweek);
            $stmt1->execute();
            while($row=$stmt1->fetch(PDO::FETCH_ASSOC))
        {
            echo("<br>"." ");
            echo($row["HTN"]." ");
            echo($row["Team1Goals"]." ");
            echo((new DateTime($row["Date"]))->format('H:i:s')." ");
            echo($row["Team2Goals"]." ");
            echo($row["ATN"]." ");

            //only league managers are shown the button to edit the fixture
            if($leaguemanager==true){
                echo('<form action="editfixtures.php" method="get" style="display:inline">');
                echo('<input type="hidden" name ="FixtureID" value="'.$row["FixtureID"].'">');
                echo('<input type="submit" value="Edit fixture">');
                echo("</form>");
            }
           

        }
            
        
        
        ?>
    </table>
</body>

</html>