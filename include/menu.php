<?php
$obj1 = new AdminVO();
$obj1->set_id($_SESSION['id_usuario']);
$c = new Controller("admin","load", $obj1);
if(!isset($submodule)){
    $submodule = '';
}
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../img/avatar/<?php echo $c->obj->fields['imagem']; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $c->obj->fields['nome']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><MENU></MENU></li>
            <?php if (($_SESSION['tp_usuario'] == "ADMIN") || ($_SESSION['tp_usuario'] == "GERENTE")) {?>
            <li class="treeview <?php if (($module == "tipo_usuarios")||($module == "usuarios")) {?>active<?php } ?>">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Administra&ccedil;&atilde;o</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li <?php if ($module == "tipo_usuarios") {?>class="active"<?php } ?>><a href="tipousuarios.php"><i class="fa fa-circle-o"></i> Tipo Usu&aacute;rios</a></li>
                    <li <?php if ($module == "usuarios") {?>class="active"<?php } ?>><a href="admin.php"><i class="fa fa-circle-o"></i> Usu&aacute;rios</a></li>
                </ul>
            </li>
            <li class="treeview <?php if (($module == "clientes")||($module == "clientes")) {?>active<?php } ?>">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Clientes</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li <?php if ($module == "clientes") {?>class="active"<?php } ?>><a href="clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                </ul>
            </li>
            <?php } ?>
            <li class="treeview <?php echo $module == "relatorios" ? 'active' : '' ?>">
                <a href="#"><i class="fa fa-user"></i> <span>Relatórios</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li <?php echo $module == "relatorios" ? 'class="active"' : '' ?>><a href="dashboard_teste.php"><i class="fa fa-circle-o"></i> Visão Geral</a></li>
                    <!--<li <?php echo $module == "relatorios" ? 'class="active"' : '' ?>><a href="#"><i class="fa fa-circle-o"></i> Manutenções</a></li>
                    <li <?php echo $module == "relatorios" ? 'class="active"' : '' ?>><a href="#"><i class="fa fa-circle-o"></i> Endereços</a></li>-->
                </ul>
            </li>
            <?php if ($_SESSION['tp_usuario'] == "ADMIN") {?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-share"></i> <span>Multilevel</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> Bla
                                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Bla 1</a></li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Bla 2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php } ?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>