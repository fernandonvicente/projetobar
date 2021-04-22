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
              <li><a href="javascript:void(0);"><?php echo e($pagAction); ?></a></li>
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
            <div class="panel-heading"> Verifique nosso cardápio</div>
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

                                <?php $__currentLoopData = $lista_cardapio_com_estoque; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td width="150">
                                        <img src="<?php echo e(url('/assets_plugin_admin/plugins/images/sem-imagem.jpg')); ?>" alt="iMac" width="80">
                                    </td>
                                    <td width="550">
                                        <h5 class="font-500"><?php echo e($item->produto); ?></h5>
                                        <!-- <p>descrição</p> -->
                                    </td>
                                    <td width="100">R$ <?php echo e($item->preco); ?></td>                                  
                                    <td class="font-500" align="center">
                                      <span class="label label-warning font-weight-100" style="color: #000;"><?php echo e($item->categoria); ?></span>
                                    </td>
                                    
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                              
                            
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
            <h3 class="box-title">Comanda aberta</h3>
            <hr> <small>Preço Total</small>
            <h2>R$ 80,88</h2>
            <hr>
            <button class="btn btn-success model_img img-responsive" data-toggle="modal" data-target=".bs-example-modal-lg">Conferir</button>

            <!-- <button class="btn btn-default btn-outline">Cancel</button> -->
        </div>
    </div>

</div>

<!-- sample modal content -->
 <?php echo $__env->make('area-cliente.modal-comanda-itens', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- /.modal -->

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.template_cliente', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bayarea\resources\views/area-cliente/cardapio.blade.php ENDPATH**/ ?>