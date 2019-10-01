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
                    if($Status != 'Closed')
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
                        echo "<td>-</td>";
                    }
                    else
                    {
                        echo "<td>".$Solution."</td></tr>";
                    }
                    
                    echo "</table>";
                }mysqli_close($DBConnect);
            }   
        }
    }
}
?>
<h2>Edit information</h2>

        <?php  if(isset($_GET['success']))
        {
            echo '<p>The ticket was updated!</p>';
        }
?>
        <form class='ticketform' method="POST" action="edit.php?id=<?php echo $TicketNumber?>">
            <p>Ticket Number</p>
            <input type="number" min="0" name="ticket" required value="<?php if(isset($TicketNumber)){echo $TicketNumber;}?>"/>
            <p>Customer ID</p> 
            <input type="number" min="0" name="customer" required value="<?php if(isset($CustomerID)){echo $CustomerID;}?>"/>
            <p>Operator ID</p> 
            <input type="number" min="0" name="operator" required value="<?php if(isset($OperatorID)){echo $OperatoID;}?>"/>
            <p>Date Submitted</p>
            <p><i>Please do not to change the format</i></p>
            <input type="text" name="d_open" required value="<?php if(isset($DateSubmitted)){echo substr($DateSubmitted,0,10);}?>"/>
            <p>Date Closed</p>
            <p><i>Please do not to change the format</i></p>
            <input type="text" name="d_close" required value="<?php if(isset($DateClosed)){echo substr($DateClosed,0,10);}?>"/>
            <p>OS</p> 
            <input type="radio" name="OS" value="Linux" <?php if($OS=='Linux'){echo 'checked';} ?>>Linux
            <input type="radio" name="OS" value="Mac" <?php if($OS=='Mac'){echo 'checked';} ?>>Mac
            <input type="radio" name="OS" value="Windows" <?php if($OS=='Windows'){echo 'checked';} ?>>Windows
            <p>Software version</p> 
            <input type="text" name="software" required value="<?php echo $SoftwareVersion?>"/>
            <p>Ticket Description</p> 
            <textarea rows="4" cols="50" name="description"/><?php echo $TicketDescription?></textarea>
            <p>Status</p> 
            <select name='status'>
                <option value='Open' <?php if($Status == 'Open') {echo 'selected';} ?>>Open</option>
                <option value='Pending' <?php if($Status == 'Pending') {echo 'selected';} ?>>Pending</option>
                <option value='Resolved' <?php if($Status == 'Resolved') {echo 'selected';} ?>>Resolved</option>
                <option value='Closed' <?php if($Status == 'Closed') {echo 'selected';} ?>>Closed</option>
            </select>
            <p>Solution</p> 
            <textarea rows="4" cols="50" name="solution"/><?php echo $Solution?></textarea>
            <p><input type="submit" name='submit' value="Submit" /></p>
        </form>
    </div>
</div>