<?php
if(isset($_POST['upload']))				
   {
				$comp_id = $_GET['comp_id'];                   
				//holding data from the user form				
				$comp_logo = $_FILES['comp_logo']['name'];
                $comp_logo_tmp = $_FILES['comp_logo']['tmp_name'];

                
                if(move_uploaded_file($comp_logo_tmp,'./images/photo/'.$comp_logo))
			    {
                 //inserting data
				 include ('conn.php');

				  $result = " Update  company set comp_logo='$comp_logo' where comp_id = 1 ";
                 
                    if($result)
                    {
                        echo  "Logo have been successfully uploaded.";
                    } else 
		            {
                      echo mysqli_error();
                    }
	            } else
	            {
	              echo  "Uloading logo failled.";
	            }
   }
?>