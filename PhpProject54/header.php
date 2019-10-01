<?php
 if(!isset($_SESSION))
        {
            session_start();
        }

if (!isset($_SESSION['u-id']))
        {
    /****************************
     * HEADER LOGGED OUT
     ******************************/
            echo "<div class='header'>
	<div class='menu-list'>
            <p>Stenden|Support</p>
	</div>
	<div class='logo'>
            <a href='index2.php?page=login'><img src='img/logo.png' alt='Stenden Logo'></a>
	</div>
	<div class='option'>
            <a href='index2.php?page=signup'>Sign Up</a>
	</div>
</div>";
        }
        else
        {
            if($_SESSION['u_main']="MNT96578438")
            {
                /************************
                 * HEADER WITH MAINT
                 ************************/
                 echo "<div class='header'>
	<div class='menu-list'>
            <ul>
                <li><a href='mainmember.php'>Home</a></li>
                <li><a href='memberprofile.php'>My profile</a></li>
            </ul>
	</div>
            <div class='logo'>
            <a href='mainmember.php'><img src='img/logo.png' alt='Stenden Logo'></a>
	</div>
	<div class='option'>
            <img class='profileicon' src= 'img/" . $img . "' alt='usericon'>
            <form action='includes/logout-inc.php' method='POST'>
                <button type='submit' name='submit'>Logout</button>                 
            </form>
	</div>
</div> ";
            }
            elseif ($_SESSION['u_main']!="MNT96578438" || $_SESSION['e_role']==="employee" || $_SESSION['e_role']==="admin" || $_SESSION['e_role']==="teamleader")
            {
                /**********************
                 * HEADER WITHOUT MAINT/ HEADER EMPLOYEE
                 */
                echo "<div class='header'>
	<div class='menu-list'>
            <ul>
                <li><a href='homepage.php'>Home</a></li>
            </ul>
	</div>
	<div class='logo'>
            <img src='img/logo.png' alt='Stenden Logo'>
	</div>
	<div class='option'>
            <form action='includes/logout-inc.php' method='POST'>
                <button type='submit' name='submit'>Logout</button>                 
            </form> 
	</div>
</div>";
            }
            
        }
        
        
        ?>