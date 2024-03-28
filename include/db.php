<?php
// -========================================================================================
// - DESCRICAO
// - Classe com metodos para o banco de dados PostgreSQL
// -========================================================================================	
class DB {
	// parametros para conexao
	private $dbName;
	private $dbHost;
	private $dbUsername;
	private $dbPassword;
	
	// armazena a consulta
	private $sql;

	// armazena o resultado das consultas
	public $result;
	public $numRows;

	// armazena o handle da conexao
	private $conn;
	private $persistent;
	
	// -========================================================================================
	// - DESCRICAO
	// - recebe a query a ser executada
	//
	// - PARAMETROS UTILIZADOS
	// - $sql - STRING DA QUERY
	// -========================================================================================	
	public function set_sql($sql)
	{
		$this->sql = $sql;	
	}
	
	// -========================================================================================
	// - DESCRICAO
	// - retorna a query a ser executada
	//
	// - PARAMETROS UTILIZADOS
	// - $sql - STRING DA QUERY
	// -========================================================================================	
	public function get_sql()
	{
		return $this->sql;	
	}

	// -========================================================================================
	// - DESCRICAO
	// - construtor da classe
	//
	// - PARAMETROS UTILIZADOS
	// - $name - NOME DA BASE DE DADOS
	// - $host - HOST DA BASE DE DADOS
	// - $username - NOME DO USUARIO DA BASE DE DADOS
	// - $password - SENHA DO USUARIO
	// -========================================================================================	
	public function __construct($name, $host, $username, $password, $port) {
		$this->dbName = $name;
		$this->dbHost = $host;
		$this->dbUsername = $username;
		$this->dbPassword = $password;
		$this->dbPort = $port;
		$this->result = false;
		$this->numRows = 0;
		$this->conn = NULL;
		$this->persistent = false;
	}
	
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que conecta ao banco de dados
	//
	// - PARAMETROS UTILIZADOS
	// - $persistent - TIPO DE CONEXAO
	// - [false] - NORMAL
	// - [true] - PERSISTENTE
	// -========================================================================================
	public function dbConnect($persistent = false) {

        $this->conn = mysqli_connect($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName, $this->dbPort);
        // CHARSET UTF-8
        mysqli_query($this->conn, "SET NAMES 'utf8'");
        mysqli_query($this->conn, 'SET character_set_connection=utf8');
        mysqli_query($this->conn, 'SET character_set_client=utf8');
        mysqli_query($this->conn, 'SET character_set_results=utf8');
        // CHARSET UTF-8
		if($this->conn) {
			return true;
		}

		return false;
	}

	// -========================================================================================
	// - DESCRICAO
	// - Funcao que consulta a base de dados e armazena o resultado no objeto
	//
	// - PARAMETROS UTILIZADOS
	// - $query - CONSULTA A SER ENVIADA AO SERVIDOR
	// -========================================================================================
	public function dbQuery() {

		$result = mysqli_query($this->conn, $this->sql);
		if (($result)||(mysqli_errno($this->conn) == 0)) {
			$this->result = $result;
			if (@mysqli_num_rows($this->result) > 0) {
				$this->numRows = mysqli_num_rows($this->result);
			} else {
				$this->numRows = 0;
			}
			return true;
		}

		return false;
	}

	// -========================================================================================
	// - DESCRICAO
	// - Funcao que retorna um array com os resultados da consulta
	// -========================================================================================
	public function fetchRow() {
		return mysqli_fetch_row($this->result);
	}

	// -========================================================================================
	// - DESCRICAO
	// - Funcao que retorna um array associativo com os resultados da consulta
	// -========================================================================================
	public function fetchArray() {
		return mysqli_fetch_array($this->result, MYSQLI_BOTH);
	}

	// -========================================================================================
	// - DESCRICAO
	// - Funcao que retorna um objeto com os resultados da consulta
	// -========================================================================================	
	public function fetchObject() {
		return mysqli_fetch_object($this->result);
	}

	// -========================================================================================
	// - DESCRICAO
	// - Funcao que retorna o numero de linhas afetadas pela ultima consulta
	// -========================================================================================	
	public function affectedRows() {
		return mysqli_affected_rows($this->conn);
	}

	// -========================================================================================
	// - DESCRICAO
	// - Funcao que limpa o ponteiro de resultados
	// -========================================================================================
	public function freeResult() {
		return mysqli_free_result($this->result);
	}

