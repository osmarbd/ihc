<?php
Class TipoUsuariosModel {

    public function showList() {

        $obj = (new TipoUsuariosDAO)->loadAll("nome"," WHERE deleted_at is NULL");

        // CALCULA O NUMERO DE ELEMENTOS DO ARRAY
        $end = count($obj);
        echo "<table id='tabela1' class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>Criado em</th>";
        echo "<th>Alterado em</th>";
        echo "<th data-orderable='false'>";
        echo "<a href=instipousuarios.php><span class='glyphicon glyphicon-plus fa-lg' title='Inserir' alt='Inserir'></span></a></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for ($i = 1; $i <= $end; $i++) {

            $objstr = new UtilString();

            $nome = $obj[$i]->get_nome();

            $dt_create = $obj[$i]->get_created_at();
            if($dt_create != null) {
                $dt_create = date_format(new DateTime($dt_create), 'd/m/Y H:i');
            }
            $dt_update = $obj[$i]->get_updated_at();
            if($dt_update != null){
                $dt_update = date_format(new DateTime($dt_update), 'd/m/Y H:i');
            }
            $stt = $obj[$i]->get_stt();


            echo "<tr>";
            echo "<td>".$nome."</td>";
            echo "<td>".$dt_create."</td>";
            echo "<td>".$dt_update."</td>";
            echo "<td>";
            echo "<a href=alttipousuarios.php?cod=".$obj[$i]->get_id().">";
            echo "<span class='glyphicon glyphicon-edit fa-lg' title='Alterar' alt='Alterar'></span></a>&nbsp;";
            echo "<a href=exctipousuarios.php?cod=".$obj[$i]->get_id().">";
            echo "<span class='glyphicon glyphicon-remove fa-lg' title='Excluir' alt='Excluir'></span></a>&nbsp;";
            if ($stt == "0") {
                echo "<a href=altstttipousuarios.php?cod=".$obj[$i]->get_id()."&stt=1>";
                echo "<span class='glyphicon glyphicon-ok-circle fa-lg' title='Ativar' alt='Ativar'></span></a>";
            } else {
                echo "<a href=altstttipousuarios.php?cod=".$obj[$i]->get_id()."&stt=0>";
                echo "<span class='glyphicon glyphicon-remove-circle fa-lg' title='Desativar' alt='Desativar'></span></a>";
            }
            echo "</td>";
            echo "</tr>";

        }
        echo "</tbody>";
        echo "<tfoot>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>Criado em</th>";
        echo "<th>Alterado em</th>";
        echo "<th><a href=lixtipousuarios.php><span class='glyphicon glyphicon-trash fa-lg' title='Lixeira' alt='Lixeira'></span></a></th>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table>";
        return null;
    }

    public function showListLixeira() {

        $obj = (new TipoUsuariosDAO)->loadAll("nome"," WHERE deleted_at is not NULL");



        // CALCULA O NUMERO DE ELEMENTOS DO ARRAY
        $end = count($obj);
        echo "<table id='tabela1' class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>Criado em</th>";
        echo "<th>Alterado em</th>";
        echo "<th>Deletado em</th>";
        echo "<th data-orderable='false'>";
        echo "&nbsp;</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for ($i = 1; $i <= $end; $i++) {

            $objstr = new UtilString();

            $nome = $obj[$i]->get_nome();

            $dt_create = $obj[$i]->get_created_at();
            if($dt_create != null) {
                $dt_create = date_format(new DateTime($dt_create), 'd/m/Y H:i');
            }
            $dt_update = $obj[$i]->get_updated_at();
            if($dt_update != null){
                $dt_update = date_format(new DateTime($dt_update), 'd/m/Y H:i');
            }

            $dt_deleted = $obj[$i]->get_deleted_at();
            if($dt_deleted != null){
                $dt_deleted = date_format(new DateTime($dt_deleted), 'd/m/Y H:i');
            }
            $stt = $obj[$i]->get_stt();


            echo "<tr>";
            echo "<td>".$nome."</td>";
            echo "<td>".$dt_create."</td>";
            echo "<td>".$dt_update."</td>";
            echo "<td>".$dt_deleted."</td>";
            echo "<td>";
            echo "<a href=restipousuarios.php?cod=".$obj[$i]->get_id().">";
            echo "<span class='glyphicon glyphicon-plus-sign fa-lg' title='Restaurar' alt='Restaurar'></span></a>";
            echo "</td>";
            echo "</tr>";

        }
        echo "</tbody>";
        echo "<tfoot>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>Criado em</th>";
        echo "<th>Alterado em</th>";
        echo "<th>Deletado em</th>";
        echo "<th>&nbsp;</th>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table>";
        return null;
    }

    public static function combo($param, $css = null, $where = null, $name = null, $id = null) {

        $obj = (new TipoUsuariosDAO)->loadAll("nome", " WHERE stt = 1 AND deleted_at is NULL");

        // CALCULA O NÚMERO DE ELEMENTOS DO ARRAY

        $end = count($obj);

        echo "<select name=";

        if ($name != "") {
            echo $name;
        } else {
            echo '"tipo_usuarios"';
        }

        if ($id != "") {
            echo " id=".$id;
        } else {
            echo ' id = "tipo_usuarios"';
        }

        if ($css != "") {
            echo " class='".$css."'";
        }
        echo ">";


        echo "<option value=''>Selecione um tipo de usu&aacute;rio</option>";
        for ($i = 1; $i <= $end; $i++) {
            $a_descricao = $obj[$i]->get_nome();
            $a_nome = $obj[$i]->get_nome();
            echo "<option value='".$a_nome."'";
            if ($param == $a_nome) {
                echo " selected";

            }
            echo ">".$a_descricao."</option>";
        }
        echo "</select>";

    }

    public function insert($param) {
        return (new TipoUsuariosDAO)->insert($param);
    }

    public function load($param) {
        $obj = (new TipoUsuariosDAO)->load($param);
        return $obj;
    }

    public function update($param) {
        return (new TipoUsuariosDAO)->update($param);
    }

    public function updateStt($param) {
        return (new TipoUsuariosDAO)->updateStt($param);
    }

    public function delete($param) {
        return (new TipoUsuariosDAO)->delete($param);
    }

    public function softDelete($param) {
        return (new TipoUsuariosDAO)->softDelete($param);
    }

    public function softRestore($param) {
        return (new TipoUsuariosDAO)->softRestore($param);
    }


}
?>


