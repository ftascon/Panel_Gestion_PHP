<?php

class servicios_datos extends Database {

    function get_by_service($id) {
        $stmt = 'SELECT *
                FROM servicos_datos
                WHERE fk_servicios = ' . $id;
        return $this->getRecord($stmt);
    }

    function get_by_alumno($id) {
        $stmt = 'SELECT *
                FROM servicos_datos
                JOIN alumnos_servicios ON alumnos_servicios.fk_servicio = servicos_datos.fk_servicios
                WHERE alumnos_servicios.id_alumnos_servicios = ' . $id;
        return $this->getRecord($stmt);
    }

}

?>