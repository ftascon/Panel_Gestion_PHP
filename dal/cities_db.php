<?php

class cities extends Database {

    function get_all_cities() {
        $stmt = 'SELECT * FROM cities';
        return $this->getRecord($stmt);
    }

    function get_cities_by_country($id) {
        $stmt = 'SELECT * FROM cities WHERE fk_id_country = "'.$id.'"';
        return $this->getRecord($stmt);
    }

}

?>