<?php
extract($_REQUEST);
//include_once './modelo/ModeloXML.php';
include_once './dao/DaoFiles.php';
$daoFiles = new dao\DaoFiles\DaoFiles();
//$controllerXml = new ControllerXML();
//echo "<pre>xxx: ";print_r($_FILES);die();
//1324
$action = isset($action) ? $action : "";
$json = array();
if($action == "btnFinalizarUplods"){
//    $controllerXml->finalizarUploadXML($_REQUEST);
} else if ($action == "deleteUploadFileByID"){
    if((int)$id > 0){
        $path = $daoFiles->getURLByID($id);
        $path = __DIR__."/".$path;
        if($daoFiles->deleteUploadFilesByID($id)){
            $json["mensaje"] = "Se elimino el archivo con ID: ".$id;
            $json["estatus"] = 1;
            //eliminar del servidor
            $daoFiles->deleteFileServer($path);
        }else{
            $json["mensaje"] = "Error al eliminar el archivo con ID: ".$id;
            $json["estatus"] = 0;
        }
    }    
} else if($action == "deleteUploadFilesNoActivos"){
//    $controllerXml->deleteUploadFilesNoActivos();
}
if(isset($_FILES) && count($_FILES) > 0){   
    if (session_status() == PHP_SESSION_NONE) {session_start();}        
        $ext = strtolower(pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION));
        $nameFile = date("dmY_his_"). rand(1, 10000).".".$ext;
        $path = "upload/docs";
        $param["idEmpleado"] = 0;
        $param["nombreArchivo"] = "";
        $param["url"] = $path . "/" . $nameFile;
        $param["extension"] = "." . $ext;
        $param["tipoArchivo"] = "Documentos generales";
        $param["estatus"] = 2;
        $param["token"] = $_FILES["file"]["name"]."_".$_FILES["file"]["size"];
        if(!$daoFiles->existeFile($param["token"])){
            $id = $daoFiles->saveFiles($param);
            if($id > 0){
                if(isset($_SESSION["idHistorialArchivos"])){
                    $aux = array();
                    $aux = $_SESSION["idHistorialArchivos"];
                    array_push($aux, $id);
                    $_SESSION["idHistorialArchivos"] = $aux;
                }else{
                    $aux = array();
                    array_push($aux, $id);
                    $_SESSION["idHistorialArchivos"] = $aux;
                }
                //upload file                
                $path = __DIR__ . "/" .$path . "/" . $nameFile;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                    $json["mensaje"] = "Se ha subido el archivo: ".basename($_FILES["file"]["name"]);
                    $json["ids"] = json_encode($_SESSION["idHistorialArchivos"]);
                    $json["estatus"] = 1;                    
                } else {
                    $json["mensaje"] = "Error al subir el archivo: ".basename($_FILES["file"]["name"]);
                    $json["estatus"] = 0;
                } 
                $json["idFile"] = $id;
            }
        }else{
            $json["mensaje"] = "Ya existe guardado el archivo: ".basename($_FILES["file"]["name"]);
            $json["estatus"] = 0;
        }    
}
header('Content-type: application/json; charset=utf-8');
//        echo '<pre>';print_r($json);
die(json_encode($json)); 