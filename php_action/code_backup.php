=============== correct js code
<script>
$(document).ready(function() {
	// fill the loan select box using jquery
	$('#select_emp').change(function(){
		var emp_id = $(this).val();
		$.ajax({
		     url:"fetch_loans.php",	
			 method:"POST",
			 data:{emp_id:emp_id},
			 dataType:"text",
			 success:function(data)
			 {
				 $('#select_loan').html(data);
				 
			 }
		
		});
		
	});


});

function myFunction() {
    var basicsalary = document.getElementById("select_salary").value;
    var ssnit = basicsalary * 0.055;
	document.getElementById("ssnit").value = ssnit ;
	   //CALCULATIONS
	    nettaxable =0;
		nettaxable=basicsalary-ssnit;
		if(nettaxable<=216){
			paye= (nettaxable*0);
		 } else if ((nettaxable>=216) && (nettaxable<=331)){
			paye=((nettaxable-216)*0.05);
		 } else if((nettaxable>=331) && (nettaxable<=431)){
		    paye=(((nettaxable-331)*0.1)+3.5);
		 } else if((nettaxable>=431) && (nettaxable<=3241)) {
			paye=(((nettaxable-431)*0.175)+3.5+10);
		 } else if(nettaxable>3241) {
		    paye=(((nettaxable-3241)*0.25)+491.75+3.5+10);
		 }
		 netsalary=nettaxable-paye;
		 
    document.getElementById("paye").value = paye ;
}

</script>  

<script>
$(document).ready(function() {
	$("#pay_date").datepicker({showOtherMonths: true , changeMonth: true});
} );

$(document).ready(function() 
{
    $('#select_emp').change(function(){
		 var emp_id = $(this).val();	

        if(emp_id !='')
		{
		    $.ajax({
                  url:"fetch_salary.php",
                  method:"POST",
                  data:{emp_id:emp_id},
                  datatype:"json",
                  success:function(data)
                  {
                    //$('#select_salary').val(data);
                    $('#emp_ssnit_number').val(data);
                  }
              });
		}else{ 	
	         alert('please select employee');     
		}
     });
 });
 
$(document).ready(function() 
{
  $('#select_emp').blur(function()
	{
		var emp_id = $(this).val();
        var basicsalary = $('#select_salary').val();		 

   if(emp_id !='')
   {
        var emp_ssnit_number = $('#emp_ssnit_number').val();
        if(emp_ssnit_number =="N/A" || emp_ssnit_number ==""){
		  var ssnit = basicsalary * 0.00;
		} else {			
          var ssnit = basicsalary * 0.055;
		}
	    document.getElementById("ssnit").value = ssnit.toFixed(2) ;
	    //CALCULATIONS
	    nettaxable =0;
		nettaxable=basicsalary-ssnit;
		if(nettaxable<=216){
			paye= (nettaxable*0);
		 } else if ((nettaxable>=216) && (nettaxable<=331)){
			paye=((nettaxable-216)*0.05);
		 } else if((nettaxable>=331) && (nettaxable<=431)){
		    paye=(((nettaxable-331)*0.1)+3.5);
		 } else if((nettaxable>=431) && (nettaxable<=3241)) {
			paye=(((nettaxable-431)*0.175)+3.5+10);
		 } else if(nettaxable>3241) {
		    paye=(((nettaxable-3241)*0.25)+491.75+3.5+10);
		 }
		 netsalary=nettaxable-paye;
		 
        document.getElementById("paye").value = paye.toFixed(2) ;
    }else{ 	
	         //alert('please select employee');
	         document.getElementById("select_salary").value = "";
             document.getElementById("paye").value = "";	
			 document.getElementById("ssnit").value = "";
		     
		}
    });

// second 
$('#select_salary').blur(function()
	{
	
		var emp_id = $(this).val();
        var basicsalary = $('#select_salary').val();
        var emp_ssnit_number = $('#emp_ssnit_number').val();
        if(emp_ssnit_number =="N/A"){
		  var ssnit = basicsalary * 0.00;
		} else {			
              ssnit = basicsalary * 0.055;
		}
	    document.getElementById("ssnit").value = ssnit.toFixed(2) ;
	   //CALCULATIONS
	    nettaxable =0;
		nettaxable=basicsalary-ssnit;
		if(nettaxable<=216){
			paye= (nettaxable*0);
		 } else if ((nettaxable>=216) && (nettaxable<=331)){
			paye=((nettaxable-216)*0.05);
		 } else if((nettaxable>=331) && (nettaxable<=431)){
		    paye=(((nettaxable-331)*0.1)+3.5);
		 } else if((nettaxable>=431) && (nettaxable<=3241)) {
			paye=(((nettaxable-431)*0.175)+3.5+10);
		 } else if(nettaxable>3241) {
		    paye=(((nettaxable-3241)*0.25)+491.75+3.5+10);
		 }
		 netsalary=nettaxable-paye;
		 
        document.getElementById("paye").value = paye.toFixed(2) ;   
    });
 });
 
 // fill the loan select box using jquery

