<?php
require "conn.php";

$query = " select emp_fullname from employees ";

$data = mysqli_query($conn, $query);

$emp_fullname = array();

while ($row = mysqli_fetch_array($data)
{
  array_push($emp_fullname,$row['emp_id']);   
}

echo json_encodes($emp_fullname);

?>
