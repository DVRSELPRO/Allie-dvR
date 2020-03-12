<?php 
if(!isset($debug)){header("location: http://directoresygerentesonline.com/registro-candidato.php");}
if (session_status() == PHP_SESSION_NONE) {session_start();}
ini_set('display_errors', 1);
error_reporting(E_ALL);
//include_once "./validarSesion.php";
include_once './modelo/ModeloUser.php';
include_once './modelo/ModeloDireccion.php';
include_once './controller/ControllerUser.php';
include_once './dao/DaoFiles.php';
extract($_REQUEST);
//echo '<pre>';print_r($_REQUEST);
$mDir = new \modelo\ModeloUser\ModeloDireccion();
$controllerUser = new ControllerUser();
$daoFiles = new dao\DaoFiles\DaoFiles();
$action = (isset($action) ? $action : "");
$dir = array();
$s = array();
switch ($action) {
    case "getDirByCP":
        $controllerUser->getDirByCP($cp);
    break;
    case "getCatEstados":
        $controllerUser->getCatEstados();
    break;
    case "getCiudadByEstado":
        $controllerUser->getCiudadByEstado($_REQUEST);
    break;
    case "saveRegistroCandidado":
        if(count($_POST) > 0){
            $controllerUser->registroUser($_POST);   
        }        
    break;
    
}
//Si el usuario recarga la pagina, se eliminan los archivos de la db y server
if(isset($_SESSION["idHistorialArchivos"]) && count($_SESSION["idHistorialArchivos"]) > 0){
    foreach ($_SESSION["idHistorialArchivos"] as $key => $idFile) {
        if($daoFiles->deleteFileSiNo($idFile)){           
           $path = $daoFiles->getURLByID($idFile);
           $path = __DIR__."/".$path;
           $daoFiles->deleteFileServer($path);           
           $daoFiles->deleteUploadFilesByID($idFile);
        }        
    }
    unset($_SESSION["idHistorialArchivos"]);
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include_once './includes/headerForm.php'; ?>        
        <!-- Bootstrap fileupload css -->
        <link href="plugins/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />

        <!-- Dropzone css -->
        <link href="plugins/dropzone/dropzone.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="font-montserrat">

        <!-- LOADER -->	
        <div id="loader-overflow">
            <div id="loader3" class="loader-cont">Favor de habilidar el uso de JavaScripts</div>
        </div>	

        <div id="wrap" class="boxed ">
            <div class="grey-bg"> <!-- Grey BG  -->	
                <!-- EI8 -->
                <?php include_once './includes/ie8-unsoport.php'; ?>

                <!-- HEADER 1 FONT MONTSERRAT BLACK TRANSPARENT -->
                <header id="nav" class="header header-1 affix-on-mobile">
                    <?php // include_once './includes/menu-top.php'; ?>
                    <!-- END header-wrapper -->

                </header>
                <div class="p-30-20-cont">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-sm-12"><h3 class="sl1-text">Registro de Gerentes y Directores</h3></div>
                            <div class="col-md-offset-1 col-md-4 col-sm-offset-7 col-sm-5 col-xs-offset-5 col-xs-7 mt-40x mb-20">
                                <img src="./images/logo/logo.png" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COTENT CONTAINER -->
                <div class="container">

                    <div class="row">
                        <!--<form id="frm_candidato">-->
                        <form action="#" class="frm_candidato" id="frm_candidato" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="saveRegistroCandidado">
                            <input type="hidden" name="delegacion" class="delegacion">
                            <input type="hidden" name="estado" class="estado">
                            <div class="">
                                <div class="heading-underline h3-line">
                                    <h3 class="mb-20">Datos personales</h3>
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-20">
                                    <label for="nombreempleado">Nombre</label>
                                    <input class="form-control nombreempleado" type="text" required="" id="nombreempleado" placeholder="" name="nombreempleado">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-20">
                                    <label for="apellidopaterno">Apellido paterno</label>
                                    <input class="form-control apellidopaterno" type="text" required="" id="apellidopaterno" placeholder="" name="apellidopaterno">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-20">
                                    <label for="apellidomaterno">Apellido materno</label>
                                    <input class="form-control apellidomaterno" type="text" required="" id="apellidomaterno" placeholder="" name="apellidomaterno">
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-20 selects-fechaNacimiento">
                                    <label for="fechaNacimiento">Fecha de nacimiento</label><br/>
                                    <select class="form-control-static fechaNacimiento_dia " required="" id="fechaNacimiento_dia" name="fechaNacimiento_dia">
                                        <option value="">Día</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>                                    
                                    </select>
                                    <select class="form-control-static fechaNacimiento_mes " required="" id="fechaNacimiento_mes" name="fechaNacimiento_mes">
                                        <option value="">Mes</option><option value="0">Ene</option><option value="1">Feb</option><option value="2">Mar</option><option value="3">Abr</option><option value="4">May</option><option value="5">Jun</option><option value="6">Jul</option><option value="7">Ago</option><option value="8">Sep</option><option value="9">Oct</option><option value="10">Nov</option><option value="11">Dic</option>
                                    </select>
                                    <select class="form-control-static fechaNacimiento_year " required="" id="fechaNacimiento_year" name="fechaNacimiento_year">
                                        <option value="">Año</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
                                    <label for="tieneNSS-0">¿Cuentas con Número de Seguridad Social?</label>
                                    <div class="">
                                        <input type="radio" id="tieneNSS-1" name="tieneNSS" class="custom-control-input tieneNSS" value="Si">
                                        <label class="custom-control-label" for="tieneNSS-1">Sí</label>
                                    </div>
                                    <div class="">
                                        <input type="radio" id="tieneNSS-2" name="tieneNSS" class="custom-control-input tieneNSS" value="No tramitado">
                                        <label class="custom-control-label" for="tieneNSS-2">No, autorizo su trámite</label>
                                    </div>
                                    <div class="">
                                        <input type="radio" id="tieneNSS-3" name="tieneNSS" class="custom-control-input tieneNSS" value="No lo tengo a la mano">
                                        <label class="custom-control-label" for="tieneNSS-3">No lo tengo a la mano, autorizo su consulta</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-20 div-nss" style="display: none;">
                                    <label for="nss">NSS</label>
                                    <input class="form-control nss" type="text" id="nss" placeholder="" name="nss" maxlength="11" onkeypress="return fnc_registrocandidato.isNumber(event)">
                                </div>                            
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-20">
                                    <label for="curp">CURP</label>
                                    <input class="form-control curp" type="text" required="" id="curp" placeholder="" name="curp" maxlength="18">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-20">
                                    <label for="rfc">RFC</label>
                                    <input class="form-control rfc" type="text" id="rfc" placeholder="" name="rfc" maxlength="13">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-20">
                                    <label for="estadoCivil">Estado civil</label>
                                    <select class="form-control estadoCivil " required="" id="estadoCivil" name="estadoCivil">
                                        <option value="">Seleccionar</option>
                                        <option value="Soltero">Soltero</option>
                                        <option value="Casado">Casado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="">
                                <div class="heading-underline h3-line">
                                    <h3 class="mb-20">Datos de contacto</h3>
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-20">
                                    <label for="calle">Calle</label>
                                    <input class="form-control calle" type="text" required="" id="calle" placeholder="" name="calle">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-20">
                                    <label for="numeroExterior">Núm. Ext.</label>
                                    <input class="form-control numeroExterior" type="text" required="" id="numeroExterior" placeholder="" name="numeroExterior">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-20">
                                    <label for="numeroInterior">Núm. int.</label>
                                    <input class="form-control numeroInterior" type="text" id="numeroInterior" placeholder="" name="numeroInterior">
                                </div>                                
                                <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-20">
                                    <label for="cp">CP</label>
                                    <input class="form-control cp" type="number" required="" id="cp" name="cp" maxlength="5" onchange="fnc_registrocandidato.getDirByCP($(this).val());" >
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
                                    <label for="colonia">Colonia</label>
                                    <select class="form-control colonia" required="" id="colonia" name="colonia">
                                        <option value="">Seleccionar</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
                                    <label for="ciudad">Ciudad</label>
                                    <input class="form-control ciudad" type="text" required="" id="ciudad" placeholder="" name="ciudad">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-20">
                                    <label for="email">Correo electrónico</label>
                                    <input class="form-control email" type="email" required="" id="email" placeholder="" name="email">
                                </div>                            
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-20">
                                    <label for="telefonoCelular">Celular</label>
                                    <input class="form-control telefonoCelular" type="tel" id="telefonoCelular" placeholder="" name="telefonoCelular" maxlength="10" onkeypress="return fnc_registrocandidato.isNumber(event)">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-20">
                                    <label for="telefonoFijo">Teléfono fijo</label>
                                    <input class="form-control telefonoFijo" type="tel" id="telefonoFijo" placeholder="" name="telefonoFijo" maxlength="10" onkeypress="return fnc_registrocandidato.isNumber(event)">
                                </div>
                            </div>
                            <div class="">
                                <div class="heading-underline h3-line">
                                    <h3 class="mb-20">Otros datos</h3>
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
                                    <label for="nivelEstudio">Nivel de estudios</label>
                                    <select class="form-control nivelEstudio" required="" id="nivelEstudio" name="nivelEstudio">
                                        <option value="">Seleccionar</option>
                                        <option value="Posgrado">Posgrado</option>
                                        <option value="Licenciatura/Ingeniería">Licenciatura/Ingeniería</option>
                                        <option value="Medio superior">Medio superior</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
                                    <label for="dependientesEconomico">¿Tienes dependientes económicos?</label>
                                    <div class="">
                                        <input type="radio" id="dependientesEconomico-1" name="dependientesEconomico" class="custom-control-input dependientesEconomico" value="Si">
                                        <label class="custom-control-label" for="dependientesEconomico-1">Sí</label>
                                    </div>
                                    <div class="">
                                        <input type="radio" id="dependientesEconomico-2" name="dependientesEconomico" class="custom-control-input dependientesEconomico" value="No">
                                        <label class="custom-control-label" for="dependientesEconomico-2">No</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
                                    <label for="experienciaLaboral_estatus">¿Se encuentra laborando actualmente?</label>
                                    <div class="">
                                        <input type="radio" id="experienciaLaboral_estatus-1" name="experienciaLaboral_estatus" class="custom-control-input experienciaLaboral_estatus" value="Si">
                                        <label class="custom-control-label" for="experienciaLaboral_estatus-1">Sí</label>
                                    </div>
                                    <div class="">
                                        <input type="radio" id="experienciaLaboral_estatus-2" name="experienciaLaboral_estatus" class="custom-control-input experienciaLaboral_estatus" value="No">
                                        <label class="custom-control-label" for="experienciaLaboral_estatus-2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
                                    <label for="experienciaLaboral_puesto">Último puesto</label>
                                    <select class="form-control experienciaLaboral_puesto" required="" id="experienciaLaboral_puesto" name="experienciaLaboral_puesto">
                                        <option value="">Seleccionar</option>
                                        <option value="Gerente">Gerente</option>
                                        <option value="Directivo">Directivo</option>
                                        <option value="Coordinador">Coordinador</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
                                    <label for="lugarTrabajo-0" class="lugarTrabajo-0">¿Prestaré mis servicios en ésta misma dirección?</label>
                                    <div class="">
                                        <input type="radio" id="lugarTrabajo-1" name="lugarTrabajo" class="custom-control-input lugarTrabajo" value="Si">
                                        <label class="custom-control-label" for="lugarTrabajo-1">Sí</label>
                                    </div>
                                    <div class="">
                                        <input type="radio" id="lugarTrabajo-2" name="lugarTrabajo" class="custom-control-input lugarTrabajo" value="No">
                                        <label class="custom-control-label" for="lugarTrabajo-2">No, seleccionar otro</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20 div-lugarTrabajo" style="display: none">
                                    <label for="empleado_lugarTrabajo_estado">Estado:</label>
                                    <select class="form-control empleado_lugarTrabajo_estado" required="" id="empleado_lugarTrabajo_estado" name="empleado_lugarTrabajo_estado" onchange="fnc_registrocandidato.getCiudadByEstado($('select.empleado_lugarTrabajo_estado').val())">
                                        <option value="">Seleccionar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-b-20 div-lugarTrabajo" style="display: none">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20 div-ciudad">
                                    <label for="empleado_lugarTrabajo_ciudad">Ciudad</label>
                                    <select class="form-control empleado_lugarTrabajo_ciudad" required="" id="empleado_lugarTrabajo_ciudad" name="empleado_lugarTrabajo_ciudad">
                                        <option value="">Seleccionar</option>                                    
                                    </select>
                                </div>
                            </div>

                            <div class="heading-underline h3-line">
                                <h3 class="mb-20">Documentos</h3>                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12x col-12 mb-20">                                
                                <h4 class="header-title m-t-0">Se anexan los siguientes documentos:</h4>
                                
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input nombreArchivo" id="dato-1" name="nombreArchivo[]" value="IFE/INE O Pasaporte">
                                    <label class="custom-control-label" for="dato-1">IFE/INE O Pasaporte</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input nombreArchivo" id="dato-2" name="nombreArchivo[]" value="Curriculum">
                                    <label class="custom-control-label" for="dato-2">Curriculum actualizado</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input nombreArchivo" id="dato-3" name="nombreArchivo[]" value="Comprobante de domicilio">
                                    <label class="custom-control-label" for="dato-3">Comprobante de domicilio</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input nombreArchivo" id="dato-4" name="nombreArchivo[]" value="Certificado de estudios">
                                    <label class="custom-control-label" for="dato-4">Certificado de estudios (Título, cédula)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input nombreArchivo" id="dato-5" name="nombreArchivo[]" value="Número de Seguridad Social">
                                    <label class="custom-control-label" for="dato-5">Número de Seguridad Social</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input nombreArchivo" id="dato-6" name="nombreArchivo[]" value="CURP">
                                    <label class="custom-control-label" for="dato-6">CURP</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input nombreArchivo" id="dato-7" name="nombreArchivo[]" value="Ultimos dos recibos de nómina">
                                    <label class="custom-control-label" for="dato-7">Ultimos dos recibos de nómina</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input nombreArchivo" id="dato-8" name="nombreArchivo[]" value="RFC">
                                    <label class="custom-control-label" for="dato-8">RFC</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12x col-12 mb-20">
                                <h4 class="header-title m-t-0">Arrastra o selecciona los archivos (PDF, WORD, PNG, JPEG, JPG )</h4>
                                <div class="row divUploadFiles">
                                    <div class="col-12">
                                        <div class="card-box">                                            
<!--                                            <form action="#" class="dropzone" id="dropzone" method="POST" enctype="multipart/form-data">-->
                                            <div class="dropzone" id="dropzone">
                                                 <div class="fallback">
                                                    <input name="file" type="file" multiple />
                                                </div>
                                            </div>

                                            <!--</form>-->   
                                            <div class="clearfix text-right mt-3">
                                                <button type="button" class="btn btn-custom waves-effect waves-light btnAceptar" id="btnAceptar" style="display: none;" onclick="fnc_subirXml.btnContinuar();">Continuar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>                            

                            <div class="col-md-12 text-right">
                                <div class="heading-underline h3-line">
                                    <h3 class="mb-15"></h3>
                                </div>
                                <button type="submit" class="button medium hover-thin deeporange btnFinalizar">Finalizar</button>                                
                            </div> 
                            <div class="col-md-12">
                                <br/>
                                <div id="alerts" class="mb-100 bs-docs-section">
                                    <div class="alert nobottommargin div_mensajes" style="display: none;">
                                        <button type="button" class="close" data-dismiss="alertx" aria-hidden="true" onclick="fnc_registrocandidato.closeDivAlert();">×</button>                                        
                                        <span aria-hidden="true" class="alert-icon icon_like" style="display: none;"></span>
                                        <span aria-hidden="true" class="alert-icon icon_blocked" style="display: none;"></span>
                                        <strong>Aviso</strong> <div class="mensaje"></div>
                                    </div>

                                </div>
                            </div> 
                        </form>
                    </div><!-- /row                     
                </div><!-- /container -->

                    <!-- FOOTER 3 FONT MONTSERRAT -->
                    <?php // include_once './includes/footer.php'; ?>

                    <!-- BACK TO TOP -->
                    <p id="back-top">
                        <a href="#top" title="Ir al inicio"><span class="icon icon-arrows-up"></span></a>
                    </p>

                </div><!-- End BG -->	
            </div><!-- End wrap -->	

            <!-- JS begin -->
            <?php include_once './includes/footer-form.php'; ?>
            <?php // include_once './includes/footer-files-sliders.php'; ?>        
            <!--JS customizados-->        
            <!-- Bootstrap fileupload js -->
            <script src="plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
            <!-- Dropzone js -->
            <script src="plugins/dropzone/dropzone.js"></script>
            <script src="./js/registro-candidato.js"></script>
    </body>
</html>		