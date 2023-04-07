<?php include('conenction.php')

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$type = $_POST['type'];

$sql = "INSERT INTO `member`(`firstname`,`lastname`,`type`) VALUES('$firstname', '$lastname', '$type')";
$query = mysqli_query($con, $sql);
if($query == true) 
{
    $data = array(
        'status' => 'success',
    );
    echo json_encode($data);
}
else 
{
    $data = array(
        'status' => 'failed',
    );
    echo json_encode($data);
}