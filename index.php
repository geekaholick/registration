<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.3/datatables.min.css" rel="stylesheet"/>

    <title>USCCMPC</title>
  </head>
  <body>
    <h1 class="text-center">USC & Community Multipurpose Cooperative</h1>
    <h1 class="text-center">60th General Assembly</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <!-- <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="button" style="margin-bottom: 40px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                            ADD
                        </button>
                    </div>
                    <div class="col-md-2"></div>
                </div> -->
                
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table id="datatable" class="table">
                            <thead>
                                <th>ID</th>
                                <th>LASTNAME</th>
                                <th>FIRSTNAME</th>
                                <th>EMAIL</th>
                                <th>TYPE</th>
                                <th>ACTIONS</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.3/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#datatable').DataTable({
            'serverSide': true,
            'processing': true,
            'paging': true,
            'order': [],
            'ajax': {
                'url': 'fetch_data.php',
                'type': 'post',
            },
            'fnCreateRow': function(nRow, aData, iDataIndex)
            {
                $(nRow).attr('id', aData[0]);
            },
            'columnDefs': [{
                'target': [0,5],
                'orderable': false, 
            }]
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.checkInBtn', function(event){
            var id = $(this).data('id');
            $.ajax({
                url: "checkin.php",
                data: {id:id},
                type: "post",
                success: function(data)
                {
                    var json = JSON.parse(data);
                    status = json.status;
                    if(status == 'success')
                    {
                        table = $('#datatable').DataTable();
                        table.draw(); 
                    }
                    else
                    {
                        alert('Error checking in.');
                    }
                } 
            });
        });

        $(document).on('click', '.checkOutBtn', function(event){
            var id = $(this).data('id');
            $.ajax({
                url: "checkout.php",
                data: {id:id},
                type: "post",
                success: function(data)
                {
                    var json = JSON.parse(data);
                    status = json.status;
                    if(status == 'success')
                    {
                        table = $('#datatable').DataTable();
                        table.draw(); 
                    }
                    else
                    {
                        alert('Error checking out.');
                    }
                } 
            });
        });
    </script>
</div>
</body>
</html>