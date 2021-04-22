            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Menu</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users" data-icon="v"></i> <span class="hide-menu"> Usuários <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo e(url('/bayareaadmin/user/create')); ?>"><i class="fa fa-plus-square" data-icon="v"></i> <span class="hide-menu">Cadastrar</span></a></li>
                            <li><a href="<?php echo e(url('/bayareaadmin/user/index')); ?>"><i class="fa fa-list" data-icon="v"></i> <span class="hide-menu">Lista</span></a></li>
                        </ul>
                    </li>
                   
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users" data-icon="v"></i> <span class="hide-menu"> Clientes <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo e(url('/bayareaadmin/cliente/create')); ?>"><i class="fa fa-plus-square" data-icon="v"></i> <span class="hide-menu">Cadastrar</span></a></li>
                            <li><a href="<?php echo e(url('/bayareaadmin/cliente/index')); ?>"><i class="fa fa-list" data-icon="v"></i> <span class="hide-menu">Lista</span></a></li>
                        </ul>
                    </li>
               
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart-outline fa-fw" data-icon="v"></i> <span class="hide-menu"> Comandas <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo e(url('/bayareaadmin/comanda/create')); ?>"><i class="fa fa-plus-square" data-icon="v"></i> <span class="hide-menu">Cadastrar</span></a></li>
                            <li><a href="<?php echo e(url('/bayareaadmin/comanda/index')); ?>"><i class="fa fa-list" data-icon="v"></i> <span class="hide-menu">Lista</span></a></li>
                        </ul>
                    </li>

                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-dollar" data-icon="v"></i> <span class="hide-menu"> Despesas <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo e(url('/bayareaadmin/despesa/create')); ?>"><i class="fa fa-plus-square" data-icon="v"></i> <span class="hide-menu">Cadastrar</span></a></li>
                            <li><a href="<?php echo e(url('/bayareaadmin/despesa/index')); ?>"><i class="fa fa-list" data-icon="v"></i> <span class="hide-menu">Lista</span></a></li>
                        </ul>
                    </li>

                </ul>
            </div><?php /**PATH C:\xampp\htdocs\bayarea\resources\views/admin/layout/navbar-default.blade.php ENDPATH**/ ?>