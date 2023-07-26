<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<?php 
 if(isset($_POST['submit']))				
			{
//holding data from the user form
$emp_code = $_POST['emp_code'];
$emp_joining_date = $_POST['emp_joining_date'];
$emp_fullname = $_POST['emp_fullname'];
$emp_dob = $_POST['emp_dob'];
$emp_gender = $_POST['emp_gender'];
$emp_maratial_status = $_POST['emp_maratial_status'];
$emp_mothers_mainden_name = $_POST['emp_mothers_mainden_name'];
$emp_nationality = $_POST['emp_nationality'];
if($_POST['emp_tin_number'] == ""){
  $emp_tin_number = "N/A";
} else { 
  $emp_tin_number = $_POST['emp_tin_number'];
}
if($_POST['emp_ssnit_number'] == ""){
  $emp_ssnit_number = "N/A";
} else { 
  $emp_ssnit_number = $_POST['emp_ssnit_number'];
}
$emp_present_address = $_POST['emp_present_address'];
$emp_city = $_POST['emp_city'];
$emp_country = $_POST['emp_country'];
$emp_mobile = $_POST['emp_mobile'];
$emp_email = $_POST['emp_email'];
$bank_name = $_POST['bank_name'];
$bank_branch = $_POST['bank_branch'];
$bank_account_name = $_POST['bank_account_name'];
$bank_account_no = $_POST['bank_account_no'];
$emp_contact_fullname = $_POST['emp_contact_fullname'];
$emp_contact_housenumber = $_POST['emp_contact_housenumber'];
$emp_contact_mobile = $_POST['emp_contact_mobile'];
$emp_contact_occupation = $_POST['emp_contact_occupation'];
$emp_contact_relationshipToEmp = $_POST['emp_contact_relationshipToEmp'];
$position_id = $_POST['position_id'];
$head_dep_id = $_POST['head_dep_id'];
$basic_salary = $_POST['basic_salary'];
$employment_type = $_POST['employment_type'];
$annual_leave = $_POST['annual_leave'];
$sick_leave = $_POST['sick_leave'];
$year = $_POST['year'];
$emp_photo = $_FILES['emp_photo']['name'];
$emp_photo_tmp = $_FILES['emp_photo']['tmp_name'];
$emp_resume = $_FILES['emp_resume']['name'];
$emp_resume_tmp = $_FILES['emp_resume']['tmp_name'];
$emp_offerLetter = $_FILES['emp_offerLetter']['name'];
$emp_offerLetter_tmp = $_FILES['emp_offerLetter']['tmp_name'];
$emp_joiningLetter = $_FILES['emp_joiningLetter']['name'];
$emp_joiningLetter_tmp = $_FILES['emp_joiningLetter']['tmp_name'];
$emp_contractPaper = $_FILES['emp_contractPaper']['name'];
$emp_contractPaper_tmp = $_FILES['emp_contractPaper']['tmp_name'];
$emp_idProff = $_FILES['emp_idProff']['name'];
$emp_idProff_tmp = $_FILES['emp_idProff']['tmp_name'];
$emp_otherDocument = $_FILES['emp_otherDocument']['name'];
$emp_otherDocument_tmp = $_FILES['emp_otherDocument']['tmp_name'];
// for holding any kind of document to unload

               if(move_uploaded_file($emp_photo_tmp,'./images/photo/'.$emp_photo) || move_uploaded_file($emp_resume_tmp,'./images/photo/'.$emp_resume)|| move_uploaded_file($emp_offerLetter_tmp,'./images/photo/'.$emp_offerLetter)|| move_uploaded_file($emp_joiningLetter_tmp,'./images/photo/'.$emp_joiningLetter)|| move_uploaded_file($emp_contractPaper_tmp,'./images/photo/'.$emp_contractPaper)|| move_uploaded_file($emp_idProff_tmp,'./images/photo/'.$emp_idProff)|| move_uploaded_file($emp_otherDocument_tmp,'./images/photo/'.$emp_otherDocument))
			    {				
                 //inserting data
				 include ('conn.php');
				 
				 $insert_emp = " insert into employees (emp_code,emp_joining_date,emp_fullname,emp_dob,emp_gender,emp_maratial_status,emp_mothers_mainden_name,emp_nationality,emp_tin_number,emp_ssnit_number,
				 emp_present_address,emp_city,emp_country,emp_mobile,emp_email,bank_name,bank_branch,bank_account_name,bank_account_no,emp_contact_fullname,emp_contact_housenumber,emp_contact_mobile,emp_contact_occupation,emp_contact_relationshipToEmp,
				 position_id,head_dep_id,basic_salary ,employment_type , emp_photo,emp_resume,emp_offerLetter,emp_joiningLetter,emp_contractPaper,emp_idProff,emp_otherDocument,status,annual_leave,sick_leave,year) 
				 
                 values ('$emp_code','$emp_joining_date','$emp_fullname','$emp_dob','$emp_gender','$emp_maratial_status','$emp_mothers_mainden_name','$emp_nationality','$emp_tin_number','$emp_ssnit_number',
				 '$emp_present_address','$emp_city','$emp_country','$emp_mobile','$emp_email','$bank_name','$bank_branch' ,'$bank_account_name','$bank_account_no','$emp_contact_fullname','$emp_contact_housenumber','$emp_contact_mobile','$emp_contact_occupation','$emp_contact_relationshipToEmp',
				 '$position_id','$head_dep_id','$basic_salary','$employment_type' ,'$emp_photo','$emp_resume' ,'$emp_offerLetter','$emp_joiningLetter','$emp_contractPaper','$emp_idProff','$emp_otherDocument',1,'$annual_leave','$sick_leave','$year')";
                 
                 $result= mysqli_query($conn,$insert_emp);

                   if($result)
				    {
                       echo  "<script>alert('insert is successfully completed')</script>";
                       echo "<script>window.open('employees','_self')</script>";
					   
                    } else 
				    {		
	                    echo  "<script>alert('insert is not successfully completed')</script>";
				        echo "<script>window.open('employees','_self')</script>";		         
                    }
				
				}
				else 
				{ 
				 include ('conn.php');
				 
				 $insert_emp = " insert into employees (emp_code,emp_joining_date,emp_fullname,emp_dob,emp_gender,emp_maratial_status,emp_mothers_mainden_name,emp_nationality,emp_tin_number,emp_ssnit_number,
				 emp_present_address,emp_city,emp_country,emp_mobile,emp_email,bank_name,bank_branch,bank_account_name,bank_account_no,emp_contact_fullname,emp_contact_housenumber,emp_contact_mobile,emp_contact_occupation,emp_contact_relationshipToEmp,
				 position_id,head_dep_id,basic_salary,employment_type,status,annual_leave,sick_leave,year) 
				 
                 values ('$emp_code','$emp_joining_date','$emp_fullname','$emp_dob','$emp_gender','$emp_maratial_status','$emp_mothers_mainden_name','$emp_nationality','$emp_tin_number','$emp_ssnit_number',
				 '$emp_present_address','$emp_city','$emp_country','$emp_mobile','$emp_email','$bank_name','$bank_branch' ,'$bank_account_name','$bank_account_no','$emp_contact_fullname','$emp_contact_housenumber','$emp_contact_mobile','$emp_contact_occupation','$emp_contact_relationshipToEmp',
				 '$position_id','$head_dep_id' ,'$basic_salary','$employment_type' ,1,'$annual_leave','$sick_leave','$year')";
                 
                 $result= mysqli_query($conn,$insert_emp);

                   if($result)
				    {
                       echo  "<script>alert('insert is successfully completed')</script>";
                       echo "<script>window.open('employees','_self')</script>";
                    } else 
				    {		
	                    echo  "<script>alert('insert is not successfully completed')</script>";
				        echo "<script>window.open('employees','_self')</script>";		         
                    }
				}
				
            }					 
		
