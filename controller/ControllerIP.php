<?php
include_once './dao/DaoIP.php';
//include_once './utilidades/varsGlobal.php';
class ControllerIP {
    private $daoip = null;    
    function __construct() {
        $this->daoip = new DaoIP\DaoIP();        
    }
    
    public function saveIP($ip){
       return $this->daoip->saveIP($ip);
    }
    public function getTotalIP($ip){        
      return $this->daoip->getTotalIP($ip);
    }
    public function updateEstatuIP(){
        return $this->daoip->updateEstatuIP();
    }
}
