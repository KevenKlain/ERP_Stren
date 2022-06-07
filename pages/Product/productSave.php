<?php

	switch ($_REQUEST["acao"]) {
		case 'cadastrar':
			$serial = "
				SELECT 
						COALESCE(MAX(id_produto), 0)+1 as id_produto 
				FROM db_gol.tb_produto";

			$sql_serial = utf8_encode($serial); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql_serial);

			$row = pg_fetch_array($result);
			$id_produto = $row['id_produto'];
			$descricao 	= $_POST["descricao"];
			$vr_venda 	= str_replace(['.',','],'', $_POST["vr_venda"]);
			$vr_venda   = str_replace(',','.', str_replace('.','', $_POST["vr_venda"]));

			$sql = "
				INSERT INTO db_gol.tb_produto(
					id_produto, 			descricao, 					vr_venda, 
					nm_login, 				dt_inc, 					dt_atu
				) VALUES (
					".$id_produto.", 		'".$descricao."', 			".$vr_venda .", 
					'keven_klain', 			NOW(), 						NOW());";
	
			$sql_cadastrar	= utf8_encode($sql); 		
			$conexao    	= new Conexao();
			$conn       	= $conexao->open();
			$result     	= pg_query($conn, $sql_cadastrar);

			if($result==true){
				
				print "<script>location.href='?page=productEdit&id_produto=".$id_produto.";'</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível cadastrar.</div>";
			}
			break;	

		case 'editar':
			$descricao  = $_POST["descricao"];	
			$vr_venda   = str_replace(',','.', str_replace('.','', $_POST["vr_venda"]));
			$id_produto = $_POST["id_produto"];
			
			$sql = "
				UPDATE db_gol.tb_produto
					SET descricao = '".$descricao."',
					vr_venda = ".$vr_venda.",
					dt_atu = NOW()
					WHERE id_produto = ".$id_produto;
			
			echo $sql;
			$sql_update = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql_update);

			if($result==true){
				print "<script>location.href='?page=productEdit&id_produto=".$_POST["id_produto"].";'</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível editar.</div>";
			}
			break;	

		case 'excluir':
			$id_produto = $_POST["id_produto"];

			$sql = "
				DELETE FROM db_gol.tb_produto
				WHERE id_produto = ".$id_produto;

			$sql_1       = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql);

			if($result==true){
				print "<script>location.href='?page=productConsult';</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível excluir.</div>";
			}
			break;		
		
	}
?>