<?php

class aulas_alumnos extends Database {

    function get_all() {

        $stmt = "SELECT

                        * 

                FROM

                        aulas_alumnos

                LEFT JOIN aulas ON aulas_alumnos.fk_aula = aulas.id_aula

                LEFT JOIN aulas_usuarios ON aulas_usuarios.fk_aula = aulas.id_aula 

                LEFT JOIN alumnos_servicios ON aulas_alumnos.fk_alumno = alumnos_servicios.id_alumnos_servicios

                GROUP BY aulas.id_aula";

        return $this->getRecord($stmt);
    }

    function get_all_user($id_user) {

        $stmt = "SELECT 

                        * 

                FROM

                        aulas_alumnos

                LEFT JOIN aulas ON aulas_alumnos.fk_aula = aulas.id_aula

                LEFT JOIN users_aulas ON (users_aulas.fk_aula = aulas.id_aula) AND (users_aulas.fk_people = " . $id_user . ")

                GROUP BY aulas.id_aula";

//        echo $stmt;

        return $this->getRecord($stmt);
    }

    function add_alumnos_to_aula($aula, $data) {

//        print_r($data);

        $stmt = "INSERT INTO aulas_alumnos "
                . "(fk_aula, fk_alumno) "
                . "VALUES ";

        for ($i = 0; $i < count($data); $i++) {

            $stmt .= "('" . $aula . "', '" . $data[$i] . "') ";

            if ($i != count($data) - 1) {

                $stmt .= ",";
            }
        }

//        echo $stmt;

        return $this->saveRecord($stmt);
    }

    function get_alumnos_by_aula($id) {

        $stmt = 'SELECT

                        people.id_people,

                        people.fname_people,

                        people.lname1_people,

                        people.lname2_people,

                        people.email_people,

                        people.address_people,

                        people.phone_people,

                        people.fk_city_people,

                        people.fk_country_people,

                        people.fk_type_people,

                        people.photo_people,

                        countries.name_country,

                        cities.name_city

                FROM

                        people

                LEFT JOIN countries ON countries.id_country = fk_country_people

                LEFT JOIN cities ON cities.id_city = fk_city_people

                LEFT JOIN aulas_alumnos ON aulas_alumnos.fk_alumno = people.id_people

                WHERE

                        fk_type_people = "1"

                AND aulas_alumnos.fk_aula = "' . $id . '" 

                GROUP BY people.id_people 

                ORDER BY

                        fname_people ASC';

//        echo $stmt;

        return $this->getRecord($stmt);
    }

    function get_alumnos_by_aula_idmod($id, $v2 = false) {
        $output = array();
        $stmt = 'SELECT

                        people.*,

                        countries.*,

                        cities.*,

                        servicios.*,

                        alumnos_servicios.*,

                        aulas_alumnos.*,

                        users.*

                FROM

                        people

                people

                LEFT JOIN countries ON countries.id_country = fk_country_people

                LEFT JOIN cities ON cities.id_city = fk_city_people

                LEFT JOIN alumnos_servicios ON alumnos_servicios.id_alumnos_servicios = people.id_people

                LEFT JOIN servicios ON alumnos_servicios.fk_servicio = servicios.id_servicio

                LEFT JOIN aulas_alumnos ON aulas_alumnos.fk_alumno = people.id_people

                LEFT JOIN users ON users.fk_id_people_profile = people.id_people

                WHERE

                        fk_type_people = "1"

                AND aulas_alumnos.fk_aula = "' . $id . '" 

                GROUP BY people.id_people 

                ORDER BY

                        fname_people ASC';

       // echo $stmt; 

        if ($v2 == false) {

            $result = $this->mysqli->query($stmt);

            while ($row = $result->fetch_assoc()) {

                $output[$row["id_people"]] = $row;
            }
            if (count($output) <= 0) {
                $output = FALSE;
            }
        } else {

            $output = $this->getRecord($stmt);
        }


        return $output;
    }

    function remove_alumnes_aula($aula) {

        $stmt = "DELETE FROM aulas_alumnos "
                . "WHERE fk_aula = '" . $aula . "'";

//        echo $stmt;

        $this->mysqli->query($stmt);
    }

    function remove_alumnes_from_aula($id) {

        $stmt = "DELETE FROM aulas_alumnos "
                . "WHERE fk_alumno = '" . $id . "'";

//        echo $stmt;

        $this->mysqli->query($stmt);
    }

    function update_alumnos_to_aula($data, $aula) {

//        print_r($data);

        $this->remove_alumnes_aula($aula);

        return $this->add_alumnos_to_aula($aula, $data);
    }

    /* no permisions */

    function get_aulas_by_alumno($id) {

        $stmt = "SELECT

    *

FROM

    aulas_alumnos

LEFT JOIN aulas ON aulas_alumnos.fk_aula = aulas.id_aula

LEFT JOIN users_aulas ON (users_aulas.fk_aula = aulas.id_aula) AND  (users_aulas.fk_people = '" . $id . "')

LEFT JOIN alumnos_servicios ON aulas_alumnos.fk_alumno = alumnos_servicios.id_alumnos_servicios

LEFT JOIN modulos_orden ON alumnos_servicios.fk_servicio = modulos_orden.fk_servicio_educativo

AND aulas.fk_modulo = modulos_orden.fk_modulo

WHERE

    aulas_alumnos.fk_alumno = '" . $id . "'

GROUP BY aulas.id_aula

ORDER BY

modulos_orden.orden ASC";



//        echo $stmt;

        return $this->getRecord($stmt);
    }

        function get_aulas_by_alumno_nw($id) {

        $stmt = "SELECT
                a.id_aula,
                m.id_modulo,
                m.nombre_modulo,
                m.imagen_modulo,
                a.f_inicio
                FROM
                    aulas_alumnos aa
                INNER JOIN aulas a ON a.id_aula = aa.fk_aula
                INNER JOIN modulos m ON m.id_modulo = a.fk_modulo
                WHERE aa.fk_alumno = ". $id ."
                ORDER BY a.id_aula";



//        echo $stmt;

        return $this->getRecord($stmt);
    }

}
