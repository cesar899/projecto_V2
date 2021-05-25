<?php 
include("conexion.php");

// leer
$sql_leer = 'SELECT * FROM productos';
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();
$resultado = $gsent->fetchall();

// agregar
if ($_POST){
	$producto = $_POST['producto'];
	$cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];
  $stock = $_POST['stock'];

	$sql_agregar = 'INSERT INTO productos (producto,cantidad,precio,stock) VALUES (?,?,?,?)';
	$sentencia_agregar = $pdo->prepare($sql_agregar);
	$sentencia_agregar->execute(array($producto,$cantidad,$precio,$stock));

	header('location:index.php');
}
if ($_GET) {
	$id = $_GET['id'];
	$sql_unico = 'SELECT * FROM `productos` WHERE id=?';
  $gsent_unico = $pdo->prepare($sql_unico);
  $gsent_unico ->execute(array($id));
  $resultado_unico = $gsent_unico->fetch();

    
}

    
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/all.css" integrity="sha512-ajhUYg8JAATDFejqbeN7KbF2zyPbbqz04dgOLyGcYEk/MJD3V+HJhJLKvJ2VVlqrr4PwHeGTTWxbI+8teA7snw==" crossorigin="anonymous" />

     <title>crud productos</title>
  </head>
  <body>
  
   <div class="container mt-5">
    <div class="row">
  		
   <div class="col-md-6">
 
  	<?php foreach($resultado as $dato): ?>

  	 <div 
  	   class="alert alert-primary text-uppercase"
       role="alert">
  	  
        <?php echo $dato['producto'] ?>
        -
        <?php echo $dato['cantidad'] ?>
        -
        <?php echo $dato['precio'] ?>
        -
        <?php echo $dato['stock'] ?>

        <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="float-rightml-3 "  >
          <i class="far fa-trash-alt"></i>
        </a>

        <a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right">
         	<i class="fas fa-pencil-alt"></i>
        </a>

     </div>

     <?php endforeach ?>

 </div>

     <div class="col-md-6">
      <?php if(!$_GET):?>
     	 <h2>AGREGAR PRODUCTO</h2>
     	
        <form method="POST">
        
          <label for="producto">producto:</label>
     		  <input type="text" class="form-control" name="producto">

          <label for="cantidad">cantidad:</label>
     		  <input type="text" class="form-control mt-3"
     		  name="cantidad" required>

          <label for="precio">precio:</label>
          <input type="text" class="form-control mt-3"
          name="precio" required>

          <label for="precio">stock:</label>
          <input type="text" class="form-control mt-3"
          name="stock" required>

     		 <button class="btn btn-primary mt-3">agregar</button>
     	  </form>
     
      <?php endif ?>

    <?php if($_GET):?>
     	<h2>EDITAR PRODUCTOS</h2>
     	<form method="GET" action="editar.php">
     		
        <input type="text" class="form-control" name="producto" 
     		value="<?php echo $resultado_unico['producto']?>">
     		
        <input type="text" class="form-control mt-3"
     		name="cantidad"
     		value="<?php echo $resultado_unico['cantidad']?>">
       
        <input type="text" class="form-control mt-3"
        name="precio"
        value="<?php echo $resultado_unico['precio']?>">
       
        <input type="text" class="form-control mt-3"
        name="stock"
        value="<?php echo $resultado_unico['stock']?>">
     		
        <input type="hidden" name="id"
     		value="<?php echo $resultado_unico['id']?>">
     		
        <button class="btn btn-primary mt-3">agregar</button>
     	</form>
    <?php endif ?>

         </div>

     </div>
 
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>