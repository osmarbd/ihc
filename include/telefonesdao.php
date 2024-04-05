<?php
	Class TelefonesDAO {
	
		public function login($param)
		{
			global $objdb;
			$objstring = new UtilString();
			$admin = $param;

			$a_resposta = 0;
			$ArrayI[0] = 2;
			$ArrayI[1] = chr(34);
			$ArrayO[1] = "";
			$ArrayI[2] = chr(39);
			$ArrayO[2] = "";

			$af_log = $objdb->verifySQLInjection($admin->get_login());
			$af_pwd = $objdb->verifySQLInjection($admin->get_senha());
		
			$objstring->str = $af_log;
			$af_log = $objstring->changeChar($ArrayI, $ArrayO);
			$objstring->str = $af_pwd;
			$af_pwd = $objstring->changeChar($ArrayI, $ArrayO);
		
			$af_log = $objdb->convertField(0, $af_log);
		
			$sql = "SELECT id, nome, login, senha, email, stt, tipo FROM ".$admin->table." WHERE login=".$af_log.";";


			$objdb->set_sql($sql);
			$objdb->dbQuery();
			
			if ($objdb->numRows > 0)
			{
				$array = $objdb->fetchArray();
				$a_id = $array['id'];
                $a_nome = $array['nome'];
                $a_login = $array['login'];
				$a_pwd = $array['senha'];
				$a_stt = $array['stt'];
                $a_tp = $array['tipo'];
				if ($a_stt != 1){
					$a_resposta = 2;
				} elseif (MD5($af_pwd) != $a_pwd) {
					$a_resposta = 3;
				} else {
					$a_resposta = 0;
					$_SESSION['id_usuario'] = $a_id;
                    $_SESSION['tp_usuario'] = $a_tp;
                    $_SESSION['login_usuario'] = $a_login;
                    $_SESSION['nome_usuario'] = $a_nome;
				}
			} else {
				$a_resposta = 1;
			}

			return $a_resposta;
		}
		
		public function loadAll($order, $where = null) {
			$i = 1;
			global $objdb;
            $userArr = null;
			$flag = 0;
			$fields = "";
			$admin = new TelefonesVO();
			
			foreach(array_keys($admin->fields) as $field){
				if ($flag == 0) {
					$fields .= $field;
					$flag = 1;
				} else {
					$fields .= ", ".$field;
				}
			}
			
			$query = "SELECT ".$fields." FROM ".$admin->table;
			if ($where != "") {
                $query .= $where;
			}
            $query .= " ORDER BY ".$order;
			//print_r($query);

			$objdb->set_sql($query);
			$objdb->dbQuery();
			if ($objdb->numRows > 0) {
				for ($j = 0; $j < $objdb->numRows; $j++) {
					$admin_aux = new TelefonesVO();
					$array = $objdb->fetchArray();
					foreach(array_keys($admin->fields) as $field){
						$str = "set_".$field;
						$admin_aux->$str($array[$field]);

					}
					$userArr[$i] = $admin_aux;

					$i++;
				}
			}
			return $userArr;
		}
		
		// VERIFICA
		function verifyLogin($param)
		{
			global $objdb;
			$admin = new TelefonesVO();
			$a_total = 0;
			
			$query = "SELECT COUNT(*) FROM ".$admin->table." WHERE login='".$param."'";
			//print_r($query);
			//exit();
			$objdb->set_sql($query);
			$objdb->dbQuery();
			if ($objdb->dbQuery($query)) {
				$row = $objdb->fetchRow();
				if ($objdb->numRows>0)
				{
					$a_total = $row[0];
				}
			}
		
			if ($a_total > 0)
				return 1;
			else
				return 0;
		}
		
		public function insert($param) {
			global $objdb;
			$flag = 0;
			$fields = "";
			$admin = $param;
					
			$values = array();
			foreach(array_keys($admin->fields) as $field){
				if ((($field != $admin->pkfield) && ($field != "updated_at")) && ($field != "deleted_at"))  {
					if ($flag == 0) {
						$fields .= $field;
						$flag = 1;
					} else {
						$fields .= ", ".$field;
					}
                    if ($field == "senha") {
                        $values[] = $objdb->convertField($admin->datatype[$field], MD5($admin->fields[$field]));
                    } else {
                        $values[] = $objdb->convertField($admin->datatype[$field], $admin->fields[$field]);
					}
				}
			}
			$inspt = join( ", ", $values);
			
			$query = "INSERT INTO ".$admin->table." ($fields) VALUES ($inspt);";
			//echo "<br>$query<br>";
			//exit;
			$objdb->set_sql($query);
			$result = $objdb->dbQuery();
			if ($result == false) {
				return false;
			} else {
				return true;
			}
		}
		
		public function updatePwd($param) {
			global $objdb;
			$admin = $param;
			$key = (string) $admin->pkfield;
			
			$sets = array();
			$values = array();
			foreach(array_keys($admin->fields) as $field) {
				if ($field == "senha") {
					$sets []= $field." = ".$objdb->convertField($admin->datatype[$field], MD5($admin->fields[$field]));
				}
			}	
			$set = join( ", ", $sets);
			$query = "UPDATE ".$admin->table." SET ".$set." WHERE ".$admin->pkfield."=".$admin->fields[$key].";";

			$objdb->set_sql($query);
			$result = $objdb->dbQuery();
			if ($result == false) {
				return false;
			} else {
				return true;
			}
		}
		
		public function load($param) {
			global $objdb;
			$flag = 0;
			$fields = "";
			$admin = $param;

			foreach(array_keys($admin->fields) as $field){
				if ($flag == 0) {
					$fields .= $field;
					$flag = 1;
				} else {
					$fields .= ", ".$field;
				}
			}			
			$query = "SELECT ".$fields." FROM ".$admin->table." WHERE ".$admin->pkfield." = ".$admin->get_id();

			//print_r($query);

			$objdb->set_sql($query);
			$objdb->dbQuery();
			if ($objdb->numRows > 0) {
				$array = $objdb->fetchArray();
				foreach(array_keys($admin->fields) as $field){
					$str = "set_".$field;
					$admin->$str($array[$field]);
				}
			}
			return $admin;
		}

        public function update($param) {
            global $objdb;
            $admin = $param;
			//print_r($param);
            $key = (string) $admin->pkfield;

            $sets = array();
            $values = array();
            foreach(array_keys($admin->fields) as $field) {
                if ((((($field != $key) && ($field != "stt")) && ($field != "senha")) && ($field != "created_at")) && ($field != "deleted_at")) {
                    $sets []= $field." = ".$objdb->convertField($admin->datatype[$field], $admin->fields[$field]);
                }
            }
            $set = join( ", ", $sets);

            $query = "UPDATE ".$admin->table." SET ".$set." WHERE ".$admin->pkfield."=".$admin->fields[$key].";";
			//echo $query;
			//exit;

            $objdb->set_sql($query);
            $result = $objdb->dbQuery();
            if ($result == false) {
                return false;
            } else {
                return true;
            }
        }
		
		public function delete($param) {
			global $objdb;
			$admin = $param;
            $key = (string) $admin->pkfield;
			
			$query = "DELETE FROM ".$admin->table." WHERE ".$admin->pkfield." = ".$admin->fields[$key].";";
			$objdb->set_sql($query);
			$result = $objdb->dbQuery();
			$objdb->dbDisconnect();
			if ($result == false) {
				return false;
			} else {
				return true;
			}
		}

        public function updateImage($param) {
            global $objdb;
            $elemento = $param;
            $key = (string) $elemento->pkfield;

            $query = "UPDATE ".$elemento->table." SET imagem = '".$elemento->fields['imagem']."' WHERE ".$elemento->pkfield."=".$elemento->fields[$key].";";

            echo $elemento->fields['imagem'];
            $objdb->set_sql($query);
            $result = $objdb->dbQuery();
            if ($result == false) {
                return false;
            } else {
                return true;
            }
        }
		
		public function updateStt($param) {
			global $objdb;
			$admin = $param;
			$key = (string) $admin->pkfield;
			
			$sets = array();
			$values = array();
			foreach(array_keys($admin->fields) as $field) {
				if ($field == "stt") {
					$sets []= $field." = ".$objdb->convertField($admin->datatype[$field], $admin->fields[$field]);
				}
			}	
			$set = join( ", ", $sets);
			
			$query = "UPDATE ".$admin->table." SET ".$set." WHERE ".$admin->pkfield."=".$admin->fields[$key].";";
			$objdb->set_sql($query);
			$result = $objdb->dbQuery();
			if ($result == false) {
				return false;
			} else {
				return true;
			}
		}
}
?>


