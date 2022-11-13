<?php include('../Conexion_BD.php');
$ID_Producto = $_POST['ID_Producto'];
$sql = "SELECT * FROM producto WHERE ID_Producto='$ID_Producto' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
