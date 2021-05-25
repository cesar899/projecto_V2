<?php

$id = $_GET['id'];
$producto = $_GET['producto'];
$cantidad= $_GET['cantidad'];
$precio = $_GET['precio'];
$stock = $_GET['stock'];


include_once 'conexion.php';

$sql_editar = 'UPDATE productos SET producto=?, cantidad=?, precio=?, stock=?  WHERE id=?';
$sentencia_editar = $pdo->prepare($sql_editar);
$sentencia_editar->execute(array($producto,$cantidad,$precio,$stock,$id));

header('location:index.php');
?>