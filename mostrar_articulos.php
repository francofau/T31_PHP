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
    <title>Listado de Artículos</title>
</head>
<body>
<?php 

    require 'conexion/conectarBD.php';

    $conexion = crear_conexion();
    if(!$conexion){
        die('Error de conexión');
    } else {
        $registros = $conexion->query("SELECT Codigo, Descripcion, Precio FROM articulos");
        if($conexion->error)    
            die();
        
        echo "<div class='text-center d-flex justify-content-center mt-3'>";
        echo '<table class="tablalistado">';
        echo '<tr><th>Código</th><th>Descripción</th><th>Precio</th></tr>';
        while ($reg = $registros->fetch_array()) {
            echo '<tr>';
            echo '<td>';
            echo $reg['Codigo'];
            echo '</td>';
            echo '<td>';
            echo $reg['Descripcion'];
            echo '</td>';
            echo '<td>';
            echo $reg['Precio'];
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
        $conexion->close();
    }
?>
     <div class="text-center">
        <div class="row mt-3">
            <div class="col-12">
                <a href="crear_articulo.php" class="btn btn-primary">Crear artículo</a>
                <a href="insertar.php" class="btn btn-primary">Nuevo rubro</a>
                <a href="borrar.php" class="btn btn-primary">Borrar rubro</a>
                <a href="modificar.php" class="btn btn-primary">Modificar rubro</a>
                <a href="mostrar_articulos.php" class="btn btn-primary">Mostrar todos los artículos</a>
            </div>
        </div>
    </div>
</body>
</html>
