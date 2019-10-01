

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
//currently the same as employee_display
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
        $SQLstring = "SELECT * FROM ".$TableName;
        if ($stmt = mysqli_prepare($DBConnect, $SQLstring))
        {
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
                        <th>Customer ID</th>
                        <th>Operator ID</th>
                        
                        <th>Date Submitted</th>
                        <th>Date Closed</th>
                        <th>OS</th>
                        <th>Software version</th>
                        <th>Ticket Description</th>
                        <th>Status</th>
                        <th>Close</th>
                        <th>Edit</th></tr>";
                while (mysqli_stmt_fetch($stmt)) 
                {
                    $id= $TicketNumber;
                    echo "<tr><td>".$TicketNumber."</td>";
                    echo "<td>".$CustomerID."</td>";
                    echo "<td>".$OperatoID."</td>";
                    
                    echo "<td>".substr($DateSubmitted,0,10)."</td>";
                    if($Status != 'Closed')
                    {
                        echo "<td>-</td>";
                    }
                    else
                    {
                        echo "<td>".substr($DateClosed,0,10)."</td>";
                    }
                    
                    echo "<td>".$OS."</td>";
                    echo "<td>".$SoftwareVersion."</td>";
                    echo "<td>".$TicketDescription."</td>";
                    echo "<td>".$Status."</td>";
                    if($Status != 'Closed')
                    {
                        echo "<td><a href='teamleader.php?page=solve&id=".$id."'>Solve or Close a Ticket</a>";
                        echo "<td><a href='teamleader.php?page=edit&id=".$id."'><b>Edit Ticket Information</b></a></td></tr>";
                    }
                    else
                    {
                        echo "<td>-</td><td>-</td></tr>";
                    }
                    
                }
                echo "</table>";
                mysqli_close($DBConnect);
            }   
        } 
    }
}
?>
    </div>
</div>