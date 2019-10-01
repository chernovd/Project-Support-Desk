<div class="container">
    <div class='banner'>
            <h1>Stenden|Support</h1>
            
    </div>
    <div class="menu">
        <div class="box largebox">
            <a href="admin.php?page=edit"><img src="img/overview.png" alt="ticket icon"></a>
            <p>Edit the employee list</p>
        </div>
        <div class="box largebox">
            <a href="admin.php?page=signup"><img src="img/ticket.png" alt="overview icon"></a>
            <p>Create new account for employee</p>
        </div>
    </div>
    <div class="ticketdisplay">
        <?php
        
            echo "<h2>Employee list</h2>";
            if(isset($_GET['success']))
            {
                echo '<p>The chosen employee was deleted. He will no longer have access to the Stenden|Support platform</p>';
            }
        
         include('includes/dbh-inc.php');
         $TableName = 'employee';
         $query = 'SELECT * FROM '.$TableName. ' WHERE role<>"admin"';
         if($stmt = mysqli_prepare($conn, $query))
        {
           if(mysqli_stmt_execute($stmt))
           {
               if(mysqli_stmt_bind_result($stmt, $employeeID, $eFirstName,$eLastName, $username,$password,$role,$email))
               {
                   mysqli_stmt_store_result($stmt);
                   if(mysqli_stmt_num_rows($stmt)!=0)
                   {
                       echo "<table><tr>";
                       echo "<th>EmployeeID</th>";
                       echo "<th>First Name</th>";
                       echo "<th>Last Name</th>";
                       echo "<th>Username</th>";
                       echo "<th>Role</th>";
                       
                       echo "<th></th></tr>";
                       
                       
                       while(mysqli_stmt_fetch($stmt))
                       {
                           echo "<tr>";
                           echo "<td>".$employeeID."</td>";
                           echo "<td>".$eFirstName."</td>";
                           echo "<td>".$eLastName."</td>";
                           echo "<td>".$username."</td>";
                           echo "<td>".$role."</td>";
                           
                           echo "<td><a href='deleteemployee.php?id=".$employeeID."'>Delete employee</a></td></tr>";
                       }
                       echo '</table>';
                   }
                   else
                   {
                       echo '0 rows returned';
                   }
               }
               else
               {
                   echo 'binding result error';
               }
           }
           else
           {
               echo 'executing error';
           }     
        }
 else        
 {
    echo 'preparing error'; 
 }
    
    
        
        ?>
    </div>
</div>



