<?php
// validacion de sesion
$usuario="";

if(!isset($_SESSION["validarIngreso"])){
    echo '<script>window.location = "index.php?pagina=ingreso";</script>';
    return;
}else{
    if($_SESSION["validarIngreso"] != "ok"){

        echo '<script>window.location = "index.php?pagina=ingreso";</script>';
        return;
    }
}



        $usuario= ControladorFormularios::ctrSeleccionarRegistroDoc(null, null);

 // echo '<pre>';print_r($usuario);echo '</pre>';

    if(!(is_array($usuario))){
        return;
    }


?>


<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Tipo</th>
            <th>Tamaño</th>
            <th>Nombre en Sistema</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuario as $key => $value) {?>
        <tr>

            <td><?=$key+1; ?></td>
            <td><?=$value['name'] ?></td>
            <td><?=$value['descripcion'] ?></td>
            <td><?=$value['type'] ?></td>
            <td><?=$value['size'] ?></td>
            <td><?=$value['name_sistem'] ?></td>
            <td>
                <div class="btn-group">
                    <div class="px-1">
                        <a href="index.php?pagina=editarDocumento&id=<?=$value['id_documento'];?>" class="btn btn-warning"><i
                                class="fa-solid fa-pencil"></i>
                        </a>
                    </div>
                    <form method="post">
                        <input type="hidden" name="eliminarRegistroDocumento" value="<?=$value["id_documento"]?>">
                        <input type="hidden" name="unlink" value="<?=$value["name_sistem"].".".$value["type"]?>">
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        <?php

                        $eliminar = new ControladorFormularios();
                        $eliminar -> ctrEliminarRegistroDocumento();


                    ?>

                    </form>

                </div>
            </td>
        </tr>
        <?php }?>


    </tbody>
</table>