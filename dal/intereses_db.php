<?php

class intereses extends Database {

    function add_intereses($data) {
        $stmt = "INSERT INTO intereses "
                . "() VALUES ('" . $data["fname_people"] . "', '" . $data["lname1_people"] . "')";
        return $this->getRecord($stmt);
    }
}

?>