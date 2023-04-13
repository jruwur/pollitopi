
<!doctype html>
<html lang="es">
  <head>
    <title>Administrador - update</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="../img/Iconopio.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <?php
  $todoslosdatos = []; //arreglo para mandar datos a la bd

  //verificación de usuario admin
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
   
   $idEditar = $_GET['id'];//capturo el id del resgistro seleccionado
   $sqlEditar = "SELECT * FROM usuarios where id = $idEditar LIMIT 1";//consulta SQL
   $resultEditar = mysqli_query($conn, $sqlEditar);
   $row2 = mysqli_fetch_assoc($resultEditar);
   
function test_input($data) {
  $data = trim($data); //evitar caracteres inesesarios(extra space, tab, newline)
  $data = stripslashes($data);//evitar backslashes (\)
  $data = htmlspecialchars($data);//evitar caracteres especiales
  return $data;
  }
  
if(isset($_POST['submit1'])){

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
$accion = "Edición de usuario";
$usuario = "admin@correo.com";
$sql = "INSERT into pollito_logs (accion, usuario) values('$accion','$usuario')";
$result = mysqli_query($conn,$sql);
//registrar en log--------------------------------------------------------
       
          $sql = ("UPDATE usuarios set nombre  ='$nombre', correo ='$correo', contraseña1 = '$contraseña1',contraseña2 ='$contraseña2' where id = $idEditar");
          $result = mysqli_query($conn,$sql);
          if($result){
            header("location: ../admin/update.php?datitos=890&id=31&msg=Actualización completada");
          }
          else{
            header("location: ../admin/update.php?datitos=890&id=1&msg=Algo salió mal");
          }
          
        }
        else{

          header("location: ../admin/update.php?datitos=890&id=1&msg=Completa los datos");
        }
    

}

function error($error1){
  echo "<div class='alert alert-danger text-center d-flex align-items-center' role='alert'>
  <div>
  $error1
  </div>
  </div>";
}
 
 

   if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    echo "<div class='alert alert-success text-center d-flex align-items-center' role='alert'>
    <div>
    $msg !
    </div>
    </div>";
   }
   
  ?>  

  <div class="container mt-2">
    <div class="row">
    <div class="container d-flex justify-content-center">
    <form id="myForm"  method="post" action="editar.php">
      <button type="submit" name="añadir1" class="btn btn-dark">Añadir usuarios</button>
      <button type="submit" name="eliminar1" class="btn btn-dark">eliminar usuarios</button>
      <button type="submit" name="editar1" class="btn btn-dark">editar usuarios</button>
      <button type="submit" name="admin1" class="btn btn-success">volver al menú</button>
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
            <input type="text" class="form-control" name="Pnombre" value="<?php echo $row2['nombre'] ?>">
          </div>
          <div class="col">
            <label for="form-label">Correo:</label>
            <input type="email" class="form-control" value="<?php echo $row2['correo'] ?>" name="Pcorreo">
          </div>
          <div>
          <label for="form-label">Contraseña:</label>
            <input type="password" class="form-control"value="<?php echo $row2['contraseña1'] ?>" name="Pcontraseña1">
          </div>
        </div>
        <div>
          <label for="form-label">Confirmar contraseña:</label>
            <input type="password" class="form-control" value="<?php echo $row2['contraseña2'] ?>" name="Pcontraseña2">
          </div>
        </div>
        <div>
        <div class="container d-flex justify-content-center mt-2">
            <button type="submit" name="submit1" class="btn btn-success">Guardar</button>
          </div>
        </div>
      
      </form>
      </div>   
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
      <td colspan="2"><a type="submit" href="../admin/update.php?datitos=890&id=<?php echo $row['id'] ?>"  name="Butoneditar" class="btn btn-success"> Editar</a></td>
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