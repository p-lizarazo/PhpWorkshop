<?php
  include "../DbIntegration/database_module.php";

  $cedula = @$_POST["cedula"];
  $nombre = @$_POST["nombre"];
  $apellido = @$_POST["apellido"];
  $edad = @$_POST["edad"];
  $correo = @$_POST["correo"];

  echo $cedula;

  $user = new User($cedula, $nombre, $apellido, $edad, $correo);
  if (count(buscarUsuario($user)) == 0) {
    echo "creando";
    crearUsuario($user);
  }
  else {
    echo "actualizando...";
    actualizarUsuario($user);
  }

  header("Location: ../");
?>