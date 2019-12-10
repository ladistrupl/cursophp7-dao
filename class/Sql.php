<?

class Sql extends PDO {
	
	private $conn;
	
	public function __construct(){
		try {
			$this->conn = new PDO("mysql:dbname=db_curso_php7;host=localhost;", "root", "mysql");
		} catch(PDOException $e){
			echo "Erro ao conectar ao BD: ",$e->getMessage();
		}
	}
	
	private function setParam($statment, $key, $value){ $statment->bindParam($key,$value); }
	
	private function setParams($statment, $parameters = array()){
		foreach($parameters as $key => $value){ $this->setParam($statment, $key, $value); }
	}
	
	public function query($rawQuery, $params = array()){
		$stmt=$this->conn->prepare($rawQuery);	
		$this->setParams($stmt, $params);
		$stmt->execute();												
		return $stmt;
	}
	
	public function select($rawQuery, $params = array()):array {
		$stmt=$this->query($rawQuery, $params);	
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
}

?>