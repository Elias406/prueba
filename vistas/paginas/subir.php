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


?>

<div class="d-flex justify-content-center text-center ">
    <form class="py-3 px-5 bg-light" method="POST" enctype="multipart/form-data">
        <div class="form-group"  >
            <label for="name_doc">Nombre documentos</label>
            <input type="text" class="form-control" id="name_doc" name="name_doc"
            placeholder="Introduce el nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion_doc">descripcion</label>
            <input type="text" class="form-control" id="descripcion_doc" name="descripcion_doc"
            placeholder="descripcion" required>
        </div>
        <div class="form-group">
            <input type="file" id="archivo" name="archivo" required>
        </div>
        <?php 
        $actualizar = new ControladorFormularios();
        $actualizar -> ctrSubirDoc();


         
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
                window.location = \"index.php?pagina=inicio\"
                }, 3000);

                </script>";
            }
            ?>
            <button type="submit" class="btn btn-primary" id ="agregarDoc" name="agregarDoc">Cargar Documento</button>
          

        </form>
        
    </div>