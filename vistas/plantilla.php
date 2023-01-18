<?php
// le dice al navegador que vamos a trabajar con variables de sesion
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--
            CDNS DE CSS
        -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <!--
            CDNS JAVASCRIPT
        -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <!--
            CDNs FontAwesome
        -->
    <script src="https://kit.fontawesome.com/632714d7b5.js" crossorigin="anonymous"></script>
    <title>Inicio</title>
</head>

<body>
    <!--============
            LOGOTIPO
        ==============-->
    <div class="container-fluid">
        <h3 class="text-center py-3">LOGO</h3>
    </div>
    <!--============
            Botonera
        ==============-->
    <div class="container-fluid bg-light">
        <div class="container">
            <ul class="nav nav-justified py-2 nav-pills">
                <?php 
                if (isset($_GET['pagina'])) {
                    if($_GET['pagina'] == 'registro'){?>
                <li class="nav-item">
                    <a href="index.php?pagina=registro" class="nav-link active">Registro</a>
                </li>
                <?php }else{?>
                <li class="nav-item">
                    <a href="index.php?pagina=registro" class="nav-link">Registro</a>
                </li>
                <?php }
                    if($_GET['pagina'] == 'ingreso'){?>
                <li class="nav-item">
                    <a href="index.php?pagina=ingreso" class="nav-link active">Ingreso</a>
                </li>
                <?php }else{?>
                <li class="nav-item">
                    <a href="index.php?pagina=ingreso" class="nav-link">Ingreso</a>
                </li>
                <?php }
                    
                    if($_GET['pagina'] == 'inicio'){?>
                <li class="nav-item">
                    <a href="index.php?pagina=inicio" class="nav-link active">Inicio</a>
                </li>
                <?php }else{?>
                <li class="nav-item">
                    <a href="index.php?pagina=inicio" class="nav-link">Inicio</a>
                </li>
                <?php }
                if($_GET['pagina'] == 'buscar'){?>
                <li class="nav-item">
                    <a href="index.php?pagina=buscar" class="nav-link active">Documentos</a>
                </li>
                <?php }else{?>
                <li class="nav-item">
                    <a href="index.php?pagina=buscar" class="nav-link">Documentos</a>
                </li>
                <?php }

                if($_GET['pagina'] == 'subir'){?>
                <li class="nav-item">
                    <a href="index.php?pagina=subir" class="nav-link active">Registrar Documento</a>
                </li>
                <?php }else{?>
                <li class="nav-item">
                    <a href="index.php?pagina=subir" class="nav-link">Registrar Documento</a>
                </li>
                <?php }

                if($_GET['pagina'] == 'salir'){?>
                <li class="nav-item">
                    <a href="index.php?pagina=salir" class="nav-link active">Salir</a>
                </li>
                <?php }else{?>
                <li class="nav-item">
                    <a href="index.php?pagina=salir" class="nav-link">Salir</a>
                </li>
                <?php }

                    
                } else {?>
                <li class="nav-item">
                    <a href="index.php?pagina=registro" class="nav-link active">Registro</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pagina=ingreso" class="nav-link">Ingreso</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pagina=inicio" class="nav-link ">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pagina=buscar" class="nav-link">Buscar</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pagina=salir" class="nav-link">Salir</a>
                </li>
                <?php } ?>

            </ul>
        </div>
    </div>
    <!--============
            CONTENIDO
        ==============-->
    <div class="container-fuid">
        <div class="container mt-3 py-5">
            <?php 
            if(isset($_GET['pagina'])){
                if($_GET['pagina'] == "registro"||
                    $_GET['pagina'] == "ingreso"||
                    $_GET['pagina'] == "inicio"||
                    $_GET['pagina'] == "buscar"||
                    $_GET['pagina'] == "editar"||
                    $_GET['pagina'] == "editarDocumento"||
                    $_GET['pagina'] == "subir"||
                    $_GET['pagina'] == "salir"){
                        include "paginas/".$_GET['pagina'].".php";
                    }else{
                        include "paginas/error404.php";
                    }
            }else{
                include "paginas/registro.php";
            }
            ?>
        </div>
    </div>


</body>
<script>
document.querySelector('#cargar').addEventListener('click', function() {
    obtenerDatos();
});


$(document).ready(function() {
    let campo = document.getElementById("buscarNombre");
    if (campo.value == "") {
        document.querySelector('#cargar').appendChild(document.createElement(
            '<i class="fa-sharp fa-solid fa-magnifying-glass"></i>'));
    } else {
        document.querySelector('#cargar').appendChild(document.createElement(
            '<i class="fa-solid fa-x"></i>'));
    }
});

function obtenerDatos() {
    let url = `https://fakerapi.it/api/v1/users?_quantity=10`;
    const api = new XMLHttpRequest();
    api.open('GET', url, true);
    api.send();

    console.log(this.status);
    api.readyStateChanged = function() {
        if (this.status == "ok") {
            let content = document.getElementById("contenido");
            let datos = JSON.parse(this.responseText);
            content.innerHTML(datos);
        }
    }
}
</script>

</html>