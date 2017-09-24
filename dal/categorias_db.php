<?php

class categorias extends Database {

    function get_all() {
        $stmt = "SELECT * FROM categorias";
        return $this->getRecord($stmt);
    }
 
    function get_by_noticia($id) {
        
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