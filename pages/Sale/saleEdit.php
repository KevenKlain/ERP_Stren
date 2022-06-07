
<?php
	if($_POST["id_venda"] > 0){
		$id_venda = $_POST["id_venda"];
	}else{
		$id_venda = $_GET["id_venda"];
	}
	$sql = "SELECT 
				id_venda, 
				nm_cliente, 
				vr_total, 
				lo_status, 
				nm_login, 
				dt_inc, 
				dt_atu
			FROM db_gol.tb_venda
			WHERE id_venda = ".$id_venda;
	
	$sql_1      = utf8_encode($sql); 		
	$conexao    = new Conexao();
	$conn       = $conexao->open();
	$result     = pg_query($conn, $sql_1);
	$row = pg_fetch_array($result);

	$sql_cliente = "SELECT 
						id_cliente,
						nm_cliente
					FROM db_gol.tb_cliente";

	$sql_2      = utf8_encode($sql_cliente); 		
	$conexao    = new Conexao();
	$conn       = $conexao->open();
	$result2    = pg_query($conn, $sql_2);


	$sql_valor = "SELECT 
						SUM(vr_total) AS vr_total
					FROM db_gol.tb_venda_item 
					WHERE id_venda =".$id_venda;

	$sql_3      = utf8_encode($sql_valor); 		
	$conexao    = new Conexao();
	$conn       = $conexao->open();
	$result3    = pg_query($conn, $sql_3);
	$row3 = pg_fetch_array($result3);
