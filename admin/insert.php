<!doctype html>
<html lang="es">
  <head>
    <title>Administrador agregar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="../img/Iconopio.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <?php
  $todoslosdatos=[];
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

if(isset($_POST['submit'])){
  $nombre = $_POST['Pnombre'];
  $correo =  $_POST['Pcorreo'];
  $contraseña1 =$_POST['Pcontraseña1'];
  $contraseña2 =$_POST['Pcontraseña2'] ;

if(empty($_POST['Pnombre'])){
  $error1 = 'Completa tu nombre';
  error($error1);
}else{
  test_input($nombre);
    array_push($todoslosdatos, $nombre);
}if(empty($_POST['Pcorreo'])){
  $error2 = 'Completa tu correo';
  error($error2);
}else{
  test_input($correo);
    array_push($todoslosdatos, $correo);
}if(empty($_POST['Pcontraseña1'])){
  $error3 = 'Completa tu contraseña';
  error($error3);
}else{
  test_input($contraseña1);
    array_push($todoslosdatos, $contraseña1);
}
if(empty($_POST['Pcontraseña2'])){
  $error4 = 'Completa tu otra contraseña';
  error($error4);
}else{
  test_input($contraseña2);
    array_push($todoslosdatos, $contraseña2);
}
$count = count($todoslosdatos);//contar los valores para validarlos
if($count ===4){
  //registrar en log--------------------------------------------------------
$accion = "Registro de nuevo usuario";
$usuario = "admin@correo.com";
$sql = "INSERT into pollito_logs (accion, usuario) values('$accion','$usuario')";
$result = mysqli_query($conn,$sql);
//registrar en log--------------------------------------------------------
          // Prepare the statement
          $stmt = $conn->prepare("CALL sp_insertarusuario(?,?,?,?)");
          // Bind the parameters
          $stmt->bind_param("ssss", $nombre, $correo, $contraseña1,$contraseña2);
          // Execute and end the statement
          $stmt->execute();
          $stmt->get_result();
          $stmt->close();
          $conn->close();
          echo "<div class='alert alert-success text-center d-flex align-items-center' role='alert'>
          <div>
          Registro realizado correctamente!
          </div>
          </div>";
        }
        else{

          //error por no completar todos los datos
          "<div class='alert alert-danger text-center d-flex align-items-center' role='alert'>
          <div>
             completa los campos pls
          </div>
          </div>";
        }
    

}
function error($error1){
  echo "<div class='alert alert-danger text-center d-flex align-items-center' role='alert'>
  <div>
  $error1
  </div>
  </div>";
}
     function test_input($data) {
      $data = trim($data); //evitar caracteres inesesarios(extra space, tab, newline)
      $data = stripslashes($data);//evitar backslashes (\)
      $data = htmlspecialchars($data);//evitar caracteres especiales
      return $data;
      }
      if(isset($_POST['añadir'])){
        header("Location: ../admin/insert.php?datitos=890");
       }
   if(isset($_POST['eliminar'])){
    header("Location: ../admin/delete.php?datitos=890");
   }
   if(isset($_POST['editar'])){
    header("Location: ../admin/update.php?datitos=890&id=31");
   }
   if(isset($_POST['admin'])){
    header("Location: ../admin/admin.php?datitos=890");
   }


?>
 <div class="container mt-2">
    <div class="row">
    <div class="container d-flex justify-content-center">
    <form id="myForm"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <button type="submit" name="añadir" class="btn btn-dark">Añadir usuarios</button>
      <button type="submit" name="eliminar" class="btn btn-dark">eliminar usuarios</button>
      <button type="submit" name="editar" class="btn btn-dark">editar usuarios</button>
 <button type="submit" name="admin" class="btn btn-success">volver al menú</button>
    </form>
    </div>
    </div>
  </div>
<div class="container">
  <div class="row">
    <div class="col-12">
      <h2>Añadir usuario</h2>
      <p>Completa el formulario para añadir usuario</p>
      <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:40vw; min-width: 300px;">
        <div class="row">
          <div class="col">
            <label for="form-label">Nombre:</label>
            <input type="text" class="form-control" name="Pnombre">
          </div>
          <div class="col">
            <label for="form-label">Correo:</label>
            <input type="email" class="form-control" name="Pcorreo">
          </div>
          <div>
          <label for="form-label">Contraseña:</label>
            <input type="password" class="form-control" name="Pcontraseña1">
          </div>
        </div>
        <div>
          <label for="form-label">Confirmar contraseña:</label>
            <input type="password" class="form-control" name="Pcontraseña2">
          </div>
        </div>
        <div>
        <div class="container d-flex justify-content-center mt-2">
            <button type="submit" name="submit" class="btn btn-success">Guardar</button>
          </div>
        </div>
      
      </form>
      </div>   
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