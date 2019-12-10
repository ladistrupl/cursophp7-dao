<?
class Usuario {
	
	private $idusuario;
	private $ds_login;
	private $ds_senha;
	private $dt_cadastro;
	
	public function getIdUsuario(){ return $this->idusuario; }
	public function getDsLogin(){ return $this->ds_login; }
	public function getDsSenha(){ return $this->ds_senha; }
	public function getDtCadastro(){ return $this->dt_cadastro; }
	
	public function setIdUsuario($value){ $this->idusuario = $value; }
	public function setDsLogin($value){ $this->ds_login = $value; }
	public function setDsSenha($value){ $this->ds_senha = $value; }
	public function setDtCadastro($value){ $this->dt_cadastro = $value; }
	
	public function __construct($login = "", $pass = ""){
		$this->setDsLogin($login);
		$this->setDsSenha($pass);
	}
	
	public function setDados($dados){
		$this->setIdUsuario($dados['idusuario']);
		$this->setDsLogin($dados['ds_login']);
		$this->setDsSenha($dados['ds_senha']);
		$this->setDtCadastro(new DateTime($dados['dt_cadastro']));
	}
	
	public function loadById($id){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID;", array(":ID"=>$id));
		if(count($result) > 0){
			$this->setDados($result[0]);
		}
	}
	
	public static function searchLogin($login){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE ds_login LIKE :SEARCH ORDER BY ds_login", array(':SEARCH'=>"%".$login."%"));
		return $result;
	}
	
	public function login($login, $pass){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE ds_login = :LOGIN AND ds_senha = :PASS;", array(
			":LOGIN"=>$login, ":PASS"=>$pass));
		if(count($result) > 0){
			$this->setDados($result[0]);
		} else {
			throw new Exception("Erro: Login ou Senha não encontrados!");
		}
	}
	
	public function insert(){
		$sql = new Sql();
		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASS)", array(
			':LOGIN'=>$this->getDsLogin(),
			':PASS'=>$this->getDsSenha()
		));
		if(count($result) > 0){
			$this->setDados($result[0]);
		}
	}
	
	public function update($login, $pass){
		$this->setDsLogin($login);
		$this->setDsSenha($pass);
		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET ds_login = :LOGIN, ds_senha = :PASS WHERE idusuario = :ID", array(
		':LOGIN'=>$this->getDsLogin(),
		':PASS'=>$this->getDsSenha(),
		':ID'=>$this->getIdUsuario()
		));
	}
	
	public function delete(){
		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(':ID'=>$this->getIdUsuario()));
		$this->setIdUsuario(0);
		$this->setDsLogin("");
		$this->setDsSenha("");
		$this->setDtCadastro(new DateTime());
	}
	
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario;");
	}
	
	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdUsuario(),
			"ds_login"=>$this->getDsLogin(),
			"ds_senha"=>$this->getDsSenha(),
			"dt_cadastro"=>$this->getDtCadastro()
		));
	}
	
	
}


?>