<?php

require_once ('../src/config/config.php');

Class Produto {

    function produtoConnect($sql){
        $sql        = utf8_encode($sql); 		
        $conexao    = new Conexao();
        $conn       = $conexao->open();
        $result     = pg_query($conn, $sql);

        
        if(pg_num_rows($result) >= 1){
            $row = pg_fetch_array($result);
            
        }
        return $row;
	}

	function productSerial(){
        $teste='cheguei';
        return $teste;
        /*$serial = " 
        SELECT 
            COALESCE(MAX(id_concessionaria), 0)+1 as id_produto
        FROM db_tb_produto";
        $response = self::produtoConnect($serial);
        return $response;*/
	}
}

?>