<div class="d-flex justify-content-center text-center ">
    <form class="py-3 px-5 bg-light" method="post">
        <h1>Ingreso</h1>
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="ingresoEmail" placeholder="Ingrese su correo"
                    name="email" />
            </div>
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Contraseña:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" class="form-control" id="pwd" name="ingresoPassword"
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

        $ingreso= new ControladorFormularios();
        $ingreso-> ctrIngreso();
        
        ?>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>