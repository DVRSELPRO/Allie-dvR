<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once './utilidades/varsGlobal.php';
include_once './modelo/ModeloXML.php';
include_once './modelo/ModeloUser.php';
include_once './dao/DaoXML.php';
include_once './dao/DaoUser.php';
include_once './utilidades/EnviarCorreo.php';
include_once './utilidades/TmpsMails.php';
include_once './utilidades/UtilsMysql.php';
include_once './utilidades/Utils.php';
include_once './controller/ControllerUser.php';
require_once './utilidades/UtilsReadXML.php';

class ControllerXML {

    private $daoXml = null;
    private $daoUser = null;
    private $mail = null;
    private $utilsMysql = null;
    private $utils = null;
    private $strXML = null;

    function __construct() {
        $this->daoXml = new DaoXML\DaoXML();
        $this->mail = new \utilidades\EnviarCorreo\EnviarCorreo();
        $this->utilsMysql = new \utilidades\UtilsMysql\UtilsMysql();
        $this->utils = new Utils\Utils();
        $this->daoUser = new dao\DaoUser\DaoUser();
    }

    public function saveXml($file) {
        $json = array();
        $modeloSession = new ModeloUser\ModeloUser();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $modeloSession = (isset($_SESSION["ModeloUser"]) ? unserialize($_SESSION["ModeloUser"]) : array());
        if (isset($_SESSION["ModeloUser"]) && (int) $modeloSession->getIduser() > 0) {
            $this->strXML = file_get_contents($file["file"]["tmp_name"]);
            //valida que al final de la cadena no tenga un "
            if (ord(substr($this->strXML, -1)) == 34) {
                $this->strXML = substr($this->strXML, 0, -1);
            }
            if ($this->getTipoCFDI($this->strXML) == "I") {
                if ($this->utils->checkEncoding($this->strXML, "UTF-8")) {
                    //echo "total: ".strlen($str)."<br/>";
                    $arrXML = array();
                    $arrData = $this->getContentXML();
                    if ($arrData["estatus"] == 1) {
                        $arrXML = $arrData["arrxml"];
                        if (count($arrXML) > 0) {
                            $arrXML = $this->setXMLModeloIngreso($arrXML);
                            if (isset($arrXML["estatus"]) && $arrXML["estatus"] == 1) {
                                //validar que los xmls a subir sean de la persona registrada
                                $mxml = new ModeloXML\ModeloXML();
                                $mxml = $arrXML["xml"];
                                //                      echo "<pre>";print_r($mxml);                            
                                if ((int) $this->daoXml->getUuid($mxml->getComplementoTFUUID()) == 0) {
                                    $id = $this->daoXml->saveXml($mxml);
                                    if ((int) $id > 0) {
                                        $json["estatus"] = 1;
                                        $json["mensaje"] = "<b>" . $file["file"]["name"] . "</b> se ha procesado correctamente";
                                        $json["rfc"] = $mxml->getReceptorRfc();
                                        $json["razonsocial"] = $mxml->getReceptorNombre();
                                        $json["subtotal"] = $mxml->getComplementoAtribSubTotal();
                                        $json["iva"] = $mxml->getTotalImpuesto();
                                        $json["total"] = $mxml->getComplementoAtribTotal();
                                        $json["uuid"] = $mxml->getComplementoTFUUID();
                                        $json["idxml"] = $id;
                                        $json["fecha"] = date('d/m/Y H:i:s', strtotime($mxml->getComplementoTFFechaTimbrado()));
                                    } else {
                                        $json["estatus"] = 0;
                                        $json["mensaje"] = "Error al guardar el archivo <b>" . $file["file"]["name"] . "</b> con UUID <b>" . $mxml->getComplementoTFUUID() . "</b>.";
                                    }
                                } else {
                                    $json["estatus"] = 0;
                                    $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> con UUID <b>" . $mxml->getComplementoTFUUID() . "</b> ya se encuentra en el sistema.";
                                }
                            } else {
                                $json["estatus"] = 0;
                                $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> " . $arrXML["mensaje"];
                            }
                        }
                    } else {
                        $json["estatus"] = 0;
                        $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> " . $arrData["mensaje"];
                    }
                } else {
                    $json["estatus"] = 0;
                    $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> al parecer su contenido XML está en ISO-8859-1, no en UTF-8. Notifique a su proveedor y pídale que lo solucionen, porque si no funciona para usted probablemente tampoco funcione para otras personas.";
                }
            } else if ($this->getTipoCFDI($this->strXML) == "P") {
                $json["estatus"] = 0;
                    $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> es un XML de tipo CFDI de tipo Pagos. Éste tipo no es soportado. Favor de seleccionar un CFDI de tipo Ingresos.";
                /*if ($this->utils->checkEncoding($this->strXML, "UTF-8")) {
                    //echo "total: ".strlen($str)."<br/>";
                    $arrXML = array();
                    $arrData = $this->getContentXML();
                    if ($arrData["estatus"] == 1) {
                        $arrXML = $arrData["arrxml"];
                        if (count($arrXML) > 0) {
                            $arrXML = $this->setXMLModeloPago($arrXML);
                            if (isset($arrXML["estatus"]) && $arrXML["estatus"] == 1) {
                                //validar que los xmls a subir sean de la persona registrada
                                $mxml = new ModeloXML\ModeloXML();
                                $mxml = $arrXML["xml"];
                                //                      echo "<pre>";print_r($mxml);                            
                                if ((int) $this->daoXml->getUuid($mxml->getComplementoTFUUID()) == 0) {
                                    $id = $this->daoXml->saveXml($mxml);
                                    if ((int) $id > 0) {
                                        $json["estatus"] = 1;
                                        $json["mensaje"] = "<b>" . $file["file"]["name"] . "</b> se ha procesado correctamente";
                                        $json["rfc"] = $mxml->getReceptorRfc();
                                        $json["razonsocial"] = $mxml->getReceptorNombre();
                                        $json["subtotal"] = $mxml->getComplementoAtribSubTotal();
                                        $json["iva"] = $mxml->getTotalImpuesto();
                                        $json["total"] = $mxml->getComplementoAtribTotal();
                                        $json["uuid"] = $mxml->getComplementoTFUUID();
                                        $json["idxml"] = $id;
                                        $json["fecha"] = date('d/m/Y H:i:s', strtotime($mxml->getComplementoTFFechaTimbrado()));
                                    } else {
                                        $json["estatus"] = 0;
                                        $json["mensaje"] = "Error al guardar el archivo <b>" . $file["file"]["name"] . "</b> con UUID <b>" . $mxml->getComplementoTFUUID() . "</b>.";
                                    }
                                } else {
                                    $json["estatus"] = 0;
                                    $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> con UUID <b>" . $mxml->getComplementoTFUUID() . "</b> ya se encuentra en el sistema.";
                                }
                            } else {
                                $json["estatus"] = 0;
                                $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> " . $arrXML["mensaje"];
                            }
                        }
                    } else {
                        $json["estatus"] = 0;
                        $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> " . $arrData["mensaje"];
                    }
                } else {
                    $json["estatus"] = 0;
                    $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> al parecer su contenido XML está en ISO-8859-1, no en UTF-8. Notifique a su proveedor y pídale que lo solucionen, porque si no funciona para usted probablemente tampoco funcione para otras personas.";
                }*/
            } else {
                $json["estatus"] = 0;
                $json["mensaje"] = "El archivo <b>" . $file["file"]["name"] . "</b> de tipo CFDI: <b>[" . $this->getTipoCFDI($this->strXML) . "]</b> no es soportado o inválido.";
            }
        } else {
            $json["estatus"] = 0;
            $json["mensaje"] = "Ha caducado su sesión Favor de iniciar sesion.";
        }
        //echo '<pre>';print_r($json);echo '</pre>';die();        
        header('Content-type: application/json; charset=utf-8');
        die(json_encode($json, JSON_UNESCAPED_UNICODE));
    }

