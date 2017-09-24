<?php

class alumnos extends Database {

    function get_all_alumnos() {
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
                    users.passphrase_users,
                    users.username_users,
                    countries.name_country,
                    cities.name_city, 
                    servicios.name_servicio
                    FROM
                            people
                    LEFT JOIN users ON users.fk_id_people_profile = people.id_people                   
                    LEFT JOIN countries ON countries.id_country = fk_country_people
                    LEFT JOIN cities ON cities.id_city = fk_city_people
                    LEFT JOIN alumnos_servicios ON alumnos_servicios.id_alumnos_servicios = people.id_people
                    LEFT JOIN servicios ON alumnos_servicios.fk_servicio = servicios.id_servicio
                    WHERE
                            fk_type_people = "1"
                    ORDER BY
                            fname_people ASC;';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function create_alumne($data) {
//        print_r($data);
        $stmt = "INSERT INTO people "
                . "(fname_people, lname1_people, lname2_people, email_people, phone_people, fk_type_people) "
                . "VALUES "
                . "('" . $data["fname_people"] . "', '" . $data["lname1_people"] . "', '" . $data["lname2_people"] . "', '" . $data["email_people"] . "', '" . $data["phone_people"] . "', '" . $data["fk_type_people"] . "');";
        $this->mysqli->query($stmt);
        return $this->mysqli->insert_id;
    }

    function get_alumnos_by_profe($id) {
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
                        cities.name_city,
                        servicios.name_servicio
                    FROM
                        people
                            LEFT JOIN
                        countries ON countries.id_country = fk_country_people
                            LEFT JOIN
                        cities ON cities.id_city = fk_city_people
                            LEFT JOIN
                        alumnos_servicios ON alumnos_servicios.id_alumnos_servicios = people.id_people
                            LEFT JOIN
                        servicios ON alumnos_servicios.fk_servicio = servicios.id_servicio
                                    LEFT JOIN
                            aulas_alumnos ON aulas_alumnos.fk_alumno = people.id_people
                                    LEFT JOIN 
                            aulas_profesores ON aulas_profesores.fk_aula = aulas_alumnos.fk_aula
                    WHERE
                        fk_type_people = "1"
                    AND aulas_profesores.fk_profesor = ' . $id . '
                    GROUP BY people.id_people
                    ORDER BY fname_people ASC;';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function get_alumnos_by_profe_aula($id) {
        $stmt = 'SELECT 
                        people.id_people,
                        people.fname_people,
                        people.lname1_people,
                        people.lname2_people,
                        people.email_people,
                        modulos.id_modulo,
                        modulos.nombre_modulo,
                        people.address_people,
                        people.phone_people,
                        people.fk_city_people,
                        people.fk_country_people,
                        people.fk_type_people,
                        people.photo_people,
                        countries.name_country,
                        cities.name_city,
                        aulas.f_inicio,
                        servicios.name_servicio
                    FROM
                        people
                            LEFT JOIN
                        countries ON countries.id_country = fk_country_people
                            LEFT JOIN
                        cities ON cities.id_city = fk_city_people
                            LEFT JOIN
                        alumnos_servicios ON alumnos_servicios.id_alumnos_servicios = people.id_people
                            LEFT JOIN
                        servicios ON alumnos_servicios.fk_servicio = servicios.id_servicio
                                    LEFT JOIN
                            aulas_alumnos ON aulas_alumnos.fk_alumno = people.id_people
                                    LEFT JOIN 
                            aulas_profesores ON aulas_profesores.fk_aula = aulas_alumnos.fk_aula
                            LEFT JOIN
                        aulas ON aulas.id_aula = aulas_alumnos.fk_aula
                            LEFT JOIN 
                        modulos ON modulos.id_modulo = aulas.fk_modulo
                    WHERE
                        fk_type_people = "1"
                    AND aulas_profesores.fk_profesor = ' . $id . '
                    ORDER BY modulos.nombre_modulo DESC;';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function get_alumnos_not_aula($id) {
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
                WHERE
                        fk_type_people = "1"
                AND people.id_people NOT IN (
                        SELECT
                                aulas_alumnos.fk_alumno
                        FROM
                                aulas_alumnos
                        WHERE
                                aulas_alumnos.fk_aula = "' . $id . '"
                )
                ORDER BY
                        fname_people ASC;';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function remove_alumno($id) {
        $stmt = "DELETE FROM people "
                . "WHERE id_people = '" . $id . "'";
        return $this->mysqli->query($stmt);
    }

    /* no permisions */
}
