<?php

class servicios extends Database {

    function get_all_servicios() {

        $stmt = 'SELECT 

                    servicios.id_servicio,

                    servicios.creador_servicio,

                    servicios.name_servicio,

                    servicios.price_servicio,

                    servicios.price_servicio2,

                    servicios.descripcion_servicio,

                    type_services.name,

                    type_services.id_type_services

                FROM servicios

                LEFT JOIN type_services on type_services.id_type_services = servicios.fk_type_services';

        return $this->getRecord($stmt);
    }

    function create_servicio($data) {

//        print_r($data);

        $stmt = "INSERT INTO servicios "
                . "(creador_servicio, name_servicio, price_servicio, descripcion_servicio, fk_type_services, price_servicio2) "
                . "VALUES "
                . "('" . $data["creador_servicio"] . "', '" . $data["nombre_servicio"] . "', '" . $data["precio_servicio"] . "', '" . $data["descripcion_servicio"] . "', '" . $data["fk_type_services"] . "', '" . $data["precio_servicio2"] . "');";

//        echo $stmt;

        return $this->saveRecord($stmt);
    }

    function update_servicio($data, $id) {

        $stmt = "UPDATE servicios "
                . "SET name_servicio = '" . $data["nombre_servicio"] . "', "
                . "price_servicio ='" . $data["precio_servicio"] . "', "
                . "price_servicio2 ='" . $data["precio_servicio2"] . "', "
                . "descripcion_servicio ='" . $data["descripcion_servicio"] . "', "
                . "fk_type_services ='" . $data["fk_type_services"] . "' "
                . "WHERE id_servicio = '" . $id . "'";

//        echo $stmt;

        return $this->mysqli->query($stmt);
    }

    function remove_servicio($id) {

        $stmt = "DELETE FROM servicios "
                . "WHERE id_servicio = '" . $id . "'";

//        echo $stmt;

        return $this->mysqli->query($stmt);
    }

    function get_services_by_type($type) {

        $stmt = 'SELECT 

                    servicios.id_servicio,

                    servicios.creador_servicio,

                    servicios.name_servicio,

                    servicios.price_servicio,

                    servicios.descripcion_servicio,

                    type_services.name,

                    type_services.id_type_services

                FROM servicios

                JOIN type_services on type_services.name = "' . $type . '"';

        return $this->getRecord($stmt);
    }

    function get_services_by_id($id) {

        $stmt = 'SELECT 

                    servicios.id_servicio,

                    servicios.creador_servicio,

                    servicios.name_servicio,

                    servicios.price_servicio,

                    servicios.price_servicio2,

                    servicios.descripcion_servicio,

                    type_services.name,

                    type_services.id_type_services,
                    ediciones.anio_init,
                    ediciones.mes_init

                FROM servicios

                LEFT JOIN type_services on type_services.id_type_services = servicios.fk_type_services
                LEFT JOIN servicios_ediciones ON servicios_ediciones.fk_servicios = servicios.id_servicio
                LEFT JOIN ediciones ON ediciones.id_ediciones = servicios_ediciones.fk_ediciones

                WHERE servicios.id_servicio = "' . $id . '"';

        $data = $this->getRecord($stmt);

        return $data[0];
    }

}
