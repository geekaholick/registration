<?php include('connection.php');

// date_default_timezone_set('Asia/Manila');
// $current_date = date('d/m/Y == H:i:s');

$id = $_POST['id'];

// $sql = "UPDATE members SET timeIn='".$current_date."' WHERE id='$id'";
$sql = "UPDATE `members` SET `timeIn`=NOW() WHERE `id`='$id'";
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