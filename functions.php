<?php
function load_employees()
{
    include ('conn.php');
    $get_emp ="select  * from employees order by emp_fullname ";
    $run_emp = mysqli_query($conn, $get_emp);
	    while ($row_emp = mysqli_fetch_array($run_emp))
		{
			$emp_id=$row_emp['emp_id'];
		    $emp_fullname =$row_emp['emp_fullname'];
						

            echo "<option value='$emp_id'>$emp_fullname</option>";

        }
}

// get salry from employees table

function loan_salary()
{
	include ('conn.php');
	$get_basic_salary ="Select * from employees  where emp_id = '".$_POST["emp_id"]."' ";
	$run_basic_salary = mysqli_query($conn, $get_basic_salary);
    while ($row_basic_salary = mysqli_fetch_array($run_basic_salary))
	{
	$basic_salary=$row_loan['basic_salary'];
    }
	echo $basic_salary;
}


function year(){
	
}					 
?>