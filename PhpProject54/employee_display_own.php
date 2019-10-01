


<div class="container">
    <div class='banner'>
            <h1>Stenden|Support</h1>
            
    </div>
    <div class="menu">
        <div class="box largebox">
            <a href="employee.php?page=overview"><img src="img/overview.png" alt="ticket icon"></a>
            <p>Overview of all open tickets</p>
        </div>
        <div class="box largebox">
            <a href="employee.php?page=overviewown"><img src="img/ticket.png" alt="overview icon"></a>
            <p>Overview of my assigned tickets</p>
        </div>
    </div>
    <div class="ticketdisplay">
        <?php
$DBName = "supportdesk";
$DBConnect = mysqli_connect("127.0.0.1", "root", "");
if ($DBConnect === FALSE)
{
    echo "<p>Unable to connect to the database server.</p>"
    . "<p>Error code " . mysqli_errno($DBConnect) . ": "
    . mysqli_error($DBConnect) . "</p>";
}
else
{
    $db=mysqli_select_db ($DBConnect, $DBName);
    if ($db === FALSE)
    {
        echo "<p>Unable to connect to the database server.</p>"
        . "<p>Error code " . mysqli_errno($DBConnect) . ": "
        . mysqli_error($DBConnect) . "</p>";
        mysqli_close($DBConnect);
        $DBConnect = FALSE;
    }
    else
    {
        $TableName = "ticket";
        $OperatorID = $_SESSION['e_id'];
        $SQLstring = "SELECT * FROM ".$TableName." WHERE OperatorID = ?";
        if ($stmt = mysqli_prepare($DBConnect, $SQLstring))
        {
            mysqli_stmt_bind_param($stmt,'i',$OperatorID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $TicketNumber,$CustomerID, $OperatoID, $IncidentID, $DateSubmitted, $DateClosed, $OS,$SoftwareVersion,$TicketDescription,$Status,$Solution);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 0)
            {
                echo "<p>You have no tickets available.</p>";
                //mysqli_stmt_close($stmt);
            }
            else
            {

                echo "<table>";
                echo "<tr><th>Ticket Number</th>
                        <th>Date Submitted</th>
                        <th>Date Closed</th>
                        <th>OS</th>
                        <th>Software version</th>
                        <th>Ticket Description</th>
                        <th>Status</th>
                        <th></th></tr>";
                while (mysqli_stmt_fetch($stmt)) 

                {
                    $id= $TicketNumber;
                    echo "<tr><td>".$TicketNumber."</td>";
                    echo "<td>".substr($DateSubmitted, 0, 10)."</td>";
                    if($Status == 'Closed')
                    {
                        echo "<td>". substr($DateClosed, 0, 10)."</td>";
                    }
                    else
                    {
                        echo "<td>-</td>";
                    }
                    
                    echo "<td>".$OS."</td>";
                    echo "<td>".$SoftwareVersion."</td>";
                    echo "<td>".$TicketDescription."</td>";
                    echo "<td>".$Status."</td>";
                    echo "<td><a href='employee.php?page=solve&id=".$id."'>Solve ticket</a></td></tr>";
                }
                echo "</table>";
               mysqli_stmt_close($stmt);
            }   
        }  
    }
}

mysqli_close($DBConnect);
?>
    </div>
</div>
                