    public function finalizarUploadXML($params) {
        extract($params);
        $json = array();
        //echo '<pre>';print_r($params);die();
        if (isset($uuids) && count($uuids) > 0) {
            $flag = array();
            foreach ($uuids as $key => $uuid) {
                $x = $this->daoXml->updateEstatusXML($uuid);
                array_push($flag, $x);
            }
            if (count($flag) > 0) {
                $x = true;
                foreach ($flag as $key => $st) {
                    if (!$st) {
                        $x = false;
                        break;
                    }
                }
                $json["estatus"] = $x ? 1 : 0;
                $json["mensaje"] = $x ? "Se ha guardado correctamente." : "Error al guardar. Favor de volver a intentarlo.";
                $json["arr"] = $flag;
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION["arrModeloXmls"])) {
                    unset($_SESSION["arrModeloXmls"]);
                }
            }
        } else {
            $json["estatus"] = 0;
            $json["mensaje"] = "No hay uuids para modificar";
        }
        header('Content-type: application/json; charset=utf-8');
        die(json_encode($json, JSON_UNESCAPED_UNICODE));
    }

    public function getContentXML() {
        $process = array();
        if ($this->strXML != "" && strlen($this->strXML) > 1000) {
            $array = \XML2Array::createArray($this->strXML);
//            echo "<pre>";
//            print_r($array);
            $process["arrxml"] = $array;
            $process["estatus"] = 1;
            $process["mensaje"] = "se convertió a array correctamente";
        } else {
            $process["estatus"] = 0;
            $process["mensaje"] = "El archivo es inválido. La cantidad de caracteres (" . strlen($this->strXML) . " es muy poco.)";
        }
        return $process;
    }

    public function setXMLModeloIngreso($data) {
        $arr = array();
        $arr["xml"] = array();
//        echo "<pre>";print_r($data);die();
        if (is_array($data) && count($data) > 0) {
            //obtener el contenido del xml
            if ($this->getTipoCFDI($this->strXML) == "I") {
                $arrEmisor = $this->getEmisor($data);
                $arrReceptor = $this->getReceptor($data);
                $arrConceptosImpuestos = $this->getConceptosImpuestos($data);
                $arrImpuestosTransladado = $this->getImpuestosTransladado($data);
                $arrTotalImpuestosTransladado = $this->getTotalImpuestosTransladado($data);
                $arrComplementoTimbreFiscal = $this->getComplementoTimbreFiscal($data);
                $arrComplementoAtributes = $this->getComplementoAtrributes($data);
                if ($arrEmisor["estatus"] == 1) {
                    if ($arrReceptor["estatus"] == 1) {
                        if ($arrConceptosImpuestos["estatus"] == 1) {
                            if ($arrImpuestosTransladado["estatus"] == 1) {
                                if ($arrTotalImpuestosTransladado["estatus"] == 1) {
                                    if ($arrComplementoTimbreFiscal["estatus"] == 1) {
                                        if ($arrComplementoAtributes["estatus"] == 1) {
                                            if ($arrComplementoAtributes["Version"] == 3.3) {
                                                if (isset($arrComplementoTimbreFiscal["UUID"])) {
                                                    $arr["estatus"] = 1;
                                                    $arr["mensaje"] = "XML validado correctamente";
                                                    //agregar los datos al modeloXML
                                                    $arr["xml"] = $this->addDataModeloIngreso($arrEmisor, $arrReceptor, $arrConceptosImpuestos, $arrImpuestosTransladado, $arrTotalImpuestosTransladado, $arrComplementoTimbreFiscal, $arrComplementoAtributes);
                                                } else {
                                                    $arr["estatus"] = 0;
                                                    $arr["mensaje"] = "No se ha encontrado el UUID";
                                                }
                                            } else {
                                                $arr["estatus"] = 0;
                                                $arr["mensaje"] = "El XML debe ser de la Versión 3.3";
                                            }
                                        } else {
                                            $arr["estatus"] = 0;
                                            $arr["mensaje"] = $arrComplementoAtributes["mensaje"];
                                        }
                                    } else {
                                        $arr["estatus"] = 0;
                                        $arr["mensaje"] = $arrComplementoTimbreFiscal["mensaje"];
                                    }
                                } else {
                                    $arr["estatus"] = 0;
                                    $arr["mensaje"] = $arrTotalImpuestosTransladado["mensaje"];
                                }
                            } else {
                                $arr["estatus"] = 0;
                                $arr["mensaje"] = $arrImpuestosTransladado["mensaje"];
                            }
                        } else {
                            $arr["estatus"] = 0;
                            $arr["mensaje"] = $arrConceptosImpuestos["mensaje"];
                        }
                    } else {
                        $arr["estatus"] = 0;
                        $arr["mensaje"] = $arrReceptor["mensaje"];
                    }
                } else {
                    $arr["estatus"] = 0;
                    $arr["mensaje"] = $arrEmisor["mensaje"];
                }
            } else {
                $arr["mensaje"] = "Inválido tipo CFDI. [" . $this->getTipoCFDI($this->strXML) . "]";
            }
        }
//        echo "<pre>";print_r($arr);die();
        return $arr;
    }

    public function setXMLModeloPago($data) {
        $arr = array();
        $arr["xml"] = array();
//        echo "<pre>";print_r($data);die();
        if (is_array($data) && count($data) > 0) {
            //obtener el contenido del xml
            $arrEmisor = $this->getEmisor($data);
            $arrReceptor = $this->getReceptor($data);
            $arrConceptosPagos = $this->getConceptosPagos($data);
            $arrComplementoTimbreFiscal = $this->getComplementoTimbreFiscal($data);
            $arrComplementoAtributes = $this->getComplementoAtrributes($data);
            $arrCFDIRelacionado = $this->getCfdiRelacionado($data);
            $arrComplementoPagos = $this->getComplementoPagos($data);
            if ($arrEmisor["estatus"] == 1) {
                if ($arrReceptor["estatus"] == 1) {
                    if ($arrConceptosPagos["estatus"] == 1) {
                        if ($arrComplementoTimbreFiscal["estatus"] == 1) {
                            if ($arrComplementoAtributes["estatus"] == 1) {
                                if ($arrCFDIRelacionado["estatus"] == 1) {
                                    if ($arrComplementoPagos["estatus"] == 1) {
                                        if (isset($arrComplementoTimbreFiscal["UUID"])) {
                                            $arr["estatus"] = 1;
                                            $arr["mensaje"] = "XML validado correctamente";
                                            //agregar los datos al modeloXML 
                                            $arr["xml"] = $this->addDataModeloPago($arrEmisor, $arrReceptor, $arrConceptosPagos, $arrComplementoTimbreFiscal, $arrComplementoAtributes, $arrCFDIRelacionado, $arrComplementoPagos);
//                                            echo "<pre>";print_r($arr["xml"]);die();
                                        } else {
                                            $arr["estatus"] = 0;
                                            $arr["mensaje"] = "No se ha encontrado el UUID";
                                        }
                                    } else {
                                        $arr["estatus"] = 0;
                                        $arr["mensaje"] = $arrComplementoPagos["mensaje"];
                                    }
                                } else {
                                    $arr["estatus"] = 0;
                                    $arr["mensaje"] = $arrCFDIRelacionado["mensaje"];
                                }
                            } else {
                                $arr["estatus"] = 0;
                                $arr["mensaje"] = $arrComplementoAtributes["mensaje"];
                            }
                        } else {
                            $arr["estatus"] = 0;
                            $arr["mensaje"] = $arrComplementoTimbreFiscal["mensaje"];
                        }
                    } else {
                        $arr["estatus"] = 0;
                        $arr["mensaje"] = $arrConceptosPagos["mensaje"];
                    }
                } else {
                    $arr["estatus"] = 0;
                    $arr["mensaje"] = $arrReceptor["mensaje"];
                }
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = $arrEmisor["mensaje"];
            }
        }
//        echo "<pre>";print_r($arr);die();
        return $arr;
    }

    public function addDataModeloIngreso($arrEmisor, $arrReceptor, $arrConceptosImpuestos, $arrImpuestosTransladado, $arrTotalImpuestosTransladado, $arrComplementoTimbreFiscal, $arrComplementoAtributes) {
        $aux = new ModeloXML\ModeloXML();
        //Emisor
        $aux->setEmisorRfc($arrEmisor["Rfc"]);
        $aux->setEmisorNombre($arrEmisor["Nombre"]);
        $aux->setEmisorRegimenFiscal($arrEmisor["RegimenFiscal"]);
        //Receptor
        $aux->setReceptorRfc($arrReceptor["Rfc"]);
        $aux->setReceptorNombre($arrReceptor["Nombre"]);
        $aux->setReceptorUsoCFDI($arrReceptor["UsoCFDI"]);
        //agregar los arrays de conceptos
        foreach ($arrConceptosImpuestos["impuestos"] as $k1 => $arrVal) {
            foreach ($arrVal as $k2 => $val) {
                $arrAux[$k1][$k2] = (is_numeric($val) ? $this->utils->convertMontoToDecimal($val, 2) : $val);
                $aux->setArrConceptos($arrAux);
            }
        }
        //agregar los arrays de atributos
        foreach ($arrConceptosImpuestos["atributos"] as $k1 => $arrVal) {
            foreach ($arrVal as $k2 => $val) {
                $arrAux[$k1][$k2] = (is_numeric($val) ? $this->utils->convertMontoToDecimal($val, 2) : $val);
                ;
                $aux->setArrAtributos($arrAux);
            }
        }
        //agregar los impuestos trasladado
        $aux->setImpuestoImpuesto($arrImpuestosTransladado["Impuesto"]);
        $aux->setImpuestoTipoFactor($arrImpuestosTransladado["TipoFactor"]);
        $aux->setImpuestoTasaOCuota($arrImpuestosTransladado["TasaOCuota"]);
        $aux->setImpuestoImporte($arrImpuestosTransladado["Importe"]);
        //Agregar total impuestos trasladado
        $aux->setTotalImpuesto($this->utils->convertMontoToDecimal($arrTotalImpuestosTransladado["TotalImpuestosTrasladados"], 2));
        //Agregar timbre fiscal digital
        $aux->setComplementoTFschemaLocation($arrComplementoTimbreFiscal["schemaLocation"]);
        $aux->setComplementoTFVersion($arrComplementoTimbreFiscal["Version"]);
        $aux->setComplementoTFUUID($arrComplementoTimbreFiscal["UUID"]);
        $aux->setComplementoTFFechaTimbrado($arrComplementoTimbreFiscal["FechaTimbrado"]);
        $aux->setComplementoTFRfcProvCertif($arrComplementoTimbreFiscal["RfcProvCertif"]);
        $aux->setComplementoTFSelloCFD($arrComplementoTimbreFiscal["SelloCFD"]);
        $aux->setComplementoTFNoCertificadoSAT($arrComplementoTimbreFiscal["NoCertificadoSAT"]);
        $aux->setComplementoTFSelloSAT($arrComplementoTimbreFiscal["SelloSAT"]);
        //Agregar timbre fiscal atributos
        $aux->setComplementoAtribschemaLocation($arrComplementoAtributes["schemaLocation"]);
        $aux->setComplementoAtribVersion($arrComplementoAtributes["Version"]);
        $aux->setComplementoAtribSerie($arrComplementoAtributes["Serie"]);
        $aux->setComplementoAtribFolio($arrComplementoAtributes["Folio"]);
        $aux->setComplementoAtribFecha($arrComplementoAtributes["Fecha"]);
        $aux->setComplementoAtribSello($arrComplementoAtributes["Sello"]);
        $aux->setComplementoAtribFormaPago($arrComplementoAtributes["FormaPago"]);
        $aux->setComplementoAtribNoCertificado($arrComplementoAtributes["NoCertificado"]);
        $aux->setComplementoAtribCertificado($arrComplementoAtributes["Certificado"]);
        $aux->setComplementoAtribSubTotal($this->utils->convertMontoToDecimal($arrComplementoAtributes["SubTotal"], 2));
        $aux->setComplementoAtribMoneda($arrComplementoAtributes["Moneda"]);
        $aux->setComplementoAtribTotal($this->utils->convertMontoToDecimal($arrComplementoAtributes["Total"], 2));
        $aux->setComplementoAtribTipoDeComprobante($arrComplementoAtributes["TipoDeComprobante"]);
        $aux->setComplementoAtribMetodoPago($arrComplementoAtributes["MetodoPago"]);
        $aux->setComplementoAtribLugarExpedicion($arrComplementoAtributes["LugarExpedicion"]);
        $aux->setContentXML($this->strXML);
        return $aux;
    }

    public function addDataModeloPago($arrEmisor, $arrReceptor, $arrConceptosPagos, $arrComplementoTimbreFiscal, $arrComplementoAtributes, $arrCFDIRelacionado, $arrComplementoPagos) {
        $aux = new ModeloXML\ModeloXML();
        //CFDI Relacionado
        $aux->setCfdiRelacionadoUUID($arrCFDIRelacionado["UUID"]);
        $aux->setCfdiRelacionadoTipoRelacion($arrCFDIRelacionado["TipoRelacion"]);
        //Emisor
        $aux->setEmisorRfc($arrEmisor["Rfc"]);
        $aux->setEmisorNombre($arrEmisor["Nombre"]);
        $aux->setEmisorRegimenFiscal($arrEmisor["RegimenFiscal"]);
        //Receptor
        $aux->setReceptorRfc($arrReceptor["Rfc"]);
        $aux->setReceptorNombre($arrReceptor["Nombre"]);
        $aux->setReceptorUsoCFDI($arrReceptor["UsoCFDI"]);
        //agregar pago10:Pagos DoctoRelacionado
        $aux->setDocIdDocumento($arrComplementoPagos["IdDocumento"]);
        $aux->setDocSerie($arrComplementoPagos["Serie"]);
        $aux->setDocFolio($arrComplementoPagos["Folio"]);
        $aux->setDocMonedaDR($arrComplementoPagos["MonedaDR"]);
        $aux->setDocMetodoDePagoDR($arrComplementoPagos["MetodoDePagoDR"]);
        $aux->setDocNumParcialidad($arrComplementoPagos["NumParcialidad"]);
        $aux->setDocImpSaldoAnt($arrComplementoPagos["ImpSaldoAnt"]);
        $aux->setDocImpPagado($arrComplementoPagos["ImpPagado"]);
        $aux->setDocImpSaldoInsoluto($arrComplementoPagos["ImpSaldoInsoluto"]);
        $aux->setDocFechaPago($arrComplementoPagos["FechaPago"]);
        $aux->setDocFormaDePagoP($arrComplementoPagos["FormaDePagoP"]);
        $aux->setDocMonedaP($arrComplementoPagos["MonedaP"]);
        $aux->setDocMonto($arrComplementoPagos["Monto"]);
        $aux->setDocNumOperacion($arrComplementoPagos["NumOperacion"]);
        $aux->setDocVersion($arrComplementoPagos["Version"]);

        //agregar los arrays de conceptos
        foreach ($arrConceptosPagos["conceptos"] as $k1 => $arrVal) {
            foreach ($arrVal as $k2 => $val) {
                $arrAux[$k1][$k2] = (is_numeric($val) ? $this->utils->convertMontoToDecimal($val, 2) : $val);
                $aux->setArrConceptos($arrAux);
            }
        }

        //Agregar timbre fiscal digital
        $aux->setComplementoTFschemaLocation($arrComplementoTimbreFiscal["schemaLocation"]);
        $aux->setComplementoTFVersion($arrComplementoTimbreFiscal["Version"]);
        $aux->setComplementoTFUUID($arrComplementoTimbreFiscal["UUID"]);
        $aux->setComplementoTFFechaTimbrado($arrComplementoTimbreFiscal["FechaTimbrado"]);
        $aux->setComplementoTFRfcProvCertif($arrComplementoTimbreFiscal["RfcProvCertif"]);
        $aux->setComplementoTFSelloCFD($arrComplementoTimbreFiscal["SelloCFD"]);
        $aux->setComplementoTFNoCertificadoSAT($arrComplementoTimbreFiscal["NoCertificadoSAT"]);
        $aux->setComplementoTFSelloSAT($arrComplementoTimbreFiscal["SelloSAT"]);
        //Agregar timbre fiscal atributos
        $aux->setComplementoAtribschemaLocation($arrComplementoAtributes["schemaLocation"]);
        $aux->setComplementoAtribVersion($arrComplementoAtributes["Version"]);
        $aux->setComplementoAtribSerie($arrComplementoAtributes["Serie"]);
        $aux->setComplementoAtribFolio($arrComplementoAtributes["Folio"]);
        $aux->setComplementoAtribFecha($arrComplementoAtributes["Fecha"]);
        $aux->setComplementoAtribSello($arrComplementoAtributes["Sello"]);
        $aux->setComplementoAtribFormaPago($arrComplementoPagos["FormaDePagoP"]);
        $aux->setComplementoAtribNoCertificado($arrComplementoAtributes["NoCertificado"]);
        $aux->setComplementoAtribCertificado($arrComplementoAtributes["Certificado"]);
        $aux->setComplementoAtribSubTotal($this->utils->convertMontoToDecimal($arrComplementoAtributes["SubTotal"], 2));
        $aux->setComplementoAtribMoneda($arrComplementoAtributes["Moneda"]);
        $aux->setComplementoAtribTotal($this->utils->convertMontoToDecimal($arrComplementoAtributes["Total"], 2));
        $aux->setComplementoAtribTipoDeComprobante($arrComplementoAtributes["TipoDeComprobante"]);
        $aux->setComplementoAtribMetodoPago($arrComplementoPagos["MetodoDePagoDR"]);
        $aux->setComplementoAtribLugarExpedicion($arrComplementoAtributes["LugarExpedicion"]);
        $aux->setContentXML($this->strXML);
        return $aux;
    }

    /*
     * START CFDI INGRESOS AND PAGOS
     */

    public function getEmisor($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
                if ($key == "cfdi:Comprobante") {
                    if (isset($arrValues["cfdi:Emisor"])) {
                        foreach ($arrValues["cfdi:Emisor"] as $key2 => $arrValues2) {
                            if ($key2 == "@attributes") {
                                $arr["Rfc"] = $arrValues2["Rfc"];
                                $arr["Nombre"] = $arrValues2["Nombre"];
                                $arr["RegimenFiscal"] = $arrValues2["RegimenFiscal"];
                            }
                        }
                    }
                }
            }
            if (isset($arr["Rfc"])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se obtenido correctamente los datos del emisor";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getEmisor(): No se pudo obtener el emisor";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio";
        }
