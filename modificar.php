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
    <title>Modificar Item</title>
</head>
<body>
<?php 
   

    if(empty($_SESSION['modifying'])){
        $_SESSION["modifying"] = false;
    }

    require 'conexion/conectarBD.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION["modifying"] == false){
        $codigo = validate($_POST["Codigo"]);
        
        $conexion = crear_conexion();
        if(!$conexion){
            die('Error de conexión');
        } else {
            $registro = $conexion->query("SELECT Descripcion FROM rubros WHERE Codigo='$codigo'");
            if($conexion->error)    
                die();
            
            if($reg = $registro->fetch_array()){
                $_SESSION["modifying"] = true;
            } else {
                echo 'No existe un rubro con ese código';
            }
            
            $conexion->close();
        }
    } else if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION["modifying"] == true){
            $codigo = validate($_POST["Codigo"]);
            $descripcion = validate($_POST["Descripcion"]);
            
            // Si la conexión a la base de datos da error, entonces...
            $conexion = crear_conexion();
            if(!$conexion){
                die('Ha habido un error, intente más tarde');
            } else {
                $registro = $conexion->query("UPDATE rubros SET Descripcion='$descripcion' WHERE Codigo='$codigo'");
                if($conexion->error)    die();
                echo 'Se modificó la descripcion del rubro';
                session_destroy();
            }
            $conexion->close();
    }
?>
    <div class="text-center">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="mt-4">
            
            <?php if(!isset($reg)): ?>
                <label>Ingrese el código del rubro a modificar: </label>
                <input type="text" name="Codigo">
            <?php else:?>
                <label>Código del rubro que quiere modificar </label>
                <input type="text" name="Codigo" readonly value="<?php echo $_REQUEST['Codigo']; ?>">

                <label>Descripción de rubro: </label>
                <input type="text" name="descripcion" value="<?php echo $reg['Descripcion']; ?>">
            <?php endif;?>


            <button type="submit">Modificar</button>
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


