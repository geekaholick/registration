<?php 

include('connection.php');

$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];
$email = $_POST['emailAdd'];
$program = $_POST['program'];
$year = $_POST['yearLvl'];

$sql = "INSERT INTO `members`(`firstname`,`lastname`,`email`,`program`,`year`) VALUES('$firstname', '$lastname', '$email','$program','$year')";
$query = mysqli_query($con, $sql);
if($query == true) 
{
    $data = array(
        'status' => 'success',
        'message' => 'Member added successfully',
    );
    echo json_encode($data);
}
else 
{
    $data = array(
        'status' => 'failed',
        'message' => 'Error adding member',
    );
    echo json_encode($data);
}

?>