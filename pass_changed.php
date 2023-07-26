<?php
include("conn.php");

$errors = array();

if(isset($_POST['change_pass']))
 {
	
	$current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];
	
   if(empty($current_pass) || empty($new_pass) || empty($confirm_pass)) 
    {
		if($current_pass == "") {
			$errors[] = "Current Password is required";
		} 

		if($new_pass == "") {
			$errors[] = "New Password is required";
		}
		if($confirm_pass == "") {
			$errors[] = "Confirm New password is required";
		}
    } else 
    {
	
     $user = $_SESSION['user_role'];

     $sel_pass ="select password from users where password = '$current_pass' AND user_role ='$user'";

     $run_pass = mysqli_query($conn, $sel_pass);

     $check_pass = mysqli_num_rows($run_pass);

       if($check_pass==0)
	    {
         $errors[] = " Your Current password is wrong ! ";
         exit();
	    } else if($confirm_pass != $new_pass){
         $errors[] = " New password do not match ! ";
         exit();
        } else 
		{

        $update_pass = "update users set password = 'md5($new_pass)' where user_role ='$user'";

        $run_update = mysqli_query($conn, $update_pass);

        $errors[] = " Your password was updated successfully ! ";
        // header('location: index');	
		
        }

    }
 }
?>
