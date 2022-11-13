

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/Header.css" />
</head>
<body>
<div class="header">
  <a href="#' class="logo">ULSA FOOD</a>
  <div class="header-right">
    <a class="active" href="#">Inicio</a>
    <a href="index.php">Productos</a>
    <a href="#">Clientes</a>
    <a href="Venta.php">Venta</a>
    <a href="">Reporte de ventas</a>
    <a href="#">Empleado</a>
  </div>
</div>
  <div class="container-fluid">
  <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
        <form id="addVenta" action="">
            <div class="mb-3 row">
              <label for="addNombre_Producto" class="col-md-3 form-label">Producto</label>
              <div class="col-md-9">
                <select  class="form-control" id="addNombre_Producto" name="Nombre">
                
                    
                <option disabled selected>Selecciona una opción</option>

                <?php   
                require 'Conexion_BD.php';
                $sql = "select * from producto order by Nombre_Producto";
                $query = mysqli_query($con,$sql);
                while ($row = mysqli_fetch_assoc($query)) {   
                    $ID_Producto = $row['ID_Producto']; 
                    $Nombre_Producto = $row['Nombre_Producto'];    
                    echo "<option value='$ID_Producto'>$Nombre_Producto</option>";
                  }
                ?>
                </select>
              </div>
            </div>
            
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Realizar Venta</button>
            </div>
        </form>
</div>
</div>
</div>

</body>
</html>