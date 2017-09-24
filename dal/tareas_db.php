<?php

class tareas extends Database {

    function save_tarea($data) {
//        print_r($data);
        $stmt = "INSERT INTO tareas "
                . "(titulo, fecha_inicio, hora_inicio, trabajador, lugar, fecha_fin, hora_fin, cliente, direccion, servicio, estado, facturado, activas, comentario, prioridad, descuento_task) "
                . "VALUES "
                . "('" . $data["titulo"] . "', '" . $data["fecha_inicio"] . "', '" . $data["hora_inicio"] . "', '" . $data["trabajador"] . "', '" . $data["lugar"] . "'"
                . ", '" . $data["fecha_fin"] . "', '" . $data["hora_fin"] . "', '" . $data["cliente"] . "', '" . $data["direccion"] . "', '" . $data["servicio"] . "'"
                . ", '" . $data["estado"] . "', '" . $data["facturado"] . "', 1, '" . $data["comentario"] . "', '" . $data["prioridad"] . "', '" . $data["descuento_task"] . "');";
//        echo $stmt;
        return $this->saveRecord($stmt);
    }

    function get_all_tareas() {
        $stmt = "SELECT
                    tareas.id_tareas,
                    tareas.fecha_inicio,
                    tareas.hora_inicio,
                    tareas.trabajador,
                    tareas.lugar,
                    tareas.fecha_fin,
                    tareas.hora_fin,
                    tareas.cliente,
                    tareas.direccion,
                    tareas.estado,
                    tareas.facturado,
                    tareas.activas,
                    people.fname_people AS trabajador_name,
                    people.lname1_people AS trabajador_lname1,
                    people.lname2_people AS trabajador_lname2,
                    tareas.titulo,
                    tareas.servicio,
                    tareas.comentario,
                    tareas.prioridad,
                    c.fname_people as cliente_nombre,
                    c.lname1_people as cliente_apellido,
                    c.lname2_people as cliente_apellido2
                FROM
                        tareas
                LEFT JOIN people ON people.id_people = tareas.trabajador
                LEFT JOIN people as c ON c.id_people = tareas.cliente
                LEFT JOIN servicios ON tareas.servicio = servicios.id_servicio";

        return $this->getRecord($stmt);
    }

    function get_by_id($id) {
        $stmt = 'SELECT * FROM tareas WHERE id_tareas = ' . $id;
        $res = $this->getRecord($stmt);
        return $res[0];
    }

    function remove_by_id($id) {
        $stmt = 'DELETE FROM tareas WHERE id_tareas = ' . $id;
        return $this->mysqli->query($stmt);
    }

}
