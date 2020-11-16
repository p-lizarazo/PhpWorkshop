<?php
include_once dirname(__FILE__) . '/config.php';
include "Model/users.php";
$conexion;
$conexionBD;

function crearConexion()
{
  global $conexion;
  $conexion = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS);
}

function crearBD()
{
  global $conexion;
  $sql = "CREATE DATABASE " . NOMBRE_DB;
  mysqli_query($conexion, $sql);
}

function establecerConexionBD()
{
  global $conexionBD;
  $conexionBD = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
}

function crearTablaUsuarios()
{
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


function inicializarBD()
{
  crearConexion();
  crearBD();
  establecerConexionBD();
  crearTablaUsuarios();
}

function crearUsuario($user)
{
  global $conexionBD;
  $sql = "INSERT INTO USERS (CEDULA, NOMBRE, APELLIDO, EDAD, CORREO_ELECTRONICO) VALUES ('" .
    $user->cedula . "', '" .
    $user->nombre . "', '" .
    $user->apellido . "', " .
    $user->edad . ", '" .
    $user->correo_electronico . "'
    )";
  mysqli_query($conexionBD, $sql);
}

function actualizarUsuario($user)
{
  global $conexionBD;
  $sql = "UPDATE USERS SET
      NOMBRE = '" . $user->nombre . "', 
      APELLIDO = '" . $user->apellido . "', 
      EDAD = " . $user->edad . ", 
      CORREO_ELECTRONICO = '" . $user->correo_electronico . "'
    WHERE CEDULA = '" . $user->cedula . "'";
  mysqli_query($conexionBD, $sql);
}

function eliminarUsuario($cedula)
{
  global $conexionBD;
  $sql = "DELETE FROM USERS WHERE CEDULA = '" . $cedula . "'";
  mysqli_query($conexionBD, $sql);
}

function buscarUsuario($user)
{
  global $conexionBD;
  $sql = "SELECT * FROM USERS WHERE CEDULA = '" . $user->cedula . "'";
  $result = mysqli_query($conexionBD, $sql);
  $users = array();
  while ($user = $result->fetch_object()) {
    array_push($users, new User($user->CEDULA, $user->NOMBRE, $user->APELLIDO, $user->EDAD, $user->CORREO_ELECTRONICO));
  }
  mysqli_free_result($result);
  return $users;
}

function obtenerUsuarios()
{
  global $conexionBD;
  $sql = "SELECT * FROM USERS";
  $result = mysqli_query($conexionBD, $sql);
  $users = array();
  while ($user = $result->fetch_object()) {
    array_push($users, new User($user->CEDULA, $user->NOMBRE, $user->APELLIDO, $user->EDAD, $user->CORREO_ELECTRONICO));
  }
  mysqli_free_result($result);
  return $users;
}

establecerConexionBD();
