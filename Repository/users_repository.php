<?php
  include "DbIntegration/database_module.php";

  function putUsuario($user) {
    if (count(buscarUsuario($user)) == 0) {
      crearUsuario($user);
      return "Usuario creado exitosamente";
    }
    else {
      actualizarUsuario($user);
      return "Usuario actualizado exitosamente";
    }
  }

  function listaUsuarios() {
    return obtenerUsuarios();
  }

  function eliminar($cedula) {
    eliminarUsuario($cedula);
  }


?>