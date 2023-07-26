<?php	
	include ('conn.php');
	$output = '';
	$get_emp_mobile ="Select * from employees  where emp_id = '".$_POST["emp_id"]."' ";
	$run_emp_mobile = mysqli_query($conn, $get_emp_mobile);
    while ($row_emp_mobile = mysqli_fetch_array($run_emp_mobile))
	{
	$output .=$row_emp_mobile['emp_mobile'];
    }
	echo $output;
                        
?>