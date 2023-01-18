<?php
// validacion de sesion
if(!isset($_SESSION["validarIngreso"])){
    echo '<script>window.location = "index.php?pagina=ingreso";</script>';
    return;
}else{
    if($_SESSION["validarIngreso"] != "ok"){

        echo '<script>window.location = "index.php?pagina=ingreso";</script>';
        return;
    }
}


if(isset($_GET["id"])){
    $item= "id_documento";
    $valor=$_GET["id"];

    $usuario= ControladorFormularios::ctrSeleccionarRegistroDoc($item, $valor);

//  echo '<pre>';print_r($usuario);echo '</pre>';

    if(!(is_array($usuario))){
        return;
    }
}

?>


<div class="d-flex justify-content-center text-center ">
    <form class="py-3 px-5 bg-light" method="post">
        <div class="mb-6 mt-6">
                <label for="name"><b>Nombre del documento</b></label><br><hr>
            <div class="input-group mb-6">
                <span class="input-group-text"><i class="fas fa-file"></i></span>
                <input type="text" class="form-control" id="name" name="name"
                    placeholder="Nombre del Documento"  value="<?=$usuario['name'];?>" />
            </div>
        </div><br>
        <div class="mb-6 mt-6">
                <label for="descripcion_doc"><b>descripción</b></label><br><hr>
            <div class="input-group mb-6">
                <span class="input-group-text"><i class="fas fa-file"></i></span>
                <input type="text" class="form-control" id="descripcion" name="descripcion"
                    placeholder="Ingrese la descripcion" name="descripcion" value="<?=$usuario['descripcion'];?>" />
            </div>
        </div>
        <div class="mb-6">
            <div class="input-group">
                <input type="hidden" name="descripcionActual" value="<?=$usuario['descripcion']?>" /></input>
                <input type="hidden" name="idDoc" value="<?=$usuario['id_documento']?>" /></input>
                <input type="hidden" name="nameActual" value="<?=$usuario['id_documento']?>" /></input>
            </div>
        </div>
        
        <?php 
        $actualizar = ControladorFormularios::ctrActualizarRegistroDoc();
        

        if($actualizar == "ok"){
                echo "<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            
                </script>";
            echo "<div class=\"alert alert-success\"> Datos actualizados satisfactoriamente</div>
            
                </script>
                <script>

                setTimeout(function(){
                    window.location = \"index.php?pagina=buscar\"
                }, 3000);

                </script>";
                }
        ?>
        <hr>
        <button type="submit" class="btn btn-primary" id="actualizarDoc" name="actualizarDoc">Actualizar</button>
    </form>
</div>