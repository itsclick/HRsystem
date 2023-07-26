<?php	
	include ('conn.php');
	$output = '';
	$get_basic_salary ="Select * from employees  where emp_id = '".$_POST["emp_id"]."' ";
	$run_basic_salary = mysqli_query($conn, $get_basic_salary);
    while ($row_basic_salary = mysqli_fetch_array($run_basic_salary))
	{
	$output .=$row_basic_salary['basic_salary'];
    }
	echo $output;
                        
?>