<?php
if(!isset($_SESSION["validarIngreso"])){
    echo '<script>window.location = "index.php?pagina=ingreso";</script>';
    return;
}else{
    if($_SESSION["validarIngreso"] != "ok"){

        echo '<script>window.location = "index.php?pagina=ingreso";</script>';
        return;
    }
    
}

$usuarios = ControladorFormularios::ctrSeleccionarRegistro(NULL, NULL);  


?>


<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $key => $value) {?>
        <tr>

            <td><?=$key+1; ?></td>
            <td><?=$value['nombre'] ?></td>
            <td><?=$value['email'] ?></td>
            <td><?=$value['fecha'] ?></td>
            <td>
                <div class="btn-group">
                    <div class="px-1">
                        <a href="index.php?pagina=editar&id=<?=$value['id'];?>" class="btn btn-warning"><i
                                class="fa-solid fa-pencil"></i>
                        </a>
                    </div>
                    <form method="post">
                        <input type="hidden" name="eliminarRegistro" value="<?=$value["id"]?>">
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        <?php

                        $eliminar = new ControladorFormularios();
                        $eliminar -> ctrEliminarRegistro();


                    ?>

                    </form>

                </div>
            </td>
        </tr>
        <?php }?>


    </tbody>
</table>