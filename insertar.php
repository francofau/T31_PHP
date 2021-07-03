<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS propio -->
    <link rel="stylesheet" href="css/styles.css">
    <title>Nuevo Item</title>
</head>
<body>
<?php 

    require 'conexion/conectarBD.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = validate($_POST["descripcion"]);
        
        $conexion = crear_conexion();
        if(!$conexion){
            die('Error de conexión');
        } else {
            $conexion->query("INSERT INTO rubros (descripcion) VALUES ('$nombre')");
            if($conexion->error)    die();
            echo 'Nuevo Rubro añadido';
            $conexion->close();
        }
    }

?>
    <div class="text-center">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <label>Descripción de nuevo rubro: </label>
            <input type="text" name="descripcion">
            <button type="submit">Agregar</button>

            <div class="row mt-3">
                <div class="col-12">
                    <a href="crear_articulo.php" class="btn btn-primary">Crear artículo</a>
                    <a href="insertar.php" class="btn btn-primary">Nuevo rubro</a>
                    <a href="borrar.php" class="btn btn-primary">Borrar rubro</a>
                    <a href="modificar.php" class="btn btn-primary">Modificar rubro</a>
                    <a href="mostrar_articulos.php" class="btn btn-primary">Mostrar todos los artículos</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>