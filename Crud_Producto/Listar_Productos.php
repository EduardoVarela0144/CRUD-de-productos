<?php include('../Conexion_BD.php');

$output= array();
$sql = "SELECT * FROM producto ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'ID_Producto',
	1 => 'Nombre_Producto',
	2 => 'Precio_Producto',
	3 => 'Stock_Producto',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE ID_Producto like '%".$search_value."%'";
	$sql .= " OR Nombre_Producto like '%".$search_value."%'";
	$sql .= " OR Precio_Producto like '%".$search_value."%'";
	$sql .= " OR Stock_Producto like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY ID_Producto desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['ID_Producto'];
	$sub_array[] = $row['Nombre_Producto'];
	$sub_array[] = $row['Precio_Producto'];
	$sub_array[] = $row['Stock_Producto'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['ID_Producto'].'"  class="btn btn-info btn-sm editbtn" >Editar</a>  <a href="javascript:void();" data-id="'.$row['ID_Producto'].'"  class="btn btn-danger btn-sm deleteBtn" >Eliminar</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
