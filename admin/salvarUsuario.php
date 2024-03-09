<?php

include "menu.php";
	//verificar se foi post
if ( $_POST ) {		

	$nomef = "";		
	if ( ! empty ($_FILES["imagem"]["name"] ) ) {

		$tipo = $_FILES["imagem"]["type"];
		$tamanho = $_FILES["imagem"]["size"];

			// bytes em kbytes
		$tamanho = $tamanho / 1024;

			//formatar o tamanho
		$tamanho = number_format( 
			$tamanho, 
			3, 
			".", 
			"" 
		);

			//verificar se é um arquivo JPG
		if ( $tipo != "image/jpeg" ) {
			echo "<script>alert('Você pode enviar somente arquivos JPG. Formato enviado $tipo.');history.back();</script>";
		} else if ( $tamanho > 1024 ) {

			echo "<script>alert('Envie imagens de até 1 MB. Tamanho da imagem atual $tamanho Kb');history.back();</script>";
		} else if ( !copy( 
			$_FILES["imagem"]["tmp_name"], 
			"../fotos/" . $_FILES["imagem"]["name"] ) ) {

			echo "<script>alert('Erro ao copiar arquivo');history.back();</script>";
		} else {

				//incluir o arquivo com a funcao
			include "../config/imagem.php";
			
			$pastaFotos = "../fotos/";
			$imagem = $pastaFotos . $_FILES["imagem"]["name"];
			$nomef = time();
			
				//echo $nome;

			LoadImg($imagem,$nomef,$pastaFotos);

		}
	} else if ( !empty ( $_POST["imagem"] ) ){

		$nomef = trim ( $_POST["imagem"] );

	} 


		//recuperar os dados do formulário
		//print_r( $_POST );
	$id = trim( $_POST["id"] );
	$nome = trim( $_POST["nome"] );
	$email = trim( $_POST["email"] );
	$cpf = trim( $_POST["cpf"] );
	$dataNasc = trim( $_POST["dataNasc"]);
	$dataCad = trim( $_POST["dataCad"] );
	$cep = trim( $_POST["cep"] );
	$endereco = trim( $_POST["endereco"] );
	$numero = trim( $_POST["numero"] );
	$idcategoria = trim( $_POST["idcategoria"] );
	$login = trim( $_POST["login"] );
	$senha = trim( $_POST["senha"] );
	$tipo = trim( $_POST["tipo"]);
	$ativo = trim( $_POST["ativo"] ); 

	
	$imagem = $nomef;
	$dataNasc = formatardata( $dataNasc );
	$dataCad = formatardata( $dataCad );	

		//verificar se o campo esta em branco
	if ( empty( $nome ) ) {
			//mensagem com o javascript
		echo "<script>alert('Preencha o nome');history.back();</script>";
	} else if ( empty( $email ) ) {
			//mensagem com o javascript
		echo "<script>alert('Preencha o e-mail');history.back();</script>";
	}  else if ( empty( $login ) ) {
			//mensagem com o javascript
		echo "<script>alert('Preencha o login');history.back();</script>";
	}  else if ( empty( $ativo ) ) {
			//mensagem com o javascript
		echo "<script>alert('Selecione o campo ativo');history.back();</script>";
	} else {

			//verificar se o registro já existe
		$sql = "select * from usuario
		where login = ? and id <> ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $login);
		$consulta->bindParam(2, $id);
		$consulta->execute();
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		if ( !empty( $dados->id ) ) {
				//já existe um registro cadastrado
			echo "<script>alert('Já existe um cadastro com este Login');history.back();</script>";
			exit;

		}

			//criptografar senha se não estiver vazia
		if ( ! empty ( $senha ) ) $senha = md5( $senha );

			//verificar se o id esta vazio - insert
		if ( empty ( $id ) ) {
				//gravar no banco de dados
			$sql = "insert into usuario (id, nome, email, cpf, dataNasc, dataCad, cep, endereco, numero, imagem, idcategoria, login, senha, tipo, ativo)
			values (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$consulta = $pdo->prepare($sql);
				//passar o parametro
			$consulta->bindParam(1, $nome);
			$consulta->bindParam(2, $email);
			$consulta->bindParam(3, $cpf);
			$consulta->bindParam(4, $dataNasc);
			$consulta->bindParam(5, $dataCad);
			$consulta->bindParam(6, $cep);
			$consulta->bindParam(7, $endereco);
			$consulta->bindParam(8, $numero);
			$consulta->bindParam(9, $imagem);
			$consulta->bindParam(10, $idcategoria);
			$consulta->bindParam(11, $login);
			$consulta->bindParam(12, $senha);
			$consulta->bindParam(13, $tipo);
			$consulta->bindParam(14, $ativo);
	
		} else {
			
			if ( empty ( $senha ) ) {
					//dar update
				$sql = "update usuario 
				set nome = ?, email = ?, cpf = ?, dataNasc = ?, dataCad = ?, cep = ?, endereco = ?, numero = ?, imagem = ?, idcategoria = ?, login = ?, tipo = ?, ativo = ?
				where id = ? 
				limit 1";
				$consulta->bindParam(1, $nome);
				$consulta->bindParam(2, $email);
				$consulta->bindParam(3, $cpf);
				$consulta->bindParam(4, $dataNasc);
				$consulta->bindParam(5, $dataCad);
				$consulta->bindParam(6, $cep);
				$consulta->bindParam(7, $endereco);
				$consulta->bindParam(8, $numero);
				$consulta->bindParam(9, $imagem);
				$consulta->bindParam(10, $idcategoria);
				$consulta->bindParam(11, $login);
				$consulta->bindParam(12, $tipo);
				$consulta->bindParam(13, $ativo);
				$consulta->bindParam(14, $id );
			} else {
					//dar update
				$sql = "update usuario 
				set nome = ?, email = ?, cpf = ?, dataNasc = ?, dataCad = ?, cep = ?, endereco = ?, numero = ?, imagem = ?, idcategoria = ?, login = ?, senha = ?, tipo = ?, ativo = ? 
				where id = ? 
				limit 1";
				$consulta = $pdo->prepare( $sql );
				$consulta->bindParam(1, $nome);
				$consulta->bindParam(2, $email);
				$consulta->bindParam(3, $cpf);
				$consulta->bindParam(4, $dataNasc);
				$consulta->bindParam(5, $dataCad);
				$consulta->bindParam(6, $cep);
				$consulta->bindParam(7, $endereco);
				$consulta->bindParam(8, $numero);
				$consulta->bindParam(9, $imagem);
				$consulta->bindParam(10, $idcategoria);
				$consulta->bindParam(11, $login);
				$consulta->bindParam(12, $senha);
				$consulta->bindParam(13, $tipo);
				$consulta->bindParam(14, $ativo);
				$consulta->bindParam(15, $id );
			}

		}

			//verificar se executou corretamente
		if ( $consulta->execute() ) {

			echo "<script>alert('Registro Salvo');location.href='listarUsuario.php';</script>";

		} else {

			echo "<script>alert('Erro ao Salvar');history.back();</script>";

		}
	}
} else {

		//mensagem de erro ao acessar diretamente o arquivo
	echo "<div class='alert alert-danger container'>
	ERRO: tentativa inválida</div>";

}

?>

</body>
</html>