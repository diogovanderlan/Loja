<?php
  try {
    $servidor = "localhost";
    $banco = "loja1";
    $usuario = "root";
    $senha = "root";

    $pdo = new PDO ("mysql:host=$servidor;dbname=$banco;charset=utf8","$usuario","$senha");

  } catch (PDOException $e) {
    echo "Erro de Conexão " . $e->getMessage();
    exit;
  }