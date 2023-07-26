<?php
					
	include ('conn.php');
	$output = '';
	$get_loan ="Select *  from loans  where emp_id = '".$_POST["emp_id"]."' and loan_balance > 0 ORDER BY loan_date ";
	$run_loan = mysqli_query($conn, $get_loan);
	$output= '<option value="1">~~ SELECT Outstanding loan ~~</option>';
    while ($row_loan = mysqli_fetch_array($run_loan))
	{
		$loan_id=$row_loan['loan_id'];
		$loan_date=$row_loan['loan_date'];
		$loan_balance=$row_loan['loan_balance'];

						
        
        $output .= "<option value='$loan_id'>$loan_date , $loan_balance </option>";

    }
	echo $output;
                        
?>