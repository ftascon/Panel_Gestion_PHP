<?php

class type_services extends Database {

    function get_all() {
        $stmt = 'SELECT id_type_services,
                        name
                    FROM
                        type_services';
        return $this->getRecord($stmt);
    }

    function create($data) {
    }

    function remove($aula) {
    }
    
    function update($data, $aula) {
    }

}

?>