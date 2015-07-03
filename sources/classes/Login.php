<?php
	class Login
	{
		//Database ligada
		private $db_connection = null;
		//existencia de erros
		public $errors = array();
		//mensagens de sucesso/erros
		public $messages = array();
		
		public $user_mail = "";
		
		public $old_pw = "";
		
		public $new_pw = "";
		
		public $rnew_pw = "";

		public function __construct()
		{

			session_start();


			if (isset($_GET["logout"])) {
				$this->doLogout();
			}
			elseif (isset($_POST["login"])) {
				$this->dologinWithPostData();
			}
			elseif (isset($_POST['c_mail'])) {
				$this->UserEditMail($_POST['email']);
			}
			elseif (isset($_POST['c_pw'])) {
				$this->UserEditPassword($_POST['apw'], $_POST['pw'], $_POST['rpw']);
			}
		}

		private function dologinWithPostData()
		{
			if (empty($_POST['user_name'])) {
				$this->errors[] = "O campo do username está vazio!";
			} elseif (empty($_POST['user_password'])) {
				$this->errors[] = "O campo da password está vazio!";
			} elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

				$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				
				if ($this->db_connection->connect_error) {
					die('Connect Error (' . $this->db_connection->connect_errno . ') ' . $this->db_connection->connect_error);
				}
				
				if (!$this->db_connection->set_charset("utf8")) {
					$this->errors[] = $this->db_connection->error;
				}

				if (!$this->db_connection->connect_errno) {

					$user_name = $this->db_connection->real_escape_string($_POST['user_name']);

					$sql = "SELECT userid, nome, mail, password, admin
							FROM usuarios
							WHERE nome = '" . $user_name . "' OR mail = '" . $user_name . "';";
					$result_of_login_check = $this->db_connection->query($sql);
					header("Location: index.php?action=login");
					if ($result_of_login_check->num_rows == 1) {

						$result_row = $result_of_login_check->fetch_object();
						$pw = $_POST['user_password'];
						if (hashsamp($pw) == $result_row->password) {

							$_SESSION['u_name'] = $result_row->nome;
							$_SESSION['u_id'] = $result_row->userid;
							$_SESSION['u_email'] = $result_row->mail;
							$_SESSION['u_admin'] = $result_row->admin;
							$_SESSION['u_pw'] = $result_row->password;
							$_SESSION['u_status'] = 1;
							header("Location: index.php");

						} else {
							$this->errors[] = "Password incorrecta, tenta de novo!";
						}
					} else {
						$this->errors[] = "O username não existe, tenta de novo!";
					}
				} else {
					$this->errors[] = "Problemas com a conexão a database.";
				}
			}
		}

	 
		public function doLogout()
		{

			$_SESSION = array();
			session_destroy();

			$this->messages[] = "You have been logged out.";
			header("Location: index.php");

		}
		
		public function GetUserData($user_name)
		{
			$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if (!$this->db_connection->connect_errno) {
				$sql = "SELECT * FROM usuarios WHERE nome = '".$user_name."';";
				$query_user = $this->db_connection->query($sql);
				return $query_user->fetch_array();
			} else {
				return false;
			}
		}
	  
		public function UserLogged()
		{
			if (isset($_SESSION['u_status']) AND $_SESSION['u_status'] == 1) {
				return true;
			}
			return false;
		}
		
		public function UserIsAdmin()
		{
				if(isset($_SESSION['u_admin']) AND $_SESSION['u_admin'] > 0) {
					return true;
				} else return false;
		}
		
		public function UserEditMail($user_email)
		{
			$user_email = substr(trim($user_email), 0, 64);
			$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			
			if (!empty($user_email) && $user_email == $_SESSION["u_email"]) {
				$this->errors[] = "O email que inseriste é igual ao antigo.";
			} else if (empty($user_email) || !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
				$this->errors[] = "O email que inseriste não é válido.";
			} else if(!$this->db_connection->connect_errno) {
				$sql = "SELECT nome, mail
						FROM usuarios
						WHERE mail = '" . $user_email . "';";
				$query = $this->db_connection->query($sql);
				if($query->num_rows == 0){ 
					$sql = "UPDATE usuarios SET mail = '" . $user_email . "' WHERE userid = ". $_SESSION['u_id'] .";";
					if($query = $this->db_connection->query($sql)) {
						$_SESSION['u_email'] = $user_email;
						$this->messages[] = "Email mudado com sucesso para: " . $_SESSION['u_email'];
					}else {
						$this->errors[] = "Ocorreu um erro ao mudar de email, tenta mais tarde ou fala com um Admin.";
					}

				}else {
					$this->errors[] = "O email que inseriste já existe.";
				}
			}else {
				$this->errors[] = "Problemas com a conexão a database.";
			}
		}
		public function UserEditPassword($old_pw, $new_pw, $rnew_pw) {
			if (empty($new_pw) || empty($rnew_pw) || empty($old_pw)) {
				$this->errors[] = "Os campos têm de estar preenchidos!";
			}elseif ($new_pw !== $rnew_pw) {
				$this->errors[] = "As passwords não coicidem!";
			} elseif (strlen($new_pw) < 6) {
				$this->errors[] = "Password muito pequena.";
			}else {
			
				
				if(isset($_SESSION['u_pw'])) {
					if (hashsamp($old_pw) == $_SESSION['u_pw']) {
						$hash_newpw = hashsamp($new_pw);
						$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
						$sql = "UPDATE usuarios SET password = '".$hash_newpw."' WHERE nome = '".$_SESSION['u_name']."';";
						
						if($this->db_connection->query($sql)) {
							$this->messages[] = "Password mudada com sucesso para: " . $new_pw;
							$_SESSION['u_pw'] = $hash_newpw;
						}else {
							$this->errors[] = "Ocorreu um erro ao mudar de password, tenta mais tarde ou fala com um Admin.";
						}
						
					}else {
						$this->errors[] = "A password antiga não coincide.";
						$this->errors[] = hashsamp($old_pw);
						$this->errors[] = $_SESSION['u_pw'];
					}
				}else {
					$this->errors[] = "A conta não exise.";
				}
			}
		}
	}
?>