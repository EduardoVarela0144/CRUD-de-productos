<?php include('Conexion_BD.php'); ?>
<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <link rel="stylesheet" type="text/css" href="css/Header.css" />
  <title>Control de productos</title>
  <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
  </style>
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
  
    <h2 class="text-center">Bienvenido</h2>
    <p class="datatable design text-center">Control de productos</p>
    
    <div class="row">
      <div class="container">
        <div class="btnAdd">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm">Agregar Producto</a>
        </div>
        
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table id="example" class="table">
              <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Opciones</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'Crud_Producto/Listar_Productos.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [4]
          },

        ]
      });
    });
    $(document).on('submit', '#addProducto', function(e) {
      e.preventDefault();
      
      var Nombre = $('#addNombre_Producto').val();
      var Precio = $('#addPrecio_Producto').val();
      var Stock =  $('#addStock_Producto').val();
      if (Nombre != '' && Precio != '' && Stock != '') {
        $.ajax({
          url: "Crud_Producto/Agregar_Producto.php",
          type: "post",
          data: {
            Nombre_Producto: Nombre,
            Precio_Producto: Precio,
            Stock_Producto: Stock
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#example').DataTable();
              mytable.draw();
              $('#addUserModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $(document).on('submit', '#updateProducto', function(e) {
      e.preventDefault();
      
      var Nombre = $('#ANombre').val();
      var Precio = $('#APrecio').val();
      var Stock = $('#AStock').val();
      var id = $('#id').val();
      var trid = $('#trid').val();
      if (Nombre != '' && Precio != '' && Stock != '' ) {
        
        $.ajax({
          url: "Crud_Producto/Actualizar_Producto.php",
          type: "post",
          data: {
            Nombre_Producto: Nombre,
            Precio_Producto: Precio,
            Stock_Producto: Stock,
            ID_Producto: id,           
          },
          success: function(data) {
            
            var json = JSON.parse(data);
            
            var status = json.status;
            if (status == 'true') {
              
              table = $('#example').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Editar</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Eliminar</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id,Nombre,Precio,Stock,button]);
              $('#exampleModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Todos los campos deben ser rellenados');
      }
    });
    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "Crud_Producto/Buscar_Un_Producto.php",
        data: {
          ID_Producto: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#ANombre').val(json.Nombre_Producto);
          $('#APrecio').val(json.Precio_Producto);
          $('#AStock').val(json.Stock_Producto);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    });

    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      // En la variable id guardo el id del elemento HTML,no de la BD
      var id = $(this).data('id');
      if (confirm("¿Estás seguro de querer eliminar este producto?")) {
        $.ajax({
          url: "Crud_Producto/Eliminar_Producto.php",
          data: {
            ID_Producto: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              $("#" + id).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }



    })
  </script>
  <!-- Actualiza Producto Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateProducto">
          <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="ANombre" class="col-md-3 form-label">Nombre</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="ANombre" name="ANombre">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="APrecio" class="col-md-3 form-label">Precio</label>
              <div class="col-md-9">
                <input type="float" class="form-control" id="APrecio" name="APrecio">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="AStock" class="col-md-3 form-label">Stock</label>
              <div class="col-md-9">
                <input type="number" class="form-control" id="AStock" name="AStock">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Agregar Usuario Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addProducto" action="">
            <div class="mb-3 row">
              <label for="addNombre_Producto" class="col-md-3 form-label">Nombre</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addNombre_Producto" name="Nombre">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addPrecio_Producto" class="col-md-3 form-label">Precio</label>
              <div class="col-md-9">
                <input type="float" class="form-control" id="addPrecio_Producto" name="Precio">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addStock_Producto" class="col-md-3 form-label">Stock</label>
              <div class="col-md-9">
                <input type="number" class="form-control" id="addStock_Producto" name="Stock">
              </div>
            </div>
            
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  
  
 

</body>

</html>
<script type="text/javascript">
</script>