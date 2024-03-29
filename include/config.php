<?php
class Config{		
	// CONEXAO COM BANCO DE DADOS	
	public function dataConect() {		
		// AMBIENTE		
		// 0 - Casa - PC		
		// 1 - Note
		// 1 - s4		
		// 2 - Locaweb		
		$ambiente = 0;		
		if ($ambiente == 0){ 
			// CASA-PC			
			$database = "template";
			$host = "localhost";			
			$dbuser = "root";			
			$dbpassword = "obtz76";
			$dbport = 3307;
		}elseif($ambiente == 1){ 
			// Note			
			$database = "template";			
			$host = "localhost";			
			$dbuser = "root";			
			$dbpassword = "pwd1234!";		
			$dbport = 3306;
		}elseif($ambiente == 2){            
			$database = "";            
			$host = "";            
			$dbuser = "";            
			$dbpassword = "";        
		}		
		$arrayConn = array('database' => $database,'host' => $host,'dbuser' => $dbuser,'dbpassword' => $dbpassword, 'dbport' => $dbport);		
		return $arrayConn;	
	}	
}