//        echo "Emisor: <pre>";print_r($arr);
        return $arr;
    }

    public function getReceptor($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
                if ($key == "cfdi:Comprobante") {
                    if (isset($arrValues["cfdi:Receptor"])) {
                        foreach ($arrValues["cfdi:Receptor"] as $key2 => $arrValues2) {
                            if ($key2 == "@attributes") {
                                $arr["Rfc"] = $arrValues2["Rfc"];
                                $arr["Nombre"] = $arrValues2["Nombre"];
                                $arr["UsoCFDI"] = $arrValues2["UsoCFDI"];
                            }
                        }
                    }
                }
            }
            if (isset($arr["Rfc"])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se obtenido correctamente los datos del Receptor";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getReceptor(): No se pudo obtener el Receptor";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio";
        }
//        echo "Receptor: <pre>";print_r($arr);
        return $arr;
    }

    public function getConceptosImpuestos($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
                if ($key == "cfdi:Comprobante") {
                    //determinar si trae varios conceptos
                    if (isset($arrValues["cfdi:Conceptos"]["cfdi:Concepto"][0])) { //trae muchos conceptos
                        foreach ($arrValues["cfdi:Conceptos"]["cfdi:Concepto"] as $key2 => $conceptos) {
                            foreach ($conceptos as $key3 => $val) {
                                if (isset($val["cfdi:Traslados"]["cfdi:Traslado"])) {
                                    foreach ($val["cfdi:Traslados"]["cfdi:Traslado"] as $key4 => $val2) {
                                        if ($key4 == "@attributes") {
                                            foreach ($val2 as $k => $values) {
                                                $arr["impuestos"][$key2][$k] = $values;
                                            }
                                        }
                                    }
                                }
                            }
                            foreach ($conceptos["@attributes"] as $at => $atributos) {
                                $arr["atributos"][$key2][$at] = $atributos;
                            }
                        }
                    } else {
                        if (isset($arrValues["cfdi:Conceptos"]["cfdi:Concepto"]["cfdi:Impuestos"]["cfdi:Traslados"]["cfdi:Traslado"])) {
                            foreach ($arrValues["cfdi:Conceptos"]["cfdi:Concepto"]["cfdi:Impuestos"]["cfdi:Traslados"]["cfdi:Traslado"] as $key2 => $arrValues2) {
                                if ($key2 == "@attributes") {
                                    foreach ($arrValues2 as $k3 => $val) {
                                        $arr["impuestos"][0][$k3] = $val;
                                    }
                                }
                            }
                        }
                        if (isset($arrValues["cfdi:Conceptos"]["cfdi:Concepto"]["@attributes"])) {
                            foreach ($arrValues["cfdi:Conceptos"]["cfdi:Concepto"]["@attributes"] as $key => $value) {
                                $arr["atributos"][0][$key] = $value;
                            }
                        }
                    }
                }
            }
            if (isset($arr["impuestos"]) && isset($arr["atributos"])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se obtenido correctamente";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getConceptosImpuestos(): No se pudo obtener los conceptos";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio";
        }
