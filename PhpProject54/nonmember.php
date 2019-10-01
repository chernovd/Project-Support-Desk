

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8">
        <link rel="icon" href="img/logo.png">
        <title>Stenden|Support</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php 
        
        session_start();
        include_once('includes/dbh-inc.php');
        if (isset($_SESSION['u_id'])) {
            $img = strval($_SESSION['u_img']);
            $uid = $_SESSION['u_uid'];
            $main=$_SESSION['u_main'];
            
            include 'headerWithoutMaint.php'; 
            
            
            include ('nonmembercontent.php');
            
            if (isset($_GET['page']) && $_GET['page'] == 'upgrade')
            {
                echo "<div class='ticketdisplay' >
                <p>In order to purchase a maintenance license, you have to confirm your username and password. An email will then be sent with the invoice.
                   The conversion to a maintenance user will be done automaticaly.</p>";
                if(isset($_GET['success']) && $_GET['success'] == 'yes')
                {
                    echo "<p style='color:purple;'>Your account has been upgraded! Log out and login again to complete the process.</p>";
                }
                elseif(isset($_GET['success']) && $_GET['success'] == 'key')
                {
                    echo "<p style='color:purple;'>The key you provided is not correct!</p>";
                }
                    
               echo "<form class='ticketform' action='upgrade.php' method='post'>
                   <input type='text' name='usn' placeholder='Username'>
                   <br>
                   <input type='password' name='password' placeholder='Password'>
                   <br>
                   <input type='text' name='maintenance' placeholder='Maintenance license key'>
                   <p>Are you sure you want to proceed with this action?</p>
                   <input type='radio' name='proceed' value='yes' checked>Yes
                   <input type='radio' name='proceed' value='no'>No
                   <br>
                   <input type='submit' name='upgrade' value='Submit'>
               </form>
           </div>";
            }
            
            include 'footer.php';
        }
        
        
          ?>
    </body>
</html>



