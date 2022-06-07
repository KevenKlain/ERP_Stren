
<?php
	
	
	$sql_cliente = "SELECT 
						id_cliente,
						nm_cliente
					FROM db_gol.tb_cliente";

	$sql_2      = utf8_encode($sql_cliente); 		
	$conexao    = new Conexao();
	$conn       = $conexao->open();
	$result2    = pg_query($conn, $sql_2);
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

	#button 
	{
		border-radius: 15px;
		margin: 2px; 
	}
		
	.buttons {
		display: flex;
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
				
				<span>Nr. Venda: <?php print str_pad($row['id_cliente'], 6, 0, STR_PAD_LEFT); ?></span>
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
						
					</form>
					
					<div class="form-group">
						
					</div>
				</div>
			</h3>
		<form action="?page=saleSave" method="POST">
			
			<input type="hidden" name="acao" value="cadastrar">
			<input type="hidden" name="id_cliente" value="<?php print $row['id_cliente']; ?>">
			<input type="hidden" name="lo_status" value="Aberto">
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

			</div>
			<button 
				id='button'
				type="submit" 
				class="btn btn-success">
				<i class="fa-solid fa-circle-plus"></i>
					Incluir
			</button>
		</form>
	</div>
</form>

