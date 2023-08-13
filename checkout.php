<?php include('connection.php');

$id = $_POST['id'];

$sqlCheck = "SELECT `timeOut` FROM `members` WHERE `id`='$id'";
$queryCheck = mysqli_query($con, $sqlCheck);
$rowCheck = mysqli_fetch_assoc($queryCheck);

if ($rowCheck['timeOut'] === null) {
    $sqlUpdate = "UPDATE `members` SET `timeOut`=NOW() WHERE `id`='$id'";
    $queryUpdate = mysqli_query($con, $sqlUpdate);

    if ($queryUpdate) {
        $data = array(
            'status' => 'success',
            'action' => 'checkOut'
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
        'action' => 'alreadyCheckedOut'
    );
    echo json_encode($data);
}
?>
