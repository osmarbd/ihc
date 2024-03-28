<?php
class AdminVO extends PatternVO {

	// -========================================================================================
	// - DESCRICAO
	// - construtor da classe
	//
	// - PARAMETROS UTILIZADOS
	// - $table - NOME DA TABELA
	// - $fields - NOME DOS CAMPOS DA TABELA
	// - $datatypes - TIPO DE DADOS DOS CAMPOS
	// -========================================================================================
	function __construct()
	{
		if (file_exists('../include/db.xml')) {
			$xml = simplexml_load_file('../include/db.xml');
			$ent = $xml->xpath("//ent[@name='usuarios']");

			$this->table = $ent[0]['name'];
			$this->pkfield = $ent[0]->pk;
			
			foreach ($ent[0]->attr as $column) {
				$key = (string) $column['name'];
				$this->fields[$key] = null;
				$this->datatype[$key] = $column['type'];
			}
		} else {
			exit('Failed to open db.xml.');
		}
	}

}
?>