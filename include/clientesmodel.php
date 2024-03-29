<?php
	Class ClientesModel {
	
		public function login($param) {
			return (new ClientesDAO)->login($param);
		}
		
		public function showList() {
			
			$obj = (new ClientesDAO)->loadAll("nome");
			
			// CALCULA O NUMERO DE ELEMENTOS DO ARRAY
			$end = count($obj);
            echo "<table id='tabela1' class='table table-bordered table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Nome</th>";
            echo "<th>Email</th>";       
            echo "<th data-orderable='false'>";
            echo "<a href=clientesins.php><span class='glyphicon glyphicon-plus fa-lg' title='Inserir' alt='Inserir'></span></a></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

			for ($i = 1; $i <= $end; $i++) {

				$objstr = new UtilString();				

                $str_nome = $obj[$i]->get_nome();
                //$objstr->str = $str_nome;
                //$str_nome = $objstr->formatString(0);

                $str_email = $obj[$i]->get_email();
                //$objstr->str = $str_email;
                //$str_email = $objstr->formatString(0);               

				$stt = $obj[$i]->get_stt();

				

                echo "<tr>";
                echo "<td>".$str_nome."</td>";
                echo "<td>".$str_email."</td>";             
                echo "<td>";
                echo "<a href=clientesalt.php?cod=".$obj[$i]->get_id().">";
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
            echo "<th>Nome</th>";
            echo "<th>Email</th>";        
            echo "<th>&nbsp;</th>";
            echo "</tr>";
            echo "</tfoot>";
            echo "</table>";
			return null;
		}
		
		public function verifyLogin($param) {
			return (new ClientesDAO)->verifyLogin($param);
		}
		
		public function insert($param) {
			return (new ClientesDAO)->insert($param);
		}
		
		public function load($param) {
			$obj = (new ClientesDAO)->load($param);
			return $obj;
		}
		
		public function updatePwd($param) {
			return (new ClientesDAO)->updatePwd($param);
		}

        public function update($param) {
            return (new ClientesDAO)->update($param);
        }

        public function updateImage($param) {
            return (new ClientesDAO)->updateImage($param);
        }
		
		public function delete($param) {
			return (new ClientesDAO)->delete($param);
		}
		
		public function updateStt($param) {
			return (new ClientesDAO)->updateStt($param);
		}

        public static function combo($param, $css = null, $where = null, $name = null) {
		    //print_r($where);

            $obj = (new ClientesDAO)->loadAll("nome", $where);

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


