<?php
					
	include ('conn.php');
	$output = '';
	$get_loan ="Select l.leave_id,l.reason_id,r.reason_name from leave_types
                JOIN reason_codes on l.reason_id = r.reason_id               
			    where leave_id = '".$_POST["leave_id"]."' ";
	$run_loan = mysqli_query($conn, $get_loan);
	$output= '<option value="">~~ SELECT Outstanding loan ~~</option>';
    while ($row_loan = mysqli_fetch_array($run_loan))
	{
		$leave_id=$row_loan[0];
		$reason_id=$row_loan[1];
		$reason_name=$row_loan[2];				
        
        $output .= "<option value='$reason_id'>$reason_name </option>";

    }
	echo $output;
                        
?>