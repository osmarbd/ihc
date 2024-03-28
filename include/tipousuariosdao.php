<?php
Class TipoUsuariosDAO {

    public function loadAll($order, $where = null) {
        $i = 1;
        global $objdb;
        $flag = 0;
        $fields = "";
        $tipoArr = null;
        $tipo = new TipoUsuariosVO();

        foreach(array_keys($tipo->fields) as $field){
            if ($flag == 0) {
                $fields .= $field;
                $flag = 1;
            } else {
                $fields .= ", ".$field;
            }
        }

        $query = "SELECT ".$fields." FROM ".$tipo->table;
        if ($where != "") {
            $query .= $where;
        }
        $query .= " ORDER BY ".$order;
        //print_r($query);
        $objdb->set_sql($query);
        $objdb->dbQuery();

        if ($objdb->numRows > 0) {
            for ($j = 0; $j < $objdb->numRows; $j++) {
                $tipo_aux = new TipoUsuariosVO();
                $array = $objdb->fetchArray();
                foreach(array_keys($tipo->fields) as $field){
                    $str = "set_".$field;
                    $tipo_aux->$str($array[$field]);
                }
                $tipoArr[$i] = $tipo_aux;
                $i++;
            }
        }

        return $tipoArr;
    }

    public function insert($param) {
        global $objdb;
        $flag = 0;
        $fields = "";
        $module = $param;

        $values = array();
        foreach(array_keys($module->fields) as $field){
            if (($field != $module->pkfield) && ($field != 'updated_at') && ($field != 'deleted_at')) {
                if ($flag == 0) {
                    $fields .= $field;
                    $flag = 1;
                } else {
                    $fields .= ", ".$field;
                }
                $values[] = $objdb->convertField($module->datatype[$field], $module->fields[$field]);
            }
        }
        $inspt = join( ", ", $values);

        $query = "INSERT INTO ".$module->table." ($fields) VALUES ($inspt);";
        //print_r($query);

        $objdb->set_sql($query);
        $result = $objdb->dbQuery();
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function load($param) {
        global $objdb;
        $flag = 0;
        $fields = "";
        $module = $param;

        foreach(array_keys($module->fields) as $field){
            if ($flag == 0) {
                $fields .= $field;
                $flag = 1;
            } else {
                $fields .= ", ".$field;
            }
        }
        $query = "SELECT ".$fields." FROM ".$module->table." WHERE ".$module->pkfield." = ".$module->get_id();

        //print_r($query);

        $objdb->set_sql($query);
        $objdb->dbQuery();
        if ($objdb->numRows > 0) {
            $array = $objdb->fetchArray();
            foreach(array_keys($module->fields) as $field){
                $str = "set_".$field;
                $module->$str($array[$field]);
            }
        }
        return $module;
    }

    public function update($param) {
        global $objdb;
        $module = $param;
        $key = (string) $module->pkfield;

        $sets = array();
        $values = array();
        foreach(array_keys($module->fields) as $field) {
            if (($field != $key) && ($field != "stt") && ($field != "created_at") && ($field != "deleted_at")) {
                $sets []= $field." = ".$objdb->convertField($module->datatype[$field], $module->fields[$field]);
            }
        }
        $set = join( ", ", $sets);

        $query = "UPDATE ".$module->table." SET ".$set." WHERE ".$module->pkfield."=".$module->fields[$key].";";

        //print_r($query);
        //exit();
        $objdb->set_sql($query);
        $result = $objdb->dbQuery();
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function softDelete($param) {
        global $objdb;
        $module = $param;
        $key = (string) $module->pkfield;

        $sets = array();
        $values = array();
        foreach(array_keys($module->fields) as $field) {
            if (($field != $key) && ($field != "stt") && ($field != "created_at") && ($field != "updated_at")) {
                $sets []= $field." = ".$objdb->convertField($module->datatype[$field], $module->fields[$field]);
            }
        }
        $set = join( ", ", $sets);

        $query = "UPDATE ".$module->table." SET ".$set." WHERE ".$module->pkfield."=".$module->fields[$key].";";

        //print_r($query);
        //exit();
        $objdb->set_sql($query);
        $result = $objdb->dbQuery();
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function softRestore($param) {
        global $objdb;
        $module = $param;
        $key = (string) $module->pkfield;

        $sets = array();
        $values = array();
        foreach(array_keys($module->fields) as $field) {
            if (($field != $key) && ($field != "nome") && ($field != "stt") && ($field != "created_at")) {
                $sets []= $field." = ".$objdb->convertField($module->datatype[$field], $module->fields[$field]);
            }
        }
        $set = join( ", ", $sets);

        $query = "UPDATE ".$module->table." SET ".$set." WHERE ".$module->pkfield."=".$module->fields[$key].";";

        //print_r($query);
        //exit();
        $objdb->set_sql($query);
        $result = $objdb->dbQuery();
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function delete($param) {
        global $objdb;
        $module = $param;

        $query = "DELETE FROM ".$module->table." WHERE ".$module->pkfield." = ".$module->get_id_admin();
        $objdb->set_sql($query);
        $result = $objdb->dbQuery();
        $objdb->dbDisconnect();
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function updateStt($param) {
        global $objdb;
        $module = $param;
        $key = (string) $module->pkfield;

        $sets = array();
        $values = array();
        foreach(array_keys($module->fields) as $field) {
            if ($field == "stt") {
                $sets []= $field." = ".$objdb->convertField($module->datatype[$field], $module->fields[$field]);
            }
        }
        $set = join( ", ", $sets);

        $query = "UPDATE ".$module->table." SET ".$set." WHERE ".$module->pkfield."=".$module->fields[$key].";";

        //print_r($query);
        //exit();
        $objdb->set_sql($query);
        $result = $objdb->dbQuery();
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }
}
?>


