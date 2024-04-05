<?php ob_start();?>

<?php
session_start();
require_once("../include/controller.php");
$empresa = (new Empresa())->dataEmpresa();

//print_r($_SESSION);

if (!($_SESSION['conexao_session'])){
    header("Location: login.php");
    exit;
}

/*
if($_SESSION['tp_usuario'] != 'ADMIN'){
    header("Location: home.php");
}
*/
$module = "clientes";
$a_erro = "";
$error = 0;
//FORMULARIO SUBMETIDO

    $a_cod = $_GET['cod'];
    $obj1 = new ClientesVO();
    $obj1->set_id($a_cod);
    $c = new Controller("clientes", "load", $obj1);
    $a_nome = $c->obj->get_nome();
    $a_email = $c->obj->get_email();
    $a_stt = $c->obj->get_stt();
 

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title_adm;?></title>
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $empresa['favicon']; ?>">
        <link rel="icon" type="image/png" href="<?php echo $empresa['favicon']; ?>">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../css/AdminLTE.min.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../css/skins/_all-skins.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b><?php echo $empresa['apelido']; ?></b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b><?php echo $empresa['empresa']." ".$empresa['cidade']; ?></b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <!-- Menu do Topo -->
                <?php require_once("../include/top-menu.php"); ?>
            </nav>
        </header>
        <!-- =============================================== -->
        <!-- Left side column. contains the sidebar -->
        <?php require_once("../include/menu.php"); ?>
        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <!-- Content Header (Page header) -->

            <section class="content-header">
                <h1>
                    Usu&aacute;rios
                    <small>Mostrar</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Administra&ccedil;&atilde;o</a></li>
                    <li><a href="admin.php">Usu&aacute;rios</a></li>
                    <li class="active">Mostrar</li>
                </ol>
            </section>
            <!-- Main content -->

            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Preencha o formulário abaixo:</h3>
                            </div>
                            <div class="box-body">
                                corpo
                            </div>
                            <div class="box-footer">
                                rodape
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Preencha o formulário abaixo:</h3>
                            </div>
                            <div class="box-body">
                                corpo
                            </div>
                            <div class="box-footer">
                                rodape
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-6">
                        <!-- Default box -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Preencha o formulário abaixo:</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form id="mainForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form-horizontal">
                                <input type="hidden" name="guarda" value="tomo1">
                                <input type="hidden" name="cod" value="<?php echo $a_cod?>">                
                                <div class="box-body">
                                    <?php if($error==1){ ?>
                                        <label class="col-sm-2 control-label" for="tagNome">&nbsp;</label>
                                        <div class="col-sm-10 alert alert-warning alert-dismissible">
                                            <h4><i class="icon fa fa-warning"></i> Alert!</h4><?php echo $a_nome ?> já existe!.
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="tagNome">Nome</label>
                                        <div class="col-sm-10">
                                            <?php echo $a_nome;?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="tagNome">E-mail</label>
                                        <div class="col-sm-10">
                                            <?php echo $a_email;?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="col-sm-2">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-10">                                
                                        <button type="button" class="btn btn-warning btn-flat margin" onClick="javascript:window.location='clientes.php';">Voltar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Preencha o formulário abaixo:</h3>
                            </div>
                            <div class="box-body">
                                corpo
                            </div>
                            <div class="box-footer">
                                rodape
                            </div>
                        </div>    
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <!-- FOOTER -->

        <?php require_once("../include/footer.php");?>





    </div>

    <!-- ./wrapper -->



    <!-- jQuery 3 -->

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->

    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- SlimScroll -->

    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <!-- FastClick -->

    <script src="../bower_components/fastclick/lib/fastclick.js"></script>

    <!-- AdminLTE App -->

    <script src="../js/adminlte.min.js"></script>

    <!-- AdminLTE for demo purposes -->

    <script src="../js/demo.js"></script>

    <!-- jQuery Validate -->

    <script src="../bower_components/jquery-validate/dist/jquery.validate.min.js"></script>

    <!-- jQuery Mask -->

    <script src="../js/jquery.mask.min.js"></script>

    <script>

        $(document).ready(function () {

            $('.sidebar-menu').tree();

            $( "#mainForm" ).validate( {

                rules: {

                    nome: {

                        required: true

                    },

                    email: {

                        required: true,

                        email: true

                    },


                },

                messages: {

                    nome: {

                        required: "Por favor, inform o nome do usu&aacute;rio"

                    },

                    email: {

                        required: "Por favor, informe um e-mail",

                        email: "Por favor, informe um e-mail válido"

                    },

                   

                    

                    

                },

                errorElement: "em",

                errorPlacement: function ( error, element ) {

                    // Add the `help-block` class to the error element

                    error.addClass( "help-block" );



                    if ( element.prop( "type" ) === "checkbox" ) {

                        error.insertAfter( element.parent( "label" ) );

                    } else {

                        error.insertAfter( element );

                    }

                },

                highlight: function ( element, errorClass, validClass ) {

                    $( element ).parents( ".col-sm-10" ).addClass( "has-error" ).removeClass( "has-success" );

                },

                unhighlight: function (element, errorClass, validClass) {

                    $( element ).parents( ".col-sm-10" ).addClass( "has-success" ).removeClass( "has-error" );

                }

            });



            $('#barcode_produto').mask('000000000000000');



        });





        $(document).on("click", "#submit", function () {

            $("#mainForm").valid();

        });



    </script>

    </body>

    </html>

<?php ob_end_flush();?>