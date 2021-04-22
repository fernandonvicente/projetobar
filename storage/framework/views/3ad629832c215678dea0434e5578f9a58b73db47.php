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
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"> Despesa</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <form action="javascript:void(0);" name="formDespesaItem" id="formDespesaItem" method="post" enctype="multipart/form-data" > 
                        <?php echo e(csrf_field()); ?>

                        <div class="form-body">
                            <h3 class="box-title">Cadastro</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Despesa</label>
                                        
                                        <select class="form-control clearItem" name="despesa_tipo_id" id="despesa_tipo_id">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Cardápio</label>
                                        
                                        <select class="form-control clearItem" name="cardapio_id" id="cardapio_id">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Qtidade</label>
                                        <input type="text" id="quantidade" name="quantidade" class="form-control number clearItem" placeholder="" value="">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Valor</label>
                                        <input type="text" id="valor" name="valor" class="form-control money clearItem" placeholder="" value="">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label"></label>
                                        <p style="margin-top: 6px;">
                                            <input type="hidden" id="idRecord2" name="idRecord2" value="<?php echo e($despesa_id); ?>">
                                            <input type="hidden" id="status_bt_item" name="status_bt_item" value="">
                                            <button type="submit" class="btn btn-warning btn-success-item"> <i class="fa fa-plus"></i> Adicionar</button>
                                        </p>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                    </form>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Despesa</th>
                                            <th>Cardápio</th>
                                            <th>Qtidade</th>
                                            <th>Valor</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listaDespesas">

                                        <?php if($qtDespesas > 0): ?>
                                            <?php $__currentLoopData = $listaDespesas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr id="tr_item_<?php echo e($item->despesa_item_id); ?>">
                                                    <td><?php echo e($item->despesa_item_id); ?></td>
                                                    <td><?php echo e($item->despesa_tipo); ?></td>
                                                    <td><?php echo e($item->cardapio); ?></td>
                                                    <td><?php echo e($item->quantidade); ?></td>                     
                                                    <td>R$ <?php echo e($item->valor); ?></td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="excluirRegistroItem(<?php echo e($item->despesa_item_id); ?>);"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - <?php echo e($item->despesa_item_id); ?>"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" style="text-align: center">Nenhuma despesa localizada.</td>
                                            </tr>
                                        <?php endif; ?>
                                        

                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="total_despesas">R$ <?php echo e($total_despesas); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>



                                </div>  
                            </div>
                    <form action="javascript:void(0);" name="formDespesa" id="formDespesa" method="post" enctype="multipart/form-data" > 
                         <?php echo e(csrf_field()); ?>

                            <!--/row-->
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Descrição</label>
                                        <textarea class="form-control" rows="5" name="descricao" id="descricao"><?php echo e($descricao); ?></textarea>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Anexar NF</label>
                                        <input type="file" id="arquivo" name="arquivo" class="form-control" placeholder="" value="">
                                        <?php if($anexo): ?>
                                        <p style="color: #ff0000;">
                                            <a href="<?php echo e(url('/bayareaadmin/despesa/download')); ?>/<?php echo e($anexo); ?>">
                                            <i class="fa fa-paperclip"></i> Ver anexo
                                            </a> 
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label"></label>
                                        <p style="margin-top: 6px;">
                                            <!-- mostrar o anexo -->
                                        </p>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            
                        </div>

                        <div class="form-actions text-right"> 
                            <input type="hidden" id="idRecord" name="idRecord" value="<?php echo e($despesa_id); ?>">
                            <input type="hidden" id="status_bt" name="status_bt" value="">
                            <!--<button type="button" class="btn btn-default">Cancelar</button>-->
                            <button type="submit" class="btn btn-success btn-final"> <i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(url('/assets_admin/js/script-despesa.js')); ?>"></script>

   


<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelseterenan\resources\views/admin/despesa/create-edit.blade.php ENDPATH**/ ?>