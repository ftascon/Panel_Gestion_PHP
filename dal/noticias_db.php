<?php

class noticias extends Database {

    function get_all() {
        $stmt = "SELECT 
                    noticias.*, people.fname_people, people.lname1_people, people.lname2_people
                FROM
                    noticias
                LEFT JOIN 
                    people ON people.id_people = noticias.fk_autor
                    GROUP BY noticias.id_noticias";
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function get_all_simple() {
        $stmt = "SELECT *
                FROM noticias
                ORDER BY noticias.fecha_noticias DESC, hora_noticias DESC
                LIMIT 10";
        return $this->getRecord($stmt);
    }

    function get_by_id($id) {
        $stmt = "SELECT 
                    noticias.*, people.fname_people, people.lname1_people, people.lname2_people
                FROM
                    noticias
                LEFT JOIN
                    people ON people.id_people = noticias.fk_autor
                WHERE noticias.id_noticias = '" . $id . "'";
        $res = $this->getRecord($stmt);
        return $res[0];
    }

    function get_by_rol($rol) {
        
    }

    function get_by_people($id) {
        $stmt = 'SELECT
                        noticias.*
                FROM
                        noticias
                LEFT JOIN noticias_people ON noticias.id_noticias = noticias_people.fk_noticias
                LEFT JOIN noticias_aulas ON noticias_aulas.fk_noticias = noticias.id_noticias
                LEFT JOIN aulas_alumnos ON aulas_alumnos.fk_aula = noticias_aulas.fk_aulas
                LEFT JOIN aulas_profesores ON aulas_profesores.fk_aula = noticias_aulas.fk_aulas
                WHERE
                        (
                                aulas_alumnos.fk_alumno = ' . $id . '
                        )
                OR (
                        aulas_profesores.fk_profesor = ' . $id . '
                )
                OR (
                        noticias_people.fk_people = ' . $id . '
                )
                OR (
                        noticias.fk_autor = ' . $id . '
                )
                GROUP BY
                        noticias.id_noticias
                ORDER BY
                        noticias.fecha_noticias DESC,
                        noticias.hora_noticias DESC';

        return $this->getRecord($stmt);
    }

    function get_by_aula($id) {
        
    }

    function check_visible($id_user, $noticia) {
        $stmt = 'SELECT COUNT(*) as cuenta '
                . 'FROM noticias_people '
                . 'WHERE fk_noticias = "' . $noticia . '" '
                . 'AND fk_people = "' . $id_user . '"';
        return $this->mysqli->query($stmt);
    }

    function create($data) {
        $stmt = "INSERT INTO noticias "
                . "(titulo_noticias, contenido_noticias, fecha_noticias, hora_noticias, fk_autor) "
                . "VALUES "
                . "('" . $this->mysqli->escape_string($data["titulo_noticias"]) . "', '" . $this->mysqli->escape_string($data["contenido_noticias"]) . "' ,'" . $this->mysqli->escape_string($data["fecha_noticias"]) . "' ,'" . $this->mysqli->escape_string($data["hora_noticias"]) . "' ,'" . $this->mysqli->escape_string($data["fk_autor"]) . "')";
//        echo $stmt;
        $this->mysqli->query($stmt);
        return $this->mysqli->insert_id;
    }

    function edit($id, $data) {
        $stmt = "UPDATE noticias "
                . "SET titulo_noticias = '" . $this->mysqli->escape_string($data["titulo_noticias"]) . "', "
                . "contenido_noticias='" . $this->mysqli->escape_string($data["contenido_noticias"]) . "' "
                . "WHERE id_noticias = '" . $id . "'";
//        echo $stmt;
        return $this->mysqli->query($stmt);
    }

    function remove($id) {
        $stmt = "DELETE FROM noticias "
                . "WHERE id_noticias = '" . $id . "'";
        return $this->mysqli->query($stmt);
    }

}

?>