<?php
function sys_autoload($class_name) {
	require_once strtolower($class_name). '.php';
    date_default_timezone_set('America/Sao_Paulo');
};

spl_autoload_register('sys_autoload');

Class Controller 
{
	var $obj;

    function __construct($class = null, $action = null, $param = null, $css = null, $where = null, $name = null, $limit = null) {

        return $this->MainController($class, $action, $param, $css, $where, $name, $limit);

    }

    function MainController($class = null, $action = null, $param = null, $css = null, $where = null, $name = null, $limit = null) {
		switch ($class) {
            case "admin":
                switch ($action) {
                    case "login":
                        $this->obj = (new AdminModel)->login($param);
                        break;
                    case "list":
                        $this->obj = (new AdminModel)->showList();
                        break;
                    case "verifyLogin":
                        $this->obj = (new AdminModel)->verifyLogin($param);
                        break;
                    case "insert":
                        return (new AdminModel)->insert($param);
                        break;
                    case "load":
                        $this->obj = (new AdminModel)->load($param);
                        break;
                    case "update":
                        $this->obj = (new AdminModel)->update($param);
                        break;
                    case "updatePwd":
                        $this->obj = (new AdminModel)->updatePwd($param);
                        break;
                    case "delete":
                        return (new AdminModel)->delete($param);
                        break;
                    case "updateStt":
                        $this->obj = (new AdminModel)->updateStt($param);
                        break;
                    case "combo":
                        $this->obj = (new AdminModel())->combo($param, $css, $where, $name);
                        break;
                    case "updateImage":
                        $this->obj = (new AdminModel)->updateImage($param);
                        break;
                };
                break;


            case "tipo_usuarios":
                switch ($action) {
                    case "combo":
                        $this->obj = (new TipoUsuariosModel())->combo($param, $css, $where, $name);
                        break;
                    case "list":
                        $this->obj = (new TipoUsuariosModel)->showList();
                        break;
                    case "listLix":
                        $this->obj = (new TipoUsuariosModel())->showListLixeira();
                        break;
                    case "insert":
                        return (new TipoUsuariosModel)->insert($param);
                        break;
                    case "load":
                        $this->obj = (new TipoUsuariosModel)->load($param);
                        break;
                    case "update":
                        $this->obj = (new TipoUsuariosModel)->update($param);
                        break;
                    case "updateStt":
                        $this->obj = (new TipoUsuariosModel)->updateStt($param);
                        break;
                    case "softDelete":
                        $this->obj = (new TipoUsuariosModel)->softDelete($param);
                        break;
                    case "softRestore":
                        $this->obj = (new TipoUsuariosModel)->softRestore($param);
                        break;
                };
                break;

                case "clientes":
                    switch ($action) {
                        case "login":
                            $this->obj = (new ClientesModel)->login($param);
                            break;
                        case "list":
                            $this->obj = (new ClientesModel)->showList();
                            break;
                        case "verifyLogin":
                            $this->obj = (new ClientesModel)->verifyLogin($param);
                            break;
                        case "insert":
                            return (new ClientesModel)->insert($param);
                            break;
                        case "load":
                            $this->obj = (new ClientesModel)->load($param);
                            break;
                        case "update":
                            $this->obj = (new ClientesModel)->update($param);
                            break;
                        case "updatePwd":
                            $this->obj = (new ClientesModel)->updatePwd($param);
                            break;
                        case "delete":
                            return (new ClientesModel)->delete($param);
                            break;
                        case "updateStt":
                            $this->obj = (new ClientesModel)->updateStt($param);
                            break;
                        case "combo":
                            $this->obj = (new ClientesModel())->combo($param, $css, $where, $name);
                            break;
                        case "updateImage":
                            $this->obj = (new ClientesModel)->updateImage($param);
                            break;
                    };
                    break;

                    case "telefones":
                        switch ($action) {
                            case "login":
                                //$this->obj = (new ClientesModel)->login($param);
                                break;
                            case "list":
                                $this->obj = (new TelefonesModel)->showList();
                                break;
                            case "verifyLogin":
                                //$this->obj = (new ClientesModel)->verifyLogin($param);
                                break;
                            case "insert":
                                return (new TelefonesModel)->insert($param);
                                break;
                            case "load":
                                //$this->obj = (new ClientesModel)->load($param);
                                break;
                            case "update":
                                //$this->obj = (new ClientesModel)->update($param);
                                break;
                            case "updatePwd":
                                //$this->obj = (new ClientesModel)->updatePwd($param);
                                break;
                            case "delete":
                                //return (new ClientesModel)->delete($param);
                                break;
                            case "updateStt":
                                //$this->obj = (new ClientesModel)->updateStt($param);
                                break;
                            case "combo":
                                //$this->obj = (new ClientesModel())->combo($param, $css, $where, $name);
                                break;
                            case "updateImage":
                                //$this->obj = (new ClientesModel)->updateImage($param);
                                break;
                        };
                        break;
		}
   	}

}



    $conn = array();
    $conn = (new Config())->dataConect();

	$objdb = new DB($conn['database'], $conn['host'], $conn['dbuser'], $conn['dbpassword'], $conn['dbport']);

	if (!$objdb->dbConnect()) echo "Problemas de conex&ccedil;&atilde;o com o banco de dados";
	// PATH PARA DOWNLOAD DE ARQUIVOS
	$path="download/";
	$title_adm="..::: Empresa :::..";
	$title="Empresa";
?>
