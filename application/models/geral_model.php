<?php

require_once(APPPATH . "models/dao/Total_sms.php");
require_once(APPPATH . "models/dao/Total_sms_mes.php");
require_once(APPPATH . "models/dao/Total_sms_operadora.php");
require_once(APPPATH . "models/dao/Total_sms_pc.php");

class Geral_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function totalSMScarrierGraf() {
        $fns = new Functions();
        $info = $this->totalSMScarrier();

        foreach ($info as $i) {
            $data = array(
                array('Tim', $i->tim),
                array('Claro', $i->claro),
                array('Vivo', $i->vivo),
                array('Oi', $i->oi)
            );
        }


        $plot = new PHPlot(200, 200);

        $plot->SetXTickLabelPos('none');
        $plot->SetXTickPos('none');
        $plot->SetShading(0);
        $plot->SetPlotAreaWorld(NULL, 0);
        $plot->SetYDataLabelPos('plotin');
        $plot->SetYTickLabelPos('none');
        $plot->SetYTickPos('none');

        $plot->SetDataValues($data);
        $plot->SetPlotType('bars');
        $plot->SetTitle('Total de mensagens por operadora');
        $plot->SetLegend(array('Total de Mensagens'));
        return $plot->DrawGraph();
    }

    public function totalSMSkeywordGraf() {
        $fns = new Functions();
        $info = $fns->totalPerKeywords();

        foreach ($info as $i) {
            $data[] = array($i['op'], $i['total']);
        }

        $plot = new PHPlot(300, 300);

        $plot->SetXTickLabelPos('none');
        $plot->SetXTickPos('none');
        $plot->SetShading(0);
        $plot->SetPlotAreaWorld(NULL, 0);
        $plot->SetYDataLabelPos('plotin');
        $plot->SetYTickLabelPos('none');
        $plot->SetYTickPos('none');

        $plot->SetDataValues($data);
        $plot->SetDataType('text-data');
        $plot->SetPlotType('bars');
        $plot->SetTitle('Total de mensagens por palavra-chave');
        $plot->SetLegend(array('Total de Mensagens'));
        $plot->DrawGraph();
    }

    function translateMonth($mes) {
        switch ($mes) {
            case '01':
                return 'Janeiro';
                break;
            case '02':
                return 'Fevereiro';
                break;
            case '03':
                return 'Março';
                break;
            case '04':
                return 'Abril';
                break;
            case '05':
                return 'Maio';
                break;
            case '06':
                return 'Junho';
                break;
            case '07':
                return 'Julho';
                break;
            case '08':
                return 'Agosto';
                break;
            case '09':
                return 'Setembro';
                break;
            case '10':
                return 'Outubro';
                break;
            case '11':
                return 'Novembro';
                break;
            case '12':
                return 'Dezembro';
                break;
        }
    }

    function subMonthFromCurrentDate($modificador = 0) {
        $aux = mktime(date("H"), date("i"), date("s"), date("m") - $modificador, date("d"), date("Y"));
        $date = date('m', $aux);

        return $date;
    }

    function subDaysFromCurrentDate($modificador = 0) {
        $aux = mktime(date("H"), date("i"), date("s"), date("m"), date("d") - $modificador, date("Y"));
        $date = date('m', $aux);

        return $date;
    }

    function totalSMS() {
        $result = array();

        $sql = "
            SELECT count(m.*) as total_sms 
            FROM mensagens AS m, campanhas AS c, empresas AS e 
            WHERE e.idempresa = 261 
            AND c.idempresa = e.idempresa 
            AND m.idcampanha = c.idcampanha";

        $ret = $this->db->query($sql);

        foreach ($ret->result_array() as $row) {
            $result[] = new Total_sms($row);
        }

        if ($result) {
            return $result;
        } else {
            return array();
        }
    }

    function totalSMSmes($modificador = 0) {
        $date = $this->subMonthFromCurrentDate($modificador);

        $sql = "
            SELECT 
                count(m.*) as total_mes
            FROM 
                mensagens AS m, 
                campanhas AS c, 
                empresas AS e 
            WHERE 
                e.idempresa = 261 
            AND 
                c.idempresa = e.idempresa 
            AND 
                m.idcampanha = c.idcampanha 
            AND 
                dtenvio 
            BETWEEN 
                '2012-" . $date . "-01 23:59:59' 
            AND 
                '2012-" . $date;
        if ($date == '04' || $date == '06' || $date == '09' || $date == '11') {
            $sql .= "-30 23:59:59'";
        } else if ($date == '01' || $date == '03' || $date == '05' || $date == '07' || $date == '08' || $date == '10' || $date == '12') {
            $sql .= "-31 23:59:59'";
        } else {
            $sql .= "-28 23:59:59'";
        }

        $ret = $this->db->query($sql);

        foreach ($ret->result_array() as $row) {
            $result[] = new Total_sms_mes($row);
        }

        if ($result) {
            return $result;
        } else {
            return array();
        }
    }

    function totalSMScarrier() {
        $sql = "
            SELECT 
                o.nome AS op, 
                count(m.*) AS total 
            FROM 
                mensagens AS m, 
                campanhas AS c, 
                empresas AS e, 
                operadoras AS o 
            WHERE 
                e.idempresa = 261 
            AND 
                c.idempresa = e.idempresa 
            AND 
                m.idcampanha = c.idcampanha 
            AND 
                m.idoperadora = o.idoperadora 
            AND 
                dtenvio
            BETWEEN 
                '2012-" . date('m') . "-01 23:59:59' 
            AND 
                '2012-" . date('m');
        if (date('m') == '04' || date('m') == '06' || date('m') == '09' || date('m') == '11') {
            $sql .= "-30 23:59:59'";
        } else if (date('m') == '01' || date('m') == '03' || date('m') == '05' || date('m') == '07' || date('m') == '08' || date('m') == '10' || date('m') == '12') {
            $sql .= "-31 23:59:59'";
        } else {
            $sql .= "-28 23:59:59' ";
        }

        $sql.= " 
            GROUP BY 
                o.nome
            ORDER BY 
                total DESC
            LIMIT
                4";

        $ret = $this->db->query($sql);
        $ret = $ret->result_array();

        foreach ($ret as $r) {
            if (strstr($r['op'], 'TIM')) {
                $result['tim'] = $r['total'];
            }
            if (strstr($r['op'], 'Claro')) {
                $result['claro'] = $r['total'];
            }
            if (strstr($r['op'], 'Vivo')) {
                $result['vivo'] = $r['total'];
            }
            if (strstr($r['op'], 'Oi')) {
                $result['oi'] = $r['total'];
            }
        }

        $result = new total_sms_operadora($result);

        if ($result) {
            return $result;
        } else {
            return array();
        }
    }

    function totalSMSpc($qtde = 0) {
        $sql = "
            SELECT 
                k.palavra AS operadora,
                count(m.*) AS total 
            FROM 
                mensagens AS m, 
                campanhas AS c, 
                empresas AS e, 
                keywords AS k,
                campanhas_keywords AS ck
            WHERE 
                e.idempresa = 261 
            AND 
                c.idempresa = e.idempresa 
            AND 
                m.idcampanha = c.idcampanha
            AND
                k.idkeyword = ck.fk_keywords
            AND
                c.idcampanha = ck.fk_campanhas
            GROUP BY
                operadora
            ORDER BY
                total DESC";
        if ($qtde > 0) {
            $sql .= "
            LIMIT {$qtde}";
        }
        $ret = $this->db->query($sql);

        foreach ($ret->result_array() as $r) {
            $result[] = new total_sms_pc($r);
        }

        if (!empty($result)) {
            return $result;
        } else {
            return array();
        }
    }

    function totalSMSpcDia($dias = 7) {
        
    }

}

?>
