<?php
if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $mesInt = 9;
        
        
$meses = array(
            "1"=> "Enero",
            "2"=> "Febrero",
            "3"=> "Marzo",
            "4"=> "Abril",
            "5"=> "Mayo",
            "6"=> "Junio",
            "7"=> "Julio",
            "8"=> "Agosto",
            "9"=> "Septiembre",
            "10"=> "Octubre",
            "11"=> "Noviembre",
            "12"=> "Diciembre"
        );
        die("xxx: ".strtr($mesInt, $meses));
die(date("m"));        
        
$yourString = "ORTIZ";
$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
$yourString = str_replace($vowels, "", $yourString);
echo $yourString; //FlNmfHll
die("die");
//unset($_SESSION["idHistorialArchivos"]);
        echo "<pre>xxx: "; print_r($_SESSION["idHistorialArchivos"]);
 echo "-> ".implode(", ", $_SESSION["idHistorialArchivos"]);
if (isset($_SESSION["files"]) && count($_SESSION["files"]) > 0) {
        $arrFiles = array();
        $arrFiles = unserialize($_SESSION["files"]);
        echo "<pre>xxx: "; print_r($arrFiles);
        $path = __DIR__ . "/upload/docs";
        $num = 0;
        foreach ($arrFiles as $key => $files) {
            $num ++;
            $w = strtolower(pathinfo(basename($files["file"]["name"]), PATHINFO_EXTENSION));
    //    echo basename($files["file"]["name"])." [".$w."]<br>";
            $path = __DIR__ . "/upload/docs";
            $name = date("His_dmY") . "." . $w;
            $path = $path . "/" . $num . "_" . $name;
    //    echo $path."<br>";
        echo "tmp: <pre>";print_r($files['file']['tmp_name'])."<br>";
//            $_FILES["file"]["tmp_name"] = $files['file']['tmp_name'];
            if (move_uploaded_file($files['file']['tmp_name'], $path)) {
                echo " subido " . basename($_FILES["file"]["name"]) . " -> " . $path . "<br>";
            } else {
                echo " Error " . basename($files["file"]["name"]) . " -> " . $path . "<br>";
            }
            $_FILES["file"]["tmp_name"] = NULL;
        }
    }
/*
[file] => Array
(
    [name] => SCA_E1.pdf
    [type] => application/pdf
    [tmp_name] => /tmp/php7gwZ7l
    [error] => 0
    [size] => 77142
)
 */    
/*$f = array(
    "name" => 'SCA_E1.pdf',
    "type" => 'application/pdf',
    "tmp_name" => '/tmp/php7gwZ7l',
    "error" => 0,
    "size" => 77142    
);
    
if(strlen(recursive_array_search('SCA_E1.pdf', $f)) == 0 && strlen(recursive_array_search(77142, $f)) == 0){
    echo "no se encuentra";
}else{
    echo "si se encontro";
}
    
    
    
}else{
    echo "No hay files";
}
function recursive_array_search($needle, $haystack, $currentKey = '') {
    foreach($haystack as $key=>$value) {
        if (is_array($value)) {
            $nextKey = recursive_array_search($needle,$value, $currentKey . '[' . $key . ']');
            if ($nextKey) {
                return $nextKey;
            }
        }
        else if($value==$needle) {
            return is_numeric($key) ? $currentKey . '[' .$key . ']' : $currentKey . '["' .$key . '"]';
        }
    }
    return false;
}*/

/* 
* RFC= GOVG851120EF5
* CURP=GOVG851120MGRMLD06
* NSS= 11048505074
* fec: 20/11/1985: 10 digitos-> 19851120-> 851120
* Obtener la fecha de nacimiento: YYmmdd-> debe ser igual al del rfc y curp
*/
/*
$rfc =  "GOVG861120EF5";
$curp = "GOVG851120MGRMLD06";
$nss =  "11048605074";
$nss =  "";
$fn_dia = "20";
$fn_mes = "11";
$fn_year = "1985";
        $fnyear = substr($fn_year, 2,2);
        if($rfc != "" && $curp != "" && $nss != ""){
            //10 primeros digitos
            $rfc10 = substr($rfc, 0, 10);
            $curp10 = substr($curp, 0, 10);
            if($rfc10 !== $curp10){
                echo "Error<br>";
            }
            //fecha de nacimiento
            $rfcyear = substr($rfc, 4, 2);
            $curpyear = substr($curp, 4, 2);
            $nssyear = substr($nss, 4, 2);
            if( $rfcyear !== $curpyear || $rfcyear !== $nssyear || $rfcyear !== $fnyear ){
                echo "error--<br>";
            }
        }
        if($rfc != "" && $curp ){
            //10 primeros digitos
            $rfc10 = substr($rfc, 0, 10);
            $curp10 = substr($curp, 0, 10);
            if($rfc10 !== $curp10){
                echo "Errorx<br>";
            }
            //fecha de nacimiento
            $rfcyear = substr($rfc, 4, 2);
            $curpyear = substr($curp, 4, 2);
            if( $rfcyear !== $curpyear || $rfcyear !== $fnyear ){
                echo "error--<br>";
            }
        }
 
 */