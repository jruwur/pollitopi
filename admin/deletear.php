<?php 
include("../database.php");
//registrar en log--------------------------------------------------------
$accion = "Eliminación de usuario";
$usuario = "admin@correo.com";
$sql = "INSERT into pollito_logs (accion, usuario) values('$accion','$usuario')";
$result = mysqli_query($conn,$sql);
//registrar en log--------------------------------------------------------
$id = $_GET['id'];//se trae el id del boton precionado
$sql = "DELETE FROM usuarios where id = $id"; // consulta


$result = mysqli_query($conn, $sql);
if($result){
    header("location: delete.php?datitos=890&msg=Usuario Eliminado");
}
else{
    echo "<div class='alert alert-success text-center d-flex align-items-center' role='alert'>
    <div>
    Algo salió mal!
    </div>
    </div>";
}

?>