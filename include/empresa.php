<?php
class Empresa{
	// CONEXAO COM BANCO DE DADOS	
	public function dataEmpresa() {

	    $empresa = array(
            'apelido' => 'Emp',
            'empresa' => 'Empresa',
            'cidade' => 'Curitiba',
            'favicon' => '../img/sistema/logos/favicon76x76.png'
        );

	    return $empresa;

	}	
}