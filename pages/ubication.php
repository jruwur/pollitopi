

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/Iconopio.ico">
    <link rel="stylesheet" href="../css/cabeza.css">
    <link rel="stylesheet" href="../css/Inicio.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https:/fonts.googleapis.com/css2?family=Josfin+Sans:ital,wght@0,.100;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Montserrat:wght@700;800;900&display=swap">
    <title>Ubicación Actual en Mapa</title>
   
</head>
<body>
    
<?php include('../templates/header.html') ?>

    
       
<div class="container">
    <div class="row">
      <div class="container-fluid ">
        <div  class="row px-4">
         <div id="" class="col-lg-2 col-xs-0 col-sm-2">  </div>
         <div id="map" style="width:650px; height:300px; border-radius:10px ; box-shadow: 8px 8px 6px 8px #888888;" class="col-lg-8 col-xs-12 col-sm-10 ">
         </div>
         <div id="" class="col-lg-2 col-xs-0 col-sm-2">
        </div>
        
      </div>
      
     </div>
   </div>
      <script src="../js/map.js" ></script>
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmidefHy_QfzF1T9oX79GuKX0Zqhx2cAQ&callback=initMap">
    </script>
    <?php include('../templates/footer.html') ?>
    
</body>
<script src="/js/ubicacion.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=obtenerUbicacion" async defer></script>
</html>