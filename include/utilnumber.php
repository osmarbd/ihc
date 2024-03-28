<?php
class UtilNumber {

	var $numero;
	var $base;
	

	// -========================================================================================
	// - DESCRICAO
	// - construtor da classe
	//
	// - PARAMETROS UTILIZADOS
	// - $date - DATA
	// -========================================================================================
	public function __construct()
	{
		$this->numero = null;
		$this->base = null;
	}
	
	// -========================================================================================
	// - DESCRICAO
	// - Retorna o modulo de uma divisao
	// -========================================================================================
	public function MOD() {
		return $this->numero%$this->base;
	}

	// -========================================================================================
	// - DESCRICAO
	// - Retorna o resto de uma divisao
	// -========================================================================================
	public function DIV() {
		return floor($this->numero/$this->base);
	}
}
?>