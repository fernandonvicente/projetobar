<!DOCTYPE html>
<html lang="en">

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
    <!-- Menu CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')); ?>" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/chartist-js/dist/chartist.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')); ?>" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.css')); ?>" rel="stylesheet" />
    <!-- toast CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/toast-master/css/jquery.toast.css')); ?>" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/css/animate.css')); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/css/style.css')); ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo e(url('/assets_plugin_admin/css/colors/blue-dark.css')); ?>" id="theme" rel="stylesheet">

    <link href="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/bootstrap-table/dist/bootstrap-table.min.css')); ?>" rel="stylesheet" type="text/css" />
    <?php echo $__env->yieldPushContent('css'); ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
             <?php echo $__env->make('admin.layout.navbar-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
           <?php echo $__env->make('admin.layout.navbar-default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content-header'); ?>
                
                <!-- ============================================================== -->
                <?php echo $__env->yieldContent('content'); ?>
                <!-- ============================================================== -->
                
                
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li class="full-width"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="gray-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme working">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme">12</a></li>
                            </ul>
                            <ul class="m-t-20 all-demos">
                                <li><b>Choose other demos</b></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/users/varun.jpg')); ?>" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/users/genu.jpg')); ?>" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/users/ritesh.jpg')); ?>" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/users/arijit.jpg')); ?>" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/users/govinda.jpg')); ?>" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/users/hritik.jpg')); ?>" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/users/john.jpg')); ?>" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo e(url('/assets_plugin_admin/plugins/images/users/pawandeep.jpg')); ?>" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ampleadmin brought to you by themedesigner.in </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
   
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')); ?>"></script>
    <!--Counter js -->
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/waypoints/lib/jquery.waypoints.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/counterup/jquery.counterup.min.js')); ?>"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/jquery.slimscroll.js')); ?>"></script>
    <!--Wave Effects -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/waves.js')); ?>"></script>
    <!-- Vector map JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.min.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/vectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/vectormap/jquery-jvectormap-in-mill.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/vectormap/jquery-jvectormap-us-aea-en.js')); ?>"></script>
    <!-- chartist chart -->
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/chartist-js/dist/chartist.min.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')); ?>"></script>
    <!-- sparkline chart JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js')); ?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/custom.min.js')); ?>"></script>
    <!-- <script src="<?php echo e(url('/assets_plugin_admin/js/dashboard3.js')); ?>"></script>-->
    <!--Style Switcher -->
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')); ?>"></script>


    <!--notification slimscroll JavaScript -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/jquery.slimscroll.js')); ?>"></script>
    <!--Wave Effects -->
    <script src="<?php echo e(url('/assets_plugin_admin/js/waves.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/toast-master/js/jquery.toast.js')); ?>"></script>
    <script src="<?php echo e(url('/assets_plugin_admin/js/toastr.js')); ?>"></script>
    <!--notification -------------------------- -->

    <!--table -->
        <script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/bootstrap-table/dist/bootstrap-table.min.js')); ?>"></script>
        <!--<script src="<?php echo e(url('/assets_plugin_admin/plugins/bower_components/bootstrap-table/dist/bootstrap-table.ints.js')); ?>"></script>-->
    <!--table --------------------------------- -->
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <input type="hidden" name="urlJs" id="urlJs" value="<?php echo e(url('')); ?>">


</body>

</html>
<?php /**PATH C:\xampp\htdocs\laravelseterenan\resources\views/admin/layout/template2.blade.php ENDPATH**/ ?>