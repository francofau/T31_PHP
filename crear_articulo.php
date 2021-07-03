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
    <title>Crear artículo</title>
</head>
<body>
<?php 

require 'conexion/conectarBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = validate($_POST["descripcion"]);
    $precio = validate($_POST['precio']);
    $rubro = validate($_POST['codigoRubro']);
    
    $conexion = crear_conexion();
    if(!$conexion){
        die('Error de conexión');
    } else {
        $conexion->query("INSERT INTO articulos (descripcion, precio, codigoRubros) VALUES ('$nombre', '$precio', '$rubro')");
        if($conexion->error)    
            die($conexion->error);
        echo 'Articulo añadido';
        $conexion->close();
    }
}

?>
    <div class="text-center">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="mt-4">
            <label>Descripción del artículo: </label>
            <input type="text" name="descripcion"><br>
            <label>Precio: </label>
            <input type="text" name="precio"><br>
            <label for="codigorubro">Seleccione el rubro del artículo: </label>
            <select name="codigorubro" >
            <?php
                $conexion = crear_conexion();
                if(!$conexion){
                    die('Error de conexión');
                } else {
                    $registros = $conexion->query("SELECT Codigo, Descripcion FROM rubros");
                    if($conexion->error)    die();
                    
                    while ($reg = $registros->fetch_array()) {
                        echo "<option value=\"" . $reg['Codigo'] . "\">" . $reg['Descripcion'] . "</option>";
                    }
                    $conexion->close();
                }
            ?>
            </select>
            <br>
            <button type="submit" class="mt-3">Confirmar</button>
            
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