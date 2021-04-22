<?php $__env->startPush('css'); ?>

<style>
    div.scroll {
        margin:5px;
        padding:5px;
        height: 510px;
        overflow: auto;
        text-align:justify;
    }
</style>

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
    <div class="col-md-9 col-lg-9 col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"> Your Cart (5 items)</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="table-responsive scroll">
                        <table class="table product-overview">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th style="text-align:center">Sessão</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="150"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/chair.jpg')); ?>" alt="iMac" width="80"></td>
                                    <td width="550">
                                        <h5 class="font-500">Rounded Chair</h5>
                                        <p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look</p>
                                    </td>
                                    <td>$153</td>                                  
                                    <td class="font-500" align="center">
                                      <span class="label label-success font-weight-100">Paid</span>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/chair2.jpg')); ?>" alt="iMac" width="80"></td>
                                    <td>
                                        <h5 class="font-500">Rounded Chair</h5>
                                        <p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look</p>
                                    </td>
                                    <td>$153</td>
                                    <td class="font-500" align="center">
                                      <span class="label label-success font-weight-100">Paid</span>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/chair3.jpg')); ?>" alt="iMac" width="80"></td>
                                    <td>
                                        <h5 class="font-500">Rounded Chair</h5>
                                        <p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look</p>
                                    </td>
                                    <td>$153</td>
                                    <td class="font-500" align="center">
                                      <span class="label label-success font-weight-100">Paid</span>
                                    </td>
                                   
                                </tr>
                                <tr>
                                    <td><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/chair4.jpg')); ?>" alt="iMac" width="80"></td>
                                    <td>
                                        <h5 class="font-500">Rounded Chair</h5>
                                        <p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look</p>
                                    </td>
                                    <td>$153</td>
                                    <td class="font-500" align="center">
                                      <span class="label label-success font-weight-100">Paid</span>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-5">
        <div class="white-box">
            <h3 class="box-title">Cardápio aberto</h3>
            <hr> <small>Preço Total</small>
            <h2>R$ 0,00</h2>
            <hr>
            <button class="btn btn-success">Conferir</button>
            <!-- <button class="btn btn-default btn-outline">Cancel</button> -->
        </div>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-5">
        <div class="white-box">
            <h3 class="box-title">For Any Support</h3>
            <hr>
            <h4><i class="ti-mobile"></i> 9998979695 (Toll Free)</h4> <small>Please contact with us if you have any questions. We are avalible 24h.</small> </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.template_cliente', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bayarea\resources\views/cliente-comanda/cardapio.blade.php ENDPATH**/ ?>