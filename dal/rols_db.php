<?php

class rols extends Database {

    function get_all_rols() {
        $stmt = 'SELECT * FROM rols';
        return $this->getRecord($stmt);
    }
}

?>