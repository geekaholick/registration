<?php
include('connection.php');

    $id = $_POST['id'];
    $type = $_POST['type'];

    $sql = "UPDATE `members` SET `$type`=NULL WHERE `id`='$id'";
    $query = mysqli_query($con, $sql);

    if($type=='timeIn'){
        $sqlV2 = "UPDATE `members` SET `timeOut`=NULL WHERE `id`='$id'";
        $queryV2 = mysqli_query($con, $sqlV2);      
    }
    
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
?>