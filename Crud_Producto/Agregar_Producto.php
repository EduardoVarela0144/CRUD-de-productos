<?php 
include('../Conexion_BD.php');
$Nombre_Producto = $_POST['Nombre_Producto'];
$Precio_Producto = $_POST['Precio_Producto'];
$Stock_Producto = $_POST['Stock_Producto'];

$sql = "INSERT INTO `producto` (`Nombre_Producto`,`Precio_Producto`,`Stock_Producto`) values ('$Nombre_Producto', '$Precio_Producto', '$Stock_Producto' )";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>