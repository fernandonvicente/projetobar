<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5 - Implementing datatables tutorial using yajra package</title>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">


    <script src="https://datatables.yajrabox.com/js/jquery.min.js"></script>
    <script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>

</head>
<body>
<input type="hidden" name="urlJs" id="urlJs" value="{{ url('') }}">
<div class="container">
  <table id="users" class="table table-hover table-condensed" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Action</th>
        </tr>
    </thead>
  </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        'aLengthMenu': [[50], [50]],
        'iDisplayLength': 50,
        "ajax": $('#urlJs').val()+'/clientajax/getposts',
        "columns": [
            {data: 'fantasia', name: 'fantasia'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
</body>
</html>