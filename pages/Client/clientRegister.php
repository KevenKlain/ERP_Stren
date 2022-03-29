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
					function mascaraMutuario(o,f){
						v_obj=o
						v_fun=f
						setTimeout('execmascara()',1)
					}
					
					function execmascara(){
						v_obj.value=v_fun(v_obj.value)
					}
					
					function cpfCnpj(v){
					
						//Remove tudo o que não é dígito
						v=v.replace(/\D/g,"")
					
						if (v.length > 0 && v.length <= 11) { //CPF
							v=v.replace(/(\d{3})(\d)/,"$1.$2")
							v=v.replace(/(\d{3})(\d)/,"$1.$2")
							v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
					
						} else { //CNPJ
					
							v=v.replace(/^(\d{2})(\d)/,"$1.$2");
							v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3");
							v=v.replace(/\.(\d{3})(\d)/,".$1/$2");
							v=v.replace(/(\d{4})(\d)/,"$1-$2");
					
						}
					
						return v
					
					}
				</script>
				<span>Nr. Cliente: <?php print str_pad($row['id_cliente'], 6, 0, STR_PAD_LEFT); ?></span>
				
				<div class='buttons'>
					<div class="form-group">
						<button
							id='button'
							type="submit"
							class='btn btn-warning'
							onclick="location.href='?page=clientConsult';">
							<i class="fa-solid fa-arrow-left"></i>
								Voltar
						</button>
					</div>
					
				</div>	
			</h3>	
		<form action="?page=clientSave" method="POST">
			
			<input type="hidden" name="acao" value="cadastrar">
			<input type="hidden" name="id_cliente" value="<?php print $row['id_cliente']; ?>">
			<div class="form-group">
				<label><b>Nome do Cliente</b></label>
				<input type="text" name="nm_cliente" class="form-control">
				<label><b>CPF/CNPJ</b></label>
				<input type="text" name="cpf_cnpj" onkeypress='mascaraMutuario(this,cpfCnpj)' maxlength="18" class="form-control">
				<label><b>Região</b></label>
				<input type="text" name="nm_regiao" class="form-control">
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