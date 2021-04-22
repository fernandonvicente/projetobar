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
              <li><a href="<?php echo e(url('/bayareaadmin/comanda/index')); ?>"><?php echo e($pagAction); ?></a></li>
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
            <div class="panel-heading"> <?php echo e($title); ?></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <p>
                        <div class="row">
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                              <a href="<?php echo e(url('/bayareaadmin/cliente/create')); ?>">
                                <button class="btn btn-block btn-info"> <i class="fa fa-save"></i> Cadastrar Cliente</button>
                              </a>
                            </div>
                        </div>
                      </p>

                    <form action="javascript:void(0);" name="formComandaItem" id="formComandaItem" method="post" enctype="multipart/form-data" > 
                        <?php echo e(csrf_field()); ?>

                        <div class="form-body">
                            <h3 class="box-title">Cadastro</h3>

                            <hr>
                            <?php if($checkedRecebimentoTiposCombo == 'A'): ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Cliente</label>
                                        
                                        <?php echo e(Form::select('cliente_id', $clientesCombo, $checkedCliente, ['placeholder' => 'Selecione...', 'class' => 'form-control ', 'id' => 'cliente_id', 'required' => 'required', 'tabindex' => '1', 'data-plugin-selectTwo' => 'data-plugin-selectTwo',
                                        $disabled => $disabled])); ?>


                                        <?php if($checkedCliente): ?>
                                            <input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo e($checkedCliente); ?>">
                                        <?php endif; ?>

                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Cardápio</label>
                                        
                                        <?php echo e(Form::select('cardapio_id', $cardapiosCombo, $checkedCardapio, ['placeholder' => 'Selecione...', 'class' => 'form-control clearItem showCardapio', 'id' => 'cardapio_id', 'required' => 'required', 'tabindex' => '2', 'data-plugin-selectTwo' => 'data-plugin-selectTwo'])); ?>

                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Quantidade</label>
                                        <input type="text" id="quantidade" name="quantidade" class="form-control number clearItem" placeholder="" value="" tabindex="3" >
                                    </div>
                                </div>

                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Valor</label>
                                        <input type="text" id="valor" name="valor" class="form-control clearItem" placeholder="" value="0,00" tabindex="4" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label"></label>
                                        <p style="margin-top: 6px;">
                                            <input type="hidden" id="idRecord2" name="idRecord2" value="<?php echo e($comanda_id); ?>">
                                            <input type="hidden" id="status_bt_item" name="status_bt_item" value="">
                                            <button type="submit" class="btn btn-warning btn-success-item" tabindex="5"> <i class="fa fa-plus"></i> Adicionar</button>
                                        </p>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <?php endif; ?>
                            <!--/row-->
                    </form>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produto</th>
                                            <th>Qtidade</th>
                                            <th>Valor</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listaDespesas">

                                        <?php if($qtDespesas > 0): ?>
                                            <?php $__currentLoopData = $listaComandas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr id="tr_item_<?php echo e($item->comanda_item_id); ?>">
                                                    <td><?php echo e($item->comanda_item_id); ?></td>
                                                    <td><?php echo e($item->produto); ?></td>
                                                    <td><?php echo e($item->quantidade); ?></td>                     
                                                    <td>R$ <?php echo e($item->valor); ?></td>
                                                    <td>
                                                        <?php if($checkedRecebimentoTiposCombo == 'A'): ?>
                                                        <a href="javascript:void(0);" onclick="excluirRegistroItem(<?php echo e($item->comanda_item_id); ?>);"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - <?php echo e($item->comanda_item_id); ?>"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" style="text-align: center">Nenhuma item localizado.</td>
                                            </tr>
                                        <?php endif; ?>
                                        

                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="total_despesas">R$ <?php echo e($total_despesas); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>



                                </div>  
                            </div>
                    <form action="javascript:void(0);" name="formComanda" id="formComanda" method="post" enctype="multipart/form-data" > 
                         <?php echo e(csrf_field()); ?>

                            <!--/row-->
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        
                                        <?php echo e(Form::select('comanda_status', $comandaStatusCombo, $checkedComandaStatusCombo, ['placeholder' => 'Selecione...', 'class' => 'form-control clearItem showCardapio', 'id' => 'comanda_status', 'required' => 'required', 'tabindex' => '6', 'data-plugin-selectTwo' => 'data-plugin-selectTwo'])); ?>

                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Recebimento</label>
                                        
                                        <?php echo e(Form::select('recebimento_tipo_id', $recebimentoTiposCombo, $checkedRecebimentoTiposCombo, ['placeholder' => 'Selecione...', 'class' => 'form-control clearItem showCardapio', 'id' => 'recebimento_tipo_id', 'required' => 'required', 'tabindex' => '7', 'data-plugin-selectTwo' => 'data-plugin-selectTwo'])); ?>

                                    
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
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-3">
                                    <div class="form-group btn-final">
                                        <label class="control-label">Total</label>
                                        <input type="text" id="valor_total_final" name="valor_total_final" class="form-control " placeholder="" value="<?php echo e($total_despesas); ?>" tabindex="8" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group btn-final">
                                        <label class="control-label">Valor Recebido</label>
                                        <input type="text" id="valor_recebido" name="valor_recebido" class="form-control money" placeholder="" tabindex="9" value="<?php echo e($valor_recebido); ?>" required  disabled="<?php echo e($troco_disabled); ?>">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group btn-final">
                                        <label class="control-label">Troco</label>
                                        <input type="text" id="troco" name="troco" class="form-control " placeholder="" value="<?php echo e($troco); ?>" tabindex="10" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            
                        </div>

                        <div class="form-actions text-right"> 
                            <input type="hidden" id="idRecord" name="idRecord" value="<?php echo e($comanda_id); ?>">
                            <input type="hidden" id="status_bt" name="status_bt" value="">
                            <!--<button type="button" class="btn btn-default">Cancelar</button>-->
                            <button type="submit" class="btn btn-success btn-final-troco" tabindex="11"> <i class="fa fa-save"></i> Fechar Comanda</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(url('/assets_admin/js/script-comanda.js')); ?>"></script>

   


<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bayarea\resources\views/admin/comanda/create-edit.blade.php ENDPATH**/ ?>