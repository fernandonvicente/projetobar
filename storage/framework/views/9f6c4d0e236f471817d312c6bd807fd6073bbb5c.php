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
              <li><a href="<?php echo e(url('/bayareaadmin/cliente/index')); ?>"><?php echo e($title); ?></a></li>
              <li class="active"><?php echo e($pagAction); ?></li>
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
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_usuarios')): ?>
                  <a href="<?php echo e(url('/bayareaadmin/cliente/create')); ?>">
                    <button class="btn btn-block btn-info"> <i class="fa fa-save"></i> Cadastrar</button>
                  </a>
                  <?php endif; ?>
                </div>
                <div class="col-lg-2 col-sm-4 col-xs-12">
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_usuarios')): ?>
                  <a href="<?php echo e(url('/bayareaadmin/user/permission')); ?>">
                    <button class="btn btn-block btn-warning"> <i class="fa fa-cogs"></i> Permissões</button>
                  </a>
                  <?php endif; ?>
                </div>
            </div>
          </p>
          <p class="text-muted m-b-30"></p>

          <div class="table-responsive">
              <table id="tb_datatable" class="display nowrap" cellspacing="0" width="100%">
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
                  <tfoot>
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
    
    
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>


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

 
</script>



<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bayarea\resources\views/admin/user2/indexajax.blade.php ENDPATH**/ ?>