
<!doctype html>
<html lang="es">
  <head>
    <title>Administrador - Eliminar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="../img/Iconopio.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <?php
 
   include("../database.php");
   $verificacion =$_GET['datitos'] ;
   if($verificacion != 890){
       header("Location: ../pages/login.php?datitos=891");
   }
   else{
       echo'<div class="container">
       <div class="row">
           <div style="color: green;" class=" col-12 text-center">
           Bienvenido poderoso Admin
           </div>
       </div>
   </div>';
   
   }

   if(isset($_POST['añadir'])){
    header("Location: ../admin/insert.php?datitos=890");
   }
   if(isset($_POST['Ireliminar'])){
    header("Location: ../admin/delete.php?datitos=890");
   }
   if(isset($_POST['editar'])){
    header("Location: ../admin/update.php?datitos=890&id=31");
   }
   if(isset($_POST['admin'])){
    header("Location: ../admin/admin.php?datitos=890");
   }
 //alerta de registro eliminado
   if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    echo "<div class='alert alert-success text-center d-flex align-items-center' role='alert'>
    <div>
    $msg correctamente!
    </div>
    </div>";
   }
  ?>  
  <div class="container mt-2">
    <div class="row">
    <div class="container d-flex justify-content-center">
    <form id="myForm"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <button type="submit" name="añadir" class="btn btn-dark">Añadir usuarios</button>
      <button type="submit" name="Ireliminar" class="btn btn-dark">eliminar usuarios</button>
      <button type="submit" name="editar" class="btn btn-dark">editar usuarios</button>
      <button type="submit" name="admin" class="btn btn-success">volver al menú</button>
    
    </div>
    </div>
  </div>

  <div class="container mt-2">
    <div class="row">
    <div class="container d-flex justify-content-center">
    <table class="table table-dark text-center">
  <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">nombre</th>
        <th scope="col">correo</th>
        <th scope="col">accion</th>
    
    </tr>
  </thead>
  <tbody>
    <?php
    include("../database.php");
    $sql = "SELECT * FROM usuarios";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){  
        ?>
        <tr class="table-">      
    
    </tr>
    <tr>
      <th scope="row"><?php echo $row['id']?></th>
      <td colspan="2" class="table-active"><?php echo $row['nombre'] ?></td>
      <td><?php echo $row['correo'] ?></td>
      <td colspan="2"><a type="submit" href="deletear.php?datitos=890&id=<?php echo $row['id'] ?>"  name="eliminar" class="btn btn-danger"> eliminar</a></td>
      <td colspan="2"><a type="submit" href="update.php?datitos=890&id=<?php echo $row['id'] ?>"  name="editar" class="btn btn-primary"> editar</a></td>
    </tr>
    <?php
    }
?>
  </tbody>
</table>
</form>
    </div>
    </div>
  </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>