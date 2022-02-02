<?php

include 'database.php';
error_reporting(E_ERROR);
$customer = [];
$sql = "SELECT * FROM customer";

if ($result = mysqli_query($con,$sql)) 
{
	$cr = 0;
	while ($row = mysqli_fetch_assoc($result))
	 {
		$customer[$cr]['id'] = $row['id'];
		$customer[$cr]['status'] = $row['status'];

		$customer[$cr]['fname'] = $row['fname'];
		$customer[$cr]['lname'] = $row['lname'];
		$customer[$cr]['email'] = $row['email'];
		$customer[$cr]['paper'] = $row['paper'];
		$customer[$cr]['date'] = $row['date'];
		$customer[$cr]['phone_no'] = $row['phone_no'];
		$customer[$cr]['address'] = $row['address'];
		$customer[$cr]['village'] = $row['village'];
		$customer[$cr]['pincode'] = $row['pincode'];

		$cr++;
	}

	
	echo json_encode($customer);
}
else
{
	http_response_code(404);
}

?>