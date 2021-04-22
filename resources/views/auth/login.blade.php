<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/assets_plugin_admin/plugins/images/favicon.png') }}">
    <title>Bayarea - admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('/assets_plugin_admin/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ url('/assets_plugin_admin/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ url('/assets_plugin_admin/css/style.css') }}" rel="stylesheet">
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
    <section id="wrapper" class="new-login-register bg-theme-dark">
        <div class="lg-info-panel">
            <div class="inner-panel">
                <a href="javascript:void(0)" class="p-20 di"><img src="{{ url('/assets_plugin_admin/plugins/images/admin-logo.png') }}"></a>
                <div class="lg-content">
                    <h2></h2>
                    <p class="text-muted"></p>
                    <a href="#" class="btn btn-rounded btn-danger p-l-20 p-r-20"></a>
                </div>
            </div>
        </div>
        <div class="new-login-box">
            <div class="white-box">
                <h3 class="box-title m-b-0">FAÇA LOGIN NO ADMINISTRADOR</h3>
                <small>Insira seus dados abaixo</small>
                <form class="form-horizontal new-lg-form" id="loginform" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label>Email </label>
                            <input class="form-control" type="text" required="" placeholder="Username" name="email" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Password</label>
                            <input class="form-control" type="password" required="" placeholder="Password" name="password" id="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <!--
                            <div class="checkbox checkbox-info pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                            -->
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Escqueceu a senha?</a> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Entrar</button>
                        </div>
                    </div>
                    
                </form>
                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Digite seu e-mail e as instruções serão enviadas para você! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reenviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="{{ url('/assets_plugin_admin/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('/assets_plugin_admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{ url('/assets_plugin_admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{ url('/assets_plugin_admin/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ url('/assets_plugin_admin/js/waves.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ url('/assets_plugin_admin/js/custom.min.js') }}"></script>
    <!--Style Switcher -->
    <script src="{{ url('/assets_plugin_admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
</body>

</html>