?>
<style>
	body {
		background: #f1f2f3;
	}

	.card {
		background: white;
		padding: 1.5rem 2rem;
		border-radius: 10px;
		border:none;

		margin-bottom: 2rem;
		-moz-box-shadow:    3px 3px 5px 6px #ccc;
		-webkit-box-shadow: 3px 3px 5px 6px #ccc;
		box-shadow:         3px 3px 5px 6px #ccc;

		color: var(--dark-blue);
	}

	.card h3 {
		font-weight: normal;
		font-size: 25px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin: 10px 0px 20px;
	}

	.card p {
		font-size: 2rem;
		line-height: 3rem;
		margin-top: 1rem;
	}

	.form-control {
		background: white;
		border-radius: 10px;
		padding: 1.5rem 2rem;
		border:none;
		margin-bottom: 2rem;
		-moz-box-shadow:    3px 3px 5px 6px #ccc;
		-webkit-box-shadow: 3px 3px 5px 6px #ccc;
		box-shadow:         3px 3px 5px 6px #ccc;
		color: #000000;
	}

	.form-control2 {
		background: white;
		border-radius: 10px;
		padding: 5px;
		border:none;
		margin-bottom: 1rem;
		-moz-box-shadow:    3px 3px 5px 6px #ccc;
		-webkit-box-shadow: 3px 3px 5px 6px #ccc;
		box-shadow:         3px 3px 5px 6px #ccc;
		color: #000000;
	}

	#button 
	{
		border-radius: 15px;
		margin: 2px; 
	}
		
	.buttons {
		display: flex;
	}

	.buttons_valor {
		display: flex;
		justify-content: space-between;
	}

	#button_plus {
		border-radius: 15px;
		margin: 2px; 
		
	}

	
	.h2, h2 {
    font-size: 2rem;
    color: green;
}

	/* Modal ===================== */
	.modal-overlay {
		width: 100%;
		height: 100%;

		background-color: rgba(0,0,0,0.7);

		position: fixed;
		top: 0;

		display:flex;
		align-items: center;
		justify-content: center;

		opacity: 0;
		visibility: hidden;

		z-index: 999;
	}

	.modal-overlay.active {
		opacity: 1;
		visibility: visible;
	}

	.modal {
		background: #F0F2f5;
		padding: 2.4rem;

		position: relative;
		z-index: 1;
	}


	/* Form ===================== */
	#form {
		max-width: 500px;
	}

	#form h2 {
		margin-top: 0;
	}

	input {
		border: none;
		border-radius: 0.2rem;

		padding: 0.8rem;

		width: 100%;
	}

	.input-group {
		margin-top: 0.8rem;
	}

	.input-group .help{
		opacity: 0.4;
	}

	.input-group.actions {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.input-group.actions .button,
	.input-group.actions button {
		width: 48%;
	}

	
</style>

<body>

	<div class="card">
		
			<h3>
				<script src=https://kit.fontawesome.com/88ebab1f4a.js crossorigin='anonymous'></script>	
				
				<span>Nr. Venda: <?php print str_pad($row['id_venda'], 6, 0, STR_PAD_LEFT); ?></span>
				<div class="buttons">
					<div class="form-group">
						<button
							id='button'
							type="submit"
							class='btn btn-warning'
							onclick="location.href='?page=saleConsult';">
							<i class="fa-solid fa-arrow-left"></i>
								Voltar
						</button>
					</div>

					<form action="?page=saleSave" method="POST">
						<input type="hidden" name="acao" value="excluir">
						<input type="hidden" name="id_venda" value="<?php print $row['id_venda']; ?>">
						<div class="form-group">
							<button 
								id='button'
								type="submit"
								class="btn btn-danger">
								<i class="fa-solid fa-trash-can"></i>
									Excluir
							</button>
						</div>
					</form>
					
					<div class="form-group">
						<button
							id='button'
							type="submit"
							class='btn btn-success'
							onclick="location.href='?page=saleRegister';">
							<i class='fa-solid fa-circle-plus'></i>
								Novo
						</button>
					</div>
				</div>
			</h3>
		<form action="?page=saleSave" method="POST">
			
			<input type="hidden" name="acao" value="editar">
			<input type="hidden" name="id_venda" value="<?php print $row['id_venda']; ?>">
			<div class="form">
				<label><b>Nome do Cliente</b></label>
				<input type="text" name="nm_cliente" value="<?php print $row['nm_cliente']; ?>" list="cliente" class="form-control">
				<datalist id="cliente">
					<?php while($row2 = pg_fetch_array($result2)) { ?>
						<option>
								<?php print $row2["nm_cliente"]?>  
						</option>
					<?php }?>
				</datalist>
				<select name="lo_status" class="form-control2" value="<?php print $row['lo_status'];?>">
						<option value=""><?php print $row['lo_status'];?></option>
						<option value="Pago">Pago</option>
						<option value="Aberto">Aberto</option>
				</select>
			</div>
			<div class="buttons_valor">
				<button 
					id='button'
					type="submit" 
					class="btn btn-info">
					<i class="fa-solid fa-floppy-disk"></i>
						Salvar
				</button>
				
				<h2 id="valor_total"><?php print 'R$ '.number_format($row3['vr_total'],2,",","."); ?></h2>
				
			</div>
			
		</form>
		<form action="?page=itemSale" method="POST">
			<input type="hidden" name="id_venda" value="<?php print $row['id_venda']; ?>">
				<div class="buttons_valor">
					<button
						id='button_plus'
						type="submit" 
						class="btn btn-success">
						<i class="fa-solid fa-circle-plus"></i>
							Item
					</button>
					
				</div>
			
		</form>
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
					box-shadow: 1px 5px 1px #ccc;
					
				
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
				
					
					
					<section id='transaction'>
					<table id='data-table'>
						<thead>
							<tr>
								<th></th>
								<th id='id_item'>Nr. Item</th>
								<th>Descrição Produto</th>
								<th>Vr. Venda</th>
								<th>Quantidade</th>
								<th>Vr. Total</th>
							</tr>
						</thead>
						<tbody>";
			
			
			$sql = "SELECT 
				id_item
				, id_venda
				, descricao
				, vr_venda
				, nu_quantidade
				, vr_total
			FROM db_gol.tb_venda_item
			WHERE id_venda = ".$id_venda;

			$sql_1       = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql);
			

			if(pg_num_rows($result) >= 1){
				
				while($row = pg_fetch_array($result)){
					$envio = strtotime($row['dt_inc']);
					$data = date("d/m/Y", $envio);
					$id_venda = $row['id_venda'];
					$id_item = $row['id_item'];

					$aux_consulta .= "
					<tr>
						<td width='10px' align=center>
							<form action='?page=itemSave' method='POST'>
								<input type='hidden' name='acao' value='excluir'>
								<input type='hidden' name='id_venda' value='".$id_venda."' list='cliente' class='form-control'>
								<input type='hidden' name='id_item' value='".$id_item."' list='cliente' class='form-control'>
								<div class='form-group'>
									<button 
										id='button'
										type='submit'
										class='btn btn-danger'>
										<i class='fa-solid fa-trash-can'></i>
											
									</button>
								</div>
							</form>
							<form action='?page=itemSave' method='POST'>
						</td> 

						<td width='80px' align=center>".$row['id_item']."</td>

						<td width='300px'>".$row['descricao']."</td>
						
						<td width='80px' align=center'>".'R$ '.number_format($row['vr_venda'],2,",",".")."</td>
						<td width='80px' align=center>".$row['nu_quantidade']."</td>
						<td width='80px' align=center'>".'R$ '.number_format($row['vr_total'],2,",",".")."</td>
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
	</div>
</form>

