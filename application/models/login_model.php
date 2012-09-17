<?php

require_once(APPPATH . 'models/dao/User.php');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function authUser($login, $pass) {
        if (strstr($login, 'marcelonicolau') || strstr($login, 'rctimrs')) {

            $passwd = md5($pass);

            $sql = "SELECT * FROM usuarios WHERE login LIKE '{$login}' AND senha LIKE '{$passwd}'";

            $ret = $this->db->query($sql);
            $ret = $ret->result_array();

            if (!empty($ret)) {
                $moreno = new User($ret[0]);

                return $moreno;
            }
            return false;
        } else {
            return false;
        }
    }

}

?>
