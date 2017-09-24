<?php

class aulas_vico extends Database {

    function add_vico_to_aula($aula, $data) {
//        print_r($data);
        $stmt = "INSERT INTO aulas_vico "
                . "(fk_aula, title_aulas_vico, desc_aulas_vico) "
                . "VALUES "
                . "('" . $aula . "','" . $data["title_aulas_vico"] . "','" . $data["desc_aulas_vico"] . "')";
//        echo $stmt;
        return $this->saveRecord($stmt);
    }

    function get_vico_by_aula($id) {
        $stmt = 'SELECT
                        *
                FROM
                        aulas_vico
                WHERE
                        fk_aula = "' . $id . '"';
        return $this->getRecord($stmt);
    }

    function remove_vico_aula($aula, $vico) {
        $stmt = "DELETE FROM aulas_vico "
                . "WHERE fk_aula = '" . $aula . "' "
                . "AND id_aulas_vico = '" . $vico . "'";
        $this->mysqli->query($stmt);
    }

    function update_vico_to_aula($data, $aula) {
        $this->remove_vico_aula($aula);
        return $this->add_alumnos_to_aula($aula, $data);
    }

}

?>