<?php

require_once(APPPATH . "models/dao/total_sms.php");
require_once(APPPATH . "models/dao/total_sms_mes.php");
require_once(APPPATH . "models/dao/total_sms_operadora.php");
require_once(APPPATH . "models/dao/total_sms_pc.php");

class Geral_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function totalSMS(){
        $result = array();
        
        $sql = "
            SELECT count(m.*) as total_sms 
            FROM mensagens AS m, campanhas AS c, empresas AS e 
            WHERE e.idempresa = 261 
            AND c.idempresa = e.idempresa 
            AND m.idcampanha = c.idcampanha";

        $ret = $this->db->query($sql);
        
        foreach($ret->result_array() as $row){
            $result[] = new total_sms($row['total_sms']);
        }

        if ($result) {
            return $result;
        } else {
            return array();
        }
    }

    function totalSMSmes(){
        
    }
    
    function totalSMSoperadora(){
        
    }
    
    function totalSMSpc(){
        
    }
}

?>
