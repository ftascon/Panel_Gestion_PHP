<?php

class noticias_people extends Database {

    function get_all() {
        $stmt = "SELECT * FROM noticias_people";
        return $this->getRecord($stmt);
    }

    function set_noticias_people($id_noticia, $id_people) {
        $stmt = "INSERT INTO noticias_people "
                . "(fk_noticias, fk_people) "
                . "VALUES "
                . "('" . $id_noticia . "', '" . $id_people . "')";
//        echo $stmt;
        return $this->mysqli->query($stmt);
    }

    function rm_by_noticia($id) {
        $stmt = 'DELETE FROM noticias_people'
                . ' WHERE fk_noticias = "' . $id . '"';

        return $this->mysqli->query($stmt);
    }

    function get_people_auth($id_noticia) {
        $stmt = 'SELECT people.*
                FROM noticias_people
                JOIN people ON people.id_people = noticias_people.fk_people
                WHERE noticias_people.fk_noticias = "' . $id_noticia . '"';
        return $this->getRecord($stmt);
    }

    function get_aulas_auth($id_noticia) {
        $stmt = 'SELECT aulas.*
                FROM noticias_aulas
                JOIN aulas ON aulas.id_aula = noticias_aulas.fk_aulas
                WHERE noticias_aulas.fk_noticias = "' . $id_noticia . '"';
        return $this->getRecord($stmt);
    }

    function create($data) {
        
    }

    function edit($data) {
        
    }

    function remove($id) {
//        return $this->mysqli->query($stmt);
    }

}

?>