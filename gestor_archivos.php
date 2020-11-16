<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href='https://css.gg/arrow-down.css' rel='stylesheet'>
    <link href='https://css.gg/arrow-up.css' rel='stylesheet'>
    <link href='https://css.gg/trash.css' rel='stylesheet'>
    <link href='https://css.gg/pen.css' rel='stylesheet'>
    <style>
        .gg-arrow-up {
            color: green;
        }

        .gg-arrow-down {
            color: red;
        }

        .gg-pen {
            color: darkgoldenrod;
        }

        .gg-trash {
            color: darkred;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../">Taller 3</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../gestor_usuario.php/">Crear/Modificar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../delete.php/">Eliminar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../gestor_archivos.php/">Subir archivo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../">Lista</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php

    if (substr($_SERVER['REQUEST_URI'], -1) != "/") {
        header('Location: ' . $uri . $_SERVER['REQUEST_URI'] . '/');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $str_pagina = "";
        if ($_FILES["arch"]["error"] > 0) {
            echo "Error: " . $_FILES["arch"]["error"] . "<br>";
            echo '<div class="bg-danger text-white p-3 m-3 h4">Fallo en el guardado</div>';
        } elseif (file_exists('arch_subidos/' . $_FILES["arch"]["name"])) {
            echo '<div class="bg-danger text-white p-3 m-3 h4">Fallo en el guardado, ya existe un archivo con el mismo nombre</div>';
        } else {
            $str_pagina .= "Nombre: " . $_FILES["arch"]["name"] . "<br>";
            $str_pagina .= "Tipo: " . $_FILES["arch"]["type"] . "<br>";
            $str_pagina .= "Tamaño: " . ($_FILES["arch"]["size"] / 1024) . " kB<br>";
            $str_pagina .= "Guardado en: " . $_FILES["arch"]["tmp_name"];
            if (!file_exists('arch_subidos/')) {
                mkdir('arch_subidos/', 0777, true);
            }
            move_uploaded_file($_FILES["arch"]["tmp_name"], "arch_subidos/" . $_FILES["arch"]["name"]);
            echo '<div class="bg-success text-white p-3 m-3 h4">Guardado exitosamente</div>';
            echo $str_pagina;
            echo "Guardado en: " . "arch_subidos/" . $_FILES["arch"]["name"];
        }
    }
    ?>

    <div class="container mt-3">
        <h1>Subir archivos </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" name="arch" class="custom-file-input" id="arch">
                    <label class="custom-file-label" for="arch" id="archlabel">Escoger Archivo</label>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Subir">
        </form>
        <?php
        crear_imagen();
        echo '<img class="d-block mx-auto" src="../img/imagen.png" >';
        $timestamp = date('Y-m-d H:i:s');
        echo '<div> Timestamp(Y-m-d H:i:s) </div>';
        echo '<div>' . $timestamp . '</div>';

        function  crear_imagen()
        {
            $im = imagecreate(300, 300) or die("Error en la creacion de imagenes");
            $color_fondo = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
            $rand_col1 = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
            $rand_col2 = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
            $rand_col3 = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));

            imagerectangle($im,   rand(0, 290),  rand(0, 290), rand(0, 290), rand(0, 290), $rand_col1);
            imagefilledrectangle($im,   rand(0, 290),  rand(0, 290), rand(0, 290), rand(0, 290), $rand_col2);
            imagerectangle($im,   rand(0, 290),  rand(0, 290), rand(0, 290), rand(0, 290), $rand_col3);
            if (!file_exists('img/')) {
                mkdir('img/', 0777, true);
            }
            imagepng($im, "img/imagen.png");
            imagedestroy($im);
        }
        ?>
    </div>


    <script>
        console.log("Hello");
        document.getElementById('arch').onchange = function(event) {
            document.getElementById('archlabel').innerHTML = this.files.item(0).name;
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>