<!DOCTYPE HTML>
<html>
<body>
    <table>

    
<?php
            include_once("connection.php");
            $stmt1= $conn->prepare("SELECT Date,Team1Goals,Team2Goals, home.Teamname as HTN,away.Teamname as ATN FROM tblfixtures 
            INNER JOIN tblteams as home
            on (tblfixtures.Team1ID = home.TeamID)
            INNER JOIN tblteams as away
            on (tblfixtures.Team2ID = away.TeamID)");
            $stmt1->execute();
            while($row=$stmt1->fetch(PDO::FETCH_ASSOC))
        {
            echo("<br>"." ");
            echo($row["HTN"]." ");
            echo($row["Team1Goals"]." ");
            echo((new DateTime($row["Date"]))->format('H:i:s')." ");
            echo($row["Team2Goals"]." ");
            echo($row["ATN"]." ");
            //echo($row["Name"]." ".$row["Description"]." ".$row["Price"]);
            //echo('<input type="number" name ="qty" min ="1" max="5" value="1">');
            //echo('<input type="hidden" name ="foodid" value='.$row["FoodID"].'>');
            //echo('<input type="submit" value="Add to basket">');
            //echo("</form>");

        }
            
        
        
        ?>
    </table>
</body>

</html>