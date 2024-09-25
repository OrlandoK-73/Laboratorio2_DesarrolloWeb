<?php
    if(isset($_GET["Cod"])){
        include_once("app/crud/conexion.php");
        $sql="Select codigo, descripcion, precio, observaciones from Producto where codigo='".$_GET["Cod"]."'";    
        $result=$cn->query($sql);
        $codigo=null; $nombre=null; $telefono=null;$correo=null;
        if($result->num_rows>0){
        while($row=mysqli_fetch_array($result)){
            $codigo=$row["codigo"];
            $nombre=$row["descripcion"];
            $precio=$row["precio"];
            $observacion=$row["observaciones"];
        }
        //mysqli_close($cn);
    }

    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>Productos</title>
</head>
<body>
    <div class="container">
    <div class="content">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Navbar</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li><a href="Clientes.php">Clientes</a></li>
                    <li><a href="Productos.php">Productos</a></li>
                    <li><a href="Facturas.php">Facturacion</a></li>
                </ul>
              </div>
            </div>
          </nav>
        <h1>Catalogo de Productos</h1>
        <row><button class="btn btn-primary" onclick="mostrarformulario();" id="add">Nuevo</button></row>
        <div id="form">
        <form action="app/crud/productos/crud.php" method="post">
            <label class="form-label">Codigo</label><input class="form-control" id="codigo" name="codigo" value="<?php if(isset($codigo)){echo $codigo;} else {echo "0";}   ?>"><br>
            <label class="form-label">Nombre</label><input class="form-control" type="text" id="producto" name="producto" placeholder="Nombre Producto" required value="<?php if(isset($nombre)){echo $nombre;} else {echo "";}?>"><br>
            <label class="form-label">Precio</label><input class="form-control" type="text" id="valor" name="valor" placeholder="00.00" value="<?php if(isset($precio)){echo $precio;} else {echo "";}?>"><br>
            <label class="form-label">Observacion</label><input class="form-control" type="text" id="observaciones" name="observaciones" placeholder="observaciones" value="<?php if(isset($observacion)){echo $observacion;} else {echo "";}?>"><br>
            <row>
                <button class="btn btn-primary" id="crear" name="crear" onclick="ocultarformulario();">Guardar</button>
                <button class="btn btn-warning" id="editar" name="editar" onclick="ocultarformulario();">Editar</button>
                <button class="btn btn-danger" id="eliminar" name="eliminar" onclick="ocultarformulario();">Eliminar</button>
            </row>            
        </form>    
        </div>
        <div>
        <?php include_once("app/crud/productos/listar.php");?>
        </div>

            
        
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    <script src="js/script.js"></script>
</body>
</html>