<?php
  include_once dirname(__FILE__).'/config.php';
  include "../Model/users.php";
  $conexion;
  $conexionBD;

  function crearConexion() {
    global $conexion;
    $conexion = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS);
  }

  function crearTablaUsuarios() {
    global $conexionBD;
    $sql = "CREATE TABLE USERS (
        ID INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (ID),
        CEDULA CHAR(31),
        NOMBRE CHAR (31),
        APELLIDO CHAR(31),
        EDAD INT, 
        CORREO_ELECTRONICO CHAR(63)
      )";
    mysqli_query($conexionBD, $sql);
  }

  function crearBD() {
    global $conexion;
    global $conexionBD;
    $sql="CREATE DATABASE ".NOMBRE_DB;
    mysqli_query($conexion, $sql);
    $conexionBD = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
  }

  function inicializarBD() {
    crearConexion();
    crearBD();
    crearTablaUsuarios();
  }

  function insertarUsuario($user) {
    global $conexionBD;
    $sql = "INSERT INTO USERS (cedula, nombre, apellido, edad, correo_electronico) VALUES ('".
      $user->cedula."', '".
      $user->nombre."', '".
      $user->apellido."', ".
      $user->edad.", '".
      $user->correo_electronico."'
    )";
    mysqli_query($conexionBD, $sql);
  }

  function actualizarUsuario($user) {
    global $conexionBD;
    $sql = "UPDATE USERS SET
      nombre = '".$user->nombre."', 
      apellido = '".$user->apellido."', 
      edad = ".$user->edad.", 
      correo_electronico = '".$user->correo_electronico."'
    WHERE cedula = '".$user->cedula."'";
    mysqli_query($conexionBD, $sql);
  }

  function eliminarUsuario($user) {
    global $conexionBD;
    $sql = "DELETE FROM USERS WHERE cedula = '".$user->cedula."'";
    mysqli_query($conexionBD, $sql);
  }

  function obtenerUsuarios() {
    global $conexionBD;
    $sql = "SELECT * FROM USERS";
    $users = array();
    $result = mysqli_query($conexionBD, $sql);
    while ($user = $result->fetch_object()) {
      array_push($users, new User($user->CEDULA, $user->NOMBRE, $user->APELLIDO, $user->EDAD, $user->CORREO_ELECTRONICO));
    }
    mysqli_free_result($result);
    return $users;
  }

  inicializarBD();
  insertarUsuario(new User("9932", "Pedro", "lizarazo", 35, "correo"));
  obtenerUsuarios();
?>