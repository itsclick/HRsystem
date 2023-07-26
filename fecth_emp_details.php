<?php

if(isset($_POST["emp_id"]))
{
  include("conn.php");
  $query = "select * from employees where emp = '".$_POST["emp_id"]."'";
  $result = mysqli_query($conn,$query);
  while($row = mysqli_fetch_array($result))
  {
     $data["basic_salary"] = $row["basic_salary"];
     $data["emp_ssnit_number"] = $row["emp_ssnit_number"];
  }
  
  echo json_encode($data);

}

?>