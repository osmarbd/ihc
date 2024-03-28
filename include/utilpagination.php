<?php
class UtilPagination {

    var $pagina;
    var $exibe;
    var $total;
    var $ArrayParametro;
    var $ArrayValor;
    var $link;
    var $tamd;
    var $atuald;

    // -========================================================================================
    // - DESCRICAO
    // - construtor da classe
    // -========================================================================================
    public function __construct($pagina = null, $exibe = null, $total = null, $ArrayParametro = null, $ArrayValor = null, $link = null, $tamd = null, $atuald = null)
    {
        $this->pagina = $pagina;
        $this->exibe = $exibe;
        $this->total = $total;
        $this->ArrayParametro = $ArrayParametro;
        $this->ArrayValor = $ArrayValor;
        $this->link = $link;
        $this->tamd = $tamd;
        $this->atuald = $atuald;

    }

    // -========================================================================================
    // - DESCRICAO
    // - Funcao que gera uma paginacao
    // -========================================================================================
    public function listPage() {

        $a_string = "";
        $paging_str = "";

        if ($this->pagina != "") {
            $pagina = trim($this->pagina);
            $pagina = floor(($pagina));
        }

        if ($this->exibe != "") {
            $exibe = trim($this->exibe);
            $exibe = floor(($exibe));
        }

        if ($this->tamd != "") {
            $tamd = trim($this->tamd);
            $tamd = floor(($tamd));
        }


        $numpag = $this->total / $exibe;
        $numpag = floor($numpag);
        if ($this->total > ($numpag * $exibe)) {
            $numpag++;
        }

        $totald = $numpag / $tamd;
        $totald = floor($totald);

        if ($numpag > ($totald * $tamd)){
            $totald++;
        }

        if ($this->atuald == 1) {
            $inicial = 1;
            if ($numpag < $tamd) {
                $final = $numpag;
            } else {
                $final = $tamd;
            }

        }
        else {
            $inicial = ($tamd * ($this->atuald - 1)) + 1;
            $parcial = $this->atuald * $tamd;
            if ($numpag < $parcial)
                $final = $numpag;
            else
                $final = $parcial;
        }

        $iniciald = ($tamd * $this->atuald) + 1;
        $finald = $tamd * $this->atuald;

        if ($this->atuald > 1)
            $inicialda = ($tamd * ($this->atuald - 2)) + 1;

        if ($this->ArrayParametro[0] != 0) {
            for ($i = 1; $i <= $this->ArrayParametro[0]; $i++)
                $a_string .= '&'.$this->ArrayParametro[$i].'='.$this->ArrayValor[$i];
        }

        if ($numpag != 1) {

            $paging_str .= "<div class='no-margin pull-left'>";
            if ($this->total == 0) {
                $paging_str .= "Exibindo 0 a 0 de ".$this->total." registros";
            } else {
                $paging_str .= "Exibindo ".((($pagina -1) * $exibe) + 1)." a ".($pagina * $exibe)." de ".$this->total." registros";
            }
            $paging_str .= "</div>";
            $paging_str .= "<ul class='pagination pagination-sm no-margin pull-right'>";
            if ($this->atuald > 1) {
                $paging_str .= "<li><a href='".$this->link.".php?pagina=".$inicialda."&atuald=".($this->atuald - 1)."".$a_string."'>&#171</a></li>";
            } else {
                $paging_str .= "<li class='disabled'><a href='#'>&#171</a></li>";
            }
            if ($pagina > 1) {
                $paging_str .= "<li><a href='".$this->link.".php?pagina=".($pagina - 1)."&atuald=";;
                if ($this->atuald > 1) {
                    if (($pagina - 1) > ($tamd * ($this->atuald - 1))) {
                        $paging_str .= $this->atuald;
                    } else {
                        $paging_str .= ($this->atuald - 1);
                    }
                } else {
                    $paging_str .= $this->atuald;
                }
                if ($a_string != "") $paging_str .= $a_string;
                $paging_str .=  "'>Anterior</a></li>";
            } else {
                $paging_str .= "<li class='disabled'><a href='#'>Anterior</a></li>";
            }

            for ($i = $inicial; $i <= $final; $i++) {

                if ($i != $pagina) {
                    $paging_str .= "<li><a href='".$this->link.".php?pagina=".$i."&atuald=".$this->atuald."".$a_string."' class='nav-link'>".$i."</a></li>";
                } else {
                    $paging_str .= "<li class='active'><a href='#'>".$i."</a></li>";
                }
            }

            if ($this->total == 0) {
                $paging_str .= "<li class='disabled'><a href='#'>Pr&oacute;xima</a></li>";
            }elseif ($pagina != $numpag) {
                $paging_str .= "<li><a href='".$this->link.".php?pagina=".($pagina + 1)."&atuald=";;
                if ($pagina < $finald) {
                    $paging_str .= $this->atuald;
                } else {
                    $paging_str .= ($this->atuald + 1);
                }
                if ($a_string != "") $paging_str .= $a_string;
                $paging_str .=  "'>Pr&oacute;xima</a></li>";
            }
            if ($this->atuald < $totald) {
                $paging_str .= "<li><a href='".$this->link.".php?pagina=".$iniciald."&atuald=".($this->atuald + 1)."".$a_string."'>&#187</a></li>";
            } else {
                $paging_str .= "<li class='disabled'><a href='#'>&#187</a></li>";
            }

            $paging_str .= "</ul>";

            return $paging_str;


        }
    }


}
?>