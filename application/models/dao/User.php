<?php
class User {
    
    public $idusuario;
    public $idempresa;
    public $login;
    public $senha;
    public $adm;

    public function User($info = false) {
        if ($info) {
            $this->init($info);
        }
    }

    private function init($info) {
        foreach ($info as $property => $value) {
            if (property_exists(__CLASS__, $property)) {
                $this->$property = $value;
            } else {
                $errors[] = "Atributo {$property} inexistente";
            }
        }
        if (count(@$errors) > 0) {
            print("OCORREU UM ERRO COM OS ATRIBUTOS");
            print_r($errors);
            die();
        }
        return $this;
    }

    public function validateFields() {
        foreach ($this as $property => $value) {
            if (empty($value) && $property != "pk_owner") {
                addError("Existem campos vázios! $property");
                return false;
            }
        }
        return true;
    }

}

?>
