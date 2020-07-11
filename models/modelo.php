<?php

class Rank {
    
    private $resultado;
    private $db;

    public function __construct() {
        $this->resultado = array();
        $this->db = new PDO('mysql:host=localhost;dbname=test_orgoa', "root", "");
    }

    private function setNames() {
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function ranking($dato1, $dato2, $range) {

        self::setNames();
        $sql = "SELECT COUNT(id), http_useragent FROM `clicks_tracking_test` WHERE `id_campaign`='" . $dato1 . "' AND `created_at`='" . $dato2 . "' GROUP BY http_useragent ORDER BY COUNT(id) DESC LIMIT $range ";
        foreach ($this->db->query($sql) as $res) {
            $this->resultado[] = $res;
        }
        return $this->resultado;
        $this->db = null;
    }

}
?>