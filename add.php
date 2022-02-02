<?php
require 'database.php';
error_reporting(E_ERROR);

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{

  // Extract the data.
  $request = json_decode($postdata);
  
  if(trim($request->status) === '' || trim($request->fname) === '' || trim($request->lname) === '' || trim($request->paper) === '' || trim($request->date) === '' || trim($request->phone_no) === '' || trim($request->email) === '' || trim($request->address) === '' || trim($request->village) === '' || trim($request->pincode) === '' )
  {
    return http_response_code(400);
  }


   //sanitize
  $status = mysqli_real_escape_string($con, trim($request->status));
  $fname = mysqli_real_escape_string($con, trim($request->fname));
  $lname = mysqli_real_escape_string($con, trim($request->lname));
  $paper = mysqli_real_escape_string($con, trim($request->paper));
  $date = mysqli_real_escape_string($con, trim($request->date));
  $phone_no = mysqli_real_escape_string($con, trim($request->phone_no));
  $email = mysqli_real_escape_string($con, trim($request->email));
  $address = mysqli_real_escape_string($con, trim($request->address));
  $village = mysqli_real_escape_string($con, trim($request->village));
  $pincode = mysqli_real_escape_string($con, trim($request->pincode));
  
  
  // Store.
	$sql = "INSERT INTO `customer`(`status`,`fname`,`lname`, `paper`, `date`,`phone_no`,`email`,`address`,`village`,`pincode`) VALUES ('{$status}','{$fname}','{$lname}','{$paper}','{$date}','{$phone_no}','{$email}','{$address}','{$village}','{$pincode}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $customer = [
      'status' => $status,
      'fname' => $fname,
      'lname' => $lname,
      'paper' => $paper,
      'date' => $date,
      'phone_no' => $phone_no,
      'email' => $email,
      'address' => $address,
      'village' => $village,
      'pincode' => $pincode,

    ];
    echo json_encode($customer);
  }
  else
  {
    http_response_code(422);
  }
}