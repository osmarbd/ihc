<?php
	Class UtilsMask {

		// VERIFICA
		function maskCpfCnpj($param)
		{
			if(strlen($param)>11) {
                return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $param);
            }else{
                return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $param);
			}

		}

        function maskTelefone($param)
        {
            if(strlen($param)>10) {
                return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $param);
            }else{
                return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $param);
            }

        }

        function maskMoney($param)
        {
                return number_format($param,2,",",".");
        }

        function maskCep($param)
        {
            if(strlen($param)==8) {
                return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $param);
            }else{
               return "cep incorreto";
            }

        }
}
?>


