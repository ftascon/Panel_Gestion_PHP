<?php

//



class Database {

    public $mysqli;

    function __construct() {


        $this->mysqli = new mysqli("localhost", "root", "", "admin");


        $this->mysqli->query("SET NAMES 'utf8'");

    }


    function saveRecord($stmt) {

        return $this->mysqli->query($stmt);
    }

    function getRecord($stmt) {

//        echo $stmt;
        $out = '';
        $output = array();

        if ($result = $this->mysqli->query($stmt)) {

            while ($row = $result->fetch_assoc()) {

                $output[] = $row;
            }

            $out = $output;
        } else {

            $out = "ha fallado la consulta " . $this->mysqli->errno;
        }
        return $out;
    }

}