//        echo "Conceptos->impuestos: <pre>";print_r($arr);
        return $arr;
    }

    public function getImpuestosTransladado($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
                if ($key == "cfdi:Comprobante") {
                    if (isset($arrValues["cfdi:Impuestos"]["cfdi:Traslados"]["cfdi:Traslado"])) {
                        foreach ($arrValues["cfdi:Impuestos"]["cfdi:Traslados"]["cfdi:Traslado"] as $key2 => $arrValues2) {
                            if ($key2 == "@attributes") {
                                $arr["Impuesto"] = $arrValues2["Impuesto"];
                                $arr["TipoFactor"] = $arrValues2["TipoFactor"];
                                $arr["TasaOCuota"] = $arrValues2["TasaOCuota"];
                                $arr["Importe"] = $arrValues2["Importe"];
                            }
                        }
                    }
                }
            }
            if (isset($arr["Impuesto"])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se obtenido correctamente";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getImpuestosTransladado() No se pudo obtener los impuestos";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio";
        }
//        echo "getImpuestosTransladado: <pre>";print_r($arr);
        return $arr;
    }

    public function getTotalImpuestosTransladado($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
                if ($key == "cfdi:Comprobante") {
                    if (isset($arrValues["cfdi:Impuestos"]["@attributes"])) {
                        foreach ($arrValues["cfdi:Impuestos"] as $key2 => $arrValues2) {
                            if ($key2 == "@attributes") {
                                $arr["TotalImpuestosTrasladados"] = ((int) $arrValues2["TotalImpuestosTrasladados"] > 0 ? $arrValues2["TotalImpuestosTrasladados"] : 0);
                            }
                        }
                    }
                }
            }
            if (isset($arr["TotalImpuestosTrasladados"])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se obtenido correctamente";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getTotalImpuestosTransladado() No se pudo obtener el total de impuestos";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio";
        }
