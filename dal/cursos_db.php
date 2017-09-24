<?php
class cursos extends Database {

    function get_all_cursos() {
        $stmt = 'SELECT * FROM cursos;';
        return $this->getRecord($stmt);
    }

}

?>