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
          if (isset($_GET['signup'])) {
                $error = $_GET['signup'];
                if ($error == 'empty'){
                    echo "<p>Please fill out all of the inputs!</p>";
                } else {

                    if ($error == 'email') {
                        echo "<p>Please provide a valid email</p>";
                    } elseif ($error == 'usertaken') {
                       
                            echo "<p>Usename is already taken.</p>";
                    }elseif ($error=='role'){
                    echo "<p>Please fill in a role.</p>"; }
                    
                }
          }
          if(isset($_GET['success']))
          {
              echo '<p>Your account was created! You can now log in.</p>';
          }
            ?>
            <form method="POST" class="ticketform" action="includes/esignup-inc.php" enctype="multipart/form-data">
                <input type="text" name="email" placeholder='Email' ><br>
                <input type="text" name="uid" placeholder="Username" ><br>
                <input type="password" name="pwd"placeholder="Password" ><br>
                <input type="text" name="mein" placeholder="Role"><br>
                <input type="text" name="fname" placeholder="First name" ><br>  
                <input type="text" name="lname" placeholder="Last name"><br>
                <input type="submit" name="submit" value='Create account'>
            </form>
    </div>
</div>
            
