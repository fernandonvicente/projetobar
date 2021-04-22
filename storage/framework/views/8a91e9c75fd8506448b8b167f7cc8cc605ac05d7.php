<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content-header'); ?>
	<section class="content-header">
      <h1>
        Usuários
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('bayareaadmin')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Usuários</li>
      </ol>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
  <?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Alerta!</h4>
    <?php echo e(session()->get('message')); ?>

  </div>
  <?php endif; ?>
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">  
                <div class="col-xs-12">  
                  
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_permissao_usuarios')): ?>
                  <a href="<?php echo e(url('/bayareaadmin/user/permission')); ?>">
                    <button type="button" class="btn btn-warning pull-right" style="margin-left: 20px;"><i class="fa fa-cogs"></i> Permissões
                    </button>
                  </a>
                  <?php endif; ?>
                  
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_usuarios')): ?>
                  <a href="<?php echo e(url('bayareaadmin/user/create')); ?>">
                    <button type="button" class="btn btn-info pull-right"><i class="fa fa-fw fa-plus"></i> Cadastrar
                    </button>
                  </a>
                  <?php endif; ?>
                  
                </div>
                
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Status</th>
                  <th>Tipo</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($user->id); ?></td>
                  <td><?php echo e($user->name); ?></td>
                  <td><?php echo e($user->email); ?></td>
                  <td><?php echo e($user->status); ?></td>
                  <td><?php echo e($user->role_name); ?></td>
                  <td>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_usuarios')): ?>
                    <a href="<?php echo e(url('bayareaadmin/user/edit')); ?>"><i class="fa fa-fw fa-edit" title="Editar"></i></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_usuarios')): ?>
                    <a href="javascript:void(0);" onclick="excluirRegistro(<?php echo e($user->id); ?>);"><i class="fa fa-trash" title="Excluir"></i></a>
                    <?php endif; ?>

                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Status</th>
                  <th>Tipo</th>
                  <th>Ações</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<!-- DataTables -->
<script src="<?php echo e(url('/assets_admin/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>

<script>

  function excluirRegistro(idRegistro){
    if (confirm("Tem certeza que deseja excluir o registro?")) {
      var id = idRegistro;
      // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
      $.get('<?php echo e(url("/bayareaadmin/user/delete/")); ?>/' + id, function (resposta) {
        if(resposta=='Registro excluido com sucesso!')
          location.reload();
        else
          alert(resposta);
      });
    }
  }

  $(function () {
    $('#example1').DataTable({
        'order': [[1,'asc']],
        'aLengthMenu': [[50], [50]],
        'iDisplayLength': 50,
        scrollY: 2000,
        deferRender: true,
        scrollCollapse: true,
        scroller: {
          loadingIndicator: true
        },
        "oLanguage": {
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
    })

    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bayarea\resources\views/admin/user/index.blade.php ENDPATH**/ ?>