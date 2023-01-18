<?php
 require_once 'conexion.php';

 class ModeloFormularios{
    /************************
     *******REGISTRAR********
     ************************/
    static public function mdlRegistro($tabla, $datos){
        
        #statement->declaración
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, email, password) 
                                                VALUES (:nombre, :email, :password)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            // echo "Fallo al conectar a MySQL: (" . $stmt->connect_errno . ") " . $stmt->connect_error;
            print_r(Conexion::conectar()->errorInfo());
        
        }
        $stmt = null;
    }


    /************************
     *SELECCIONAR REGISTRO***
     ************************/

    static public function mdlSeleccionarRegistros($tabla, $item, $valor){

        if($item == null && $valor == null){

            $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') 
                                                AS fecha FROM $tabla ORDER BY id DESC");

        $stmt->execute();

        return $stmt->fetchAll();

        }else{

        $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') 
                                                AS fecha 
                                                FROM $tabla 
                                                WHERE $item = :$item 
                                                ORDER BY id DESC");

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
        
        $stmt->execute();

        return $stmt->fetch();

        }

        $stmt = NULL;
        
    }
    /************************
     *SELECCIONAR REGISTRO***
     ************************/

    static public function mdlSeleccionarRegistrosDoc($tabla, $item, $valor){

        if($item == null && $valor == null){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        }else{

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM $tabla 
                                                WHERE $item = :$item 
                                                ");

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
        
        $stmt->execute();

        return $stmt->fetch();

        }

        $stmt = NULL;
        
    }

    static public function mdlActualizarRegistro($tabla,$datos){
        #statement->declaración
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
                                                SET nombre=:nombre, 
                                                    email=:email, 
                                                    password=:password 
                                                WHERE id=:id");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);//Por que es un numero entero

        if($stmt->execute()){
            return "ok";
        }else{
            // echo "Fallo al conectar a MySQL: (" . $stmt->connect_errno . ") " . $stmt->connect_error;
            print_r(Conexion::conectar()->errorInfo());
        
        }
        $stmt = null;
    }
     static public function mdlActualizarRegistroDoc($tabla,$datos){
      
        #statement->declaración
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
                                                SET name=:name, 
                                                    descripcion=:descripcion
                                                WHERE id_documento=:id_documento");

        $stmt->bindParam(":name", $datos["name"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_documento", $datos["id_documento"], PDO::PARAM_INT);//Por que es un numero entero

        if($stmt->execute()){
            return "ok";
        }else{
            // echo "Fallo al conectar a MySQL: (" . $stmt->connect_errno . ") " . $stmt->connect_error;
            print_r(Conexion::conectar()->errorInfo());
        
        }
        $stmt = null;
    }

    static public function mdlEliminarRegistro($tabla, $valor){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla 
                                                WHERE id=:id");
        $stmt->bindParam(":id", $valor, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            // echo "Fallo al conectar a MySQL: (" . $stmt->connect_errno . ") " . $stmt->connect_error;
            print_r(Conexion::conectar()->errorInfo());
        
        }
        $stmt = null;
    }
    static public function mdlEliminarRegistroDocumento($tabla, $valor){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla 
                                                WHERE id_documento=:id_documento");
        $stmt->bindParam(":id_documento", $valor, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            // echo "Fallo al conectar a MySQL: (" . $stmt->connect_errno . ") " . $stmt->connect_error;
            print_r(Conexion::conectar()->errorInfo());
        
        }
        $stmt = null;
    }

     static public function mdlSubirDoc($tabla, $valor, $documento){
      
        $sql = "INSERT INTO $tabla( name, descripcion, name_sistem, type, url, size, estado) 
                                    VALUES (:name, :descripcion, :name_sistem, :type, :url, :size, :estado)";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":name", $valor['name'], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $valor['descripcion'], PDO::PARAM_STR);
        $stmt->bindParam(":name_sistem", $documento[0], PDO::PARAM_STR);
        $stmt->bindParam(":type", $documento[1], PDO::PARAM_STR);
        $stmt->bindParam(":url", $documento[3], PDO::PARAM_STR);
        $stmt->bindParam(":size", $documento[2], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $valor['estado'], PDO::PARAM_INT);
       if($stmt->execute()){
            return "ok";
        }else{
           echo "Fallo al conectar a MySQL: (" . $stmt->connect_errno . ") " . $stmt->connect_error;
            print_r(Conexion::conectar()->errorInfo());
        
        }
        $stmt = null;
    }
 } 
?>