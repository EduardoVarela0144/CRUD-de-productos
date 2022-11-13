<?php 
include('../Conexion_BD.php');
$Nombre_Producto = $_POST['Nombre_Producto'];
$Precio_Producto = $_POST['Precio_Producto'];
$Stock_Producto = $_POST['Stock_Producto'];
$ID_Producto= $_POST['ID_Producto'];

$sql = "UPDATE `producto` SET  `Nombre_Producto`='$Nombre_Producto' , `Precio_Producto`= '$Precio_Producto', `Stock_Producto`='$Stock_Producto' WHERE ID_Producto='$ID_Producto' ";
$query= mysqli_query($con,$sql);

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