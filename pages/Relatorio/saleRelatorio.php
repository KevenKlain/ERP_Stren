
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

		#status_pago{
			color: green;
		}

		#status_pendente{
			color: red;
		}

		.card {
			background: white;
			border-radius: 10px;
		}
		
		.card h3 {
			font-weight: bold;
			font-size: 20px;
			margin: 5px;
			display: flex;
			align-items: center;
			justify-content: space-between;
		}
		
		.card p {
			   font-size: 10px;
			   
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
					onclick=\"location.href='?page=saleRegister';\">
					<i class='fa-solid fa-circle-plus'></i>
						Novo
				</button>

				<div class='submit-line'>
					<form action='?page=saleConsult' method='POST' class='form-inline my-2 my-lg-0'>
					<input type='text' name='pesquisa' class='form-control' placeholder='Nr. Venda'/>
					<button class='submit-lente' type='submit'>
						<i class='fa fa-search'></i>
					</button>
				</div>
			</div>
			
			<section id='transaction'>
			<table id='data-table'>
				<thead>
					<tr>
						<th id='id_item'>Nr. Venda</th>
						<th>Cliente</th>
						<th>Data da Venda</th>
						<th>Valor Total</th>
						<th>Situação</th>
					</tr>
				</thead>
				<tbody>";
	
	
		$sql = "SELECT 
					a.id_venda, 
					a.nm_cliente, 
					SUM(b.vr_total) as vr_total, 
					a.lo_status, 
					a.nm_login, 
					a.dt_inc, 
					a.dt_atu
				FROM db_gol.tb_venda a
				JOIN db_gol.tb_venda_item b
				ON a.id_venda = b.id_venda
				GROUP BY 1,2,4,5,6,7
				ORDER BY dt_inc DESC";


	$sql_1       = utf8_encode($sql); 		
	$conexao    = new Conexao();
	$conn       = $conexao->open();
	$result     = pg_query($conn, $sql);
	

	if(pg_num_rows($result) >= 1){
		
		while($row = pg_fetch_array($result)){
			$envio = strtotime($row['dt_inc']);
			$data = date("d/m/Y", $envio);

			$aux_consulta .= "
			<tr>

				<td width='80px' align=center>".str_pad($row['id_venda'], 6, 0, STR_PAD_LEFT)."</td>

				<td width='400px'>".$row['nm_cliente']."</td>

				<td width='80px' align=center'>".$data."</td>
				<td width='80px' align=center'>".'R$ '.number_format($row['vr_total'],2,",",".")."</td>";
				
				if($row['lo_status'] == 'Pago'){
					$aux_consulta .=
					"<td width='80px' id='status_pago' align=center'>".$row['lo_status']."</td>
				</tr>";
				}else{
					$aux_consulta .=
					"<td width='80px' id='status_pendente' align=center'>".$row['lo_status']."</td>
				</tr>";
				}
		}
		$aux_consulta .="
					</tbody>
				</table>
			</section>";
	}
			
	$aux_saldos = str_replace(array(chr(10), chr(13)), array('',''),$aux_consulta);
	echo trim($aux_saldos);	

?>