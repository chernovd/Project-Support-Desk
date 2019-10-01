<div class='container'>
    <div class="backgroundimg">
        <div class="loginbox">

                <div class="formheader">
                    <h1>Log In </h1>
                </div>
                <?php
                if (isset($_GET['login'])) {
                 $error = $_GET['login']; 
                 if ($error == 'empty') 
                     echo "<p>Please fill all of the inputs.</p>";
                 elseif ($error == 'error2') 
                     echo "<p>Username or password doesn't match.</p>";    
                }
                ?> 
                <form class='loginform' action="includes/login-inc.php" method="POST">
                    <input type="text" name="uid" placeholder="Username">
                    <br>
                    <input type="password" name="pwd" placeholder="Password">
                    <br>
                    <input class='button' type="submit" name="submit" value="Log In">
                    
                </form>
                
            <a class='button' href="index2.php?page=elogin" style='color:black;'>Login as an employee</a>
                
                

                
        </div>
    </div>
</div>