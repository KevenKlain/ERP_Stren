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

?>
