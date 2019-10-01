

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Stenden|Support</title>
    </head>
    <body>
        <?php

session_start();
include_once('includes/dbh-inc.php');
if (isset($_SESSION['e_id'])) {
   
    $eid = $_SESSION['e_uid'];
    $erole=$_SESSION['e_role'];
    
    include ('headerWithoutMaint.php');
    
    if (!isset($_GET['page']) || $_GET['page'] == 'overview')
            {
                //see all tickets + assign some to yourself
                include ('TL_display.php');
            }
            elseif ($_GET['page'] == 'overviewown')
            {
                //see own tickets + solve them
                include ('TL_display_own.php');
            }
            elseif($_GET['page'] == 'solve')
            {
                include ('TL_close.php');
            }
            elseif ($_GET['page'] == 'edit')
            {
                include ('TL_edit.php');
            }
            elseif($_GET['page'] == 'incident')
            {
                include ('incidentoverview.php');
            }
            
            include ('footer.php');
}
  
  ?>
    </body>
</html>
