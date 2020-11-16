<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
  
<?php
  include "./Model/Users.php";

  $cedula = @$_GET["cedula"];
  $nombre = @$_GET["nombre"];
  $apellido = @$_GET["apellido"];
  $edad = @$_GET["edad"];
  $correo = @$_GET["correo"];
?>
  <div class="conainter w-50 mx-auto mt-3">
    <h2>Crear o Modificar Usuario</h2>
    <form action="../Repository/users_repository.php" method="post">
      <div class="form-group">
        <label for="cedula">Cedula</label>
        <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $cedula?>">
      </div>
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre?>">
      </div>
      <div class="form-group">
        <label for="apellido">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $apellido?>">
      </div>
      <div class="form-group">
        <label for="edad">Edad</label>
        <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $edad?>">
      </div>
      <div class="form-group">
        <label for="correo">Correo Electrónico</label>
        <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $correo?>">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
