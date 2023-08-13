<?php include('connection.php');

$sql = "SELECT * FROM members";
$query = mysqli_query($con, $sql);
$count_all_rows = mysqli_num_rows($query);

if(isset($_POST['search']['value']))
{
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE lastname like '%".$search_value."%'";
    $sql .= " OR firstname like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
    $column = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY '".$column."' ".$order;
}
else 
{
    $sql .= " ORDER BY id ASC";
}

if($_POST['length'] != -1) 
{
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT ".$start.", ".$length;
}

$data = array();

$run_query = mysqli_query($con, $sql);
$filtered_rows = mysqli_num_rows($run_query);
while($row = mysqli_fetch_assoc($run_query))
{
    $subarray = array();
    $subarray[] = $row['id'];
    $subarray[] = $row['lastname'];
    $subarray[] = $row['firstname'];
    $subarray[] = $row['email'];
    $subarray[] = $row['program'];
    $subarray[] = $row['year'];

    $dt1 = new DateTime($row['timeIn']);
    $time1 = $dt1->format('h:i A');
    $dt2 = new DateTime($row['timeOut']);
    $time2 = $dt2->format('h:i A');

    if($row['timeIn'] != null && $row['timeOut'])
    {
        $subarray[] = '<a href="javascript:void(0);" data-id='.$row['id'].' class="btn btn-sm btn-success checkInBtn">'.$time1.'</a> <a href="javascript:void(0);" data-id='.$row['id'].' class="btn btn-sm btn-success checkOutBtn">'.$time2.'</a>';
    }
    else if($row['timeIn'] != null)
    {
        $subarray[] = '<a href="javascript:void(0);" data-id='.$row['id'].' class="btn btn-sm btn-success checkInBtn">'.$time1.'</a> <a href="javascript:void(0);" data-id='.$row['id'].' class="btn btn-sm btn-warning checkOutBtn">Check Out</a>';
    }
    else
    {
        $subarray[] = '<a href="javascript:void(0);" data-id='.$row['id'].' class="btn btn-sm btn-warning checkInBtn">Check In</a> <a class="btn btn-sm btn-secondary checkOutBtn">Check Out</a>';
    }
    
    $data[] = $subarray;
}

$output = array(
    'data' => $data,
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_all_rows,
    'recordsFiltered' => $filtered_rows,
);
echo json_encode($output);
