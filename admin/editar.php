<?php

if(isset($_POST['añadir1'])){
    header("Location: ../admin/insert.php?datitos=890");
   }
   if(isset($_POST['eliminar1'])){
    header("Location: ../admin/delete.php?datitos=890");
   }
   if(isset($_POST['editar1'])){
    header("Location: ../admin/update.php?datitos=890&id=31");
   }
   if(isset($_POST['admin1'])){
    header("Location: ../admin/admin.php?datitos=890");
   }
  
?>