<div class="d-flex justify-content-center text-center ">
    <form class="py-3 px-5 bg-light" method="post">
        <h1>Registro</h1>
        <div class="mb-3 mt-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" id="nombre" name="registroNombre"
                    placeholder="Ingrese su correo" name="email" />
            </div>
        </div>
        <div class="mb-3 mt-3">

            <label for="email" class="form-label">Correo Electrónico:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="registroEmail" placeholder="Ingrese su correo"
                    name="email" />
            </div>
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Contraseña:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" class="form-control" id="pwd" name="registroPassword"
                    placeholder="Ingrese su contraseña" name="pswd" />
            </div>
        </div>
        <?php 
        /*************************************************
         * FORMA EN QUE SE INSTANCIA UN METODO NO ESTÁTICO
         ************************************************/
        // $registro = new ControladorFormularios();
        // $registro->ctrRegistro();

        /*************************************************
         * FORMA EN QUE SE INSTANCIA UN METODO ESTÁTICO
         ************************************************/

        $registro = ControladorFormularios::ctrRegistro();
        if($registro == "ok"){
            // con el siguiente script borramos la caché para que no registre doblemente los usuario 
            // tantas veces refresquemos el navegador
            echo "<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                    
                }
            
                </script>";
            echo "<div class=\"alert alert-success\"> Datos guardado Satisfactoriamente</div>";
            echo '<script>window.location = "index.php?pagina=ingreso";</script>';
        }
        ?>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>