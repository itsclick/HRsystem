<?php	
	include ('conn.php');
	$output = '';
	$get_sick_leave ="Select * from employees  where emp_id = '".$_POST["emp_id"]."' ";
	$run_sick_leave = mysqli_query($conn, $get_sick_leave);
    while ($row_sick_leave = mysqli_fetch_array($run_sick_leave))
	{
	$output .=$row_sick_leave['sick_leave'];
    }
	echo $output;
                        
?>