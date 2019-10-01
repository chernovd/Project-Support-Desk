<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="icon" href="img/logo.png">
        <title>Stenden|Support</title>
    </head>
    <body>
        <?php
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }

        include_once('includes/dbh-inc.php');
        if (isset($_SESSION['u_uid']))
        {
            $img = strval($_SESSION['u_img']);
            $uid = $_SESSION['u_uid'];
            $main=$_SESSION['u_main'];
            $date = $_SESSION['u_id'];
            $today = date("Y-m-d", time());
            $exp = $_SESSION['u_exp'];


            //content

            include('headerWithMaint.php');
            
                if(!isset($_GET['page']))
                {
                    include ('maintprofile.php');
                }
                elseif($_GET['page'] == 'ticket')
                {
                    include('newincident.php');
                }
                elseif($_GET['page'] == 'overview')
                {
                    include('overview.php');
                }
            include ('footer.php');
        }
        else
        {
            header('Location: index2.php?page=login');
        }
        
          ?>
    </body>
</html>


       