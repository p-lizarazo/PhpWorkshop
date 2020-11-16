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
    <?php
    include "Repository/users_repository.php";
    
    $users = listaUsuarios();

    $order = @$_GET["orden"];
    $order_att = @$_GET["atributo"];

    function cmp_asc_cedula($a, $b)
    {
        return $a->cedula > $b->cedula;
    }
    function cmp_desc_cedula($a, $b)
    {
        return $a->cedula < $b->cedula;
    }
    function cmp_asc_nombre($a, $b)
    {
        return $a->nombre > $b->nombre;
    }
    function cmp_desc_nombre($a, $b)
    {
        return $a->nombre < $b->nombre;
    }

    if ($order == "asc") {
        if ($order_att == "cedula") {
            usort($users, 'cmp_asc_cedula');
        } else if ($order_att == "nombre") {
            usort($users, 'cmp_asc_nombre');
        }
    } elseif ($order == "desc") {
        if ($order_att == "cedula") {
            usort($users, 'cmp_desc_cedula');
        } else if ($order_att == "nombre") {
            usort($users, 'cmp_desc_nombre');
        }
    }

    ?>

    <?php
    if (is_array($users) and !empty($users)) :
    ?>
        <div class="container">

            <h2>Usuarios</h2>
            <form action="" method="get">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="text-primary" for="orden">Orden:</label>

                        <div class="input-group mb-3">
                            <select class="custom-select" name="orden" id="orden">
                                <option value="" selected>Elija...</option>
                                <option value="asc">Ascendente</option>
                                <option value="desc">Descendente</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label class="text-primary" for="atributo">Atributo:</label>
                        <div class="input-group mb-3">
                            <select class="custom-select" name="atributo" id="atributo">
                                <option value="" selected>Elija...</option>
                                <option value="cedula">Cedula</option>
                                <option value="nombre">Nombre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto align-self-end mb-3">
                        <button type="submit" class="btn btn-primary mt-auto">Filtrar</button>
                    </div>
                </div>
            </form>
            <table class="table">
                <thead>
                    <th scope="col">id</th>
                    <th scope="col"><span class="d-flex">Cedula
                            <?php if ($order == "asc" and $order_att == "cedula") : ?>
                                <i class="gg-arrow-up"></i>
                            <?php endif ?>
                            <?php if ($order == "desc" and $order_att == "cedula") : ?>
                                <i class="gg-arrow-down"></i>
                            <?php endif ?>
                        </span></th>
                    <th scope="col"><span class="d-flex">Nombre
                            <?php if ($order == "asc" and $order_att == "nombre") : ?>
                                <i class="gg-arrow-up"></i>
                            <?php endif ?>
                            <?php if ($order == "desc" and $order_att == "nombre") : ?>
                                <i class="gg-arrow-down"></i>
                            <?php endif ?>
                        </span></th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Correo</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user) :
                    ?>
                        <tr>
                            <td><?php echo $user->id ?></td>
                            <td><?php echo $user->cedula ?></td>
                            <td><?php echo $user->nombre ?></td>
                            <td><?php echo $user->apellido ?></td>
                            <td><?php echo $user->edad ?></td>
                            <td><?php echo $user->correo_electronico ?></td>
                            <td>
                                <div class="d-flex" style="align-items: baseline;">
                                    <span class="px-3 py-3 m-2">
                                        <a class="gg-pen" href=<?php echo "./gestor_usuario.php/?cedula=" . $user->cedula . "&nombre=" . $user->nombre . "&apellido=" . $user->apellido . "&edad=" . $user->edad . "&correo=" . $user->correo_electronico ?>></a>
                                    </span>
                                    <span class="p-2 m-2">
                                        <a class="gg-trash" href=<?php echo "./delete.php/?cedula=" . $user->cedula ?>></a>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    else :
    ?>
        <h1 class="title">No existen usuarios lo sentimos :'c</h1>
    <?php
    endif;
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>