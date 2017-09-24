<?php

class alumnos_servicios extends Database {

    function set_service_alumno($data) {
        $stmt = "INSERT INTO alumnos_servicios "
                . "(id_alumnos_servicios, fk_servicio) "
                . "VALUES "
                . "('" . $data["fk_id_people_profile"] . "', '" . $data["fk_servicio"] . "');";
        $this->saveRecord($stmt);
    }

    function update($data, $id) {
        $stmt = "UPDATE alumnos_servicios "
                . " SET id_alumnos_servicios = " . $data["fk_id_people_profile"] . ","
                . " fk_servicio = " . $data["fk_servicio"]
                . " WHERE id_alumnos_servicios = " . $id;
//        echo $stmt;
        return $this->mysqli->query($stmt);
//        $this->saveRecord($stmt);
    }

    function get_service_by_alumno($id) {
        $stmt = "SELECT *
                FROM alumnos_servicios, servicios
                WHERE alumnos_servicios.fk_servicio = servicios.id_servicio
                AND alumnos_servicios.id_alumnos_servicios = '" . $id . "' ";
        $res = $this->getRecord($stmt);
        return $res[0];
    }

}

?>