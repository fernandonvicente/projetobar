<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(url('/assets_plugin_admin/plugins/images/favicon.png')); ?>">
    <title>Ample Admin Template - The Ultimate Multipurpose admin template</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/css/animate.css')); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/css/style.css')); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box login-sidebar bg-theme-dark">
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginClienteForm" name="loginClienteForm" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    <?php echo e(csrf_field()); ?>

                    <a href="javascript:void(0)" class="text-center db"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/admin-logo.png')); ?>" alt="Home" />
                        <br/><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/admin-text.png')); ?>" alt="Home" /></a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control maskTel" type="text" required="" name="login_telefone" id="login_telefone" placeholder="(00) 90000-0000">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" name="login_senha" id="login_senha" placeholder="******">
                        </div>
                    </div>
                    <div class="form-group">
                        <!--
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Esqueceu a senha?</a> 
                        </div>
                        -->
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <input type="hidden" name="status_bt_cliente" id="status_bt_cliente">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light btn-success-cliente" type="submit">Login</button>
                        </div>
                    </div>
                    <!--
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                            <div class="social">
                                <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                            </div>
                        </div>
                    </div>
                    -->
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Não tem conta? <a href="<?php echo e(url('/cliente/cadastro')); ?>" class="text-primary m-l-5"><b>Inscrever-se</b></a></p>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- Menu Plugin JavaScript -->
     <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')); ?>"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/jquery.slimscroll.js')); ?>"></script>
    <!--Wave Effects -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/waves.js')); ?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/custom.min.js')); ?>"></script>

    <!--notification slimscroll JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/jquery.slimscroll.js')); ?>"></script>
    <!--Wave Effects -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/waves.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/toast-master/js/jquery.toast.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/js/toastr.js')); ?>"></script>
    <!--notification -------------------------- -->

    <!--Style Switcher -->
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')); ?>"></script>

    <script src="<?php echo e(url('/assets/js_cliente/script-cliente.js')); ?>"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>


    <input type="hidden" name="urlJs" id="urlJs" value="<?php echo e(url('')); ?>">
</body>

</html>
<?php /**PATH C:\xampp\htdocs\bayarea\resources\views/cliente-comanda/index.blade.php ENDPATH**/ ?>