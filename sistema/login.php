<?php ob_start();?>
<?php

    session_start();

    require_once("../include/controller.php");

    $a_erro = "";

    $a_tipo_erro = 0;

	$_SESSION['pagorigem'] = "home.php";

	$_SESSION['conexao_session'] = false;

	$_SESSION['id_usuario'] = 0;

    if (isset($_POST['guarda'])) {

        $a_login = $_POST['usuario'];

        $a_senha = $_POST['senha'];

        $resposta = 0;

        if ($a_login == "") {

            $a_erro = "Usu&aacute;rio n&atilde;o preenchido";

            $a_tipo_erro = 1;

        } elseif ($a_senha == "") {

            $a_erro = "Senha n&atilde;o preenchida";

            $a_tipo_erro = 2;

        } else {

            $obj1 = new AdminVO();

            $obj1->set_login($a_login);

            $obj1->set_senha($a_senha);


            $c = new Controller("admin","login", $obj1);

            $resposta = $c->obj;

            print_r($resposta);

            if ($resposta == 0) {

                $_SESSION['conexao_session'] = True;

                header("Location: ".$_SESSION['pagorigem']);

                exit();

            } else {

                switch ($resposta) {

                    case 1:
                            $a_erro = "Usu&aacute;rio n&atilde;o cadastrado";
                            $a_tipo_erro = 1;
                            break;
                    case 2:
                            $a_erro = "Usu&aacute;rio desativado";
                            $a_tipo_erro = 1;
                            break;
                    case 3:
                            $a_erro = "Senha incorreta";
                            $a_tipo_erro = 2;
                            break;

                }

            }

        }

    } else {

        $a_login = "";

        $a_senha = "";

    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $empresa['favicon']; ?>">
    <link rel="icon" type="image/png" href="<?php echo $empresa['favicon']; ?>">
    <title><?php echo $title_adm;?></title>
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
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="../img/sistema/logos/logo_principal.png" width="260" height="200" border="0">
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Efetue seu login no sistema</p>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input type="hidden" name="guarda" value="tomo1">
            <?php if (($a_erro == "")||($a_tipo_erro == 2)) {?>
                <div class="form-group has-feedback">
            <?php } else {?>
                <div class="form-group has-error">
                <label class="control-label" for="usuario"><i class="fa fa-times-circle-o"></i> <?php echo $a_erro;?></label>
            <?php }?>
                <input name="usuario" id="usuario" type="text" class="form-control" placeholder="Usuário" value="<?php echo $a_login;?>" maxlength="15">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <?php if (($a_erro == "")||($a_tipo_erro == 1)) {?>
                <div class="form-group has-feedback">
            <?php } else {?>
                <div class="form-group has-error">
                <label class="control-label" for="senha"><i class="fa fa-times-circle-o"></i> <?php echo $a_erro;?></label>
            <?php }?>
                <input name="senha" id="senha" type="password" class="form-control" placeholder="Senha" value="<?php echo $a_senha;?>" maxlength="20">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    &nbsp;
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
<?php ob_end_flush();?>