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
    $eimg = ($_SESSION['e_img']);
}
set_time_limit(0);
?>
  <?php
    if (isset($_SESSION['u_uid']) && (isset($_SESSION['u_main']) && $_SESSION['u_main']==="MNT96578438")) {
                  
              header('Location:mainmember.php');
      
    }  
    elseif(isset($_SESSION['u_uid']) && (isset($_SESSION['u_main']) && $_SESSION['u_main']!="MNT96578438")) {
                
        header('Location:nonmember.php');
    }
     elseif(isset($_SESSION['e_uid']) && (isset($_SESSION['e_role']) && $_SESSION['e_role']==="employee")) {
                
        header('Location:employee.php');
    }
     elseif(isset($_SESSION['e_uid']) && (isset($_SESSION['e_role']) && $_SESSION['e_role']==="admin")) {
                
        header('Location:admin.php');
    }
      elseif(isset($_SESSION['e_uid']) && (isset($_SESSION['e_role']) && $_SESSION['e_role']==="teamleader")) {
                
        header('Location:teamleader.php');
      }
   
    else{
              echo ' <a href="login.php"><button>
                        Login 
                    </button></a> ';
                    echo ' <a href="signup.php"><button>
                        Signup
                    </button> </a> ';
                   
    }
                
      
                ?>
   <?php
                  /* 
                if (isset($_SESSION['u_id'])) {
                    echo '  <div class="propic">
                    <img src="uploads/' . $img . '">
                         
                         </div>';
                    echo 'Welcome <b>' . $uid . '</b>';
                  
                }elseif (isset ($_SESSION['e_id'])){
                    echo '<div class="propic">
                    <img src="uploads/' . $eimg . '">
                </div>';
                    echo 'Welcome <b>' . $eid . '</b>';
                            }
                */
                ?>  
                    
