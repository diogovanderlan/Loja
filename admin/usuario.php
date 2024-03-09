<?php
	//incluir o menu
include "menu.php";

$id = $nome = $email = $cpf = $dataNasc = $dataCad = $cep = $endereco = $numero = $imagem = $idcategoria = $login =$senha = $tipo = $ativo   = "";

$dataCad = date_default_timezone_set('America/Sao_Paulo'); 
$dataCad = date("d/m/Y");

	//verificar se está editando
if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
	$id = trim( $_GET["id"] );
		//selecionar os dados do banco
	$sql = "select * from usuario where id = ? limit 1";
		//prepare
	$consulta = $pdo->prepare( $sql );
		//passar um parametro
	$consulta->bindParam( 1, $id );
		//executa
	$consulta->execute();
		//separar os dados
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	$id 			= $dados->id;
	$nome 			= $dados->nome;
	$email 			= $dados->email;
	$cpf 			= $dados->cpf;
	$dataNasc		= $dados->dataNasc;
	$dataCad 		= $dados->dataCad;
	$cep 			= $dados->cep;
	$endereco		= $dados->endereco;
	$numero 		= $dados->numero;
	$imagem 		= $dados->imagem;
	$idcategoria 	= $dados->idcategoria;
	$login 			= $dados->login;
	$senha 			= $dados->senha;
	$tipo 			= $dados->tipo;
	$ativo			= $dados->ativo;
	
	
	$dataNasc = date('d/m/Y', strtotime($dataNasc));
	$dataCad = date('d/m/Y', strtotime($dataCad));

}
?>

<div class="container">
	<div class="well">
		<h1>Cadastro de Usuários</h1>

		<a href="usuario.php" 
		class="btn btn-success pull-right">
		<i class="glyphicon glyphicon-file"></i>
		Novo Cadastro
	</a>
	<a href="listarUsuario.php" 
	class="btn btn-primary pull-right">
	<i class="glyphicon glyphicon-search"></i> Listar Cadastros
</a>

<div class="clearfix"></div>

