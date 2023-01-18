<?php
/*========================================
=            MOSTRAR ERRORES             =
========================================*/
    
    ini_set("display_errors", 0);
    ini_set("log_errors", 1);
    ini_set("error_log", "C:/xampp/htdocs/prueba/php_error_log");
/*=====  End of MOSTRAR ERRORES   ======*/
 require_once "controladores/plantilla.controlador.php";
 require_once "controladores/formularios.controlador.php";
 require_once "modelos/formularios.modelo.php";
 $plantilla = new ControladorPlantilla();
 $plantilla->ctrTraerPlantilla();
?>