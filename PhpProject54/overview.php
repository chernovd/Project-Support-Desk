<div class="container">
    <div class='banner'>
            <h1>Stenden|Support</h1>
            <p>Ready to assist you with anything!</p>
    </div>
    <div class="menu">
        <div class="box largebox">
            <a href="memberprofile.php?page=ticket"><img src="img/faq.png" alt="ticket icon"></a>
            <p>Submit a new ticket</p>
        </div>
        <div class="box largebox">
            <a href="memberprofile.php?page=overview"><img src="img/renew.png" alt="overview icon"></a>
            <p>Overview of my submitted tickets</p>
        </div>
    </div>
    <div class="ticketdisplay">
        <?php
                
                if(!isset($_SESSION))
                {
                    session_start();
                }
                
                $DBConnect = mysqli_connect("localhost", "root", "");
                if ($DBConnect === FALSE)
                {
                    echo "<p>Unable to connect to the database server.</p>"
                    . "<p>Error code " . mysqli_errno() . ": " . mysqli_error()
                    . "</p>";
                }
                
                else {$DBName = "supportdesk"; 
                if(!mysqli_select_db ($DBConnect, $DBName))
                {
                  echo "<p>Connection to the database failed.</p>";
                }
                
                else {$TableName = "ticket";
                $customerID = $_SESSION['u_id'];
                $SQLstring = "SELECT * FROM ".$TableName. " WHERE CustomerID = ?";
                if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) 
                {
                    mysqli_stmt_bind_param($stmt, 's', $customerID);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $ticketNumber, $cID, $oID, $iID, $dateSubmitted, $dateClosed ,$OS,$softwareVers,$ticketDescription, $status, $solution);
                    mysqli_stmt_store_result($stmt);
                
                    if (mysqli_stmt_num_rows($stmt) == 0) 
                    {

                         echo "<p>You haven't submitted any tickets so far!</p>";
                   }

                   else 
                       {

                        echo "<h1>Tickets overview:</h1>";
                        echo "<table>";
                        echo "<tr><th>TicketNumber</th>
                           <th>Date Submitted</th>
                           <th>Operating system</th>
                          <th>Software version</th>
                          <th>Problem description</th>
                          <th>Status</th>
                          <th>Solution</th></tr>";
                        while (mysqli_stmt_fetch($stmt)) {
                        echo "<tr><td><center>".$ticketNumber."</center></td>";
                        echo "<td><center>".substr($dateSubmitted, 0, 10)."</center></td>";
                        echo "<td><center>".$OS."</center></td>";
                        echo "<td><center>".$softwareVers."</center></td>";
                        echo "<td><center>".$ticketDescription."</center></td>";
                        echo "<td><center>".$status."</center></td>";
                        if($status == 'Closed' || $status == 'Resolved')
                        {
                            echo "<td><center>".$solution."</center></td></tr>";
                        }
                        else
                        {
                            echo "<td><center>-</center></td>";
                        }
                        
                                            
                        
                        }
                        echo '</table>';
                        

                        }
                        mysqli_stmt_close($stmt);
                }
                    } 
                    
                    mysqli_close($DBConnect);
                }
                
                ?>

    </div>
</div>
                
                