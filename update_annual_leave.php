<?php
// update annual leave for emp table
include ('conn.php');
$annual_leave = $_POST['annual_leave'] ;
$sick_leave = $_POST['sick_leave'] ;
$year = $_POST['year'] ;

    $result = mysqli_query($conn,"select * from employees where emp_id = '".$_POST['emp_id']."' ");
    while($row=mysqli_fetch_array($result))
	{
		$e_emp_id =$row['emp_id'];
		$e_emp_fullname =$row['emp_fullname'];
		$e_annual_leave =$row['annual_leave'];
		$e_sick_leave =$row['sick_leave'];
		$e_year =$row['year'];		
	}

	include ('conn.php');
	$result = mysqli_query($conn,"select * from employee_annual_leaves where emp_id = '".$_POST['emp_id']."' and year =  '".$_POST['year']."' ");
    while($row=mysqli_fetch_array($result))
	{
       $e_a_l_year =$row['year'];	
    }
	
$result = mysqli_query($conn, " update employees set annual_leave = $annual_leave ,sick_leave = $sick_leave , year = $year where emp_id = '".$_POST['emp_id']."' ");	

if($result)
 {
    echo  "The Annual Leaves have been successfully updated.";
    
	
    if($e_year !== $_POST['year'])
	{
		$result = mysqli_query($conn, " insert into employee_annual_leaves ( emp_id,emp_fullname,annual_leave,sick_leave,year,action,change_date)
		                               values ($e_emp_id,'$e_emp_fullname', $e_annual_leave ,$e_sick_leave , $e_year,'Update',now()) ");
				
		
	} else 
	{
         $result = mysqli_query($conn, " Update  employee_annual_leaves SET annual_leave = '".$_POST['annual_leave']."' , change_date = now() where emp_id = '".$_POST['emp_id']."' and year = '".$_POST['year']."' ");
		

	}
	
	
	
	
  } else {
    echo mysqli_error();
  } 

?>