	// -========================================================================================
	// - DESCRICAO
	// - Funcao que fecha a conexao com o servidor
	// -========================================================================================
	public function dbDisconnect() {
		return mysqli_close($this->conn);
	}
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que apaga caracteres invalidos para a query de login
	//
	// - PARAMETROS UTILIZADOS
	// - $af_field - CAMPO A SER VALIDADO
	// -========================================================================================
	function verifySQLInjection($af_field)
	{
		$a_str = trim($af_field);
	
		$a_str = str_replace("", "select", $a_str);
		$a_str = str_replace("", "insert", $a_str);
		$a_str = str_replace("", "delete", $a_str);
		$a_str = str_replace("", "update", $a_str);
		$a_str = str_replace("", "drop", $a_str);
		$a_str = str_replace("", "exec", $a_str);
		$a_str = str_replace("", "xp_", $a_str);
		$a_str = str_replace("", "sp_", $a_str);
		$a_str = str_replace("", "--", $a_str);
		$a_str = str_replace("", ";", $a_str);
		$a_str = str_replace("", "'", $a_str);
		
		return($a_str);
	
	}
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que formata um campo a ser inserido em um banco de dados
	//
	// - PARAMETROS UTILIZADOS
	// - $af_tipo - TIPO DO CAMPO
	// - [0] - STRING
	// - [1] - NUMERO
	// - [2] - DATA
	// - [3] - TEXTO
	// - [4] - FLOAT
	// - [5] - BOOLEANO
    // - [6] - DOUBLE
	// - [X] - CLASSE
	// - $af_field - CAMPO A SER CONVERTIDO
	// -========================================================================================
	function convertField($af_tipo, $af_field)
	{
		$a_campo = $af_field;
		
		if(trim($a_campo)!="") {
			$a_campo = trim($a_campo);		
			switch ($af_tipo) {
			    case "CHAR":
			    case "VARCHAR":
			        return("'" . $a_campo . "'");
			        break;
			    case "INT":
					if(is_numeric($a_campo))
						return($a_campo);
					else
						return("NULL");
			        break;
			    case "TIMESTAMP":
                    return("'" . $a_campo . "'");
			        break;
				case "DATETIME":
			    	$utildate = New UtilDate();
			    	$utildate->strdate = $a_campo;
					if($utildate->verifyDateTime()) {
						$a_data = substr($a_campo, 0, 10);
						$a_hora = substr($a_campo, 11);
						list($a_dia,$a_mes,$a_ano) = explode("/",$a_data);
						$a_campo = $a_ano."-".$a_mes."-".$a_dia;
						if ($a_hora != "")
							$a_campo .= " ".$a_hora;
						return("'".$a_campo."'");
					} else
						return("NULL");
			        break;
				case "DATE":
			    	$utildate = New UtilDate();
			    	$utildate->strdate = $a_campo;
					if($utildate->verifyDate()) {
						list($a_dia,$a_mes,$a_ano) = explode("/",$a_campo);
						$a_campo = $a_ano."-".$a_mes."-".$a_dia;
						return("'".$a_campo."'");
					} else
						return("NULL");
			        break;
				case "TIME":
			    	$utildate = New UtilDate('H:i:s');
			    	$utildate->strdate = $a_campo;
					if($utildate->verifyTime()) {
						return("'".$a_campo."'");
					} else
						return("NULL");
			        break;
			    case "TEXT":
					$a_campo = str_replace("'","^",$a_campo);
					return("'" . $a_campo . "'");
			        break;
			    case "FLOAT":
				case "NUMERIC":
				case "DECIMAL":
					//$a_campo = number_format($a_campo, 2, '.', '');
					$a_campo = str_replace(".", "", $a_campo);
					$a_campo = str_replace(",", ".", $a_campo);
					if(is_numeric($a_campo)){
						return($a_campo);
					}else
						return("NULL");
			        break;
                case "DOUBLE":
                    //$a_campo = number_format($a_campo, 2, '.', '');
                    //$a_campo = str_replace(".", "", $a_campo);
                    //$a_campo = str_replace(",", ".", $a_campo);
                    if(is_numeric($a_campo)){
                        return($a_campo);
                    }else
                        return("NULL");
                    break;
			    case "BOOL":
                case "BOOLEAN":
					if((int)$a_campo==1)
						return("true");
					else
						return("false");
			        break;
			    default:
					return ("NULL");
			}
		} else
			return("NULL");
	}
}
?>