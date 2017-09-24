<?php

class examenes extends Database {

    function get_all() {
        $stmt = 'SELECT examenes.*, aulas.id_aula, aulas.nombre_aula, aulas.f_inicio as f_inicio_aula '
                . 'FROM examenes '
                . 'LEFT JOIN aulas ON aulas.id_aula = examenes.fk_aula';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function add($data) {
        $stmt = "INSERT INTO examenes "
                . "(nombre_examen, f_inicio, f_fin, url_examen, fk_aula) "
                . "VALUES "
                . "('" . $data["nombre_examen"] . "','" . $data["f_inicio"] . "','" . $data["f_fin"] . "', '" . $data["url_examen"] . "', '" . $data["fk_aula"] . "')";
//        echo $stmt;
        return $this->saveRecord($stmt);
    }

    function by_id($id) {
        $stmt = 'SELECT *
                FROM
                       examenes
                WHERE
                        id_examen = "' . $id . '"';
//        echo $stmt;
        $res = $this->getRecord($stmt);
        return $res[0];
    }

    function by_aula($id_aula) {
        $stmt = 'SELECT
                        examenes.*, aulas.id_aula,
                        aulas.nombre_aula,
                        aulas.f_inicio AS f_inicio_aula
                FROM
                        examenes
                LEFT JOIN aulas ON aulas.id_aula = examenes.fk_aula
                WHERE
                        aulas.id_aula = "' . $id_aula . '"
                GROUP BY
                        examenes.id_examen';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function by_alumno($id) {
        $stmt = "SELECT
                examenes.*, aulas.id_aula,
                aulas.nombre_aula,
                aulas.f_inicio AS f_inicio_aula
        FROM
                examenes
        LEFT JOIN aulas ON aulas.id_aula = examenes.fk_aula
        LEFT JOIN aulas_alumnos ON aulas_alumnos.fk_aula = aulas.id_aula
        WHERE
	aulas_alumnos.fk_alumno  = '" . $id . "'
                GROUP BY examenes.id_examen 
                ORDER BY examenes.f_inicio DESC";
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function by_profe($id) {
        $stmt = 'SELECT
                       examenes.*, aulas.id_aula, aulas.nombre_aula, aulas.f_inicio as f_inicio_aula
                FROM
                        examenes
                LEFT JOIN aulas ON aulas.id_aula = examenes.fk_aula
                LEFT JOIN aulas_profesores ON aulas_profesores.fk_aula = aulas.id_aula
                WHERE aulas_profesores.fk_profesor = ' . $id . '
                GROUP BY examenes.id_examen 
                ORDER BY examenes.f_inicio DESC';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function remove($id) {
        $stmt = "DELETE FROM examenes "
                . "WHERE id_examen = '" . $id . "'";
//        echo $stmt;
        return $this->mysqli->query($stmt);
    }

    function update($data, $id) {
        $stmt = "UPDATE examenes SET "
                . "nombre_examen = '" . $data["nombre_examen"] . "', "
                . "f_inicio = '" . $data["f_inicio"] . "', "
                . "f_fin = '" . $data["f_fin"] . "', "
                . "url_examen = '" . $data["url_examen"] . "', "
                . "fk_aula = '" . $data["fk_aula"] . "' "
                . "WHERE id_examen = '" . $id . "'";
//        echo $stmt;
        return $this->mysqli->query($stmt);
    }

}

?>