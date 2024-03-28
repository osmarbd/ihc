<?php
class UtilString {

	var $str;
	
	// -========================================================================================
	// - DESCRICAO
	// - construtor da classe
	//
	// - PARAMETROS UTILIZADOS
	// - $string - STRING
	// -========================================================================================
	public function __construct()
	{
		$this->str = null;
	}
  
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que troca caracteres
	//
	// - PARAMETROS UTILIZADOS
	// - $ArrayInput[] - ARRAY DE PARAMETROS A SEREM ENCONTRADOS
	// - $ArrayOutput[] - ARRAY DE PARAMETROS SUBSTITUTOS
	// -========================================================================================
	function changeChar($ArrayInput, $ArrayOutput)
	{
		$a_valor = "";
		for($i = 1; $i <= $ArrayInput[0]; $i++) {
			$a_valor = str_replace($ArrayInput[$i], $ArrayOutput[$i], $this->str);
		}
		return($a_valor);
	}

	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que Formata uma String
	//
	// - PARAMETROS UTILIZADOS
	// - $af_tipo --> FORMATO DE EXIBIÇAO DE UMA STRING
	// - [0] - MAÍUSCULO
	// - [1] - MINÚSCULO 
	// - [2] - PRIMEIRA LETRA DA STRING EM MAÍUSCULO
	// -========================================================================================
	function formatString($af_tipo)
	{
		$a_str = "";
		$a_string = trim($this->str);
        $encoding = 'UTF-8';

		if(trim($a_string) != "") {
			if ($af_tipo == 0) {
                $a_str = mb_convert_case($a_string, MB_CASE_UPPER, $encoding);
			} else if ($af_tipo == 1) {
                $a_str = mb_convert_case($a_string, MB_CASE_LOWER, $encoding);
			} else if ($af_tipo == 2) {
                $a_str = mb_convert_case($a_string, MB_CASE_TITLE, $encoding);
			}
		}
		return $a_str;
	}
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que apaga caracteres invalidos para a query de login
	// -========================================================================================
	function verifySQLInjection()
	{
		$a_str = trim($this->str);
	
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
    // - Funcao que gera um link amigavel
    // -========================================================================================
    function sluggable() {

        $str = trim($this->str);

        if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
            $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
        $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
        $str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
        $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
        $str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
        $str = strtolower( trim($str, '-') );

        return $str;

    }
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que apaga caracteres invalidos para a query de login
	// -========================================================================================
	function removeStress()
	{
		$a_str = trim($this->str);
	
		$a_str = preg_replace("[^a-zA-Z0-9_]", "", strtr($a_str, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
		
		return($a_str);
	
	}
}
?>