//        echo "getTotalImpuestosTransladado: <pre>";print_r($arr);
        return $arr;
    }

    public function getComplementoTimbreFiscal($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
                if ($key == "cfdi:Comprobante") {
                    if (isset($arrValues["cfdi:Complemento"]["tfd:TimbreFiscalDigital"]["@attributes"])) {
                        foreach ($arrValues["cfdi:Complemento"]["tfd:TimbreFiscalDigital"] as $key2 => $arrValues2) {
                            if ($key2 == "@attributes") {
                                foreach ($arrValues2 as $key3 => $val) {
                                    $arr[$key3] = $val;
                                }
                            }
                        }
                    }
                }
            }
            if (isset($arr["UUID"])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se obtenido correctamente";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getComplementoTimbreFiscal(). No se pudo obtener los datos del timbre fiscal";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio";
        }
//        echo "getComplementoTimbreFiscal: <pre>";print_r($arr);
        return $arr;
    }

    public function getComplementoAtrributes($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
                if ($key == "cfdi:Comprobante") {
                    if (isset($arrValues["@attributes"])) {
                        foreach ($arrValues["@attributes"] as $key2 => $value) {
                            $arr[$key2] = $value;
                        }
                    }
                }
            }
            if (isset($arr["Sello"])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se obtenido correctamente";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getComplementoTimbreFiscal(). No se pudo obtener los atributos de los datos fiscales.";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio";
        }
