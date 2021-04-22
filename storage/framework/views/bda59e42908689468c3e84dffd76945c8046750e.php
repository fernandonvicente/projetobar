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
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"> Cliente</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <form method="POST" action="<?php echo e(url('bayareaadmin/user/createProfilePermission')); ?>" accept-charset="UTF-8" role="form" id="form_submit" autocomplete="off" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>



  <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

              <div class="col-xs-4">           
                  
                  <button type="submit" class="btn btn-success pull-left"><i class="fa fa-fw fa-save"></i> Salvar
                  </button>
                  
                </div>
                <div class="col-xs-4">           
                  
                  
                    <label>
                      <input id="btMarcarDesmarcar" type="checkbox" checked="">
                      Marcar/Desmarcar
                    </label>
                  

                </div>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 300px;">
                  
                  <?php echo e(Form::select('role', $listRoles, $selectdRole, ['placeholder' => 'Selecione um perfil',
                                     'class' => 'form-control', 'id' => 'role', 'required' => 'required'])); ?>


                  
                </div>
              </div>


            </div>
            <!-- /.box-header -->
          
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
  </div>

  <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                              <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th>Sessão</th>
                  <th>Visualizar</th>
                  <th>Cadastrar</th>
                  <th>Editar</th>
                  <th>Excluir</th>
                </tr>

                <?php echo html_entity_decode($tr); ?>

                
              </tbody></table>
            </div>
                        </div>
                    </div>
  <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(url('/assets_admin/js/script-user.js')); ?>"></script>

<script>
$('#btMarcarDesmarcar').click(function(){
    
    if ( $(this).is(':checked') ){
      //marcar
      $('.checkbox').prop("checked", true);
     // $('.vSwitch').addClass('on');
    }else{
      //desmarca
      $('.checkbox').prop("checked", false);
     // $('.vSwitch').removeClass('on');
    }
  });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bayarea\resources\views/admin/user/permission.blade.php ENDPATH**/ ?>