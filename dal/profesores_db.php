<?php

class profesores extends Database {

    function get_all_profesores() {
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
                    cities.name_city
                    FROM
                            people
                    LEFT JOIN users ON users.fk_id_people_profile = people.id_people
                    LEFT JOIN countries ON countries.id_country = fk_country_people
                    LEFT JOIN cities ON cities.id_city = fk_city_people
                    WHERE
                            fk_type_people = "2"
                    ORDER BY
                            fname_people ASC;';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function get_by_id($id) {
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
                    people.photo_people
                    FROM
                            people
                            WHERE id_people = ' . $id;
        $res = $this->getRecord($stmt);
        return $res[0];
    }

    function get_by_aula($id) {
        $stmt = 'SELECT *
                    FROM people
                    LEFT JOIN aulas_profesores ON aulas_profesores.fk_profesor = people.id_people
                    WHERE aulas_profesores.fk_aula = ' . $id;
        return $this->getRecord($stmt);
    }

    function get_all_out_noticia($noticia) {
        $stmt = 'SELECT
                    people.id_people,
                    people.fname_people,
                    people.lname1_people,
                    people.lname2_people,
                    fk_type_people
                    FROM
                            people
                    WHERE people.id_people NOT IN (SELECT 
                                                    people.id_people
                                                FROM
                                                    people
                                                        LEFT JOIN
                                                noticias_people ON noticias_people.fk_people = people.id_people
                                                WHERE
                                                noticias_people.fk_noticias = ' . $noticia . ')
                    GROUP BY
                        people.id_people
                    ORDER BY
                            fname_people ASC
                        ';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function get_all_in_noticia($noticia) {
        $stmt = 'SELECT
                    people.id_people,
                    people.fname_people,
                    people.lname1_people,
                    people.lname2_people,
                    fk_type_people
                FROM
                        people
                LEFT JOIN noticias_people ON noticias_people.fk_people = people.id_people
                WHERE noticias_people.fk_noticias = ' . $noticia . ' 
                GROUP BY
                        people.id_people
                ORDER BY
                        fname_people ASC
                        ';
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function get_by_alumno($id) {
        $stmt = 'SELECT 
                    people.*
                FROM
                    people
                LEFT JOIN aulas_profesores ON aulas_profesores.fk_profesor = people.id_people
                LEFT JOIN aulas ON aulas.id_aula = aulas_profesores.fk_aula
                LEFT JOIN aulas_alumnos ON aulas_alumnos.fk_aula = aulas_profesores.fk_aula
                WHERE people.fk_type_people = "2" AND aulas_alumnos.fk_alumno = "' . $id . '"
                GROUP BY people.id_people';
        return $this->getRecord($stmt);
    }

    function get_simple_profesores() {
        $stmt = 'SELECT
                    people.id_people,
                    people.fname_people,
                    people.lname1_people,
                    people.lname2_people
                    FROM
                            people
                    WHERE
                            fk_type_people = "2"
                    ORDER BY
                            fname_people ASC;';
        return $this->getRecord($stmt);
    }

    function create_profesor($data) {
//        print_r($data);
        $stmt = "INSERT INTO people "
                . "(id_people, fname_people, lname1_people, lname2_people, email_people, address_people, phone_people, fk_city_people, fk_country_people, fk_type_people) "
                . "VALUES "
                . "('" . $data["fname_people"] . "', '" . $data["lname1_people"] . "', '" . $data["lname2_people"] . "', '" . $data["email_people"] . "', '" . $data["address_people"] . "', '" . $data["phone_people"] . "', '" . $data["fk_city_people"] . "', '" . $data["fk_country_people"] . "', '" . $data["fk_type_people"] . "');";
        return $this->saveRecord($stmt);
    }

}

?>