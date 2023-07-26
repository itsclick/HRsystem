<?php
					
	include ('conn.php');
	$output = '';
	$get_loan ="Select *  from loans  where loan_id = '".$_POST["loan_id"]."' ";
	$run_loan = mysqli_query($conn, $get_loan);
    //$output= '<option value="0">~~ SELECT Outstanding loan ~~</option>';
    while ($row_loan = mysqli_fetch_array($run_loan))
	{			
        if($row_loan['loan_balance'] == "" ){
            $output .= 0 ;
        } else {
			$output .=  $row_loan['loan_balance'];
		}
    }
	echo $output;
                        
?>

