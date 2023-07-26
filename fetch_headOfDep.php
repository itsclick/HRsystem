<?php	
						
	include ('conn.php');
	$output = '';
	$get_dep =" select e.head_dep_id,h.HeadOfDepartment,d.dep_name from employees e 						            
									join headOfDepartments h on e.head_dep_id = h.head_dep_id 
                                    join departments d on h.dep_id = d.dep_id 
									where  emp_id = '".$_POST["emp_id"]."' ";
	$run_dep = mysqli_query($conn, $get_dep);
	$output= '<option value="">~~ SELECT HeadOfDepartment ~~</option>';
    while ($row_dep = mysqli_fetch_array($run_dep))
	{
		$head_dep_id=$row_dep[0];
		$HeadOfDepartment =$row_dep[1];
	    $dep_name =$row_dep[2];

						
        
        $output .= "<option value='$head_dep_id'>$dep_name , $HeadOfDepartment </option>";

    }
	echo $output;
                        
?>

