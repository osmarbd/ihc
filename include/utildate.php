<?php
class UtilDate {

	var $strdate;
	
	// -========================================================================================
	// - DESCRICAO
	// - construtor da classe
	//
	// - PARAMETROS UTILIZADOS
	// - $date - DATA
	// -========================================================================================
	public function __construct()
	{
		$this->strdate = null;
	}
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que retorna se uma data e valida ou nao
	// -========================================================================================
	function verifyDateTime()
	{
		$a_data = substr($this->strdate, 0, 10);
		$a_hora = substr($this->strdate, 11);
		echo "<br>data: ". $a_data;
		echo "<br>hora: ". $a_hora;

		list($a_dia,$a_mes,$a_ano) = explode("/",$a_data);

		if ((checkdate($a_mes,$a_dia,$a_ano))&&(preg_match("#([0-1]{1}[0-9]{1}|[2]{1}[0-3]{1}):[0-5]{1}[0-9]{1}:[0-5]{1}[0-9]{1}#", $a_hora))) {
			return true;
		} else {
			return false;
		}
	}
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que retorna se uma data e valida ou nao
	// -========================================================================================
	function verifyDate()
	{
		list($a_dia,$a_mes,$a_ano) = explode("/",$this->strdate);
	
		if (checkdate($a_mes,$a_dia,$a_ano)) {
			return true;
		} else {
			return false;
		}
	}
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que retorna se uma data e valida ou nao
	// -========================================================================================
	function verifyTime()
	{
		return preg_match("#([0-1]{1}[0-9]{1}|[2]{1}[0-3]{1}):[0-5]{1}[0-9]{1}:[0-5]{1}[0-9]{1}#", $this->strdate);
	}
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que formata a saida de uma data
	//
	// - PARAMETROS UTILIZADOS
	// - $af_dataini - DATA DE INPUT NO FORMATO DE BANCO DE DADOS
	// - $af_data - DATA DE OUTPUT
	// - $af_hora - HORA DE OUTPUT
	// -========================================================================================
	function outputDate(&$af_data, &$af_hora)
	{
	    list ($a_ano, $a_mes, $a_dia) = explode ("-", $this->strdate);
	    $af_data = mktime (0, 0, 0, $a_mes, $a_dia, $a_ano);
	    $af_data = date("d/m/Y", $af_data);
	    $af_hora = trim(substr($this->strdate, 11, 5));
	}

	// -===========================================================================================
    // - Funcao que retorna a idade
    // -===========================================================================================

	function idade($data){

	    list($dia, $mes, $ano) = explode('/', $data);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

	    return $idade;
    }
}
?>