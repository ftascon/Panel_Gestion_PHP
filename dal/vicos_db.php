<?php

class vicos extends Database {

    function get_all($format = false) {

        $stmt = 'SELECT
                        *
                FROM
                        vicos
                LEFT JOIN aulas ON aulas.id_aula = vicos.fk_aula
                LEFT JOIN modulos ON modulos.id_modulo = aulas.fk_modulo';
        if ($format) {
            $stmt .= ' WHERE
                        YEAR (vicos.fecha_vico) >= YEAR (NOW())
                AND MONTH (vicos.fecha_vico) >= MONTH (NOW())
                AND day(vicos.fecha_vico) >= day(NOW())-10';
        }
        $stmt .= ' ORDER BY
                                vicos.fecha_vico ASC';
//        echo $stmt;
        $result = $this->getRecord($stmt);
//        print_r($result);
        return $result;
    }

    function add_vico($data) {
        $stmt = "INSERT INTO vicos "
                . "(nombre_vico, url_vico, fk_aula, fecha_vico, hora_vico) "
                . "VALUES "
                . "('" . $data["nombre_vico"] . "','" . $data["url_vico"] . "','" . $data["fk_aula"] . "', '" . $data["fecha_vico"] . "', '" . $data["hora_vico"] . "')";
//        echo $stmt;
        return $this->saveRecord($stmt);
    }

    function get_vico_by_id($id) {
        $stmt = 'SELECT
                        *
                FROM
                        vicos
                WHERE
                        id_vico = "' . $id . '"';
//        echo $stmt;
        $res = $this->getRecord($stmt);
        return $res[0];
    }

    function get_vico_by_profe($id) {
        $stmt = 'SELECT 
                    vicos.*, aulas.*, modulos.*
                FROM
                    vicos
                LEFT JOIN aulas_profesores ON aulas_profesores.fk_aula = vicos.fk_aula
                LEFT JOIN aulas ON aulas.id_aula = aulas_profesores.fk_aula 
                LEFT JOIN modulos ON modulos.id_modulo = aulas.fk_modulo
                WHERE aulas_profesores.fk_profesor = "' . $id . '"
                GROUP BY vicos.id_vico';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function get_vicos_by_alumno($id) {
        $stmt = "SELECT
                        *
                FROM
                        vicos
                JOIN aulas_alumnos ON aulas_alumnos.fk_aula = vicos.fk_aula
                JOIN aulas ON aulas.id_aula = aulas_alumnos.fk_aula
                JOIN modulos ON modulos.id_modulo = aulas.fk_modulo
                WHERE aulas_alumnos.fk_alumno = '" . $id . "'
                GROUP BY vicos.id_vico 
                ORDER BY vicos.fecha_vico ASC";
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function get_vico_by_aula($id) {
        $stmt = 'SELECT
                        *
                FROM
                        vicos
                WHERE
                        fk_aula = "' . $id . '" '
                . 'GROUP BY id_vico '
                . 'ORDER by vicos.fecha_vico';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function remove_vico($vico) {
        $stmt = "DELETE FROM vicos "
                . "WHERE id_vico = '" . $vico . "'";
//        echo $stmt;
        return $this->mysqli->query($stmt);
    }

    function update_vico($data, $id) {
        $stmt = "UPDATE vicos SET "
                . "nombre_vico = '" . $data["nombre_vico"] . "', "
                . "url_vico = '" . $data["url_vico"] . "', "
                . "fecha_vico = '" . $data["fecha_vico"] . "', "
                . "hora_vico = '" . $data["hora_vico"] . "', "
                . "fk_aula = '" . $data["fk_aula"] . "' "
                . "WHERE id_vico = '" . $id . "'";
//        echo $stmt;
        $this->mysqli->query($stmt);
    }

}

?>