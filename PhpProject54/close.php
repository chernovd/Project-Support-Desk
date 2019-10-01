<?php
    if(empty($_POST['solution']) || empty($_POST['status']))
    {
        echo "<p>You didn't change anything.</p>";
    }
    else 
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
                
                $tick_num = $_GET['id'];
                mysqli_select_db($DBConnect, $DBName);
                $Status = htmlentities($_POST['status']);
                $Solution = htmlentities($_POST['solution']);
                $DateClosed = date('Y/m/d H:i:s');
                //database update
                $TableName = "ticket";
                $SQL = "update ". $TableName ." set Status=?, Solution=?, DateClosed=? where TicketNumber=?";
                if ($stmt = mysqli_prepare($DBConnect, $SQL)) 
                {
                    mysqli_stmt_bind_param($stmt, 'sssi', $Status, $Solution, $DateClosed, $tick_num);
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
                        header('Location: teamleader.php?page=solve&success=1');
                        exit();
                    }
                    //Clean up the $stmt after use
                    mysqli_stmt_close($stmt);
                }
                else
                {
                    echo 'prepare';
                }
                mysqli_close($DBConnect);
            }
        }
            
    }
?>