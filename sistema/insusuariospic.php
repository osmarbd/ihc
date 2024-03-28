<?php ob_start();?>
<?php

    session_start();

    require_once("../include/controller.php");
    $empresa = (new Empresa())->dataEmpresa();

	if (!($_SESSION['conexao_session']))

	{

		header("Location: login.php");

		exit;

	}

	$module = "usuarios";

    $a_erro = "";

    //FORMULARIO SUBMETIDO


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title_adm;?></title>
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $empresa['favicon'] ?>">
    <link rel="icon" type="image/png" href="<?php echo $empresa['favicon'] ?>">
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
                Usuario
                <small>Inserir Foto</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="altusuario.php">Usuario</a></li>
                <li class="active">Inserir Foto</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tire a foto proxima ao rosto do cliente:</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form id="mainForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="guarda" value="tomo1">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="tagNome">Exibição:</label>

                            <div class="col-sm-5" id="my_camera">

                            </div>

                            <div class="col-sm-5" id="results">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="tagNome"></label>
                            <div class="col-sm-5">
                                <input type=button value="Tire a foto" class="btn btn-primary btn-flat margin" onClick="take_snapshot()">
                            </div>
                            <div class="col-sm-5" id="save_img">

                            </div>


                        </div>
                    </div>
                    <!-- /.box-body -->

                        <div class="box-footer">

                        </div>
                </form>
            </div>
            <!-- /.box -->

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
<script src="../js/jquery.mask.min.js"></script>

<script type="text/javascript" src="../js/webcam.min.js"></script>

<!-- Configure a few settings and attach camera -->
<script>
    Webcam.set({
        width: 320,
        height: 240,
        crop_width: 128,
        crop_height: 128,
        image_format: 'jpg',
        jpeg_quality: 90
    });


    Webcam.attach( '#my_camera' );

    function take_snapshot() {
        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML =
                '<img id="imageprev" src="'+data_uri+'"/>';
            document.getElementById('save_img').innerHTML =
                '<input type=button value="Salvar a imagem" class="btn btn-primary btn-flat margin" onClick="saveSnap()">';
        });
    }

    function saveSnap(){
        // Get base64 value from <img id='imageprev'> source
        var base64image = document.getElementById("imageprev").src;

        Webcam.upload( base64image, 'uploadusuario.php', function(code, text) {
            location.href="altadmin2.php?cod="+<?php echo $_SESSION['id_usuario']; ?>
            //console.log('Save successfully');
            //console.log(text);
        });
    }
</script>

<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree();

    });

    $(document).on("click", "#submit", function () {
        $("#mainForm").valid();
    });

</script>

</body>
</html>
<?php ob_end_flush();?>