<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href='style.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/logo.png">
        <title>
            Stenden|Support 
        </title>
    </head>
    <body>
        <?php
        session_start();
        include_once('includes/dbh-inc.php');
        if (isset($_SESSION['u_id'])) {
            $img = strval($_SESSION['u_img']);
            $uid = $_SESSION['u_uid'];
            $main= $_SESSION['u_main'];
             $reg = $_SESSION['u_date'];
           $end= date("Y-m-d",strtotime(date("Y-m-d",strtotime($reg))."+30 minutes"));
        }
        if ( isset($_SESSION['e_id'])){
             $eid = $_SESSION ['e_uid'];
            $erole = $_SESSION['e_role'];
            //$eimg = ($_SESSION['e_img']);
        }
        set_time_limit(0);
        ?>
        
        <?php 
        
        // Header
        if (!isset($_SESSION['u_id']))
        {
            include ('headerLoggedOut.php');
        }
        else
        {
            if($_SESSION['u_main']="MNT96578438")
            {
                include ('headerWithMaint.php');
            }
            elseif ($_SESSION['u_main']!="MNT96578438")
            {
                include ('headerWithoutMaint.php');
            }
            elseif ($_SESSION['e_role']==="employee" || $_SESSION['e_role']==="admin" || $_SESSION['e_role']==="teamleader")
            {
                include ('headerWithoutMaint.php');
            }
        }
        
        //include 'header.php';
        
        
        // Content
       if(!isset($_SESSION['u_id']) && !isset($_SESSION['e_id']))
       {
           if(!isset($_GET['page']) || $_GET['page'] == 'login')
           {
               include ('logInForm.php');
           }
           elseif(isset($_GET['page']) && $_GET['page'] == 'signup')
           {
               include ('signUpForm.php');
           }
           elseif(isset($_GET['page']) && $_GET['page'] == 'elogin')
           {
               include ('eLogInForm.php');
           }
           
       }
       elseif(isset($_SESSION['u_uid']) && $_SESSION['u_main'] == "MNT96578438")
       {
           header('Location: mainmember.php');
       }
       elseif(isset($_SESSION['u_uid']) && $_SESSION['u_main'] != "MNT96578438")
       {
           header ('Location: nonmember.php');
       }
       elseif(isset($_SESSION['e_uid']) && (isset($_SESSION['e_role']) && $_SESSION['e_role']==="employee"))
       {
           header('Location: employee.php');
       }
       elseif(isset($_SESSION['e_uid']) && (isset($_SESSION['e_role']) && $_SESSION['e_role']==="admin")) 
        {     
           header('Location:admin.php');
        }
      elseif(isset($_SESSION['e_uid']) && (isset($_SESSION['e_role']) && $_SESSION['e_role']==="teamleader")) 
        {
            header('Location:teamleader.php');
        }
       
       
        //include 'logInForm.php';
        
        // Footer
        include 'footer.php';
        ?>
        
        
    </body>
</html>