//        echo "getComplementoAtrributes: <pre>";print_r($arr);
        return $arr;
    }

    /*
     * END CFDI INGRESOS AND PAGOS
     */
    /*
     * START CFDI PAGOS
     */

    public function getConceptosPagos($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
                if ($key == "cfdi:Comprobante") {
                    if (isset($arrValues["cfdi:Conceptos"]["cfdi:Concepto"]["@attributes"])) {
                        foreach ($arrValues["cfdi:Conceptos"]["cfdi:Concepto"]["@attributes"] as $key => $value) {
                            $arr["conceptos"][0][$key] = $value;
                        }
                    }
                }
            }
            if (isset($arr["conceptos"][0])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se ha obtenido correctamente: getConceptosPagos: 713";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getConceptosImpuestos(): No se pudo obtener los conceptos";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio";
        }
//        echo "Conceptos->impuestos: <pre>";print_r($arr);
        return $arr;
    }

    public function getCfdiRelacionado($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
//            echo $key."<br>";
                if ($key == "cfdi:Comprobante") {
                    foreach ($arrValues as $key1 => $arrRelac) {
                        if (isset($arrRelac["cfdi:CfdiRelacionado"])) {
                            foreach ($arrRelac as $key2 => $arrAtt) {
                                if (isset($arrAtt["@attributes"])) {
                                    foreach ($arrAtt["@attributes"] as $key3 => $values) {
                                        $arr[$key3] = $values;
                                    }
                                }
                            }
                            if (isset($arrRelac["@attributes"])) {
                                foreach ($arrRelac as $key2 => $arrAtt) {
                                    if (isset($arrAtt["TipoRelacion"])) {
                                        foreach ($arrAtt as $key3 => $values) {
                                            $arr[$key3] = $values;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (isset($arr["UUID"])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se ha obtenido correctamente getCfdiRelacionado: 770";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getCfdiRelacionado(): No se pudo obtener el CFDI relacionado";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio. No se pudo obtener el CFDI relacionado";
        }
//        echo "Conceptos->impuestos: <pre>";print_r($arr);
        return $arr;
    }

    public function getComplementoPagos($data) {
        $arr = array();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $arrValues) {
                if ($key == "cfdi:Comprobante") {
                    if (isset($arrValues["cfdi:Complemento"]["pago10:Pagos"]["pago10:Pago"]["pago10:DoctoRelacionado"])) {
                        foreach ($arrValues["cfdi:Complemento"]["pago10:Pagos"]["pago10:Pago"]["pago10:DoctoRelacionado"] as $key2 => $arrValues2) {
                            if ($key2 == "@attributes") {
                                foreach ($arrValues2 as $key3 => $val) {
                                    $arr[$key3] = $val;
                                }
                            }
                        }
                    }
                    if (isset($arrValues["cfdi:Complemento"]["pago10:Pagos"]["pago10:Pago"]["@attributes"])) {
                        foreach ($arrValues["cfdi:Complemento"]["pago10:Pagos"]["pago10:Pago"] as $key2 => $arrValues2) {
                            if ($key2 == "@attributes") {
                                foreach ($arrValues2 as $key3 => $val) {
                                    $arr[$key3] = $val;
                                }
                            }
                        }
                    }
                    if (isset($arrValues["cfdi:Complemento"]["pago10:Pagos"]["@attributes"])) {
                        foreach ($arrValues["cfdi:Complemento"]["pago10:Pagos"]["@attributes"] as $key3 => $val) {
                            $arr[$key3] = $val;
                        }
                    }
                }
            }
            if (isset($arr["IdDocumento"])) {
                $arr["estatus"] = 1;
                $arr["mensaje"] = "Se ha obtenido correctamente";
            } else {
                $arr["estatus"] = 0;
                $arr["mensaje"] = "getComplementoPagos(). No se pudo obtener los datos del pago";
            }
        } else {
            $arr["estatus"] = 0;
            $arr["mensaje"] = "Arreglo vacio";
        }
//        echo "getComplementoTimbreFiscal: <pre>";print_r($arr);
        return $arr;
    }

    /*
     * END CFDI PAGOS
     */

    public function deleteUploadFilesByID($id) {
        $json = array();
        if ($this->daoXml->deleteUploadFilesByID($id)) {
            $json["estatus"] = 1;
            $json["mensaje"] = "Se eliminó correctamente";
        } else {
            $json["estatus"] = 0;
            $json["mensaje"] = "Error al eliminar ID: " . $id;
        }
        header('Content-type: application/json; charset=utf-8');
        die(json_encode($json, JSON_UNESCAPED_UNICODE));
    }

    public function deleteUploadFilesNoActivos() {
        $this->daoXml->deleteUploadFilesNoActivos();
    }

    public function getXMLS($param) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        extract($param);
        $arrxmls = array();
        $arrModeloXmls = array();
        $json = array();
        if (isset($_SESSION["arrModeloXmls"])) {
            $arrModeloXmls = unserialize($_SESSION["arrModeloXmls"]);
            return $arrModeloXmls;
        }
        $arrxmls = $this->daoXml->getXMLS($param);
        if (count($arrxmls) > 0) {
            foreach ($arrxmls as $key => $valObject) {
                $mxml = new ModeloXML\ModeloXML();
                $mxml = $valObject;
                $this->strXML = $mxml->getContentXML();
                $arrData = $this->getContentXML();
                if ($arrData["estatus"] == 1) {
                    $arrXML = $arrData["arrxml"];
                    if (count($arrXML) > 0) {
                        if ($this->getTipoCFDI($mxml->getContentXML()) == "I") {
                            $arrXML = $this->setXMLModeloIngreso($arrXML);
                        } else if ($this->getTipoCFDI($mxml->getContentXML()) == "P") {
                            $arrXML = $this->setXMLModeloPago($arrXML);
                        }
                        if (isset($arrXML["estatus"]) && $arrXML["estatus"] == 1) {
                            $aux = new ModeloXML\ModeloXML();
                            $aux = $arrXML["xml"];
//                            echo "<pre>";print_r($aux);echo "</pre>";
                            $aux->setIdxml($mxml->getIdxml());
                            $aux->setIduser($mxml->getIduser());
                            $aux->setFechaCreacion($mxml->getFechaCreacion());
                            $aux->setFechaModificacion($mxml->getFechaModificacion());
                            $aux->setEstatus($mxml->getEstatus());
                            array_push($arrModeloXmls, $aux);
                        }
                    }
                }
            }
        }
        $_SESSION["arrModeloXmls"] = serialize($arrModeloXmls);
        return $arrModeloXmls;
    }

    public function convertModeloToArr(ModeloXML\ModeloXML $aux, $tipoCfdi) {
        $arr = array();
        //echo "<pre>";        print_r($aux);        
        if ($aux != null) {
            //Emisor
            $arr["emisor_Rfc"] = $aux->getEmisorRfc();
            $arr["emisor_Nombre"] = $aux->getEmisorNombre();
            $arr["emisor_RegimenFiscal"] = $aux->getEmisorRegimenFiscal();
            //Receptor
            $arr["receptor_Rfc"] = $aux->getReceptorRfc();
            $arr["receptor_Nombre"] = $aux->getReceptorNombre();
            $arr["receptor_UsoCFDI"] = $aux->getReceptorUsoCFDI();
            //impuesto
            if ($tipoCfdi == "I") {
                $arr["Impuesto"] = $aux->getImpuestoImpuesto();
                $arr["TipoFactor"] = $aux->getImpuestoTipoFactor();
                $arr["TasaOCuota"] = $aux->getImpuestoTasaOCuota();
                $arr["Importe"] = $aux->getImpuestoImporte();
                //Agregar total impuestos trasladado
                $arr["TotalImpuestosTrasladados"] = $aux->getTotalImpuesto();
            }
            //Agregar timbre fiscal digital
            $arr["schemaLocation"] = $aux->getComplementoTFschemaLocation();
            $arr["Version"] = $aux->getComplementoTFVersion();
            $arr["UUID"] = $aux->getComplementoTFUUID();
            $arr["FechaTimbrado"] = $aux->getComplementoTFFechaTimbrado();
            $arr["RfcProvCertif"] = $aux->getComplementoTFRfcProvCertif();
            $arr["SelloCFD"] = $aux->getComplementoTFSelloCFD();
            $arr["NoCertificadoSAT"] = $aux->getComplementoTFNoCertificadoSAT();
            $arr["SelloSAT"] = $aux->getComplementoTFSelloSAT();
            //Agregar timbre fiscal atributos
            $arr["schemaLocation"] = $aux->getComplementoAtribschemaLocation();
            $arr["Version"] = $aux->getComplementoAtribVersion();
            $arr["Serie"] = $aux->getComplementoAtribSerie();
            $arr["Folio"] = $aux->getComplementoAtribFolio();
            $arr["Fecha"] = $aux->getComplementoAtribFecha();
            $arr["Sello"] = $aux->getComplementoAtribSello();
            $arr["FormaPago"] = $aux->getComplementoAtribFormaPago();
            $arr["NoCertificado"] = $aux->getComplementoAtribNoCertificado();
            $arr["Certificado"] = $aux->getComplementoAtribCertificado();
            $arr["SubTotal"] = $aux->getComplementoAtribSubTotal();
            $arr["Moneda"] = $aux->getComplementoAtribMoneda();
            $arr["Total"] = $aux->getComplementoAtribTotal();
            $arr["TipoDeComprobante"] = $aux->getComplementoAtribTipoDeComprobante();
            $arr["MetodoPago"] = $aux->getComplementoAtribMetodoPago();
            $arr["LugarExpedicion"] = $aux->getComplementoAtribLugarExpedicion();
            $arr["conceptos"] = $aux->getArrConceptos();
            $arr["atributos"] = $aux->getArrAtributos();
        }
        return $arr;
    }

    public static function getTipoCFDI($xmlsString) {
        $tipo = "";
        if (strpos($xmlsString, 'TipoDeComprobante="P"') !== false) {
            $tipo = "P";
        } else if (strpos($xmlsString, 'TipoDeComprobante="I"') !== false) {
            $tipo = "I";
        } else if (strpos($xmlsString, 'TipoDeComprobante="N"') !== false) {
            $tipo = "N";
        }
        return $tipo;
    }

}
