<?php
	$id_venda = $_POST["id_venda"];
    $id_item = $_POST["id_item"];
    if($_POST["id_venda"] > 0){
		$id_venda = $_POST["id_venda"];
        $id_item = 0;
	}else{
		$id_venda = $_GET["id_venda"];
        $id_item = $_GET["id_item"];
	}
	$sql = "SELECT 
				id_item
				, descricao
				, vr_venda
				, nu_quantidade
				, vr_total
			FROM db_gol.tb_venda_item
			WHERE id_venda = ".$id_venda."
            AND id_item = ".$id_item;
    

	$sql_1      = utf8_encode($sql); 		
	$conexao    = new Conexao();
	$conn       = $conexao->open();
	$result     = pg_query($conn, $sql_1);
	$row = pg_fetch_array($result);

	$sql_cliente = "SELECT 
                        descricao
                    FROM db_gol.tb_produto";

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

	#button_plus {
		border-radius: 15px;
		margin: 2px; 
		
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
				<div class="buttons">
					<div class="form-group">
                        <form action="?page=saleEdit" method="POST">
                            <input type="hidden" name="id_venda" value="<?php print $id_venda; ?>">
                            <button
                                id='button'
                                type="submit"
                                class='btn btn-warning'
                                onclick="location.href='?page=saleConsult';">
                                <i class="fa-solid fa-arrow-left"></i>
                                    Voltar
                            </button>
                        </form>
					</div>
				</div>
			</h3>
		<form action="?page=itemSave" method="POST">
			
			<input type="hidden" name="acao" value="cadastrar">
			<input type="hidden" name="id_venda" value="<?php print $id_venda; ?>">
			<div class="form">
				<label><b>Produto</b></label>
				<input type="text" name="descricao" placeholder="Descrição" value="<?php print $row['descricao']; ?>" list="cliente" class="form-control">
				<datalist id="cliente">
					<?php while($row2 = pg_fetch_array($result2)) { ?>
						<option>
								<?php print $row2["descricao"]?>  
						</option>
					<?php }?>
				</datalist>
                <label><b>Quantidade</b></label>
                <input type="number" name="nu_quantidade" placeholder="0" value="<?php print $row['nu_quantidade']; ?>" class="form-control">
                <label><b>Valor do Produto</b></label>
				<input type="text" name="vr_venda" onKeyUp="mascaraMoeda(this, event)" value="<?php print $row['vr_venda']; ?>" placeholder="0,00" class="form-control">

			</div>
           
			<button
                id='button_plus'
                type="submit" 
                class="btn btn-success">
                <i class="fa-solid fa-circle-plus"></i>
                    Adicionar
            </button>
			
		</form>
		
	</div>
</form>