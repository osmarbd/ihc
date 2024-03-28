<?php
class PatternVO {

	var $pkfield;
	var $table;
	var $fields = array();
	var $datatype = array();

	// -========================================================================================
	// - DESCRICAO
	// - funcao _call da classe
	//
	// - PARAMETROS UTILIZADOS
	// - $method - METODO DE ACESSO A CLASSE
	// - $args - ARGUMENTOS DE ACESSO
	// -========================================================================================
	public function __call($method, $args)
	{
		if (preg_match("/set_(.*)/", $method, $found))
		{
		  if (array_key_exists($found[1], $this->fields))
		  {
		    $this->fields[$found[1]] = $args[0];
		    return true;
		  }
		}
		else if (preg_match("/get_(.*)/", $method, $found))
		{
		  if (array_key_exists($found[1], $this->fields))
		  {
		    return $this->fields[$found[1]];
		  }
		}
		return false;
	}

}
?>