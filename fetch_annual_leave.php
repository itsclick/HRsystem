<?php	
	include ('conn.php');
	$output = '';
	$get_annual_leave ="Select * from employees  where emp_id = '".$_POST["emp_id"]."' ";
	$run_annual_leave = mysqli_query($conn, $get_annual_leave);
    while ($row_annual_leave = mysqli_fetch_array($run_annual_leave))
	{
	$output .=$row_annual_leave['annual_leave'];
    }
	echo $output;
                        
?>