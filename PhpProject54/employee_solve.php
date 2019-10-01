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
                    echo "<table width='100%' border='1'>";
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
                            
                            <td>".substr($DateSubmitted,0,10)."</td>";
                            if($Status != 'Closed' && $Status != 'Resolved')
                    {
                        echo "<td>-</td>";
                    }
                    else
                    {
                        echo "<td>".$DateClosed."</td>";
                    }
                            echo "<td>".$OS."</td>
                            <td>".$SoftwareVersion."</td>
                            <td>".$TicketDescription."</td>
                            <td>".$Status."</td>";
                            if($Status != 'Closed' && $Status != 'Resolved')
                            {
                                echo "<td>-</td></tr></table>";
                            }
                            else
                            {
                                echo " <td>".$Solution."</td></tr></table>";
                            }
                           
                }mysqli_close($DBConnect);
            }   
        }
    }
}
?>
<h2>Propose Solution</h2>
        <?php  if(isset($_GET['success']))
        {
            echo '<p>Your solution was submitted.</p>';
        }
?>
        <form class='ticketform' method="POST" action="solve.php?id=<?php echo $TicketNumber?>">
            <p>Solution:</p> 
            <textarea rows="4" cols="50" name="solution"/><?php if(isset($Solution)) {echo $Solution;}?></textarea>
            <p><input type="submit" value="Submit" /></p>
        </form>

    </div>
</div>