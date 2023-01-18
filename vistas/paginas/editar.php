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
    $item= "id";
    $valor=$_GET["id"];

    $usuario= ControladorFormularios::ctrSeleccionarRegistro($item, $valor);

//  echo '<pre>';print_r($usuario);echo '</pre>';

    if(!(is_array($usuario))){
        return;
    }
}

?>


<div class="d-flex justify-content-center text-center ">
    <form class="py-3 px-5 bg-light" method="post">
        <div class="mb-3 mt-3">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" id="nombre" name="actualizarNombre"
                    placeholder="Ingrese su correo" name="email" value="<?=$usuario['nombre'];?>" />
            </div>
        </div>
        <div class="mb-3 mt-3">
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="actualizarEmail"
                    placeholder="Ingrese su correo" name="email" value="<?=$usuario['email'];?>" />
            </div>
        </div>
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" class="form-control" id="pwd" name="actualizarPassword"
                    placeholder="Ingrese su contraseña" name="pswd" value="" />
                <input type="hidden" name="passwordActual" value="<?=$usuario['password']?>" /></input>
                <input type="hidden" name="idUsuario" value="<?=$usuario['id']?>" /></input>
            </div>
        </div>
        <?php 
        $actualizar = ControladorFormularios::ctrActualizarRegistro();
        

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
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>