<?php 

 class ControladorFormularios{
    /************************
     ********REGISTRO********
     ************************/
    static public function ctrRegistro(){
        if(isset($_POST['registroNombre'])){

            $tabla = "registros";
            $datos = array("nombre"=>$_POST['registroNombre'],
                            "email"=>$_POST['registroEmail'],
                            "password"=>$_POST['registroPassword']);
            
            $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);
            
            return $respuesta;
        }
    }


    /************************
     *SELECCIONAR REGISTRO***
     ************************/
    static public function ctrSeleccionarRegistro($item, $valor) {  
        $tabla = "registros";

        $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

        if(is_array($respuesta)){
            return $respuesta;
        }else{
            echo "<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            
                </script>";
                echo "<div class=\"alert alert-danger\"> Esta intentando ingresar un dato no valido en el sistema</div>";
        }
        

    }
    /************************
     *SELECCIONAR  DOCUMENTOS*
     ************************/
    static public function ctrSeleccionarRegistroDoc($item, $valor) {  
        $tabla = "documentos";

        $respuesta = ModeloFormularios::mdlSeleccionarRegistrosDoc($tabla, $item, $valor);

        if(is_array($respuesta)){
            return $respuesta;
        }else{
            echo "<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            
                </script>";
                echo "<div class=\"alert alert-danger\"> Esta intentando ingresar un dato no valido en el sistema</div>";
        }
        

    }

    /************************
     *******INGRESAR*********
     ************************/

    public function ctrIngreso(){
        if(isset($_POST['ingresoEmail'])){ 
            $tabla= "registros";
            $item= "email";
            $valor = $_POST['ingresoEmail']; 
            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
            // Preguntamos si es un arreglo para saber que si consiguio los 
            // valores en la base de datos por que de no encontrarlos es por que 
            // el sql nos esta devolviendo una respuesta booleana en False
            if(is_array($respuesta)){
                if($respuesta["email"] == $_POST['ingresoEmail'] &&
                $respuesta["password"] == $_POST['ingresoPassword']){

                $_SESSION['validarIngreso'] = "ok";
                echo '<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
                window.location = "index.php?pagina=inicio";
                </script>';
            }
            }else{
                echo "<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            
                </script>";
                echo "<div class=\"alert alert-danger\"> Email o contraseña no cohinciden</div>";
        
            }
            
        }
    }

    static public function ctrActualizarRegistro(){
        if(isset($_POST['actualizarNombre'])){

            $tabla = "registros";
            if($_POST['actualizarPassword']==""){
                $password= $_POST["passwordActual"];
            }else{
                $password= $_POST["actualizarPassword"];
            }

            $datos = array("id"=>$_POST['idUsuario'],
                            "nombre"=>$_POST['actualizarNombre'],
                            "email"=>$_POST['actualizarEmail'],
                            "password"=>$password);
            
            $respuesta = ModeloFormularios::mdlActualizarRegistro($tabla, $datos);

            return $respuesta;
            
            
            
        }
    }
     static public function ctrActualizarRegistroDoc(){
        if(isset($_POST['actualizarDoc'])){

            $tabla = "documentos";
            if($_POST['descripcion']==""){
                $descripcion= $_POST["descripcionActual"];
            }else{
                $descripcion= $_POST["descripcion"];
            }
            if($_POST['name']==""){
                $name= $_POST["nameActual"];
            }else{
                $name= $_POST["name"];
            }

            $datos = array("id_documento"=>$_POST['idDoc'],
                            "name"=>$name,
                            "descripcion"=>$descripcion);
         
            $respuesta = ModeloFormularios::mdlActualizarRegistroDoc($tabla, $datos);

            return $respuesta;
            
            
            
        }
    }


    /************************
    **ELIMINAR REGISTRO******
    ************************/
    
    public function ctrEliminarRegistro() {
        if(isset($_POST['eliminarRegistro'])){

            $tabla = "registros";
            $valor = $_POST['eliminarRegistro'];

            $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor);

            if($respuesta == "ok"){
                echo '<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
                window.location = "index.php?pagina=inicio";
                </script>';

            }
        }
    }
    /************************
    **ELIMINAR REGISTRO******
    ************************/
    
    public function ctrEliminarRegistroDocumento() {
        if(isset($_POST['eliminarRegistroDocumento'])){

            $tabla = "documentos";
            $valor = $_POST['eliminarRegistroDocumento'];

            
            if(unlink('watever/'.$_POST['unlink'])){
                $respuesta = ModeloFormularios::mdlEliminarRegistroDocumento($tabla, $valor);

                if($respuesta == "ok"){
                    echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                    window.location = "index.php?pagina=buscar";
                    </script>';

                }
            }
        }
    }
    public function dif_fechas($fecha1,$fecha2){
        date_default_timezone_set('America/Bogota');
        $diff = date_diff($fecha1,$fecha2);
        return  $diff;
    }
    public function time_default(){//EXCEL
        date_default_timezone_set('America/Bogota');
    }
        public function hoy(){//EXCEL
        $this->time_default();
        $hoy=date('Y-m-d');
        return $hoy;
    }
    public function dif_dias($fecha1,$fecha2){
        date_default_timezone_set('America/Bogota');
        $fechaActual = $fecha2; 
        $datetime1 = date_create($fecha1);
        $datetime2 = date_create($fechaActual);
        $contador = date_diff($datetime1, $datetime2);
        $differenceFormat = '%a';
        return $contador->format($differenceFormat);
    }

    public function validaArchivo($archivo) {
        
        $type= explode("/", $archivo['type'])[1];
        
        if($type == 'pdf'){
            $name = $archivo['name'];
            $nameT =  trim($name);
            $nameArray = explode('.', $nameT)[0];
            $nameTemp = str_replace(" ", "_", $nameArray);
            $name = $nameTemp."_".$this->hoy();
            $cont= 0;
            $destino="watever/".$name.".".$type;
            while (file_exists($destino)) {
                $cont++;
                $destino ="watever/".$name."_".$cont.".".$type;
            }
            $ruta= $archivo['tmp_name'];
            $size = $archivo['size'];
            
            if(copy($ruta, $destino)){
                return  [$name, $type, $size, $destino];
            }
        }
        
    }
    /************************
    **Cargar Documentos******
    ************************/
    
    public function ctrSubirDoc() {
        if(isset($_POST['agregarDoc'])){
            if($_POST['name_doc'] == ""){
                echo "<script> if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }</script>";
                 echo "<script>alert('Los campos no pueden estar vacios, Verifique')</script>";
                 return;
            }

            $archivo = $_FILES['archivo'];
            $resulForm = $this->validaArchivo($archivo);
            if($resulForm[1] != 'pdf'){
                echo "<script> if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }</script>";
                 echo "<script>alert('Documento invalido, Solo se permiten pdf')</script>";
                 return;
            }

                $tabla = "documentos";
                 $datos = array("name"=>$_POST['name_doc'],
                            "descripcion"=>$_POST['descripcion_doc'],
                            "estado"=> 0);

                $respuesta = ModeloFormularios::mdlSubirDoc($tabla, $datos, $resulForm);

                if($respuesta == "ok"){

                    $this->notify_succes("Documento Guardado");
                    echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }

                    setTimeout(fadeout, 3000);
                    function fadeout() {
                    
                        window.location = "index.php?pagina=buscar";
                    }
                    </script>';

                }
            
        }
    }
    public function notify_succes($mensaje){// Mensaje de Enviar Exito (SOLO PARA ENVIAR DEL CONTROLADOR)

                echo '

                    <div id="notification_process" class="alert alert-success"style="position: absolute; right: 10px; top: 0px; z-index: 10; role="alert">
                    '.$mensaje.'
                    </div>

                    <script>

                        var alert = document.getElementById("notification_process");
                        alert.addEventListener("click", function(){

                            $( "#notification_process" ).fadeOut( "slow", function() {
                                
                                $("#notification_process").remove();

                            });
                        });

                        window.setTimeout(close, 2000);

                        function close(){

                            $( "#notification_process" ).fadeOut( "slow", function() {
                                
                                $("#notification_process").remove();

                            });
                        }
                    </script>
                ';
            }


 }
?>