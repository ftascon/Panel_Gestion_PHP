<?php

class aulas_notas extends Database {

    function add_notas_to_aula($aula, $data) {
        $stmt = "INSERT INTO aulas_notas "
                . "(title_aulas_notas, fk_aula, coment_aulas_notas) "
                . "VALUES "
                . "('" . $data["title_aulas_notas"] . "', '" . $aula . "' ,'" . $data["coment_aulas_notas"] . "')";
//        echo $stmt;
        return $this->saveRecord($stmt);
    }

    function get_nota_by_id($id) {
        $stmt = 'SELECT * '
                . 'FROM aulas_notas '
                . 'WHERE aulas_notas.id_aulas_notas = "' . $id . '"';
//        echo $stmt;
        $res = $this->getRecord($stmt);
        return $res[0];
    }

    function get_aulaid_by_nota($id_nota) {
        $stmt = "select 
                    fk_aula as id_aula,
                    nombre_aula,
                    title_aulas_notas
                from aulas_notas
                join aulas on aulas_notas.fk_aula = aulas.id_aula
                where aulas_notas.id_aulas_notas = '" . $id_nota . "'";
        $res = $this->getRecord($stmt);
        return $res[0];
    }

    function get_notas_by_aula($id) {
        $stmt = "SELECT * FROM aulas_notas "
                . "WHERE fk_aula = '" . $id . "'";
        return $this->getRecord($stmt);
    }

    function get_single_nota_by_aula($id, $id_nota) {
        $stmt = 'SELECT
                        *
                FROM
                        aulas_notas
                JOIN notas_alumnos ON aulas_notas.id_aula_notas = notas_alumnos.fk_nota
                JOIN people ON people.id_people = notas_alumnos.fk_alumno
                WHERE
                        aulas_notas.fk_aula = "' . $id . '" '
                . 'AND aulas_notas.id_aulas_notas = "' . $id_nota . '"';

        return $this->getRecord($stmt);
    }

    function remove_notas_aula($aula, $notas) {
        $stmt = " DELETE FROM aulas_notas "
                . "WHERE fk_aula = '" . $aula . "' "
                . "AND id_aulas_notas = '" . $notas . "'";
        $this->mysqli->query($stmt);
    }

    function remove_notas_by_id($notas) {
        $stmt = " DELETE FROM aulas_notas "
                . "WHERE id_aulas_notas = '" . $notas . "' ";
//        echo $stmt;
        $this->mysqli->query($stmt);
    }

    function update_by_id($data) {
        $stmt = "UPDATE aulas_notas "
                . " SET title_aulas_notas = '" . $data["title_aulas_notas"] . "', "
                . " coment_aulas_notas = '" . $data["coment_aulas_notas"] . "' "
                . "WHERE id_aulas_notas = " . $data["id_nota"];
//        echo $stmt;
        return $this->mysqli->query($stmt);
    }

    function update_notas_to_aula($data, $aula) {
        $this->remove_notas_aula($aula);
        return $this->add_alumnos_to_aula($aula, $data);
    }

}

?>