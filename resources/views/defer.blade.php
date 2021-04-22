<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5 - defer</title>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    

    <script src="https://datatables.yajrabox.com/js/jquery.min.js"></script>
    <script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>

</head>
<body>

<div class="container">
  <table id="users" class="table table-hover table-condensed" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Post Title</th>
            <th>Category</th>
            <th>Tag</th>
            <th>Action</th>
        </tr>

        
    </thead>

        <tbody>
            @foreach($clients as $client)
                <tr>
                  <td>{{$client->clientes_id}}</td>
                  <td>{{$client->clientes_nomedaradio}}</td>
                  <td>{{$client->clientes_cnpfcnpj}}</td>
                  <td>**</td>
                  <td>**</td>
                </tr>
            @endforeach

    </tbody>



  </table>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('#users').DataTable( {
        //"bPaginate": true,
        "processing": true,
        "serverSide": true,
        ajax: {
            url: '{{ route('getdefer') }}'
            //dataSrc: 'data'
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'cpf', name: 'cpf'},
            {data: 'genre', name: 'genre'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "deferLoading": 3476

    } );
     //3476
       
});
</script>
</body>
</html>