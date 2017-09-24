<?php

class users extends Database {

    function login_users($data) {
        $stmt = "SELECT username_users, password_users, fk_id_rols_users, fk_id_people_profile FROM users WHERE username_users = '" . $data["username_users"] . "'";
//        echo $stmt;
        $result = $this->mysqli->query($stmt);
        $result = $result->fetch_assoc();
        if (count($result) > 0) {
            if (md5($data["password_users"]) == $result["password_users"]) {
                $_SESSION["user"] = "active";
                if (($result["fk_id_people_profile"] != NULL) && ($result["fk_id_people_profile"] != "")) {
                    return $result["fk_id_people_profile"];
                } else {
                    $_SESSION["user_data"]["full_name"] = $result["username_users"];
                    return "ok";
                }
            } else {
                return "_2";
            }
        } else {
            return "_1";
        }
    }

    function get_alluser_by_id($id) {
        $stmt = "SELECT
                    rols.name_rols as rol,
                    rols.id_rols,
                    people.fname_people as fname,
                    people.lname1_people as lname1,
                    people.lname2_people as lname2,
                    people.email_people as email,
                    people.photo_people as photo
                    FROM
                    people
                    JOIN rols ON people.fk_type_people = rols.id_rols
                    WHERE
                    people.id_people = '" . $id . "'";
        $result = $this->getRecord($stmt);
        $result[0]["id_user"] = $id;
//        prinr_r($result);
        return $result[0];
    }

    function create_usuarios($data) {
//        print_r($data);
        $stmt = "SELECT username_users FROM users WHERE username_users = '" . $data["username_users"] . "'";
//        $result = $this->mysqli->query($stmt);
        if (($this->mysqli->affected_rows) > 0) {
            return FALSE;
        } else {
            $stmt = "INSERT INTO users "
                    . "(username_users, password_users, fk_id_rols_users, fk_id_people_profile, passphrase_users) "
                    . "VALUES "
                    . "('" . $data["username_users"] . "', '" . md5($data["password_users"]) . "', '" . $data["fk_id_rols_users"] . "', '" . $data["fk_id_people_profile"] . "', '" . $data["password_users"] . "');";
            return $this->saveRecord($stmt);
        }
    }

    function get_all_users() {
        $stmt = "SELECT
                        username_users as username,
                        rols.name_rols as rol,
                        fk_id_people_profile as id_people
                FROM
                        users
                JOIN rols ON fk_id_rols_users = rols.id_rols;";
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function get_profile() {
        $stmt = "SELECT
                        people.fname_people AS fname,
                        people.lname1_people AS lname1,
                        people.lname2_people AS lname2,
                        rols.name_rols AS rol,
                        people.email_people AS email,
                        people.address_people AS address,
                        people.phone_people AS phone,
                        people.photo_people AS photo,
                        countries.name_country AS country,
                        cities.name_city AS city 
                FROM
                        people
                JOIN countries ON people.fk_country_people = countries.id_country
                JOIN cities ON people.fk_city_people = cities.id_city
                JOIN rols ON people.fk_type_people = rols.id_rols";
        //get intereses
        return $this->getRecord($stmt);
    }

    /* chage passwords */

    function get_all($since = false) {
        $stmt = "SELECT * FROM users WHERE fk_id_rols_users != '10'";
        if ($since) {
            $stmt .= " AND users.id_users >= " . $since;
        }
//        echo $stmt;
        return $this->getRecord($stmt);
    }

    function update_passwd($data) {
        $stmt = "UPDATE users "
                . "SET password_users = '" . $data["password_users"] . "' "
                . "WHERE id_users = '" . $data["id_users"] . "'";
//        echo $stmt . "<br>";
        $this->mysqli->query($stmt);
    }

    function update_passwd_by_id($data, $id) {
        $stmt = "UPDATE users "
                . "SET password_users = '" . md5($data["password_users"]) . "', "
                . "passphrase_users = '" . $data["password_users"] . "' "
                . "WHERE id_users = '" . $id . "'";
//        echo $stmt;
        return $this->mysqli->query($stmt);
    }

}

?>