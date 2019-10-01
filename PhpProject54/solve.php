<?php
    if(empty($_POST['solution']))
    {
        echo "<p>You didn't give a solution.</p>";
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
                mysqli_select_db($DBConnect, $DBName);
                $tick_num = $_GET['id'];
                $TableName = "ticket";
                $solution = htmlentities($_POST['solution']);
                $Status = 'Resolved';
                $SQL = "update ". $TableName ." set solution=?, Status =?  where TicketNumber=?";
                if ($stmt = mysqli_prepare($DBConnect, $SQL)) 
                {
                    mysqli_stmt_bind_param($stmt, 'ssi', $solution, $Status, $tick_num);
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
                        header('Location: employee.php?page=solve&success=1');
                        //echo "<a href='employee_solve.php?id=".$tick_num."'>go back</a>";
                    }
                    //Clean up the $stmt after use
                    mysqli_stmt_close($stmt);
                }
                mysqli_close($DBConnect);
            }
        }
            
    }
?>
