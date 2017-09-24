<?php

class noticias_aulas extends Database {

    function get_all() {
        
    }

    function set_noticias_aulas($id_noticia, $id_aula) {
        $stmt = "INSERT INTO noticias_aulas "
                . "(fk_noticias, fk_aulas) "
                . "VALUES "
                . "('" . $id_noticia . "', '" . $id_aula . "');";
//        echo $stmt;
        return $this->mysqli->query($stmt);
    }

    function rm_by_noticia($id) {
        $stmt = 'DELETE FROM noticias_aulas'
                . ' WHERE fk_noticias = "' . $id . '"';

        return $this->mysqli->query($stmt);
    }

    function rm_by_aulas($id) {
        $stmt = 'DELETE FROM noticias_aulas'
                . ' WHERE fk_aulas = "' . $id . '"';

        return $this->mysqli->query($stmt);
    }

    function get_aulas_permisos($id_noticia, $id_user = FALSE) {
        if ($id_user) {
            $stmt = 'SELECT  * '
                    . 'FROM noticias_aulas '
                    . 'WHERE fk_noticias = "' . $id_noticia . '" '
                    . 'GROUP BY fk_aulas ';
        } else {
            
        }
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