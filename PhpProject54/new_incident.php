
	        		<?php
                                        if(!isset($_SESSION))
                                        {
                                            session_start();
                                        }
                                        
                                        if(isset($_POST['submit']))
                                        {
                                            if(empty($_POST['OS']) || empty($_POST['software']) || empty($_POST['description']))
                                            {
						header ('Location: memberprofile.php?page=ticket&error=empty');
                                                exit();
                                            }
					        
                                        else {
						$DBConnect = mysqli_connect("localhost", "root", "");
                                                if ($DBConnect === FALSE)
                                                    {
                                                        echo "<p>Unable to connect to the database server.</p>"
                                                        . "<p>Error code " . mysqli_errno() . ": "
                                                        . mysqli_error() . "</p>";
                                                    }
							 
                                        else 
                                            {
                                                $DBName = "supportdesk";
         					    
                                                mysqli_select_db($DBConnect, $DBName);
                                                $TableName = "ticket";
                                                
                                                
                                            $customerID = $_SESSION['u_id'];
                                            $OS = htmlentities($_POST['OS']);
                                            $software = htmlentities($_POST['software']);
                                            $description = filter_input(INPUT_POST,'description', FILTER_SANITIZE_STRING);
                                            $IncidentID = $_POST['category'];
                                            $status = 'Open';
                                            $SQLstring2 = "INSERT INTO ". $TableName ." (CustomerID, IncidentID, OS, SoftwareVersion, TicketDescription, Status) VALUES(?, ?, ?, ?, ?, ?)";
                                                    if ($stmt = mysqli_prepare($DBConnect, $SQLstring2)) 
                                                    {
                                                          mysqli_stmt_bind_param($stmt, 'ssssss',$customerID, $IncidentID, $OS, $software,$description, $status);
                                                          $QueryResult2 = mysqli_stmt_execute($stmt);

                                                          if ($QueryResult2 === FALSE)
                                                              {
                                                                echo "<p>Unable to execute the query.</p>"
                                                                . "<p>Error code "
                                                                . mysqli_errno($DBConnect)
                                                                . ": "
                                                                . mysqli_error($DBConnect)
                                                                . "</p>";
                                                                } 
                                                                
                                                                else {
                                                                      mysqli_stmt_close($stmt);
                                                                      $TableName2 = 'Incident';
                                                                      $query2 = 'SELECT Occurance FROM '.$TableName2. ' WHERE IncidentID=?';
                                                                      if($stmt = mysqli_prepare($DBConnect, $query2))
                                                                      {
                                                                          if(mysqli_stmt_bind_param($stmt,'i', $IncidentID))
                                                                          {
                                                                              if(mysqli_stmt_execute($stmt))
                                                                              {
                                                                                  if(mysqli_stmt_bind_result($stmt, $occurance))
                                                                                  {
                                                                                      mysqli_stmt_store_result($stmt);
                                                                                      $occurance++;
                                                                                      mysqli_stmt_close($stmt);
                                                                                      $query3 = 'UPDATE '.$TableName2. ' SET Occurance=? WHERE IncidentID=?';
                                                                                      if($stmt = mysqli_prepare($DBConnect,$query3))
                                                                                      {
                                                                                          mysqli_stmt_bind_param($stmt, 'ii', $occurance, $IncidentID);
                                                                                          if(mysqli_stmt_execute($stmt))
                                                                                          {
                                                                                              header('Location: memberprofile.php?page=ticket&success=yes');

                                                                                          }
                                                                                          else
                                                                                          {
                                                                                              echo 'executing error3';
                                                                                          }
                                                                                         
                                                                                      }
                                                                                      else
                                                                                      {
                                                                                          echo 'preparing error 3';
                                                                                      }
                                                                                                                         
                                                                                  }
                                                                                  else
                                                                                  {
                                                                                      echo 'binding result error 2';
                                                                                  }
                                                                              }
                                                                              else
                                                                              {
                                                                                  echo 'executing error 2';
                                                                              }
                                                                          }
                                                                          else
                                                                          {
                                                                              echo 'binding error 2';
                                                                          }
                                                                      }
                                                                      else
                                                                      {
                                                                          echo 'preparing error 2';
                                                                      }
                                                                     }  
                                                                     
                                                                     mysqli_close($DBConnect);
                                                    }
                                                    else
                                                    {
                                                        echo "<p>Preparing error</p>";
                                                    }
                                           }

                                        }

                                        }
                                        else
                                        {
                                            header('Location: memberprofile.php?page=ticket');
                                        }
                                
	        			

					?>
	