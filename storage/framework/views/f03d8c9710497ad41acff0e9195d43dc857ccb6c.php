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
                    <?php if($formAction=='create'): ?>
                     <form action="<?php echo e(url('bayareaadmin/user/store')); ?>" method="post" id="form_submit" name="form_submit" autocomplete="off" enctype="multipart/form-data">
                    <?php else: ?>
                      <form action="<?php echo e(url('bayareaadmin/user/update')); ?>/<?php echo e($id); ?>" method="post" id="form_submit" name="form_submit" autocomplete="off" enctype="multipart/form-data">
                    <?php endif; ?>

                    <?php echo e(csrf_field()); ?>


                        <div class="form-body">
                            <h3 class="box-title">Cadastro</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ocultarUploadImagem">
                                        <label class="control-label">Nome</label>
                                        <?php echo e(Form::text('name', $name, ['id' => 'name','class' => 'form-control','placeholder' => 'Preencha o nome', 'required' => 'required' ])); ?>

                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input class="form-control" name="password" id="password" placeholder="******" type="password" <?php echo e($required_password); ?>>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">E-mail</label>
                                        <?php echo e(Form::email('email', $email, ['id' => 'email','class' => 'form-control','placeholder' => 'Preencha o e-mail', 'required' => 'required' ])); ?>

                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php if(Auth::user()->id == 68): ?>
                                        <label>Tipo de Usuário</label>
                                        <?php echo e(Form::select('role', $listRoles, $selectdRole, ['placeholder' => 'Selecione uma opção',
                                                             'class' => 'form-control', 'id' => 'role', 'required' => 'required'])); ?>

                                        <?php else: ?>
                                        <input type="hidden" name="role" name="role" value="<?php echo e($selectdRole); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            
                        </div>
                        <div class="form-actions text-right"> 
                            <input id="totalImagens" name="totalImagens" type="hidden" value="<?php echo e($totalImage); ?>" />
                            <input id="stautsImagem" name="stautsImagem" type="hidden" value="">
                            <input id="nomeImagem" name="nomeImagem" type="hidden" value="<?php echo e($avatar); ?>">
                            <input id="idRecord" name="idRecord" type="hidden" value="<?php echo e($id); ?>">
                            
                            <input id="page" name="page" type="hidden" value="<?php echo e($numberPage); ?>">  
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Salvar</button>
                        </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bayarea\resources\views/admin/user/create-edit.blade.php ENDPATH**/ ?>