<div class='container'>
    <div class="backgroundimg">
        <div class="loginbox">

                <div class="formheader">
                    <h1>Login as an employee</h1>
                </div>
                <?php
                if (isset($_GET['login'])) {
                 $error = $_GET['login']; 
                 if ($error == 'empty') 
                     echo "<b>Please fill in all the inputs</b>";
                 elseif ($error == 'error2') 
                     echo "<b>Username and password don't match</b>";    
                }
                ?> 
                <form class='loginform' action="includes/elogin-inc.php" method="POST">
                    <input type="text" name="uid" placeholder="Username">
                    <br>
                    <input type="password" name="pwd" placeholder="Password">
                    <br>
                    <input class='button' type="submit" name="submit" value="Log in">
                </form>

                
        </div>
    </div>
</div>