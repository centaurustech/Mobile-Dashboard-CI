<?php

class Total_sms_mes {
    
    public $mes = null;
    public $total_mes = null;

    public function Total_sms_mes($data = false) {
        if ($data != false) {
            return $this->populate($data);
        }
    }

    public function populate($data) {
        foreach ($data as $property => $value) {
            if (property_exists(__CLASS__, $property)) {
                $this->$property = $value;
            } else {
                $errors[] = "A propriedade '$property' referenciada não existe";
            }
        }
        if (count(@$errors) > 0) {
            print("<pre>UM ERRO OCORREU, FAVOR VERIFICAR AS PROPRIEDADES<br />");
            print_r($errors);
            die();
        }
        return $this;
    }
}
?>

