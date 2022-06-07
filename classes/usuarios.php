<?php
Class Conexao {

	protected $host = 'localhost';
	protected $port = '5842';
	protected $user = 'postgres';
	protected $pswd = '1234';
	protected $con = null;

	function __construct(){} //m�todo construtor


	//m�todo que inicia conexao
	function open(){
		
		$this->con = pg_connect("host=$this->host port=$this->port dbname='db_000001' user=$this->user password=$this->pswd");
		return $this->con;
	}

	//m�todo que encerra a conexao
	function close(){
		pg_close($this->con);
	}

	//m�todo verifica status da conexao
	function statusCon(){
		if(!$this->con){
			echo "<h3>O sistema nao esta conectado a  [$this->dbname] em [$this->host].</h3>";
			exit;
		} else {
			echo "<h3>O sistema esta conectado a  [$this->dbname] em [$this->host].</h3>";
			exit;
		}
	}
}

class usuario
{
	private $pdo;
	public $msgErro = "";

	/*public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		try {
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
		
	}*/

	protected $host = 'localhost';
	protected $port = '5842';
	protected $user = 'postgres';
	protected $pswd = '1234';
	protected $con = null;

	function __construct(){} //m�todo construtor


	//m�todo que inicia conexao
	function open(){
		
		$this->con = pg_connect("host=$this->host port=$this->port dbname='db_000001' user=$this->user password=$this->pswd");
		return $this->con;
	}

	//m�todo que encerra a conexao
	function close(){
		pg_close($this->con);
	}

	//m�todo verifica status da conexao
	function statusCon(){
		if(!$this->con){
			echo "<h3>O sistema nao esta conectado a  [$this->dbname] em [$this->host].</h3>";
			exit;
		} else {
			echo "<h3>O sistema esta conectado a  [$this->dbname] em [$this->host].</h3>";
			exit;
		}
	}

	


	public function cadastrar($nome, $telefone, $email, $senha)
	{
	

		$sql = ("SELECT id_usuario FROM db_gol.usuarios WHERE email = '".$email."'");
	
		$sql_1       = utf8_encode($sql); 		
		$conexao    = new Conexao();
		$conn       = $conexao->open();
		$result     = pg_query($conn, $sql_1);

		if(pg_num_rows($result) > 0)
		{
			return false; //ja esta cadastrada
		}
		else
		{
			$serial = "
				SELECT 
						COALESCE(MAX(id_usuario), 0)+1 as id_usuario 
				FROM db_gol.usuarios";
				
			$sql_serial = utf8_encode($serial); 
			$conexao    = new usuario();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql_serial);
			$row = pg_fetch_array($result);
			
			$id_usuario = $row['id_usuario'];
			//caso nao, cadastrar
			$sql = ("INSERT INTO db_gol.usuarios (
					id_usuario,   		nome,		telefone, 		email, 		senha
					) VALUES (
					".$id_usuario.",  '".$nome."', 	'".$telefone."', '".$email."', '".$senha."')"); 

			$sql_cadastrar	= utf8_encode($sql); 		
			$conexao    	= new usuario();
			$conn       	= $conexao->open();
			$result     	= pg_query($conn, $sql_cadastrar);					
			return true;
		}
	}

	public function logar($email, $senha)
	{

		global $pdo;
		//verificar se email e senha estao cadastrado,se sim
		//$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
		
		$sql = ("SELECT id_usuario FROM db_gol.usuarios WHERE email = '".$email."' AND senha = '".$senha."'");
		

		$sql_serial = utf8_encode($sql); 
		$conexao    = new usuario();
		$conn       = $conexao->open();
		$result     = pg_query($conn, $sql_serial);
		$row = pg_fetch_array($result);
		
			
		$id_usuario = $row['id_usuario'];

		/*$sql->bindValue(":e",$email);
		$sql->bindValue(":s",md5($senha));
		$sql->execute();*/
		if(pg_num_rows($result) > 0)
		{
			
			//entrar no sistema (sessao)
			//$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $row['id_usuario'];
			
			return true; //logado com sucesso
		}
		else
		{
			return false; //nao foi possivel logar
		}	

	}


}







?>