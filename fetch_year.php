<?php	
	include ('conn.php');
	$output = '';
	$get_siyear ="Select * from employees  where emp_id = '".$_POST["emp_id"]."' ";
	$run_year = mysqli_query($conn, $get_year);
    while ($row_year = mysqli_fetch_array($run_year))
	{
	$year =$row_year['year'];
	
	$output .= "<option value='$year'>$year </option>";
    }
	echo $output;
                        
?>