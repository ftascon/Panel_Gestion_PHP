<?php

class users_aulas extends Database {

    function get_all() {
        $stmt = 'SELECT * FROM users_aulas';
        return $this->getRecord($stmt);
    }

    function insert($id_user, $data) {
        $stmt = 'SELECT *'
                . ' FROM users_aulas'
                . ' WHERE fk_aula = ' . $data["fk_aula"]
                . ' AND fk_people = ' . $id_user;

        if (count($this->getRecord($stmt)) > 0) {
            $stmt = 'UPDATE users_aulas '
                    . 'SET user = "' . $data["user"] . '",'
                    . ' password = "' . $data["password"] . '"'
                    . ' WHERE (fk_people = ' . $id_user . ')'
                    . ' AND (fk_aula = ' . $data["fk_aula"] . ')';
//            echo "<br>" . $stmt . "<br>";
        } else {
            $stmt = "INSERT INTO users_aulas"
                    . " (fk_people, fk_aula, user, password) VALUES"
                    . " ('" . $id_user . "', '" . $data["fk_aula"] . "', '" . $data["user"] . "', '" . $data["password"] . "')";
        }
        $this->mysqli->query($stmt);
        return $this->mysqli->insert_id;
    }

    function remove() {
        
    }

    function get_by_aula($id) {
        $stmt = 'SELECT *'
                . ' FROM users_aulas'
                . ' WHERE fk_aula = ' . $id;
        return $this->getRecord($stmt);
    }

    function rm_by_id() {
        
    }

}
//620 48 68 56
//93 802 3215