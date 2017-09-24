<?php

class countries extends Database {

    function get_all_countries() {
        $stmt = 'SELECT * FROM countries';
        return $this->getRecord($stmt);
    }

}

?>