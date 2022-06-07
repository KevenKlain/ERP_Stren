<?php
	switch ($_REQUEST["acao"]) {
		case 'cadastrar':
            $id_venda = $_POST["id_venda"];
			$serial = "
				SELECT 
						COALESCE(MAX(id_item), 0)+1 as id_item 
				FROM db_gol.tb_venda_item
                WHERE id_venda =".$id_venda;

			$sql_serial = utf8_encode($serial); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql_serial);

			$row = pg_fetch_array($result);

			$id_item        = $row['id_item'];
			$descricao      = $_POST["descricao"];
            $nu_quantidade  = $_POST["nu_quantidade"];
            $vr_venda       = str_replace(',','.', str_replace('.','', $_POST["vr_venda"]));
            $vr_total       = str_replace(',','.', str_replace('.','', $_POST["vr_venda"])) * $nu_quantidade;

            $sql = "
				INSERT INTO db_gol.tb_venda_item(
					id_venda, 				    id_item, 				    descricao, 				vr_venda,           vr_total,
					nu_quantidade, 				nm_login, 					dt_inc,                 dt_atu
				) VALUES (
					".$id_venda.", 			    ".$id_item.", 			    '".$descricao."',		".$vr_venda.",      ".$vr_total.",
					".$nu_quantidade.", 	    'keven_klain', 			    NOW(), 					NOW());";

			
			$sql_cadastrar	= utf8_encode($sql); 		
			$conexao    	= new Conexao();
			$conn       	= $conexao->open();
			$result     	= pg_query($conn, $sql_cadastrar);

			if($result==true){
				
				print "<script>location.href='?page=saleEdit&id_venda=".$id_venda.";'</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível cadastrar.</div>";
			}
			break;	

		case 'editar':
			$id_venda = $_POST['id_venda'];
			$nm_cliente = $_POST["nm_cliente"];
			
			$sql = "
				UPDATE db_gol.tb_venda
					SET nm_cliente = '".$nm_cliente."'
					WHERE id_venda = ".$id_venda;
			
			echo $sql;
			$sql_update = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql_update);

			if($result==true){
				print "<script>location.href='?page=saleEdit&id_venda=".$id_venda.";'</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível editar.</div>";
			}
			break;	

		case 'excluir':
			$id_venda = $_POST["id_venda"];
            $id_item = $_POST["id_item"];
            echo 'id_venda'.$id_venda;

			$sql = "
				DELETE FROM db_gol.tb_venda_item
				WHERE id_venda = ".$id_venda."
                AND id_item =".$id_item;
            echo $sql;

			$sql_1      = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql);

			if($result==true){
				print "<script>location.href='?page=saleEdit&id_venda=".$id_venda.";'</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível excluir.</div>";
			}
			break;		
		
	}
?>