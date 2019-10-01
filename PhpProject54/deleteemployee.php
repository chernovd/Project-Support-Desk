<?php

if(isset($_GET['id']))
{
    $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    
    include('includes/dbh-inc.php');
    $TableName = 'employee';
    $query = 'DELETE FROM '.$TableName.' WHERE EmployeeID=?';
    if($stmt = mysqli_prepare($conn, $query))
    {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if(mysqli_stmt_execute($stmt))
        {
            header('Location: admin.php?page=edit&success=yes');
        }
        
    }
    else
    {
        echo 'preparing error';
    }
}

?>