<form name="formcadastro" method="post" action="salvarUsuario.php" novalidate enctype="multipart/form-data">
	<fieldset>
		<legend>Preencha os campos:</legend>

		<div class="control-group">
			<label for="id">ID:</label>
			<div class="controls">
				<input type="text" name="id"
				class="form-control" id="id"
				readonly
				value="<?=$id;?>">
			</div>
		</div>

		<label name="idcategoria">Selecione a Categoria</label>
		<div class="controls">
			<select name="idcategoria"
			class="form-control"
			required id="idcategoria"
			data-validation-required-message="Selecione uma Categoria">
			<option value="">
				Selecione uma Categoria
			</option>
			<?php
			$sql = "select * from categoria order by categoria";
			$consulta = $pdo->prepare($sql);
			$consulta->execute();

			while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
				$id = $dados->id;
				$categoria = $dados->categoria;

				echo "<option value='$id'>$categoria</option>"; 						
			}
			?>
		</select>
		<script type="text/javascript">
			$("#idcategoria").val('<?=$idcategoria;?>');
		</script>
	</div>

	<div class="control-group">
		<label for="nome">
		Nome do Usuário:</label>
		<div class="controls">
			<input type="text" 
			name="nome"
			class="form-control"
			required
			data-validation-required-message="Preencha o nome completo"
			value="<?=$nome;?>">
		</div>
	</div>

	<div class="control-group">
		<label for="email">
		E-mail do Usuário:</label>
		<div class="controls">
			<input type="text" 
			name="email" placeholder="exemplo@hotmail.com"
			class="form-control" 
			required
			data-validation-required-message="Preencha o e-mail"
			value="<?=$email;?>">
		</div>
	</div>

	<div class="control-group">
		<label for="cpf">
		CPF do Usuario:</label>
		<div class="controls">
			<input type="text" 
			name="cpf" placeholder="000.000.000-00"
			class="form-control" 
			required
			data-validation-required-message="Preencha o CPF"
			data-mask="999.999.999-99"
			value="<?=$cpf;?>"> 
		</div>
	</div>


	<div class="control-group">
		<label for="dataNasc">Data de Nascimento</label>
		<div class="controls">
			<input type="text" 
			name="dataNasc"
			class="form-control"
			required value="<?=$dataNasc;?>"
			data-validation-required-message="Preencha o data de Nascimento"
			data-mask="99/99/9999"
			onblur="verificaData(this.value)">
		</div>
	</div>


	<div class="control-group">
		<label for="dataNascimento">Data de Cadastro</label>
		<div class="controls">
			<input type="text" 
			name="dataCad" readonly
			class="form-control"
			required value="<?=$dataCad;?>"
			data-validation-required-message="Preencha o dataCad"
			data-mask="99/99/9999">
		</div>
	</div>	

	<div class="control-group">
		<label for="endereco">
		Endereço do Usuario:</label>
		<div class="controls">
			<input type="text" 
			name="endereco" placeholder="R. av brasil"
			class="form-control" 
			required
			data-validation-required-message="Preencha o endereço"
			value="<?=$endereco;?>">
		</div>
	</div>

	<div class="control-group">
		<label for="numero">
		Numero da Casa</label>
		<div class="controls">
			<input type="text" 
			name="numero" placeholder="N"
			class="form-control" 
			required
			data-validation-required-message="Preencha o Numero da casa"
			value="<?=$numero;?>">
		</div>
	</div>
	
	<div class="control-group">
		<label for="imagem">
			Imagem (Foto JPG com largura mínima de 800px):
		</label>
		<div class="controls">						
			<input type="file"
			name="imagem"
			class="form-control"
			>
			<input type="hidden"
			name="imagem"
			value="<?=$imagem;?>">
		</div>
	</div>
		

	<div class="control-group">
		<label for="login">
		Login do Usuário:</label>
		<div class="controls">
			<input type="text" 
			name="login" id="loginusuario"
			class="form-control"
			required onblur="verificaLogin(this.value)"
			data-validation-required-message="Preencha o login"
			value="<?=$login;?>">
		</div>
	</div>

	<div class="control-group">
		<label for="senha">
		Senha:</label>
		<div class="controls">
			<input type="password" 
			name="senha"
			class="form-control"
			<?php if ( empty ( $senha ) ) echo "required data-validation-required-message='Preencha a senha' "; ?>>
		</div>
	</div>

	<div class="control-group">
		<label for="senha">
		Re-digite a Senha:</label>
		<div class="controls">
			<input type="password" 
			class="form-control"
			data-validation-match-match="senha"
			data-validation-match-message="As senhas digitadas são diferentes"
			>
		</div>
	</div>

	<div class="control-group">
		<label for="ativo">
		Ativo:</label>
		<div class="controls">
			<select	name="ativo" id="ativo"
			class="form-control"
			required
			data-validation-required-message="Selecione o Ativo">
			<option value=""></option>
			<option value="sim">Sim</option>
			<option value="nao">Não</option>

		</select>
	</div>
	<script type="text/javascript">
		$("#ativo").val("<?=$ativo;?>");
	</script>
</div>

<div class="control-group">
	<label for="tipo">
	Tipo:</label>
	<div class="controls">
		<select	name="tipo" id="tipo"
		class="form-control"
		required
		data-validation-required-message="Selecione o Tipo">
		<option value=""></option>
		<option value="adm">Adiministrador</option>
		<option value="esp">Especialista</option>
		<option value="usu">Usuario</option>

	</select>
</div>
<script type="text/javascript">
	$("#tipo").val("<?=$tipo;?>");
</script>
</div>

<button type="submit" class="btn btn-success">Salvar Dados</button>


</fieldset>
</form>

</div>
<script type="text/javascript">
		//funcao para verificar a data
		function verificaLogin( login ) {
			//mostrar a mascara
			$("#mascara").show("fast");

			id = $("#id").val();

			if ( login != "") {
				//ajax
				$.get("login.php",
					{login:login,id:id},
					function(dados){

						if ( dados != "ok" ) {
							alert(dados);
							$("#loginusuario").focus();
							$("#loginusuario").val('');
						}
					})
			}
			$("#mascara").hide("fast");
		}
		
				//funcao para verificar a data
				function verificaData( data ) {
					//mostrar a mascara
					$("#mascara").show("fast");

					if ( data != "") {
						//ajax
						$.get("data.php",
							{data:data},
							function(dados){

								if ( dados != "ok" ) {
									alert(dados);
									$("#dataNasc").focus();
									$("#dataNasc").val('');
								}
							})
					}
					$("#mascara").hide("fast");
				}
			</script>
		</div>

	</body>
	</html>






