<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content-header'); ?>
  <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title"><?php echo e($title); ?></h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          
          <ol class="breadcrumb">
              <li><a href="<?php echo e(url('/bayareaadmin')); ?>">Dashboard</a></li>
              <li><a href="<?php echo e(url('/bayareaadmin/despesa/index')); ?>"><?php echo e($pagAction); ?></a></li>
              <li class="active"><?php echo e($title); ?></li>
          </ol>
      </div>
      <!-- /.col-lg-12 -->
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-sm-12">
      <div class="white-box">
          <h3 class="box-title m-b-0"></h3>
          <p>
            <div class="row">
                <div class="col-lg-2 col-sm-4 col-xs-12">
                  <a href="<?php echo e(url('/bayareaadmin/despesa/create')); ?>">
                    <button class="btn btn-block btn-info"> <i class="fa fa-save"></i> Cadastrar</button>
                  </a>
                </div>
            </div>
          </p>
          <p class="text-muted m-b-30"></p>

          <div class="table-responsive">
              <table id="tb_datatable" class="display nowrap" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Valor</th>
                          <th>Descrição</th>
                          <th>Data Cadastro</th>
                          <th>Ações</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>ID</th>
                          <th>Valor</th>
                          <th>Descrição</th>
                          <th>Data Cadastro</th>
                          <th>Ações</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
    
<?php $__env->startPush('scripts'); ?>
    
    <script src="<?php echo e(url('/assets_admin/js/script-despesa.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>


<script type="text/javascript">

$(function () {

  //https://demos.laraget.com/images/loading2.gif
    
    //ao carregar página
   var table = $('#tb_datatable').DataTable({
    "order": [[0,'dsc']], //informa qual coluna inicia com ordenacao, neste caso estou removendo a primeiro coluna (0)
    oLanguage: {
          "sProcessing": "Carregando...",
          "sLengthMenu": "Mostrar _MENU_ registros por página",
          "sZeroRecords": "Nenhum registro encontrado",
          "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
          "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
          "sInfoFiltered": "(filtrado de _MAX_ registros)",
          "sSearch": "Pesquisar: ",
          "oPaginate": {
              "sFirst": "Início",
              "sPrevious": "Anterior",
              "sNext": "Próximo",
              "sLast": "Último"
          }
      },
      dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
       processing: true,
       serverSide: true,
       ajax: {
           url: '<?php echo url("/bayareaadmin/despesa/carregaTabela"); ?>',
           data: function ( d ) {
               //d.valorFiltroInput = $('#valorFiltroInput').val();
               // d.custom = $('#myInput').val();
               // etc
           }
       },
       columns: [
           {data: 'id', name: 'id'},
           {data: 'valor', name: 'valor'},   
           {data: 'descricao', name: 'descricao'},  
           {data: 'created_at', name: 'created_at'},
           {data: 'action', name: 'action', orderable: false, searchable: false},
       ]
   });

   
});

</script>  
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelseterenan\resources\views/admin/despesa/indexajax.blade.php ENDPATH**/ ?>