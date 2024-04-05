<?php
	Class TelefonesModel {
	
		public function login($param) {
			return (new TelefonesDAO)->login($param);
		}
		
		public function showList() {
			
			$obj = (new TelefonesDAO)->loadAll("telefone");
            if(empty($obj)){
                $end = 0;
            }else{
                // CALCULA O NUMERO DE ELEMENTOS DO ARRAY
			    $end = count($obj);
            }
			
			
            echo "<table id='tabela1' class='table table-bordered table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>DDD</th>";
            echo "<th>Telefone</th>";       
            echo "<th data-orderable='false'>";
            echo "<a href=telefonesins.php><span class='glyphicon glyphicon-plus fa-lg' title='Inserir' alt='Inserir'></span></a></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

			for ($i = 1; $i <= $end; $i++) {

				$objstr = new UtilString();				

                $str_ddd = $obj[$i]->get_ddd();
                //$objstr->str = $str_nome;
                //$str_nome = $objstr->formatString(0);

                $str_telefone = $obj[$i]->get_telefone();
                //$objstr->str = $str_email;
                //$str_email = $objstr->formatString(0);               

				$stt = $obj[$i]->get_stt();

				

                echo "<tr>";
                echo "<td>".$str_ddd."</td>";
                echo "<td>".$str_telefone."</td>";             
                echo "<td>";
                echo "<a href=telefonesalt.php?cod=".$obj[$i]->get_id().">";
                echo "<span class='glyphicon glyphicon-edit fa-lg' title='Alterar' alt='Alterar'></span></a>&nbsp;";
                //echo "<a href=adminexec.php?cod=".$obj[$i]->get_id().">";
                //echo "<span class='glyphicon glyphicon-remove fa-lg' title='Excluir' alt='Excluir'></span></a>&nbsp;";
                if ($stt == "0") {
                    echo "<a href=clientesaltstt.php?cod=".$obj[$i]->get_id()."&stt=1>";
                    echo "<span class='glyphicon glyphicon-ok-circle fa-lg' title='Ativar' alt='Ativar'></span></a>";
                } else {
                    echo "<a href=clientesaltstt.php?cod=".$obj[$i]->get_id()."&stt=0>";
                    echo "<span class='glyphicon glyphicon-remove-circle fa-lg' title='Desativar' alt='Desativar'></span></a>";
                }
                echo "</td>";
				echo "</tr>";
                }
			
            echo "</tbody>";
            echo "<tfoot>";
            echo "<tr>";
            echo "<th>DDD</th>";
            echo "<th>Telefone</th>";        
            echo "<th>&nbsp;</th>";
            echo "</tr>";
            echo "</tfoot>";
            echo "</table>";
			return null;
		}
		
		public function verifyLogin($param) {
			return (new TelefonesDAO)->verifyLogin($param);
		}
		
		public function insert($param) {
			return (new TelefonesDAO)->insert($param);
		}
		
		public function load($param) {
			$obj = (new TelefonesDAO)->load($param);
			return $obj;
		}
		
		public function updatePwd($param) {
			return (new TelefonesDAO)->updatePwd($param);
		}

        public function update($param) {
            return (new TelefonesDAO)->update($param);
        }

        public function updateImage($param) {
            return (new TelefonesDAO)->updateImage($param);
        }
		
		public function delete($param) {
			return (new TelefonesDAO)->delete($param);
		}
		
		public function updateStt($param) {
			return (new TelefonesDAO)->updateStt($param);
		}

        public static function combo($param, $css = null, $where = null, $name = null) {
		    //print_r($where);

            $obj = (new TelefonesDAO)->loadAll("nome", $where);

            // CALCULA O NÚMERO DE ELEMENTOS DO ARRAY

            $end = count($obj);

            echo "<select name=";

            if ($name != "") {
                echo $name;
                echo " id=".$name;
            } else {
                echo '"usuarios"';
                echo ' id="usuarios"';
            }

            if ($css != "") {
                echo " class='".$css."'";
            }
            echo ">";

            $objstr = new UtilString();

            echo "<option value=''>Todas as agendas</option>";
            for ($i = 1; $i <= $end; $i++) {
                $a_cod = $obj[$i]->get_id();

                $str_nome = $obj[$i]->get_nome();
                $objstr->str = $str_nome;
                $str_nome = $objstr->formatString(0);

                echo "<option value='".$a_cod."'";
                if ($param == $a_cod) {
                    echo " selected";

                }
                echo ">".$str_nome."</option>";
            }
            echo "</select>";

        }
		
	}
?>