?>

<html>
<head>
<title>Payroll Management System</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="assets/jqueryui/jquery-ui.css">

    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="asset/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="asset/css/main.css" /> 
    <link rel="stylesheet" href="asset/css/theme.css" />
    <link rel="stylesheet" href="asset/css/MoneAdmin.css" />
    <link rel="stylesheet" href="asset/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="asset/css/bootstrap-fileupload.min.css" />
    <!-- END PAGE LEVEL  STYLES -->

<link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatable/css/buttons.dataTables.min.css">


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.structure.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.theme.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


<script type="text/javascript" src="datatable/js/jquery.min.js"></script>
<script type="text/javascript" src="datatable/js/jquery.dataTables.min.js"></script>   
<script type="text/javascript" src="datatable/js/jquery.tabledit.min.js"></script>
<script type="text/javascript" src="datatable/js/jszip.min.js"></script>
<script type="text/javascript" src="datatable/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="datatable/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="datatable/js/pdfmake.min.js"></script>
<script type="text/javascript" src="datatable/js/buttons.print.min.js"></script>

<script> 
 function confirmdelete() 
{
var agree=confirm("Are you sure you want to delete ?");
if (agree)
return true;
else
return false;
}
</script>


</head>
<body style="background-color:white;">
<div class="container_fluid">
 <div class="row">
  
        <nav class="navbar navbar-default">
        <div class="container-fluid">
			
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  </button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			     
				<ul class="nav navbar-nav" >
				 <li id="navDashboard"><a href="admin/index"> <i class="glyphicon glyphicon-home"> </i> Dashboard </a> </li>  
				 
				 <li id="navDashboard"><a href="headOfDepartments"> <i class="glyphicon glyphicon-menu-hamburger"> </i> Department </a> </li>  

 				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-menu-hamburger"></i> Employee <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="employees"><i class="glyphicon glyphicon-plus "></i> Add Employee </li> </a>
				 <li id="manageOrder"><a href="view_employees"><i class="glyphicon glyphicon-edit "></i> Manage Employee </li> </a>
				 </ul>
				 </li>	
				 
				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-menu-hamburger"></i> Payroll <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="view_payroll"><i class="glyphicon glyphicon-th-list "></i> View Payroll </li> </a>
				 <li id="manageOrder"><a href="view_full_payroll"><i class="glyphicon glyphicon-th-list "></i> View Full Payroll </li> </a>
				 </ul>
				 </li>	
				  
                 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-calendar"></i> Leave <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="leaves"><i class="glyphicon glyphicon-plus "></i> Add Leave </li> </a>
				 <li id="manageOrder"><a href="view_leaves"><i class="glyphicon glyphicon-edit "></i> Manage Leave </li> </a>
				 </ul>
				 </li>	
				 
				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-time"></i> Overtime <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="overtimes"><i class="glyphicon glyphicon-plus "></i> Add Overtime </li> </a>
				 <li id="manageOrder"><a href="view_overtimes"><i class="glyphicon glyphicon-edit "></i> Manage Overtime </li> </a>
				 </ul>
				 </li>	
				 
				  <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-piggy-bank"></i> Loan <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="viw_loans"><i class="glyphicon glyphicon-menu-hamburger "></i> View Loan </li> </a>
				 </ul>
				 </li>
				   		 				 
				 <li class="dropdown">
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon  glyphicon-certificate"></i> Awards <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="awards"><i class="glyphicon glyphicon-plus "></i> Add Award </li> </a>
				 </ul>
				 </li>
				 </ul>
				 <ul class="nav navbar-nav navbar-right">
				 <li class="dropdown menu">
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addSetting"><a href="setting?comp_id=$comp_id"><i class="glyphicon glyphicon-wrench "></i> Setting </li> </a>
				 <li id="manageLogout"><a href="logout"><i class="glyphicon glyphicon-log-out "></i> Logout </li> </a>
				 </ul>
				 </li>	 
				</ul>
		    </div>
		</div>
		 
    </nav>
         
         

