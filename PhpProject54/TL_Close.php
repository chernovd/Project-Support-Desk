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
if(isset($_GET['id']))
{
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
            $tick_num = $_GET['id'];
            //currently this only shows the ticket given above
            $SQLstring = "SELECT * FROM ".$TableName." where TicketNumber=?";
            if ($stmt = mysqli_prepare($DBConnect, $SQLstring))
            {
                mysqli_stmt_bind_param($stmt, 'i', $tick_num);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $TicketNumber,$CustomerID, $OperatoID, $IncidentID, $DateSubmitted, $DateClosed, $OS,$SoftwareVersion,$TicketDescription,$Status,$Solution);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 0)
                {
                    echo "<p></p>";
                    mysqli_stmt_close($stmt);
                }
                else
                {
                    mysqli_stmt_fetch($stmt);
                    echo "<h1>Your selected ticket is:".$TicketNumber."</h1>";
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
                            <th>Solution</th></tr>";
                    echo "<tr><td>".$TicketNumber."</td>
                    <td>".$CustomerID."</td>
                    <td>".$OperatoID."</td>
                    
                    <td>".substr($DateSubmitted, 0, 10)."</td>";
                    if($Status == 'Closed')
                    {
                        echo "<td>".substr($DateClosed,0,10)."</td>";
                    }
                    else
                    {
                        echo "<td>-</td>";
                    }
                    
                    echo "<td>".$OS."</td>
                    <td>".$SoftwareVersion."</td>
                    <td>".$TicketDescription."</td>
                    <td>".$Status."</td>";
                     if($Status == 'Resolved' || $Status == 'Closed')
                     {
                         echo "<td>".$Solution."</td></tr>";
                     }
                    else
                    {
                        echo "<td>-</td>";
                    }
                    echo "</table>";
                }mysqli_close($DBConnect);
            }   
        }
    }
}
?>
<h2>Solve ticket and close it</h2>

        <?php if(isset($_GET['success']))
        {
            echo '<p>The ticket was updated!</p>';
        }
        elseif (isset($_GET['error']))
        {
            echo '<p>No changes were made to the ticket.</p>';
        }
?>
        <form class="ticketform" method="POST" action="close.php?id=<?php echo $TicketNumber?>">
            <p>Status</p> 
<!--            <input type="text" name="status" required value="<?php echo $Status?>"/>-->
            <select name='status'>
                <option value='Pending' <?php if(isset($Status) && $Status == 'Pending'){echo 'selected';} ?>>Pending</option>
                <option value='Closed' <?php if(isset($Status) && $Status == 'Closed'){echo 'selected';} ?>>Closed</option>
            </select>
            <p>Solution</p> 
            <textarea rows="4" cols="50" name="solution"/><?php if(isset($Solution)){echo $Solution;}?></textarea>
            <p><input type="submit" value="Submit" /></p>
        </form>

    </div>
</div>