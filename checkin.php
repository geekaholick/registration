<?php
include('connection.php');

$id = $_POST['id'];

$sqlCheck = "SELECT `timeIn` FROM `members` WHERE `id`='$id'";
$queryCheck = mysqli_query($con, $sqlCheck);
$rowCheck = mysqli_fetch_assoc($queryCheck);

if ($rowCheck['timeIn'] === null) {
    $sqlUpdate = "UPDATE `members` SET `timeIn`=NOW() WHERE `id`='$id'";
    $queryUpdate = mysqli_query($con, $sqlUpdate);

    if ($queryUpdate) {
        $data = array(
            'status' => 'success',
            'action' => 'checkIn'
        );
        echo json_encode($data);
    } else {
        $data = array(
            'status' => 'failed'
        );
        echo json_encode($data);
    }
} else {
    $data = array(
        'status' => 'success',
        'action' => 'alreadyCheckedIn'
    );
    echo json_encode($data);
}
?>