</div>
</div>
	    
<div class="container">

    <div class="row">
	
	    <ol class="breadcrumb">
		
		  <li><a href="admin/index">Home</a> </li>
		  <li class="Active">Employee </li>
		
		</ol>
        <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-plus"></i> Add Employee </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="pull pull-right" style="padding-bottom:20px; margin-right:15px;">
			  
			     <button class="btn btn-default"><a href="view_employees.php"><i class="glyphicon glyphicon-edit" ></i> Manage Employee </a></button>
			 
		    </div> 
		    
			<div class="col-lg-12" >
                 <form name="form1" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
				 
		        <div id="container" >
            <div class="form-group">
                        <label class="control-label col-lg-3">Employee Photo</label>
						<label class="col-sm-1 control-label">: </label>
                        <div class="col-lg-8">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="asset/img/demoUpload.jpg" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select Photo</span><span class="fileupload-exists">Change</span><input type="file" id="emp_photo" name="emp_photo" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
            </div>		        
			<div class="form-group">
	        	<label for="emp_code" class="col-sm-3 control-label">Employee ID <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" required id="emp_code" placeholder="Employee ID" name="emp_code" autocomplete="off" >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_joining_date" class="col-sm-3 control-label">Employment Date <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" required  id="emp_date-" placeholder="Date Of Employment" name="emp_joining_date" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="emp_fullname" class="col-sm-3 control-label">Employee Name <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" required id="emp_fullname" placeholder="Employee Full Name" name="emp_fullname" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_dob" class="col-sm-3 control-label">Date Of Birth <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" required id="emp_dob-" placeholder="Employee Date of Birth" name="emp_dob" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="emp_gender" class="col-sm-3 control-label">Gender <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="emp_gender" name="emp_gender" required >
				      	<option value="">~~ SELECT gender ~~</option>
				      	<option value="Male">Male</option>
                        <option value="Female">Female</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_maratial_status" class="col-sm-3 control-label">Maratial Status <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">				      
				      <select class="form-control" id="emp_maratial_status" name="emp_maratial_status" required >
				      	<option value="">~~ SELECT maratian status ~~</option>
				      	<option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
				      </select>
					
					</div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="emp_mothers_mainden_name" class="col-sm-3 control-label">Mothers Mainden Name :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="emp_mothers_mainden_name" placeholder="Employee Mothers Mainden Name" name="emp_mothers_mainden_name" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="emp_nationality" class="col-sm-3 control-label">Nationality <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select type="text" class="form-control" id="emp_nationality" name="emp_nationality"  >
				      	<option value="">~~ SELECT Nationality ~~</option>
  <option value="Afghan">Afghan</option>
  <option value="Albanian">Albanian</option>
  <option value="Algerian">Algerian</option>
  <option value="American">American</option>
  <option value="Andorran">Andorran</option>
  <option value="Angolan">Angolan</option>
  <option value="Antiguans">Antiguans</option>
  <option value="Argentinean">Argentinean</option>
  <option value="Armenian">Armenian</option>
  <option value="Australian">Australian</option>
  <option value="Austrian">Austrian</option>
  <option value="Azerbaijani">Azerbaijani</option>
  <option value="Bahamian">Bahamian</option>
  <option value="Bahraini">Bahraini</option>
  <option value="Bangladeshi">Bangladeshi</option>
  <option value="Barbadian">Barbadian</option>
  <option value="Barbudans">Barbudans</option>
  <option value="Batswana">Batswana</option>
  <option value="Belarusian">Belarusian</option>
  <option value="Belgian">Belgian</option>
  <option value="Belizean">Belizean</option>
  <option value="Beninese">Beninese</option>
  <option value="Bhutanese">Bhutanese</option>
  <option value="Bolivian">Bolivian</option>
  <option value="Bosnian">Bosnian</option>
  <option value="Brazilian">Brazilian</option>
  <option value="British">British</option>
  <option value="Bruneian">Bruneian</option>
  <option value="Bulgarian">Bulgarian</option>
  <option value="Burkinabe">Burkinabe</option>
  <option value="Burmese">Burmese</option>
  <option value="Burundian">Burundian</option>
  <option value="Cambodian">Cambodian</option>
  <option value="Cameroonian">Cameroonian</option>
  <option value="Canadian">Canadian</option>
  <option value="Cape Verdean">Cape Verdean</option>
  <option value="Central African">Central African</option>
  <option value="Chadian">Chadian</option>
  <option value="Chilean">Chilean</option>
  <option value="Chinese">Chinese</option>
  <option value="Colombian">Colombian</option>
  <option value="Comoran">Comoran</option>
  <option value="Congolese">Congolese</option>
  <option value="Costa Rican">Costa Rican</option>
  <option value="Croatian">Croatian</option>
  <option value="Cuban">Cuban</option>
  <option value="Cypriot">Cypriot</option>
  <option value="Czech">Czech</option>
  <option value="Danish">Danish</option>
  <option value="Djibouti">Djibouti</option>
  <option value="Dominican">Dominican</option>
  <option value="Dutch">Dutch</option>
  <option value="East Timorese">East Timorese</option>
  <option value="Ecuadorean">Ecuadorean</option>
  <option value="Egyptian">Egyptian</option>
  <option value="Emirian">Emirian</option>
  <option value="Equatorial Guinean">Equatorial Guinean</option>
  <option value="Eritrean">Eritrean</option>
  <option value="Estonian">Estonian</option>
  <option value="Ethiopian">Ethiopian</option>
  <option value="Fijian">Fijian</option>
  <option value="Filipino">Filipino</option>
  <option value="Finnish">Finnish</option>
  <option value="French">French</option>
  <option value="Gabonese">Gabonese</option>
  <option value="Gambian">Gambian</option>
  <option value="Georgian">Georgian</option>
  <option value="German">German</option>
  <option value="Ghanaian">Ghanaian</option>
  <option value="Greek">Greek</option>
  <option value="Grenadian">Grenadian</option>
  <option value="Guatemalan">Guatemalan</option>
  <option value="Guinea-Bissauan">Guinea-Bissauan</option>
  <option value="Guinean">Guinean</option>
  <option value="Guyanese">Guyanese</option>
  <option value="Haitian">Haitian</option>
  <option value="Herzegovinian">Herzegovinian</option>
  <option value="Honduran">Honduran</option>
  <option value="Hungarian">Hungarian</option>
  <option value="Icelander">Icelander</option>
  <option value="Indian">Indian</option>
  <option value="Indonesian">Indonesian</option>
  <option value="Iranian">Iranian</option>
  <option value="Iraqi">Iraqi</option>
  <option value="Irish">Irish</option>
  <option value="Israeli">Israeli</option>
  <option value="Italian">Italian</option>
  <option value="Ivorian">Ivorian</option>
  <option value="Jamaican">Jamaican</option>
  <option value="Japanese">Japanese</option>
  <option value="Jordanian">Jordanian</option>
  <option value="Kazakhstani">Kazakhstani</option>
  <option value="Kenyan">Kenyan</option>
  <option value="Kittian and Nevisian">Kittian and Nevisian</option>
  <option value="Kuwaiti">Kuwaiti</option>
  <option value="Kyrgyz">Kyrgyz</option>
  <option value="Laotian">Laotian</option>
  <option value="Latvian">Latvian</option>
  <option value="Lebanese">Lebanese</option>
  <option value="Liberian">Liberian</option>
  <option value="Libyan">Libyan</option>
  <option value="Liechtensteiner">Liechtensteiner</option>
  <option value="Lithuanian">Lithuanian</option>
  <option value="Luxembourger">Luxembourger</option>
  <option value="Macedonian">Macedonian</option>
  <option value="Malagasy">Malagasy</option>
  <option value="Malawian">Malawian</option>
  <option value="Malaysian">Malaysian</option>
  <option value="Maldivan">Maldivan</option>
  <option value="Malian">Malian</option>
  <option value="Maltese">Maltese</option>
  <option value="Marshallese">Marshallese</option>
  <option value="Mauritanian">Mauritanian</option>
  <option value="Mauritian">Mauritian</option>
  <option value="Mexican">Mexican</option>
  <option value="Micronesian">Micronesian</option>
  <option value="Moldovan">Moldovan</option>
  <option value="Monacan">Monacan</option>
  <option value="Mongolian">Mongolian</option>
  <option value="Moroccan">Moroccan</option>
  <option value="Mosotho">Mosotho</option>
  <option value="Motswana">Motswana</option>
  <option value="Mozambican">Mozambican</option>
  <option value="Namibian">Namibian</option>
  <option value="Nauruan">Nauruan</option>
  <option value="Nepalese">Nepalese</option>
  <option value="New Zealander">New Zealander</option>
  <option value="Ni-Vanuatu">Ni-Vanuatu</option>
  <option value="Nicaraguan">Nicaraguan</option>
  <option value="Nigerien">Nigerien</option>
  <option value="North Korean">North Korean</option>
  <option value="Northern Irish">Northern Irish</option>
  <option value="Norwegian">Norwegian</option>
  <option value="Omani">Omani</option>
  <option value="Pakistani">Pakistani</option>
  <option value="Palauan">Palauan</option>
  <option value="Panamanian">Panamanian</option>
  <option value="Papua New Guinean">Papua New Guinean</option>
  <option value="Paraguayan">Paraguayan</option>
  <option value="Peruvian">Peruvian</option>
  <option value="Polish">Polish</option>
  <option value="Portuguese">Portuguese</option>
  <option value="Qatari">Qatari</option>
  <option value="Romanian">Romanian</option>
  <option value="Russian">Russian</option>
  <option value="Rwandan">Rwandan</option>
  <option value="Saint Lucian">Saint Lucian</option>
  <option value="Salvadoran">Salvadoran</option>
  <option value="Samoan">Samoan</option>
  <option value="San Marinese">San Marinese</option>
  <option value="Sao Tomean">Sao Tomean</option>
  <option value="Saudi">Saudi</option>
  <option value="Scottish">Scottish</option>
  <option value="Senegalese">Senegalese</option>
  <option value="Serbian">Serbian</option>
  <option value="Seychellois">Seychellois</option>
  <option value="Sierra Leonean">Sierra Leonean</option>
  <option value="Singaporean">Singaporean</option>
  <option value="Slovakian">Slovakian</option>
  <option value="Slovenian">Slovenian</option>
  <option value="Solomon islander">Solomon Islander</option>
  <option value="Somali">Somali</option>
  <option value="South African">South African</option>
  <option value="South Korean">South Korean</option>
  <option value="Spanish">Spanish</option>
  <option value="Sri Lankan">Sri Lankan</option>
  <option value="Sudanese">Sudanese</option>
  <option value="Surinamer">Surinamer</option>
  <option value="Swazi">Swazi</option>
  <option value="Swedish">Swedish</option>
  <option value="Swiss">Swiss</option>
  <option value="Syrian">Syrian</option>
  <option value="Taiwanese">Taiwanese</option>
  <option value="Tajik">Tajik</option>
  <option value="Tanzanian">Tanzanian</option>
  <option value="Thai">Thai</option>
  <option value="Togolese">Togolese</option>
  <option value="Tongan">Tongan</option>
  <option value="Trinidadian or Tobagonian">Trinidadian or Tobagonian</option>
  <option value="Tunisian">Tunisian</option>
  <option value="Turkish">Turkish</option>
  <option value="Tuvaluan">Tuvaluan</option>
  <option value="Ugandan">Ugandan</option>
  <option value="Ukrainian">Ukrainian</option>
  <option value="Uruguayan">Uruguayan</option>
  <option value="Uzbekistani">Uzbekistani</option>
  <option value="Venezuelan">Venezuelan</option>
  <option value="Vietnamese">Vietnamese</option>
  <option value="Welsh">Welsh</option>
  <option value="Yemenite">Yemenite</option>
  <option value="Zambian">Zambian</option>
  <option value="Zimbabwean">Zimbabwean</option> 
																 
				      </select>
				    </div>
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="emp_tin_number" class="col-sm-3 control-label">Employee TIN Number :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				    <input type="text" class="form-control" id="emp_tin_number" placeholder="Employee TIN Number" name="emp_tin_number" autocomplete="off">  
				    </div>
	        </div> <!-- /form-group-->	            		
			<div class="form-group">
	        	<label for="emp_ssnit_number" class="col-sm-3 control-label">SSNIT Number :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="emp_ssnit_number" placeholder="Employee SSNIT Number" name="emp_ssnit_number" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_present_address" class="col-sm-3 control-label">Employee Present Address <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="emp_present_address" placeholder="Employee Present Address" name="emp_present_address" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_city" class="col-sm-3 control-label">City <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="emp_city" placeholder=" Enter city" name="emp_city" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
			</div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="emp_country" class="col-sm-3 control-label">Country <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select type="text" class="form-control" id="emp_country" name="emp_country"  required >
				      	<option value="">~~ SELECT Country ~~</option>
    <option value="Afghanistan">Afghanistan</option>
	<option value="Albania">Albania</option>
	<option value="Algeria">Algeria</option>
	<option value="Andorra">Andorra</option>
	<option value="Antigua and Barbuda">Antigua and Barbuda</option>
	<option value="Argentina">Argentina</option>
	<option value="Armenia">Armenia</option>
	<option value="Australia">Australia</option>
	<option value="Austria">Austria</option>
	<option value="Azerbaijan">Azerbaijan</option>
	<option value="Bahamas">Bahamas</option>
	<option value="Bahrain">Bahrain</option>
	<option value="Bangladesh">Bangladesh</option>
	<option value="Barbados">Barbados</option>
	<option value="Belarus">Belarus</option>
	<option value="Belgium">Belgium</option>
	<option value="Belize">Belize</option>
	<option value="Benin">Benin</option>
	<option value="Bhutan">Bhutan</option>
	<option value="Bolivia">Bolivia</option>
	<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
	<option value="Botswana">Botswana</option>
	<option value="Brazil">Brazil</option>
	<option value="Brunei">Brunei</option>
	<option value="Bulgaria">Bulgaria</option>
	<option value="Burkina Faso">Burkina Faso</option>
	<option value="Burundi">Burundi</option>
	<option value="Cambodia">Cambodia</option>
	<option value="Cameroon">Cameroon</option>
	<option value="Canada">Canada</option>
	<option value="Cape Verde">Cape Verde</option>
	<option value="Central African Republic">Central African Republic</option>
	<option value="Chad">Chad</option>
	<option value="Chile">Chile</option>
	<option value="China">China</option>
	<option value="Colombia">Colombia</option>
	<option value="Comoros">Comoros</option>
	<option value="Congo">Congo</option>
	<option value="Costa Rica">Costa Rica</option>
	<option value="Cote d'Ivoire">Cote d'Ivoire</option>
	<option value="Croatia">Croatia</option>
	<option value="Cuba">Cuba</option>
	<option value="Cyprus">Cyprus</option>
	<option value="Czech Republic">Czech Republic</option>
	<option value="Denmark">Denmark</option>
	<option value="Djibouti">Djibouti</option>
	<option value="Dominica">Dominica</option>
	<option value="Dominican Republic">Dominican Republic</option>
	<option value="East Timor">East Timor</option>
	<option value="Ecuador">Ecuador</option>
	<option value="Egypt">Egypt</option>
	<option value="El Salvador">El Salvador</option>
	<option value="Equatorial Guinea">Equatorial Guinea</option>
	<option value="Eritrea">Eritrea</option>
	<option value="Estonia">Estonia</option>
	<option value="Ethiopia">Ethiopia</option>
	<option value="Fiji">Fiji</option>
	<option value="Finland">Finland</option>
	<option value="France">France</option>
	<option value="Gabon">Gabon</option>
	<option value="Gambia">Gambia</option>
	<option value="Georgia">Georgia</option>
	<option value="Germany">Germany</option>
	<option value="Ghana">Ghana</option>
	<option value="Greece">Greece</option>
	<option value="Grenada">Grenada</option>
	<option value="Guatemala">Guatemala</option>
	<option value="Guinea">Guinea</option>
	<option value="Guinea-Bissau">Guinea-Bissau</option>
	<option value="Guyana">Guyana</option>
	<option value="Haiti">Haiti</option>
	<option value="Honduras">Honduras</option>
	<option value="Hong Kong">Hong Kong</option>
	<option value="Hungary">Hungary</option>
	<option value="Iceland">Iceland</option>
	<option value="India">India</option>
	<option value="Indonesia">Indonesia</option>
	<option value="Iran">Iran</option>
	<option value="Iraq">Iraq</option>
	<option value="Ireland">Ireland</option>
	<option value="Israel">Israel</option>
	<option value="Italy">Italy</option>
	<option value="Jamaica">Jamaica</option>
	<option value="Japan">Japan</option>
	<option value="Jordan">Jordan</option>
	<option value="Kazakhstan">Kazakhstan</option>
	<option value="Kenya">Kenya</option>
	<option value="Kiribati">Kiribati</option>
	<option value="North Korea">North Korea</option>
	<option value="South Korea">South Korea</option>
	<option value="Kuwait">Kuwait</option>
	<option value="Kyrgyzstan">Kyrgyzstan</option>
	<option value="Laos">Laos</option>
	<option value="Latvia">Latvia</option>
	<option value="Lebanon">Lebanon</option>
	<option value="Lesotho">Lesotho</option>
	<option value="Liberia">Liberia</option>
	<option value="Libya">Libya</option>
	<option value="Liechtenstein">Liechtenstein</option>
	<option value="Lithuania">Lithuania</option>
	<option value="Luxembourg">Luxembourg</option>
	<option value="Macedonia">Macedonia</option>
	<option value="Madagascar">Madagascar</option>
	<option value="Malawi">Malawi</option>
	<option value="Malaysia">Malaysia</option>
	<option value="Maldives">Maldives</option>
	<option value="Mali">Mali</option>
	<option value="Malta">Malta</option>
	<option value="Marshall Islands">Marshall Islands</option>
	<option value="Mauritania">Mauritania</option>
	<option value="Mauritius">Mauritius</option>
	<option value="Mexico">Mexico</option>
	<option value="Micronesia">Micronesia</option>
	<option value="Moldova">Moldova</option>
	<option value="Monaco">Monaco</option>
	<option value="Mongolia">Mongolia</option>
	<option value="Montenegro">Montenegro</option>
	<option value="Morocco">Morocco</option>
	<option value="Mozambique">Mozambique</option>
	<option value="Myanmar">Myanmar</option>
	<option value="Namibia">Namibia</option>
	<option value="Nauru">Nauru</option>
	<option value="Nepal">Nepal</option>
	<option value="Netherlands">Netherlands</option>
	<option value="New Zealand">New Zealand</option>
	<option value="Nicaragua">Nicaragua</option>
	<option value="Niger">Niger</option>
	<option value="Nigeria">Nigeria</option>
	<option value="Norway">Norway</option>
	<option value="Oman">Oman</option>
	<option value="Pakistan">Pakistan</option>
	<option value="Palau">Palau</option>
	<option value="Panama">Panama</option>
	<option value="Papua New Guinea">Papua New Guinea</option>
	<option value="Paraguay">Paraguay</option>
	<option value="Peru">Peru</option>
	<option value="Philippines">Philippines</option>
	<option value="Poland">Poland</option>
	<option value="Portugal">Portugal</option>
	<option value="Puerto Rico">Puerto Rico</option>
	<option value="Qatar">Qatar</option>
	<option value="Romania">Romania</option>
	<option value="Russia">Russia</option>
	<option value="Rwanda">Rwanda</option>
	<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
	<option value="Saint Lucia">Saint Lucia</option>
	<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
	<option value="Samoa">Samoa</option>
	<option value="San Marino">San Marino</option>
	<option value="Sao Tome and Principe">Sao Tome and Principe</option>
	<option value="Saudi Arabia">Saudi Arabia</option>
	<option value="Senegal">Senegal</option>
	<option value="Serbia and Montenegro">Serbia and Montenegro</option>
	<option value="Seychelles">Seychelles</option>
	<option value="Sierra Leone">Sierra Leone</option>
	<option value="Singapore">Singapore</option>
	<option value="Slovakia">Slovakia</option>
	<option value="Slovenia">Slovenia</option>
	<option value="Solomon Islands">Solomon Islands</option>
	<option value="Somalia">Somalia</option>
	<option value="South Africa">South Africa</option>
	<option value="Spain">Spain</option>
	<option value="Sri Lanka">Sri Lanka</option>
	<option value="Sudan">Sudan</option>
	<option value="Suriname">Suriname</option>
	<option value="Swaziland">Swaziland</option>
	<option value="Sweden">Sweden</option>
	<option value="Switzerland">Switzerland</option>
	<option value="Syria">Syria</option>
	<option value="Taiwan">Taiwan</option>
	<option value="Tajikistan">Tajikistan</option>
	<option value="Tanzania">Tanzania</option>
	<option value="Thailand">Thailand</option>
	<option value="Togo">Togo</option>
	<option value="Tonga">Tonga</option>
	<option value="Trinidad and Tobago">Trinidad and Tobago</option>
	<option value="Tunisia">Tunisia</option>
	<option value="Turkey">Turkey</option>
	<option value="Turkmenistan">Turkmenistan</option>
	<option value="Tuvalu">Tuvalu</option>
	<option value="Uganda">Uganda</option>
	<option value="Ukraine">Ukraine</option>
	<option value="United Arab Emirates">United Arab Emirates</option>
	<option value="United Kingdom">United Kingdom</option>
	<option value="United States">United States</option>
	<option value="Uruguay">Uruguay</option>
	<option value="Uzbekistan">Uzbekistan</option>
	<option value="Vanuatu">Vanuatu</option>
	<option value="Vatican City">Vatican City</option>
	<option value="Venezuela">Venezuela</option>
	<option value="Vietnam">Vietnam</option>
	<option value="Yemen">Yemen</option>
	<option value="Zambia">Zambia</option>
	<option value="Zimbabwe">Zimbabwe</option>
																 
				      </select>
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="emp_mobile" class="col-sm-3 control-label">Mobile Number <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="emp_mobile" required placeholder="Enter Mobile Number" name="emp_mobile" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->				
			<div class="form-group">
	        	<label for="emp_email" class="col-sm-3 control-label">Email  Address <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="email" class="form-control" id="emp_email" required placeholder="Email Address" name="emp_email" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="bank_name" class="col-sm-3 control-label"> Bank Name :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  required id="bank_name" placeholder="Enter Bank Name  " name="bank_name" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="bank_branch" class="col-sm-3 control-label"> Bank Branch :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="bank_branch" placeholder="Enter Bank Branch  " name="bank_branch" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="bank_account_name" class="col-sm-3 control-label"> Bank Account Name :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="bank_account_name" placeholder="Enter Bank Account Name  " name="bank_account_name" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="bank_account_no" class="col-sm-3 control-label"> Bank Account Numer :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"   id="bank_account_no" placeholder="Enter Bank Account Number  " name="bank_account_no" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_contact_fullname" class="col-sm-3 control-label">Contact full Name <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  required id="emp_contact_fullname" placeholder="Enter Contact Full name  " name="emp_contact_fullname" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_contact_housenumber" class="col-sm-3 control-label">Contact Person House Number :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="emp_contact_housenumber" placeholder="Contact Person House No" name="emp_contact_housenumber" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_contact_mobile" class="col-sm-3 control-label">Contact Person Number <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  required id="emp_contact_mobile" placeholder="Contact Person Mobile" name="emp_contact_mobile" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_contact_occupation" class="col-sm-3 control-label">Contact Person Occupation <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" required id="emp_contact_occupation" placeholder="Contact Person Occupation" name="emp_contact_occupation" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_contact_relationshipToEmp" class="col-sm-3 control-label">Contact Relationship To Employee <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="emp_contact_relationshipToEmp" placeholder=" Contact Relationship To Employee" name="emp_contact_relationshipToEmp" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="position_id" class="col-sm-3 control-label">Position <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-5">
				      <select class="form-control" id="position_id" name="position_id" required>
					    <option value="0">~~ SELECT Position ~~</option>
				      	<?php
                         include ('conn.php');
				        $get_pos ="select * from positions";
				        $run_pos = mysqli_query($conn, $get_pos);
				        while ($row_pos = mysqli_fetch_array($run_pos)){
				        $position_id =$row_pos['position_id'];
				        $pos_name =$row_pos['position'];

                         echo "<option value='$position_id'>$pos_name</option>";

                        }
		                ?>
						
				      </select>
				    </div>
					<div class="col-sm-3">
					   <a href="positions" title ="Add New Position"> <i class="glyphicon glyphicon-plus "></i> Add Position</a>
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="head_dep_id" class="col-sm-3 control-label">Head Of Department <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-5">
				      <select class="form-control" id="head_dep_id" name="head_dep_id" required>
					    <option value="0">~~ SELECT Head Of Department ~~</option>
                        <?php
                        include ('conn.php');
				        $get_dep ="select h.head_dep_id,h.dep_id,h.HeadOfDepartment,d.dep_name from headOfDepartments h
						            join departments d on h.dep_id=d.dep_id ";
				        $run_dep = mysqli_query($conn, $get_dep);
				        while ($row_dep = mysqli_fetch_array($run_dep)){
						$head_dep_id=$row_dep[0];
				        $dep_id =$row_dep[1];
						$HeadOfDepartment =$row_dep[2];
				        $dep_name =$row_dep[3];
						
						

                        echo "<option value='$head_dep_id'>$dep_name , $HeadOfDepartment</option>";

                        }
		                ?>					  
				      </select>
					  </div>
					  <div class="col-sm-3">
					   <a href="headOfDepartments" title ="Add New Head Of Department"> <i class="glyphicon glyphicon-plus "></i> Add Head Of Department</a>
				    </div>
	        </div> <!-- /form-group-->	
            <div class="form-group">
	        	<label for="basic_salary" class="col-sm-3 control-label">Basic Salary <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required id="basic_salary" placeholder="Employee Basic Salary  " name="basic_salary" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="employment_type" class="col-sm-3 control-label">Employment Type <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="employment_type" name="employment_type" required >
				      	<option value="">~~ SELECT Employment Type ~~</option>
				      	<option value="Permanent">Permanent</option>
                        <option value="Probationary">Probationary</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	
            <div class="form-group">
	        	<label for="annual_leave" class="col-sm-3 control-label">Annual Leave <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required id="annual_leave" placeholder="Employee Annual Leave   " name="annual_leave" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
            <div class="form-group">
	        	<label for="sick_leave" class="col-sm-3 control-label">Sick Leave <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required id="sick_leave" placeholder="Employee Annual Sick Leave   " name="sick_leave" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
            <div class="form-group">
	        	<label for="year" class="col-sm-3 control-label">Year  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				       <select class="form-control" id="year" name="year" required  >
					   <option value="">~~ Select Year ~~</option>
				      	<?php
						    for ($i=2018 ; $i <= 3000 ; $i++ )
	                          {	
	                              echo "<option value='$i'>$i</option>" ;				
                              }                    
						?>
				       </select>

				    </div>
	        </div> <!-- /form-group-->				
			<div class="form-group">
	        	<label for="emp_resume" class="col-sm-3 control-label">Employee Resume Letter :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="emp_resume" placeholder="Employee Resume Letter " name="emp_resume" class="file-loading" style="width:auto;"/>
					    </div>				      
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_offerLetter" class="col-sm-3 control-label">Employee Offer Letter :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="emp_offerLetter" placeholder="Employee Offer Letter" name="emp_offerLetter" class="file-loading" style="width:auto;"/>
					    </div>				      
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_joiningLetter" class="col-sm-3 control-label">Employee Joining Letter :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="emp_joiningLetter" placeholder="Employee Joining Letter" name="emp_joiningLetter" class="file-loading" style="width:auto;"/>
					    </div>			      
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_contractPaper" class="col-sm-3 control-label">Employee Contract Paper :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="emp_contractPaper" placeholder="Employee Contract Paper" name="emp_contractPaper" class="file-loading" style="width:auto;"/>
					    </div>				      
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_idProff" class="col-sm-3 control-label">Employee ID Card :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="emp_idProff" placeholder="Employee ID Card" name="emp_idProff" class="file-loading" style="width:auto;"/>
					    </div>	      
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="emp_otherDocument" class="col-sm-3 control-label">Employee Other Document :</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="emp_otherDocument" placeholder="Employee Other Document" name="emp_otherDocument" class="file-loading" style="width:auto;"/>
					    </div>
				      
				    </div>
	        </div> <!-- /form-group-->	
             <div class="form-group">
	        	<label for="submit" class="col-sm-3 control-label"></label>
	        	<label class="col-sm-1 control-label"></label>
				    <div class="col-sm-8">
				    <button type="submit" name="submit" class="btn btn-success" style="width:300px; margin-left:430px;">Save</button>	  
				    </div>
	        </div> <!-- /form-group-->	   
				
            
		        </div> 
                	
                </form>
                </div> 
			
			
    	
		   
		   </div>
		   </div>
		
      
    </div>
	
	
</div>
   
    <!-- GLOBAL SCRIPTS -->
    <script src="asset/plugins/jquery-2.0.3.min.js"></script>
     <script src="asset/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="asset/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->

         <!-- PAGE LEVEL SCRIPTS -->
    <script src="asset/plugins/jasny/js/bootstrap-fileupload.js"></script>
         <!-- END PAGE LEVEL SCRIPTS -->
<script>
$(document).ready(function() {
	$("#emp_date").datepicker({showOtherMonths: true , changeMonth: true});
	$("#emp_dob").datepicker({showOtherMonths: true , changeMonth: true , changeYear: true});
	
	
} );
</script>  
</body>
</html>
