
<?php


	$aux_consulta = "
	<style>
		body {
			background: #f1f2f3;
		}
		
		#data-table {
			width: 100%;
			border-spacing: 0 0.5rem;
			color: #000000;
			border-collapse: separate;
		}
		
		table thead tr th:first-child,
		table tbody tr td:first-child {
			border-radius: 20px 0 0 20px;
		}
		
		table thead tr th:last-child,
		table tbody tr td:last-child {
			border-radius: 0 20px 20px 0;
		}
		
		table thead th {
			background: white;
			font-weight: bold;
			padding: 10px;
			text-align: left;
		}

		#id_item {
			text-align: center;
		}
		
		table tbody td {
			background: white;
			padding: 15px;
		}

		#button {
			border-radius: 15px;
		}

		.fa-pencil {
			color:#FF9800;
		}

		.submit-lente {
			position:absolute;
			top:1000; 
			right:0;
			z-index:10;
			border:none;
			background:transparent;
			outline:none;
		  }
		  
		  .submit-line {
			position: relative;
			width: 180px;
		  }
		  
		  .submit-line input {
			width: 100%;
			border-radius: 15px;
			margin: 0px 4px;
		  }

		  #fields {
			display: flex;
			
		  }

		  #message {
			margin: 0px 100px;
		  }
		  
		  #transaction {
			display: block;
			width: 100%;
			overflow-x: auto;
	      }
	</style>
	";

	$aux_consulta .= "
		<script src=https://kit.fontawesome.com/88ebab1f4a.js crossorigin='anonymous'></script>	
		
			<div id='fields'>
				<button
					id='button'
					class='btn btn-success' 
					onclick=\"location.href='?page=clientRegister';\">
					<i class='fa-solid fa-circle-plus'></i>
						Novo
				</button>

				<div class='submit-line'>
					<form action='?page=clientConsult' method='POST' class='form-inline my-2 my-lg-0'>
					<input type='text' name='pesquisa' class='form-control' placeholder='Nome do Cliente'/>
					<button class='submit-lente' type='submit'>
						<i class='fa fa-search'></i>
					</button>
				</div>
			</div>
			<section id='transaction'>
			<table id='data-table'>
				<thead>
					<tr>
						<th></th>
						<th id='id_item'>Nr. Cliente</th>
						<th>Cliente</th>
						<th>CPF/CNPJ</th>
						<th>Região</th>
					</tr>
					
				</thead>
				<tbody>";
	
	if(@$_REQUEST["pesquisa"]){
		//$sql = "SELECT * FROM concessionaria  WHERE id_concessionaria = '".$_REQUEST['pesquisa']."'";
		$sql = "SELECT 
					id_cliente, 
					nm_cliente, 
					cpf_cnpj, 
					nm_regiao, 
					nm_login, 
					dt_inc, 
					dt_atu
				FROM db_gol.tb_cliente
				WHERE nm_cliente LIKE '%".$_REQUEST['pesquisa']."%'";
	}else{
		$sql = "SELECT 
					id_cliente, 
					nm_cliente, 
					cpf_cnpj, 
					nm_regiao, 
					nm_login, 
					dt_inc, 
					dt_atu
				FROM db_gol.tb_cliente
				ORDER BY id_cliente";
	}

	$sql_1       = utf8_encode($sql); 		
	$conexao    = new Conexao();
	$conn       = $conexao->open();
	$result     = pg_query($conn, $sql);
	

	if(pg_num_rows($result) >= 1){
		
		while($row = pg_fetch_array($result)){

			$aux_consulta .= "
					<tr>
						<td width='10px' align=center>
							<i  class='fa-solid fa-pencil'
								onclick=\"location.href='?page=clientEdit&id_cliente=".$row['id_cliente']."';\"
							></i>
						</td> 

						<td width='80px' align=center>".str_pad($row['id_cliente'], 6, 0, STR_PAD_LEFT)."</td>

						<td width='250px'>".$row['nm_cliente']."</td>

						<td width='80px' align=center'>".$row['cpf_cnpj']."</td>
						<td width='80px' align=center'>".$row['nm_regiao']."</td>
					</tr>";
		}
		$aux_consulta .="
					</tbody>
				</table>
			</section>";
	}
			
	$aux_saldos = str_replace(array(chr(10), chr(13)), array('',''),$aux_consulta);
	echo trim($aux_saldos);	

?>