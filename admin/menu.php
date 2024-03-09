<?php
  //iniciar a sessao
session_start();

if ( !isset( $_SESSION["admin"]["id"] ) ) {
    //direcionar para o index
  header( "Location: index.php" );
}

  //incluir o arquivo para conectar no banco
include "conecta.php";

  //funcao para formatar datas 
function formatardata($data) {
    // 29/09/2017 -> 2017-09-29
  $data = explode( "/", $data );
  $data = $data[2]."-".$data[1]."-".$data[0];
  return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Loja</title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    $(function () {
      //validação dos campos
      $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
    } );
  </script>
 
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">Vantech</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cadastros
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="usuarios.php">Usuarios</a></li>
            <li><a class="dropdown-item" href="#">Clientes</a></li>
            <li><a class="dropdown-item" href="#">Entregadores</a></li>
            <li><a class="dropdown-item" href="cadastroprodutos">Produtos</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">relatorios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sair.php" id="sair" > Olá <?php echo $_SESSION["admin"]["login"];?>
        - Sair</a>
        </li>
     
        
      </ul>
    </div>
  </div>
</nav>