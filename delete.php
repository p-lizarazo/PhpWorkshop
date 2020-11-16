<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
  
<?php
  include "Repository/users_repository.php";

  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $cedula = @$_POST["cedula"];

    @$_GET["cedula"] = "";

    eliminar($cedula);

    echo '<div class="bg-success text-white p-3 m-3 h4">Ya no existe el usuario con cédula ' . $cedula . '</div>';
  }



  $cedula = @$_GET["cedula"];
  
?>
  <div class="conainter w-50 mx-auto mt-3">
    <h2>Eliminar Usuario</h2>
    <form action="" method="post">
      <div class="form-group">
        <label for="cedula">Cedula</label>
        <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $cedula?>">
      </div>
      <button type="submit" class="btn btn-danger">Submit</button>
    </form>
  </div>
</body>
