
<?php
	
	$sql = "SELECT 
				id_produto, 
				descricao, 
				vr_venda, 
				nm_login, 
				dt_inc, 
				dt_atu
			FROM db_gol.tb_produto
			WHERE id_produto = ".$_GET["id_produto"]."";

	$sql_1       = utf8_encode($sql); 		
	$conexao    = new Conexao();
	$conn       = $conexao->open();
	$result     = pg_query($conn, $sql);
	$row = pg_fetch_array($result)
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
		padding: 1.5rem 2rem;
		border-radius: 10px;
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
</style>

<body>

	<div class="card">
		
			<h3>
				<script src=https://kit.fontawesome.com/88ebab1f4a.js crossorigin='anonymous'></script>	
				<script>
					String.prototype.reverse = function(){
						return this.split('').reverse().join(''); 
						};

						function mascaraMoeda(campo,evento){
						var tecla = (!evento) ? window.event.keyCode : evento.which;
						var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
						var resultado  = "";
						var mascara = "###.###.###,##".reverse();
						for (var x=0, y=0; x<mascara.length && y<valor.length;) {
							if (mascara.charAt(x) != '#') {
							resultado += mascara.charAt(x);
							x++;
							} else {
							resultado += valor.charAt(y);
							y++;
							x++;
							}
						}
						campo.value = resultado.reverse();
					}
				</script>
				
				<span>Nr. Produto: <?php print str_pad($row['id_produto'], 6, 0, STR_PAD_LEFT); ?></span>
				<div class="buttons">
					<div class="form-group">
						<button
							id='button'
							type="submit"
							class='btn btn-warning'
							onclick="location.href='?page=productConsult';">
							<i class="fa-solid fa-arrow-left"></i>
								Voltar
						</button>
					</div>

					<form action="?page=productSave" method="POST">
						<input type="hidden" name="acao" value="excluir">
						<input type="hidden" name="id_produto" value="<?php print $row['id_produto']; ?>">
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
							onclick="location.href='?page=productRegister';">
							<i class='fa-solid fa-circle-plus'></i>
								Novo
						</button>
					</div>
				</div>
			</h3>
		<form action="?page=productSave" method="POST">
			
			<input type="hidden" name="acao" value="editar">
			<input type="hidden" name="id_produto" value="<?php print $row['id_produto']; ?>">

			<div class="form-group">
				<label><b>Descrição</b></label>
				<input type="text" name="descricao" value="<?php print $row['descricao']; ?>" class="form-control">
				<label><b>Valor de Venda</b></label>
				<input type="text" name="vr_venda" onKeyUp="mascaraMoeda(this, event)" value="<?php print number_format($row['vr_venda'],2,",","."); ?>" class="form-control">
			</div>
			<button 
				id='button'
				type="submit" 
				class="btn btn-info">
				<i class="fa-solid fa-floppy-disk"></i>
					Salvar
			</button>
		</form>
		
	</div>
</form>

