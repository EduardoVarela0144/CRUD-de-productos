<?php 
include('../Conexion_BD.php');

$ID_Producto = $_POST['ID_Producto'];
$sql = "DELETE FROM producto WHERE ID_Producto='$ID_Producto'";
$delQuery =mysqli_query($con,$sql);
if($delQuery==true)
{
	 $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);
} 

?>