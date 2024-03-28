<?php
class UtilMail {
	
	// -========================================================================================
	// - DESCRICAO
	// - Funcao que verifica a autenticidade de um email
	// -========================================================================================
	function verifyMail($af_email)
	{
		if (!filter_var($af_email, FILTER_VALIDATE_EMAIL))
			return(false);
		else
			return(true);
	}

}
?>