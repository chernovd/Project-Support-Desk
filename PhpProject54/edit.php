<?php
    if(isset($_POST['submit']))
    {
        
        $DBConnect = mysqli_connect("127.0.0.1", "root", "");
        if ($DBConnect === FALSE)
        {
            echo "<p>Unable to connect to the database server.</p>"
                . "<p>Error code " . mysqli_errno() . ": "
                . mysqli_error() . "</p>";
        }
        else 
        {
            $DBName = "supportdesk";
            if (!mysqli_select_db($DBConnect, $DBName)) 
            {
                echo "<p>no such database</p>";
            }   
            else
            {
                mysqli_select_db($DBConnect, $DBName);
                $TicketNumber = htmlentities($_POST['ticket']);
                $CustomerID = htmlentities($_POST['customer']);
                $OperatorID = htmlentities($_POST['operator']);
                
                $DateSubmitted = htmlentities($_POST['d_open']);
                $DateClosed = htmlentities($_POST['d_close']);
                $OS = htmlentities($_POST['OS']);
                $SoftwareVersion = htmlentities($_POST['software']);
                $TicketDescription = htmlentities($_POST['description']);
                $Status = htmlentities($_POST['status']);
                $Solution = htmlentities($_POST['solution']);
                //database update
                $TableName = "ticket";
                $SQL = "update ". $TableName ." set TicketNumber=?, CustomerID=?, OperatorID=?, DateSubmitted=?, DateClosed=?, OS=?, SoftwareVersion=?, TicketDescription=?, Status=?, Solution=? where TicketNumber=?";
                if ($stmt = mysqli_prepare($DBConnect, $SQL)) 
                {
                    mysqli_stmt_bind_param($stmt, 'iiisssssssi', $TicketNumber,$CustomerID, $OperatorID, $DateSubmitted, $DateClosed, $OS, $SoftwareVersion,$TicketDescription, $Status, $Solution, $TicketNumber);
                    $QueryResult = mysqli_stmt_execute($stmt);
                    if ($QueryResult === FALSE) 
                    {
                        echo "<p>Unable to enter solution.</p>"
                            . "<p>Error code "
                            . mysqli_errno($DBConnect)
                            . ": "
                            . mysqli_error($DBConnect)
                            . "</p>";
                    } 
                    else 
                    {
                        header('Location: teamleader.php?page=edit&success=1&id=' . $TicketNumber . "'");
                        exit();
                    }
                    //Clean up the $stmt after use
                    mysqli_stmt_close($stmt);
                }
                mysqli_close($DBConnect);
            }
        }
            
    }
?>
