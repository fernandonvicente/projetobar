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
                    <form action="javascript:void(0);" name="formCliente" id="formCliente" method="post" enctype="multipart/form-data" > 
                        <?php echo e(csrf_field()); ?>

                        <div class="form-body">
                            <h3 class="box-title">Cadastro</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nome</label>
                                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="<?php echo e($nome); ?>" required>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Documento</label>
                                        <input type="text" id="documento" name="documento" class="form-control" placeholder="" value="<?php echo e($documento); ?>">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">E-mail</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="seuemail@dominio.com" value="<?php echo e($email); ?>">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Celular</label>
                                        <input type="celular" id="celular" name="celular" class="form-control maskTel" placeholder="(xx) xxxxx-xxxx" value="<?php echo e($celular); ?>">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            
                        </div>
                        <div class="form-actions text-right"> 
                            <input type="hidden" id="idRecord" name="idRecord" value="<?php echo e($cliente_id); ?>">
                            <input type="hidden" id="status_bt" name="status_bt" value="">
                            <button type="button" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(url('/assets_admin/js/script-cliente.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelseterenan\resources\views/admin/cliente/create-edit.blade.php ENDPATH**/ ?>