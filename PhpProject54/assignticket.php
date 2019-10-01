<?php

if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION['e_id']) && isset($_GET['id']))
{
    include('includes/dbh-inc.php');
    
    $TableName = 'ticket';
    
    $OperatoID = $_SESSION['e_id'];
    $ticketNumber = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $Status = 'Pending';
    
    $query = 'UPDATE ' .$TableName. ' SET OperatorID = ?, Status = ? WHERE TicketNumber = ?';
    if($stmt = mysqli_prepare($conn, $query))
    {
       if(mysqli_stmt_bind_param($stmt, 'isi', $OperatoID, $Status, $ticketNumber))
       {
           if(mysqli_stmt_execute($stmt))
           {
               header('Location: employee.php?page=overview&error=success');
           }
           else
           {
               echo 'executing error';
           }
       }
       else
       {
           echo 'binding error';
       }
    }
 else        
 {
    echo 'preparing error'; 
 }
    
    
}
 else 
 {
//     header ('Location: employee.php');
//     exit();
     echo 'aaa';
 }

?>

