<div class="container">
    <div class="backgroundimg">
        <div class="loginbox">
            <div class='formheader'>
                <h2>Sign Up</h2>
            </div>
            <?php
          if (isset($_GET['signup'])) {
                $error = $_GET['signup'];
                if ($error == 'empty'){
                    echo "Please fill in all of the fields";
                } else {

                    if ($error == 'email') {
                        echo "Please provide a valid email";
                    } elseif ($error == 'usertaken') {
                       
                            echo "Usename is already taken";
                    }elseif ($error=='role'){
                    echo"Please fill a product key"; }
                    else {
                        echo "<p>Your account has been created! You can now login</p>";
                    }
                }
          }
            ?>
            <form method="POST" class="signupform" action="includes/signup-inc.php" enctype="multipart/form-data">
                <input type="text" name="email" placeholder='Email*' ><br>
                <input type="text" name="uid" placeholder="Username*" ><br>
                <input type="password" name="pwd"placeholder="Password*" ><br>
                <input type="text" name="mein" placeholder="Maintenance license, if you have one"><br>
                <input type="text" name="fname" placeholder="First name*" ><br>  
                <input type="text" name="lname" placeholder="Last name*"><br>
                <input type="text" name="pnum" placeholder="Phone*"><br>
                <input class='button' type="submit" name="submit" value='Sign Up'>
            </form>
            
            
            
        </div>
    </div>
</div>
            