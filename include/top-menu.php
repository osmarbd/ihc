<?php
    $obj1 = new AdminVO();
    $obj1->set_id($_SESSION['id_usuario']);
    $c = new Controller("admin","load", $obj1);
?>
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../img/avatar/<?php echo $c->obj->fields['imagem']; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $c->obj->fields['nome']; ?></span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    <img src="../img/avatar/<?php echo $c->obj->fields['imagem']; ?>" class="img-circle" alt="User Image">

                    <p>
                        <?php echo $c->obj->fields['nome']; ?> - <?php echo $c->obj->fields['tipo']; ?>
                        <small>Membro desde <?php echo $c->obj->fields['created_at']; ?></small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="adminalt2.php?cod=<?php echo $_SESSION['id_usuario'];?>" class="btn btn-default btn-flat">Seu Perfil</a>
                    </div>
                    <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sair</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>