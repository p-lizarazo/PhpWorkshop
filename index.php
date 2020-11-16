<?php
    include "./Model/users.php";
    $users = new User("1234","pedro","lizarazo",35,"correo");
?>

<?php
    if (is_array($users) and !empty($users)):
?>
<table>
    <th>
        <tr>    
            Tabla usuarios
        </tr>    
    </th>
    <tbody>
        <?php

        ?>

        <?php

        ?>
    </tbody>
</table>
<?php
    endif;
?>