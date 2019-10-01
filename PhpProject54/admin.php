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
            
            include('headerWithoutMaint.php');

            if (!isset($_GET['page']) || $_GET['page'] == 'edit')
                    {
                        include ('employeelist.php');
                    }
                    elseif ($_GET['page'] == 'signup')
                    {
                        include ('eSignUpForm.php');
                    }
                    


                    include ('footer.php');
}
  
  ?>
    </body>
</html>

