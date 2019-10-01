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
        if(isset($_GET['error']) && $_GET['error'] == 'success')
        {
            echo '<p>You have successfully assigned a ticket to yourself!</p>';
        }
        
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
                $SQLstring = "SELECT * FROM ".$TableName. " WHERE Status LIKE 'Open'";
                if ($stmt = mysqli_prepare($DBConnect, $SQLstring))
                {
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $TicketNumber,$CustomerID, $OperatoID, $IncidentID, $DateSubmitted, $DateClosed, $OS,$SoftwareVersion,$TicketDescription,$Status,$Solution);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 0)
                    {
                        echo "<p>error</p>";
                    }
                    else
                    {
                        echo "<table>";
                        echo "<tr><th>Ticket Number</th>";
                        echo "<th>Date Submitted</th>";
                        echo "<th>OS</th>";
                        echo "<th>Software Version</th>";
                        echo "<th>Ticket Description</th>";
                        echo "<th>Status</th>";
                        echo "<th></th></tr>";
                        while (mysqli_stmt_fetch($stmt))
                        {
                            $DateSubmitted = substr($DateSubmitted, 0, 10);
                            echo "<tr><td>".$TicketNumber."</td>";
                            echo "<td>".$DateSubmitted."</td>";
                            echo "<td>".$OS."</td>";
                            echo "<td>".$SoftwareVersion."</td>";
                            echo "<td>".$TicketDescription."</td>";
                            echo "<td>".$Status."</td>";
                            if ($Status === 'Open')
                            {
                                echo "<td><a href='assignticket.php?id=".$TicketNumber."'>Assign ticket</a></td></tr>";
                            }
                            else
                            {
                                echo "<td>-</td></tr>";
                            }
                            
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
                
