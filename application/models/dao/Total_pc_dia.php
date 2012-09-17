<?php

class Total_pc_dia {

    public $pc = null;
    public $dias = array(
                        "1" => null,
                        "2" => null,
                        "3" => null,
                        "4" => null,
                        "5" => null,
                        "6" => null,
                        "7" => null
                        );

    public function Total_pc_dia($data = false) {
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
