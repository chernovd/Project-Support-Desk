<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Stenden|Support</title>
    </head>
    <body>
<?php
include('headerWithoutMaint.php');
?>

<div class="container">
    <div class='banner'>
            <h1>Stenden|Support</h1>
            
    </div>
    <div class="menu">
        <div class="box">
            <a href="teamleader.php?page=overview"><img src="img/overview.png" alt="ticket icon"></a>
            <p>Overview of all submitted tickets</p>
        </div>
        <div class="box">
            <a href="teamleader.php?page=overviewown"><img src="img/ticket.png" alt="overview icon"></a>
            <p>Overview my assigned tickets</p>
        </div>
        <div class="box">
            <a href="teamleader.php?page=incident"><img src="img/incident.png" alt="overview icon"></a>
            <p>Overview off incidents</p>
        </div>
    </div>
    <div class="ticketdisplay">
        
        <?php
        if(isset($_POST['submit']))
        {
            include('includes/dbh-inc.php');
            $category = $_POST['category'];
            $TableName1 = 'ticket';
            $TableName2 = 'incident';
            echo '<h2>These are the tickets in the chosen category:</h2>';
            $query = 'SELECT CustomerID, OperatorID, DateSubmitted, DateClosed, OS, SoftwareVersion, TicketDescription, Status, Solution'
                    . ' FROM '.$TableName1.' WHERE ticket.IncidentID=?';
            if($stmt = mysqli_prepare($conn,$query))
            {
                mysqli_stmt_bind_param($stmt,'i', $category);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $CustomerID, $OperatoID, $DateSubmitted, $DateClosed, $OS, $SoftwareVersion, $TicketDescription, $Status, $Solution);
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) != 0)
                {
                    echo "<table>";
                    echo "<tr><th>CustomerID</th>";
                    echo "<th>OperatorID</th>";
                    echo "<th>DateSubmitted</th>";
                    echo "<th>DateClosed</th>";
                    echo "<th>OS</th>";
                    echo "<th>SoftwareVersion</th>";
                    echo "<th>TicketDescription</th>";
                    echo "<th>Status</th>";
                    echo "<th>Solution</th></tr>";
                    while(mysqli_stmt_fetch($stmt))
                    {
                        echo "<tr>";
                        echo "<td>".$CustomerID."</td>"
                           . "<td>".$OperatoID."</td>"
                           ."<td>".substr($DateSubmitted,0,10)."</td>";
                            if($Status == 'Closed')
                            {
                                echo "<td>".substr($DateClosed,0,10)."</td>";
                            }
                            else
                            {
                                echo "<td>-</td>";
                            }
                        echo "<td>".$OS."</td>";
                        echo "<td>".$SoftwareVersion."</td>";
                        echo "<td>".$TicketDescription."</td>";
                        echo "<td>".$Status."</td>";
                        if($Status == 'Closed' || $Status == 'Resolved')
                        {
                            echo "<td>".$Solution."</td></tr>";
                        }
                        else
                        {
                            echo "<td>-</td></tr>";
                        }
                           
                    }
                    echo '</table>';
                    mysqli_stmt_close($stmt);
                }
                else
                {
                    echo 'no rows were returned';
                }
                mysqli_close($conn);
            }
            
            else
            {
                echo 'preparing error';
            }
        }
       
       ?>
    </div>
</div>
<?php
include('footer.php');
?>

</body>
</html>