$(document).ready(function() {	
	$('#select_emp').change(function(){
		var emp_id = $(this).val();	
		$.ajax({
		     url:"fetch_loans.php",	
			 method:"POST",
			 data:{emp_id:emp_id},
			 dataType:"text",
			 success:function(data)
			 {
				 $('#select_loan').html(data);				 
			 }
		
		});
		
	});


});

</script>

if($l_loan_paid = 0){
                                        $p_loan_paid  = 0 ;
                                        $loan_balance = $loan_amount - $p_loan_paid ;
                                        $update_loan_bal = "update loans set loan_paid = '$loan_paid' , loan_balance = '$loan_balance' where emp_id =$l_emp_id AND loan_id = $loan_id ";
		                                $query = mysqli_query($conn,$update_loan_bal);	
                                     } else {	
									 
========= Jquery how to hire empty table rows
$(document).ready(function() {
	$('table tr').each(function(){

    var hide = true;

    $('td',this).each(function(){

        if ($.trim($(this).text()) != "")
            hide = false;

    });

    if(hide)
        $(this).closest('tr').hide();
        // OR $(this).closest('tr).addClass('nodisplay');

});


=============== array function
<?php

// run query
$query = mysql_query("SELECT * FROM table");

// set array
$array = array();

// look through query
while($row = mysql_fetch_assoc($query)){

  // add each row returned into an array
  $array[] = $row;

  // OR just echo the data:
  echo $row['username']; // etc

}

// debug:
print_r($array); // show all array data
echo $array[0]['username']; // print the first rows username
//exampe
$conn = mysqli_connect("localhost","root","","mydatabase");
$result = mysqli_query($conn,"SELECT * from Employees");
//storing in array
$data = array();
while ($row = mysqli_fetch_assoc($result))
{
	$data[] = $row:
}	

echo json_encode($data);
?>

<?php	
	include ('conn.php');
	$data = array();
	$query ="Select * from employees  where emp_id = '".$_POST["emp_id"]."' ";
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	
    foreach$(result as $row)
	{
		$data[] = array(
	    'basic_salary' => $row["basic_salary"];
	    'emp_ssnit_number' => $row["emp_ssnit_number"];		
		);
    }
	echo json_encode($data);

                        
?>
================
function func2() 
                {
                    if(document.getElementById("hours").checked)
                    {
                        var val = document.getElementById("hours").value;
                        alert(val);
                    }
                    
                    else if(document.getElementById("minues").checked)
                    {
                        var val = document.getElementById("minues").value;
                        alert(val);
                    }       
                }

<input type="hidden" class="form-control" id="emp_ssnit_number" value ="<?php echo $emp_ssnit_number ; ?>" placeholder="Enter Date Loan was taken" name="emp_ssnit_number" autocomplete="off"  > 
================query trial
$query =  " select p.pay_id,p.emp_id,p.basic_salary,p.loan_id,p.loan_paid from payroll p
						                     JOIN employees e on p.emp_id= e.emp_id 
						                     JOIN loans l on p.loan_id= l.loan_id 
											 where p.pay_id ='".$_GET['pay_id']."'";
											 
											 
$query =  " select l.loan_id,l.emp_id,l.loan_amount,l.loan_paid,l.loan_balance,p.emp_id 
			                                          from loans l Join payroll p on l.loan_id= p.loan_id 
													  ";








===================trial js code

			// get basic_salary
			
	$('#select_emp').change(function(){
		var emp_id = $(this).val();
         if(emp_id  !=''){
	        $.ajax({
		        url:"fetch_salary.php",	
			    method:"POST",
			    data:{emp_id:emp_id},
			    dataType:"JSON",
			    success:function(data)
			       {
			         $('#select_salary').text(data.basic_salary);				 
			       }
		
		      });
            }
	
    });
	
	-----------------
	// fill the loan select box using jquery
	$('#select_emp').change(function(){
		var emp_id = $(select_emp).val();
		$.ajax({
		     url:"fetch_salary.php",	
			 method:"POST",
			 data:{emp_id:emp_id},
			 dataType:"text",
			 success:function(data)
			 {
				 $('#select_salary').html(data);
				 
			 }
		
		});
		
	});
------------------------------
$('#search').click(function(){
var emp_id = $('#select_emp').val();
	
}

=================
include ('conn.php');
<?php
// update annual leave for emp table
if(isset($_POST['update'])){
include ('conn.php');

$result = mysqli_query($conn, " update employees set annual_leave = '".$_POST['annual_leave']."' where emp_id = '".$_POST['emp_id']."' ");	

if($result)
 {
    echo  "<script>alert('Update is successfully completed')</script>";
    echo "<script>window.open('leaves','_self')</script>";
	
	$annual_leave = "";

    $result = mysqli_query($conn, " select annual_leave from employees where emp_id = '".$_POST['emp_id']."' ");
    while($row = mysqli_fetch_array($result)){
	
	$annual_leave = $row['annual_leave'];
	
	}
	
 } else 
 {		
	 echo  "<script>alert('Update is not successfully completed')</script>";
     echo "<script>window.open('leaves','_self')</script>";		         
 }
	
}
// fetch annual leave from emp table

?>

=== head of department code 
                       <?php	
	                     include ('conn.php');
	                    $get_dep ="select h.head_dep_id,h.dep_id,h.HeadOfDepartment,d.dep_name from headOfDepartments h
						            join departments d on h.dep_id=d.dep_id  ";
				        $run_dep = mysqli_query($conn, $get_dep);
				        while ($row_dep = mysqli_fetch_array($run_dep)){
						$head_dep_id=$row_dep[0];
				        $dep_id =$row_dep[1];
						$HeadOfDepartment =$row_dep[2];
				        $dep_name =$row_dep[3];

                        echo "<option value='$head_dep_id'>$dep_name , $HeadOfDepartment</option> ";
						
                        }
                       ?>

=== getting reason code data

                        <?php
                         include ('conn.php');
				        $get_reason ="select * from reason_codes";
				        $run_reason = mysqli_query($conn, $get_reason);
				        while ($row = mysqli_fetch_array($run_reason)){
				        $reason_id =$row['reason_id'];
				        $reason_name =$row['reason_name'];
						$reason_code =$row['reason_code'];

                         echo "<option value='$reason_id'>$reason_name , $reason_code </option>";

                        }
		                ?>


$(document).ready(function() 
{  
     // getting reason_code  from reason table
    $('#leave_id').change(function(){
		 var leave_id = $(this).val();	
       
		    $.ajax({
                  url:"fetch_reason_code.php",
                  method:"POST",
                  data:{leave_id:leave_id},
                  datatype:"text",
                  success:function(data)
                  {
                    $('#reason_id').val(data);

                  }
              });
		  
        
    });
	 
});

  // getting headOfDepartments  from headOfDepartments table
    $('#select_emp').change(function(){
		 var emp_id = $(this).val();	

        if(emp_id !='')
		{
		    $.ajax({
                  url:"fetch_headOfDep.php",
                  method:"POST",
                  data:{emp_id:emp_id},
                  datatype:"text",
                  success:function(data)
                  {
                    $('#head_dep_id').val(data);

                  }
              });
		  
         
		}	else { 		     
		     alert("Please select employee");
		}
    });
	
<form name="form1" id="update_form"  class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">				 
		    <div id="container" >
            <div id="container" >

<?php

?>
			</div>
			</form>
			
/*			// update loans tables								   
							    	$query =  " select l.loan_id,l.emp_id,l.loan_amount,l.loan_paid,l.loan_balance,p.emp_id,p.emp_id
			                                          from loans l Join payroll p on l.loan_id= p.loan_id 
											          where p.emp_id = $emp_id AND p.loan_id = $loan_id ";

	                                $result = mysqli_query($conn,$query);
	                                while($row=mysqli_fetch_array($result))
	                                {
	                                 $loan_id = $row[0];	                                 
	                                 $l_emp_id = $row[1];
	                                 $loan_amount = $row[2];
		                             $l_loan_paid = $row[3];
	                                 $loan_balance = $row[4];
                                     $p_emp_id = $row[5]; 
                                   									 
		                             // Calculating loan balance
                                     								 
									    $loan_paid = $l_loan_paid - $p_loan_paid ;
                                        $loan_balance = $loan_amount - $loan_paid ;
                                        $update_loan_bal = "update loans set loan_paid = '$loan_paid' , loan_balance = '$loan_balance' where emp_id =$l_emp_id AND loan_id = $loan_id ";
		                                $query = mysqli_query($conn,$update_loan_bal);		
									
								}
	*/			

==============payroll edit code
// GETTING LOAN BALANCE FROM LOANS TABLE

$(document).ready(function() {	

    $('#select_loan').blur(function(){
		
	 var emp_id = $('#select_emp').val();	
	 
		$.ajax({
		     url:"fetch_loans.php",	
			 method:"POST",
			 data:{emp_id:emp_id},
			 dataType:"text",
			 success:function(data)
			 {
				 $('#select_loan').html(data);				 
			 }
		
		});
	});

});
/*
//GETTING BASIC SALARY FROM EMPLOYEE TABLE
$(document).ready(function() 
{
    $('#select_emp').blur(function(){
		 var emp_id = $(this).val();	

        if(emp_id !='')
		{
		    $.ajax({
                  url:"fetch_salary.php",
                  method:"POST",
                  data:{emp_id:emp_id},
                  datatype:"JSON",
                  success:function(data)
                  {
                   $('#select_salary').val(data);
                  }
              });
		}else{ 	
	         alert('please select employee');     
		}
     });
 });
 */
 
 
 
 
 //CALCULATING SSNIT AND PAYE
$(document).ready(function() 
{
  $('#select_emp').blur(function()
	{
		var emp_id = $(this).val();
        var basicsalary = $('#select_salary').val();		 

   if(emp_id !='')
   {
        var emp_ssnit_number = $('#emp_ssnit_number').val();
        if(emp_ssnit_number =="N/A" || emp_ssnit_number ==""){
		  var ssnit = basicsalary * 0.00;
		} else {			
          var ssnit = basicsalary * 0.055;
		}
	    document.getElementById("ssnit").value = ssnit.toFixed(2) ;
	    //CALCULATIONS
	    nettaxable =0;
		nettaxable=basicsalary-ssnit;
		if(nettaxable<=216){
			paye= (nettaxable*0);
		 } else if ((nettaxable>=216) && (nettaxable<=331)){
			paye=((nettaxable-216)*0.05);
		 } else if((nettaxable>=331) && (nettaxable<=431)){
		    paye=(((nettaxable-331)*0.1)+3.5);
		 } else if((nettaxable>=431) && (nettaxable<=3241)) {
			paye=(((nettaxable-431)*0.175)+3.5+10);
		 } else if(nettaxable>3241) {
		    paye=(((nettaxable-3241)*0.25)+491.75+3.5+10);
		 }
		 netsalary=nettaxable-paye;
		 
        document.getElementById("paye").value = paye.toFixed(2) ;
    }else{ 	
	         //alert('please select employee');
	         document.getElementById("select_salary").value = "";
             document.getElementById("paye").value = "";	
			 document.getElementById("ssnit").value = "";
		     
		}
    });

// second 


<div class="form-group">
	        	<label for="loan_id" class="col-sm-3 control-label">Outstanding Loans <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-5">
				      <select class="form-control" id="select_loan" name="loan_id"  >
					    <option value="<?php  echo $row[4];?> "><?php  echo $row[19].' '.' '.'As Loan Balance for'.' '.$row[20]; ?></option>
                       			  
				      </select>
					  </div>
					<div class="col-sm-3">
					   <a href="loans" title ="Update employee loan "> <i class="glyphicon glyphicon-plus "></i> Update Loan </a>
				    </div> 
</div> <!-- /form-group-->

 // Get Loan balance
				$get_loan="select loan_id,loan_balance from loans where loan_id = '".$_GET['loan_id']."'";
				
				$result = mysqli_query($conn,$get_loan);
				 while($row=mysqli_fetch_array($result))
	            {
				     $loan_balance=$row['loan_balance'];	
			
				}
} else if ( $loan_paid > $loan_balance ){ 
				     echo  "<script>alert('Please you cannot paid more than you owe. Check loan paid')</script>";
                     echo "<script>window.open('view_payrolls','_self')</script>";	
				

<table id="example" class="display nowrap" border=1; style="width:100%">
    
    <thead>
			   <tr>						
					<th align="center">SN</th>
					<th></th>
					<th align="center">Start Date</th>
					<th></th>
					<th align="center">End Date </th>					
					<th></th>
					<th align="center">Resume Date</th>
					<th></th>
					<th>Type Of Leave</th>
					<th></th>
					<th>Reason Code </th>
                    <th></th>
					<th align="center">No Of Days </th>					

			   </tr>
			   </thead>
			   <tbody>
    <?php 
	include('conn.php'); 
	$emp_id = $_GET['emp_id'];
    $i = 0;	
	$result = mysqli_query($conn,"select l.leave_form_id,l.emp_id,e.emp_fullname,l.head_dep_id,h.HeadOfDepartment,d.dep_name,l.start_date,l.end_date,l.total_days,
	    l.resumption_date,l.leave_id,t.leave_types ,l.reason_id,r.reason_name,l.reason_explanation,l.contact_number,l.Officer_taken_over from leave_form l 
		Join employees e on l.emp_id = e.emp_id 
		Join headOfDepartments h on l.head_dep_id = h.head_dep_id 
		Join departments d on h.dep_id = d.dep_id 
		Join leave_types t on l.leave_id = t.leave_id 
		Join reason_codes r on l.reason_id = r.reason_id 
      	");
    while($row=mysqli_fetch_array($result))
	{
		$leave_form_id =$row[0];
		$emp_id =$row[1];
		$emp_fullname =$row[2];
		$headOfDepartment =$row[4];
		$dep_name =$row[5];
		$start_date =$row[6];
		$end_date =$row[7];
		$total_days =$row[8];
		$resumption_date =$row[9];
		$leave_types =$row[11];
		$reason_name =$row[13];
		$reason_explanation =$row[14];
		$contact_number = $row[15];
	    $Officer_taken_over = $row[16];	
	    $i++ ;	
        
	?>      
	        <tr>  
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
 			<td>&nbsp;</td>
			<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
 			<td>&nbsp;</td>
			<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
			</tr>  
            <tr>   
                <td align="center"><?php echo $i ; ?></td>	 
                <td>&nbsp;</td>				
                <td align="center"><?php echo $start_date ; ?></td>
				<td>&nbsp;</td>										
				<td align="center"><?php echo $end_date ; ?></td>				
				<td>&nbsp;</td>	
				<td align="center"><?php echo $resumption_date ; ?></td>                  
 				<td>&nbsp;</td>	
				<td><?php echo $leave_types ; ?></td>	
                <td>&nbsp;</td>					
				<td><?php echo $reason_name ; ?></td>
                <td>&nbsp;</td>	
                <td align="center"><?php echo $total_days ; ?></td>				
           </tr>
    <?php
	
	}
	?>
        </tbody>
             
	
    </table>
<div class="form-group">
	        	<label for="reason_id" class="col-sm-3 control-label">Reason Code  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-5">
				      <select class="form-control" id="reason_id" name="reason_id" required>
					    <option value="0">~~ SELECT Reason Code ~~</option>
				      	 <?php
                         include ('conn.php');
				        $get_reason ="select * from reason_codes";
				        $run_reason = mysqli_query($conn, $get_reason);
				        while ($row = mysqli_fetch_array($run_reason)){
				        $reason_id =$row['reason_id'];
				        $reason_name =$row['reason_name'];
						$reason_code =$row['reason_code'];

                         echo "<option value='$reason_id'>$reason_name , $reason_code </option>";

                        }
		                ?>
						
				      </select>
				    </div>
					<div class="col-sm-3">
					   <a href="reason_codes" title ="Add New leave"> <i class="glyphicon glyphicon-plus "></i> Add Reason Code</a>
				    </div>
	        </div> <!-- /form-group-->	
<div class="form-group">
	        	<label for="reason_id" class="col-sm-3 control-label">Reason Code  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="reason_id" name="reason_id" required>
					    <option value="<?php echo $reason_id ;?>"><?php echo $reason_name .' , '. $reason_code  ;?></option>
						 <?php
                         include ('conn.php');
				        $get_reason ="select * from reason_codes";
				        $run_reason = mysqli_query($conn, $get_reason);
				        while ($row = mysqli_fetch_array($run_reason)){
				        $reason_id =$row['reason_id'];
				        $reason_name =$row['reason_name'];
						$reason_code =$row['reason_code'];

                         echo "<option value='$reason_id'>$reason_name , $reason_code </option>";

                        }
		                ?>						
				      </select>
				    </div>
					
	        </div> <!-- /form-group-->	
			<option value="0">~~ SELECT Head Of Department ~~</option>
                        <?php	
	                     include ('conn.php');
	                    $get_dep ="select h.head_dep_id,h.dep_id,h.HeadOfDepartment,d.dep_name from headOfDepartments h
						            join departments d on h.dep_id=d.dep_id  ";
				        $run_dep = mysqli_query($conn, $get_dep);
				        while ($row_dep = mysqli_fetch_array($run_dep)){
						$head_dep_id=$row_dep[0];
				        $dep_id =$row_dep[1];
						$HeadOfDepartment =$row_dep[2];
				        $dep_name =$row_dep[3];

                        echo "<option value='$head_dep_id'>$dep_name , $HeadOfDepartment</option> ";
						
                        }
                       ?>











	