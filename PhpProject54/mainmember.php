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
        if (isset($_SESSION['u_id']))
        {
            $img = strval($_SESSION['u_img']);
            $uid = $_SESSION['u_uid'];
            $main=$_SESSION['u_main'];
            $date = $_SESSION['u_id'];
            $today = date("Y-m-d", time());
            $exp = $_SESSION['u_exp'];
//            if($today < $exp){
//                echo "your licencse is okay";
//            }else {
//                echo "your license is out";
//            }

            //content

            include('headerWithMaint.php');

            if(!isset($_GET['page']))
            {
                include ('memberHomepage.php');
            }
            else
            {
                if($_GET['page'] == 'faq')
                {
                    include('maintfaq.php');
                }
                elseif ($_GET['page'] == 'ticket')
                {
                    header('Location: memberprofile.php?page=ticket');
                }
            }

            include ('footer.php');
        }
        else
        {
            header('Location: index.php');
        }



            ?>
    </body>
</html>


       